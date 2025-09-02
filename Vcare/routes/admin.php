<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\AddRoleController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AppointmentController;



Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/home', DashboardController::class)->name('dashboard');
    Route::get('profile', ProfileController::class)->name('profile');
    Route::resource('doctors', DoctorController::class);
    Route::get('/appointments/{id}', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{id}/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::patch('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    // Route::resource('appointments', AppointmentController::class);
    Route::resource('bookings', BookingController::class);
    Route::get('/doctor/{id}/appointments', [BookingController::class, 'getDoctorAppointments']);
    Route::resource('banners', BannerController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('patients', PatientController::class);
    Route::get('chats', [MessageController::class, 'index'])->name('chats.index');
    Route::get('chats/{receiver}', [MessageController::class, 'chatForm'])->name('chats.chatForm');
    Route::post('chats/{receiver}', [MessageController::class, 'send'])->name('chats.send');
    Route::get('chats/messages/{id}', [MessageController::class, 'messages'])->name('chats.messages');
    Route::get('add-role/{id}', [AddRoleController::class, 'addRole'])->name('users.addRole');
    Route::post('add-role/{id}', [AddRoleController::class, 'assignRole'])->name('users.assignRole');
});
