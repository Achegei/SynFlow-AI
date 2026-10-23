<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentLog;
use App\Services\IntaSendPaymentService;
use App\Services\IntaSendInvoiceVerifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use IntaSend\IntaSendPHP\Collection;

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
        IntaSendPaymentService $paymentService
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
        | 8. Independently verify payment with IntaSend
        |--------------------------------------------------------------------------
        |
        | Incoming webhook fields are notifications, not payment proof.
        | Never replace stored invoice IDs or API references with values
        | supplied by the webhook.
        |
        */

        /*
         * An enrollment webhook can arrive before the STK initiation
         * response stores its invoice ID. Never trust the webhook ID
         * without independently checking the provider's invoice.
         */
        if (
            $payment->course_enrollment_id !== null &&
            $payment->status === 'pending' &&
            $payment->payment_id === null &&
            is_string($invoiceId) &&
            $invoiceId !== '' &&
            is_string($apiRef) &&
            $apiRef !== '' &&
            $payment->api_ref === $apiRef
        ) {
            try {
                $collection = app(Collection::class);

                $collection->init([
                    'token' => config('intasend.secret_key'),
                    'publishable_key' => config('intasend.publishable_key'),
                    'test' => config('intasend.test_mode', false),
                ]);

                $response = $collection->status($invoiceId);
                $invoice = $response->invoice ?? null;

                $candidate = clone $payment;
                $candidate->payment_id = $invoiceId;

                if (
                    !is_object($invoice) ||
                    !(new IntaSendInvoiceVerifier())->verify(
                        $candidate,
                        $invoice
                    )
                ) {
                    Log::warning(
                        '[Webhook] Early invoice verification failed',
                        ['payment_id' => $payment->id]
                    );

                    return response()->json(['success' => true]);
                }

                $associated = DB::transaction(
                    function () use ($payment, $invoiceId, $apiRef) {
                        $locked = Payment::query()
                            ->whereKey($payment->id)
                            ->lockForUpdate()
                            ->firstOrFail();

                        if (
                            $locked->status !== 'pending' ||
                            $locked->api_ref !== $apiRef ||
                            (
                                $locked->payment_id !== null &&
                                $locked->payment_id !== $invoiceId
                            )
                        ) {
                            return false;
                        }

                        $claimed = Payment::query()
                            ->where('payment_id', $invoiceId)
                            ->whereKeyNot($locked->id)
                            ->exists();

                        if ($claimed) {
                            return false;
                        }

                        if ($locked->payment_id === null) {
                            $locked->payment_id = $invoiceId;
                            $locked->save();
                        }

                        return true;
                    }
                );

                if (!$associated) {
                    Log::warning(
                        '[Webhook] Early invoice association rejected',
                        ['payment_id' => $payment->id]
                    );

                    return response()->json(['success' => true]);
                }

                $payment->refresh();
            } catch (\Throwable $e) {
                Log::error(
                    '[Webhook] Early invoice reconciliation failed',
                    [
                        'payment_id' => $payment->id,
                        'error' => $e->getMessage(),
                    ]
                );

                return response()->json([
                    'success' => false,
                    'message' => 'Payment reconciliation failed.',
                ], 500);
            }
        }

        if (
            ($invoiceId && $payment->payment_id !== $invoiceId) ||
            ($apiRef && $payment->api_ref !== $apiRef)
        ) {
            Log::warning(
                '[Webhook] Payment reference mismatch',
                ['payment_id' => $payment->id]
            );

            return response()->json(['success' => true]);
        }

        try {
            $payment = $paymentService->synchronize($payment);
        } catch (\Throwable $e) {
            Log::error(
                '[Webhook] Provider reconciliation failed',
                [
                    'payment_id' => $payment->id,
                    'error' => $e->getMessage(),
                ]
            );

            return response()->json([
                'success' => false,
                'message' => 'Payment reconciliation failed.',
            ], 500);
        }

        Log::info(
            '[Webhook] Reconciliation finished',
            [
                'payment_id' => $payment->id,
                'status' => $payment->status,
            ]
        );

        return response()->json([
            'success' => true,
        ]);
    }
}
