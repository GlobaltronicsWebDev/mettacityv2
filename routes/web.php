<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\BookingController;

// Public Routes with Visit Tracking
Route::middleware(\App\Http\Middleware\TrackVisit::class)->group(function () {
    Route::get('/', function () {
        $totalVisits = \App\Models\Visit::count();
        return view('mainpage', compact('totalVisits'));
    })->name('home');

    Route::get('/enter-metta-city', function () {
        $totalVisits = \App\Models\Visit::count();
        return view('iientermettacity', compact('totalVisits'));
    })->name('enter.metta.city');

    Route::get('/ticketing', function () {
        $totalVisits = \App\Models\Visit::count();
        return view('iiiticketing', compact('totalVisits'));
    })->name('ticketing');

    Route::get('/plan-your-visit', function () {
        $totalVisits = \App\Models\Visit::count();
        return view('ivplanvisit', compact('totalVisits'));
    })->name('visit');

    Route::get('/faqs', function () {
        $totalVisits = \App\Models\Visit::count();
        return view('vfaqs', compact('totalVisits'));
    })->name('faqs');

    Route::get('/about-us', function () {
        $totalVisits = \App\Models\Visit::count();
        return view('viaboutus', compact('totalVisits'));
    })->name('aboutus');

    Route::get('/news', function () {
        $news = \App\Models\News::where('is_active', true)
            ->orderBy('published_date', 'desc')
            ->get();
        $totalVisits = \App\Models\Visit::count();
        return view('news', compact('news', 'totalVisits'));
    })->name('news');

    Route::get('/careers', function () {
        $careers = \App\Models\Career::where('is_active', true)
            ->latest()
            ->get();
        $totalVisits = \App\Models\Visit::count();
        return view('careers', compact('careers', 'totalVisits'));
    })->name('careers');
});

// Booking Routes
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::middleware(\App\Http\Middleware\RestrictAdminIP::class)->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
            Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'destroy'])->names('admin.bookings');
            Route::post('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
            
            // Profile Management (All Admins)
            Route::get('profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
            Route::put('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
            Route::delete('profile/picture', [AdminProfileController::class, 'removeProfilePicture'])->name('admin.profile.removePicture');
            
            // Careers - View only for all admins
            Route::get('careers', [AdminCareerController::class, 'index'])->name('admin.careers.index');
            
            // Super Admin Only Routes
            Route::middleware(\App\Http\Middleware\IsSuperAdmin::class)->group(function () {
                Route::resource('news', AdminNewsController::class)->names('admin.news');
                Route::resource('users', AdminUserController::class)->names('admin.users');
                
                // Careers - Create, Edit, Delete (Super Admin only)
                Route::get('careers/create', [AdminCareerController::class, 'create'])->name('admin.careers.create');
                Route::post('careers', [AdminCareerController::class, 'store'])->name('admin.careers.store');
                Route::get('careers/{career}/edit', [AdminCareerController::class, 'edit'])->name('admin.careers.edit');
                Route::put('careers/{career}', [AdminCareerController::class, 'update'])->name('admin.careers.update');
                Route::delete('careers/{career}', [AdminCareerController::class, 'destroy'])->name('admin.careers.destroy');
            });
        });
    });
});
