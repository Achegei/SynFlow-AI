<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CommunityDashboardController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\Admin\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file organizes all web routes into logical, commented groups.
|   1. Public Routes: Accessible to all visitors.
|   2. Authentication Routes: Handled by Laravel Breeze.
|   3. Authenticated Routes: Require a logged-in user.
|   4. Admin Routes: Require both authentication and admin privileges.
|
*/

//================================================
// 1. Public-Facing Site Routes
//================================================
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/contactus', 'contact')->name('contactus'); // Alias for the contact page
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy-policy', 'policy')->name('policy');
});

Route::controller(CareerController::class)->group(function () {
    Route::get('/careers', 'index')->name('careers');
    // The specific 'apply' route must be defined before the dynamic route below
    Route::get('/careers/apply', [ApplicationController::class, 'showForm'])->name('careers.apply');
    // Route for dynamic job descriptions
    Route::get('/careers/{position}', 'show')->name('careers.description');
});

// A standalone public route for the map
Route::get('/map', function () {
    return view('map');
})->name('map');


//================================================
// 2. Authentication Routes (Provided by Breeze)
//================================================
require __DIR__.'/auth.php';


//================================================
// 3. Authenticated User Routes (Clients & Members)
//================================================
Route::middleware('auth')->group(function () {
    // The main dashboard page
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // User profile management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Community and leaderboard pages
    Route::controller(CommunityDashboardController::class)->group(function () {
        Route::get('/community', 'index')->name('community.dashboard');
        Route::get('/community/leaderboard', 'showLeaderboard')->name('community.leaderboard');
        Route::get('/members', 'members')->name('community.members');
    });

    // Classroom routes
    Route::prefix('classroom')->name('classroom.')->group(function () {
        Route::get('/', [ClassroomController::class, 'index'])->name('index');
        Route::get('/{course}', [ClassroomController::class, 'show'])->name('course-details');
    });
});


//================================================
// 4. Admin-Only Routes
//================================================
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->name('admin.')->group(function () {
    // Admin routes for course management
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/create', [CourseAdminController::class, 'create'])->name('create');
        Route::post('/', [CourseAdminController::class, 'store'])->name('store');
    });

    // We no longer need to define resource routes for videos here.
    // Filament handles them automatically based on the VideoResource.php file.
    // The previous `Route::resource` call here was causing a conflict.
});

// This route is fine as it's outside the admin group and points to a public-facing controller.
Route::get('/videos', [VideoController::class, 'indexPublic'])->name('videos.index');
