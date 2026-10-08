<?php

namespace App\Filament\Resources\AIEducationAmbassadorApplicationResource\Pages;

use App\Filament\Resources\AIEducationAmbassadorApplicationResource;
use Filament\Resources\Pages\ListRecords;

class ListAIEducationAmbassadorApplications extends ListRecords
{
    protected static string $resource = AIEducationAmbassadorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
