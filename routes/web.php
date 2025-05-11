<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\manageUserController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Registrasi
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Hanya bisa diakses jika sudah login
Route::middleware('auth')->group(function () {

    // Dashboard untuk User (Volunteer)
    Route::get('dashboard/user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    // Dashboard untuk Admin
    Route::get('dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Dashboard untuk Event Organizer (EO)
    Route::get('dashboard/eo', [DashboardController::class, 'eoDashboard'])->name('dashboardEO');

    // Halaman Event
    Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create'); // Halaman buat event
    Route::post('events', [EventController::class, 'store'])->name('events.store'); // Proses penyimpanan event
    Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit'); // Halaman edit event
    Route::put('events/{id}', [EventController::class, 'update'])->name('events.update'); // Proses update event
    Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy'); // Hapus event


    //Manage User
    Route::get('manageusers', [manageUserController::class, 'index'])->name('manageusers.index'); // Daftar semua user
    Route::get('manageusers/{id}', [manageUserController::class, 'show'])->name('manageusers.show'); // Lihat detail user
    Route::get('manageusers/{id}/edit', [manageUserController::class, 'edit'])->name('manageusers.edit'); // Halaman edit user
    Route::put('manageusers/{id}', [manageUserController::class, 'update'])->name('manageusers.update'); // Proses update user
    Route::delete('manageusers/{id}', [manageUserController::class, 'destroy'])->name('manageusers.destroy'); // Hapus user
});
