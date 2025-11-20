<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use IntaSend\IntaSendPHP\Checkout;
use IntaSend\IntaSendPHP\Customer;

class PurchaseController extends Controller
{
    public function purchase($courseId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $course = Course::find($courseId);
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        if ($user->courses->contains($course->id)) {
            return redirect()
                ->route('classroom.show', $course->id)
                ->with('info', 'You already own this course.');
        }

        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name  = $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount = (float) $course->price;
        $currency = "KES";

        $redirectUrl = route('purchase.complete', ['course_id' => $courseId]);
        $reference = "order-user{$user->id}-course{$courseId}-" . time();

        $checkout = new Checkout();
        $checkout->init([
            'token' => env('INTASEND_SECRET_KEY'),
            'publishable_key' => env('INTASEND_PUBLISHABLE_KEY'),
            'test' => filter_var(env('INTASEND_TEST_ENVIRONMENT', true), FILTER_VALIDATE_BOOLEAN),
        ]);

        try {
            $response = $checkout->create(
                $amount,                 // 1. amount
                $currency,               // 2. currency
                $customer,               // 3. customer
                config('app.url'),       // 4. host
                $redirectUrl,            // 5. redirect_url
                $reference,              // 6. api_ref
                '',                      // 7. comment
                'M-PESA'                 // 8. method
            );
        } catch (\Exception $e) {
            return back()->with('error', "Payment initialization failed: {$e->getMessage()}");
        }

        if (!isset($response->invoice->url)) {
            return back()->with('error', 'Could not start payment. Contact support.');
        }

        Payment::updateOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            [
                'status' => 'pending',
                'provider' => 'intasend',
                'payment_id' => $response->invoice->invoice_id ?? null,
                'amount' => $amount,
                'payload' => json_encode($response),
            ]
        );

        return redirect($response->invoice->url);
    }

    public function complete(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->query('course_id');

        if (!$user || !$courseId) {
            abort(400, 'Invalid request.');
        }

        $course = Course::find($courseId);
        if (!$course) {
            return redirect()->route('classroom.index')->with('error', 'Course not found.');
        }

        $payment = Payment::where([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'status' => 'completed',
        ])->first();

        if (!$payment) {
            return redirect()
                ->route('classroom.show', $course->id)
                ->with('error', 'Payment not confirmed yet. Please wait a few seconds.');
        }

        $user->courses()->syncWithoutDetaching([$courseId]);

        return redirect()
            ->route('classroom.show', $courseId)
            ->with('success', 'Payment successful — course unlocked!');
    }
}
