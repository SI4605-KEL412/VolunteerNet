<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\manageUserController;
use App\Http\Controllers\EventController;
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< Updated upstream
=======
Route::resource('manageUser',manageUserController::class);

Route::resource('/events', EventController::class);
>>>>>>> Stashed changes
