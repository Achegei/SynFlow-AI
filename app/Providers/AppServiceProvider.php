<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User; // Don't forget to import the User model
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use a view composer to share variables with the navigation layout
        View::composer('layouts.navigation', function ($view) {
            // Fetch the data you need for the navigation bar here.
            // This will be executed on every request that renders this view.
            $membersCount = User::count();
            $adminsCount = User::where('is_admin', true)->count();
            $onlineMembers = User::where('is_online', true)->pluck('name'); // Or a more robust way to count online users

            // Share the variables with the view
            $view->with(compact('membersCount', 'adminsCount', 'onlineMembers'));
        });
        // Register User observer
            User::observe(UserObserver::class);
    }
}
