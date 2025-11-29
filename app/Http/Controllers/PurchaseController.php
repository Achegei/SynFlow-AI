<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use IntaSend\IntaSendPHP\Checkout;
use IntaSend\IntaSendPHP\Customer;

class PurchaseController extends Controller
{
    /**
     * Start a purchase and create an IntaSend checkout session
     */
    public function purchase(Request $request, $courseId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $course = Course::find($courseId);
        if (!$course) {
            return back()->with('error', 'Course not found.');
        }

        // If user already owns course
        if ($user->courses->contains($courseId)) {
            return redirect()->route('classroom.show', $courseId)
                ->with('info', 'You already own this course.');
        }

        // IntaSend customer data
        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name  = $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount   = $course->price;
        $currency = "KES";

        /**
         * API REF FORMAT (very important for webhook matching)
         * order-user{userId}-course{courseId}-{timestamp}
         */
        $apiRef = "order-user{$user->id}-course{$courseId}-" . time();

        // Initialize IntaSend Checkout
        $checkout = new Checkout();
        $checkout->init([
            'token'           => config('intasend.secret_key'),
            'publishable_key' => config('intasend.publishable_key'),
            'test'            => config('intasend.test_mode', false),
        ]);

        try {

            $response = $checkout->create(
                $amount,
                $currency,
                $customer,
                route('purchase.complete', $courseId), // redirect url
                null,                                  // host (optional)
                $apiRef,                               // api_ref
                null,                                  // comment
                "M-PESA"                               // method
            );

            Log::info("[IntaSend Checkout] Session created", (array) $response);

        } catch (\Throwable $e) {
            Log::error("[IntaSend Checkout] Error: {$e->getMessage()}");
            return back()->with('error', 'Could not initialize payment. Please try again.');
        }

        // IntaSend response has invoice->invoice_id
        $invoiceId = $response->invoice->invoice_id ?? $response->id ?? null;

        if (!$invoiceId) {
            Log::error("[IntaSend Checkout] Missing invoice_id in response", (array) $response);
            return back()->with('error', 'Payment could not be started.');
        }

        // Store payment record (updateOrCreate prevents duplicates)
        Payment::updateOrCreate(
            [
                'user_id'   => $user->id,
                'course_id' => $courseId,
            ],
            [
                'provider'   => 'intasend',
                'status'     => 'pending',
                'payment_id' => $invoiceId,
                'api_ref'    => $apiRef,
                'amount'     => $amount,
                'payload'    => json_encode($response),
            ]
        );

        // Redirect user to the IntaSend payment page
        if (!isset($response->url)) {
            Log::error("[IntaSend Checkout] Missing payment URL", (array)$response);
            return back()->with('error', 'Payment URL missing. Contact support.');
        }

        return redirect($response->url);
    }


    /**
     * Redirect after payment (NOT webhook)
     */
    public function complete($courseId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $payment = Payment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->latest()
            ->first();

        return view('purchase.complete', compact('payment'));
    }
}
