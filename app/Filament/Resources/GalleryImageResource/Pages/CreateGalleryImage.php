<?php

namespace App\Filament\Resources\GalleryImageResource\Pages;

use App\Filament\Resources\GalleryImageResource;
use App\Support\GalleryMediaValidator;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryImage extends CreateRecord
{
    protected static string $resource = GalleryImageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data = GalleryMediaValidator::prepare($data);

        $published = (bool) ($data['is_published'] ?? false);

        $data['published_at'] = $published ? now() : null;

        $data['show_on_homepage'] = $published
            && (bool) ($data['show_on_homepage'] ?? false);

        return $data;
    }
}
