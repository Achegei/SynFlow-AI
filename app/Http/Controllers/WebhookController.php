<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentLog;
use App\Services\PaymentCompletionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle IntaSend Webhook.
     *
     * The webhook is one source of payment confirmation.
     *
     * Payment completion itself is delegated to:
     *
     * PaymentCompletionService
     *
     * This keeps payment completion idempotent and allows the same
     * completion logic to be used by:
     *
     * - Webhook
     * - Frontend status polling
     * - Manual/admin reconciliation
     */
    public function handleIntaSend(
        Request $request,
        PaymentCompletionService $completionService
    ) {
        $data = $request->all();

        Log::info(
            '[Webhook] Incoming IntaSend payload',
            $data
        );

        /*
        |--------------------------------------------------------------------------
        | 1. Extract invoice ID
        |--------------------------------------------------------------------------
        */

        $invoiceId =
            $data['invoice_id']
            ?? $data['id']
            ?? data_get($data, 'invoice.invoice_id')
            ?? null;

        /*
        |--------------------------------------------------------------------------
        | 2. Extract API reference
        |--------------------------------------------------------------------------
        */

        $apiRef =
            $data['api_ref']
            ?? $data['api_reference']
            ?? $data['reference']
            ?? data_get($data, 'invoice.api_ref')
            ?? null;

        /*
        |--------------------------------------------------------------------------
        | 3. Extract payment state
        |--------------------------------------------------------------------------
        */

        $paid = filter_var(
            $data['paid'] ?? false,
            FILTER_VALIDATE_BOOLEAN
        );

        $state = strtolower(
            trim(
                (string) (
                    $data['state']
                    ?? $data['status']
                    ?? data_get($data, 'invoice.state')
                    ?? ''
                )
            )
        );

        /*
        |--------------------------------------------------------------------------
        | 4. Save raw webhook log
        |--------------------------------------------------------------------------
        */

        try {
            $log = PaymentLog::create([
                'invoice_id' => $invoiceId,

                'api_ref' => $apiRef,

                'state' => $state,

                'payload' => json_encode(
                    $data,
                    JSON_UNESCAPED_SLASHES
                ),
            ]);

            Log::info(
                '[Webhook] PaymentLog saved',
                [
                    'id' => $log->id,
                    'invoice_id' => $invoiceId,
                    'api_ref' => $apiRef,
                    'state' => $state,
                    'paid' => $paid,
                ]
            );

        } catch (\Throwable $e) {

            Log::error(
                '[Webhook] Could not save PaymentLog',
                [
                    'error' => $e->getMessage(),
                    'invoice_id' => $invoiceId,
                    'api_ref' => $apiRef,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Validate identifiers
        |--------------------------------------------------------------------------
        */

        if (!$invoiceId && !$apiRef) {

            Log::warning(
                '[Webhook] Missing invoice ID and API reference',
                [
                    'payload' => $data,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Return 200 so IntaSend does not continuously retry.
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Locate existing payment
        |--------------------------------------------------------------------------
        |
        | The AIPaymentController creates the Payment BEFORE the STK request
        | completes.
        |
        | Therefore we should normally find an existing Payment here.
        |
        |--------------------------------------------------------------------------
        */

        $payment = null;

        /*
        |--------------------------------------------------------------------------
        | Try invoice ID first
        |--------------------------------------------------------------------------
        */

        if ($invoiceId) {

            $payment = Payment::query()
                ->where('payment_id', $invoiceId)
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Fallback to API reference
        |--------------------------------------------------------------------------
        */

        if (!$payment && $apiRef) {

            $payment = Payment::query()
                ->where('api_ref', $apiRef)
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | 7. Payment not found
        |--------------------------------------------------------------------------
        |
        | Do NOT blindly create a payment here.
        |
        | The application should normally already have a Payment record.
        |
        | If it doesn't exist, log it clearly so the issue can be
        | investigated instead of potentially creating bad financial data.
        |--------------------------------------------------------------------------
        */

        if (!$payment) {

            Log::error(
                '[Webhook] Payment record not found',
                [
                    'invoice_id' => $invoiceId,
                    'api_ref' => $apiRef,
                    'state' => $state,
                    'payload' => $data,
                ]
            );

            return response()->json([
                'success' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 8. Store latest webhook payload
        |--------------------------------------------------------------------------
        */

        $payment->payload = json_encode(
            $data,
            JSON_UNESCAPED_SLASHES
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure invoice ID is preserved.
        |--------------------------------------------------------------------------
        */

        if ($invoiceId) {
            $payment->payment_id = $invoiceId;
        }

        /*
        |--------------------------------------------------------------------------
        | Make sure API reference is preserved.
        |--------------------------------------------------------------------------
        */

        if ($apiRef) {
            $payment->api_ref = $apiRef;
        }

        $payment->save();

        Log::info(
            '[Webhook] Payment located',
            [
                'payment_id' => $payment->id,
                'invoice_id' => $payment->payment_id,
                'api_ref' => $payment->api_ref,
                'current_status' => $payment->status,
                'state' => $state,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 9. Determine whether payment is confirmed
        |--------------------------------------------------------------------------
        */

        $paymentConfirmed =
            $paid
            ||
            in_array(
                $state,
                [
                    'complete',
                    'completed',
                    'paid',
                    'successful',
                    'success',
                ],
                true
            );

        /*
        |--------------------------------------------------------------------------
        | 10. Payment is not confirmed
        |--------------------------------------------------------------------------
        */

        if (!$paymentConfirmed) {

            /*
            |--------------------------------------------------------------------------
            | Handle failed payment states.
            |--------------------------------------------------------------------------
            */

            if (
                in_array(
                    $state,
                    [
                        'failed',
                        'cancelled',
                        'canceled',
                        'rejected',
                    ],
                    true
                )
            ) {

                $payment->status = 'failed';

                $payment->save();

                Log::warning(
                    '[Webhook] Payment marked FAILED',
                    [
                        'payment_id' => $payment->id,
                        'invoice_id' => $payment->payment_id,
                        'state' => $state,
                    ]
                );

                return response()->json([
                    'success' => true,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Still pending.
            |--------------------------------------------------------------------------
            */

            Log::info(
                '[Webhook] Payment not yet confirmed',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                    'api_ref' => $payment->api_ref,
                    'paid' => $paid,
                    'state' => $state,
                ]
            );

            return response()->json([
                'success' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 11. Payment confirmed
        |--------------------------------------------------------------------------
        |
        | DO NOT manually:
        |
        | $payment->status = 'paid';
        |
        | CompletionService owns that responsibility.
        |
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[Webhook] PAYMENT CONFIRMED',
            [
                'payment_id' => $payment->id,
                'invoice_id' => $payment->payment_id,
                'api_ref' => $payment->api_ref,
                'state' => $state,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 12. Complete payment
        |--------------------------------------------------------------------------
        |
        | PaymentCompletionService handles:
        |
        | - Marking payment as paid
        | - paid_at
        | - Commission
        | - AI LearningAccess
        | - Institutional course access
        | - Duplicate protection
        |
        |--------------------------------------------------------------------------
        */

        try {

            $completedPayment =
                $completionService->complete($payment);

            Log::info(
                '[Webhook] Payment completion successful',
                [
                    'payment_id' => $completedPayment->id,
                    'invoice_id' => $completedPayment->payment_id,
                    'status' => $completedPayment->status,
                    'user_id' => $completedPayment->user_id,
                    'course_id' => $completedPayment->course_id,
                    'package_id' => $completedPayment->package_id,
                ]
            );

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            |
            | Return 500 here so IntaSend can retry the webhook if the
            | application failed while completing the payment.
            |
            |--------------------------------------------------------------------------
            */

            Log::error(
                '[Webhook] Payment completion FAILED',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                    'api_ref' => $payment->api_ref,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]
            );

            return response()->json([
                'success' => false,
                'message' => 'Payment completion failed.',
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | 13. Complete
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[Webhook] Processing completed successfully',
            [
                'payment_id' => $payment->id,
                'invoice_id' => $payment->payment_id,
                'api_ref' => $payment->api_ref,
            ]
        );

        return response()->json([
            'success' => true,
        ]);
    }
}