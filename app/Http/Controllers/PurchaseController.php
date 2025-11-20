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
    /**
     * Start IntaSend checkout session
     */
            public function purchase($courseId)
        {
            \Log::info("Purchase triggered for course: {$courseId}");

            $user = Auth::user();
            if (!$user) {
                \Log::warning('Purchase attempted by unauthenticated user.');
                return redirect()->route('login')->with('error', 'Please log in first.');
            }

            $course = Course::find($courseId);
            if (!$course) {
                return redirect()->back()->with('error', 'Course not found.');
            }

            // Prevent duplicate purchases
            if ($user->courses->contains($course->id)) {
                return redirect()
                    ->route('classroom.show', $course->id)
                    ->with('info', 'You already own this course.');
            }

            // Create customer
            $customer = new Customer();
            $customer->first_name = $user->name;
            $customer->last_name  = $user->name;
            $customer->email      = $user->email;
            $customer->country    = "KE";

            $amount   = $course->price;
            $currency = "KES";
            $reference = "order-user{$user->id}-course{$courseId}-" . time();
            $redirectUrl = route('purchase.complete', ['course' => $courseId]);
            //$redirectUrl = route('purchase.complete', ['course_id' => $courseId]);

            $checkout = new Checkout();
            $checkout->init([
                'token' => config('intasend.secret_key'),
                'publishable_key' => config('intasend.publishable_key'),
                'test' => filter_var(config('intasend.test'), FILTER_VALIDATE_BOOLEAN),
            ]);

            try {
                $response = $checkout->create(
                    $amount,
                    $currency,
                    $customer,
                    "https://mooseloonai.ca", // host
                    $redirectUrl,
                    $reference,
                    null,     // comment
                    "M-PESA"  // method
                );

                \Log::info('IntaSend response', (array)$response);

            } catch (\Exception $e) {
                \Log::error('IntaSend checkout failed: ' . $e->getMessage());
                return back()->with('error', "Failed to initiate payment: " . $e->getMessage());
            }

            // Save payment record using the correct response properties
            $payment = Payment::updateOrCreate(
                [
                    'user_id'   => $user->id,
                    'course_id' => $course->id,
                ],
                [
                    'status'      => 'pending',
                    'provider'    => 'intasend',
                    'payment_id'  => $response->id,          // <-- use $response->id
                    'amount'      => $amount,
                    'payload'     => json_encode($response),
                ]
            );

            // Redirect to the IntaSend checkout URL
            return redirect($response->url); // <-- use $response->url
        }

    /**
     * Return URL after payment page finishes
     */
   public function complete(Request $request, $course)
{
    $user = Auth::user();
    $courseId = $course;

    if (!$user || !$courseId) {
        \Log::warning('Purchase complete called with invalid parameters', [
            'user' => $user ? $user->id : null,
            'course_id' => $courseId
        ]);
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
            ->with('error', 'Payment not confirmed yet. This may take a few seconds.');
    }

    $user->courses()->syncWithoutDetaching([$courseId]);

    return redirect()
        ->route('classroom.show', $courseId)
        ->with('success', 'Payment successful — course unlocked!');
}

}
