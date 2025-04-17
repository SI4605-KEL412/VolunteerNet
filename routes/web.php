<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;

// Halaman utama diarahkan ke index feedback
Route::get('/', [FeedbackController::class, 'create'])->name('create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Resource untuk feedback (CRUD)
Route::resource('feedback', FeedbackController::class);
// Route untuk autentikasi (login, register, logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);