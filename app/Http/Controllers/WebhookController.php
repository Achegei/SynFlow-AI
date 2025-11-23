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

        // Handle handshake challenge
        if ($request->has('challenge')) {
            Log::info("[Webhook] Challenge received: " . $request->input('challenge'));
            return response()->json(['challenge' => $request->input('challenge')]);
        }

        // Only M-PESA flow
        if (in_array($providerType, ['M-PESA', 'MPESA'])) {
            switch ($state) {
                case 'COMPLETE':
                    if ($payment->status !== 'completed') {
                        $payment->status = 'completed';
                        $payment->save();

                        // Unlock course
                        $user = User::find($payment->user_id);
                        if ($user) {
                            $user->courses()->syncWithoutDetaching([$payment->course_id]);
                            Log::info("[Webhook] Course unlocked for user {$user->id} via M-PESA");
                        }
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

        // If somehow non-M-PESA hits this
        return response()->json(['error' => 'Non-M-PESA payments are not handled'], 400);
    }
}
