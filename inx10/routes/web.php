<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');

Route::post('/update-dark-mode', [LoginController::class, 'updateDarkMode']);


Route::get('/admin', function () {
    return view('admin'); // Ensure this matches your view file
})->name('admin');

