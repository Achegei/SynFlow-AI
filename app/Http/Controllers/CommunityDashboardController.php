<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\View\View;

class CommunityDashboardController extends Controller
{
    public function index(): View
    {
        // Fetch posts with their authors, categories, comments, and likes, and paginate them
        $posts = Post::with(['author', 'category', 'comments', 'likes'])
                     ->latest()
                     ->paginate(5);

        // Fetch other data for the dashboard
        $recentPosts = Post::with(['author', 'category'])->latest()->take(3)->get();
        $allCategories = Category::pluck('name')->all();

        // Assuming you have columns for score, is_admin, and a way to determine who's online
        $leaderboard = User::orderByDesc('score')->take(5)->get();
        $membersCount = User::count();
        $postsCount = Post::count();
        $adminsCount = User::where('is_admin', true)->count();
        $onlineMembers = User::where('is_online', true)->pluck('name');

        return view('community.dashboard', compact(
            'posts', 'recentPosts', 'allCategories', 'leaderboard',
            'membersCount', 'postsCount', 'adminsCount', 'onlineMembers'
        ));
    }
    public function showLeaderboard(): View
    {
        // Fetch the current authenticated user. Assuming you are using Laravel's built-in auth.
        $currentUser = auth()->user();

        // Fetch the leaderboards directly from the database, assuming a 'score' column exists
        $leaderboard7Day = User::orderByDesc('score')->take(10)->get();
        $leaderboard30Day = User::orderByDesc('score')->take(10)->get();
        $leaderboardAllTime = User::orderByDesc('score')->take(10)->get();

        // The 'levels' data is typically not in the database but defined in your app logic.
        $levels = [
            ['level' => 1, 'percentage' => 87],
            ['level' => 2, 'percentage' => 5],
            ['level' => 3, 'percentage' => 2],
            ['level' => 4, 'percentage' => 1],
            ['level' => 5, 'percentage' => 1],
            ['level' => 6, 'percentage' => 1],
            ['level' => 7, 'percentage' => 1],
            ['level' => 8, 'percentage' => 1],
            ['level' => 9, 'percentage' => 1],
        ];
        
        // Fetch the count of non-admin members
        $nonAdminMembers = User::where('is_admin', false)->count();

        $lastUpdated = now()->format('M jS Y H:ia');

        return view('community.leaderboard', compact('currentUser', 'leaderboard7Day', 'leaderboard30Day', 'leaderboardAllTime', 'levels', 'lastUpdated', 'nonAdminMembers'));
    }
    
    public function members(): View
    {
        // Fetch all members who are not admins from the users table
        $members = User::where('is_admin', false)->latest()->get();

        // Get the total counts from the database
        $onlineMembers = User::where('is_online', true)->get();
        $adminsCount = User::where('is_admin', true)->count();
        $membersCount = User::count();

        return view('community.members', compact('members', 'onlineMembers', 'adminsCount', 'membersCount'));
    }
}
