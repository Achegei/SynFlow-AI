@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">
        Moose Loon AI Solutions
    </h1>

    <!--@auth
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
    @endauth -->

    @php
        $user = auth()->user()?->fresh('courses');
    @endphp

   <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
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

        <div class="group bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative">

    <img
        src="{{ $course->image_url }}"
        alt="{{ $course->title }}"
        class="w-full h-52 object-cover group-hover:scale-105 transition duration-500 {{ !$hasAccess ? 'opacity-70' : '' }}"
    >

    <div class="absolute top-4 left-4">

        @if($isFreeCourse)

            <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                Self Paced
            </span>

        @elseif($hasAccess)

            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                Enrolled
            </span>

        @else

            <span class="bg-black/70 text-white text-xs font-semibold px-3 py-1 rounded-full">
                Premium
            </span>

        @endif

    </div>

</div>

            <div class="p-5">
            <h2 class="text-xl font-bold text-gray-900 leading-snug line-clamp-2">
                    {{ $course->title }}
            </h2>

                <p class="mt-3 text-sm text-gray-500 leading-relaxed line-clamp-3">
                    {{ $course->description }}
                </p>
                <div class="flex items-center justify-between mt-5 text-sm">

                    <div class="flex items-center gap-2 text-gray-500">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3
                                    3-1.343 3-3-1.343-3-3-3z" />
                        </svg>

                        <span>
                            {{ $course->modules->count() }} Modules
                        </span>

                    </div>

                    <div class="text-blue-600 font-semibold">
                        AI Automation
                    </div>

                </div>

                @if ($isFreeCourse)
                    <a href="{{ route('classroom.show', $course->id) }}"
                       class="inline-block w-full text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 mt-4">
                        Start Free Course
                    </a>

                @elseif ($hasAccess)
                    <a href="{{ route('classroom.show', $course->id) }}"
                       class="mt-6 flex items-center justify-center w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                        Continue Course
                    </a>
                @elseif ($pendingPayment)
                    <div class="mt-6 flex items-center justify-center w-full bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-900 transition"">
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
<div class="mt-4 flex items-center justify-between text-xs text-gray-400">

    <span>Beginner Friendly</span>

    <span>Self Paced</span>

</div>
</div>
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
