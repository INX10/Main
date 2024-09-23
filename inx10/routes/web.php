    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmployeeController;

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

// Route to get employee count
Route::get('/employee-count', [EmployeeController::class, 'getEmployeeCount']);

Route::post('/admin', [EmployeeController::class, 'insertEmployeeData'])->name('admin.InsertEmployeeData');
