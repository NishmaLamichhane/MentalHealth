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
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProgressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [PagesController::class, 'welcome'])->name('home');
Route::get('/activities', [PagesController::class, 'activities'])->name('activities');
Route::get('/viewtherapist/{id}', [PagesController::class, 'viewtherapist'])->name('viewtherapist');
Route::get('/specialisttherapist/{id}', [PagesController::class, 'specialisttherapist'])->name('specialisttherapist');
Route::get('/search', [PagesController::class, 'search'])->name('search');
Route::get('/about', [PagesController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| USERS
|--------------------------------------------------------------------------
*/
Route::resource('users', UserController::class);

/*
|--------------------------------------------------------------------------
| AUTH MIDDLEWARE GROUP
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER PROGRESS
    |--------------------------------------------------------------------------
    */
    Route::prefix('progress')->name('user_progress.')->group(function () {
        Route::get('/', [UserProgressController::class, 'index'])->name('index');
        Route::get('/create', [UserProgressController::class, 'create'])->name('create');
        Route::post('/', [UserProgressController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserProgressController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserProgressController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserProgressController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | BOOKINGS (USER SIDE)
    |--------------------------------------------------------------------------
    */
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/index', [BookingController::class, 'index'])->name('index');
        Route::get('/create/{therapist}', [BookingController::class, 'create'])->name('create');
        Route::post('/', [BookingController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BookingController::class, 'update'])->name('update');
        Route::delete('/{id}', [BookingController::class, 'destroy'])->name('destroy');

        /*
        |----------------------------------------------------------------------
        | DYNAMIC SLOT API ROUTES
        | Called via AJAX to fetch available time slots for a given date.
        |----------------------------------------------------------------------
        */
        Route::get('/slots', [BookingController::class, 'getAvailableSlots'])->name('slots');
        Route::get('/{id}/slots', [BookingController::class, 'getAvailableSlotsForEdit'])->name('slots.edit');
    });

});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | SPECIALIST
    |--------------------------------------------------------------------------
    */
    Route::prefix('specialist')->name('specialist.')->group(function () {
        Route::get('/', [SpecialistController::class, 'index'])->name('index');
        Route::get('/create', [SpecialistController::class, 'create'])->name('create');
        Route::post('/store', [SpecialistController::class, 'store'])->name('store');
        Route::get('/{specialist}/edit', [SpecialistController::class, 'edit'])->name('edit');
        Route::put('/{specialist}', [SpecialistController::class, 'update'])->name('update');
        Route::delete('/{specialist}', [SpecialistController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | THERAPIST
    |--------------------------------------------------------------------------
    */
    Route::prefix('therapist')->name('therapist.')->group(function () {
        Route::get('/', [TherapistController::class, 'index'])->name('index');
        Route::get('/create', [TherapistController::class, 'create'])->name('create');
        Route::post('/store', [TherapistController::class, 'store'])->name('store');
        Route::get('/{therapist}/edit', [TherapistController::class, 'edit'])->name('edit');
        Route::put('/{therapist}', [TherapistController::class, 'update'])->name('update');
        Route::delete('/{therapist}', [TherapistController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | CATEGORY
    |--------------------------------------------------------------------------
    */
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | MINDSET / ACTIVITIES
    |--------------------------------------------------------------------------
    */
    Route::prefix('mindfulness_activities')->name('mindfulness_activities.')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/create', [ActivityController::class, 'create'])->name('create');
        Route::post('/store', [ActivityController::class, 'store'])->name('store');
        Route::get('/{activity}/edit', [ActivityController::class, 'edit'])->name('edit');
        Route::put('/{activity}', [ActivityController::class, 'update'])->name('update');
        Route::delete('/{activity}', [ActivityController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | BOOKING APPROVAL (ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::get('/bookings/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');
    Route::get('/bookings/{id}/updateStatus/{status}', [BookingController::class, 'updateStatus'])
        ->name('bookings.updateStatus');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';