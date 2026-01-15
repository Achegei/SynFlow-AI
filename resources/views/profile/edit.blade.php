@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 🔥 Referral Box -->
            <div class="p-4 sm:p-8 bg-green-50 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <p class="text-green-800 font-semibold mb-2">🎯 Your Referral Link</p>

                    <div class="flex items-center justify-between bg-green-100 rounded px-3 py-2">
                        <input type="text"
                               readonly
                               id="referralInput"
                               class="w-full bg-green-100 text-green-900 font-bold focus:outline-none"
                               value="{{ url('/register?ref=' . auth()->user()->referral_code) }}" />

                        <button onclick="copyReferralLink()"
                                class="ml-2 px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">
                            Copy
                        </button>
                    </div>

                    <p class="text-green-900 text-sm mt-2">
                        Share this link to invite friends and earn rewards for every signup!
                    </p>
                </div>
            </div>

            <!-- Profile Information Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Copy to Clipboard Script -->
    <script>
        function copyReferralLink() {
            const referralInput = document.getElementById('referralInput');
            referralInput.select();
            referralInput.setSelectionRange(0, 99999); // Mobile devices
            navigator.clipboard.writeText(referralInput.value).then(() => {
                alert('Referral link copied to clipboard!');
            });
        }
    </script>
