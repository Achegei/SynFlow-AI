<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{
    public function handle(Request $request, $provider)
    {
        $providerLower = strtolower($provider);
        Log::info("[Webhook] Received from {$providerLower}", $request->all());

        if ($providerLower !== 'intasend') {
            return response()->json(['error' => 'Unknown provider'], 400);
        }

        $payload      = $request->getContent();
        $apiRef       = $request->input('api_ref');
        $state        = strtoupper($request->input('state', ''));
        $providerType = strtoupper($request->input('provider', ''));

        if (!$apiRef) {
            return response()->json(['error' => 'Missing api_ref'], 400);
        }

        $payment = Payment::where('payment_id', $apiRef)->first();
        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Save raw payload
        $payment->payload = $payload;
        $payment->save();

        // Handle IntaSend handshake challenge
        if ($request->has('challenge')) {
            Log::info("[Webhook] Challenge received: " . $request->input('challenge'));
            return response()->json(['challenge' => $request->input('challenge')]);
        }

        // Signature verification only for card/checkout payments
        if (!in_array($providerType, ['M-PESA', 'MPESA'])) {
            $intasendSecret = config('intasend.secret_key');
            $receivedSignature = $request->header('IntaSend-Signature') 
                              ?? $request->header('X-IntaSend-Signature');

            if (!$receivedSignature) {
                Log::warning('[Webhook] Missing signature for card/checkout event');
                return response()->json(['error' => 'Missing signature'], 400);
            }

            $calculatedSignature = hash_hmac('sha256', $payload, $intasendSecret);
            if (!hash_equals($calculatedSignature, $receivedSignature)) {
                Log::warning('[Webhook] Signature verification failed', [
                    'calculated' => $calculatedSignature,
                    'received'   => $receivedSignature,
                    'payload'    => $payload
                ]);
                return response()->json(['error' => 'Invalid signature'], 403);
            }
        }

        // Handle payment states
        switch ($state) {
            case 'COMPLETE':
                if ($payment->status !== 'completed') {
                    $payment->status = 'completed';
                    $payment->save();

                    // Unlock course immediately
                    $user = User::find($payment->user_id);
                    if ($user) {
                        $user->courses()->syncWithoutDetaching([$payment->course_id]);
                        Log::info("[Webhook] Course unlocked for user {$user->id} via {$providerType}");
                    }
                }

                // Only verify card/checkout payments
                if (!in_array($providerType, ['M-PESA', 'MPESA'])) {
                    try {
                        Log::info("[Complete] Verifying card payment api_ref: {$apiRef}");
                        $this->verifyWithIntaSend($apiRef);
                    } catch (\Exception $e) {
                        Log::error("[Complete] Verification failed: " . $e->getMessage());
                    }
                } else {
                    Log::info("[Complete] Mobile payment confirmed via webhook, no API verification needed.");
                }
                break;

            default:
                // Save other states: PENDING, PROCESSING, FAILED, etc.
                $payment->status = strtolower($state);
                $payment->save();
                Log::info("[Webhook] Payment state updated => {$state}");
        }

        return response()->json(['message' => 'OK'], 200);
    }

    // Card verification helper
    private function verifyWithIntaSend($apiRef)
    {
        $secretKey = config('intasend.secret_key');

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$secretKey}"
        ])->get("https://api.intasend.com/v1/payments/{$apiRef}");

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        $data = $response->json();
        Log::info("[Verify] IntaSend response: ", $data);

        return $data;
    }
}
