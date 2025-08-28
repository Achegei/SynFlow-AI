<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\BlogPost; // <-- ADD THIS LINE
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Card::make('Total Blog Posts', BlogPost::count())
                ->description('Published posts in the system')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Card::make('New Users Today', User::whereDate('created_at', today())->count())
                ->description('Joined in the last 24 hours')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning'),
        ];
    }
}
