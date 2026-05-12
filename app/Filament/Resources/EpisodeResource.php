<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EpisodeResource\Pages;
use App\Models\Episode;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class EpisodeResource extends Resource
{
    protected static ?string $model = Episode::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';
    protected static ?string $navigationLabel = 'Episodes';

    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    public static function form(Form $form): Form
    {
        return $form->schema([

            /*
            |--------------------------------------------------------------------------
            | ATTACH TO MODULE
            |--------------------------------------------------------------------------
            */

            Select::make('module_id')
                ->relationship('module', 'title')
                ->searchable()
                ->required()
                ->label('Module'),

            /*
            |--------------------------------------------------------------------------
            | LESSON INFO
            |--------------------------------------------------------------------------
            */

            TextInput::make('title')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->rows(4)
                ->nullable(),

            /*
            |--------------------------------------------------------------------------
            | CONTENT TYPE
            |--------------------------------------------------------------------------
            */

            Select::make('type')
                ->options([
                    'video' => 'Video',
                    'reading' => 'Reading',
                ])
                ->default('video')
                ->required(),

            /*
            |--------------------------------------------------------------------------
            | VIDEO + PDF CONTENT
            |--------------------------------------------------------------------------
            */

            TextInput::make('video_url')
                ->label('YouTube URL')
                ->url()
                ->nullable(),

            FileUpload::make('pdf_path')
                ->label('PDF Notes')
                ->directory('episodes/pdfs')
                ->acceptedFileTypes(['application/pdf'])
                ->nullable(),

            /*
            |--------------------------------------------------------------------------
            | ORDERING
            |--------------------------------------------------------------------------
            */

            TextInput::make('position')
                ->numeric()
                ->default(0)
                ->label('Order'),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TABLE (WITH SORTING INSIDE MODULES)
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('module.title')
                    ->label('Module')
                    ->sortable(),

                TextColumn::make('type')
                    ->badge(),

                TextColumn::make('position')
                    ->label('Order')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime(),
            ])

            /*
            |--------------------------------------------------------------------------
            | DRAG & DROP ORDERING
            |--------------------------------------------------------------------------
            */

            ->defaultSort('position')
            ->reorderable('position')

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEpisodes::route('/'),
            'create' => Pages\CreateEpisode::route('/create'),
            'edit' => Pages\EditEpisode::route('/{record}/edit'),
        ];
    }
}