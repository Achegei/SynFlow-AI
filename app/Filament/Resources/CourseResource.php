<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms\Components\HasManyRepeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;                     // <-- correct Form import
use Filament\Resources\Resource;
use Filament\Tables\Table;                    // <-- correct Table import
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

            // Inline episodes editor (HasManyRepeaters)
            HasManyRepeater::make('episodes')
                ->relationship('episodes') // MUST match Course::episodes()
                ->createItemButtonLabel('Add Episode')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('video_url')
                        ->required()
                        ->url()
                        ->maxLength(2048),
                ])
                ->columns(1)
                ->collapsed(false)
                //->orderable(), // optional UI ordering
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#')->sortable(),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('created_at')->label('Created')->dateTime('M d, Y'),
            ])
            ->filters([
                //
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
