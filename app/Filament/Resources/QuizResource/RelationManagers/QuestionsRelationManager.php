<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    protected static ?string $recordTitleAttribute = 'question';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | QUESTION
                |--------------------------------------------------------------------------
                */
                Forms\Components\Textarea::make('question')
                    ->required()
                    ->rows(3),

                /*
                |--------------------------------------------------------------------------
                | OPTIONS (CLEAN JSON BINDING)
                |--------------------------------------------------------------------------
                */
                Forms\Components\TextInput::make('options.A')
                    ->label('Option A')
                    ->required(),

                Forms\Components\TextInput::make('options.B')
                    ->label('Option B')
                    ->required(),

                Forms\Components\TextInput::make('options.C')
                    ->label('Option C')
                    ->required(),

                Forms\Components\TextInput::make('options.D')
                    ->label('Option D')
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | CORRECT ANSWER
                |--------------------------------------------------------------------------
                */
                Forms\Components\Select::make('correct_answer')
                    ->options([
                        'A' => 'Option A',
                        'B' => 'Option B',
                        'C' => 'Option C',
                        'D' => 'Option D',
                    ])
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | POSITION
                |--------------------------------------------------------------------------
                */
                Forms\Components\TextInput::make('position')
                    ->numeric()
                    ->default(0),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')->limit(50),
                Tables\Columns\TextColumn::make('correct_answer'),
                Tables\Columns\TextColumn::make('position'),
            ])
            ->defaultSort('position')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}