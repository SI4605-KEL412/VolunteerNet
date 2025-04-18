<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\manageUserController;

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('manageUser',manageUserController::class);
