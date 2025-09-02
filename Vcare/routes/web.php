<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MajorController;
use App\Http\Controllers\Site\DoctorController;
use App\Http\Controllers\Site\BookingController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\Auth\LoginController;
use App\Http\Controllers\Site\Auth\LogoutController;
use App\Http\Controllers\Site\Auth\RegisterController;
use App\Http\Controllers\Site\Auth\SocialiteController;

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

Route::get('/', HomeController::class)->name('home.index');
Route::get('majors', [MajorController::class, 'index'])->name('majors.index');
Route::get('majors/{major}', [MajorController::class, 'show'])->name('majors.show');
Route::get('doctors', [DoctorController::class,'index'])->name('doctors.index');
Route::get('doctors/{id}', [DoctorController::class,'show'])->name('doctors.show');
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::prefix('site')->middleware('auth')->group(function () {
    Route::get('booking/{doctor}', [BookingController::class, 'index'])->name('booking.index');
    Route::patch('booking/{doctor}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('appointments', [BookingController::class, 'appointments'])->name('booking.show');
    Route::post('booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::patch('profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('profile/destroy-image', [ProfileController::class, 'destroyImage'])->name('profile.destroyImage');
    Route::get('chats', [MessageController::class, 'index'])->name('chats.index');
    Route::get('chats/{receiver}', [MessageController::class, 'chatForm'])->name('chats.chatForm');
    Route::post('chats/{receiver}', [MessageController::class, 'send'])->name('chats.send');
    Route::get('logout', LogoutController::class)->name('auth.logout');
});
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search-suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('auth/{provider}', [SocialiteController::class, 'redirect']);
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback']);
Route::get('mail/booking', MailController::class)->name('mail.booking');
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'authenticate'])->name('auth.login');
Route::get('register', [RegisterController::class, 'index'])->name('register.index');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
require_once('admin.php');
require_once('doctor.php');
