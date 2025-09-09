<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Activity;
use App\Models\UserScore;
use Carbon\Carbon;

class LeaderboardService
{
    // Sum points for a user within a time window
    public function sumPointsForUser($userId, ?Carbon $from = null, ?Carbon $to = null)
    {
        $query = Activity::where('user_id', $userId);

        if ($from) $query->where('created_at', '>=', $from);
        if ($to) $query->where('created_at', '<=', $to);

        return (int) $query->sum('points');
    }

    // Get top N users for a window (from inclusive)
    public function topUsers($limit = 10, ?Carbon $from = null, ?Carbon $to = null)
    {
        $q = Activity::select('user_id', DB::raw('SUM(points) as score'))
            ->when($from, fn($q) => $q->where('created_at', '>=', $from))
            ->when($to, fn($q) => $q->where('created_at', '<=', $to))
            ->groupBy('user_id')
            ->orderByDesc('score')
            ->limit($limit);

        $rows = $q->get();

        // join user data
        $userIds = $rows->pluck('user_id')->all();
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');

        return $rows->map(fn($r) => [
            'user_id' => $r->user_id,
            'score' => (int)$r->score,
            'name' => $users[$r->user_id]->name ?? 'Unknown',
            'profile_photo_url' => $users[$r->user_id]->profile_photo_url ?? null,
            'is_hot_streak' => false,
        ])->values();
    }

    // Recaclulate and persist to user_scores (weekly/monthly/total)
    public function recalculateAll()
    {
        // compute time windows
        $now = Carbon::now();
        $weekFrom = $now->copy()->subDays(7);
        $monthFrom = $now->copy()->subDays(30);

        // Aggregate sums grouped by user
        $weekly = Activity::select('user_id', DB::raw('SUM(points) as score'))
            ->where('created_at', '>=', $weekFrom)
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $monthly = Activity::select('user_id', DB::raw('SUM(points) as score'))
            ->where('created_at', '>=', $monthFrom)
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $total = Activity::select('user_id', DB::raw('SUM(points) as score'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $userIds = User::pluck('id');

        foreach ($userIds as $userId) {
            \App\Models\UserScore::updateOrCreate(
                ['user_id' => $userId],
                [
                    'weekly_score' => (int) ($weekly[$userId]->score ?? 0),
                    'monthly_score' => (int) ($monthly[$userId]->score ?? 0),
                    'all_time_score' => (int) ($total[$userId]->score ?? 0),
                    'last_calculated_at' => $now,
                ]
            );
        }
    }
}
