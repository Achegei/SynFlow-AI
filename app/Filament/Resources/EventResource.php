<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; 
use Filament\Tables\Columns\IconColumn; 
use Filament\Tables\Filters\Filter; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Events';
    protected static ?string $pluralLabel = 'Events';
    protected static ?string $modelLabel = 'Event';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->rows(3),

            DatePicker::make('event_date')
                ->required(),

            TimePicker::make('start_time'),
            TimePicker::make('end_time'),

            TextInput::make('link')
                ->url()
                ->maxLength(255)
                ->label('Meeting Link'),

            Toggle::make('is_live')
                ->label('Mark as Live'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('event_date')->date()->sortable(),
                TextColumn::make('start_time')->time(),
                TextColumn::make('end_time')->time(),
                IconColumn::make('is_live')
                    ->boolean()
                    ->label('Live'),
            ])
            ->filters([
                Filter::make('upcoming')
                    ->query(fn ($query) => $query->whereDate('event_date', '>=', now())),
            ])
            ->defaultSort('event_date', 'asc');
    }

        public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
            'view' => Pages\ViewEvent::route('/{record}'), // 👈 add this
        ];
    }

}