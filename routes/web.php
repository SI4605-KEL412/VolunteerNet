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
use App\Http\Controllers\VolunFeedsController;

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

    // Dashboard untuk User
    Route::get('dashboard/user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');


    // volufeeds
    Route::get('/volunfeeds', [App\Http\Controllers\VolunFeedsController::class, 'index'])->name('volunfeeds.index');

    // Like/unlike portfolio
    Route::post('/volunfeeds/{id}/like', [App\Http\Controllers\VolunFeedsController::class, 'toggleLike'])->name('volunfeeds.toggle-like');

    // My portfolios list
    Route::get('/volunfeeds/my-portfolios', [App\Http\Controllers\VolunFeedsController::class, 'myPortfolios'])->name('volunfeeds.my-portfolios');

    // View portfolio details
    Route::get('/volunfeeds/{id}', [App\Http\Controllers\VolunFeedsController::class, 'show'])->name('volunfeeds.show');

    // View user profile
    Route::get('user/profile/{userId}', [VolunFeedsController::class, 'showProfile'])->name('user.profile');

    // Add new route for volunfeeds.profile
    Route::get('/volunfeeds/profile/{userId}', [VolunFeedsController::class, 'showProfile'])->name('volunfeeds.profile');
    
    // User Notifications routes
    Route::get('/user/notifications', [UserNotificationController::class, 'index'])->name('user.notifications.index');
    Route::post('/user/notifications/{id}/read', [UserNotificationController::class, 'markAsRead'])->name('user.notifications.read');
    Route::post('/user/notifications/read-all', [UserNotificationController::class, 'markAllAsRead'])->name('user.notifications.read.all');

    // Dashboard untuk Admin
    Route::get('dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Dashboard untuk EO
    Route::get('dashboard/eo', [DashboardController::class, 'eoDashboard'])->name('dashboardEO');

    // Admin Notifications routes
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/admin/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('/admin/notifications', [AdminNotificationController::class, 'store'])->name('admin.notifications.store');
    Route::get('/admin/notifications/bulk', [AdminNotificationController::class, 'bulkCreate'])->name('admin.notifications.bulk');
    Route::post('/admin/notifications/bulk', [AdminNotificationController::class, 'bulkStore'])->name('admin.notifications.bulk.store');
    Route::get('/admin/notifications/list', [AdminNotificationController::class, 'index'])->name('admin.notifications.list');

    // Halaman Event
    Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create'); // Halaman buat event
    Route::post('events', [EventController::class, 'store'])->name('events.store'); // Proses penyimpanan event
    Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit'); // Halaman edit event
    Route::put('events/{id}', [EventController::class, 'update'])->name('events.update'); // Proses update event
    Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy'); // Hapus event

    // Manage User
    Route::get('manageusers', [manageUserController::class, 'index'])->name('manageusers.index'); // Daftar semua user
    Route::get('manageusers/{id}', [manageUserController::class, 'show'])->name('manageusers.show'); // Lihat detail user
    Route::get('manageusers/{id}/edit', [manageUserController::class, 'edit'])->name('manageusers.edit'); // Halaman edit user
    Route::put('manageusers/{id}', [manageUserController::class, 'update'])->name('manageusers.update'); // Proses update user
    Route::delete('manageusers/{id}', [manageUserController::class, 'destroy'])->name('manageusers.destroy'); // Hapus user

    // Portfolio
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index'); // Read
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create'); // Create Form
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store'); // Store Create
    Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit'); // Edit Form
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.update'); // Update
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy'); // Delete

    // Feedback
    Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
    Route::get('feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::put('feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

});

// Route untuk activities yang bisa diakses tanpa auth middleware
Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');

Route::middleware('auth')->group(function () {
    Route::get('/referral', [ReferralController::class, 'index'])->name('referral.index');
    Route::post('/referral/generate', [ReferralController::class, 'generate'])->name('referral.generate');

    // Route untuk proses pencatatan referral (contoh user baru pakai kode referral)
    Route::post('/referral/store', [ReferralController::class, 'storeReferral'])->name('referral.store');
});
