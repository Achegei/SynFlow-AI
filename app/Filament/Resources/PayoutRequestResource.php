<?php

namespace App\Filament\Resources;

use App\Models\PayoutRequest;
use App\Models\Institution;
use App\Models\SalesExecutive;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;

use App\Filament\Resources\PayoutRequestResource\Pages;

class PayoutRequestResource extends Resource
{
    protected static ?string $model = PayoutRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Payout Requests';

    protected static ?string $navigationGroup = 'Finance';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // You can extend later if admin creates payouts manually
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable()
                    ->label('Request ID'),

                BadgeColumn::make('requester_type')
                    ->colors([
                        'primary' => 'institution',
                        'warning' => 'sales_executive',
                    ])
                    ->label('Type'),

                /*
                |--------------------------------------------------------------------------
                | FIXED: Requester Name Resolver
                |--------------------------------------------------------------------------
                */
                TextColumn::make('requester_name')
                    ->label('Requester')
                    ->state(function ($record) {

                        if ($record->requester_type === 'institution') {

                            return Institution::find($record->requester_id)?->name
                                ?? 'Unknown Institution';
                        }

                        if ($record->requester_type === 'sales_executive') {

                            return SalesExecutive::find($record->requester_id)?->name
                                ?? 'Unknown Sales Exec';
                        }

                        return 'Unknown';
                    })
                    ->searchable(),

                TextColumn::make('amount')
                    ->money('KES')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Requested At'),

            ])

            ->actions([

                /*
                |--------------------------------------------------------------------------
                | APPROVE ACTION
                |--------------------------------------------------------------------------
                */
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(function ($record) {

                        if ($record->requester_type === 'institution') {

                            $institution = Institution::find($record->requester_id);

                            if ($institution) {
                                $institution->decrement('wallet_balance', $record->amount);
                            }
                        }

                        if ($record->requester_type === 'sales_executive') {

                            $executive = SalesExecutive::find($record->requester_id);

                            if ($executive) {
                                $executive->decrement('wallet_balance', $record->amount);
                            }
                        }

                        $record->update([
                            'status' => 'approved',
                            'approved_by' => auth()->id(),
                            'processed_at' => now(),
                        ]);
                    }),

                /*
                |--------------------------------------------------------------------------
                | REJECT ACTION
                |--------------------------------------------------------------------------
                */
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(function ($record) {

                        $record->update([
                            'status' => 'rejected',
                        ]);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayoutRequests::route('/'),
        ];
    }
}