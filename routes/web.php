<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\manageUserController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\RecruitmentController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth - Register
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Auth - Login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Public - Activities
Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');

// Route yang butuh login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('dashboard/user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('dashboard/eo', [DashboardController::class, 'eoDashboard'])->name('dashboardEO');
    Route::get('dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Notifikasi User
    Route::prefix('user/notifications')->name('user.notifications.')->group(function () {
        Route::get('/', [UserNotificationController::class, 'index'])->name('index');
        Route::post('{id}/read', [UserNotificationController::class, 'markAsRead'])->name('read');
        Route::post('read-all', [UserNotificationController::class, 'markAllAsRead'])->name('read.all');
    });

    // Notifikasi Admin
    Route::prefix('admin/notifications')->name('admin.notifications.')->group(function () {
        Route::get('/', [AdminNotificationController::class, 'index'])->name('index');
        Route::get('create', [AdminNotificationController::class, 'create'])->name('create');
        Route::post('/', [AdminNotificationController::class, 'store'])->name('store');
        Route::get('bulk', [AdminNotificationController::class, 'bulkCreate'])->name('bulk');
        Route::post('bulk', [AdminNotificationController::class, 'bulkStore'])->name('bulk.store');
        Route::get('list', [AdminNotificationController::class, 'index'])->name('list');
    });

    // Event
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('create', [EventController::class, 'create'])->name('create');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('{id}', [EventController::class, 'show'])->name('show');
        Route::get('{id}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('{id}', [EventController::class, 'update'])->name('update');
        Route::delete('{id}', [EventController::class, 'destroy'])->name('destroy');
    });

    // Manage Users (Admin)
    Route::prefix('manageusers')->name('manageusers.')->group(function () {
        Route::get('/', [manageUserController::class, 'index'])->name('index');
        Route::get('{id}', [manageUserController::class, 'show'])->name('show');
        Route::get('{id}/edit', [manageUserController::class, 'edit'])->name('edit');
        Route::put('{id}', [manageUserController::class, 'update'])->name('update');
        Route::delete('{id}', [manageUserController::class, 'destroy'])->name('destroy');
    });

    // Portfolio (User)
    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('index');
        Route::get('create', [PortfolioController::class, 'create'])->name('create');
        Route::post('/', [PortfolioController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PortfolioController::class, 'edit'])->name('edit');
        Route::put('{id}', [PortfolioController::class, 'update'])->name('update');
        Route::delete('{id}', [PortfolioController::class, 'destroy'])->name('destroy');
    });

    // Feedback (User)
    Route::prefix('feedback')->name('feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::get('create', [FeedbackController::class, 'create'])->name('create');
        Route::post('/', [FeedbackController::class, 'store'])->name('store');
        Route::get('{id}', [FeedbackController::class, 'show'])->name('show');
        Route::get('{id}/edit', [FeedbackController::class, 'edit'])->name('edit');
        Route::put('{id}', [FeedbackController::class, 'update'])->name('update');
        Route::delete('{id}', [FeedbackController::class, 'destroy'])->name('destroy');
    });

    // // Recruitment EO - Untuk Admin
    // Route::prefix('admin/recruitments')->name('admin.recruitment.')->group(function () {
    //     Route::get('/', [RecruitmentController::class, 'index'])->name('index');
    //     Route::get('{id}', [RecruitmentController::class, 'show'])->name('show');
    //     Route::get('{id}/edit', [RecruitmentController::class, 'edit'])->name('edit');
    //     Route::put('{id}', [RecruitmentController::class, 'update'])->name('update');
    });

    // EO Recruitment
    Route::prefix('eo/recruitment')->name('eo.recruitment.')->group(function () {
        Route::get('/', [RecruitmentController::class, 'index'])->name('index');
        Route::get('/create', [RecruitmentController::class, 'create'])->name('create');
        Route::post('/', [RecruitmentController::class, 'store'])->name('store');
        Route::get('/{recruitment}/edit', [RecruitmentController::class, 'edit'])->name('edit');
        Route::put('/{recruitment}', [RecruitmentController::class, 'update'])->name('update');
        Route::delete('/{recruitment}', [RecruitmentController::class, 'destroy'])->name('destroy');
        Route::get('/{recruitment}', [RecruitmentController::class, 'show'])->name('show');
    });


    // Referral
    Route::prefix('referral')->name('referral.')->group(function () {
        Route::get('/', [ReferralController::class, 'index'])->name('index');
        Route::post('generate', [ReferralController::class, 'generate'])->name('generate');
        Route::post('store', [ReferralController::class, 'storeReferral'])->name('store');
    });