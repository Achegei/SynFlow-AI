<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use IntaSend\IntaSendPHP\Checkout;
use IntaSend\IntaSendPHP\Customer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    /**
     * Start payment
     */
    public function purchase($courseId)
    {
        Log::info("[Purchase] Started for course {$courseId}");

        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $course = Course::findOrFail($courseId);

        if ($user->courses->contains($courseId)) {
            return redirect()->route('classroom.show', $courseId)
                ->with('info', 'You already own this course.');
        }

        $currency = "KES"; // Must define currency

        // Customer object
        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name  = $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount = $course->price;
        $reference = "order-{$user->id}-{$courseId}-" . time();
        $redirectUrl = url("/purchase/complete/{$courseId}");
        Log::info("[Purchase] Redirect URL = {$redirectUrl}");

        // Init IntaSend Checkout
        $checkout = new Checkout();
        $checkout->init([
            'token'           => config('intasend.secret_key'),
            'publishable_key' => config('intasend.publishable_key'),
            'test'            => (bool) config('intasend.test'),
        ]);

        try {
            // Positional arguments (order matters)
            $response = $checkout->create(
                $amount,       // amount
                $currency,     // currency
                $customer,     // customer object
                config('app.url'), // host / callback base
                $redirectUrl,  // redirect URL
                $reference,    // reference string
                null,          // comment (optional)
                "M-PESA"       // payment method
            );

            Log::info("[Purchase] IntaSend Response:", json_decode(json_encode($response), true));

        } catch (\Exception $e) {
            Log::error("[Purchase] Error: {$e->getMessage()}");
            return back()->with('error', 'Payment failed to start.');
        }

        $sessionId = $response->id ?? null;
        if (!$sessionId) {
            Log::error("[Purchase] Missing session ID in response.");
            return back()->with('error', 'Payment could not start.');
        }

        // Save pending payment
        Payment::updateOrCreate(
            ['user_id' => $user->id, 'course_id' => $courseId],
            [
                'payment_id' => $sessionId,
                'status'     => 'pending',
                'provider'   => 'intasend',
                'amount'     => $amount,
                'payload'    => json_encode($response)
            ]
        );

        return redirect($response->url);
    }


    /**
     * Verify payment + unlock course
     */
    public function complete(Course $course)
    {
        $user = auth()->user();
        if (!$user) return redirect()->route('login');

        $payment = Payment::where([
            'user_id'   => $user->id,
            'course_id' => $course->id,
            'status'    => 'pending'
        ])->first();

        if (!$payment) {
            return redirect()->route('classroom')
                ->with('error', 'Payment not found.');
        }

        Log::info("[Complete] Checking session: {$payment->payment_id}");

        $verifyUrl = "https://api.intasend.com/api/v1/checkout/{$payment->payment_id}";
        $response = Http::withToken(config('intasend.secret_key'))->get($verifyUrl);

        if (!$response->ok()) {
            Log::error("[Complete] Verification failed: " . $response->body());
            return redirect()->route('classroom')->with('error', 'Payment verification failed.');
        }

        $data = $response->json();
        Log::info("[Complete] IntaSend Verification:", $data);

        if (($data['paid'] ?? false) === true) {
            $payment->update(['status' => 'completed']);
            $user->courses()->syncWithoutDetaching([$course->id]);
            Log::info("[Complete] COURSE UNLOCKED for user {$user->id}");

            return redirect()->route('classroom.show', $course->id)
                ->with('success', 'Payment confirmed! Course unlocked.');
        }

        return redirect()->route('classroom')
            ->with('error', 'Payment not completed yet.');
    }
}
