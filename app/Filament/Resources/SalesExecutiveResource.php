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

                        Forms\Components\Radio::make('account_mode')
                            ->label('Account Setup')
                            ->options([
                                'new' => 'Create New User Account',
                                'existing' => 'Link Existing User',
                            ])
                            ->default('new')
                            ->live()
                            ->required()
                            ->visible(fn ($livewire) => $livewire instanceof Pages\CreateSalesExecutive)
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('new_user_name')
                            ->label('Full Name')
                            ->required(fn (Forms\Get $get) => $get('account_mode') === 'new')
                            ->maxLength(255)
                            ->visible(fn (Forms\Get $get, $livewire) =>
                                $livewire instanceof Pages\CreateSalesExecutive
                                && $get('account_mode') === 'new'
                            ),

                        Forms\Components\TextInput::make('new_user_email')
                            ->label('Email Address')
                            ->email()
                            ->required(fn (Forms\Get $get) => $get('account_mode') === 'new')
                            ->unique('users', 'email')
                            ->maxLength(255)
                            ->visible(fn (Forms\Get $get, $livewire) =>
                                $livewire instanceof Pages\CreateSalesExecutive
                                && $get('account_mode') === 'new'
                            ),

                        Forms\Components\TextInput::make('new_user_password')
                            ->label('Temporary Password')
                            ->password()
                            ->required(fn (Forms\Get $get) => $get('account_mode') === 'new')
                            ->minLength(8)
                            ->confirmed()
                            ->visible(fn (Forms\Get $get, $livewire) =>
                                $livewire instanceof Pages\CreateSalesExecutive
                                && $get('account_mode') === 'new'
                            ),

                        Forms\Components\TextInput::make('new_user_password_confirmation')
                            ->label('Confirm Temporary Password')
                            ->password()
                            ->required(fn (Forms\Get $get) => $get('account_mode') === 'new')
                            ->visible(fn (Forms\Get $get, $livewire) =>
                                $livewire instanceof Pages\CreateSalesExecutive
                                && $get('account_mode') === 'new'
                            ),

                        Forms\Components\Select::make('user_id')
                            ->label('Existing User Account')
                            ->relationship(
                                'user',
                                'name',
                                modifyQueryUsing: fn ($query) => $query
                                    ->where('is_admin', false)
                                    ->whereNull('institution_id')
                                    ->whereNotIn('role', ['admin', 'institution_admin'])
                                    ->whereNotIn(
                                        'id',
                                        SalesExecutive::query()->select('user_id')
                                    )
                            )
                            ->searchable()
                            ->preload()
                            ->required(fn (Forms\Get $get) => $get('account_mode') === 'existing')
                            ->visible(fn (Forms\Get $get, $livewire) =>
                                $livewire instanceof Pages\CreateSalesExecutive
                                && $get('account_mode') === 'existing'
                            ),

                        Forms\Components\Placeholder::make('enrollment_commission')
                            ->label('Paid Enrollment Commission')
                            ->content(
                                'KES ' . number_format(
                                    (float) config('enrollment.sales_commission'),
                                    2
                                ) . ' per qualifying paid student enrollment'
                            ),

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

                Tables\Columns\TextColumn::make('enrollment_commission')
                    ->label('Enrollment Commission')
                    ->state(
                        fn () => (float) config('enrollment.sales_commission')
                    )
                    ->money('KES'),

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