<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\FeedbackController;

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

// Rute yang hanya bisa diakses jika sudah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('dashboard/user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('dashboard/eo', [DashboardController::class, 'eoDashboard'])->name('dashboardEO');

    // Event
    Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // Manage Users
    Route::get('manageusers', [ManageUserController::class, 'index'])->name('manageusers.index');
    Route::get('manageusers/{id}', [ManageUserController::class, 'show'])->name('manageusers.show');
    Route::get('manageusers/{id}/edit', [ManageUserController::class, 'edit'])->name('manageusers.edit');
    Route::put('manageusers/{id}', [ManageUserController::class, 'update'])->name('manageusers.update');
    Route::delete('manageusers/{id}', [ManageUserController::class, 'destroy'])->name('manageusers.destroy');

    // Feedback
    Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback.index');

    // Menampilkan form create feedback dengan list event
    Route::get('feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');

    Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
    Route::get('feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::put('feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

});