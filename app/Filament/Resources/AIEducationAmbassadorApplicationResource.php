<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AIEducationAmbassadorApplicationResource\Pages;
use App\Models\AIEducationAmbassadorApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AIEducationAmbassadorApplicationResource extends Resource
{
    protected static ?string $model = AIEducationAmbassadorApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'AI Ambassador Applications';

    protected static ?string $navigationGroup = 'Recruitment';

    protected static ?string $modelLabel = 'AI Education Ambassador Application';

    protected static ?string $pluralModelLabel = 'AI Education Ambassador Applications';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Application')
                    ->description('Applicant identification and recruitment status.')
                    ->schema([
                        Forms\Components\TextInput::make('application_reference')
                            ->label('Application Reference')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Select::make('status')
                            ->label('Application Status')
                            ->options([
                                'new' => 'New',
                                'under_review' => 'Under Review',
                                'shortlisted' => 'Shortlisted',
                                'interview' => 'Interview',
                                'accepted' => 'Accepted',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\DateTimePicker::make('reviewed_at')
                            ->label('Reviewed At')
                            ->seconds(false),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone_whatsapp')
                            ->label('Phone / WhatsApp')
                            ->required()
                            ->maxLength(50),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Employment & Institution')
                    ->schema([
                        Forms\Components\Toggle::make('employed_by_educational_institution')
                            ->label('Currently employed by an educational institution in Kenya?')
                            ->disabled(),

                        Forms\Components\Select::make('institution_type')
                            ->label('Institution Type')
                            ->options([
                                'High School' => 'High School',
                                'College / TVET' => 'College / TVET',
                                'University' => 'University',
                                'Other Educational Institution' => 'Other Educational Institution',
                            ])
                            ->native(false),

                        Forms\Components\TextInput::make('institution_name')
                            ->label('Institution Name')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('city')
                            ->label('City / Town')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('county')
                            ->label('County')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('current_position')
                            ->label('Current Position / Title')
                            ->maxLength(255),

                        Forms\Components\Select::make('tenure')
                            ->label('Length of Service')
                            ->options([
                                'Less than 1 year' => 'Less than 1 year',
                                '1–3 years' => '1–3 years',
                                '4–6 years' => '4–6 years',
                                '7+ years' => '7+ years',
                            ])
                            ->native(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Institutional Access')
                    ->description("Information about the applicant's ability to reach institutional decision-makers.")
                    ->schema([
                        Forms\Components\Select::make('leadership_access')
                            ->label('Leadership Access')
                            ->options([
                                'Yes, I have direct access' => 'Yes, I have direct access',
                                'Yes, I can arrange an introduction' => 'Yes, I can arrange an introduction',
                                'Possibly, with some assistance' => 'Possibly, with some assistance',
                                'No' => 'No',
                            ])
                            ->native(false),

                        Forms\Components\CheckboxList::make('leadership_types')
                            ->label('Institutional Leaders They Can Introduce')
                            ->options([
                                'Principal / Headteacher' => 'Principal / Headteacher',
                                'Director / Management' => 'Director / Management',
                                'Dean / Faculty Leadership' => 'Dean / Faculty Leadership',
                                'Head of Department' => 'Head of Department',
                                'Vice-Chancellor / University Leadership' => 'Vice-Chancellor / University Leadership',
                                'ICT / Training Leadership' => 'ICT / Training Leadership',
                            ])
                            ->columns(2),

                        Forms\Components\Textarea::make('decision_maker_details')
                            ->label('Other Relevant Decision-Maker')
                            ->helperText('Name, position or any additional decision-maker information supplied by the applicant.')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Partnership Approach')
                    ->schema([
                        Forms\Components\Textarea::make('introduction_plan')
                            ->label('Applicant Partnership Approach')
                            ->rows(7)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Internal Review')
                    ->schema([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Internal Admin Notes')
                            ->helperText('For internal recruitment use only. These notes are not visible to the applicant.')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('application_reference')
                    ->label('Reference')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Applicant')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('institution_name')
                    ->label('Institution')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('institution_type')
                    ->label('Type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('current_position')
                    ->label('Position')
                    ->searchable()
                    ->limit(25),

                Tables\Columns\TextColumn::make('county')
                    ->label('County')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('leadership_access')
                    ->label('Leadership Access')
                    ->badge()
                    ->wrap(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'New',
                        'under_review' => 'Under Review',
                        'shortlisted' => 'Shortlisted',
                        'interview' => 'Interview',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        default => ucfirst(str_replace('_', ' ', $state)),
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'under_review' => 'Under Review',
                        'shortlisted' => 'Shortlisted',
                        'interview' => 'Interview',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ]),

                Tables\Filters\SelectFilter::make('institution_type')
                    ->label('Institution Type')
                    ->options([
                        'High School' => 'High School',
                        'College / TVET' => 'College / TVET',
                        'University' => 'University',
                        'Other Educational Institution' => 'Other Educational Institution',
                    ]),

                Tables\Filters\SelectFilter::make('county')
                    ->label('County')
                    ->options(fn (): array => AIEducationAmbassadorApplication::query()
                        ->whereNotNull('county')
                        ->where('county', '!=', '')
                        ->distinct()
                        ->orderBy('county')
                        ->pluck('county', 'county')
                        ->toArray()),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Review'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->latest('created_at');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAIEducationAmbassadorApplications::route('/'),
            'create' => Pages\CreateAIEducationAmbassadorApplication::route('/create'),
            'edit' => Pages\EditAIEducationAmbassadorApplication::route('/{record}/edit'),
        ];
    }
}
