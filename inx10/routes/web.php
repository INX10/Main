    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Models\EmployeeDepartment;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LeaveController;

// Redirect root URL to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login and logout routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');

// Admin Route (Blade for Admin)
Route::get('/admin', function () {
    return view('admin'); // Make sure this is admin.blade.php
})->name('admin')->middleware('auth');

// Employee Route (Blade for Employee)
Route::get('/employee', function () {
    return view('employee'); // Make sure this is employee.blade.php
})->name('employee')->middleware('auth');

// Department Route (Blade for Department Heads)
Route::get('/department', function () {
    return view('department'); // Make sure this is department.blade.php
})->name('department')->middleware('auth');

// Dark mode update route
Route::post('/update-dark-mode', [LoginController::class, 'updateDarkMode']);

Route::get('/admin', [EmployeeController::class, 'admin'])->name('admin');

Route::get('/employee', [EmployeeController::class, 'employee'])->name('employee');

Route::get('/department', [EmployeeController::class, 'department'])->name('department');


// Route to get employee count
Route::get('/employee-count', [EmployeeController::class, 'getEmployeeCount']);

Route::post('/add-employee', [EmployeeController::class, 'insertEmployeeData'])->name('admin.InsertEmployeeData');

Route::get('/department-employee-counts', [EmployeeController::class, 'getDepartmentEmployeeCounts']);

Route::get('/department-employees/{id}', [EmployeeController::class, 'getEmployeesByDepartment']);

Route::get('/departments', [EmployeeController::class, 'getDepartments']);


Route::get('/create-employee', [EmployeeController::class, 'create'])->name('create.employee');


Route::get('/admin/get-announcements', [AnnouncementController::class, 'getAnnouncements'])
    ->middleware('web')
    ->name('admin.getAnnouncements');

Route::post('/admin/dashboard', [AnnouncementController::class, 'store'])
    ->middleware('web')
    ->name('admin.createAnnouncement');

    // Route for employees to view announcements on their dashboard
Route::get('/employee/get-announcements', [AnnouncementController::class, 'getAnnouncementsForEmployees'])
    ->middleware('auth') // or any other middleware to restrict access
    ->name('employee.dashboard');


Route::get('/announcements/all', [AnnouncementController::class, 'getAllAnnouncements'])->name('admin.getAllAnnouncements');

// Route for employees to get all announcements
Route::get('/employee/announcements/all', [AnnouncementController::class, 'getAllAnnouncements'])
    ->middleware('auth')
    ->name('employee.getAllAnnouncements');


Route::get('/profile', [EmployeeController::class, 'showProfile'])->name('profile');

Route::get('/admin/fetch-birthdays', [EmployeeController::class, 'fetchBirthdays']);

Route::get('/employee', [LeaveController::class, 'getLeaveTypes'])->name('employee')->middleware('auth');

Route::get('/employee/leave', [LeaveController::class, 'getLeaveTypes'])->name('employee.leave.form')->middleware('auth');

Route::post('/employee/leave/submit', [LeaveController::class, 'store'])->name('submitLeaveRequest');

Route::get('/department/leave-requests', [LeaveController::class, 'showLeaveRequests'])->name('department.leave.requests')->middleware('auth');

Route::get('/department/leave-requests/ajax', [LeaveController::class, 'getDepartmentLeaveRequests'])->name('department.leave.requests.ajax');

// Approve leave request
Route::post('/department/leave/approve', [LeaveController::class, 'approveLeave'])->name('leave.approve');

// Reject leave request
Route::post('/department/leave/reject', [LeaveController::class, 'rejectLeave'])->name('leave.reject');

// In routes/web.php
Route::get('/leave-requests', [LeaveController::class, 'getAllLeaveRequests'])->name('leave.requests');
