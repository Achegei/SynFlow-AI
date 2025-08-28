<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function shouldRegisterNavigation(): bool
    {
        return false; // ✅ prevents it from appearing in the sidebar
    }
}
