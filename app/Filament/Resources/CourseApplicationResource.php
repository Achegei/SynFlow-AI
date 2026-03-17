<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseApplicationResource\Pages;
use App\Models\CourseApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CourseApplicationResource extends Resource
{
    protected static ?string $model = CourseApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Recruitment';
    protected static ?string $navigationLabel = 'Course Applications';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->label('Phone Number')
                    ->required(),

                Forms\Components\TextInput::make('city')
                    ->label('City / County'),

                Forms\Components\Select::make('education')
                    ->label('Education Level')
                    ->options([
                        'High School' => 'High School',
                        'College' => 'College',
                        'University' => 'University',
                    ])
                    ->required(),

                Forms\Components\Select::make('has_laptop')
                    ->label('Do you have a laptop?')
                    ->options([
                        'Yes' => 'Yes',
                        'No' => 'No',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('motivation')
                    ->label('Motivation / Why do you want to join?'),

                Forms\Components\Select::make('payment_option')
                    ->label('Payment Option')
                    ->options([
                        'Pay after graduation' => 'Pay after graduation',
                        'Work 30 days (waive balance)' => 'Work 30 days (waive balance)',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('City'),

                Tables\Columns\TextColumn::make('education')
                    ->label('Education'),

                Tables\Columns\TextColumn::make('has_laptop')
                    ->label('Laptop'),

                Tables\Columns\TextColumn::make('payment_option')
                    ->label('Payment Option'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Applied At')
                    ->dateTime()
                    ->sortable(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseApplications::route('/'),
            'create' => Pages\CreateCourseApplication::route('/create'),
            'edit' => Pages\EditCourseApplication::route('/{record}/edit'),
        ];
    }
}