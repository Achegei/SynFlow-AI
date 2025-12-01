<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope'; // outline envelope icon
    protected static ?string $navigationLabel = 'Contact Submissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->disabled()->required(),
                Forms\Components\TextInput::make('email')->disabled()->required(),
                Forms\Components\TextInput::make('role')->disabled(),
                Forms\Components\TextInput::make('company_name')->disabled(),
                Forms\Components\TextInput::make('company_website')->disabled(),
                Forms\Components\TextInput::make('company_size')->disabled(),
                Forms\Components\TextInput::make('revenue')->disabled(),
                Forms\Components\TextInput::make('budget')->disabled(),
                Forms\Components\Textarea::make('services')->disabled(),
                Forms\Components\Textarea::make('message')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('company_name'),
                Tables\Columns\TextColumn::make('company_size'),
                Tables\Columns\TextColumn::make('revenue'),
                Tables\Columns\TextColumn::make('budget'),
                Tables\Columns\TextColumn::make('services')->limit(50),
                Tables\Columns\TextColumn::make('message')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->dateTime('M d, Y H:i')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // allows admin to view full record
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
