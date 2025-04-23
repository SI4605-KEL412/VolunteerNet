<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\manageUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookmarkController;

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('manageUser',manageUserController::class);

Route::resource('/events', EventController::class);
Route::post('/events/{event}/bookmark', [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmark.index');