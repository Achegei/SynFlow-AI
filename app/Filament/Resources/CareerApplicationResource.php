<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerApplicationResource\Pages;
use App\Models\CareerApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\LinkColumn;

class CareerApplicationResource extends Resource
{
    protected static ?string $model = CareerApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Recruitment';
    protected static ?string $navigationLabel = 'Career Applications';

    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                    Forms\Components\TextInput::make('full_name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),

                    Forms\Components\Select::make('career_id')
                        ->label('Position')
                        ->relationship('career', 'title')
                        ->searchable()
                        ->required(),

                    Forms\Components\FileUpload::make('cv_cover_path')
                        ->label('CV / Cover Letter')
                        ->directory('career_applications')
                        ->downloadable()
                        ->required()
                        ->acceptedFileTypes(['application/pdf']),
                ]);
            }

    public static function table(Table $table): Table
    {
        return $table
                    ->columns([
            TextColumn::make('id')
                ->sortable(),

            TextColumn::make('full_name')
                ->label('Full Name')
                ->searchable(),

            TextColumn::make('email')
                ->searchable(),

            TextColumn::make('career.title')
                ->label('Position'),

            TextColumn::make('cv_cover_path')
                ->label('Download CV')
                ->formatStateUsing(fn($state) => 'Download CV')
                ->url(fn($record) => asset('storage/' . $record->cv_cover_path))
                ->openUrlInNewTab()
                ->icon('heroicon-o-arrow-down-tray'),

            TextColumn::make('created_at')
                ->dateTime()
                ->label('Applied At'),
                    ]);

    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareerApplications::route('/'),
            'create' => Pages\CreateCareerApplication::route('/create'),
            'edit' => Pages\EditCareerApplication::route('/{record}/edit'),
        ];
    }
}
