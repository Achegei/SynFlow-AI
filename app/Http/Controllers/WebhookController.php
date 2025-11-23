<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request, $provider)
    {
        $provider = strtolower($provider);
        Log::info("[Webhook] Received from {$provider}", $request->all());

        if ($provider !== 'intasend') {
            return response()->json(['error' => 'Unknown provider'], 400);
        }

        $payload = $request->getContent();
        $providerType = strtoupper($request->input('provider', ''));

        // Determine if signature is required (card/checkout payments)
        $requiresSignature = !in_array($providerType, ['M-PESA', 'MPESA']);

        $receivedSignature = $request->header('IntaSend-Signature')
            ?? $request->header('X-IntaSend-Signature');

        $intasendSecret = config('intasend.secret_key');

        // Verify signature for card/checkout events
        if ($requiresSignature) {
            if (!$receivedSignature) {
                Log::warning('[Webhook] Missing signature for card/checkout event');
                return response()->json(['error' => 'Missing signature'], 400);
            }

            $calculatedSignature = hash_hmac('sha256', $payload, $intasendSecret);

            if (!hash_equals($calculatedSignature, $receivedSignature)) {
                Log::warning('[Webhook] Signature verification failed', [
                    'calculated' => $calculatedSignature,
                    'received' => $receivedSignature,
                    'payload' => $payload
                ]);
                return response()->json(['error' => 'Invalid signature'], 403);
            }
        }

        // Handle IntaSend handshake challenge
        if ($request->has('challenge')) {
            $challenge = $request->input('challenge');
            Log::info("[Webhook] Challenge received: {$challenge}");
            return response()->json(['challenge' => $challenge]);
        }

        $apiRef = $request->input('api_ref');
        $state  = strtoupper($request->input('state', ''));

        if (!$apiRef) {
            return response()->json(['error' => 'Missing api_ref'], 400);
        }

        $payment = Payment::where('api_ref', $apiRef)->first();
        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Save webhook payload for debugging
        $payment->payload = $payload;

        // Handle payment completion
        if ($state === 'COMPLETE') {
            if ($payment->status !== 'completed' && $payment->status !== 'paid') {
                $payment->status = 'paid';
                $payment->save();

                $user = User::find($payment->user_id);
                if ($user) {
                    $user->courses()->syncWithoutDetaching([$payment->course_id]);
                    Log::info("[Webhook] Course unlocked for user {$user->id}");
                }
            }
        } else {
            // For PENDING / PROCESSING / FAILED, just log and save status
            $payment->status = strtolower($state);
            $payment->save();
            Log::info("[Webhook] Payment state updated => {$state}");
        }

        return response()->json(['message' => 'OK'], 200);
    }
}
