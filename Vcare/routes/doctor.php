<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\BookingController;
use App\Http\Controllers\Doctor\ProfileController;
use App\Http\Controllers\Doctor\DashboardController;



Route::middleware('doctor')->prefix('doctor/')->as('doctor.')->group(function(){
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::get('profile', ProfileController::class)->name('profile');
    Route::get('bookings',[BookingController::class,'index'])->name('bookings');
    Route::get('bookings/{id}',[BookingController::class,'show'])->name('bookings.show');
    Route::patch('bookings/{id}',[BookingController::class,'update'])->name('bookings.update');
});