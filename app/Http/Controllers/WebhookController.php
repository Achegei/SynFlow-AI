<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle incoming webhook requests from payment providers
     */
    public function handle(Request $request, $provider)
    {
        Log::info("Webhook received from {$provider}", $request->all());

        if (strtolower($provider) === 'intasend') {

            $invoice = $request->input('invoice');
            $meta = $request->input('meta', []);

            if (!$invoice || empty($meta['course_id']) || empty($invoice['invoice_id'])) {
                return response()->json(['error' => 'Invalid payload'], 400);
            }

            // Find the payment record
                $payment = Payment::where('payment_id', $invoice['invoice_id'])->first();

                if ($payment) {
                    $payment->status = strtolower($invoice['state']) === 'paid' ? 'completed' : $invoice['state'];
                    $payment->payload = json_encode($request->all());
                    $payment->save();

                    // Grant course access
                    $user = User::find($payment->user_id);
                    if ($user && $payment->status === 'completed') {
                        $user->courses()->syncWithoutDetaching([$invoice['meta']['course_id']]);
                    }
                return response()->json(['message' => 'Payment recorded']);
            }
        }

        return response()->json(['error' => 'Unknown provider or payment not found'], 400);
    }
}
