<?php

namespace App\Filament\Resources\GalleryImageResource\Pages;

use App\Filament\Resources\GalleryImageResource;
use App\Support\GalleryMediaValidator;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGalleryImage extends EditRecord
{
    protected static string $resource = GalleryImageResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data = GalleryMediaValidator::prepare(
            $data,
            $this->record->only([
                'media_type',
                'image_path',
                'video_path',
                'youtube_url',
            ])
        );

        $published = (bool) ($data['is_published'] ?? false);

        $data['published_at'] = $published
            ? ($this->record->published_at ?? now())
            : null;

        $data['show_on_homepage'] = $published
            && (bool) ($data['show_on_homepage'] ?? false);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
