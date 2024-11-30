<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAttendance;
use App\Models\EmployeeInformation;
use Illuminate\Http\Request;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function showAttendance()
    {
        return view('admin'); // This will load the admin.blade.php
    }
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
    
    public function fetchAttendanceData()
    {
        try {
            $attendanceRecords = DB::table('employee_attendance')
                ->select(
                    'attendance_ID',
                    'employee_name',
                    'date',
                    DB::raw("CASE WHEN time_in = '00:00:00' THEN 'No Record' ELSE time_in END AS time_in"),
                    DB::raw("CASE WHEN time_out = '00:00:00' THEN 'No Record' ELSE time_out END AS time_out")
                )
                ->whereNotNull('date') // Exclude records where date is NULL
                ->whereRaw("NOT (time_in = '00:00:00' AND time_out = '00:00:00')")
                ->orderBy('date', 'desc')
                ->get();

            // Log the records fetched for debugging
            Log::info('Attendance records fetched successfully', ['records' => $attendanceRecords]);

            return response()->json($attendanceRecords);
        } catch (\Exception $e) {
            // Log any errors that occur
            Log::error('Error fetching attendance records: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }

    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv',
        ]);
    
        try {
            $file = $request->file('file');
            Log::info('Import started', ['file' => $file->getClientOriginalName()]);
    
            Excel::import(new EmployeeImport, $file);
    
            Log::info('Import completed successfully');
            return back()->with('success', 'Attendance data has been successfully imported.');
        } catch (\Exception $e) {
            Log::error('Error during import:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Failed to import attendance data: ' . $e->getMessage()]);
        }
    }

    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 * @SuppressWarnings(PHPMD.CamelCaseVariableName)
 */
    public function showEmployeeAttendance()
    {
        $userID = Auth::user()->user_ID;
	$employee = EmployeeInformation::where(column: 'user_ID', operator: $userID)->firstOrFail();
	$first_name = $employee->first_name;
	$last_name = $employee->last_name;
	$name = $last_name . ', ' . $first_name;

    try {
        // Fetch attendance records filtered by employee name
        $attendanceRecords = DB::table('employee_attendance')
            ->select(
                'attendance_ID',
                'employee_name',
                'date',
                DB::raw("CASE WHEN time_in = '00:00:00' THEN 'No Record' ELSE time_in END AS time_in"),
                DB::raw("CASE WHEN time_out = '00:00:00' THEN 'No Record' ELSE time_out END AS time_out")
            )
            ->whereNotNull('date') // Exclude records where date is NULL
            ->whereRaw("NOT (time_in = '00:00:00' AND time_out = '00:00:00')") // Exclude records where time_in and time_out are both 00:00:00
            ->where('employee_name', $name) // Filter by employee_name
            ->orderBy('date', 'desc')
            ->get();

        // Log the records fetched for debugging
        Log::info('Attendance records fetched successfully', ['records' => $attendanceRecords]);

        return response()->json($attendanceRecords);
    } catch (\Exception $e) {
        // Log any errors that occur
        Log::error('Error fetching attendance records: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to fetch data'], 500);
    }
    }

}
