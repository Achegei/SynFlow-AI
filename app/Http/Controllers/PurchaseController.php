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
            \Log::warning("Course not found: {$courseId}");
            return redirect()->back()->with('error', 'Course not found.');
        }

        // Prevent duplicate purchases
        if ($user->courses->contains($course->id)) {
            \Log::info("User {$user->id} already owns course {$course->id}");
            return redirect()
                ->route('classroom.show', $course->id)
                ->with('info', 'You already own this course.');
        }

        // Build customer object
        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name  = $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount   = $course->price;
        $currency = "KES";

        // Where IntaSend redirects after payment
        $redirectUrl = route('purchase.complete', ['course_id' => $courseId]);

        // Order reference
        $reference = "order-user{$user->id}-course{$courseId}-" . time();

        // Initialize IntaSend
        $checkout = new Checkout();
        $checkout->init([
            'token'            => env('INTASEND_SECRET_KEY'),
            'publishable_key'  => env('INTASEND_PUBLISHABLE_KEY'),
            'test'             => false, // live environment
        ]);


        try {
            $response = $checkout->create(
                $amount,                   // amount
                $currency,                 // currency
                $customer,                 // customer
                "https://mooseloonai.ca",  // host
                $redirectUrl,              // redirect_url
                $reference,                // api_ref
                null,                      // comment (optional)
                null                       // method (null = all available methods)
            );

            \Log::info('IntaSend response', (array)$response);

        } catch (\Exception $e) {
            \Log::error('IntaSend checkout failed: ' . $e->getMessage());
            return back()->with('error', "Failed to initiate payment: " . $e->getMessage());
        }

        // Check if top-level URL exists
        if (!isset($response->url)) {
            \Log::error('IntaSend checkout URL missing', (array)$response);
            return back()->with('error', 'Could not start payment. Contact support.');
        }

        // Save or update payment record
        Payment::updateOrCreate(
            [
                'user_id'   => $user->id,
                'course_id' => $course->id,
            ],
            [
                'status'      => 'pending',
                'provider'    => 'intasend',
                'payment_id'  => $response->id ?? null,
                'amount'      => $amount,
                'payload'     => json_encode($response),
            ]
        );

        \Log::info("Redirecting user {$user->id} to IntaSend checkout", [
            'url' => $response->url
        ]);

        // Redirect to IntaSend hosted checkout
        return redirect($response->url);
    }

    /**
     * Return URL after payment page finishes
     */
    public function complete(Request $request)
    {
        $user     = Auth::user();
        $courseId = $request->query('course_id');

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

        // Check if webhook marked payment as completed
        $payment = Payment::where([
            'user_id'   => $user->id,
            'course_id' => $courseId,
            'status'    => 'completed',
        ])->first();

        if (!$payment) {
            return redirect()
                ->route('classroom.show', $course->id)
                ->with('error', 'Payment not confirmed yet. This may take a few seconds.');
        }

        // Grant access
        $user->courses()->syncWithoutDetaching([$courseId]);

        return redirect()
            ->route('classroom.show', $courseId)
            ->with('success', 'Payment successful — course unlocked!');
    }
}
