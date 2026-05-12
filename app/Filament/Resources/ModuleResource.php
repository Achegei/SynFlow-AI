<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModuleResource\Pages;
use App\Models\Module;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Modules';

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
            | COURSE RELATION
            |--------------------------------------------------------------------------
            */

            Select::make('course_id')
                ->relationship('course', 'title')
                ->searchable()
                ->required()
                ->label('Course'),

            /*
            |--------------------------------------------------------------------------
            | MODULE INFO
            |--------------------------------------------------------------------------
            */

            TextInput::make('title')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->rows(4)
                ->nullable(),

            TextInput::make('position')
                ->numeric()
                ->default(0)
                ->label('Order'),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('course.title')
                    ->label('Course'),

                TextColumn::make('episodes_count')
                    ->counts('episodes')
                    ->label('Episodes'),

                TextColumn::make('quizzes_count')
                    ->counts('quizzes')
                    ->label('Quizzes'),

                TextColumn::make('assignments_count')
                    ->counts('assignments')
                    ->label('Assignments'),

                TextColumn::make('position')
                    ->sortable()
                    ->label('Order'),
            ])
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
    | RELATION MANAGERS (THIS IS THE MAGIC PART)
    |--------------------------------------------------------------------------
    */

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\ModuleResource\RelationManagers\EpisodesRelationManager::class,
            \App\Filament\Resources\ModuleResource\RelationManagers\QuizzesRelationManager::class,
            \App\Filament\Resources\ModuleResource\RelationManagers\AssignmentsRelationManager::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}