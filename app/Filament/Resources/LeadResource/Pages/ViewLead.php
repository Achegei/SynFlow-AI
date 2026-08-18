<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewLead extends ViewRecord
{
    protected static string $resource = LeadResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        $record = $this->getRecord();

        /*
        |--------------------------------------------------------------------------
        | COMPLETE CUSTOMER JOURNEY
        |--------------------------------------------------------------------------
        */

        $activities = $record
            ->activityLogs()
            ->orderBy('created_at')
            ->get()
            ->map(function ($activity) {

                $metadata = $activity->metadata;

                if (is_string($metadata)) {
                    $metadata = json_decode($metadata, true);
                }

                return [
                    'event' => $activity->event,
                    'created_at' => $activity->created_at,
                    'visitor_id' => $activity->visitor_id,
                    'details' => self::formatActivityDetails(
                        $activity->event,
                        is_array($metadata) ? $metadata : []
                    ),
                ];
            })
            ->toArray();

        return $infolist

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT: KEEP USER INFORMATION
            |--------------------------------------------------------------------------
            */

            ->state(array_merge(
                $record->attributesToArray(),
                [
                    'lead_activity' => $activities,
                ]
            ))

            ->schema([

                /*
                |--------------------------------------------------------------------------
                | LEAD INFORMATION
                |--------------------------------------------------------------------------
                */

                Section::make('Lead Information')
                    ->schema([

                        TextEntry::make('name')
                            ->label('Name'),

                        TextEntry::make('email')
                            ->label('Email')
                            ->copyable(),

                        TextEntry::make('id')
                            ->label('User ID'),

                        TextEntry::make('created_at')
                            ->label('Registered')
                            ->dateTime('M d, Y H:i:s'),

                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | CUSTOMER JOURNEY
                |--------------------------------------------------------------------------
                */

                Section::make('Customer Journey')
                    ->description(
                        'Complete chronological journey recorded for this lead.'
                    )
                    ->schema([

                        RepeatableEntry::make('lead_activity')
                            ->label('')
                            ->schema([

                                TextEntry::make('event')
                                    ->label('Activity')
                                    ->formatStateUsing(
                                        fn (?string $state): string =>
                                            self::formatEventName($state)
                                    )
                                    ->badge(),

                                TextEntry::make('created_at')
                                    ->label('Time')
                                    ->dateTime('M d, Y H:i:s'),

                                TextEntry::make('details')
                                    ->label('Details')
                                    ->columnSpanFull(),

                            ])
                            ->columns(2)
                            ->columnSpanFull(),

                    ])
                    ->collapsible(),

            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | HUMAN-READABLE EVENT NAME
    |--------------------------------------------------------------------------
    */

    protected static function formatEventName(?string $event): string
    {
        if (! $event) {
            return 'Unknown Activity';
        }

        return match ($event) {

            'ai_assessment_step_viewed'
                => 'Assessment Step Viewed',

            'ai_assessment_step_completed'
                => 'Assessment Step Completed',

            'ai_assessment_viewed'
                => 'AI Assessment Viewed',

            'ai_learning_path_viewed'
                => 'Learning Path Viewed',

            'ai_learning_path_selected'
                => 'Learning Path Selected',

            'ai_learning_path_continue_clicked'
                => 'Continued to Packages',

            'ai_packages_viewed'
                => 'Packages Viewed',

            'ai_package_selected'
                => 'Package Selected',

            'registration_viewed'
                => 'Registration Page Viewed',

            'registration_started'
                => 'Registration Started',

            'registration_name_entered'
                => 'Name Entered',

            'registration_email_entered'
                => 'Email Entered',

            'registration_password_started'
                => 'Registration Password Started',

            'registration_submitted'
                => 'Registration Submitted',

            'payment_page_viewed'
                => 'Payment Page Viewed',

            'payment_started'
                => 'Payment Started',

            'payment_initiated'
                => 'Payment Initiated',

            'payment_completed'
                => 'Payment Completed',

            'payment_failed'
                => 'Payment Failed',

            'payment_cancelled'
                => 'Payment Cancelled',

            'paid'
                => 'Payment Confirmed',

            default => ucwords(
                str_replace('_', ' ', $event)
            ),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | HUMAN-READABLE ACTIVITY DETAILS
    |--------------------------------------------------------------------------
    */

    protected static function formatActivityDetails(
        ?string $event,
        array $metadata
    ): string {

        return match ($event) {

            /*
            |--------------------------------------------------------------------------
            | ASSESSMENT
            |--------------------------------------------------------------------------
            */

            'ai_assessment_step_viewed',
            'ai_assessment_step_completed' => sprintf(
                'Step %s of %s',
                $metadata['step'] ?? '?',
                $metadata['total_steps'] ?? '?'
            ),

            /*
            |--------------------------------------------------------------------------
            | LEARNING PATH
            |--------------------------------------------------------------------------
            */

            'ai_learning_path_viewed' => 'Viewed the AI learning path options.',

            'ai_learning_path_selected' => sprintf(
                'Selected learning path: %s',
                $metadata['path_title']
                    ?? $metadata['path']
                    ?? 'Unknown'
            ),

            'ai_learning_path_continue_clicked' =>
                'Continued from the learning path to package selection.',

            /*
            |--------------------------------------------------------------------------
            | PACKAGES
            |--------------------------------------------------------------------------
            */

            'ai_packages_viewed' =>
                'Viewed available AI packages.',

            'ai_package_selected' => sprintf(
                'Package: %s • Price: KES %s',
                $metadata['package_name'] ?? 'Unknown',
                $metadata['package_price'] ?? 'Unknown'
            ),

            /*
            |--------------------------------------------------------------------------
            | REGISTRATION
            |--------------------------------------------------------------------------
            */

            'registration_viewed' =>
                'Opened the registration page.',

            'registration_started' =>
                'Started the registration process.',

            'registration_name_entered' =>
                'Entered their name.',

            'registration_email_entered' =>
                'Entered their email address.',

            'registration_password_started' =>
                'Started entering their registration password.',

            'registration_submitted' =>
                'Submitted the registration form.',

            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */

            'payment_page_viewed' => sprintf(
                'Viewed payment page • Package: %s • Amount: KES %s',
                $metadata['package_name'] ?? 'Unknown',
                $metadata['amount']
                    ?? $metadata['package_price']
                    ?? 'Unknown'
            ),

            'payment_started' =>
                'Started the payment process.',

            'payment_initiated' => sprintf(
                'Payment request initiated%s.',
                isset($metadata['amount'])
                    ? ' • Amount: KES ' . $metadata['amount']
                    : ''
            ),

            'payment_completed',
            'paid' => sprintf(
                'Payment successfully completed%s.',
                isset($metadata['amount'])
                    ? ' • Amount: KES ' . $metadata['amount']
                    : ''
            ),

            'payment_failed' =>
                'Payment attempt failed.',

            'payment_cancelled' =>
                'Payment was cancelled or abandoned by the customer.',

            /*
            |--------------------------------------------------------------------------
            | GENERIC FALLBACK
            |--------------------------------------------------------------------------
            */

            default => self::formatGenericMetadata($metadata),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | GENERIC METADATA FALLBACK
    |--------------------------------------------------------------------------
    */

    protected static function formatGenericMetadata(array $metadata): string
    {
        if (empty($metadata)) {
            return 'No additional details recorded.';
        }

        return collect($metadata)
            ->reject(fn ($value, $key) =>
                in_array($key, [
                    'timestamp',
                    'user_agent',
                ])
            )
            ->map(function ($value, $key) {

                $label = ucwords(
                    str_replace('_', ' ', $key)
                );

                if (is_array($value)) {
                    $value = implode(', ', $value);
                }

                return "{$label}: {$value}";
            })
            ->implode(' • ');
    }
}