<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentReconciliationResource\Pages;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentReconciliationResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass-circle';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?string $navigationLabel = 'Payment Reconciliation';

    protected static ?string $modelLabel = 'Enrollment Payment';

    protected static ?string $pluralModelLabel = 'Enrollment Payments';

    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        return auth()->user()?->is_admin == 1;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereNotNull('course_enrollment_id')
            ->where('status', 'pending')
            ->with(['user', 'courseEnrollment']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Payment ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Student')
                    ->searchable(),

                Tables\Columns\TextColumn::make('course_enrollment_id')
                    ->label('Enrollment ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('api_ref')
                    ->label('API Reference')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('payment_id')
                    ->label('Provider Invoice')
                    ->placeholder('Not received')
                    ->copyable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money('KES')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),

                Tables\Columns\TextColumn::make('recovery_classification')
                    ->label('Investigation Status')
                    ->state(fn (Payment $record): string =>
                        $record->payment_id
                            ? 'Awaiting provider confirmation'
                            : 'Invoice missing — investigate'
                    )
                    ->badge()
                    ->color(fn (Payment $record): string =>
                        $record->payment_id ? 'warning' : 'danger'
                    ),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Attempt Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'asc')
            ->filters([
                Tables\Filters\Filter::make('invoice_missing')
                    ->label('Missing Provider Invoice')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNull('payment_id')
                    ),

                Tables\Filters\Filter::make('invoice_present')
                    ->label('Provider Invoice Available')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('payment_id')
                    ),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentReconciliations::route('/'),
        ];
    }
}
