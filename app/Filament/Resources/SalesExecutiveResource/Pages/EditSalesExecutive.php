<?php

namespace App\Filament\Resources\SalesExecutiveResource\Pages;

use App\Filament\Resources\SalesExecutiveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesExecutive extends EditRecord
{
    protected static string $resource = SalesExecutiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
