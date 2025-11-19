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
     * Redirect user to the course's IntaSend payment page
     */
    public function purchase($courseId)
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);

        // Already owns course
        if ($user->courses->contains($course->id)) {
            return redirect()->route('classroom.show', $course->id)
                ->with('info', 'You already have access to this course.');
        }

        // Build customer info
        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name = $user->name; // optional, separate field if available
        $customer->email = $user->email;
        $customer->country = "KE";

        $amount = $course->price; // Ensure courses table has price column
        $currency = "KES";

        $host = config('app.url'); // Website URL
        $redirect_url = route('purchase.complete', ['course_id' => $course->id]);

        $ref_order_number = "course-{$course->id}-user-{$user->id}-" . time();

        $card_tarrif = "BUSINESS-PAYS";
        $mobile_tarrif = "BUSINESS-PAYS";

        // Initialize IntaSend checkout
        //dd(env('INTASEND_PUBLISHABLE_KEY'), env('INTASEND_TEST_ENVIRONMENT'));

        $checkout = new Checkout();
        $checkout->init([
            'publishable_key' => env('INTASEND_PUBLISHABLE_KEY'),
            'test' => env('INTASEND_TEST_ENVIRONMENT', true),
        ]);

        try {
            $response = $checkout->create(
                $amount,
                $currency,
                $customer,
                $host,
                $redirect_url,
                $ref_order_number,
                null,
                null,
                $card_tarrif,
                $mobile_tarrif
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);
            $retryAfter = $responseBody['errors'][0]['detail'] ?? null;
            return redirect()->back()->with('error', "Too many requests. Please wait {$retryAfter} seconds and try again.");
        }


        if (!$response || !isset($response->invoice->url)) {
            return redirect()->back()->with('error', 'Failed to initiate payment.');
        }

        // Track pending payment in DB
        Payment::updateOrCreate(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
            ],
            [
                'status' => 'pending',
                'provider' => 'intasend',
                'payment_id' => $response->invoice->invoice_id, // fixed
                'amount' => $amount,
                'payload' => json_encode($response),
            ]
        );

        // Redirect user to IntaSend payment page
       return redirect($response->invoice->url);
    }

    /**
     * Redirect after successful payment
     */
    public function complete(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->query('course_id');

        if (!$user || !$courseId) {
            abort(400, 'Invalid request.');
        }

        $course = Course::findOrFail($courseId);

        // Check if payment is marked completed by webhook
        $payment = Payment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->where('status', 'completed')
            ->first();

        if (!$payment) {
            return redirect()->route('courses.show', $course->id)
                ->with('error', 'Payment not confirmed yet. Please wait a few moments.');
        }

        // Grant access to course
        $user->courses()->syncWithoutDetaching([$course->id]);

        return redirect()->route('classroom.show', $course->id)
            ->with('success', 'Payment successful! Course unlocked.');
    }
}
