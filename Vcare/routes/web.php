<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MajorController;
use App\Http\Controllers\Site\DoctorController;
use App\Http\Controllers\Site\BookingController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\Auth\LoginController;
use App\Http\Controllers\Site\Auth\LogoutController;
use App\Http\Controllers\Site\Auth\RegisterController;




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

Route::prefix('site')->group(function () {
    Route::get('/home', HomeController::class)->name('home.index');
    Route::get('majors', MajorController::class)->name('majors.index');
    Route::get('doctors', DoctorController::class)->name('doctors.index');
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::post('login', [LoginController::class, 'authenticate'])->name('auth.login');
    Route::get('register', [RegisterController::class, 'index'])->name('register.index');
    Route::middleware('auth')->get('logout', LogoutController::class)->name('auth.logout');

});
Route::get('mail/booking', MailController::class)->name('mail.booking');
require_once('admin.php');
