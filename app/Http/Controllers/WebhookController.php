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

    // Use LIVE secret key for both sandbox and live signatures
    $intasendSecret = config('intasend.secret_key');

    // Correct header for LIVE IntaSend webhooks
    $receivedSignature = $request->header('IntaSend-Signature')
        ?? $request->header('X-IntaSend-Signature');

    if (!$receivedSignature) {
        Log::warning('[Webhook] Missing signature');
        return response()->json(['error' => 'Missing signature'], 400);
    }

    // Use raw input for proper HMAC validation
    $payload = $request->getContent();
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
    $state  = strtoupper($request->input('state'));

    if (!$apiRef) {
        return response()->json(['error' => 'Missing api_ref'], 400);
    }

    $payment = Payment::where('payment_id', $apiRef)->first();
    if (!$payment) {
        return response()->json(['error' => 'Payment not found'], 404);
    }

    // Store webhook data for debugging
    $payment->payload = $payload;

    if ($state === 'COMPLETE') {
        if ($payment->status !== 'completed') {
            $payment->status = 'completed';
            $payment->save();

            $user = User::find($payment->user_id);
            if ($user) {
                $user->courses()->syncWithoutDetaching([$payment->course_id]);
                Log::info("[Webhook] Course unlocked for user {$user->id}");
            }
        }
    } else {
        $payment->status = strtolower($state);
        $payment->save();
        Log::info("[Webhook] Payment state updated => {$state}");
    }

    return response()->json(['message' => 'OK'], 200);
}

}
