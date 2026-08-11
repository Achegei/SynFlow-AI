@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto px-4 py-10">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        {{-- Header --}}
        <div class="text-center mb-6">

            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-50">
                <svg
                    class="h-8 w-8 text-blue-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-900">
                Payment Processing
            </h1>

            <p class="mt-2 text-gray-600">
                Your M-Pesa payment request has been sent.
            </p>

        </div>


        {{-- Payment Status --}}
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6">

            <div class="flex items-start gap-3">

                <div class="flex-shrink-0 mt-0.5">

                    <svg
                        class="h-5 w-5 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 18.5A6.5 6.5 0 1012 5a6.5 6.5 0 000 13.5z"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-sm font-semibold text-blue-900">
                        Waiting for M-Pesa confirmation
                    </p>

                    <p class="mt-1 text-sm text-blue-800">
                        Check your phone and enter your M-Pesa PIN
                        to complete the payment.
                    </p>

                </div>

            </div>

        </div>


        {{-- Payment Details --}}
        <div class="bg-gray-50 rounded-xl p-4 mb-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-gray-500">
                        Payment Amount
                    </p>

                    <p class="text-xl font-bold text-gray-900">
                        KES {{ number_format($payment->amount, 2) }}
                    </p>

                </div>


                <div class="text-right">

                    <p class="text-sm text-gray-500">
                        Status
                    </p>

                    <span
                        id="payment-status"
                        class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800"
                    >
                        Pending
                    </span>

                </div>

            </div>

        </div>


        {{-- Processing Indicator --}}
        <div class="text-center mb-6">

            <div class="flex justify-center mb-4">

                <div
                    class="h-10 w-10 animate-spin rounded-full border-4 border-gray-200 border-t-blue-600"
                ></div>

            </div>

            <p class="text-sm font-medium text-gray-700">
                Waiting for payment confirmation...
            </p>

            <p class="mt-1 text-xs text-gray-500">
                This page will automatically update once your payment
                has been confirmed.
            </p>

        </div>


        {{-- Instructions --}}
        <div class="rounded-xl bg-green-50 border border-green-100 p-4 mb-6">

            <p class="text-sm text-green-800">

                <strong>What you need to do:</strong>

                Check the phone number you used for payment and
                look for the M-Pesa payment request.


            </p>

            <ul class="mt-3 space-y-2 text-sm text-green-800">

                <li class="flex items-start gap-2">

                    <span class="font-bold">1.</span>

                    <span>Open the M-Pesa prompt on your phone.</span>

                </li>

                <li class="flex items-start gap-2">

                    <span class="font-bold">2.</span>

                    <span>Confirm the amount shown.</span>

                </li>

                <li class="flex items-start gap-2">

                    <span class="font-bold">3.</span>

                    <span>Enter your M-Pesa PIN.</span>

                </li>

                <li class="flex items-start gap-2">

                    <span class="font-bold">4.</span>

                    <span>Wait for the payment confirmation.</span>

                </li>

            </ul>

        </div>


        {{-- Payment Reference --}}
        <div class="border border-gray-200 rounded-xl p-4 mb-6">

            <div class="flex justify-between items-center gap-4">

                <div>

                    <p class="text-xs text-gray-500">
                        Payment Reference
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 break-all">
                        {{ $payment->payment_id }}
                    </p>

                </div>

                <div class="text-right">

                    <p class="text-xs text-gray-500">
                        Amount
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-900">
                        KES {{ number_format($payment->amount, 2) }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Help --}}
        <div class="text-center">

            <p class="text-sm text-gray-500">
                Haven't received the M-Pesa prompt?
            </p>

            <p class="mt-1 text-xs text-gray-400">
                Please make sure your phone is switched on and has
                sufficient network coverage.
            </p>

        </div>


        {{-- Security --}}
        <p class="text-xs text-gray-500 text-center mt-5">

            Your payment is securely processed through IntaSend.

        </p>

    </div>

</div>


{{-- Payment Status Polling --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const statusElement = document.getElementById('payment-status');

    const statusUrl = @json(
        route('ai.payment.status', ['payment' => $payment->id])
    );

    let attempts = 0;
    const maxAttempts = 300; // 5 minutes at 1-second intervals

    async function checkPaymentStatus() {

        try {

            const response = await fetch(statusUrl, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Cache-Control': 'no-cache'
                },
                cache: 'no-store'
            });

            if (!response.ok) {
                throw new Error(
                    `Payment status request failed: ${response.status}`
                );
            }

            const data = await response.json();

            console.log('[AI PAYMENT] Status:', data.status);

            /*
            |--------------------------------------------------------------------------
            | PAYMENT SUCCESSFUL
            |--------------------------------------------------------------------------
            */

            if (data.status === 'paid') {

                statusElement.textContent = 'Paid';

                statusElement.className =
                    'inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800';

                console.log(
                    '[AI PAYMENT] Payment confirmed. Redirecting...'
                );

                if (data.redirect) {

                    setTimeout(function () {
                        window.location.href = data.redirect;
                    }, 500);

                }

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | PAYMENT FAILED
            |--------------------------------------------------------------------------
            */

            if (data.status === 'failed') {

                statusElement.textContent = 'Payment Failed';

                statusElement.className =
                    'inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800';

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | STILL PENDING
            |--------------------------------------------------------------------------
            */

            attempts++;

            if (attempts < maxAttempts) {

                setTimeout(
                    checkPaymentStatus,
                    1000
                );

            } else {

                console.log(
                    '[AI PAYMENT] Maximum polling attempts reached.'
                );

            }

        } catch (error) {

            console.error(
                '[AI PAYMENT] Status check failed:',
                error
            );

            attempts++;

            if (attempts < maxAttempts) {

                setTimeout(
                    checkPaymentStatus,
                    2000
                );

            }

        }
    }


    /*
    |--------------------------------------------------------------------------
    | START POLLING
    |--------------------------------------------------------------------------
    */

    console.log(
        '[AI PAYMENT] Starting payment status polling:',
        statusUrl
    );

    checkPaymentStatus();

});
</script>
@endsection