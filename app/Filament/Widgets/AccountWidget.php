<?php

namespace App\Filament\Widgets;

use Filament\Widgets\AccountWidget as BaseAccountWidget;

class AccountWidget extends BaseAccountWidget
{
    protected function getAvatar(): string|false|null
    {
        // Returning false removes the avatar completely
        return false;
    }
}
