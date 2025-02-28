<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProgressController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PagesController::class, 'welcome'])->name('home');
Route::get('/activities', [PagesController::class, 'activities'])->name('activities');
Route::get('/viewtherapist/{id}', [PagesController::class, 'viewtherapist'])->name('viewtherapist');
Route::get('/specialisttherapist/{id}', [PagesController::class, 'specialisttherapist'])->name('specialisttherapist');
Route::get('/search', [PagesController::class, 'search'])->name('search');

// Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('register', [RegisteredUserController::class, 'store']);

// User Routes
Route::resource('users', UserController::class);

//User Progress

Route::middleware(['auth'])->group(function () {
    Route::get('/progress', [UserProgressController::class, 'index'])->name('user_progress.index');
    Route::get('/user/progress', [UserProgressController::class, 'index'])->name('user_progress.index');
    Route::get('/progress/create', [UserProgressController::class, 'create'])->name('user_progress.create');
    Route::post('/progress', [UserProgressController::class, 'store'])->name('user_progress.store');
    Route::get('/progress/{id}/edit', [UserProgressController::class, 'edit'])->name('user_progress.edit');
    Route::put('/progress/{id}',[UserProgressController::class,'update'])->name('user_progress.update');
    Route::delete('/progress/{id}', [UserProgressController::class, 'destroy'])->name('user_progress.destroy');
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Booking Routes
    Route::get('/bookings/index', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{therapist}', [BookingController::class, 'create'])->name('bookings.create');

    // Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    // Route::post('nomination/{bookingId}/store',[NominationController::class,'store'])->name('nomination.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Specialist Routes
    Route::get('/specialist', [SpecialistController::class, 'index'])->name('specialist.index');
    Route::get('/specialist/create', [SpecialistController::class, 'create'])->name('specialist.create');
    Route::post('/specialist/store', [SpecialistController::class, 'store'])->name('specialist.store');
    Route::get('/specialist/{specialist}/edit', [SpecialistController::class, 'edit'])->name('specialist.edit');
    Route::put('/specialist/{specialist}/update', [SpecialistController::class, 'update'])->name('specialist.update');
    Route::delete('/specialist/{id}', [SpecialistController::class, 'destroy'])->name('specialist.destroy');

    // Therapist Routes
    Route::get('/therapist', [TherapistController::class, 'index'])->name('therapist.index');
    Route::get('/therapist/create', [TherapistController::class, 'create'])->name('therapist.create');
    Route::post('/therapist/store', [TherapistController::class, 'store'])->name('therapist.store');
    Route::get('/therapist/{id}/edit', [TherapistController::class, 'edit'])->name('therapist.edit');
    Route::put('/therapist/{id}/update', [TherapistController::class, 'update'])->name('therapist.update');
    Route::delete('/therapist/{id}', [TherapistController::class, 'destroy'])->name('therapist.destroy');

    // Category Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Mindfulness Activities Routes
    Route::get('/mindfulness_activities', [ActivityController::class, 'index'])->name('mindfulness_activities.index');
    Route::get('/mindfulness_activities/create', [ActivityController::class, 'create'])->name('mindfulness_activities.create');
    Route::post('/mindfulness_activities/store', [ActivityController::class, 'store'])->name('mindfulness_activities.store');
    Route::get('/mindfulness_activities/{mindfulness_activities}/edit', [ActivityController::class, 'edit'])->name('mindfulness_activities.edit');
    Route::put('/mindfulness_activities/{mindfulness_activities}/update', [ActivityController::class, 'update'])->name('mindfulness_activities.update');
    Route::delete('/mindfulness_activities/{mindfulness_activities}', [ActivityController::class, 'destroy'])->name('mindfulness_activities.destroy');

    Route::get('/bookings', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::get('/bookings/{id}/updateStatus/{status}', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__ . '/auth.php';
