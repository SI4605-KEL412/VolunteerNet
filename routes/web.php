<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\VolunFeedsController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ImpactTrackerController;

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
    Route::get('dashboard/eo', [DashboardController::class, 'eoDashboard'])->name('user.dashboardEO');

    // Dashboard Admin
    Route::get('dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin Notifications
    Route::prefix('admin/notifications')->name('admin.notifications.')->group(function () {
        Route::get('/', [AdminNotificationController::class, 'index'])->name('index');
        Route::get('create', [AdminNotificationController::class, 'create'])->name('create');
        Route::post('/', [AdminNotificationController::class, 'store'])->name('store');
        Route::get('bulk', [AdminNotificationController::class, 'bulkCreate'])->name('bulk');
        Route::post('bulk', [AdminNotificationController::class, 'bulkStore'])->name('bulk.store');
        Route::get('list', [AdminNotificationController::class, 'index'])->name('list');
    });

    // VolunFeeds
    Route::prefix('volunfeeds')->name('volunfeeds.')->group(function () {
        Route::get('/', [VolunFeedsController::class, 'index'])->name('index');
        Route::post('{id}/like', [VolunFeedsController::class, 'toggleLike'])->name('toggle-like');
        Route::get('my-portfolios', [VolunFeedsController::class, 'myPortfolios'])->name('my-portfolios');
        Route::get('{id}', [VolunFeedsController::class, 'show'])->name('show');
        Route::get('profile/{userId}', [VolunFeedsController::class, 'showProfile'])->name('profile');
    });

    // User Notifications
    Route::prefix('user/notifications')->name('user.notifications.')->group(function () {
        Route::get('/', [UserNotificationController::class, 'index'])->name('index');
        Route::post('{id}/read', [UserNotificationController::class, 'markAsRead'])->name('read');
        Route::post('read-all', [UserNotificationController::class, 'markAllAsRead'])->name('read.all');
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

    // Manage Users
    Route::prefix('manageusers')->name('manageusers.')->group(function () {
        Route::get('/', [ManageUserController::class, 'index'])->name('index');
        Route::get('{id}', [ManageUserController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ManageUserController::class, 'edit'])->name('edit');
        Route::put('{id}', [ManageUserController::class, 'update'])->name('update');
        Route::delete('{id}', [ManageUserController::class, 'destroy'])->name('destroy');
    });

    // Detail User
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}/update-name', [UserController::class, 'updateName'])->name('users.updateName');

    // Portfolio
    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('index');
        Route::get('create', [PortfolioController::class, 'create'])->name('create');
        Route::post('/', [PortfolioController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PortfolioController::class, 'edit'])->name('edit');
        Route::put('{id}', [PortfolioController::class, 'update'])->name('update');
        Route::delete('{id}', [PortfolioController::class, 'destroy'])->name('destroy');
    });

    // Feedback
    Route::prefix('feedback')->name('feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::get('create', [FeedbackController::class, 'create'])->name('create');
        Route::post('/', [FeedbackController::class, 'store'])->name('store');
        Route::get('{id}', [FeedbackController::class, 'show'])->name('show');
        Route::get('{id}/edit', [FeedbackController::class, 'edit'])->name('edit');
        Route::put('{id}', [FeedbackController::class, 'update'])->name('update');
        Route::delete('{id}', [FeedbackController::class, 'destroy'])->name('destroy');
    });

    // Recruitment - User Side
    Route::prefix('recruitment-user')->name('recruitmentUser.')->group(function () {
        Route::get('/', [RecruitmentController::class, 'userIndex'])->name('index');
        Route::get('create', [RecruitmentController::class, 'userCreate'])->name('create');
        Route::post('/', [RecruitmentController::class, 'userStore'])->name('store');
        Route::get('{id}', [RecruitmentController::class, 'userShow'])->name('show');
        Route::get('{id}/edit', [RecruitmentController::class, 'userEdit'])->name('edit');
        Route::put('{id}', [RecruitmentController::class, 'userUpdate'])->name('update');
        Route::delete('{id}', [RecruitmentController::class, 'userDestroy'])->name('destroy');
    });

    // Recruitment - EO Side
    Route::prefix('eo/recruitment')->name('eo.recruitment.')->group(function () {
        Route::get('/', [RecruitmentController::class, 'index'])->name('index');
        Route::get('create', [RecruitmentController::class, 'create'])->name('create');
        Route::post('/', [RecruitmentController::class, 'store'])->name('store');
        Route::get('{recruitment}/edit', [RecruitmentController::class, 'edit'])->name('edit');
        Route::put('{recruitment}', [RecruitmentController::class, 'update'])->name('update');
        Route::delete('{recruitment}', [RecruitmentController::class, 'destroy'])->name('destroy');
        Route::get('{recruitment}', [RecruitmentController::class, 'show'])->name('show');
    });

    // Referral
    Route::prefix('referral')->name('referral.')->group(function () {
        Route::get('/', [ReferralController::class, 'index'])->name('index');
        Route::post('generate', [ReferralController::class, 'generate'])->name('generate');
        Route::post('store', [ReferralController::class, 'storeReferral'])->name('store');
    });

    // Certification
    Route::prefix('certifications')->name('certifications.')->group(function () {
        Route::get('/', [CertificationController::class, 'index'])->name('index');
        Route::post('/', [CertificationController::class, 'store'])->name('store');
        Route::get('generate/{event_id}', [CertificationController::class, 'generate'])->name('generate');
        Route::get('events', [CertificationController::class, 'showAllEvents'])->name('events');
        Route::delete('{id}', [CertificationController::class, 'destroy'])->name('destroy');
    });

    // Forum
    Route::prefix('forums')->name('forums.')->group(function () {
        Route::get('/', [ForumController::class, 'index'])->name('index');
        Route::get('create', [ForumController::class, 'create'])->name('create');
        Route::post('/', [ForumController::class, 'store'])->name('store');
        Route::get('{forum}', [ForumController::class, 'show'])->name('show');
        Route::get('{forum}/edit', [ForumController::class, 'edit'])->name('edit');
        Route::put('{forum}', [ForumController::class, 'update'])->name('update');
        Route::delete('{forum}', [ForumController::class, 'destroy'])->name('destroy');
    });

    // Comment
    Route::post('forums/{forum}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Bookmark
    Route::resource('bookmarks', BookmarkController::class)->only([
        'index', 'store', 'destroy'
    ]);

    // Impact Tracker
    // Impact Tracker EO (pindah ke dalam prefix eo)
    Route::prefix('eo')->group(function () {
        Route::get('impacttracker', [ImpactTrackerController::class, 'eoIndex'])->name('impacttracker.eo.index');
        Route::get('impacttracker/{event}/create', [ImpactTrackerController::class, 'create'])->name('impacttracker.eo.create');
        Route::post('impacttracker/{event}', [ImpactTrackerController::class, 'store'])->name('impacttracker.eo.store');
    });

    // Impact Tracker User tetap di luar prefix
    Route::get('impacttracker', [ImpactTrackerController::class, 'userIndex'])->name('impacttracker.user.index');

});
