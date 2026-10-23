<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use IntaSend\IntaSendPHP\Collection;

class IntaSendPaymentService
{
    public function __construct(
        private PaymentCompletionService $completionService
    ) {
    }

    /**
     * Ask IntaSend for the current payment status.
     *
     * If IntaSend says COMPLETE, synchronize Laravel immediately.
     */
    public function synchronize(Payment $payment): Payment
    {
        /*
        |--------------------------------------------------------------------------
        | If Laravel already knows it is paid, nothing else is required.
        |--------------------------------------------------------------------------
        */

        $payment->refresh();

        if (in_array(
        $payment->status,
            ['paid', 'failed', 'cancelled'],
            true
        )) {
            return $payment;
        }


        /*
        |--------------------------------------------------------------------------
        | Initialize IntaSend
        |--------------------------------------------------------------------------
        */

        /*
         * Do not query IntaSend without a valid invoice identifier.
         * An invoice-less pending payment must remain unchanged.
         */
        if (
            !is_string($payment->payment_id) ||
            trim($payment->payment_id) === ''
        ) {
            return $payment;
        }

        $collection = app(Collection::class);

        $collection->init([
            'token' => config('intasend.secret_key'),

            'publishable_key' => config(
                'intasend.publishable_key'
            ),

            'test' => config(
                'intasend.test_mode',
                false
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Query IntaSend directly
        |--------------------------------------------------------------------------
        */

        try {

            $response = $collection->status(
                $payment->payment_id
            );

        } catch (\Throwable $e) {

            Log::error(
                '[IntaSend Payment Service] Status request failed',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                    'error' => $e->getMessage(),
                ]
            );

            return $payment->fresh();
        }

        /*
        |--------------------------------------------------------------------------
        | Extract invoice
        |--------------------------------------------------------------------------
        */

        $invoice = $response->invoice ?? null;

        if (!$invoice) {

            Log::warning(
                '[IntaSend Payment Service] No invoice returned',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                ]
            );

            return $payment->fresh();
        }

        /*
         * Verify invoice identity, API reference, amount and currency
         * before accepting ANY provider state, including failure.
         */
        if (!(new IntaSendInvoiceVerifier())->verify($payment, $invoice)) {
            Log::warning(
                '[IntaSend Payment Service] Provider invoice mismatch',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                ]
            );

            return $payment->fresh();
        }

        $state = strtolower(
            trim(
                (string) (
                    $invoice->state ?? ''
                )
            )
        );

        Log::info(
            '[IntaSend Payment Service] IntaSend status received',
            [
                'payment_id' => $payment->id,
                'invoice_id' => $payment->payment_id,
                'state' => $state,
                'provider_ref' =>
                    $invoice->provider_ref ?? null,
                'mpesa_reference' =>
                    $invoice->mpesa_reference ?? null,
                'clearing_status' =>
                    $invoice->clearing_status ?? null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Keep latest IntaSend response
        |--------------------------------------------------------------------------
        */

        $payment->payload = json_decode(
            json_encode($response, JSON_UNESCAPED_SLASHES),
            true
        ) ?? [];

        $payment->save();

        /*
        |--------------------------------------------------------------------------
        | COMPLETE
        |--------------------------------------------------------------------------
        */

        if (in_array(
            $state,
            [
                'complete',
                'completed',
                'paid',
                'successful',
                'success',
            ],
            true
        )) {

            Log::info(
                '[IntaSend Payment Service] PAYMENT COMPLETE',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                ]
            );

            $verifier = new IntaSendInvoiceVerifier();

            if (!$verifier->verify($payment, $invoice)) {
                Log::error(
                    '[IntaSend Payment Service] Invoice verification failed',
                    [
                        'payment_id' => $payment->id,
                        'expected_invoice_id' => $payment->payment_id,
                        'course_id' => $payment->course_id,
                    ]
                );

                return $payment->fresh();
            }

            return $this->completionService
                ->complete($payment);
        }

      /*
            |--------------------------------------------------------------------------
            | FAILED / CANCELLED
            |--------------------------------------------------------------------------
            |
            | IntaSend can return state = FAILED for different reasons.
            |
            | Example:
            |
            | failed_code   = 1032
            | failed_reason = Request Cancelled by user.
            |
            | In that case, the customer cancelled the M-Pesa prompt.
            |
            | Other FAILED responses remain genuine payment failures.
            |
            */

            if (in_array(
                $state,
                [
                    'failed',
                    'cancelled',
                    'canceled',
                    'rejected',
                ],
                true
            )) {

                /*
                |--------------------------------------------------------------------------
                | Get IntaSend failure information
                |--------------------------------------------------------------------------
                */

                $failedCode = (string) (
                    $invoice->failed_code ?? ''
                );

                $failedReason = trim(
                    (string) (
                        $invoice->failed_reason ?? ''
                    )
                );

                /*
                |--------------------------------------------------------------------------
                | Determine whether customer cancelled the payment
                |--------------------------------------------------------------------------
                |
                | IntaSend uses code 1032 for:
                |
                | "Request Cancelled by user."
                |
                */

                $isCancelled =
                    in_array(
                        $state,
                        ['cancelled', 'canceled'],
                        true
                    )
                    ||
                    $failedCode === '1032'
                    ||
                    str_contains(
                        strtolower($failedReason),
                        'cancelled by user'
                    )
                    ||
                    str_contains(
                        strtolower($failedReason),
                        'canceled by user'
                    )
                    ||
                    str_contains(
                        strtolower($failedReason),
                        'request cancelled by user'
                    );

                /*
                |--------------------------------------------------------------------------
                | Set local payment status
                |--------------------------------------------------------------------------
                */

                $payment->status = $isCancelled
                    ? 'cancelled'
                    : 'failed';

                $payment->save();

                /*
                |--------------------------------------------------------------------------
                | Determine activity event
                |--------------------------------------------------------------------------
                */

                $activityEvent = $isCancelled
                    ? 'payment_cancelled'
                    : 'payment_failed';

                /*
                |--------------------------------------------------------------------------
                | Prevent duplicate activity records
                |--------------------------------------------------------------------------
                */

                $alreadyLogged = ActivityLog::query()
                    ->where('user_id', $payment->user_id)
                    ->where('event', $activityEvent)
                    ->where('metadata->payment_id', $payment->id)
                    ->exists();

                if (!$alreadyLogged) {

                    ActivityLog::create([
                        'event' => $activityEvent,

                        'visitor_id' => request()->hasSession()
                            ? request()->session()->get('lead_visitor_id')
                            : null,

                        'user_id' => $payment->user_id,

                        'metadata' => [
                            'stage' => 'payment',

                            'payment_id' => $payment->id,

                            'invoice_id' => $payment->payment_id,

                            'package_id' => $payment->package_id,

                            'amount' => $payment->amount,

                            'currency' => $payment->currency,

                            'provider' => $payment->provider,

                            'provider_state' => $state,

                            /*
                            |--------------------------------------------------------------------------
                            | Preserve IntaSend failure information
                            |--------------------------------------------------------------------------
                            */

                            'failed_code' => $failedCode ?: null,

                            'failed_reason' => $failedReason ?: null,

                            /*
                            |--------------------------------------------------------------------------
                            | Human-readable message
                            |--------------------------------------------------------------------------
                            */

                            'message' => $isCancelled
                                ? 'Customer cancelled the M-Pesa payment prompt.'
                                : 'Payment failed.',

                            'timestamp' => now()->toISOString(),
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Log outcome
                |--------------------------------------------------------------------------
                */

                Log::warning(
                    '[IntaSend Payment Service] PAYMENT NOT COMPLETED',
                    [
                        'payment_id' => $payment->id,

                        'invoice_id' => $payment->payment_id,

                        'state' => $state,

                        'failed_code' => $failedCode,

                        'failed_reason' => $failedReason,

                        'payment_status' => $payment->status,

                        'activity_event' => $activityEvent,
                    ]
                );
            }

        return $payment->fresh();
    }
}