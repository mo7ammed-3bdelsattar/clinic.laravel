<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminMajorController;
use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;



Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('admin')->group( function () {
        Route::get('/home', AdminDashboardController::class)->name('dashboard');
        Route::get('profile', AdminProfileController::class)->name('profile');
        Route::get('logout', LogoutController::class)->name('auth.logout');
        Route::resource('doctors', AdminDoctorController::class);
        Route::resource('majors', AdminMajorController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('admins', AdminController::class);
    });
    Route::get('login', [AdminLoginController::class, 'index'])->name('auth.login.index');
    Route::post('login', [AdminLoginController::class, 'authenticate'])->name('auth.login');
});