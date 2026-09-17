<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizAttemptResource\Pages;
use App\Models\QuizAttempt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class QuizAttemptResource extends Resource
{
    protected static ?string $model = QuizAttempt::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Learning Management';

    protected static ?string $navigationLabel = 'Examination Reviews';

    protected static ?string $modelLabel = 'Examination Review';

    protected static ?string $pluralModelLabel = 'Examination Reviews';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Examination Submission')
                    ->schema([
                        Forms\Components\Placeholder::make('learner')
                            ->label('Learner')
                            ->content(
                                fn (?QuizAttempt $record): string =>
                                    $record?->user?->name ?? 'Unknown learner'
                            ),

                        Forms\Components\Placeholder::make('email')
                            ->label('Email')
                            ->content(
                                fn (?QuizAttempt $record): string =>
                                    $record?->user?->email ?? '—'
                            ),

                        Forms\Components\Placeholder::make('course')
                            ->label('Course')
                            ->content(
                                fn (?QuizAttempt $record): string =>
                                    $record?->quiz?->module?->course?->title ?? '—'
                            ),

                        Forms\Components\Placeholder::make('examination')
                            ->label('Examination')
                            ->content(
                                fn (?QuizAttempt $record): string =>
                                    $record?->quiz?->title ?? '—'
                            ),

                        Forms\Components\Placeholder::make('submission_status')
                            ->label('Status')
                            ->content(
                                fn (?QuizAttempt $record): string => match ($record?->status) {
                                    'pending_review' => 'Pending Review',
                                    'reviewed' => 'Reviewed',
                                    'graded' => 'Graded',
                                    default => ucfirst(
                                        str_replace('_', ' ', (string) $record?->status)
                                    ),
                                }
                            ),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Answers & Grading')
                    ->description(
                        'Multiple-choice answers are automatically graded. '
                        . 'Review written and practical responses and award points up to the maximum shown.'
                    )
                    ->schema([
                        Forms\Components\Repeater::make('review_answers')
                            ->label('')
                            ->schema([
                                Forms\Components\Hidden::make('answer_id'),

                                Forms\Components\Hidden::make('auto_graded'),

                                Forms\Components\Hidden::make('max_points'),

                                Forms\Components\Textarea::make('question')
                                    ->label('Question')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('question_type')
                                    ->label('Question Type')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\TextInput::make('maximum_points_display')
                                    ->label('Maximum Points')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\Textarea::make('learner_answer')
                                    ->label('Learner Answer')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->rows(5)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('points_awarded')
                                    ->label('Points Awarded')
                                    ->numeric()
                                    ->minValue(0)
                                    ->step(0.01)
                                    ->required(
                                        fn (Forms\Get $get): bool =>
                                            ! (bool) $get('auto_graded')
                                    )
                                    ->disabled(
                                        fn (Forms\Get $get): bool =>
                                            (bool) $get('auto_graded')
                                    )
                                    ->maxValue(
                                        fn (Forms\Get $get): float =>
                                            (float) ($get('max_points') ?? 0)
                                    ),

                                Forms\Components\Textarea::make('review_feedback')
                                    ->label('Reviewer Feedback')
                                    ->rows(3)
                                    ->disabled(
                                        fn (Forms\Get $get): bool =>
                                            (bool) $get('auto_graded')
                                    )
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn (Builder $query) => $query->with([
                    'user',
                    'quiz.module.course',
                ])
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Learner')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('quiz.module.course.title')
                    ->label('Course')
                    ->limit(40),

                Tables\Columns\TextColumn::make('quiz.title')
                    ->label('Examination')
                    ->searchable()
                    ->limit(45),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'pending_review' => 'Pending Review',
                            'graded' => 'Graded',
                            'reviewed' => 'Reviewed',
                            default => ucfirst(str_replace('_', ' ', (string) $state)),
                        }
                    )
                    ->badge(),

                Tables\Columns\TextColumn::make('score')
                    ->label('Score')
                    ->formatStateUsing(
                        fn ($state, QuizAttempt $record): string =>
                            $record->status === 'pending_review'
                                ? 'Pending'
                                : ((string) $state . '%')
                    ),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending_review' => 'Pending Review',
                        'reviewed' => 'Reviewed',
                        'graded' => 'Graded',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Review'),
            ])
            ->bulkActions([]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('quiz.questions', function (Builder $query) {
                $query->whereIn('type', [
                    'short_answer',
                    'practical',
                ]);
            });
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizAttempts::route('/'),
            'edit' => Pages\EditQuizAttempt::route('/{record}/edit'),
        ];
    }
}
