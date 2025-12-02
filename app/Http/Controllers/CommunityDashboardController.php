<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
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
    /**
     * Redirect /community to /classroom
     */
    public function community() // removed ": View"
    {
        return redirect()->route('classroom');
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
            '7-day' => DB::table('activities')
                ->join('users', 'users.id', '=', 'activities.user_id')
                ->select('users.id', 'users.name', DB::raw('SUM(activities.points) as points'))
                ->where('activities.created_at', '>=', now()->subDays(7))
                ->groupBy('users.id', 'users.name')
                ->orderByDesc('points')
                ->take(10)
                ->get(),

            '30-day' => DB::table('activities')
                ->join('users', 'users.id', '=', 'activities.user_id')
                ->select('users.id', 'users.name', DB::raw('SUM(activities.points) as points'))
                ->where('activities.created_at', '>=', now()->subDays(30))
                ->groupBy('users.id', 'users.name')
                ->orderByDesc('points')
                ->take(10)
                ->get(),

            'all-time' => DB::table('activities')
                ->join('users', 'users.id', '=', 'activities.user_id')
                ->select('users.id', 'users.name', DB::raw('SUM(activities.points) as points'))
                ->groupBy('users.id', 'users.name')
                ->orderByDesc('points')
                ->take(10)
                ->get(),
        ];

        // return view('community.leaderboard', compact('totalMembers', 'topMember', 'levels', 'leaderboards'));
    }

    public function members()
    {
        $members = User::where('is_admin', false)->get();
        $membersCount = $members->count();
        $adminsCount = User::where('is_admin', true)->count();
        $onlineMembers = User::where('is_online', true)->get();

        // return view('community.members', compact('members', 'membersCount', 'adminsCount', 'onlineMembers'));
    }
}
