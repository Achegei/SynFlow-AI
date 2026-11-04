<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // Filament navigation settings
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $navigationGroup = 'Accounts'; // optional grouping
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 1; 

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

                Forms\Components\TextInput::make('referral_code')
                    ->label('Referral Code')
                    ->disabled(),

                Forms\Components\Select::make('referred_by')
                    ->label('Referred By')
                    ->relationship('referrer', 'name') // proper relationship usage
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('is_active')
                    ->label('Account Status')
                    ->formatStateUsing(
                        fn ($state): string => $state ? 'Active' : 'Inactive'
                    )
                    ->badge()
                    ->color(
                        fn ($state): string => $state ? 'success' : 'danger'
                    )
                    ->sortable(),

                TextColumn::make('referral_code')
                    ->label('Referral Code')
                    ->sortable(),

                TextColumn::make('referred_by')
                    ->label('Referred By')
                    ->getStateUsing(fn ($record) => $record->referrer?->name)
                    ->sortable(),

                TextColumn::make('referredUsers')
                    ->label('Referred Users')
                    ->getStateUsing(fn ($record) => $record->referredUsers()->count())
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Registered At')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                // add filters if needed
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('deactivate')
                    ->label('Deactivate')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (User $record): bool =>
                        (bool) $record->is_active
                        && $record->getKey() !== auth()->id()
                    )
                    ->action(function (User $record): void {
                        $result = \Illuminate\Support\Facades\DB::transaction(
                            function () use ($record): string {
                                // Serialize account-status changes using a shared row.
                                User::query()
                                    ->where('is_admin', 1)
                                    ->orderBy('id')
                                    ->lockForUpdate()
                                    ->get(['id', 'is_admin', 'is_active']);

                                $target = User::query()
                                    ->whereKey($record->getKey())
                                    ->first();

                                if (! $target) {
                                    return 'missing';
                                }

                                if ($target->getKey() === auth()->id()) {
                                    return 'self';
                                }

                                if (! (bool) $target->is_active) {
                                    return 'already_inactive';
                                }

                                if (
                                    (bool) $target->is_admin
                                    && User::query()
                                        ->where('is_admin', 1)
                                        ->where('is_active', true)
                                        ->whereKeyNot($target->getKey())
                                        ->doesntExist()
                                ) {
                                    return 'last_admin';
                                }

                                $target->update(['is_active' => false]);

                                return 'deactivated';
                            }
                        );

                        $notification = \Filament\Notifications\Notification::make();

                        if ($result === 'deactivated') {
                            $notification->title('Account deactivated')->success();
                        } elseif ($result === 'last_admin') {
                            $notification->title('Cannot deactivate the last active administrator')->danger();
                        } else {
                            $notification->title('Account could not be deactivated')->warning();
                        }

                        $notification->send();
                    }),

                Tables\Actions\Action::make('reactivate')
                    ->label('Reactivate')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (User $record): bool =>
                        ! (bool) $record->is_active
                    )
                    ->action(function (User $record): void {
                        $record->update(['is_active' => true]);

                        \Filament\Notifications\Notification::make()
                            ->title('Account reactivated')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([]);
    }


    /**
     * Prevent deletion of accounts with protected records.
     */
    public static function canDelete(Model $record): bool
    {
        // Permanent account deletion is disabled.
        // Preserve enrollment, payment, commission and certificate history.
        return false;
    }

    /**
     * Bulk deletion is disabled to protect learner records.
     */
    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
