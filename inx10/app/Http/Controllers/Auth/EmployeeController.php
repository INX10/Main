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
use Illuminate\Support\Facades\Auth;




class EmployeeController extends Controller
{

    public function index()
    {
        return view('employee'); // Return the employee view
    }
    
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


        

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
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

                    // Fetch the department ID from the form input
                    $departmentId = $request->input('department');

                    // Insert into employee_history with today's date as start_date and status 1
                    DB::table('employee_history')->insert([
                        'employee_ID' => $employeeId,
                        'department_ID' => $departmentId,
                        'start_date' => now()->toDateString(), // current date
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);   
                    

                    $request->validate([
                        'employee_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);
                                // Handling the Image Upload
                    if ($request->hasFile('employee_images')) {
                        $image = $request->file('employee_images');  // Get the file

                        // Read the file as binary data
                        $imageData = file_get_contents($image->getRealPath());

                        // Insert the image as BLOB into the employee_documents table
                        DB::table('employee_documents')->insert([
                            'employee_ID' => $employeeId,
                            'filename' => 'empPicture', // Save 'empPicture' in the filename column to identify it as the employee's picture
                            'document_file' => $imageData, // Save the binary data of the image in the document_file column
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

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
                    // Concatenate permanent address fields, allowing NULL for house number and street
                    $perAddress = trim(
                        ($request->input('permHouseNumber') ? $request->input('permHouseNumber') . ', ' : '') .
                        ($request->input('permStreet') ? $request->input('permStreet') . ', ' : '') .
                        $request->input('permBarangay') . ', ' .
                        $request->input('permCity') . ', ' .
                        $request->input('permProvince')
                    );

                    // Concatenate current address fields, allowing NULL for house number and street
                    $currAddress = trim(
                        ($request->input('currentHouseNumber') ? $request->input('currentHouseNumber') . ', ' : '') .
                        ($request->input('currentStreet') ? $request->input('currentStreet') . ', ' : '') .
                        $request->input('currentBarangay') . ', ' .
                        $request->input('currentCity') . ', ' .
                        $request->input('currentProvince')
                    );

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
                    
                    DB::table('employee_governmentid')->insert([
                        'employee_ID' => $employeeId,
                        'sss' => $sssid,
                        'philhealth' => $philhealthid,
                        'pagibig' => $pagibigid,
                        'tin' => $tinid,
                    ]);
                


                    $employmentType = $request->input('employment_type');
                    $companyName = $request->input('companyname');
                    $jobPosition = $request->input('jobposition');
                    $dateHired = $request->input('datehired');
                    $dateEnd = $request->input('dateend');
            
                    if ($employmentType === 'Fresh Graduate') {
                        // If the employee is a fresh graduate, record this in the remarks and leave others null
                        DB::table('employee_workhistory')->insert([
                            'employee_ID' => $employeeId,
                            'start_date' => null,
                            'end_date' => null,
                            'company' => null,
                            'remarks' => 'Fresh Graduate',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        // For Full-time and Part-time
                        DB::table('employee_workhistory')->insert([
                            'employee_ID' => $employeeId,
                            'start_date' => $dateHired,
                            'end_date' => $dateEnd,
                            'company' => $companyName,
                            'remarks' => $employmentType . ' | ' . $jobPosition,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    $educationType = $request->input('education_type');
                    $schoolName = $request->input('schoolname');
                    $programInput = $request->input('program'); // College, Undergraduate, or Vocational input
                    $programSelect = $request->input('program_select'); // Grade School, High School, or Senior High School dropdown
                    
                    $highschool = null;
                    $college = null;
                    $remarks = null;
                    
                    switch ($educationType) {
                        case "Grade School":
                            $remarks = "Grade School | $schoolName | $programSelect";
                            break;
                        case "High School":
                            $highschool = $schoolName;
                            $remarks = "High School | $programSelect";
                            break;
                        case "Senior High School":
                            $highschool = $schoolName;
                            $remarks = "SHS | $programSelect";
                            break;
                        case "Under Graduate":
                            $college = $schoolName;
                            $remarks = "UnderGrad | $programInput";
                            break;
                        case "College":
                            $college = $schoolName;
                            $remarks = "College | $programInput";
                            break;
                        case "Vocational":
                            $college = $schoolName; // Save school name in the college column for Vocational
                            $remarks = "Vocational | $programInput";
                            break;
                    }

                  
                    
                    // Insert into employee_education table
                    DB::table('employee_education')->insert([
                        'employee_ID' => $employeeId,
                        'highschool' => $highschool,
                        'college' => $college,
                        'remarks' => $remarks,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);


                    $request->validate([
                        'documents.*' => 'file|mimes:pdf,doc,docx,jpeg,jpg,png|max:14048', // Adjust max size as needed
                    ]);
            
                    // Handling multiple documents
                    if ($request->hasFile('documents')) {
                        foreach ($request->file('documents') as $document) {
                            $documentData = file_get_contents($document->getRealPath());
            
                            // Insert each document with predefined filename and binary data
                            DB::table('employee_documents')->insert([
                                'employee_ID' => $employeeId,
                                'filename' => 'docpicfile', // Set the filename as "docpicfile"
                                'document_file' => $documentData,
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
                                'employee_history.start_date as date_hired',
                                'employee_history.status'  // Add the status field here
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


                  /**
         * @SuppressWarnings(PHPMD.StaticAccess)
         * @SuppressWarnings(PHPMD.ElseExpression)
         */
        
        // EmployeeController.php
       public function getBirthdayOverview()
            {
                $currentMonth = now()->month;
                $currentDay = now()->day;

                // Get employees with upcoming birthdays this month (limit to 6)
                $employeesWithBirthdays = DB::table('employee_otherinfo')
                    ->join('employee_information', 'employee_otherinfo.employee_ID', '=', 'employee_information.employee_ID')
                    ->select('employee_information.first_name', 'employee_information.last_name', 'employee_otherinfo.birth_date')
                    ->whereMonth('employee_otherinfo.birth_date', $currentMonth)
                    ->whereDay('employee_otherinfo.birth_date', '>=', $currentDay) // Only future dates within this month
                    ->orderBy('employee_otherinfo.birth_date', 'asc') // Sort by birth date
                    ->limit(6)
                    ->get();

                // Get employee with birthday today, including their profile picture
                $birthdayToday = DB::table('employee_otherinfo')
                    ->join('employee_information', 'employee_otherinfo.employee_ID', '=', 'employee_information.employee_ID')
                    ->leftJoin('employee_documents', function ($join) {
                        $join->on('employee_otherinfo.employee_ID', '=', 'employee_documents.employee_ID')
                            ->where('employee_documents.filename', '=', 'empPicture');
                    })
                    ->select(
                        'employee_information.first_name',
                        'employee_information.last_name',
                        'employee_otherinfo.birth_date',
                        'employee_documents.document_file as picture' // Include the document file (image data)
                    )
                    ->whereMonth('employee_otherinfo.birth_date', $currentMonth)
                    ->whereDay('employee_otherinfo.birth_date', $currentDay)
                    ->first();

                // Convert picture to base64 if available
                if ($birthdayToday && $birthdayToday->picture) {
                    $birthdayToday->picture = base64_encode($birthdayToday->picture);
                }

                return response()->json([
                    'birthdayToday' => $birthdayToday,
                    'monthlyBirthdays' => $employeesWithBirthdays,
                ]);
            }


                    // EmployeeController.php
            public function updateEmployeeStatus(Request $request)
            {
                // Validate the request data
                $request->validate([
                    'employeeStatus' => 'required|array',
                ]);

                foreach ($request->employeeStatus as $employeeId => $status) {
                    // Update the status in the employee_history table
                    DB::table('employee_history')
                        ->where('employee_ID', $employeeId)
                        ->update(['status' => $status]);
                }

                return response()->json(['success' => true]);
            }


            public function getAdminEmployeeOverview()
            {
                $employees = DB::table('employee_history')
                    ->join('employee_information', 'employee_history.employee_ID', '=', 'employee_information.employee_ID')
                    ->join('employee_department', 'employee_history.department_ID', '=', 'employee_department.department_ID')
                    ->select(
                        'employee_information.first_name',
                        'employee_information.middle_name',
                        'employee_information.last_name',
                        'employee_department.department_name',
                        'employee_history.start_date',
                        'employee_history.status'
                    )
                    ->orderBy('employee_history.created_at', 'desc')
                    ->limit(7) // Limit results to 9
                    ->get();
            
                return response()->json($employees);
            }

                 /**
         * @SuppressWarnings(PHPMD.StaticAccess)
         * @SuppressWarnings(PHPMD.ElseExpression)
         */
            public function displayEmployeeManagementOverview()
            {
                $employees = DB::table('employee_information')
                    ->join('employee_contactinfo', 'employee_information.employee_ID', '=', 'employee_contactinfo.employee_ID')
                    ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID')
                    ->join('employee_department', 'employee_history.department_ID', '=', 'employee_department.department_ID')
                    ->select(
                        'employee_information.employee_ID',
                        DB::raw("CONCAT(employee_information.first_name, ' ', employee_information.middle_name, ' ', employee_information.last_name) AS name"),
                        'employee_department.department_name',
                        'employee_contactinfo.contact_no',
                        'employee_contactinfo.email',
                        'employee_history.start_date as date_hired'
                    )
                    ->limit(10)
                    ->orderBy('employee_history.start_date', 'desc') // Sort by date hired in descending order
                    ->get();
            
                return response()->json($employees);
            }
            

    /**
         * @SuppressWarnings(PHPMD.StaticAccess)
         * @SuppressWarnings(PHPMD.ElseExpression)
         */
public function getSameDepartmentEmployees(Request $request)
{
    // Get the logged-in user (department head)
    $user = Auth::user();

    // Get the department ID of the department head from the employee_history table
    $department = DB::table('employee_history')
                    ->where('employee_ID', function($query) use ($user) {
                        $query->select('employee_ID')
                              ->from('employee_information')
                              ->where('user_ID', $user->user_ID);
                    })
                    ->first();

    if (!$department) {
        return response()->json(['message' => 'Department not found'], 404);
    }

    // Get all employees in the same department
    $employees = DB::table('employee_history')
                    ->join('employee_information', 'employee_history.employee_ID', '=', 'employee_information.employee_ID')
                    ->join('employee_contactinfo', 'employee_history.employee_ID', '=', 'employee_contactinfo.employee_ID')
                    ->where('employee_history.department_ID', $department->department_ID)
                    ->select('employee_information.first_name', 'employee_information.middle_name', 'employee_information.last_name', 'employee_contactinfo.contact_no', 'employee_contactinfo.email', 'employee_history.start_date')
                    ->get();

    return response()->json($employees);
}

            


        }
    
