<?php

namespace App\Filament\Resources\PartnerResource\RelationManagers;

use App\Models\CertificateRequest;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class CertificateRequestsRelationManager extends RelationManager
{
    protected static string $relationship = 'certificateRequests';
    protected static ?string $recordTitleAttribute = 'id';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('student_count')
                    ->label('Student Count')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                    ])
                    ->required(),
                Forms\Components\Select::make('certificate_status')
                    ->label('Certificate Status')
                    ->options([
                        'pending' => 'Pending',
                        'printing' => 'Printing',
                        'shipped' => 'Shipped',
                        'issued' => 'Issued',
                    ])
                    ->required(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student_count'),
                Tables\Columns\TextColumn::make('total_amount')->money('KES'),
                Tables\Columns\TextColumn::make('payment_status')->sortable(),
                Tables\Columns\TextColumn::make('certificate_status')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('M d, Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}