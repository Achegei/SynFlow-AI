<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\View\View;

class CommunityDashboardController extends Controller
{
    /**
     * Show the community dashboard.
     */
    public function community(): View
    {
        // Fetch posts with relationships
        $posts = Post::with(['author', 'category', 'comments', 'likes'])
                     ->latest()
                     ->paginate(3);

        $recentPosts   = Post::with(['author', 'category'])->latest()->take(3)->get();
        $allCategories = Category::pluck('name')->all();

        $leaderboard   = User::orderByDesc('score')->take(3)->get();
        $membersCount  = User::count();
        $postsCount    = Post::count();
        $adminsCount   = User::where('is_admin', true)->count();
        $onlineMembers = User::where('is_online', true)->pluck('name');

        // ✅ Fetch the next upcoming event
        $nextEvent = Event::where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->first();

        $qnaEventText = $nextEvent
            ? $nextEvent->title . ' starts ' . $nextEvent->start_time->diffForHumans()
            : 'Q&A is happening soon';

        return view('community.dashboard', compact(
            'posts', 'recentPosts', 'allCategories', 'leaderboard',
            'membersCount', 'postsCount', 'adminsCount', 'onlineMembers',
            'qnaEventText'
        ));
    }

    /**
     * Show the leaderboard.
     */
    public function showLeaderboard(): View
    {
        $currentUser = auth()->user();

        $leaderboard7Day   = User::orderByDesc('score')->take(10)->get();
        $leaderboard30Day  = User::orderByDesc('score')->take(10)->get();
        $leaderboardAllTime = User::orderByDesc('score')->take(10)->get();

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

        $nonAdminMembers = User::where('is_admin', false)->count();
        $lastUpdated     = now()->format('M jS Y H:ia');

        return view('community.leaderboard', compact(
            'currentUser',
            'leaderboard7Day',
            'leaderboard30Day',
            'leaderboardAllTime',
            'levels',
            'lastUpdated',
            'nonAdminMembers'
        ));
    }

    /**
     * Show the members page.
     */
    public function members(): View
    {
        $members       = User::where('is_admin', false)->latest()->get();
        $onlineMembers = User::where('is_online', true)->get();
        $adminsCount   = User::where('is_admin', true)->count();
        $membersCount  = User::count();

        return view('community.members', compact(
            'members',
            'onlineMembers',
            'adminsCount',
            'membersCount'
        ));
    }
}
