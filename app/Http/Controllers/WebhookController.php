<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentManager;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected $payments;

    public function __construct(PaymentManager $payments)
    {
        $this->payments = $payments;
    }

    /**
     * Generic webhook handler for any payment provider.
     */
    public function handle(Request $request, $provider)
    {
        Log::info("Webhook received from {$provider}", $request->all());

        // Step 1: Normalize webhook data
        $data = $this->normalizeData($provider, $request);

        if (!$data || empty($data['email']) || empty($data['course_id'])) {
            Log::warning("Invalid payload from {$provider}", $request->all());
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        // Step 2: Record or update payment
        $recorded = $this->payments->recordPayment($provider, $data);

        if ($recorded) {
            Log::info("Payment recorded successfully for {$data['email']} (course {$data['course_id']})");
            return response()->json(['message' => 'Payment recorded']);
        }

        Log::warning("Payment recording failed for provider: {$provider}");
        return response()->json(['error' => 'Failed to record payment'], 500);
    }

    /**
     * Normalize incoming data for all supported providers.
     */
    protected function normalizeData($provider, Request $request)
    {
        switch (strtolower($provider)) {
            case 'lemonsqueezy':
                return [
                    'email'       => $request->input('data.attributes.user_email'),
                    'course_id'   => $request->input('meta.course_id'),
                    'payment_id'  => $request->input('data.id'),
                    'status'      => $request->input('data.attributes.status'),
                    'amount'      => $request->input('data.attributes.total'),
                ];

            case 'flutterwave':
                return [
                    'email'       => $request->input('customer.email'),
                    'course_id'   => $request->input('meta.course_id'),
                    'payment_id'  => $request->input('data.id'),
                    'status'      => $request->input('data.status'),
                    'amount'      => $request->input('data.amount'),
                ];

            case 'intasend':
                return [
                    'email'       => $request->input('email'),
                    'course_id'   => $request->input('meta.course_id'),
                    'payment_id'  => $request->input('transaction_id'),
                    'status'      => $request->input('status'),
                    'amount'      => $request->input('amount'),
                ];

            default:
                Log::error("Unknown payment provider: {$provider}");
                return null;
        }
    }
}
