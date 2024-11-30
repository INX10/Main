<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; // To handle dates
use App\Models\EmployeeHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\Authenticate;
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
use App\Models\UserLogin;

class AccessController extends Controller
{
    public function getDepartmentsforAccess()
    {
        $departments = EmployeeDepartment::select('department_ID', 'department_name')->get();
        return response()->json($departments);
    }
     /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

 public function getEmployeebyDepartmentForAccess($departmentID)
{
    // Retrieve employees from the employee_history table for the selected department
    $employeeHistory = EmployeeHistory::where('department_ID', $departmentID)
        ->where('status', 1) // assuming 1 means active employees
        ->get();

    // Retrieve employee details for each employee
    $employees = [];
    foreach ($employeeHistory as $history) {
        $employee = $history->employee;
        $employees[] = [
            'employee_ID' => $employee->employee_ID,
            'name' => $employee->first_name . ' ' . $employee->last_name, // Adjust as necessary
        ];
    }

    // Return employee data as JSON
    return response()->json($employees);
}

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function storeUserAccess(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'userIdAccess' => 'required|string|max:20',
            'userPWAccess' => 'required|string|max:50',
            'userTypeAccess' => 'required|in:1,2,3',
            'selectedEmployeeID' => 'required|exists:employee_information,employee_ID',
        ]);

        // Retrieve the form values
        $userIdAccess = $request->input('userIdAccess');
        $userPWAccess = $request->input('userPWAccess');
        $userTypeAccess = $request->input('userTypeAccess');
        $selectedEmployeeID = $request->input('selectedEmployeeID');

        // Step 1: Insert a new record into the user_login table
        $userLogin = new UserLogin();
        $userLogin->user_ID = $userIdAccess;
        $userLogin->user_password = $userPWAccess;
        $userLogin->user_type = $userTypeAccess;
        $userLogin->save();

        // Step 2: Update the employee_information table with the new user_ID
        $employee = EmployeeInformation::find($selectedEmployeeID);
        $employee->user_ID = $userIdAccess;
        $employee->save();

        return redirect()->back()->with('success', 'User access information successfully saved.');
    }
    
 
}
