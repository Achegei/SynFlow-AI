@extends('layouts.app')

@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | COURSE ACCESS RULE
    |--------------------------------------------------------------------------
    |
    | ONLY COURSE ID 5 IS PAID.
    | EVERY OTHER COURSE IS OPEN.
    |
    */

    $isPaidCourse = (int) $course->id === 1;

    /*
    |--------------------------------------------------------------------------
    | REFRESH AUTHENTICATED USER
    |--------------------------------------------------------------------------
    |
    | This is important after payment.
    | If the payment process has attached course #5 to the user,
    | we want the latest relationship from the database.
    |
    */

    $user = auth()->check()
        ? auth()->user()->fresh([
            'courses',
            'watchedEpisodes',
        ])
        : null;

    /*
    |--------------------------------------------------------------------------
    | COURSE ACCESS
    |--------------------------------------------------------------------------
    |
    | Courses 1-4 and every course other than #5 are open.
    |
    | Course #5 requires the user to have the course in their
    | courses relationship.
    |
    */

    $hasAccess = !$isPaidCourse
        ? true
        : (
            $user &&
            $user->courses->contains('id', (int) $course->id)
        );

    /*
    |--------------------------------------------------------------------------
    | PENDING PAYMENT
    |--------------------------------------------------------------------------
    |
    | Pending-payment logic applies ONLY to Course #5.
    |
    */

    $pendingPayment = false;

    if ($isPaidCourse && $user) {

        $pendingPayment = \App\Models\Payment::query()
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'pending')
            ->where('provider', 'intasend')
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists();

    }

@endphp


{{-- ================================================================
     PAGE
================================================================ --}}

<div class="min-h-screen bg-slate-50">

    {{-- ============================================================
         BRAND HERO
    ============================================================= --}}

    <div class="relative overflow-hidden bg-[#061638]">

        {{-- Background effects --}}

        <div
            class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-[#123A78] opacity-40 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="absolute -right-32 top-1/3 w-96 h-96 rounded-full bg-[#D71920] opacity-10 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
        >

            {{-- Back --}}

            <a
                href="{{ route('classroom') }}"
                class="inline-flex items-center gap-2 text-white/70 hover:text-white text-sm font-medium transition"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Courses

            </a>


            {{-- Course heading --}}

            <div class="mt-8 max-w-4xl">

                <div class="flex flex-wrap items-center gap-3 mb-4">

                    @if ($isPaidCourse)

                        <span
                            class="inline-flex items-center gap-2 bg-[#D71920] text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide"
                        >
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            Premium Course
                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-2 bg-white/10 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide border border-white/10"
                        >
                            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                            Open Course
                        </span>

                    @endif

                </div>


                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white"
                >
                    {{ $course->title }}
                </h1>


                <p class="mt-4 text-white/65 max-w-3xl leading-relaxed">
                    {{ \Illuminate\Support\Str::limit($course->description, 220) }}
                </p>


                {{-- Course metadata --}}

                <div class="flex flex-wrap gap-3 mt-6">

                    <span class="inline-flex items-center gap-2 bg-white/10 text-white/80 px-4 py-2 rounded-xl text-sm">
                        📚 {{ $course->modules->count() }} Modules
                    </span>

                    <span class="inline-flex items-center gap-2 bg-white/10 text-white/80 px-4 py-2 rounded-xl text-sm">
                        🎓 Practical AI Skills
                    </span>

                    <span class="inline-flex items-center gap-2 bg-white/10 text-white/80 px-4 py-2 rounded-xl text-sm">
                        💼 Modern Workforce
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
         MAIN CONTENT
    ============================================================= --}}

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">


        {{-- ========================================================
             PAYMENT REQUIRED
        ========================================================= --}}

        @if (!$hasAccess)

            <div class="max-w-3xl mx-auto">

                <div
                    class="relative overflow-hidden bg-white rounded-3xl border border-gray-200 shadow-xl"
                >

                    {{-- Top brand strip --}}

                    <div class="h-2 bg-gradient-to-r from-[#061638] via-[#123A78] to-[#D71920]"></div>


                    <div class="p-7 sm:p-10 text-center">

                        {{-- Icon --}}

                        <div
                            class="mx-auto w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center"
                        >

                            <svg
                                class="w-10 h-10 text-[#123A78]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2V9a2 2 0 00-2-2h-1V5a3 3 0 00-6 0v2H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>

                        </div>


                        <p
                            class="mt-6 text-xs font-bold uppercase tracking-[0.2em] text-[#D71920]"
                        >
                            Premium AI Training
                        </p>


                        <h2
                            class="mt-2 text-2xl sm:text-3xl font-extrabold text-[#061638]"
                        >
                            Unlock This Course
                        </h2>


                        <p class="mt-4 text-gray-500 leading-relaxed max-w-xl mx-auto">

                            This course is part of the Moose Loon AI Academy
                            premium training programme.

                            Complete your payment to unlock the full classroom,
                            including lessons, quizzes and assignments.

                        </p>


                        {{-- Price --}}

                        <div class="mt-7">

                            <div
                                class="inline-flex items-baseline gap-2 bg-slate-50 border border-gray-200 rounded-2xl px-6 py-4"
                            >

                                <span class="text-sm font-semibold text-gray-500">
                                    Course Fee
                                </span>

                                <span
                                    class="text-3xl font-extrabold text-[#061638]"
                                >
                                    KES 10,000
                                </span>

                            </div>

                        </div>


                        {{-- Pending payment --}}

                        @if ($pendingPayment)

                            <div
                                class="mt-7 bg-amber-50 border border-amber-200 rounded-2xl p-5 text-left"
                            >

                                <div class="flex items-start gap-3">

                                    <div class="text-xl">
                                        ⏳
                                    </div>

                                    <div>

                                        <p class="font-bold text-amber-800">
                                            Payment is being processed
                                        </p>

                                        <p class="mt-1 text-sm text-amber-700 leading-relaxed">
                                            We have received your payment request.
                                            Once M-PESA confirms the payment,
                                            your course will automatically unlock.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @else

                            {{-- Pay button --}}

                            <form
                                action="{{ route('purchase.course', $course->id) }}"
                                method="POST"
                                class="mt-8"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="group w-full sm:w-auto min-w-[280px] inline-flex items-center justify-center gap-3 rounded-2xl bg-[#D71920] hover:bg-[#b9151b] px-8 py-4 text-white font-extrabold shadow-xl shadow-red-900/10 transition-all duration-200 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-red-100"
                                >

                                    <span class="text-xl">
                                        📱
                                    </span>

                                    <span>
                                        Pay KES 10,000 with M-PESA
                                    </span>

                                    <svg
                                        class="w-5 h-5 transition-transform group-hover:translate-x-1"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"
                                        />
                                    </svg>

                                </button>

                            </form>

                        @endif


                        <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-400">

                            <span class="w-2 h-2 rounded-full bg-[#D71920]"></span>

                            Secure M-PESA payment

                        </div>

                    </div>

                </div>

            </div>


        {{-- ========================================================
             COURSE AVAILABLE
        ========================================================= --}}

        @else


            {{-- ====================================================
                 COURSE INFORMATION CARD
            ===================================================== --}}

            <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden mb-10">

                <div class="p-6 sm:p-8">

                    <div class="flex flex-col lg:flex-row gap-7">

                        {{-- Image --}}

                        <div class="w-full lg:w-80 shrink-0">

                            <img
                                src="{{ $course->image_url }}"
                                alt="{{ $course->title }}"
                                class="w-full h-56 object-cover rounded-2xl"
                            >

                        </div>


                        {{-- Details --}}

                        <div class="flex-1">

                            <div class="flex flex-wrap items-center gap-2">

                                <span
                                    class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold"
                                >
                                    ✓ Enrolled
                                </span>

                                @if ($isPaidCourse)

                                    <span
                                        class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold"
                                    >
                                        Premium
                                    </span>

                                @else

                                    <span
                                        class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold"
                                    >
                                        Open Access
                                    </span>

                                @endif

                            </div>


                            <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold text-[#061638]">
                                {{ $course->title }}
                            </h2>


                            <div x-data="{ expanded: false }" class="mt-3">

                                <p class="text-gray-600 leading-relaxed">

                                    <span x-show="!expanded">
                                        {{ \Illuminate\Support\Str::limit($course->description, 250) }}
                                    </span>

                                    <span x-show="expanded">
                                        {{ $course->description }}
                                    </span>

                                </p>


                                <button
                                    type="button"
                                    @click="expanded = !expanded"
                                    class="text-[#123A78] text-sm mt-2 font-bold hover:underline"
                                >
                                    <span x-text="expanded ? 'View less' : 'View more'"></span>
                                </button>

                            </div>


                            {{-- Progress --}}

                            <div class="mt-7">

                                <div class="flex items-center justify-between mb-2">

                                    <span class="text-sm font-semibold text-gray-600">
                                        Course Progress
                                    </span>

                                    <span class="text-sm font-extrabold text-[#123A78]">
                                        {{ number_format($course->progress_percentage) }}%
                                    </span>

                                </div>


                                <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">

                                    <div
                                        class="bg-gradient-to-r from-[#123A78] to-[#2F6BFF] h-3 rounded-full transition-all"
                                        style="width: {{ $course->progress_percentage }}%"
                                    ></div>

                                </div>

                            </div>


                            {{-- Certificate --}}

                            @if ($isPaidCourse && $course->progress_percentage == 100)

                                <button
                                    type="button"
                                    @click="showCertificateModal = true"
                                    class="mt-6 inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-bold shadow-lg transition"
                                >
                                    🎉 Download Your Certificate
                                </button>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 CERTIFICATE MODAL
            ===================================================== --}}

            @if ($isPaidCourse && $course->progress_percentage == 100)

                <div
                    x-data="{ showCertificateModal: false }"
                    x-show="showCertificateModal"
                    x-cloak
                    class="fixed inset-0 flex items-center justify-center bg-black/60 backdrop-blur-sm z-50 px-4"
                >

                    <div
                        @click.outside="showCertificateModal = false"
                        class="bg-white rounded-3xl p-7 max-w-md w-full shadow-2xl"
                    >

                        <h3 class="text-2xl font-extrabold text-[#061638]">
                            Download Your Certificate
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Enter your official name exactly as you want it to appear on your certificate.
                        </p>


                        <form
                            action="{{ route('certificate.download', $course->id) }}"
                            method="POST"
                            class="mt-6"
                        >

                            @csrf

                            <input
                                type="text"
                                name="full_name"
                                required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3.5 focus:border-[#123A78] focus:ring-4 focus:ring-blue-50 outline-none"
                                placeholder="e.g. John Doe"
                            >


                            <div class="flex justify-end gap-3 mt-5">

                                <button
                                    type="button"
                                    @click="showCertificateModal = false"
                                    class="px-5 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200"
                                >
                                    Cancel
                                </button>


                                <button
                                    type="submit"
                                    class="px-5 py-3 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700"
                                >
                                    Download
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            @endif


            {{-- ====================================================
                 VIDEO PLAYER
            ===================================================== --}}

            <div
                id="video-player"
                class="mt-8 hidden"
            >

                <div class="bg-white rounded-3xl shadow-xl p-4 border border-gray-100">

                    <div
                        id="youtube-player"
                        class="w-full h-[450px] rounded-2xl overflow-hidden"
                    ></div>

                </div>

            </div>


            {{-- ====================================================
                 MODULES
            ===================================================== --}}

            <div class="mt-12">

                <div class="flex items-end justify-between gap-4 mb-8">

                    <div>

                        <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-[#D71920]">
                            Your Learning Path
                        </p>

                        <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-[#061638]">
                            Course Modules
                        </h2>

                    </div>

                    <div class="hidden sm:block text-sm text-gray-400">
                        {{ $course->modules->count() }} modules
                    </div>

                </div>


                @forelse ($course->modules as $module)

                    <div
                        x-data="{
                            open: {{ $loop->first ? 'true' : 'false' }},
                            tab: 'lessons'
                        }"
                        class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-7"
                    >

                        {{-- MODULE HEADER --}}

                        <div
                            @click="open = !open"
                            class="p-6 sm:p-8 cursor-pointer hover:bg-gray-50 transition"
                        >

                            <div class="flex items-start justify-between gap-6">

                                <div class="flex gap-4 sm:gap-5">

                                    <div
                                        class="w-14 h-14 sm:w-16 sm:h-16 shrink-0 rounded-2xl bg-blue-50 text-[#123A78] flex items-center justify-center text-xl font-extrabold"
                                    >
                                        {{ $loop->iteration }}
                                    </div>


                                    <div>

                                        <h3 class="text-xl sm:text-2xl font-extrabold text-[#061638]">
                                            {{ $module->title }}
                                        </h3>


                                        <div class="flex flex-wrap gap-2 mt-3">

                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $module->episodes->count() }} Lessons
                                            </span>

                                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $module->quizzes->count() }} Quizzes
                                            </span>

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $module->assignments->count() }} Assignments
                                            </span>

                                        </div>


                                        @if ($module->description)

                                            <div
                                                x-data="{ expanded: false }"
                                                class="mt-4"
                                            >

                                                <p class="text-gray-600 leading-relaxed">

                                                    <span x-show="!expanded">
                                                        {{ \Illuminate\Support\Str::limit($module->description, 220) }}
                                                    </span>

                                                    <span x-show="expanded">
                                                        {{ $module->description }}
                                                    </span>

                                                </p>


                                                <button
                                                    type="button"
                                                    @click.stop="expanded = !expanded"
                                                    class="text-[#123A78] text-sm mt-2 font-bold hover:underline"
                                                >
                                                    <span x-text="expanded ? 'View less' : 'View more'"></span>
                                                </button>

                                            </div>

                                        @endif

                                    </div>

                                </div>


                                <svg
                                    class="w-6 h-6 text-gray-400 transition shrink-0"
                                    :class="{ 'rotate-180': open }"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"
                                    />
                                </svg>

                            </div>

                        </div>


                        {{-- MODULE CONTENT --}}

                        <div
                            x-show="open"
                            x-transition
                            class="border-t border-gray-100"
                        >

                            {{-- TABS --}}

                            <div class="px-6 sm:px-8 pt-6">

                                <div class="flex gap-6 border-b overflow-x-auto">

                                    <button
                                        type="button"
                                        @click="tab='lessons'"
                                        class="pb-4 text-sm font-bold whitespace-nowrap"
                                        :class="tab === 'lessons'
                                            ? 'text-blue-600 border-b-2 border-blue-600'
                                            : 'text-gray-500'"
                                    >
                                        📺 Lessons
                                    </button>


                                    <button
                                        type="button"
                                        @click="tab='quizzes'"
                                        class="pb-4 text-sm font-bold whitespace-nowrap"
                                        :class="tab === 'quizzes'
                                            ? 'text-purple-600 border-b-2 border-purple-600'
                                            : 'text-gray-500'"
                                    >
                                        🧠 Quizzes
                                    </button>


                                    <button
                                        type="button"
                                        @click="tab='assignments'"
                                        class="pb-4 text-sm font-bold whitespace-nowrap"
                                        :class="tab === 'assignments'
                                            ? 'text-green-600 border-b-2 border-green-600'
                                            : 'text-gray-500'"
                                    >
                                        📝 Assignments
                                    </button>

                                </div>

                            </div>


                            {{-- =================================================
                                 LESSONS
                            ================================================== --}}

                            <div
                                x-show="tab === 'lessons'"
                                class="p-6 sm:p-8 space-y-5"
                            >

                                @forelse ($module->episodes as $episode)

                                    @php

                                        parse_str(
                                            parse_url(
                                                $episode->video_url,
                                                PHP_URL_QUERY
                                            ),
                                            $youtubeParams
                                        );

                                        $videoId =
                                            $youtubeParams['v']
                                            ?? $episode->video_url;

                                    @endphp


                                    <div
                                        onclick="playEpisode('{{ $videoId }}', {{ $episode->id }})"
                                        class="border border-gray-200 rounded-2xl p-5 hover:border-blue-300 hover:shadow-md transition cursor-pointer group"
                                    >

                                        <div class="flex items-start justify-between gap-4">

                                            <div class="flex gap-4">

                                                <div
                                                    class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0 group-hover:bg-blue-600 transition"
                                                >

                                                    <svg
                                                        class="w-6 h-6 text-blue-600 group-hover:text-white"
                                                        fill="currentColor"
                                                        viewBox="0 0 20 20"
                                                    >
                                                        <path d="M6 4l10 6-10 6V4z"></path>
                                                    </svg>

                                                </div>


                                                <div>

                                                    <h4 class="font-extrabold text-gray-900 text-lg group-hover:text-blue-600 transition">
                                                        {{ $episode->title }}
                                                    </h4>


                                                    @if ($episode->description)

                                                        <p class="text-sm text-gray-500 mt-1">
                                                            {{ $episode->description }}
                                                        </p>

                                                    @endif


                                                    <div class="flex flex-wrap gap-2 mt-3">

                                                        <span class="text-xs bg-gray-100 px-3 py-1 rounded-full">
                                                            📺 Video Lesson
                                                        </span>


                                                        @if ($episode->pdf_path)

                                                            <a
                                                                href="{{ asset('storage/' . $episode->pdf_path) }}"
                                                                target="_blank"
                                                                onclick="event.stopPropagation()"
                                                                class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full hover:bg-blue-200"
                                                            >
                                                                📄 Open Notes
                                                            </a>

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>


                                            <div class="shrink-0">

                                                @if (
                                                    $user &&
                                                    $user->watchedEpisodes->contains($episode->id)
                                                )

                                                    <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                                        ✅ Completed
                                                    </div>

                                                @else

                                                    <div class="text-gray-400 text-sm">
                                                        Not Started
                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <p class="text-gray-500">
                                        No lessons yet.
                                    </p>

                                @endforelse

                            </div>


                            {{-- =================================================
                                 QUIZZES
                            ================================================== --}}

                            <div
                                x-show="tab === 'quizzes'"
                                class="p-6 sm:p-8 space-y-6"
                            >

                                @forelse ($module->quizzes as $quiz)

                                    @php

                                        $attempt = $user
                                            ? $user
                                                ->quizAttempts()
                                                ->where('quiz_id', $quiz->id)
                                                ->where('passed', true)
                                                ->latest()
                                                ->first()
                                            : null;

                                    @endphp


                                    <div
                                        x-data="quizComponent({{ $quiz->id }})"
                                        class="bg-purple-50 rounded-2xl p-6 border border-purple-100"
                                    >

                                        <div class="flex items-center justify-between mb-4 gap-4">

                                            <div>

                                                <h4 class="text-xl font-extrabold text-purple-800">
                                                    🧠 {{ $quiz->title }}
                                                </h4>

                                                @if ($quiz->description)

                                                    <p class="text-sm text-gray-600 mt-1">
                                                        {{ $quiz->description }}
                                                    </p>

                                                @endif

                                            </div>


                                            @if ($attempt)

                                                <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                                    ✅ Completed
                                                </div>

                                            @endif

                                        </div>


                                        <div class="space-y-6">

                                            @foreach ($quiz->questions as $question)

                                                <div class="bg-white rounded-xl p-4 shadow-sm">

                                                    <h5 class="font-semibold text-gray-800 mb-4">
                                                        {{ $loop->iteration }}.
                                                        {{ $question->question }}
                                                    </h5>


                                                    <div class="space-y-3">

                                                        @php

                                                            $options = $question->options;

                                                            if (is_string($options)) {
                                                                $options = json_decode($options, true);
                                                            }

                                                            $options = collect($options ?? []);

                                                        @endphp


                                                        @foreach ($options as $key => $option)

                                                            @php
                                                                $key = strtoupper(trim($key));
                                                            @endphp


                                                            <button
                                                                type="button"
                                                                @click="checkAnswer(
                                                                    {{ $question->id }},
                                                                    '{{ $key }}',
                                                                    '{{ $question->correct_answer }}'
                                                                )"
                                                                :disabled="answers[{{ $question->id }}]"
                                                                class="w-full text-left px-4 py-3 rounded-xl border transition"
                                                                :class="getButtonClass(
                                                                    {{ $question->id }},
                                                                    '{{ $key }}',
                                                                    '{{ $question->correct_answer }}'
                                                                )"
                                                            >

                                                                <div class="font-bold uppercase text-purple-600">
                                                                    {{ $key }}
                                                                </div>

                                                                <div class="text-gray-800">
                                                                    {{ $option }}
                                                                </div>

                                                            </button>

                                                        @endforeach

                                                    </div>


                                                    <div
                                                        x-show="feedback[{{ $question->id }}]"
                                                        class="mt-4 text-sm"
                                                    >

                                                        <template x-if="feedback[{{ $question->id }}] === 'correct'">

                                                            <div class="text-blue-700 font-semibold">
                                                                ✅ Correct Answer
                                                            </div>

                                                        </template>


                                                        <template x-if="feedback[{{ $question->id }}] === 'wrong'">

                                                            <div class="text-red-600 font-semibold">
                                                                ❌ Incorrect. Correct answer:
                                                                {{ $question->correct_answer }}
                                                            </div>

                                                        </template>

                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>


                                        <div class="mt-6">

                                            <button
                                                type="button"
                                                @click="submitQuiz"
                                                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold"
                                            >
                                                Submit Quiz
                                            </button>

                                        </div>


                                        <div
                                            x-show="resultVisible"
                                            class="mt-4 bg-white rounded-xl p-4"
                                        >

                                            <h5 class="font-bold text-lg">
                                                Your Score:
                                                <span x-text="score + '%'"></span>
                                            </h5>

                                            <p
                                                class="mt-2 font-medium"
                                                :class="passed ? 'text-green-600' : 'text-red-600'"
                                            >
                                                <span
                                                    x-text="passed
                                                        ? 'Quiz Completed ✅'
                                                        : 'Please Retry Incorrect Answers'"
                                                ></span>
                                            </p>

                                        </div>

                                    </div>

                                @empty

                                    <p class="text-gray-500">
                                        No quizzes yet.
                                    </p>

                                @endforelse

                            </div>


                            {{-- =================================================
                                 ASSIGNMENTS
                            ================================================== --}}

                            <div
                                x-show="tab === 'assignments'"
                                class="p-6 sm:p-8 space-y-5"
                            >

                                @forelse ($module->assignments as $assignment)

                                    <div
                                        class="bg-white border border-green-100 rounded-2xl p-6 shadow-sm"
                                    >

                                        <div class="flex items-start gap-4">

                                            <div
                                                class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center shrink-0"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-7 h-7 text-green-700"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                                    />
                                                </svg>

                                            </div>


                                            <div class="flex-1">

                                                <div class="flex items-center justify-between gap-4 flex-wrap">

                                                    <h4 class="text-xl font-extrabold text-gray-900">
                                                        📝 {{ $assignment->title }}
                                                    </h4>

                                                    <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                                        Assignment
                                                    </span>

                                                </div>


                                                @if ($assignment->instructions)

                                                    <div class="mt-4 text-gray-700 leading-relaxed whitespace-pre-line">
                                                        {{ $assignment->instructions }}
                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-6 rounded-2xl">
                                        No assignments yet.
                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-6 rounded-2xl">
                        No modules available for this course yet.
                    </div>

                @endforelse

            </div>

        @endif

    </main>


    {{-- ============================================================
         BRAND FOOTER
    ============================================================= --}}

    <div class="border-t border-gray-200 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">

                <p class="text-xs text-gray-400">
                    © {{ date('Y') }} Moose Loon AI Academy. All rights reserved.
                </p>

                <div class="inline-flex items-center gap-2 text-xs text-gray-400">

                    <span class="w-2 h-2 rounded-full bg-[#D71920]"></span>

                    Canadian Practical AI Skills for the Modern Workforce

                </div>

            </div>

        </div>

    </div>

</div>

@endsection