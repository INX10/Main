<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\LeaveType;
use App\Models\UserLogin;
use App\Models\LeaveBalance;
use App\Models\EmployeeHistory;
use App\Models\EmployeeLeave;
use App\Models\EmployeeInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveController extends Controller
{
      /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
    public function getLeaveTypes()
    {
       // Retrieve all leave types from the database
        $leaveTypes = LeaveType::all();
        
        // Assuming you want to get the current authenticated employee's ID
        $employeeId = auth()->user()->employee_ID;

        // Fetch leave balance for the employee
        $leaveBalance = LeaveBalance::where('employee_ID', $employeeId)->first();

        // Check if leave balance exists, otherwise create a new one with default values
        if (!$leaveBalance) {
            $leaveBalance = new LeaveBalance();
            $leaveBalance->balance = 0.00; // Default value if no record found
        }

        // Return the view with leave types and leave balance
        return view('employee', [
            'leaveTypes' => $leaveTypes,
            'leaveBalance' => $leaveBalance
        ]);
    }

      /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
    public function updateLeaveBalances()
    {
        // Fetch all leave balances
        $leaveBalances = LeaveBalance::all();
        
        // Update each leave balance
        foreach ($leaveBalances as $leaveBalance) {
            $leaveBalance->balance += 0.83; // Increment the balance
            $leaveBalance->save(); // Save the updated balance
        }

        return response()->json(['message' => 'Leave balances updated successfully.']);
    }

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
    public function create()
    {
        $leaveTypes = LeaveType::all(); // Fetch your leave types from the database
        return view('employee', compact('leaveTypes')); // Ensure this view exists
    }
     /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'leave_type' => 'required',
            'leave_from' => 'required|date|after_or_equal:today', // Ensure start date is today or in the future
            'leave_to' => 'required|date|after_or_equal:leave_from',
            'reason' => 'required|max:255',
        ]);

        // Get the logged-in user's ID
        $userID = Auth::user()->user_ID;

        // Retrieve the employee_ID from employee_information table
        $employee = EmployeeInformation::where('user_ID', $userID)->firstOrFail();
        $employeeID = $employee->employee_ID;

        // Get today's date for 'date_applied'
        $dateApplied = Carbon::now()->toDateString();

        // Get the department of the employee
        $employeeHistory = EmployeeHistory::where('employee_ID', $employeeID)->orderBy('start_date', 'desc')->first();
        $departmentID = $employeeHistory->department_ID;

        // Find the department head in the same department
        $manager = EmployeeHistory::join('employee_information', 'employee_history.employee_ID', '=', 'employee_information.employee_ID')
        ->join('user_login', 'employee_information.user_ID', '=', 'user_login.user_ID')
        ->where('employee_history.department_ID', $departmentID) // Get the specific department
        ->where('user_login.user_type', 3) // Ensure this corresponds to the department head
        ->select('employee_history.employee_ID') // Select only the employee_ID of the department head
        ->first();

        $managerID = $manager ? $manager->employee_ID : null; // Get manager's employee_ID if found

         // Retrieve HR information (user_type = 1)
    $hrUser = UserLogin::where('user_type', 1)->first();
    if ($hrUser) {
        // Get the HR employee ID
        $hruserID = EmployeeInformation::where('user_ID', $hrUser->user_ID)->first();
        $hruserID = $hruserID ? $hruserID->employee_ID : null;
    } else {
        $hruserID = null; // In case HR is not found
    }


        // Prepare the data for insertion
        $leaveData = [
            'employee_ID' => $employeeID,
            'date_applied' => $dateApplied,
            'leave_from' => $request->input('leave_from'),
            'leave_to' => $request->input('leave_to'),
            'leave_type' => $request->input('leave_type') === 'other' ? 0 : $request->input('leave_type'), // Default to 0 if 'Other' is selected
            'leave_type_other' => $request->input('leave_type') === 'other' ? $request->input('other-leave-type') : null,
            'reason' => $request->input('reason'),
            'manager_ID' => $managerID,
            'hr_ID' => $hruserID, // Store the HR ID here
        ];

        // Insert into the employee_leave table
        EmployeeLeave::create($leaveData);

        // Redirect with success message
        return back()->with('success', 'Leave request submitted successfully.');
    }


     /**
 * @SuppressWarnings(PHPMD.ElseExpression)
 */

    public function getDepartmentLeaveRequests()
    {
        $userID = Auth::user()->user_ID;
    
        // Find the employee's employee_ID
        $employee = EmployeeInformation::where('user_ID', $userID)->first();
        $employeeID = $employee->employee_ID;
    
        // Get the department the employee belongs to
        $departmentID = EmployeeHistory::where('employee_ID', $employeeID)
                        ->orderBy('start_date', 'desc')
                        ->first()
                        ->department_ID;
    
      
          // Fetch leave requests, ordered by date_applied in descending order
        $leaveRequests = EmployeeLeave::with('leaveType')  // Eager load LeaveType model
        ->join('employee_information', 'employee_leave.employee_ID', '=', 'employee_information.employee_ID')
        ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID')
        ->where('employee_history.department_ID', $departmentID)
        ->orderBy('employee_leave.date_applied', 'desc') // Order by date_applied
        ->select('employee_leave.*', 'employee_information.first_name', 'employee_information.last_name', 'employee_information.employee_ID')
        ->get();
    
        // Manipulate the data to use `leave_type_other` if `leave_type` is 0
        foreach ($leaveRequests as $leaveRequest) {
            if ($leaveRequest->leave_type == 0) {
                // If leave_type is 0, use leave_type_other
                $leaveRequest->leave_type_value = $leaveRequest->leave_type_other;
            } else {
                // If leave_type is not 0, use the value from the related LeaveType model
                $leaveRequest->leave_type_value = $leaveRequest->leaveType ? $leaveRequest->leaveType->value : 'N/A';
            }
        }
    
        return response()->json($leaveRequests);
    }
    
    public function approveLeave(Request $request)
    {
        // Get the leave ID from the request
        $leaveID = $request->input('leave_ID');
    
        // Update the employee_leave table to approve the leave
        EmployeeLeave::where('leave_ID', $leaveID)
             ->update([
                 'manager_approval' => 1, // Approve the leave
                 'manager_date_approved' => Carbon::now()->toDateString()
             ]);

    
        return response()->json(['message' => 'Leave request approved successfully.']);
    }
    
    public function rejectLeave(Request $request)
    {
        // Get the leave ID from the request
        $leaveID = $request->input('leave_ID');
    
        // Update the employee_leave table to reject the leave
        EmployeeLeave::where('leave_ID', $leaveID)
        ->update([
            'manager_approval' => 0, // Approve the leave
            'manager_date_approved' => Carbon::now()->toDateString()
        ]);

    
        return response()->json(['message' => 'Leave request rejected successfully.']);
    }
    

    
     /**
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public function getAllLeaveRequests()
{
    // Fetch all leave requests with employee information
    $leaveRequests = EmployeeLeave::join('employee_information', 'employee_leave.employee_ID', '=', 'employee_information.employee_ID')
    ->leftJoin('leave_type', 'employee_leave.leave_type', '=', 'leave_type.leave_type') // Use left join
    ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID') 
    ->join('employee_department', 'employee_history.department_ID', '=', 'employee_department.department_ID') // Join with employee_department
    ->select(
        'employee_leave.*', 
        'employee_information.first_name', 
        'employee_information.last_name', 
        'employee_information.employee_ID',
        'leave_type.value as leaveType', // Select the leave type name
        'employee_history.department_ID', // Keep department ID if needed
        'employee_department.department_name', // Select the department name
        'employee_leave.leave_type_other',
        'employee_leave.date_applied',
        'employee_leave.leave_ID'
    )
    ->orderByRaw('CASE 
            WHEN employee_leave.manager_approval = 2 THEN 1  -- Pending
            WHEN employee_leave.manager_approval = 1 THEN 2  -- Approved
            WHEN employee_leave.manager_approval = 0 THEN 3  -- Rejected
        END')
        ->orderBy('employee_leave.date_applied', 'desc') // Order by date_applied
        ->get();

    return response()->json($leaveRequests); // Return the leave requests as JSON
}



}
