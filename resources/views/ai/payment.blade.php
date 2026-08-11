@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto px-4 py-10">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <div class="text-center mb-6">

            <h1 class="text-2xl font-bold text-gray-900">
                Complete Your Payment
            </h1>

            <p class="mt-2 text-gray-600">
                Activate your AI learning package.
            </p>

        </div>


        {{-- Package --}}

        <div class="bg-gray-50 rounded-xl p-4 mb-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-gray-500">
                        AI Learning Package
                    </p>

                    <p class="text-lg font-semibold text-gray-900">
                        {{ $package->name }}
                    </p>

                </div>


                <div class="text-right">

                    <p class="text-sm text-gray-500">
                        Amount
                    </p>

                    <p class="text-xl font-bold text-gray-900">
                        KES {{ number_format($package->price, 2) }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Payment instructions --}}

        <div class="mb-6">

            <label
                for="phone_number"
                class="block text-sm font-medium text-gray-700 mb-2"
            >
                M-Pesa Phone Number
            </label>


            <form
                method="POST"
                action="{{ route('ai.payment.store', $package->id) }}"
                id="payment-form"
            >

                @csrf


                <input
                    type="tel"
                    name="phone_number"
                    id="phone_number"
                    value="{{ old('phone_number') }}"
                    placeholder="254768282146"
                    inputmode="numeric"
                    autocomplete="tel"
                    required
                    class="w-full rounded-xl border-gray-300 px-4 py-3 text-lg focus:border-blue-500 focus:ring-blue-500"
                >


                @error('phone_number')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror


                <p class="mt-2 text-sm text-gray-500">
                    Enter your M-Pesa number, for example:
                    <strong>254768282146</strong>
                </p>


                <button
                    type="submit"
                    id="pay-button"
                    class="w-full mt-6 rounded-xl bg-blue-600 px-5 py-3 text-white font-semibold text-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                >

                    <span id="pay-button-text">
                        Pay KES {{ number_format($package->price, 2) }}
                    </span>

                </button>

            </form>

        </div>


        {{-- Explanation --}}

        <div class="rounded-xl bg-green-50 border border-green-100 p-4">

            <p class="text-sm text-green-800">

                <strong>How it works:</strong>

                After you click Pay, an M-Pesa payment request
                will be sent directly to your phone.

                Check your phone and enter your M-Pesa PIN
                to complete the payment.

            </p>

        </div>


        {{-- Security --}}

        <p class="text-xs text-gray-500 text-center mt-5">

            Your payment is securely processed through IntaSend.

        </p>

    </div>

</div>


<script>

document
    .getElementById('payment-form')
    .addEventListener('submit', function () {

        const button =
            document.getElementById('pay-button');

        const text =
            document.getElementById('pay-button-text');


        button.disabled = true;

        text.textContent =
            'Sending M-Pesa Request...';

    });

</script>

@endsection