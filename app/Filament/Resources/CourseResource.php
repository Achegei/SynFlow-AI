<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\HasManyRepeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Courses';
    protected static ?string $pluralLabel = 'Courses';
    protected static ?string $slug = 'courses';

    public static function form(Form $form): Form
    {
        return $form->schema([

            /**
             * COURSE INFO
             */
            TextInput::make('title')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->rows(4)
                ->required(),

            TextInput::make('image_url')
                ->label('Image URL')
                ->url()
                ->nullable(),

            /**
             * =========================
             * MODULES (CORE STRUCTURE)
             * =========================
             */
            HasManyRepeater::make('modules')
                ->relationship('modules')
                ->label('Course Modules')
                ->createItemButtonLabel('Add Module')
                ->schema([

                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->rows(3)
                        ->nullable(),

                    TextInput::make('position')
                        ->numeric()
                        ->default(0),

                    /**
                     * =========================
                     * EPISODES (LESSONS)
                     * =========================
                     */
                    HasManyRepeater::make('episodes')
                        ->relationship('episodes')
                        ->label('Lessons')
                        ->createItemButtonLabel('Add Lesson')
                        ->schema([

                            TextInput::make('title')
                                ->required()
                                ->maxLength(255),

                            Textarea::make('description')
                                ->rows(3)
                                ->nullable(),

                            Select::make('type')
                                ->options([
                                    'video' => 'Video',
                                    'reading' => 'Reading',
                                ])
                                ->default('video')
                                ->required(),

                            TextInput::make('video_url')
                                ->label('YouTube URL')
                                ->url()
                                ->nullable(),

                            FileUpload::make('pdf_path')
                                ->label('PDF Notes')
                                ->directory('episodes/pdfs')
                                ->preserveFilenames()
                                ->acceptedFileTypes(['application/pdf'])
                                ->nullable(),

                            TextInput::make('position')
                                ->numeric()
                                ->default(0),

                        ])
                        ->columns(2)
                        ->collapsed(false),

                    /**
                     * =========================
                     * QUIZZES (NEW)
                     * =========================
                     */
                    HasManyRepeater::make('quizzes')
    ->relationship('quizzes')
    ->label('Module Quizzes')
    ->createItemButtonLabel('Add Quiz')
    ->schema([

        /*
        |--------------------------------------------------------------------------
        | QUIZ INFO
        |--------------------------------------------------------------------------
        */

        TextInput::make('title')
            ->required()
            ->maxLength(255),

        Textarea::make('description')
            ->rows(3)
            ->nullable(),

        TextInput::make('position')
            ->numeric()
            ->default(0),

        /*
        |--------------------------------------------------------------------------
        | QUIZ QUESTIONS
        |--------------------------------------------------------------------------
        */

        HasManyRepeater::make('questions')
            ->relationship('questions')
            ->label('Quiz Questions')
            ->createItemButtonLabel('Add Question')
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | QUESTION
                |--------------------------------------------------------------------------
                */

                Textarea::make('question')
                    ->label('Question')
                    ->rows(3)
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | OPTIONS
                |--------------------------------------------------------------------------
                */

                TextInput::make('option_a')
                    ->label('Option A')
                    ->required()
                    ->afterStateHydrated(function ($component, $state, $record) {

                        if ($record && $record->options) {
                            $options = json_decode($record->options, true);
                            $component->state($options[0] ?? '');
                        }
                    }),

                TextInput::make('option_b')
                    ->label('Option B')
                    ->required()
                    ->afterStateHydrated(function ($component, $state, $record) {

                        if ($record && $record->options) {
                            $options = json_decode($record->options, true);
                            $component->state($options[1] ?? '');
                        }
                    }),

                TextInput::make('option_c')
                    ->label('Option C')
                    ->required()
                    ->afterStateHydrated(function ($component, $state, $record) {

                        if ($record && $record->options) {
                            $options = json_decode($record->options, true);
                            $component->state($options[2] ?? '');
                        }
                    }),

                TextInput::make('option_d')
                    ->label('Option D')
                    ->required()
                    ->afterStateHydrated(function ($component, $state, $record) {

                        if ($record && $record->options) {
                            $options = json_decode($record->options, true);
                            $component->state($options[3] ?? '');
                        }
                    }),

                /*
                |--------------------------------------------------------------------------
                | CORRECT ANSWER
                |--------------------------------------------------------------------------
                */

                Select::make('correct_answer')
                    ->options(function ($get) {

                        return array_filter([
                            $get('option_a') => 'Option A',
                            $get('option_b') => 'Option B',
                            $get('option_c') => 'Option C',
                            $get('option_d') => 'Option D',
                        ]);
                    })
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | POSITION
                |--------------------------------------------------------------------------
                */

                TextInput::make('position')
                    ->numeric()
                    ->default(0),

            ])
            ->mutateRelationshipDataBeforeCreateUsing(function ($data) {

                $data['options'] = json_encode([
                    $data['option_a'],
                    $data['option_b'],
                    $data['option_c'],
                    $data['option_d'],
                ]);

                unset(
                    $data['option_a'],
                    $data['option_b'],
                    $data['option_c'],
                    $data['option_d']
                );

                return $data;
            })
            ->mutateRelationshipDataBeforeSaveUsing(function ($data) {

                $data['options'] = json_encode([
                    $data['option_a'],
                    $data['option_b'],
                    $data['option_c'],
                    $data['option_d'],
                ]);

                unset(
                    $data['option_a'],
                    $data['option_b'],
                    $data['option_c'],
                    $data['option_d']
                );

                return $data;
            })
            ->collapsed(false)

    ])
    ->collapsed(false),

                    /**
                     * =========================
                     * ASSIGNMENTS (NEW)
                     * =========================
                     */
                    HasManyRepeater::make('assignments')
                        ->relationship('assignments')
                        ->label('Module Assignments')
                        ->createItemButtonLabel('Add Assignment')
                        ->schema([

                            TextInput::make('title')
                                ->required()
                                ->maxLength(255),

                            Textarea::make('instructions')
                                ->rows(4)
                                ->required(),

                            Select::make('submission_type')
                                ->options([
                                    'file' => 'File Upload',
                                    'text' => 'Text Answer',
                                    'link' => 'Link Submission',
                                ])
                                ->default('file')
                                ->required(),

                            TextInput::make('position')
                                ->numeric()
                                ->default(0),

                        ])
                        ->collapsed(false),

                ])
                ->collapsed(false),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit'   => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}