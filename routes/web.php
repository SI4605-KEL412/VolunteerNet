<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;

// Halaman utama diarahkan ke index feedback
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Route untuk feedback (CRUD)
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

// Route untuk halaman create feedback
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
Route::get('/feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::put('/feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

// // Route untuk autentikasi (login, register, logout)
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->npame('logout');
// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::
