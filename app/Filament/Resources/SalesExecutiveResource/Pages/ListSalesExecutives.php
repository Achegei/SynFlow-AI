<?php

namespace App\Filament\Resources\SalesExecutiveResource\Pages;

use App\Filament\Resources\SalesExecutiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesExecutives extends ListRecords
{
    protected static string $resource = SalesExecutiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
