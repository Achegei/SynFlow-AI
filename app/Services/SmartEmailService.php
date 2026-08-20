<?php

namespace App\Services;

use App\Mail\PaymentStartedMail;
use App\Mail\PaymentCompletedMail;
use App\Mail\PaymentCancelledMail;
use App\Mail\PaymentFailedMail;
use App\Mail\RegistrationCompletedMail;
use App\Mail\RegistrationFollowupMail;
use App\Mail\PaymentRecoveryMail;
use App\Mail\PaymentCancelledFollowupMail;
use App\Mail\PaymentFailedFollowupMail;
use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SmartEmailService
{
    /**
     * Check whether this exact business email has already been sent.
     */
    public function alreadySent(
            User $user,
            string $event,
            array $metadata = []
        ): bool {
            $query = EmailLog::query()
                ->where('user_id', $user->id)
                ->where('event', $event)
                ->where('status', 'sent');

            if (isset($metadata['payment_activity_id'])) {
                $query->whereJsonContains(
                    'metadata->payment_activity_id',
                    $metadata['payment_activity_id']
                );
            }

            if (isset($metadata['registration_id'])) {
                $query->whereJsonContains(
                    'metadata->registration_id',
                    $metadata['registration_id']
                );
            }

            return $query->exists();
        }

    /**
     * Send an email and record the complete outcome.
     */
    public function send(
        User $user,
        string $event,
        string $template,
        string $subject,
        array $metadata = []
    ): ?EmailLog {

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate emails
        |--------------------------------------------------------------------------
        */

        if ($this->alreadySent(
            $user,
            $event,
            $metadata
        )) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Create pending email log
        |--------------------------------------------------------------------------
        */

        $log = EmailLog::create([
            'user_id' => $user->id,
            'event' => $event,
            'template' => $template,
            'recipient' => $user->email,
            'subject' => $subject,
            'status' => 'pending',
            'metadata' => $metadata,
        ]);

        try {

            $mailable = match ($event) {

                'registration_completed' =>
                    new RegistrationCompletedMail($user, $metadata),

                'registration_followup' =>
                    new RegistrationFollowupMail($user, $metadata),

                'payment_started' =>
                    new PaymentStartedMail($user, $metadata),

                'payment_recovery' =>
                    new PaymentRecoveryMail($user, $metadata),

                'payment_completed' =>
                    new PaymentCompletedMail($user, $metadata),

                'payment_cancelled' =>
                    new PaymentCancelledMail($user, $metadata),

                'payment_cancelled_followup' =>
                    new PaymentCancelledFollowupMail($user, $metadata),

                'payment_failed' =>
                    new PaymentFailedMail($user, $metadata),

                'payment_failed_followup' =>
                    new PaymentFailedFollowupMail($user, $metadata),

                default => null,
            };

            if (!$mailable) {

                $log->update([
                    'status' => 'failed',
                    'failed_at' => now(),
                    'metadata' => array_merge(
                        $metadata,
                        [
                            'error' =>
                                'No mailable configured for this event.',
                        ]
                    ),
                ]);

                Log::error(
                    '[Smart Email Service] No mailable configured',
                    [
                        'email_log_id' => $log->id,
                        'user_id' => $user->id,
                        'event' => $event,
                        'template' => $template,
                    ]
                );

                return $log;
            }

            Mail::to($user->email)->send($mailable);

            /*
            |--------------------------------------------------------------------------
            | Mark as sent
            |--------------------------------------------------------------------------
            */

            $log->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return $log;

        } catch (Throwable $e) {

            $log->update([
                'status' => 'failed',
                'failed_at' => now(),
                'metadata' => array_merge(
                    $metadata,
                    [
                        'error' => $e->getMessage(),
                        'exception' => get_class($e),
                    ]
                ),
            ]);

            Log::error(
                '[Smart Email Service] Email failed',
                [
                    'email_log_id' => $log->id,
                    'user_id' => $user->id,
                    'event' => $event,
                    'recipient' => $user->email,
                    'error' => $e->getMessage(),
                ]
            );

            return $log;
        }
    }
}