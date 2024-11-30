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

       

        // Return the view with leave types and leave balance
        return view('employee', [
            'leaveTypes' => $leaveTypes,
        ]);
    }

     /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getLeaveTypesForDepartment()
    {
        $leaveTypes = LeaveType::all(); // Fetch all leave types from the database
        return view('department', ['leaveTypes' => $leaveTypes]); // Pass to view
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
            'leave_from' => 'required|date|after_or_equal:today',
            'leave_to' => 'required|date|after_or_equal:leave_from',
            'reason' => 'required|max:255',
        ]);

        // Get the logged-in user's ID
        $userID = Auth::user()->user_ID;

        // Retrieve the employee_ID from employee_information table
        $employee = EmployeeInformation::where('user_ID', $userID)->firstOrFail();
        $employeeID = $employee->employee_ID;
        

        // Get today's date for 'date_applied'
        $dateApplied = Carbon::now();

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
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
    public function storeDepartmentHeadLeave(Request $request)
    {
        // Ensure the user is a department head
        if (Auth::user()->user_type !== 3) {
            return redirect()->back()->withErrors('Unauthorized access.');
        }

        // Validate form input
        $request->validate([
            'leave_type' => 'required',
            'leave_from' => 'required|date|after_or_equal:today',
            'leave_to' => 'required|date|after_or_equal:leave_from',
            'reason' => 'required|max:255',
        ]);

        // Get logged-in user's ID and corresponding employee ID
        $userID = Auth::user()->user_ID;
        $employee = EmployeeInformation::where('user_ID', $userID)->firstOrFail();
        $employeeID = $employee->employee_ID;

        // Set today's date for 'date_applied'
        $dateApplied = Carbon::now();

        // Retrieve HR's employee ID (assuming HR's user_type is 1)
        $hrUser = UserLogin::where('user_type', 1)->first();
        $hruserID = $hrUser ? EmployeeInformation::where('user_ID', $hrUser->user_ID)->first()->employee_ID : null;

        // Prepare data for insertion
        $leaveData = [
            'employee_ID' => $employeeID,
            'date_applied' => $dateApplied,
            'leave_from' => $request->input('leave_from'),
            'leave_to' => $request->input('leave_to'),
            'leave_type' => $request->input('leave_type') === 'other' ? $request->input('other-leave-type') : $request->input('leave_type'),
            'reason' => $request->input('reason'),
            'manager_approval' => 1, // Automatically approved for department heads
            'hr_ID' => $hruserID, // Store HR ID
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
        ->whereNull('manager_approval') 
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
            'manager_date_approved' => Carbon::now()->toDateString(),
            'hr_approval'=> 0
        ]);

    
        return response()->json(['message' => 'Leave request rejected successfully.']);
    }
    

    
     /**
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
        public function getAllLeaveRequests()
        {
        $userId = auth()->user()->user_ID; 

        $departmentId = EmployeeInformation::join('user_login', 'employee_information.user_ID', '=', 'user_login.user_ID')
            ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID')
            ->where('user_login.user_ID', $userId)
            ->value('employee_history.department_ID');

        $leaveRequests = EmployeeLeave::join('employee_information', 'employee_leave.employee_ID', '=', 'employee_information.employee_ID')
            ->leftJoin('leave_type', 'employee_leave.leave_type', '=', 'leave_type.leave_type')
            ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID')
            ->join('employee_department', 'employee_history.department_ID', '=', 'employee_department.department_ID')
            ->where('employee_history.department_ID', $departmentId) 
            ->select(
                'employee_leave.*', 
                'employee_information.first_name', 
                'employee_information.last_name', 
                'employee_information.employee_ID',
                'leave_type.value as leaveType',
                'employee_history.department_ID',
                'employee_department.department_name',
                'employee_leave.leave_type_other',
                'employee_leave.date_applied',
                'employee_leave.leave_ID'
            )
            ->orderByRaw('CASE 
                    WHEN employee_leave.manager_approval = 2 THEN 1 
                    WHEN employee_leave.manager_approval = 1 THEN 2 
                    WHEN employee_leave.manager_approval = 0 THEN 3 
                END')
            ->orderBy('employee_leave.date_applied', 'desc')
            ->get();

        
        foreach ($leaveRequests as $leaveRequest) {
            if (is_null($leaveRequest->hr_approval)) {
                $leaveRequest->full_status = 'Pending';
            } elseif ($leaveRequest->hr_approval == 1) {
                $leaveRequest->full_status = 'Approved';
            } elseif ($leaveRequest->hr_approval == 0) {
                $leaveRequest->full_status = 'Rejected';
            }
        }

        return response()->json($leaveRequests);
        }


        public function getAllLeaveRequestsForHR()
        {
            $leaveRequests = EmployeeLeave::join('employee_information', 'employee_leave.employee_ID', '=', 'employee_information.employee_ID')
                ->leftJoin('leave_type', 'employee_leave.leave_type', '=', 'leave_type.leave_type')
                ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID')
                ->join('employee_department', 'employee_history.department_ID', '=', 'employee_department.department_ID')
                ->select(
                    'employee_leave.*', 
                    'employee_information.first_name', 
                    'employee_information.last_name', 
                    'employee_information.employee_ID',
                    'leave_type.value as leaveType',
                    'employee_history.department_ID',
                    'employee_department.department_name',
                    'employee_leave.leave_type_other',
                    'employee_leave.date_applied',
                    'employee_leave.leave_ID'
                )
                ->whereNull('employee_leave.hr_approval') 
                ->orderByRaw('CASE 
                        WHEN employee_leave.manager_approval = 2 THEN 1 
                        WHEN employee_leave.manager_approval = 1 THEN 2 
                        WHEN employee_leave.manager_approval = 0 THEN 3 
                    END')
                ->orderBy('employee_leave.date_applied', 'desc')
                ->get();

            foreach ($leaveRequests as $leaveRequest) {
                if (is_null($leaveRequest->hr_approval)) {
                    $leaveRequest->full_status = 'Pending';
                } elseif ($leaveRequest->hr_approval == 1) {
                    $leaveRequest->full_status = 'Approved';
                } elseif ($leaveRequest->hr_approval == 0) {
                    $leaveRequest->full_status = 'Rejected';
                }
            }

            return response()->json($leaveRequests);
        }

        public function getAllLeaveRequestsHistory()
            {
                $leaveRequests = EmployeeLeave::join('employee_information', 'employee_leave.employee_ID', '=', 'employee_information.employee_ID')
                    ->leftJoin('leave_type', 'employee_leave.leave_type', '=', 'leave_type.leave_type')
                    ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID')
                    ->join('employee_department', 'employee_history.department_ID', '=', 'employee_department.department_ID')
                    ->select(
                        'employee_leave.*', 
                        'employee_information.first_name', 
                        'employee_information.last_name', 
                        'employee_information.employee_ID',
                        'leave_type.value as leaveType',
                        'employee_history.department_ID',
                        'employee_department.department_name',
                        'employee_leave.leave_type_other',
                        'employee_leave.date_applied',
                        'employee_leave.leave_ID'
                    )
                    ->orderBy('employee_leave.date_applied', 'desc')
                    ->get();

                // Map through the results to determine the full status
                foreach ($leaveRequests as $leaveRequest) {
                    if (is_null($leaveRequest->hr_approval)) {
                        $leaveRequest->full_status = 'Pending';
                    } elseif ($leaveRequest->hr_approval == 1) {
                        $leaveRequest->full_status = 'Approved';
                    } elseif ($leaveRequest->hr_approval == 0) {
                        $leaveRequest->full_status = 'Rejected';
                    }
                }

                return response()->json($leaveRequests);
            }



            /**
         * @SuppressWarnings(PHPMD.StaticAccess)
         * @SuppressWarnings(PHPMD.ElseExpression)
         */
        public function approveLeaveRequest($leaveid)
        {
            try {
                $leaveRequest = EmployeeLeave::findOrFail($leaveid);
                
                // Update HR approval status and date
                $leaveRequest->hr_approval = 1; // 1 for Approved
                $leaveRequest->hr_date_approved = Carbon::now()->toDateString(); // Current date
                
                // Save the changes to the database
                $leaveRequest->save();

                return response()->json(['message' => 'Leave request approved successfully.']);
            } catch (\Exception $e) {
            Log::error("Error approving leave request: " . $e->getMessage());
                return response()->json(['error' => 'An error occurred while approving the request.'], 500);
            }
        }
            /**
         * @SuppressWarnings(PHPMD.StaticAccess)
         * @SuppressWarnings(PHPMD.ElseExpression)
         */
        public function rejectLeaveRequest($leaveid)
        {
            try {
                $leaveRequest = EmployeeLeave::findOrFail($leaveid);
                
                // Update HR rejection status and date
                $leaveRequest->hr_approval = 0; // 0 for Rejected
                $leaveRequest->hr_date_approved = Carbon::now()->toDateString(); // Current date
                
                // Save the changes to the database
                $leaveRequest->save();

                return response()->json(['message' => 'Leave request rejected successfully.']);
            } catch (\Exception $e) {
                Log::error("Error rejecting leave request: " . $e->getMessage());
                return response()->json(['error' => 'An error occurred while rejecting the request.'], 500);
            }
        }


        public function getEmployeeLeaveRequests()
        {
            // Get the currently authenticated employee's user ID
            $userID = Auth::user()->user_ID;

            // Find the employee's employee_ID using the user_ID from the employee_information table
            $employee = EmployeeInformation::where('user_ID', $userID)->first();
            
            // Ensure the employee exists
            if (!$employee) {
                return response()->json(['error' => 'Employee not found'], 404);
            }

            $employeeID = $employee->employee_ID;

            // Fetch leave requests for the employee, including leave type name
            $leaveRequests = EmployeeLeave::where('employee_ID', $employeeID)
            ->leftJoin('leave_type', 'employee_leave.leave_type', '=', 'leave_type.leave_type') // Join leave_type table
            ->orderBy('date_applied', 'desc') // Order by the date applied
            ->select('employee_leave.*', 'leave_type.value as value') // Select the necessary columns
            ->get();

            // Return the leave requests as JSON
            return response()->json($leaveRequests);
        }

        /**
                 * @SuppressWarnings(PHPMD.StaticAccess)
                 * @SuppressWarnings(PHPMD.ElseExpression)
                 */
        public function getLeaveReason($leaveId)
        {
            $leaveRequest = EmployeeLeave::find($leaveId);

            if (!$leaveRequest) {
                return response()->json(['error' => 'Leave request not found'], 404);
            }

            return response()->json(['reason' => $leaveRequest->reason]); // Adjust to your column name
        }

        public function getPendingLeaveRequestsCount()
        {
            // Kunin ang bilang ng mga leave requests na walang laman sa hr_approval column
            $pendingRequests = DB::table('employee_leave')
                                ->whereNull('hr_approval')  // Kung NULL ang hr_approval
                                ->count();
        
            return response()->json(['pendingRequests' => $pendingRequests]);  // Ibabalik sa JSON format
        }


}
