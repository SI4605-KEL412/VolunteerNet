<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');