<?php

namespace App\Filament\Resources\AIEducationAmbassadorApplicationResource\Pages;

use App\Filament\Resources\AIEducationAmbassadorApplicationResource;
use Filament\Resources\Pages\EditRecord;

class EditAIEducationAmbassadorApplication extends EditRecord
{
    protected static string $resource = AIEducationAmbassadorApplicationResource::class;

    protected static ?string $title = 'Review AI Education Ambassador Application';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
