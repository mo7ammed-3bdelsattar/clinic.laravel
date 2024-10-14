<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMajorController;
use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MajorController;
use App\Http\Controllers\Site\DoctorController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\Site\RegisterController;
use App\Http\Controllers\Site\BookingController;
use App\Http\Controllers\Site\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',HomeController::class)->name('home.index');
Route::get('majors',MajorController::class)->name('majors.index');
Route::get('doctors',DoctorController::class)->name('doctors.index');
Route::get('contact',[ContactController::class,'index'])->name('contact.index');
Route::get('login',[LoginController::class,'index'])->name('login.index');
Route::get('register',[RegisterController::class,'index'])->name('register.index');
Route::get('booking',[BookingController::class,'index'])->name('booking.index');
Route::prefix('admin')->as('admin.')->group(function(){
    Route::get('/home',AdminDashboardController::class)->name('dashboard');
    Route::get('profile',AdminProfileController::class)->name('profile');
    Route::resource('doctors',AdminDoctorController::class);
    Route::resource('majors',AdminMajorController::class);
    Route::resource('users',AdminUserController::class);
});