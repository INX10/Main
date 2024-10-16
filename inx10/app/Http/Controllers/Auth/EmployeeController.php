<?php


namespace App\Http\Controllers\Auth;

use Carbon\Carbon; // To handle dates
use App\Models\EmployeeHistory;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Models\EmployeeInformation;
use App\Models\EmployeeDocuments;
use App\Models\EmployeeOtherInfo;
use Illuminate\Support\Facades\Log;
use App\Models\EmployeeDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Announcement;




class EmployeeController extends Controller
{
    
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
        public function getEmployeeCount()
        {
            try {
                $employeeCount = EmployeeInformation::count(); // Static access
                return response()->json(['count' => $employeeCount]);
            } catch (\Exception $e) {
                Log::error('Error fetching employee count: ' . $e->getMessage());
                return response()->json(['count' => 0], 500); // Return 0 in case of an error
            }
        }
/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

        public function getDepartments()
        {
            $departments = EmployeeDepartment::all();
            return response()->json($departments);
        }

        public function employee(){
            return view('employee');
        }

        public function admin(){
            return view ('admin');
        }

        public function department(){
            return view ('department');
        }
        

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
        public function insertEmployeeData(Request $request)
        {
           

          try{
                $fname = $request->input('firstName');
                $mname = $request->input('middleName');
                $lname = $request->input('lastName');
                $suffixes = $request->input('suffix_input');

                $employeeId = DB::table('employee_information')->insertGetId([
                    'first_name'=>$fname,
                    'middle_name'=>$mname,
                    'last_name' => $lname,
                    'suffix' => $suffixes,
                ]);

              

                $birthDate = $request->input('birthdate');
                $birthPlace = $request->input('birthplace');
                $civilStatus = $request->input('civilstatus');

                DB::table('employee_otherinfo')->insert([
                    'employee_ID' => $employeeId,
                    'birth_date' => $birthDate,  
                    'birth_place' => $birthPlace,
                    'civil_status' => $civilStatus,
                ]);

                $email = $request->input('Email');
                $conNumber = $request->input('contactNumber');
                $telNumber = $request->input('telephoneNumber');
                $perAddress = $request->input('PermanentAddress');
                $currAddress = $request->input('CurrentAddress');

                DB::table('employee_contactinfo')->insert([
                    'employee_ID' => $employeeId,
                    'email' => $email,
                    'contact_no' => $conNumber,
                    'telephone_no' => $telNumber,
                    'permanent_address' => $perAddress,
                    'current_address' => $currAddress,
                ]);

                // Optional government IDs
                $sssid = $request->input('sssId');
                $philhealthid = $request->input('philhealthId');
                $pagibigid = $request->input('Pagibig');
                $tinid = $request->input('TINno');

                // Validate only if inputs are provided
                $validator = Validator::make($request->all(), [
                    'sssId' => 'nullable|unique:employee_governmentid,sss|max:12',
                    'philhealthId' => 'nullable|unique:employee_governmentid,philhealth|max:13',
                    'Pagibig' => 'nullable|unique:employee_governmentid,pagibig|max:14',
                    'TINno' => 'nullable|unique:employee_governmentid,tin|max:15',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                // Insert only if values are provided
                if ($sssid) {
                    DB::table('employee_governmentid')->insert([
                        'employee_ID' => $employeeId,
                        'sss' => $sssid,
                    ]);
                }
                if ($philhealthid) {
                    DB::table('employee_governmentid')->insert([
                        'employee_ID' => $employeeId,
                        'philhealth' => $philhealthid,
                    ]);
                }
                if ($pagibigid) {
                    DB::table('employee_governmentid')->insert([
                        'employee_ID' => $employeeId,
                        'pagibig' => $pagibigid,
                    ]);
                }
                if ($tinid) {
                    DB::table('employee_governmentid')->insert([
                        'employee_ID' => $employeeId,
                        'tin' => $tinid,
                    ]);
                }

                        // Insert work history
                $companies = $request->input('company');
                $startdates = $request->input('start_dates');
                $enddates = $request->input('end_dates');
                $jobtitles = $request->input('remarks');

                $maxEntries = max(count($companies), count($enddates));

                for ($i = 0; $i < $maxEntries; $i++) {
                    $companyName = isset($companies[$i]) ? $companies[$i] : null;
                    if ($companyName) { // Only insert if company name is present
                        DB::table('employee_workhistory')->insert([
                            'employee_ID' => $employeeId,
                            'company' => $companyName,
                            'start_date' => isset($startdates[$i]) ? $startdates[$i] : null,
                            'end_date' => isset($enddates[$i]) ? $enddates[$i] : null,
                            'remarks' => isset($jobtitles[$i]) ? $jobtitles[$i] : null,
                        ]);
                    }
                }

                // Insert educational background
                $highSchool = $request->input('high_school_names');
                $highSchoolend = $request->input('high_school_end_dates');
                $college = $request->input('college_names');
                $collegeend = $request->input('college_end_dates');

                $maxEntries = max(count($highSchool), count($highSchoolend), count($college), count($collegeend));

                for ($i = 0; $i < $maxEntries; $i++) {
                    $highSchoolName = isset($highSchool[$i]) ? $highSchool[$i] : null;
                    $collegeName = isset($college[$i]) ? $college[$i] : null;

                    // Only insert if either high school or college name is present
                    if ($highSchoolName || $collegeName) {
                        DB::table('employee_education')->insert([
                            'employee_ID' => $employeeId,
                            'highschool' => $highSchoolName,
                            'college' => $collegeName,
                            'remarks' => 'High School End Date: ' . (isset($highSchoolend[$i]) ? $highSchoolend[$i] : null) . ' | College End Date: ' . (isset($collegeend[$i]) ? $collegeend[$i] : null),
                        ]);
                    }
                }

                EmployeeHistory::create([
                    'employee_ID' => $employeeId, // Assuming employee_ID is auto-incremented
                    'department_ID' => $request->input('department'),
                    'start_date' => Carbon::now(), // Set the start date to the current date
                    'status' => true, // Assuming 'true' means the employee is active
                ]);

                 // Get uploaded images
                    if ($request->hasFile('employee_images')) {
                        $images = $request->file('employee_images');
                        
                        foreach ($images as $image) {
                            // Validate image (you can customize the rules as needed)
                            $request->validate([
                                'employee_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ]);
                            
                            // Store the image
                            $filename = time() . '_' . $image->getClientOriginalName(); // Unique filename
                            $image->storeAs('uploads/employees', $filename, 'public'); // Store in the public disk

                            // Insert into the employee_documents table
                            DB::table('employee_documents')->insert([
                                'employee_ID' => $employeeId,
                                'filename' => $image->getClientOriginalName(),
                                'document_file' => 'uploads/employees/' . $filename,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }

               
        
                // Redirect back to the same route with the fragment
                return redirect()->back()->with([
                    'success' => 'Employee data inserted successfully!',
                    'section' => 'add-employee' // Pass the section identifier
                ]);
                
            
            
            }catch (\Exception $e) {
                return redirect()->back()->with([
                    'error' => 'An error occurred while inserting employee data.',
                    'section' => 'add-employee' // Pass the section identifier even in case of error
                    
                ]);
            }
            
            }
/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
            public function getDepartmentEmployeeCounts()
            {
                try {
                    // Count employees per department from the employee_history table
                    $departmentEmployeeCounts = EmployeeHistory::select('department_ID', DB::raw('count(*) as total'))
                        ->groupBy('department_ID')
                        ->pluck('total', 'department_ID')
                        ->toArray();

                    // Return the counts as JSON
                    return response()->json(['departmentEmployeeCounts' => $departmentEmployeeCounts]);
                } catch (\Exception $e) {
                    Log::error('Error fetching department employee counts: ' . $e->getMessage());
                    return response()->json(['departmentEmployeeCounts' => []], 500); // Return an empty array on error
                }
            }
/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
            public function getEmployeesByDepartment($id)
                {
                    try {
                        // Fetch employees by department ID from employee_history table
                        $employees = EmployeeHistory::where('department_ID', $id)
                        ->join('employee_information', 'employee_history.employee_ID', '=', 'employee_information.employee_ID')
                        ->select(
                            'employee_history.employee_ID',
                            DB::raw("CONCAT(employee_information.first_name, ' ', COALESCE(employee_information.middle_name, ''), ' ', employee_information.last_name) as employee_name"),
                            'employee_history.start_date as date_hired'
                        )
                        ->get();

                        // Return the employees as JSON
                        return response()->json(['employees' => $employees]);
                    } catch (\Exception $e) {
                        Log::error('Error fetching employees by department: ' . $e->getMessage());
                        return response()->json(['employees' => []], 500); // Return an empty array on error
                    }
                }

                
            public function showProfile()
                {
                    $user = auth()->user(); 

    // Check if a user is authenticated
                if (!$user) {
                    return redirect()->route('login'); // Redirect to login if not authenticated
                }

                // Pass the user to the view
                return view('admin', compact('user'));  // Pass user to the view
                }

                public function fetchBirthdays()
                {
                    $currentMonth = Carbon::now()->month;

                    // Get all birthdays for the current month
                    $birthdaysThisMonth = EmployeeOtherInfo::whereMonth('birth_date', $currentMonth)
                        ->with('employee') // Load related employee information
                        ->get();
                
                    return response()->json([
                        'birthdaysThisMonth' => $birthdaysThisMonth,
                    ]);
                }
                

                
        }
    
