<?php
// app/Console/Commands/RecalculateLeaderboard.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LeaderboardService;

class RecalculateLeaderboard extends Command
{
    protected $signature = 'leaderboard:recalculate';
    protected $description = 'Recalculate leaderboard scores';

    public function handle(LeaderboardService $service)
    {
        $this->info('Recalculating leaderboard...');
        $service->recalculateAll();
        $this->info('Done.');
    }
}
