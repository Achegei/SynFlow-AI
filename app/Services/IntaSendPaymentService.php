<?php

namespace App\Services;

use App\Models\Payment;
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

        if ($payment->status === 'paid') {
            return $payment;
        }

        /*
        |--------------------------------------------------------------------------
        | Initialize IntaSend
        |--------------------------------------------------------------------------
        */

        $collection = new Collection();

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

        $payment->payload = json_encode(
            $response,
            JSON_UNESCAPED_SLASHES
        );

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

            return $this->completionService
                ->complete($payment);
        }

        /*
        |--------------------------------------------------------------------------
        | FAILED
        |--------------------------------------------------------------------------
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

            $payment->status = 'failed';

            $payment->save();

            Log::warning(
                '[IntaSend Payment Service] PAYMENT FAILED',
                [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->payment_id,
                    'state' => $state,
                ]
            );
        }

        return $payment->fresh();
    }
}