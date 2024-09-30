<?php

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
Route::view('major','site.pages.major')->name('major.index');
Route::view('home','site.pages.home')->name('home.index');
Route::view('contact','site.pages.contact')->name('contact.index');
Route::view('doctor','site.pages.doctor')->name('doctor.index');
Route::view('login','site.pages.login')->name('login.index');
Route::view('register','site.pages.register')->name('register.index');
Route::view('booking','site.pages.booking')->name('booking.index');