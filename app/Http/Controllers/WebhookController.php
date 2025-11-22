<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class WebhookController extends Controller
{
    public function handle(Request $request, $provider)
    {
        Log::info("[Webhook] Received from {$provider}", $request->all());

        if (strtolower($provider) !== 'intasend') {
            return response()->json(['error' => 'Unknown provider'], 400);
        }

        // IntaSend webhook signature verification
        $intasendSecret = config('intasend.webhook_secret');
        $receivedSignature = $request->header('X-IntaSend-Signature');

        if (!$receivedSignature) {
            Log::warning('[Webhook] Missing signature');
            return response()->json(['error' => 'Missing signature'], 400);
        }

        $payload = json_encode($request->all());
        $calculatedSignature = hash_hmac('sha256', $payload, $intasendSecret);

        if (!hash_equals($calculatedSignature, $receivedSignature)) {
            Log::warning('[Webhook] Signature verification failed', [
                'calculated' => $calculatedSignature,
                'received' => $receivedSignature
            ]);
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        // Handle IntaSend handshake
        if ($request->has('challenge')) {
            Log::info("[Webhook] Challenge received: " . $request->input('challenge'));
            return response()->json(['challenge' => $request->input('challenge')]);
        }

        $apiRef = $request->input('api_ref');
        $state  = strtoupper($request->input('state')); // PENDING, PROCESSING, COMPLETE, FAILED

        if (!$apiRef) {
            return response()->json(['error' => 'Missing api_ref'], 400);
        }

        $payment = Payment::where('payment_id', $apiRef)->first();
        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Save payload for audit
        $payment->payload = $payload;

        if ($state === 'COMPLETE') {
            if ($payment->status !== 'completed') {
                $payment->status = 'completed';
                $payment->save();

                $user = User::find($payment->user_id);
                if ($user) {
                    // Unlock the purchased course
                    $user->courses()->syncWithoutDetaching([$payment->course_id]);
                    Log::info("[Webhook] Course unlocked for user {$user->id}, course {$payment->course_id}");
                }
            }
        } else {
            // Record other states: PENDING, PROCESSING, FAILED
            $payment->status = strtolower($state);
            $payment->save();
            Log::info("[Webhook] Payment status updated to {$state} for api_ref {$apiRef}");
        }

        return response()->json(['message' => 'Payment recorded successfully']);
    }
}
