<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\manageUserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReferralController;

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
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // Manage User
    Route::get('manageusers', [manageUserController::class, 'index'])->name('manageusers.index');
    Route::get('manageusers/{id}', [manageUserController::class, 'show'])->name('manageusers.show');
    Route::get('manageusers/{id}/edit', [manageUserController::class, 'edit'])->name('manageusers.edit');
    Route::put('manageusers/{id}', [manageUserController::class, 'update'])->name('manageusers.update');
    Route::delete('manageusers/{id}', [manageUserController::class, 'destroy'])->name('manageusers.destroy');

    // Forum Routes
    Route::get('forums', [ForumController::class, 'index'])->name('forums.index');
    Route::get('forums/create', [ForumController::class, 'create'])->name('forums.create');
    Route::post('forums', [ForumController::class, 'store'])->name('forums.store');
    Route::get('forums/{forum}', [ForumController::class, 'show'])->name('forums.show');
    Route::get('forums/{forum}/edit', [ForumController::class, 'edit'])->name('forums.edit');
    Route::put('forums/{forum}', [ForumController::class, 'update'])->name('forums.update');
    Route::delete('forums/{forum}', [ForumController::class, 'destroy'])->name('forums.destroy');

    // Comment Routes
    Route::post('forums/{forum}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Portfolio
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

    // Feedback
    Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
    Route::get('feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::put('feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    // Referral
    Route::get('/referral', [ReferralController::class, 'index'])->name('referral.index');
    Route::post('/referral/generate', [ReferralController::class, 'generate'])->name('referral.generate');
    Route::post('/referral/store', [ReferralController::class, 'storeReferral'])->name('referral.store');
});

// Route untuk activities yang bisa diakses tanpa auth middleware
Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
