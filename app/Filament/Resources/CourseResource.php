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
             * MODULES
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
                     * EPISODES (LESSONS)
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
                                    'quiz' => 'Quiz',
                                    'assignment' => 'Assignment',
                                    'reading' => 'Reading',
                                    'project' => 'Project',
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