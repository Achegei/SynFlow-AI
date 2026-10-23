@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 px-4 py-12 sm:py-16">
    <div class="mx-auto max-w-xl">

        <div class="mb-8 text-center">
            <p class="mb-3 text-sm font-semibold uppercase tracking-wider text-blue-700">
                Moose Loon AI Academy
            </p>

            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Complete Your Enrollment
            </h1>

            <p class="mt-3 text-gray-600">
                You're one step away from accessing your AI training.
            </p>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 p-6 sm:p-8">
                <p class="text-sm font-medium text-gray-500">
                    Course
                </p>

                <h2 class="mt-2 text-xl font-semibold text-gray-900">
                    {{ $course->title }}
                </h2>

                <div class="mt-6 flex items-center justify-between border-t border-gray-100 pt-6">
                    <span class="text-sm font-medium text-gray-600">
                        One-time enrollment fee
                    </span>

                    <span class="text-2xl font-bold text-gray-900">
                        KES {{ number_format($amount, 2) }}
                    </span>
                </div>
            </div>

            <div class="p-6 sm:p-8">

                @if (session('error'))
                    <div role="alert" class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div role="alert" class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('purchase.course', $course->id) }}"
                    id="course-payment-form"
                >
                    @csrf

                    <label for="phone_number" class="block text-sm font-semibold text-gray-900">
                        M-Pesa Phone Number
                    </label>

                    <p class="mt-1 text-sm text-gray-500">
                        Enter the number that will receive the M-Pesa payment prompt.
                    </p>

                    <input
                        type="tel"
                        id="phone_number"
                        name="phone_number"
                        value="{{ old('phone_number') }}"
                        placeholder="254712345678"
                        inputmode="tel"
                        autocomplete="tel"
                        maxlength="20"
                        required
                        aria-invalid="{{ $errors->has('phone_number') ? 'true' : 'false' }}"
                        class="mt-3 block w-full rounded-xl border border-gray-300 px-4 py-3 text-base text-gray-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >

                    <button
                        type="submit"
                        id="course-pay-button"
                        class="mt-6 flex w-full items-center justify-center rounded-xl bg-blue-700 px-5 py-3.5 text-base font-semibold text-white transition hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-200 disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Pay KES {{ number_format($amount, 2) }}
                    </button>
                </form>

                <div class="mt-6 rounded-xl bg-blue-50 p-4">
                    <p class="text-sm leading-6 text-blue-900">
                        After selecting Pay, check your phone for an M-Pesa prompt.
                        Enter your PIN to authorize the payment. Course access
                        will be activated after payment is verified.
                    </p>
                </div>

                <p class="mt-6 text-center text-xs text-gray-500">
                    Payments are processed securely through IntaSend.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('course-payment-form')
    ?.addEventListener('submit', function () {
        const button = document.getElementById('course-pay-button');

        if (button) {
            button.disabled = true;
            button.textContent = 'Sending M-Pesa Request...';
        }
    });
</script>
@endsection
