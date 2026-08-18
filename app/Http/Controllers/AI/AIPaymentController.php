<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use IntaSend\IntaSendPHP\Collection;
use App\Services\IntaSendPaymentService;

class AIPaymentController extends Controller
{
    /**
     * Show AI payment page.
     */
    public function create(Package $package): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Please log in to continue.');
        }

        abort_unless($package->active, 404);

        /*
        |--------------------------------------------------------------------------
        | Verify selected package
        |--------------------------------------------------------------------------
        */

        $selectedPackageId = session('selected_ai_package_id');

        if (
            !$selectedPackageId ||
            (int) $selectedPackageId !== (int) $package->id
        ) {
            return redirect()
                ->route('ai.packages')
                ->with(
                    'error',
                    'Please select an AI package first.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Course
        |--------------------------------------------------------------------------
        */

        $courseId = $package->course_id;

        if (!$courseId) {
            return redirect()
                ->route('ai.packages')
                ->with(
                    'error',
                    'This AI package is not connected to a course.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate price
        |--------------------------------------------------------------------------
        */

        $amount = (float) $package->price;

        if ($amount < 0.10) {
            Log::error(
                '[AI Payment] Invalid package price',
                [
                    'user_id' => Auth::id(),
                    'package_id' => $package->id,
                    'package_name' => $package->name ?? null,
                    'price' => $package->price,
                    'course_id' => $courseId,
                ]
            );

            return redirect()
                ->route('ai.packages')
                ->with(
                    'error',
                    'This package does not have a valid price.'
                );
        }

        return view('ai.payment', [
            'package' => $package,
            'courseId' => $courseId,
        ]);
    }

    /**
     * Start M-Pesa STK Push.
     */
    public function store(
        Request $request,
        Package $package
    ): RedirectResponse {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please log in first.'
                );
        }

        abort_unless($package->active, 404);

        /*
        |--------------------------------------------------------------------------
        | Verify selected package
        |--------------------------------------------------------------------------
        */

        $selectedPackageId = session('selected_ai_package_id');

        if (
            !$selectedPackageId ||
            (int) $selectedPackageId !== (int) $package->id
        ) {
            return redirect()
                ->route('ai.packages')
                ->with(
                    'error',
                    'Please select an AI package first.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Course
        |--------------------------------------------------------------------------
        */

        $courseId = $package->course_id;

        if (!$courseId) {
            return redirect()
                ->route('ai.packages')
                ->with(
                    'error',
                    'This AI package is not connected to a course.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate amount
        |--------------------------------------------------------------------------
        */

        $amount = (float) $package->price;
        $currency = 'KES';

        if ($amount < 0.10) {
            Log::error(
                '[AI STK] Invalid package price',
                [
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'price' => $package->price,
                    'course_id' => $courseId,
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'This package does not have a valid payment amount.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate M-Pesa number
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'phone_number' => [
                'required',
                'string',
                'max:20',
            ],
        ], [
            'phone_number.required' =>
                'Please enter your M-Pesa phone number.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Normalize Kenyan phone number
        |--------------------------------------------------------------------------
        */

        $phone = $this->normalizeKenyanPhone(
            $request->phone_number
        );

        if (!$phone) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Please enter a valid Kenyan M-Pesa number, for example 254768282146.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Unique API reference
        |--------------------------------------------------------------------------
        */

        $apiRef =
            'order-user' .
            $user->id .
            '-course' .
            $courseId .
            '-package' .
            $package->id .
            '-' .
            now()->format('YmdHis') .
            '-' .
            uniqid();

        /*
        |--------------------------------------------------------------------------
        | Log payment preparation
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[AI STK] Preparing M-Pesa STK Push',
            [
                'user_id' => $user->id,
                'package_id' => $package->id,
                'package_name' => $package->name ?? null,
                'course_id' => $courseId,
                'database_price' => $package->price,
                'amount' => number_format($amount, 2, '.', ''),
                'currency' => $currency,
                'phone' => $phone,
                'api_ref' => $apiRef,
                'test_mode' => config('intasend.test_mode', false),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Initialize IntaSend Collection
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | wallet_id is intentionally NOT included here.
        |
        | The previous implementation was passing:
        |
        | 'wallet_id' => config('intasend.wallet_id')
        |
        | into the SDK credentials.
        |
        | This resulted in:
        |
        | "Invalid wallet ID provided"
        |
        | We first want the normal STK Push to work using the
        | authenticated IntaSend sandbox account.
        |--------------------------------------------------------------------------
        */

        $collection = new Collection();

        $collection->init([
            'token' => config('intasend.secret_key'),

            'publishable_key' => config(
                'intasend.publishable_key'
            ),

            'test' => config(
                'intasend.test_mode',
                false
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify IntaSend configuration
        |--------------------------------------------------------------------------
        */

        if (
            empty(config('intasend.secret_key')) ||
            empty(config('intasend.publishable_key'))
        ) {
            Log::error(
                '[AI STK] IntaSend credentials are missing',
                [
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'course_id' => $courseId,
                    'test_mode' => config(
                        'intasend.test_mode',
                        true
                    ),
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment service is temporarily unavailable. Please try again later.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create STK Push
        |--------------------------------------------------------------------------
        */

        try {
            $response = $collection->create(
                number_format($amount, 2, '.', ''),
                $phone,
                $currency,
                'MPESA_STK_PUSH',
                $apiRef,
                $user->email,
                config('intasend.wallet_id')
            );
        } catch (\Throwable $e) {
            Log::error(
                '[AI STK] IntaSend STK Push failed',
                [
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'course_id' => $courseId,
                    'phone' => $phone,
                    'amount' => $amount,
                    'api_ref' => $apiRef,
                    'test_mode' => config(
                        'intasend.test_mode',
                        false
                    ),
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'We could not start the M-Pesa payment. Please check the number and try again.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Extract invoice ID
        |--------------------------------------------------------------------------
        */

        $invoiceId =
            $response->invoice->invoice_id
            ?? $response->invoice->id
            ?? $response->id
            ?? null;

        /*
        |--------------------------------------------------------------------------
        | Log IntaSend response
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[AI STK] IntaSend response',
            [
                'user_id' => $user->id,
                'package_id' => $package->id,
                'course_id' => $courseId,
                'api_ref' => $apiRef,
                'invoice_id' => $invoiceId,
                'response' => (array) $response,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure IntaSend returned an invoice
        |--------------------------------------------------------------------------
        */

        if (!$invoiceId) {
            Log::error(
                '[AI STK] IntaSend response missing invoice ID',
                [
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'course_id' => $courseId,
                    'api_ref' => $apiRef,
                    'response' => (array) $response,
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment could not be started. Please try again.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create local payment record
        |--------------------------------------------------------------------------
        */

        $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'package_id' => $package->id,
            'provider' => 'intasend',
            'payment_type' => 'course',
            'status' => 'pending',
            'payment_id' => $invoiceId,
            'api_ref' => $apiRef,
            'amount' => $amount,
            'currency' => $currency,
            'payload' => json_encode($response),
        ]);

        Log::info(
            '[AI STK] Payment attempt created',
            [
                'payment_id' => $payment->id,
                'user_id' => $user->id,
                'course_id' => $courseId,
                'package_id' => $package->id,
                'invoice_id' => $invoiceId,
                'amount' => $amount,
                'phone' => $phone,
                'api_ref' => $apiRef,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Save payment ID in session
        |--------------------------------------------------------------------------
        */

        session([
            'ai_pending_payment_id' => $payment->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Send user to payment waiting page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'ai.payment.pending',
                $payment->id
            )
            ->with(
                'success',
                'M-Pesa payment request sent. Please check your phone and enter your M-Pesa PIN.'
            );
    }

    /**
     * Show payment pending page.
     */
    public function pending(
        Payment $payment
    ): View|RedirectResponse {
        $user = Auth::user();

        if (!$user || $payment->user_id !== $user->id) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Already paid
        |--------------------------------------------------------------------------
        */

        if ($payment->status === 'paid') {
            return redirect()
                ->route(
                    'classroom.show',
                    $payment->course_id
                )
                ->with(
                    'success',
                    '🎉 Payment confirmed! Your AI learning access has been activated.'
                );
        }

        return view(
            'ai.payment-pending',
            [
                'payment' => $payment,
            ]
        );
    }

    /**
     * Check payment status.
     */
    public function status(
    Payment $payment,
    IntaSendPaymentService $paymentService
): JsonResponse {
    $user = Auth::user();

    if (!$user) {
        return response()->json([
            'status' => 'unauthenticated',
            'redirect' => route('login'),
        ], 401);
    }

    if ($payment->user_id !== $user->id) {
        return response()->json([
            'status' => 'forbidden',
            'redirect' => null,
        ], 403);
    }

    /*
    |--------------------------------------------------------------------------
    | Synchronize with IntaSend
    |--------------------------------------------------------------------------
    |
    | This is the important part.
    |
    | Instead of only checking our database, ask IntaSend for the
    | authoritative current payment state.
    |
    */

    $payment = $paymentService->synchronize($payment);

    Log::info(
        '[AI PAYMENT STATUS] Payment synchronized',
        [
            'payment_id' => $payment->id,
            'user_id' => $user->id,
            'status' => $payment->status,
        ]
    );

    if ($payment->status === 'paid') {
        return response()->json([
            'status' => 'paid',
            'redirect' => route(
                'classroom.show',
                $payment->course_id
            ),
        ]);
    }

    if ($payment->status === 'cancelled') {
    return response()->json([
        'status' => 'cancelled',
        'redirect' => null,
        'reason' => 'Customer cancelled the M-Pesa payment prompt.',
    ]);
}

    if ($payment->status === 'failed') {
        return response()->json([
            'status' => 'failed',
            'redirect' => null,
            'reason' => 'Payment failed.',
        ]);
    }

    return response()->json([
        'status' => 'pending',
        'redirect' => null,
    ]);
}

    /**
     * Return URL from IntaSend.
     *
     * Kept for compatibility with previous checkout flow.
     *
     * STK Push does not normally use this route.
     */
    public function complete(
        Package $package
    ): RedirectResponse|View {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login');
        }

        abort_unless($package->active, 404);

        $courseId = $package->course_id;

        if (!$courseId) {
            return redirect()
                ->route('ai.packages')
                ->with(
                    'error',
                    'This package has no course attached.'
                );
        }

        $payment = Payment::query()
            ->where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->where('package_id', $package->id)
            ->where('provider', 'intasend')
            ->latest('id')
            ->first();

        if (!$payment) {
            return redirect()
                ->route(
                    'ai.payment.create',
                    $package->id
                )
                ->with(
                    'error',
                    'No payment attempt was found.'
                );
        }

        if ($payment->status !== 'paid') {
            return redirect()
                ->route(
                    'ai.payment.pending',
                    $payment->id
                );
        }

        session()->forget([
            'selected_ai_package_id',
            'selected_ai_course_id',
            'ai_pending_payment_id',
        ]);

        return redirect()
            ->route(
                'classroom.show',
                $courseId
            )
            ->with(
                'success',
                '🎉 Payment confirmed! Your AI learning access has been activated.'
            );
    }

    /**
     * Normalize Kenyan phone number.
     */
    private function normalizeKenyanPhone(
        string $phone
    ): ?string {
        /*
        |--------------------------------------------------------------------------
        | Remove spaces, hyphens and brackets
        |--------------------------------------------------------------------------
        */

        $phone = preg_replace(
            '/[\s\-\(\)]/',
            '',
            trim($phone)
        );

        /*
        |--------------------------------------------------------------------------
        | +254...
        |--------------------------------------------------------------------------
        */

        if (str_starts_with($phone, '+254')) {
            $phone = substr($phone, 1);
        }

        /*
        |--------------------------------------------------------------------------
        | 07XXXXXXXX / 01XXXXXXXX
        |--------------------------------------------------------------------------
        */

        if (
            str_starts_with($phone, '07') ||
            str_starts_with($phone, '01')
        ) {
            $phone = '254' . substr($phone, 1);
        }

        /*
        |--------------------------------------------------------------------------
        | 7XXXXXXXX / 1XXXXXXXX
        |--------------------------------------------------------------------------
        */

        if (
            preg_match('/^[17]\d{8}$/', $phone)
        ) {
            $phone = '254' . $phone;
        }

        /*
        |--------------------------------------------------------------------------
        | Final validation
        |--------------------------------------------------------------------------
        */

        if (
            !preg_match(
                '/^254[17]\d{8}$/',
                $phone
            )
        ) {
            return null;
        }

        return $phone;
    }
    
}