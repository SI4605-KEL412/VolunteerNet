<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (umum, bisa diakses tanpa login)
Route::get('/', function () {
    return view('welcome');
});

// Group middleware untuk route yang butuh login + email terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/events', EventController::class);
    Route::post('/events/{event}/bookmark', [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmark.index');
});



require __DIR__.'/auth.php';
