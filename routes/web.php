<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes are organized into logical groups:
|   1. Public Routes: Accessible to all visitors.
|   2. Authenticated Routes: Require a user to be logged in.
|   3. Authentication Routes: Handles login, registration, etc.
|
*/

//================================================
// Public-Facing Site Routes
//================================================
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy-policy', 'policy')->name('policy');
    Route::get('/contactus', 'contact')->name('contactus');
    Route::get('/careers', 'careers')->name('careers');
});

// IMPORTANT: Place this specific route first to prevent conflicts
Route::get('/careers/apply', [ApplicationController::class, 'showForm'])->name('careers.apply');

// Route for dynamic job descriptions
Route::get('/careers/{position}', [CareerController::class, 'show'])->name('careers.description');


//================================================
// Authenticated User Routes (Clients & Members)
//================================================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});


//================================================
// Authentication Routes (Provided by Breeze)
//================================================
require __DIR__.'/auth.php';
