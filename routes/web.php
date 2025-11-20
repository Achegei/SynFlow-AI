<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CareerApplicationController;
use App\Http\Controllers\CommunityDashboardController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\EpisodeProgressController;
use App\Http\Controllers\PostController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\Career;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/certificate/download', [CertificateController::class, 'generate'])
    ->middleware('auth')
    ->name('certificate.download');

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

Route::prefix('careers')->group(function () {
    // Careers listing
    Route::get('/', [CareerController::class, 'index'])->name('careers');
    Route::post('/submit', [CareerApplicationController::class, 'store'])->name('careers.submit');

    // Apply form must come before the dynamic job description
    Route::get('/apply', [ApplicationController::class, 'showForm'])->name('careers.apply');

    // Dynamic job descriptions
    Route::get('/{position}', [CareerController::class, 'show'])->name('careers.description');
});
// Webhook route for payment providers
Route::post('/webhook/{provider}', [App\Http\Controllers\WebhookController::class, 'handle']);


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

    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');

    
    // Calendar (browse by month/year, defaults to current if not provided)
    Route::get('/calendar', [CalendarController::class, 'index'])
    ->name('calendar');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/episodes/{episode}/watched', [EpisodeProgressController::class, 'markWatched'])
    ->name('episodes.markWatched');
    Route::post('/episodes/{episode}/toggle', [EpisodeProgressController::class, 'toggle'])
    ->name('episodes.toggle');

    //Course payment routes
    Route::post('/purchase/{course}', [PurchaseController::class, 'purchase'])->name('purchase.course');
    Route::get('/purchase/complete', [PurchaseController::class, 'complete'])->name('purchase.complete');
    



    // Events (bookings)
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/map', [MapController::class, 'map'])->name('map');
    Route::get('/aboutus', [AboutController::class, 'index'])->name('auth-about');
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
        //Route::get('/create', [CourseAdminController::class, 'create'])->name('create');
        Route::post('/', [CourseAdminController::class, 'store'])->name('store');
    });

    // We no longer need to define resource routes for videos here.
    // Filament handles them automatically based on the VideoResource.php file.
    // The previous `Route::resource` call here was causing a conflict.
});

// This route is fine as it's outside the admin group and points to a public-facing controller.
Route::get('/videos', [VideoController::class, 'indexPublic'])->name('videos.index');

Route::get('/generate-sitemap', function () {
    $sitemapPath = public_path('sitemap.xml');

    // 1️⃣ Crawl the whole site (publicly accessible URLs)
    SitemapGenerator::create(config('app.url'))
        ->writeToFile($sitemapPath);

    // 2️⃣ Add custom/dynamic URLs (Posts, Careers, etc.)
    $sitemap = Sitemap::create();

    // Static pages
    $staticRoutes = [
        '/',
        '/about',
        '/services',
        '/contact',
        '/terms',
        '/privacy-policy',
        '/pricing',
        '/documentation',
        '/technology-stack',
        '/processes',
        '/faqs',
        '/careers',
        '/assistant',
        '/newsletter-creation',
        '/rag-pipeline',
    ];

    foreach ($staticRoutes as $url) {
        $sitemap->add(Url::create($url));
    }

    // Add all dynamic careers (if model exists)
    if (class_exists(Career::class)) {
        foreach (Career::all() as $career) {
            $sitemap->add(Url::create("/careers/{$career->slug}"));
        }
    }

    // Add all blog posts (if model exists)
    if (class_exists(Post::class)) {
        foreach (Post::all() as $post) {
            $sitemap->add(Url::create("/posts/{$post->id}"));
        }
    }

    // Merge and write final file
    $sitemap->writeToFile($sitemapPath);

    return response()->json([
        'message' => '✅ Sitemap generated successfully!',
        'path' => asset('sitemap.xml'),
    ]);
});


