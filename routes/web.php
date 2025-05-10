<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\manageUserController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('manageUser',manageUserController::class);

Route::resource('/events', EventController::class);