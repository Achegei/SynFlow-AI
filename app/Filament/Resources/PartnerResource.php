<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers\CertificateRequestsRelationManager;
use App\Mail\PartnerWelcomeMail;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PartnerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Partners';
    protected static ?string $navigationGroup = 'Partners Management';
    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('partnership_status')
                    ->label('Partnership Status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'suspended' => 'Suspended',
                    ])
                    ->required()
                    ->default('pending'),

                Forms\Components\TextInput::make('referral_code')
                    ->label('Referral Code')
                    ->disabled(),

                Forms\Components\TextInput::make('password_plain')
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                    ->maxLength(255)
                    ->helperText('Leave blank to keep current password'),

                Forms\Components\Hidden::make('role')
                    ->default('partner'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('partnership_status')
                    ->label('Partnership Status')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined At')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CertificateRequestsRelationManager::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'partner');
    }

    // Sidebar visibility
    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'admin';
    }

    public static function canCreate(): bool
    {
        return auth()->user()->role === 'admin';
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->role === 'admin';
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->role === 'admin';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }

    public static function beforeCreate(array $data): array
    {
        $plainPassword = $data['password_plain'] ?? Str::random(12);
        $data['password'] = Hash::make($plainPassword);
        // Ensure partnership_status is set (default to pending if missing)
        $data['partnership_status'] = 'active';

        Mail::to($data['email'])->send(new PartnerWelcomeMail($data['name'], $data['email'], $plainPassword));

        return $data;
    }

    public static function beforeSave($record, array $data): array
    {
        if (!empty($data['password_plain'])) {
            $data['password'] = Hash::make($data['password_plain']);
            Mail::to($record->email)->send(new PartnerWelcomeMail($record->name, $record->email, $data['password_plain']));
        }

        unset($data['password_plain']);

        return $data;
    }
}