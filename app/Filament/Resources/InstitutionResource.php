<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstitutionResource\Pages;
use App\Models\Institution;
use App\Models\SalesExecutive;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use App\Models\User;

class InstitutionResource extends Resource
{
    protected static ?string $model = Institution::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Partnership Management';

    protected static ?string $navigationLabel = 'Institutions';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([

            // ===================== Institution Info =====================
            Forms\Components\Section::make('Institution Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('referral_code')
                        ->nullable()
                        ->unique(ignoreRecord: true),
                ])->columns(3),

            // ===================== ADMIN =====================
Forms\Components\TextInput::make('admin_name')
    ->label('Admin Name')
    ->required()
    ->dehydrated(fn ($livewire) => $livewire instanceof \App\Filament\Resources\InstitutionResource\Pages\CreateInstitution)
    ->afterStateHydrated(function ($component, $record) {
        if ($record?->admin) {
            $component->state($record->admin->name);
        }
    }),

Forms\Components\TextInput::make('admin_email')
    ->label('Admin Email')
    ->email()
    ->required()
    ->dehydrated(fn ($livewire) => $livewire instanceof \App\Filament\Resources\InstitutionResource\Pages\CreateInstitution)
    ->afterStateHydrated(function ($component, $record) {
        if ($record?->admin) {
            $component->state($record->admin->email);
        }
    }),

Forms\Components\TextInput::make('admin_password')
    ->label('Admin Password')
    ->password()
    ->revealable()
    ->required(fn ($livewire) => $livewire instanceof \App\Filament\Resources\InstitutionResource\Pages\CreateInstitution)
    ->dehydrated(fn ($livewire) => $livewire instanceof \App\Filament\Resources\InstitutionResource\Pages\CreateInstitution)
    ->placeholder('Leave blank to keep current password'),

            // ===================== CONTACT =====================
            Forms\Components\Section::make('Contact Information')
                ->schema([
                    Forms\Components\TextInput::make('contact_person')->required(),
                    Forms\Components\TextInput::make('email')->email()->required(),
                    Forms\Components\TextInput::make('phone')->tel()->required(),
                ])->columns(3),

            // ===================== SALES =====================
            Forms\Components\Section::make('Sales Executive Assignment')
                ->schema([
                    Forms\Components\Select::make('sales_executive_id')
                        ->options(
                            SalesExecutive::with('user')
                                ->get()
                                ->mapWithKeys(fn ($exec) => [
                                    $exec->id => ($exec->user?->name ?? 'Unknown')
                                ])
                        )
                        ->searchable()
                        ->preload()
                        ->nullable(),
                ]),

            // ===================== PUBLIC PARTNERSHIP PROFILE =====================
            Forms\Components\Section::make('Public Partnership Profile')
                ->description(
                    'Manage how this institution appears on the public homepage. '
                    . 'Changes here do not affect institutional accounts or commissions.'
                )
                ->schema([
                    Forms\Components\FileUpload::make('logo_path')
                        ->label('Institution Logo')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('institution-logos')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->helperText('Upload the official institution logo. Maximum 2 MB.'),

                    Forms\Components\TextInput::make('website_url')
                        ->label('Institution Website')
                        ->url()
                        ->maxLength(255)
                        ->placeholder('https://example.org'),

                    Forms\Components\Textarea::make('public_description')
                        ->label('Public Description')
                        ->rows(3)
                        ->maxLength(1000)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('display_order')
                        ->label('Display Order')
                        ->numeric()
                        ->integer()
                        ->minValue(0)
                        ->default(0)
                        ->required(),

                    Forms\Components\Toggle::make('show_on_homepage')
                        ->label('Show on Homepage')
                        ->default(false)
                        ->helperText(
                            'Enable only after confirming that the institution '
                            . 'has approved public partnership recognition.'
                        ),
                ])
                ->columns(2),

            // ===================== STATUS =====================
            Forms\Components\Section::make('Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'active' => 'Active',
                            'suspended' => 'Suspended',
                        ])
                        ->default('active')
                        ->required(),

                    Forms\Components\TextInput::make('wallet_balance')
                        ->numeric()
                        ->prefix('KES')
                        ->disabled()
                        ->default(0),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),

                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Institution Admin')
                    ->placeholder('No Admin'),

                Tables\Columns\TextColumn::make('salesExecutive.user.name')
                    ->label('Sales Executive')
                    ->badge()
                    ->color('primary')
                    ->placeholder('Unassigned'),

                Tables\Columns\TextColumn::make('referral_code')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),

                Tables\Columns\TextColumn::make('wallet_balance')
                    ->money('KES'),

                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstitutions::route('/'),
            'create' => Pages\CreateInstitution::route('/create'),
            'edit' => Pages\EditInstitution::route('/{record}/edit'),
        ];
    }
}