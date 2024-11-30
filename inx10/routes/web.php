<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Models\EmployeeDepartment;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EditEmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Middleware\RestrictDepartmentAccess;
use App\Http\Middleware\RestrictEmployeeAccess;
use App\Http\Middleware\RestrictAdminAccess;
use App\Models\UserLogin;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login page (if not authenticated)
Route::get('/login', function () {
    if (auth()->check()) {
        $userType = session('user_type');

        switch ($userType) {
            case 1: // Admin
                return redirect()->route('admin');
            case 2: // Employee
                return redirect()->route('employee');
            case 3: // Department
                return redirect()->route('department');
            default:
                return redirect()->route('login')->withErrors('Invalid user type.');
        }
    }

    return view('auth.login');
})->name('login');


// Handle login using middleware instead of controller
Route::post('/login', function (Request $request) {
    $credentials = $request->only('user_ID', 'password');
    $user = UserLogin::where('user_ID', $credentials['user_ID'])->first();

    if ($user && $user->user_password === $credentials['password']) {
        auth()->login($user);

        session(['user_type' => $user->user_type]);

        // Redirect based on user role
        switch ($user->user_type) {
            case 1: // Admin
                return redirect()->route('admin');
            case 2: // Employee
                return redirect()->route('employee');
            case 3: // Department
                return redirect()->route('department');
            default:
                return redirect()->route('login')->withErrors('Invalid user type.');
        }
    }

    return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
})->name('login.submit');


Route::post('/logout', function () {
    auth()->logout();
    session()->flush();
    return redirect('/login');
})->name('logout');


Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/get-announcements', [AnnouncementController::class, 'getAnnouncements'])->name('admin.getAnnouncements');
    Route::post('/admin/dashboard', [AnnouncementController::class, 'store'])->name('admin.createAnnouncement');
    Route::post('/admin/submit-evaluation', [PerformanceController::class, 'storeAdminEvaluation'])->name('admin.submit.evaluation');
    Route::get('/admin', [PerformanceController::class, 'showAdmin'])->name('admin')->middleware('auth');
    Route::get('/admin/birthday-overview', [EmployeeController::class, 'getBirthdayOverview']);
    Route::get('/admin/get-latest-activity', [ActivityController::class, 'getLatestActivity']);
    Route::get('/admin/employee-overview', [EmployeeController::class, 'getAdminEmployeeOverview']);
    Route::get('/admin/employee-management-overview', [EmployeeController::class, 'displayEmployeeManagementOverview'])->name('admin.employeeManagementOverview');
    Route::get('/admin/edit-employee/departments', [EditEmployeeController::class, 'getDepartmentsEditEmployee'])->name('admin.editEmployee.departments');
    Route::get('/admin/edit-employee/{departmentId}/employees', [EditEmployeeController::class, 'editEmployeeGetEmployeesByDepartment']);
    Route::get('/admin/edit-employee/details/{employeeId}', [EditEmployeeController::class, 'getEmployeeDetails']);
    Route::get('/admin/download-file/{employeeId}', [EditEmployeeController::class, 'downloadFile']);
    Route::post('/admin/update-employee/{employeeId}', [EditEmployeeController::class, 'updateEmployee']);

    
});


Route::middleware(['auth', 'role.employee'])->group(function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::get('/employee/birthday-overview', [EmployeeController::class, 'getBirthdayOverview']);
    Route::get('/employee/get-announcements', [AnnouncementController::class, 'getAnnouncementsForEmployees'])->name('employee.dashboard');
    Route::get('/employee/announcements/all', [AnnouncementController::class, 'getAllAnnouncements'])->name('employee.getAllAnnouncements');
    Route::get('/employee', [LeaveController::class, 'getLeaveTypes'])->name('employee');
    Route::get('/employee/leave', [LeaveController::class, 'getLeaveTypes'])->name('employee.leave.form');
    Route::post('/employee/leave/submit', [LeaveController::class, 'store'])->name('submitLeaveRequest');
    Route::get('/employee/leave-requests', [LeaveController::class, 'getEmployeeLeaveRequests'])->name('employee.leaveRequests');
    Route::get('/employee/leave-reason/{leaveId}', [LeaveController::class, 'getLeaveReason']);
    

});


Route::middleware(['auth', 'role.department'])->group(function () {
    Route::get('/department/birthday-overview', [EmployeeController::class, 'getBirthdayOverview']);
    Route::get('/department', [DepartmentController::class, 'index'])->name('department');
    Route::get('/department', [LeaveController::class, 'getLeaveTypesForDepartment'])->name('department');
    Route::get('/department/leave-requests', [LeaveController::class, 'showLeaveRequests'])->name('department.leave.requests');
    Route::get('/department/announcements/all', [AnnouncementController::class, 'getAllAnnouncements'])->name('department.getAllAnnouncements');
    Route::get('/department/get-announcements', [AnnouncementController::class, 'getAnnouncementsForEmployees'])->name('department.dashboard');
    Route::get('/department/leave-requests/ajax', [LeaveController::class, 'getDepartmentLeaveRequests'])->name('department.leave.requests.ajax');
    Route::post('/department/leave/approve', [LeaveController::class, 'approveLeave'])->name('leave.approve');
    Route::post('/department/leave/reject', [LeaveController::class, 'rejectLeave'])->name('leave.reject');
    Route::get('/department/leave-requests', [LeaveController::class, 'getAllLeaveRequests'])->name('department.leaveRequests');
    Route::post('/department/leave/submit', [LeaveController::class, 'storeDepartmentHeadLeave'])->name('departmentLeaveRequest');
    Route::get('/department/recommended-actions', [PerformanceController::class, 'showActionDepartment'])->name('department.recommendedActions');
    Route::post('/department/submit-evaluation', [PerformanceController::class, 'storeDepartmentEvaluation'])->name('department.submit.evaluation');


});
Route::post('/update-dark-mode', [LoginController::class, 'updateDarkMode']);

Route::get('/employee-count', [EmployeeController::class, 'getEmployeeCount']);

Route::post('/add-employee', [EmployeeController::class, 'insertEmployeeData'])->name('admin.InsertEmployeeData');

Route::get('/department-employee-counts', [EmployeeController::class, 'getDepartmentEmployeeCounts']);

Route::get('/department-employees/{id}', [EmployeeController::class, 'getEmployeesByDepartment']);

Route::get('/departments', [EmployeeController::class, 'getDepartments']);

Route::get('/create-employee', [EmployeeController::class, 'create'])->name('create.employee');

Route::get('/announcements/all', [AnnouncementController::class, 'getAllAnnouncements'])->name('admin.getAllAnnouncements');

Route::get('/profile', [EmployeeController::class, 'showProfile'])->name('profile');

Route::get('/leave-requests', [LeaveController::class, 'getAllLeaveRequestsForHR'])->name('leave.requests');

Route::post('/leave-request/approve/{leaveid}', [LeaveController::class, 'approveLeaveRequest'])->name('leave.approve');

Route::post('/leave-request/reject/{leaveid}', [LeaveController::class, 'rejectLeaveRequest'])->name('leave.reject');

Route::get('/leave-requests/history', [LeaveController::class, 'getAllLeaveRequestsHistory'])->name('leave.requests.history');

Route::get('/fetch-departments', [PerformanceController::class, 'showAllDepartmentPage'])->name('fetchDepartments');

Route::get('/employees/{departmentId}', [PerformanceController::class, 'getEmployeesByDepartmentForPerformanceEval']);

Route::get('/evaluations', [PerformanceController::class, 'getAllEvaluations'])->name('getAllEvaluations');

Route::get('/latest-evaluations', [PerformanceController::class, 'getLatestEvaluations'])->name('getLatestEvaluations');

Route::get('/api/pending-leave-requests', [LeaveController::class, 'getPendingLeaveRequestsCount']);

Route::get('/get-departments', [AccessController::class, 'getDepartmentsforAccess']);

Route::get('/get-employees-by-department/{departmentID}', [AccessController::class, 'getEmployeebyDepartmentForAccess']);

Route::post('/store-user-access', [AccessController::class, 'storeUserAccess'])->name('access.store');

Route::post('/update-employee-status', [EmployeeController::class, 'updateEmployeeStatus'])->name('updateEmployeeStatus');

Route::get('/performance-evaluation', [PerformanceController::class, 'getEmployeePerformanceEval']);

Route::get('/evaluationsDept', [PerformanceController::class, 'getAllPerformanceEvalEmployee']);

Route::get('/evaluationsAllDept', [PerformanceController::class, 'getAllEvaluationFormDepartment']);

Route::get('/getSameDepartmentEmployees', [EmployeeController::class, 'getSameDepartmentEmployees']);

//Excell 
Route::post('/attendance/import', [AttendanceController::class, 'import'])->name('attendance.import');
Route::get('/admin/attendance', [AttendanceController::class, 'showAttendance'])->name('admin.attendance');
Route::get('/admin/attendance-data', [AttendanceController::class, 'fetchAttendanceData']);

Route::get('/employee/attendance', [AttendanceController::class, 'showEmployeeAttendance']);
Route::get('/supervisor/attendance', [AttendanceController::class, 'showEmployeeAttendance']);

