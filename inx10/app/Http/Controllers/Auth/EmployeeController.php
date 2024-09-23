<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Models\EmployeeInformation;
use Illuminate\Support\Facades\Log;
use App\Models\EmployeeDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Validator;




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
        public function create()
        {
            $departments = EmployeeDepartment::all(); // Static access
            return view('admin', ['departments' => $departments]);
        }

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
       
        public function insertEmployeeData(Request $request)
        {
            // Validation for government IDs (you can expand validation as needed)
            $messages = [
                'sssId.unique' => 'SSS ID is already taken.',
                'philhealthId.unique' => 'PhilHealth ID is already taken.',
                'Pagibig.unique' => 'Pag-IBIG ID is already taken.',
                'TINno.unique' => 'TIN number is already taken.',
            ];

            $validator = Validator::make($request->all(), [
                'sssId' => 'required|unique:employee_governmentid,sss|max:12',
                'philhealthId' => 'required|unique:employee_governmentid,philhealth|max:13',
                'Pagibig' => 'required|unique:employee_governmentid,pagibig|max:14',
                'TINno' => 'required|unique:employee_governmentid,tin|max:15',
            ], $messages);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Wrap everything in a transaction to ensure atomicity
            DB::beginTransaction();

            try {
                // Insert basic employee data using stored procedure
                $fname = $request->input('firstName');
                $mname = $request->input('middleName');
                $lname = $request->input('lastName');

                // Call the stored procedure AddEmployeeData
                $result = DB::select('CALL AddEmployeeData(?, ?, ?)', [$fname, $mname, $lname]);

                if ($result) {
                    $employeeId = $result[0]->employee_ID;

                    // Insert into employee_otherinfo table
                    $birthDate = $request->input('birthdate');
                    $birthPlace = $request->input('birthplace');
                    $civilStatus = $request->input('civilstatus');

                    DB::table('employee_otherinfo')->insert([
                        'employee_ID' => $employeeId,
                        'birth_date' => $birthDate,  // Keep the database column name as snake_case
                        'birth_place' => $birthPlace,
                        'civil_status' => $civilStatus,
                    ]);

                    // Insert into employee_contactinfo table
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

                    // Insert into employee_governmentid table
                    $sssid = $request->input('sssId');
                    $philhealthid = $request->input('philhealthId');
                    $pagibigid = $request->input('Pagibig');
                    $tinid = $request->input('TINno');

                    DB::table('employee_governmentid')->insert([
                        'employee_ID' => $employeeId,
                        'sss' => $sssid,
                        'philhealth' => $philhealthid,
                        'pagibig' => $pagibigid,
                        'tin' => $tinid,
                    ]);

                    // Insert work history
                    $companies = $request->input('company');
                    $startdates = $request->input('start_dates');
                    $enddates = $request->input('end_dates');
                    $jobtitles = $request->input('remarks');

                    $maxEntries = max(count($companies), count($enddates));

                    for ($i = 0; $i < $maxEntries; $i++) {
                        $companyName = isset($companies[$i]) ? $companies[$i] : null;
                        $startdatecomp = isset($startdates[$i]) ? $startdates[$i] : null;
                        $enddatecomp = isset($enddates[$i]) ? $enddates[$i] : null;
                        $jobtitlesremarks = isset($jobtitles[$i]) ? $jobtitles[$i] : null;

                        if ($companyName === null) {
                            continue;
                        }

                        DB::table('employee_workhistory')->insert([
                            'employee_ID' => $employeeId,
                            'company' => $companyName,
                            'start_date' => $startdatecomp,
                            'end_date' => $enddatecomp,
                            'remarks' => $jobtitlesremarks,
                        ]);
                    }

                    // Insert education history
                    $highSchool = $request->input('high_school_names');
                    $highSchoolend = $request->input('high_school_end_dates');
                    $college = $request->input('college_names');
                    $collegeend = $request->input('college_end_dates');

                    $maxEntries = max(count($highSchool), count($college), count($highSchoolend), count($collegeend));

                    for ($i = 0; $i < $maxEntries; $i++) {
                        $highSchoolName = isset($highSchool[$i]) ? $highSchool[$i] : null;
                        $collegeName = isset($college[$i]) ? $college[$i] : null;
                        $highSchoolEndDate = isset($highSchoolend[$i]) ? $highSchoolend[$i] : null;
                        $collegeEndDate = isset($collegeend[$i]) ? $collegeend[$i] : null;

                        if ($highSchoolName === null && $collegeName === null) {
                            continue;
                        }

                        DB::table('employee_education')->insert([
                            'employee_ID' => $employeeId,
                            'highschool' => $highSchoolName,
                            'college' => $collegeName,
                            'remarks' => 'High School End Date: ' . $highSchoolEndDate . ' | College End Date: ' . $collegeEndDate,
                        ]);
                    }

                    // Commit the transaction after successful inserts
                    DB::commit();

                    return redirect()->back()->with('success', 'Employee data inserted successfully.');
                }

            } catch (\Exception $e) {
                // Rollback the transaction if any exception occurs
                DB::rollback();
                Log::error('Error inserting employee data: ' . $e->getMessage());

                return redirect()->back()->withErrors('Error occurred during employee data insertion. Please try again.')->withInput();
            }
        }

}

