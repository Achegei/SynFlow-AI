<?php

namespace App\Filament\Resources\EpisodeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BlocksRelationManager extends RelationManager
{
    protected static string $relationship = 'blocks';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = 'Lesson Content';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->options([
                    'text' => 'Text',
                    'prompt' => 'Prompt',
                    'code' => 'Code',
                    'activity' => 'Activity',
                    'tip' => 'Tip',
                    'warning' => 'Warning',
                    'download' => 'Download',
                    'image' => 'Image',
                    'video' => 'Video',
                ])
                ->required(),

            Forms\Components\TextInput::make('title')
                ->maxLength(255)
                ->nullable(),

            Forms\Components\Textarea::make('content')
                ->rows(10)
                ->columnSpanFull()
                ->nullable(),

            Forms\Components\KeyValue::make('metadata')
                ->label('Metadata')
                ->keyLabel('Key')
                ->valueLabel('Value')
                ->addActionLabel('Add metadata')
                ->columnSpanFull()
                ->nullable(),

            Forms\Components\TextInput::make('position')
                ->label('Order')
                ->numeric()
                ->default(0)
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->placeholder('Untitled'),

                Tables\Columns\TextColumn::make('content')
                    ->limit(70)
                    ->wrap(),
            ])
            ->defaultSort('position')
            ->reorderable('position')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
