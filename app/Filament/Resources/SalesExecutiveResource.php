<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesExecutiveResource\Pages;
use App\Models\SalesExecutive;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SalesExecutiveResource extends Resource
{
    protected static ?string $model = SalesExecutive::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Partnership Management';

    protected static ?string $navigationLabel = 'Sales Executives';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Executive Information')
                    ->schema([

                        Forms\Components\Select::make('user_id')
                            ->label('User Account')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('commission_percentage')
                            ->numeric()
                            ->default(10)
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'suspended' => 'Suspended',
                            ])
                            ->default('active')
                            ->required(),

                        Forms\Components\TextInput::make('wallet_balance')
                            ->numeric()
                            ->prefix('KES')
                            ->disabled(),

                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Executive Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('institutions_count')
                    ->counts('institutions')
                    ->label('Institutions'),

                Tables\Columns\TextColumn::make('commission_percentage')
                    ->suffix('%'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'inactive',
                        'danger' => 'suspended',
                    ]),

                Tables\Columns\TextColumn::make('wallet_balance')
                    ->money('KES'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([

                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

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
            'index' => Pages\ListSalesExecutives::route('/'),
            'create' => Pages\CreateSalesExecutive::route('/create'),
            'edit' => Pages\EditSalesExecutive::route('/{record}/edit'),
        ];
    }
}