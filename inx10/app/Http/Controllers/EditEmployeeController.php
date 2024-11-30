<?php

namespace App\Http\Controllers;

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

class EditEmployeeController extends Controller
{
    public function getDepartmentsEditEmployee()
    {
        $departments = DB::table('employee_department')->select('department_ID', 'department_name')->get();
            return response()->json($departments);
    }

    public function editEmployeeGetEmployeesByDepartment($departmentId)
{
    // Retrieve employee history for the selected department
    $employeeHistory = DB::table('employee_history')
        ->where('department_ID', $departmentId)
        ->get();

    // Get the employee details (first_name, last_name, etc.) from the employee_information table
    $employeeIds = $employeeHistory->pluck('employee_ID');
    
    $employees = DB::table('employee_information')
        ->whereIn('employee_ID', $employeeIds)
        ->get(['employee_ID', 'first_name', 'last_name']);
    
    return response()->json($employees);
}

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */

public function getEmployeeDetails($employeeId)
{
    $employee = DB::table('employee_information')
        ->join('employee_contactinfo', 'employee_information.employee_ID', '=', 'employee_contactinfo.employee_ID')
        ->join('employee_otherinfo', 'employee_information.employee_ID', '=', 'employee_otherinfo.employee_ID')
        ->join('employee_governmentid', 'employee_information.employee_ID', '=', 'employee_governmentid.employee_ID')
        ->join('employee_workhistory', 'employee_information.employee_ID', '=', 'employee_workhistory.employee_ID')
        ->join('employee_education', 'employee_information.employee_ID', '=', 'employee_education.employee_ID')
        ->leftJoin('employee_documents', function ($join) {
            $join->on('employee_information.employee_ID', '=', 'employee_documents.employee_ID')
                ->where('employee_documents.filename', '=', 'empPicture');
        })
        ->select(
            'employee_information.first_name',
            'employee_information.middle_name',
            'employee_information.last_name',
            'employee_information.suffix',
            'employee_otherinfo.birth_date',
            'employee_otherinfo.birth_place',
            'employee_otherinfo.civil_status',
            'employee_contactinfo.email',
            'employee_contactinfo.contact_no',
            'employee_contactinfo.telephone_no',
            'employee_contactinfo.permanent_address',
            'employee_contactinfo.current_address',
            'employee_governmentid.sss',
            'employee_governmentid.philhealth',
            'employee_governmentid.pagibig',
            'employee_governmentid.tin',
            'employee_workhistory.company',
            'employee_workhistory.remark',
            'employee_workhistory.start_date',
            'employee_workhistory.end_date',
            'employee_education.remarks',
            DB::raw('COALESCE(NULLIF(employee_education.highschool, ""), NULLIF(employee_education.college, "")) AS education'),
            DB::raw('TO_BASE64(employee_documents.document_file) as empPicture')
            
        )
        ->where('employee_information.employee_ID', $employeeId)
        ->first();


    // Retrieve employee's image if available
    $employeeImage = DB::table('employee_documents')
    ->where('employee_ID', $employeeId)
    ->where('filename', 'empPicture')
    ->value('document_file'); // Get only the image blob

// Convert image blob to base64 for frontend display if available
if ($employeeImage) {
    $employee->image = 'data:image/jpeg;base64,' . base64_encode($employeeImage);
} else {
    $employee->image = null; // No image found
}

    if ($employee) {
        return response()->json($employee);
    } else {
        return response()->json(['error' => 'Employee not found'], 404);
    }
}

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public function downloadFile($employeeId)
{
    // Fetch the document record from the database
    $document = DB::table('employee_documents')
        ->where('employee_ID', $employeeId)
        ->first();

    // Check if the document exists
    if (!$document) {
        return redirect()->back()->withErrors(['Document not found']);
    }

    // Set file details
    $fileContent = $document->document_file; // Assuming this is binary content
    $fileName = $document->filename;

    // Create a temporary file with the content from the database
    $tempFile = tmpfile();
    fwrite($tempFile, $fileContent);
    $filePath = stream_get_meta_data($tempFile)['uri'];

    // Return the file as a downloadable stream
    return response()->download($filePath, $fileName, [
        'Content-Type' => 'application/octet-stream',  // Default MIME type
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ]);
}

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public function updateEmployee(Request $request, $employeeId)
{
    $fieldsToUpdate = $request->all();
    $updatedFieldsCount = 0;

    DB::beginTransaction();

    try {
        if (isset($fieldsToUpdate['first_name']) || isset($fieldsToUpdate['middle_name']) || isset($fieldsToUpdate['last_name']) || isset($fieldsToUpdate['suffix'])) {
            $updatedFieldsCount += DB::table('employee_information')
                ->where('employee_ID', $employeeId)
                ->update(array_filter([
                    'first_name' => $fieldsToUpdate['first_name'] ?? null,
                    'middle_name' => $fieldsToUpdate['middle_name'] ?? null,
                    'last_name' => $fieldsToUpdate['last_name'] ?? null,
                    'suffix' => $fieldsToUpdate['suffix'] ?? null,
                ]));
        }
        
        
        // Employee Contact Info
        if (isset($fieldsToUpdate['email']) || isset($fieldsToUpdate['contactnumber']) || isset($fieldsToUpdate['telnumber']) || isset($fieldsToUpdate['permanentAdd']) || isset($fieldsToUpdate['currentAdd'])) {
            $updatedFieldsCount += DB::table('employee_contactinfo')
                ->where('employee_ID', $employeeId)
                ->update(array_filter([
                    'email' => $fieldsToUpdate['email'] ?? null,
                    'contact_no' => $fieldsToUpdate['contactnumber'] ?? null,
                    'telephone_no' => $fieldsToUpdate['telnumber'] ?? null,
                    'permanent_address' => $fieldsToUpdate['permanentAdd'] ?? null,
                    'current_address' => $fieldsToUpdate['currentAdd'] ?? null,
                ]));
        }

        // Government IDs
        if (isset($fieldsToUpdate['sssnumber']) || isset($fieldsToUpdate['philhealthnumber']) || isset($fieldsToUpdate['pagibignumber']) || isset($fieldsToUpdate['TINnumber'])) {
            $updatedFieldsCount += DB::table('employee_governmentid')
                ->where('employee_ID', $employeeId)
                ->update(array_filter([
                    'sss' => $fieldsToUpdate['sssnumber'] ?? null,
                    'philhealth' => $fieldsToUpdate['philhealthnumber'] ?? null,
                    'pagibig' => $fieldsToUpdate['pagibignumber'] ?? null,
                    'tin' => $fieldsToUpdate['TINnumber'] ?? null,
                ]));
        }

        // Other updates...
        if (isset($fieldsToUpdate['birthdate']) || isset($fieldsToUpdate['birthplace']) || isset($fieldsToUpdate['civilStatus'])) {
            $updatedFieldsCount += DB::table('employee_otherinfo')
                ->where('employee_ID', $employeeId)
                ->update(array_filter([
                    'birth_date' => $fieldsToUpdate['birthdate'] ?? null,
                    'birth_place' => $fieldsToUpdate['birthplace'] ?? null,
                    'civil_status' => $fieldsToUpdate['civilStatus'] ?? null,
                ]));
        }

        if (isset($fieldsToUpdate['companyhistory']) || isset($fieldsToUpdate['position']) || isset($fieldsToUpdate['startjob']) || isset($fieldsToUpdate['endjob'])) {
            $updatedFieldsCount += DB::table('employee_workhistory')
                ->where('employee_ID', $employeeId)
                ->update(array_filter([
                    'company' => $fieldsToUpdate['companyhistory'] ?? null,
                    'start_date' => $fieldsToUpdate['startjob'] ?? null,
                    'end_date' => $fieldsToUpdate['endjob'] ?? null,
                    'remarks' => $fieldsToUpdate['position'] ?? null,
                ]));
        }

        if (isset($fieldsToUpdate['school']) && isset($fieldsToUpdate['attainment']) && isset($fieldsToUpdate['educationLevel'])) {
            $educationLevel = $fieldsToUpdate['educationLevel'];
            $school = $fieldsToUpdate['school'];
            $attainment = $fieldsToUpdate['attainment'];
        
           // Determine which column to update based on education level
            if (in_array($educationLevel, ['Senior High School', 'Old Curriculum', 'Grade School'])) {
                $columnToUpdate = 'highschool';
            } elseif (in_array($educationLevel, ['College', 'Undergraduate', 'Vocational'])) {
                $columnToUpdate = 'college';
            } else {
                // Handle unexpected education level
                throw new \Exception('Invalid education level provided: ' . $educationLevel);
            }
        
            // Format the remarks
            $remarks = $educationLevel . ' | ' . $attainment;
        
            // Update the database
            $updatedFieldsCount += DB::table('employee_education')
                ->where('employee_ID', $employeeId)
                ->update([
                    $columnToUpdate => $school,
                    'remarks' => $remarks,
                ]);
        }
        

        DB::commit();

        if ($updatedFieldsCount > 0) {
            return response()->json(['success' => true, 'message' => 'Changes complete']);
        } else {
            return response()->json(['success' => false, 'message' => 'No changes']);
        }
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => 'Error editing the changes', 'error' => $e->getMessage()], 500);
    }
}

    
}
