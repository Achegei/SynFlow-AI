@extends('layouts.app')

@section('content')

<div class="min-h-screen">

    {{-- ============================================================
         PAGE HEADER
    ============================================================= --}}

    <div class="mb-10">

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5">

            <div>

                <div class="inline-flex items-center gap-2 mb-3">

                    <span class="w-2.5 h-2.5 rounded-full bg-[#D71920]"></span>

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-[#2F6BFF]">
                        Moose Loon AI Academy
                    </span>

                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-[#061638]">
                    Your AI Classroom
                </h1>

                <p class="mt-3 text-gray-500 max-w-2xl leading-relaxed">
                    Build practical AI skills through structured, self-paced learning designed
                    for the modern workforce.
                </p>

            </div>


            <div class="hidden sm:flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">

                    <svg
                        class="w-5 h-5 text-[#2F6BFF]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-xs text-gray-400">
                        Learning mode
                    </p>

                    <p class="text-sm font-bold text-[#061638]">
                        Self Paced
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
         COURSE GRID
    ============================================================= --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">

        @forelse ($courses as $course)

            @php

                /*
                |--------------------------------------------------------------------------
                | SMART COURSE ACCESS
                |--------------------------------------------------------------------------
                |
                | The Course model determines whether the currently logged-in
                | user has access.
                |
                | Access can come from:
                |
                | 1. Institution pathway
                |    -> course_user
                |
                | 2. AI pathway
                |    -> active LearningAccess
                |
                | The Blade does NOT care which pathway was used.
                |
                */

                $hasAccess = auth()->check()
                    && $course->hasAccessForUser(auth()->user());


                /*
                |--------------------------------------------------------------------------
                | CHECK FOR RECENT PENDING PAYMENT
                |--------------------------------------------------------------------------
                |
                | This is only used to prevent the user from repeatedly
                | starting another payment while the previous one is
                | still being confirmed.
                |
                */

                $pendingPayment = auth()->check()
                    ? \App\Models\Payment::where('user_id', auth()->id())
                        ->where('course_id', $course->id)
                        ->where('status', 'pending')
                        ->where('provider', 'intasend')
                        ->where('created_at', '>=', now()->subMinutes(10))
                        ->exists()
                    : false;

            @endphp


            {{-- ====================================================
                 COURSE CARD
            ===================================================== --}}

            <div
                class="
                    group
                    relative
                    bg-white
                    rounded-3xl
                    overflow-hidden
                    border
                    border-gray-100
                    shadow-sm
                    hover:shadow-2xl
                    hover:-translate-y-1
                    transition-all
                    duration-300
                "
            >

                {{-- =================================================
                     COURSE IMAGE
                ================================================== --}}

                <div class="relative h-56 overflow-hidden">

                    <img
                        src="{{ $course->image_url }}"
                        alt="{{ $course->title }}"
                        class="
                            w-full
                            h-full
                            object-cover
                            transition-transform
                            duration-700
                            group-hover:scale-105
                            {{ !$hasAccess ? 'opacity-75' : '' }}
                        "
                    >


                    {{-- Image overlay --}}

                    <div
                        class="
                            absolute
                            inset-0
                            bg-gradient-to-t
                            from-[#061638]/80
                            via-transparent
                            to-transparent
                        "
                    ></div>


                    {{-- =================================================
                         COURSE STATUS
                    ================================================== --}}

                    <div class="absolute top-4 left-4">

                        @if ($hasAccess)

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-1.5
                                    bg-white/95
                                    backdrop-blur-md
                                    text-[#061638]
                                    text-xs
                                    font-bold
                                    px-3
                                    py-1.5
                                    rounded-full
                                    shadow-sm
                                "
                            >

                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                Available

                            </span>

                        @else

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-1.5
                                    bg-[#061638]/90
                                    backdrop-blur-md
                                    text-white
                                    text-xs
                                    font-bold
                                    px-3
                                    py-1.5
                                    rounded-full
                                    border
                                    border-white/10
                                "
                            >

                                <span class="w-1.5 h-1.5 rounded-full bg-[#D71920]"></span>

                                Premium

                            </span>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     COURSE CONTENT
                ================================================== --}}

                <div class="p-6">

                    <h2
                        class="
                            text-xl
                            font-extrabold
                            text-[#061638]
                            leading-snug
                            line-clamp-2
                        "
                    >
                        {{ $course->title }}
                    </h2>


                    <p
                        class="
                            mt-3
                            text-sm
                            text-gray-500
                            leading-relaxed
                            line-clamp-3
                        "
                    >
                        {{ $course->description }}
                    </p>


                    {{-- =================================================
                         COURSE META
                    ================================================== --}}

                    <div class="flex items-center justify-between mt-6">

                        <div class="flex items-center gap-2 text-gray-500">

                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 text-[#2F6BFF]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"
                                    />
                                </svg>

                            </div>

                            <span class="text-sm font-medium">
                                {{ $course->modules->count() }} Modules
                            </span>

                        </div>


                        <span class="text-xs font-bold text-[#2F6BFF]">
                            AI & Automation
                        </span>

                    </div>


                    {{-- =================================================
                         ACTION AREA
                    ================================================== --}}

                    @if ($hasAccess)

                        {{-- =============================================
                             USER HAS ACCESS
                        ============================================== --}}

                        <a
                            href="{{ route('classroom.show', $course->id) }}"
                            class="
                                mt-6
                                flex
                                items-center
                                justify-center
                                gap-2
                                w-full
                                rounded-2xl
                                bg-[#2F6BFF]
                                px-5
                                py-4
                                text-sm
                                font-extrabold
                                text-white
                                shadow-lg
                                shadow-blue-500/20
                                hover:bg-[#1F56D8]
                                hover:shadow-xl
                                focus:outline-none
                                focus:ring-4
                                focus:ring-blue-100
                                active:scale-[0.99]
                                transition-all
                                duration-200
                            "
                        >

                            <span>
                                Continue Course
                            </span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"
                                />
                            </svg>

                        </a>


                    @else

                        {{-- =============================================
                             USER DOES NOT HAVE ACCESS
                        ============================================== --}}

                        @if ($pendingPayment)

                            {{-- =========================================
                                 PAYMENT PROCESSING
                            ========================================== --}}

                            <div
                                class="
                                    mt-6
                                    w-full
                                    rounded-2xl
                                    bg-amber-50
                                    border
                                    border-amber-100
                                    px-4
                                    py-4
                                "
                            >

                                <div class="flex items-center gap-3">

                                    <div
                                        class="
                                            w-10
                                            h-10
                                            rounded-xl
                                            bg-amber-100
                                            flex
                                            items-center
                                            justify-center
                                            shrink-0
                                        "
                                    >
                                        <span class="text-lg">
                                            ⏳
                                        </span>
                                    </div>

                                    <div>

                                        <p class="text-sm font-bold text-amber-800">
                                            Payment processing
                                        </p>

                                        <p class="text-xs text-amber-700 mt-0.5">
                                            We're confirming your M-PESA payment.
                                        </p>

                                    </div>

                                </div>

                            </div>


                        @else

                            {{-- =========================================
                                 PAYMENT BUTTON
                            ========================================== --}}

                            <form
                                action="{{ route('purchase.course', $course->id) }}"
                                method="POST"
                                class="mt-6"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="
                                        w-full
                                        group/button
                                        relative
                                        overflow-hidden
                                        flex
                                        items-center
                                        justify-center
                                        gap-3
                                        rounded-2xl
                                        bg-[#061638]
                                        px-5
                                        py-4
                                        text-sm
                                        font-extrabold
                                        text-white
                                        shadow-lg
                                        shadow-[#061638]/20
                                        hover:bg-[#0B2554]
                                        hover:shadow-xl
                                        hover:shadow-[#061638]/25
                                        focus:outline-none
                                        focus:ring-4
                                        focus:ring-blue-100
                                        active:scale-[0.99]
                                        transition-all
                                        duration-200
                                    "
                                >

                                    <span
                                        class="
                                            absolute
                                            inset-0
                                            bg-gradient-to-r
                                            from-transparent
                                            via-white/10
                                            to-transparent
                                            -translate-x-full
                                            group-hover/button:translate-x-full
                                            transition-transform
                                            duration-700
                                        "
                                    ></span>


                                    {{-- M-PESA icon-style badge --}}

                                    <span
                                        class="
                                            relative
                                            flex
                                            items-center
                                            justify-center
                                            w-8
                                            h-8
                                            rounded-lg
                                            bg-[#D71920]
                                            text-white
                                            font-black
                                            text-[10px]
                                        "
                                    >
                                        M
                                    </span>


                                    {{-- NO PRICE HERE --}}

                                    <span class="relative">
                                        Pay with M-PESA
                                    </span>


                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="relative w-4 h-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"
                                        />
                                    </svg>

                                </button>

                            </form>


                            <div class="mt-3 flex items-center justify-center gap-2">

                                <svg
                                    class="w-4 h-4 text-green-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2V9a2 2 0 00-2-2h-1V5a3 3 0 00-6 0v2H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>

                                <span class="text-xs text-gray-400">
                                    Secure M-PESA payment
                                </span>

                            </div>

                        @endif

                    @endif

                </div>

            </div>

        @empty

            {{-- ====================================================
                 EMPTY STATE
            ===================================================== --}}

            <div
                class="
                    md:col-span-2
                    xl:col-span-3
                    bg-white
                    rounded-3xl
                    border
                    border-gray-100
                    shadow-sm
                    p-12
                    text-center
                "
            >

                <div
                    class="
                        mx-auto
                        w-16
                        h-16
                        rounded-2xl
                        bg-blue-50
                        flex
                        items-center
                        justify-center
                        text-[#2F6BFF]
                    "
                >

                    <svg
                        class="w-8 h-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"
                        />
                    </svg>

                </div>

                <h3 class="mt-5 text-xl font-extrabold text-[#061638]">
                    No courses available
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Your learning content will appear here once courses are available.
                </p>

            </div>

        @endforelse

    </div>


    {{-- ============================================================
         BRAND FOOTNOTE
    ============================================================= --}}

    <div class="mt-10 flex justify-center">

        <div
            class="
                inline-flex
                items-center
                gap-2
                text-xs
                text-gray-400
            "
        >

            <span class="w-2 h-2 rounded-full bg-[#D71920]"></span>

            Canadian Practical AI Skills for the Modern Workforce

        </div>

    </div>

</div>

@endsection