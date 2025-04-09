<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;



Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('admin')->group( function () {
        Route::get('/home', DashboardController::class)->name('dashboard');
        Route::get('profile', ProfileController::class)->name('profile');
        Route::resource('doctors', DoctorController::class);
        Route::resource('majors', MajorController::class);
        Route::resource('users', UserController::class);
        Route::resource('admins', AdminController::class);
    });
    Route::get('login', [LoginController::class, 'index'])->name('auth.login.index');
    Route::post('login', [LoginController::class, 'authenticate'])->name('auth.login');
});
