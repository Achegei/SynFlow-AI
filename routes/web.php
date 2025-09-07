<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CommunityDashboardController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MapController;

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/documentation', 'documentation')->name('documentation');
    Route::get('/introduction', 'introduction')->name('introduction');
    Route::get('/technology-stack', 'technology')->name('technology');
    Route::get('/processes', 'processes')->name('processes');
    Route::get('/agents', 'agents')->name('agents');
    Route::get('/assistant', 'assistant')->name('assistant');
    Route::get('/deep-research', 'research')->name('research');
    Route::get('/newsletter-creation', 'newsletter')->name('newsletter');
    Route::get('/rag-pipeline', 'rag')->name('rag');
    Route::get('/faceless-shorts', 'shorts')->name('shorts');
    Route::get('/faqs', 'faqs')->name('faqs');
});

Route::controller(CareerController::class)->group(function () {
    Route::get('/careers', 'index')->name('careers');
    // The specific 'apply' route must be defined before the dynamic route below
    Route::get('/careers/apply', [ApplicationController::class, 'showForm'])->name('careers.apply');
    // Route for dynamic job descriptions
    Route::get('/careers/{position}', 'show')->name('careers.description');
});


Route::get('/dashboard', [CommunityDashboardController::class, 'community'])
    ->middleware(['auth'])
    ->name('dashboard');
//================================================
// 2. Authentication Routes (Provided by Breeze)
//================================================

require __DIR__.'/auth.php';

//================================================
// 3. Authenticated User Routes (Clients & Members)
//================================================
Route::middleware('auth')->group(function () {
    // Static pages for authenticated users

    Route::get('/community', [CommunityDashboardController::class, 'community'])->name('community');
    Route::get('/leaderboards', [CommunityDashboardController::class, 'showLeaderboard'])->name('leaderboards');
    Route::get('/members', [CommunityDashboardController::class, 'members'])->name('members');
    Route::get('/classroom', [ClassroomController::class, 'index'])->name('classroom');
    Route::get('/classroom/{id}', [ClassroomController::class, 'show'])->name('classroom.show');
    
    // Calendar (browse by month/year, defaults to current if not provided)
    Route::get('/calendar', [CalendarController::class, 'index'])
    ->name('calendar');


    // Events (bookings)
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/map', [MapController::class, 'map'])->name('map');
    Route::view('/about', 'about')->name('about');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
// User profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

