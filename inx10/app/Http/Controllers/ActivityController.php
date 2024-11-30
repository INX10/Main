<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; // To handle dates
use App\Models\EmployeeHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\Authenticate;
use App\Models\EmployeeInformation;
use App\Models\EmployeeEvaluation;
use App\Models\LeaveType;
use App\Models\EmployeeLeave;
use Illuminate\Support\Facades\DB;


class ActivityController extends Controller
{
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
    public function getLatestActivity()
    {
        // Retrieve leave requests
        $leaveRequests = DB::table('employee_leave')
            ->join('employee_information', 'employee_leave.employee_ID', '=', 'employee_information.employee_ID')
            ->select(
                DB::raw('"Leave Request" as type'),
                'employee_information.first_name',
                'employee_information.last_name',
                'employee_leave.date_applied as date'
            );

        // Retrieve evaluations
        $evaluations = DB::table('employee_evaluation')
            ->join('employee_information', 'employee_evaluation.rater_ID', '=', 'employee_information.employee_ID')
            ->select(
                DB::raw('"Evaluation" as type'),
                'employee_information.first_name',
                'employee_information.last_name',
                'employee_evaluation.date_evaluated as date'
            );

        // Retrieve employee history
        $employeeHistory = DB::table('employee_history')
            ->join('employee_information', 'employee_history.employee_ID', '=', 'employee_information.employee_ID')
            ->select(
                DB::raw('"Employee Record" as type'),
                'employee_information.first_name',
                'employee_information.last_name',
                'employee_history.created_at as date'
            );

        // Union the three queries, order by date in descending order, and limit to the latest 3 entries
        $activities = $leaveRequests->unionAll($evaluations)->unionAll($employeeHistory)
            ->orderByDesc('date')
            ->limit(3)
            ->get();

        return response()->json($activities);
    }


}
