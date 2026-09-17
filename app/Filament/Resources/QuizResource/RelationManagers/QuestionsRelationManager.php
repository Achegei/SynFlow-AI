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
                Forms\Components\Select::make('type')
                    ->label('Question Type')
                    ->options([
                        'multiple_choice' => 'Multiple Choice',
                        'short_answer' => 'Short Answer',
                        'practical' => 'Practical',
                    ])
                    ->default('multiple_choice')
                    ->required()
                    ->live(),

                Forms\Components\Textarea::make('question')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('options.A')
                    ->label('Option A')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice')
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice'),

                Forms\Components\TextInput::make('options.B')
                    ->label('Option B')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice')
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice'),

                Forms\Components\TextInput::make('options.C')
                    ->label('Option C')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice')
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice'),

                Forms\Components\TextInput::make('options.D')
                    ->label('Option D')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice')
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice'),

                Forms\Components\Select::make('correct_answer')
                    ->label('Correct Answer')
                    ->options([
                        'A' => 'Option A',
                        'B' => 'Option B',
                        'C' => 'Option C',
                        'D' => 'Option D',
                    ])
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice')
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'multiple_choice'),

                Forms\Components\TextInput::make('max_points')
                    ->label('Maximum Points')
                    ->numeric()
                    ->minValue(0.01)
                    ->step(0.01)
                    ->default(1)
                    ->required(),

                Forms\Components\TextInput::make('position')
                    ->label('Order')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('question')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'multiple_choice' => 'Multiple Choice',
                            'short_answer' => 'Short Answer',
                            'practical' => 'Practical',
                            default => ucfirst(str_replace('_', ' ', (string) $state)),
                        }
                    ),

                Tables\Columns\TextColumn::make('max_points')
                    ->label('Points'),

                Tables\Columns\TextColumn::make('correct_answer')
                    ->label('Correct Answer')
                    ->placeholder('Manual review'),
            ])
            ->defaultSort('position')
            ->reorderable('position')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => $this->normalizeQuestionData($data)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => $this->normalizeQuestionData($data)),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    /**
     * Remove multiple-choice data when a question requires manual review.
     */
    private function normalizeQuestionData(array $data): array
    {
        if (($data['type'] ?? 'multiple_choice') !== 'multiple_choice') {
            $data['options'] = null;
            $data['correct_answer'] = null;
        }

        return $data;
    }
}
