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

                Forms\Components\TextInput::make('position')
                    ->label('Position (Submitted)')
                    ->disabled(),

                Forms\Components\TextInput::make('position_slug')
                    ->label('Position Slug')
                    ->disabled(),

                Forms\Components\Select::make('career_id')
                    ->label('Matched Career (Optional)')
                    ->relationship('career', 'title')
                    ->searchable()
                    ->nullable(),

                Forms\Components\FileUpload::make('cv_cover_path')
                    ->label('CV (PDF)')
                    ->directory('career_applications')
                    ->downloadable()
                    ->acceptedFileTypes(['application/pdf'])
                    ->required(),
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

                TextColumn::make('position')
                    ->label('Position (Submitted)')
                    ->searchable(),

                TextColumn::make('cv_cover_path')
                    ->label('Download CV')
                    ->formatStateUsing(fn () => 'Download CV')
                    ->url(fn ($record) => asset('storage/' . $record->cv_cover_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Applied At'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
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
