<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryImageResource\Pages;
use App\Models\GalleryImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class GalleryImageResource extends Resource
{
    protected static ?string $model = GalleryImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Website Content';

    protected static ?string $navigationLabel = 'Media Gallery';

    protected static ?string $modelLabel = 'Gallery Item';

    protected static ?string $pluralModelLabel = 'Gallery Items';

    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->check()
            && (bool) auth()->user()->is_active
            && auth()->user()->is_admin == 1;
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Gallery Media')
                ->schema([
                    Forms\Components\Select::make('media_type')
                        ->label('Media Type')
                        ->options([
                            'photo' => 'Photograph',
                            'video_upload' => 'Upload MP4 Video',
                            'youtube' => 'YouTube Video',
                        ])
                        ->default('photo')
                        ->required()
                        ->live(),

                    Forms\Components\FileUpload::make('image_path')
                        ->label('Photograph / Video Thumbnail')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('gallery')
                        ->visibility('public')
                        ->maxSize(5120)
                        ->required(
                            fn (Forms\Get $get): bool =>
                                in_array(
                                    $get('media_type'),
                                    ['photo', 'video_upload'],
                                    true
                                )
                        )
                        ->visible(
                            fn (Forms\Get $get): bool =>
                                $get('media_type') !== 'youtube'
                        ),

                    Forms\Components\FileUpload::make('video_path')
                        ->label('Upload MP4 Video')
                        ->acceptedFileTypes(['video/mp4'])
                        ->disk('public')
                        ->directory('gallery/videos')
                        ->visibility('public')
                        ->maxSize(51200)
                        ->required(
                            fn (Forms\Get $get): bool =>
                                $get('media_type') === 'video_upload'
                        )
                        ->visible(
                            fn (Forms\Get $get): bool =>
                                $get('media_type') === 'video_upload'
                        ),

                    Forms\Components\TextInput::make('youtube_url')
                        ->label('YouTube Video URL')
                        ->url()
                        ->maxLength(500)
                        ->required(
                            fn (Forms\Get $get): bool =>
                                $get('media_type') === 'youtube'
                        )
                        ->rule(
                            fn (): \Closure => function (
                                string $attribute,
                                mixed $value,
                                \Closure $fail
                            ): void {
                                if (
                                    ! is_string($value)
                                    || \App\Support\GalleryMediaValidator::youtubeVideoId($value) === null
                                ) {
                                    $fail('Enter a valid YouTube video URL.');
                                }
                            }
                        )
                        ->visible(
                            fn (Forms\Get $get): bool =>
                                $get('media_type') === 'youtube'
                        )
                        ->helperText(
                            'Use a standard YouTube watch or youtu.be link.'
                        ),

                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Textarea::make('caption')
                        ->rows(3)
                        ->maxLength(2000),

                    Forms\Components\TextInput::make('alt_text')
                        ->label('Image / Thumbnail Description')
                        ->maxLength(255),

                    Forms\Components\Select::make('category')
                        ->options([
                            'AI Training' => 'AI Training',
                            'AI Orientations' => 'AI Orientations',
                            'Institutional Partnerships' => 'Institutional Partnerships',
                            'MoU Signings' => 'MoU Signings',
                            'Corporate Workshops' => 'Corporate Workshops',
                            'Academy Events' => 'Academy Events',
                            'Other' => 'Other',
                        ])
                        ->required()
                        ->default('Academy Events'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Publication Settings')
                ->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publish Gallery Item')
                        ->default(false)
                        ->live()
                        ->helperText(
                            'Only publish approved photographs and videos.'
                        ),

                    Forms\Components\Toggle::make('show_on_homepage')
                        ->label('Feature on Homepage')
                        ->default(false)
                        ->disabled(
                            fn (Forms\Get $get): bool =>
                                ! (bool) $get('is_published')
                        )
                        ->dehydrated()
                        ->helperText(
                            'Featured media appears in the homepage preview.'
                        ),

                    Forms\Components\TextInput::make('display_order')
                        ->label('Display Order')
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->required(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Thumbnail')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                Tables\Columns\IconColumn::make('show_on_homepage')
                    ->label('Homepage')
                    ->boolean(),

                Tables\Columns\TextColumn::make('display_order')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('display_order')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryImages::route('/'),
            'create' => Pages\CreateGalleryImage::route('/create'),
            'edit' => Pages\EditGalleryImage::route('/{record}/edit'),
        ];
    }
}
