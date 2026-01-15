@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">
        Moose Loon AI Solutions
    </h1>

    @auth
    <div class="mb-6 flex items-center space-x-4">
        <button onclick="copyReferralMessage()"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">
            Copy Your Referral Message
        </button>
        <span class="text-gray-700 text-sm">
            Share this message with friends to give them access and earn rewards!
        </span>
        <span id="copyStatus" class="text-green-800 font-medium hidden">Copied!</span>
    </div>
    @endauth

    @php
        $user = auth()->user()?->fresh('courses');
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($courses as $course)
        @php
            $isFreeCourse = (int) $course->id === 1;

            $hasAccess = $isFreeCourse
                ? true
                : ($user && $user->courses->contains($course->id));

            $pendingPayment = (!$isFreeCourse && $user)
                ? \App\Models\Payment::where('user_id', $user->id)
                    ->where('course_id', $course->id)
                    ->where('status', 'pending')
                    ->where('provider', 'intasend')
                    ->where('created_at', '>=', now()->subMinutes(2))
                    ->exists()
                : false;
        @endphp

        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                 class="w-full h-48 object-cover rounded-t-2xl {{ !$hasAccess ? 'opacity-60' : '' }}">

            <div class="p-6">
                <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                <p class="mt-2 text-sm text-gray-600">{{ $course->description }}</p>

                @if ($isFreeCourse)
                    <a href="{{ route('classroom.show', $course->id) }}"
                       class="inline-block w-full text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 mt-4">
                        Start Free Course
                    </a>
                    <p class="mt-2 text-xs text-gray-500 text-center italic">
                        Certificate not available for this course
                    </p>
                @elseif ($hasAccess)
                    <a href="{{ route('classroom.show', $course->id) }}"
                       class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mt-4">
                        Continue Course
                    </a>
                @elseif ($pendingPayment)
                    <div class="mt-4 text-center bg-yellow-100 text-yellow-700 px-4 py-2 rounded-lg">
                        ⏳ Your M-PESA payment is being processed
                    </div>
                @else
                    <form action="{{ route('purchase.course', $course->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                                class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Pay with M-PESA to Unlock
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection

@auth
<script>
function copyReferralMessage() {
    // Full message with plain URL (clickable in WhatsApp, Messenger, SMS, email)
    const referralLink = "{{ url('/register?ref=' . auth()->user()->referral_code) }}";

    const message = `Join Moose Loon AI to learn AI sales skills and AI business solutions and get a Canadian recognized certificate.
Upon completion, you will partner with Moose Loon AI and earn income.
Join now: ${referralLink}`;

    // Copy to clipboard
    navigator.clipboard.writeText(message).then(() => {
        const status = document.getElementById('copyStatus');
        status.classList.remove('hidden');
        setTimeout(() => status.classList.add('hidden'), 2000);
    });
}
</script>
@endauth
