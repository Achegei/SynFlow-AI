<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class SmartEmailEventService
{
    public function __construct(
        private SmartEmailService $emailService
    ) {
    }

    /**
     * Handle an email event and determine
     * whether the appropriate email should be sent.
     *
     * This service acts as the bridge between:
     *
     * SmartEmailAutomationService
     *          ↓
     * SmartEmailEventService
     *          ↓
     * SmartEmailService
     */
    public function handle(
        string $event,
        User $user,
        array $metadata = []
    ): void {
        try {

            /*
            |--------------------------------------------------------------------------
            | Email event definitions
            |--------------------------------------------------------------------------
            |
            | Transactional events:
            |
            | registration_completed
            | payment_started
            | payment_completed
            | payment_cancelled
            | payment_failed
            |
            | Automation events:
            |
            | registration_followup
            | payment_recovery
            | payment_cancelled_followup
            | payment_failed_followup
            |
            */

            $rules = [

                /*
                |--------------------------------------------------------------------------
                | Transactional Emails
                |--------------------------------------------------------------------------
                */

                'registration_completed' => [
                    'template' => 'registration_completed',
                    'subject' => 'Welcome to Moose Loon AI Academy',
                ],

                'payment_started' => [
                    'template' => 'payment_started',
                    'subject' => 'Complete Your Payment',
                ],

                'payment_completed' => [
                    'template' => 'payment_completed',
                    'subject' => 'Payment Successful',
                ],

                'payment_cancelled' => [
                    'template' => 'payment_cancelled',
                    'subject' => 'Your Payment Was Cancelled',
                ],

                'payment_failed' => [
                    'template' => 'payment_failed',
                    'subject' => 'There Was a Problem With Your Payment',
                ],

                /*
                |--------------------------------------------------------------------------
                | Automation / Follow-up Emails
                |--------------------------------------------------------------------------
                */

                'registration_followup' => [
                    'template' => 'registration_followup',
                    'subject' => 'Ready to Continue Your Moose Loon AI Journey?',
                ],

                'payment_recovery' => [
                    'template' => 'payment_recovery',
                    'subject' => 'Complete Your Payment and Continue Your Enrollment',
                ],

                'payment_cancelled_followup' => [
                    'template' => 'payment_cancelled_followup',
                    'subject' => 'Need Help Completing Your Enrollment?',
                ],

                'payment_failed_followup' => [
                    'template' => 'payment_failed_followup',
                    'subject' => 'Let’s Help You Complete Your Payment',
                ],
            ];

            /*
            |--------------------------------------------------------------------------
            | Unsupported event
            |--------------------------------------------------------------------------
            |
            | Do not silently fail.
            |
            | The SmartEmailService is responsible for the actual EmailLog
            | lifecycle, while this service simply refuses to dispatch
            | an event that has no configured rule.
            |
            */

            if (!isset($rules[$event])) {

                Log::warning(
                    '[Smart Email Event] Unsupported email event',
                    [
                        'event' => $event,
                        'user_id' => $user->id,
                        'metadata' => $metadata,
                    ]
                );

                return;
            }

            $rule = $rules[$event];

            /*
            |--------------------------------------------------------------------------
            | Delegate actual sending
            |--------------------------------------------------------------------------
            */

            $this->emailService->send(
                $user,
                $event,
                $rule['template'],
                $rule['subject'],
                $metadata
            );

        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Email must NEVER break the application flow.
            |--------------------------------------------------------------------------
            */

            Log::error(
                '[Smart Email Event] Failed to process email event',
                [
                    'event' => $event,
                    'user_id' => $user->id,
                    'metadata' => $metadata,
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}