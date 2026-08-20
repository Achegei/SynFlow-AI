<?php

namespace App\Services;

use App\Models\Course;
use App\Models\LearningAccess;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentCompletionService
{
    public function __construct(
    private CommissionService $commissionService,
        private SmartEmailEventService $smartEmailEventService
    ) {
    }

    /**
     * Complete a payment and activate the appropriate access.
     *
     * This method is intentionally idempotent.
     *
     * It can safely be called by:
     *
     * - IntaSend webhook
     * - Frontend payment-status polling
     * - Manual/admin reconciliation
     */
    public function complete(Payment $payment): Payment
    {
        return DB::transaction(function () use ($payment) {

            /*
            |--------------------------------------------------------------------------
            | Refresh payment
            |--------------------------------------------------------------------------
            */

            $payment->refresh();

            /*
            |--------------------------------------------------------------------------
            | Already completed
            |--------------------------------------------------------------------------
            */

            if ($payment->status === 'paid') {

                Log::info(
                    '[Payment Completion] Payment already completed',
                    [
                        'payment_id' => $payment->id,
                        'invoice_id' => $payment->payment_id,
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | Still make sure AI access exists.
                |
                | This protects us if payment was marked paid but access
                | creation failed during an earlier attempt.
                |--------------------------------------------------------------------------
                */

                $this->ensureAccess($payment);

                return $payment->fresh();
            }

            /*
            |--------------------------------------------------------------------------
            | Mark payment as PAID
            |--------------------------------------------------------------------------
            */

            $payment->status = 'paid';

            $payment->paid_at = now();

            $payment->save();

            /*
            |--------------------------------------------------------------------------
            | Smart Email — Payment Completed
            |--------------------------------------------------------------------------
            */

            $user = User::find($payment->user_id);

            if ($user) {
                $this->smartEmailEventService->handle(
                    'payment_completed',
                    $user,
                    [
                        'payment_id' => $payment->id,
                        'invoice_id' => $payment->payment_id,
                        'course_id' => $payment->course_id,
                        'package_id' => $payment->package_id,
                        'amount' => $payment->amount,
                    ]
                );
            }

            Log::info(
                '[Payment Completion] Payment marked PAID',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                    'api_ref' => $payment->api_ref,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Process commission
            |--------------------------------------------------------------------------
            */

            try {

                $this->commissionService->process($payment);

                Log::info(
                    '[Payment Completion] Commission processed',
                    [
                        'payment_id' => $payment->id,
                    ]
                );

            } catch (\Throwable $e) {

                /*
                |--------------------------------------------------------------------------
                | Do not destroy successful payment completion just because
                | commission processing failed.
                |--------------------------------------------------------------------------
                */

                Log::error(
                    '[Payment Completion] Commission failed',
                    [
                        'payment_id' => $payment->id,
                        'error' => $e->getMessage(),
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Activate access
            |--------------------------------------------------------------------------
            */

            $this->ensureAccess($payment);

            Log::info(
                '[Payment Completion] Processing completed',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                    'user_id' => $payment->user_id,
                    'course_id' => $payment->course_id,
                    'package_id' => $payment->package_id,
                ]
            );

            return $payment->fresh();
        });
    }

    /**
     * Ensure the user receives the correct access.
     */
    private function ensureAccess(Payment $payment): void
    {
        $user = User::find($payment->user_id);

        $course = Course::find($payment->course_id);

        if (!$user || !$course) {

            Log::error(
                '[Payment Completion] User or Course not found',
                [
                    'payment_id' => $payment->id,
                    'user_id' => $payment->user_id,
                    'course_id' => $payment->course_id,
                ]
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | AI PAYMENT
        |--------------------------------------------------------------------------
        */

        if ($payment->package_id) {

            $package = Package::find($payment->package_id);

            if (!$package) {

                Log::error(
                    '[Payment Completion] Package not found',
                    [
                        'payment_id' => $payment->id,
                        'package_id' => $payment->package_id,
                    ]
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Verify package belongs to course
            |--------------------------------------------------------------------------
            */

            if (
                (int) $package->course_id !==
                (int) $course->id
            ) {

                Log::error(
                    '[Payment Completion] Package/course mismatch',
                    [
                        'payment_id' => $payment->id,
                        'package_id' => $package->id,
                        'package_course_id' => $package->course_id,
                        'payment_course_id' => $course->id,
                    ]
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Existing access
            |--------------------------------------------------------------------------
            */

            $existingAccess = LearningAccess::query()
                ->where('payment_id', $payment->id)
                ->first();

            if ($existingAccess) {

                /*
                |--------------------------------------------------------------------------
                | Reactivate valid access if necessary
                |--------------------------------------------------------------------------
                */

                if (
                    $existingAccess->status !== 'active' &&
                    (
                        !$existingAccess->expires_at ||
                        $existingAccess->expires_at->isFuture()
                    )
                ) {

                    $existingAccess->status = 'active';

                    $existingAccess->save();
                }

                Log::info(
                    '[Payment Completion] AI access already exists',
                    [
                        'learning_access_id' => $existingAccess->id,
                        'payment_id' => $payment->id,
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                        'package_id' => $package->id,
                    ]
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Create AI learning access
            |--------------------------------------------------------------------------
            */

            $durationDays = (int) $package->duration_days;

            if ($durationDays < 1) {

                Log::error(
                    '[Payment Completion] Invalid package duration',
                    [
                        'payment_id' => $payment->id,
                        'package_id' => $package->id,
                        'duration_days' => $package->duration_days,
                    ]
                );

                return;
            }

            $startsAt = now();

            $expiresAt = $startsAt
                ->copy()
                ->addDays($durationDays);

            $learningAccess = LearningAccess::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'package_id' => $package->id,
                'payment_id' => $payment->id,
                'starts_at' => $startsAt,
                'expires_at' => $expiresAt,
                'status' => 'active',
            ]);

            Log::info(
                '[Payment Completion] AI learning access CREATED',
                [
                    'learning_access_id' => $learningAccess->id,
                    'payment_id' => $payment->id,
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'package_id' => $package->id,
                    'starts_at' => $startsAt,
                    'expires_at' => $expiresAt,
                ]
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | NORMAL / INSTITUTION COURSE PAYMENT
        |--------------------------------------------------------------------------
        */

        $user->courses()->syncWithoutDetaching([
            $course->id,
        ]);

        Log::info(
            '[Payment Completion] Course access granted',
            [
                'payment_id' => $payment->id,
                'user_id' => $user->id,
                'course_id' => $course->id,
            ]
        );
    }
}