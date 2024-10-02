    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Models\EmployeeDepartment;
use App\Http\Controllers\AnnouncementController;

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

// Dark mode update route
Route::post('/update-dark-mode', [LoginController::class, 'updateDarkMode']);

// Admin route - Handled by EmployeeController
Route::get('/admin', [EmployeeController::class, 'create'])->name('admin'); // Name the route

Route::get('/employee', [EmployeeController::class, 'employee'])->name('employee');
// Route to get employee count
Route::get('/employee-count', [EmployeeController::class, 'getEmployeeCount']);

Route::post('/add-employee', [EmployeeController::class, 'insertEmployeeData'])->name('admin.InsertEmployeeData');

Route::get('/department-employee-counts', [EmployeeController::class, 'getDepartmentEmployeeCounts']);

Route::get('/admin/get-announcements', [AnnouncementController::class, 'getAnnouncements'])
    ->middleware('web')
    ->name('admin.getAnnouncements');

Route::post('/admin/dashboard', [AnnouncementController::class, 'store'])
    ->middleware('web')
    ->name('admin.createAnnouncement');

Route::get('/announcements/all', [AnnouncementController::class, 'getAllAnnouncements'])->name('admin.getAllAnnouncements');

Route::get('/profile', [EmployeeController::class, 'showProfile'])->name('profile');







