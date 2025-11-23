<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use IntaSend\IntaSendPHP\IntaSendAPI;

class WebhookController extends Controller
{
    public function handle(Request $request, $provider)
    {
        Log::info("[Webhook] Received from {$provider}", $request->all());

        if (strtolower($provider) !== 'intasend') {
            return response()->json(['error' => 'Unknown provider'], 400);
        }

        $payload = $request->getContent();
        $state   = strtoupper($request->input('state', ''));
        $apiRef  = $request->input('api_ref');

        // 1. Handshake challenge
        if ($request->has('challenge')) {
            Log::info("[Webhook] Challenge received: " . $request->input('challenge'));
            return response()->json(['challenge' => $request->input('challenge')]);
        }

        // 2. Missing API reference
        if (!$apiRef) {
            Log::warning('[Webhook] Missing api_ref');
            return response()->json(['error' => 'Missing api_ref'], 400);
        }

        // 3. Locate payment (correct field is api_ref)
        $payment = Payment::where('api_ref', $apiRef)->first();
        if (!$payment) {
            Log::warning("[Webhook] Payment NOT FOUND with api_ref: {$apiRef}");
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Store webhook payload
        $payment->payload = $payload;
        $payment->save();

        Log::info("[Webhook] State received: {$state} for api_ref {$apiRef}");

        // 4. Only process full completion
        if ($state !== 'COMPLETE') {
            $payment->status = strtolower($state);
            $payment->save();
            return response()->json(['message' => 'ACK'], 200);
        }

        // 5. Prevent double processing
        if ($payment->status === 'completed') {
            Log::info("[Webhook] Already processed for {$apiRef}");
            return response()->json(['message' => 'OK'], 200);
        }

        Log::info("[Webhook] COMPLETE received — verifying with IntaSend API...");

        // 6. Verify with IntaSend API first
        try {
            $intaSend = new IntaSendAPI(
                env('INTASEND_PUBLISHABLE_KEY'),
                env('INTASEND_SECRET_KEY'),
                env('INTASEND_TEST_ENVIRONMENT') == "false" ? "live" : "sandbox"
            );

            $verification = $intaSend->payment()->status($apiRef);

            Log::info("[Webhook Verification] API Response", $verification);

            // Verification must show COMPLETE
            if (!isset($verification['state']) || strtoupper($verification['state']) !== 'COMPLETE') {
                Log::warning("[Webhook] Verification FAILED or INCOMPLETE", $verification);
                return response()->json(['error' => 'Verification failed'], 400);
            }
        } catch (\Exception $e) {
            Log::error('[Webhook] Verification Error: ' . $e->getMessage());
            return response()->json(['error' => 'Verification error'], 400);
        }

        // 7. Mark payment completed
        $payment->status = 'completed';
        $payment->mpesa_reference = $request->input('mpesa_reference');
        $payment->save();

        // 8. Unlock course
        $user = User::find($payment->user_id);
        if ($user) {
            $user->courses()->syncWithoutDetaching([$payment->course_id]);
            Log::info("[Webhook] Course ID {$payment->course_id} UNLOCKED for User ID {$user->id}");
        }

        return response()->json(['message' => 'SUCCESS'], 200);
    }
}
