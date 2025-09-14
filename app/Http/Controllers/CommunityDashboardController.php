<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\UserScore;
use App\Services\LeaderboardService;
use Illuminate\Support\Facades\DB;




class CommunityDashboardController extends Controller
{
    public function community(LeaderboardService $service): View
    {
        $posts = Post::with(['author', 'category', 'comments', 'likes'])
            ->latest()
            ->paginate(3);

        $recentPosts = Post::with(['author', 'category'])
            ->latest()
            ->take(3)
            ->get();

        $allCategories = Category::all(); // returns a collection of Category models
        $totalMembers = User::where('is_admin', false)->count();

        // Top member (from all_time_score)
        $topMember = UserScore::join('users', 'users.id', '=', 'user_scores.user_id')
            ->select('users.*', 'user_scores.all_time_score as score')
            ->orderByDesc('user_scores.all_time_score')
            ->first();

        if ($topMember) {
            $topMember->pointsToNextLevel = 100 - ($topMember->score % 100);
            $usersBehind = UserScore::where('all_time_score', '<', $topMember->score)->count();
            $topMember->percentAhead = $totalMembers ? round($usersBehind / $totalMembers * 100) : 0;
        }

        // Leaderboard (top 3 all-time)
        $leaderboard = UserScore::join('users', 'users.id', '=', 'user_scores.user_id')
            ->select('users.*', 'user_scores.all_time_score as score')
            ->orderByDesc('user_scores.all_time_score')
            ->take(3)
            ->get();

        $membersCount = User::count();
        $postsCount = Post::count();
        $adminsCount = User::where('is_admin', true)->count();
        $onlineMembers = User::where('is_online', true)->pluck('name');

        $nextEvent = Event::where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->first();

        $qnaEventText = $nextEvent
            ? $nextEvent->title . ' starts ' . $nextEvent->start_time->diffForHumans()
            : 'Q&A is happening soon';

        return view('community.dashboard', compact(
            'posts',
            'recentPosts',
            'allCategories',
            'leaderboard',
            'membersCount',
            'postsCount',
            'adminsCount',
            'onlineMembers',
            'qnaEventText',
            'topMember'
        ));
    }

public function showLeaderboard(): View
{
    $totalMembers = User::where('is_admin', false)->count();

    // Top member (all-time)
    $topMemberScore = DB::table('user_scores')
        ->orderByDesc('all_time_score')
        ->first();

    $topMember = $topMemberScore ? User::find($topMemberScore->user_id) : null;

    if ($topMember) {
        $topMember->score = $topMemberScore->all_time_score;
        $topMember->pointsToNextLevel = 100 - ($topMemberScore->all_time_score % 100);
        $usersBehind = DB::table('user_scores')
            ->where('all_time_score', '<', $topMemberScore->all_time_score)
            ->count();
        $topMember->percentAhead = $totalMembers ? round($usersBehind / $totalMembers * 100) : 0;
    }

        // Levels distribution
        $levelsData = DB::table('user_scores')
            ->select(DB::raw('FLOOR(all_time_score / 100) as level'), DB::raw('COUNT(*) as count'))
            ->groupBy('level')
            ->get();

        $levels = [];
        foreach ($levelsData as $data) {
            $levels[$data->level] = $totalMembers ? round($data->count / $totalMembers * 100) : 0;
        }

        // Leaderboards
        $leaderboards = [
    // 7-day leaderboard
    '7-day' => DB::table('activities')
        ->join('users', 'users.id', '=', 'activities.user_id')
        ->select('users.id', 'users.name', DB::raw('SUM(activities.points) as points'))
        ->where('activities.created_at', '>=', now()->subDays(7))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('points')
        ->take(10)
        ->get(),

    // 30-day leaderboard
    '30-day' => DB::table('activities')
        ->join('users', 'users.id', '=', 'activities.user_id')
        ->select('users.id', 'users.name', DB::raw('SUM(activities.points) as points'))
        ->where('activities.created_at', '>=', now()->subDays(30))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('points')
        ->take(10)
        ->get(),

    // all-time leaderboard
    'all-time' => DB::table('activities')
        ->join('users', 'users.id', '=', 'activities.user_id')
        ->select('users.id', 'users.name', DB::raw('SUM(activities.points) as points'))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('points')
        ->take(10)
        ->get(),

    ];

    return view('community.leaderboard', compact('totalMembers', 'topMember', 'levels', 'leaderboards'));
}


    public function members()
{
    // All non-admin members
    $members = User::where('is_admin', false)->get();
    $membersCount = $members->count();

    // Count of admins
    $adminsCount = User::where('is_admin', true)->count();

    // Online members using 'is_online' column
    $onlineMembers = User::where('is_online', true)->get();

    return view('community.members', compact(
        'members', 
        'membersCount', 
        'adminsCount', 
        'onlineMembers'
    ));
}

}
