<?php

use App\Http\Controllers\Admin\AdminHomeController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('majors',[MajorController::class,'index'])->name('majors.index');
Route::get('home',[HomeController::class,'index'])->name('home.index');
Route::get('contact',[ContactController::class,'index'])->name('contact.index');
Route::get('doctors',[DoctorController::class,'index'])->name('doctors.index');
Route::get('login',[LoginController::class,'index'])->name('login.index');
Route::get('register',[RegisterController::class,'index'])->name('register.index');
Route::get('booking',[BookingController::class,'index'])->name('booking.index');
Route::prefix('admin')->group(function(){
    Route::get('home',[AdminHomeController::class,'index'])->name('admin.home.index');
    Route::get('profile',[AdminProfileController::class,'index'])->name('admin.profile.index');
    Route::get('majors',[AdminMajorController::class,'index'])->name('admin.majors.index');
    Route::get('doctors',[AdminDoctorController::class,'index'])->name('admin.doctors.index');
Route::get('users',[AdminUserController::class,'index'])->name('admin.users.index');
});