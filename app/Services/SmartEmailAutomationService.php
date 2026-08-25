<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class SmartEmailAutomationService
{
    public function __construct(
        protected SmartEmailEventService $emailEvents
    ) {
    }

    /**
     * Process registered users and determine
     * whether an automated email should be sent.
     */
    public function process(): void
    {
        User::query()
            ->whereNotNull('email')
            ->chunkById(100, function ($users) {

                foreach ($users as $user) {
                    try {
                        $this->processUser($user);
                    } catch (Throwable $e) {
                        Log::error(
                            '[Smart Email Automation] User processing failed',
                            [
                                'user_id' => $user->id,
                                'error' => $e->getMessage(),
                            ]
                        );
                    }
                }
            });
    }

    /**
     * Determine the current funnel state of a user.
     */
    protected function processUser(User $user): void
    {
        $activities = ActivityLog::query()
            ->where('user_id', $user->id)
            ->orderBy('created_at')
            ->get();

        if ($activities->isEmpty()) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Find the latest payment-related event.
        |--------------------------------------------------------------------------
        |
        | The latest payment event determines the current payment state.
        |
        */

        $latestPaymentEvent = $activities
            ->filter(function ($activity) {
                return in_array(
                    $activity->event,
                    [
                        'payment_started',
                        'payment_failed',
                        'payment_cancelled',
                        'payment_completed',
                    ],
                    true
                );
            })
            ->sortByDesc('created_at')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | No payment activity yet.
        |--------------------------------------------------------------------------
        |
        | User may still be in the registration stage.
        |
        */

        if (!$latestPaymentEvent) {

            $registration = $activities
                ->where('event', 'registration_completed')
                ->sortByDesc('created_at')
                ->first();

            if ($registration) {
                $this->handleRegistration(
                    $user,
                    $registration
                );
            }

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Current payment state.
        |--------------------------------------------------------------------------
        */

        switch ($latestPaymentEvent->event) {

            /*
            |--------------------------------------------------------------------------
            | Payment completed
            |--------------------------------------------------------------------------
            |
            | Conversion achieved.
            | Stop all recovery automation.
            |--------------------------------------------------------------------------
            */

            case 'payment_completed':

                return;

            /*
            |--------------------------------------------------------------------------
            | Payment started
            |--------------------------------------------------------------------------
            */

            case 'payment_started':

                $this->handlePaymentStarted(
                    $user,
                    $latestPaymentEvent
                );

                return;

            /*
            |--------------------------------------------------------------------------
            | Payment failed
            |--------------------------------------------------------------------------
            */

            case 'payment_failed':

                $this->handlePaymentFailed(
                    $user,
                    $latestPaymentEvent
                );

                return;

            /*
            |--------------------------------------------------------------------------
            | Payment cancelled
            |--------------------------------------------------------------------------
            */

            case 'payment_cancelled':

                $this->handlePaymentCancelled(
                    $user,
                    $latestPaymentEvent
                );

                return;
        }
    }

    /**
     * Registered but never reached payment.
     */
    protected function handleRegistration(
        User $user,
        ActivityLog $registration
    ): void {
        if (
            $registration->created_at
                ->gt(now()->subHours(24))
        ) {
            return;
        }

        $this->emailEvents->handle(
            'registration_followup',
            $user,
            [
                'registration_id' => $registration->id,
            ]
        );
    }

    /**
     * Payment was started but remains unresolved.
     */
    protected function handlePaymentStarted(
        User $user,
        ActivityLog $paymentStarted
    ): void {
        if (
            $paymentStarted->created_at
                ->gt(now()->subHours(2))
        ) {
            return;
        }

        $this->emailEvents->handle(
            'payment_recovery',
            $user,
            [
                'payment_activity_id' => $paymentStarted->id,
                'payment_id' =>
                    data_get(
                        $paymentStarted->metadata,
                        'payment_id'
                    ),
            ]
        );
    }

    /**
     * Payment failed.
     */
    protected function handlePaymentFailed(
        User $user,
        ActivityLog $paymentFailed
    ): void {
        if (
            $paymentFailed->created_at
                ->gt(now()->subHours(2))
        ) {
            return;
        }

        $this->emailEvents->handle(
            'payment_failed_followup',
            $user,
            [
                'payment_activity_id' => $paymentFailed->id,
                'payment_id' =>
                    data_get(
                        $paymentFailed->metadata,
                        'payment_id'
                    ),
                'failed_code' =>
                    data_get(
                        $paymentFailed->metadata,
                        'failed_code'
                    ),
                'failed_reason' =>
                    data_get(
                        $paymentFailed->metadata,
                        'failed_reason'
                    ),
            ]
        );
    }

    /**
     * Payment was cancelled.
     */
    protected function handlePaymentCancelled(
    User $user,
    ActivityLog $paymentCancelled
): void {
    $hoursSinceCancellation = $paymentCancelled->created_at
        ->diffInHours(now());

    if ($hoursSinceCancellation < 24) {
        return;
    }

    $recoveryDay = (int) floor(
        $hoursSinceCancellation / 24
    );

    $this->emailEvents->handle(
        'payment_cancelled_followup',
        $user,
        [
            'payment_activity_id' => $paymentCancelled->id,
            'payment_id' => data_get(
                $paymentCancelled->metadata,
                'payment_id'
            ),
            'recovery_day' => $recoveryDay,
        ]
    );
}
}