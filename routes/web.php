<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BookingController;

// Public Routes with Visit Tracking
Route::middleware(\App\Http\Middleware\TrackVisit::class)->group(function () {
    Route::get('/', function () {
        return view('mainpage');
    })->name('home');

    Route::get('/enter-metta-city', function () {
        return view('iientermettacity');
    })->name('enter.metta.city');

    Route::get('/ticketing', function () {
        return view('iiiticketing');
    })->name('ticketing');

    Route::get('/plan-your-visit', function () {
        return view('ivplanvisit');
    })->name('visit');

    Route::get('/faqs', function () {
        return view('vfaqs');
    })->name('faqs');

    Route::get('/about-us', function () {
        return view('viaboutus');
    })->name('aboutus');

    Route::get('/news', function () {
        $news = \App\Models\News::where('is_active', true)
            ->orderBy('published_date', 'desc')
            ->get();
        return view('news', compact('news'));
    })->name('news');

    Route::get('/careers', function () {
        $careers = \App\Models\Career::where('is_active', true)
            ->latest()
            ->get();
        return view('careers', compact('careers'));
    })->name('careers');
});

// Booking Routes
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'destroy'])->names('admin.bookings');
        Route::post('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
        
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
