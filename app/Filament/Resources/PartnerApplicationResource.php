<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerApplicationResource\Pages;
use App\Mail\PartnerWelcomeMail;
use App\Models\User;
use App\Models\PartnerApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PartnerApplicationResource extends Resource
{
    protected static ?string $model = PartnerApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Full Name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone'),
                Forms\Components\TextInput::make('city')
                    ->label('City'),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'suspended' => 'Suspended',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Full Name')->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Applied On')->dateTime(),
            ])
            ->actions([
                TableAction::make('approve')
                    ->label('Approve & Create Partner')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->action(function (PartnerApplication $record) {

                        if (User::where('email', $record->email)->exists()) {
                            Notification::make()
                                ->title('Partner already exists!')
                                ->warning()
                                ->send();
                            return;
                        }

                        // Generate a random password
                        $plainPassword = Str::random(12);

                        // Create the new partner
                        $user = User::create([
                            'name' => $record->name,
                            'email' => $record->email,
                            'phone' => $record->phone,
                            'city' => $record->city,
                            'role' => 'partner',
                            'password' => Hash::make($plainPassword),
                            'referral_code' => 'ML-' . strtoupper(Str::random(5)),
                            'partnership_status' => 'active',
                        ]);

                        // Update application status
                        $record->update(['status' => 'approved']);

                        // Send password to partner via email
                        Mail::to($user->email)->send(new PartnerWelcomeMail($user, $plainPassword));

                        // Notify admin
                        Notification::make()
                            ->title("Partner created. Password sent to {$user->email}")
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartnerApplications::route('/'),
            'edit' => Pages\EditPartnerApplication::route('/{record}/edit'),
        ];
    }
}