@extends('layouts.ai-onboarding')

@section('title')
    AI Learning Assessment | Moose Loon AI Academy
@endsection

@section('content')

<div class="min-h-screen w-full bg-[#F7F9FC]">

    {{-- =========================================================
        ONBOARDING CONTAINER
    ========================================================== --}}
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="flex items-center justify-between mb-6 sm:mb-8">

            {{-- Brand --}}
            <div class="flex items-center min-w-0">

                <div class="flex items-center">

                    {{-- 
                        IMPORTANT:
                        Replace this path if your actual logo is stored elsewhere.
                    --}}
                    <img
                        src="{{ asset('images/synflowlogo.jpeg') }}"
                        alt="Moose Loon AI Academy"
                        class="h-10 sm:h-12 w-auto object-contain"
                    >

                </div>

            </div>

            {{-- Step Counter --}}
            <div class="flex-shrink-0 text-right">

                <p class="text-xs sm:text-sm font-semibold text-[#071A4D]">
                    Step {{ $step }} of {{ $totalSteps }}
                </p>

                <p class="text-xs text-gray-500 mt-0.5">
                    {{ round(($step / $totalSteps) * 100) }}% complete
                </p>

            </div>

        </div>


        {{-- =====================================================
            PROGRESS BAR
        ====================================================== --}}
        <div class="mb-7 sm:mb-10">

            <div
                class="w-full h-1.5 sm:h-2 bg-[#E5EAF2] rounded-full overflow-hidden"
            >

                <div
                    class="h-full bg-[#D71920] rounded-full transition-all duration-500 ease-out"
                    style="width: {{ ($step / $totalSteps) * 100 }}%"
                ></div>

            </div>

            {{-- Small progress labels --}}
            <div class="flex justify-between mt-2">

                <span class="text-[11px] sm:text-xs text-gray-400">
                    Getting started
                </span>

                <span class="text-[11px] sm:text-xs text-gray-400">
                    Your AI learning path
                </span>

            </div>

        </div>


        {{-- =====================================================
            MAIN CONTENT
        ====================================================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-6 lg:gap-8">


            {{-- =================================================
                LEFT BRAND / CONTEXT PANEL
            ================================================== --}}
            <aside class="hidden lg:flex flex-col">

                <div
                    class="bg-[#071A4D] rounded-2xl p-6 text-white sticky top-6"
                >

                    {{-- Small brand marker --}}
                    <div class="flex items-center gap-2 mb-6">

                        <div class="w-2 h-2 rounded-full bg-[#D71920]"></div>

                        <span
                            class="text-xs font-semibold tracking-wide uppercase text-white/80"
                        >
                            Moose Loon AI Academy
                        </span>

                    </div>


                    <h2 class="text-xl font-bold leading-tight">
                        Build the AI skills
                        <span class="text-[#D71920]">
                            that move your career forward.
                        </span>
                    </h2>


                    <p class="mt-4 text-sm leading-6 text-white/70">
                        Your answers help us understand your goals and
                        recommend the right learning direction for you.
                    </p>


                    {{-- Divider --}}
                    <div class="my-6 h-px bg-white/10"></div>


                    {{-- Trust points --}}
                    <div class="space-y-4">

                        <div class="flex items-start gap-3">

                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4 text-[#D71920]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold">
                                    Practical learning
                                </p>

                                <p class="text-xs text-white/60 mt-0.5">
                                    Focused on real-world AI skills.
                                </p>
                            </div>

                        </div>


                        <div class="flex items-start gap-3">

                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4 text-[#D71920]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold">
                                    Career-focused
                                </p>

                                <p class="text-xs text-white/60 mt-0.5">
                                    Designed for the modern workforce.
                                </p>
                            </div>

                        </div>


                        <div class="flex items-start gap-3">

                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4 text-[#D71920]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold">
                                    Hands-on projects
                                </p>

                                <p class="text-xs text-white/60 mt-0.5">
                                    Learn by building practical solutions.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </aside>


            {{-- =================================================
                MAIN ONBOARDING CARD
            ================================================== --}}
            <main>

                <div
                    class="bg-white border border-[#E5EAF2] rounded-2xl sm:rounded-3xl shadow-[0_8px_30px_rgba(7,26,77,0.06)] overflow-hidden"
                >

                    {{-- =========================================
                        CARD HEADER
                    ========================================== --}}
                    <div
                        class="px-5 sm:px-8 lg:px-10 pt-6 sm:pt-9 lg:pt-10"
                    >

                        {{-- Mobile-only brand marker --}}
                        <div class="lg:hidden flex items-center gap-2 mb-5">

                            <div
                                class="w-2 h-2 rounded-full bg-[#D71920]"
                            ></div>

                            <span
                                class="text-[11px] font-semibold uppercase tracking-wide text-[#071A4D]"
                            >
                                Moose Loon AI Academy
                            </span>

                        </div>


                        {{-- Step label --}}
                        <div class="mb-3">

                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-[#FDEBEC] text-[#B51218] text-xs font-semibold"
                            >
                                Step {{ $step }} of {{ $totalSteps }}
                            </span>

                        </div>


                        {{-- Title --}}
                        <h1
                            class="text-[26px] leading-tight sm:text-3xl lg:text-[34px] font-bold tracking-tight text-[#071A4D]"
                        >
                            {{ $stepData['title'] }}
                        </h1>


                        {{-- Subtitle --}}
                        <p
                            class="mt-3 text-sm sm:text-base leading-6 text-[#5B6472] max-w-2xl"
                        >
                            {{ $stepData['subtitle'] }}
                        </p>

                    </div>


                    {{-- =========================================
                        FORM
                    ========================================== --}}
                    <form
                        method="POST"
                        action="{{ route('ai.onboarding.store', $step) }}"
                        class="px-5 sm:px-8 lg:px-10 pt-7 sm:pt-9 pb-6 sm:pb-9"
                    >

                        @csrf


                        {{-- =====================================
                            SINGLE SELECTION
                        ====================================== --}}
                        @if($stepData['type'] === 'single')

                            <div class="space-y-3">

                                @foreach($stepData['options'] as $value => $label)

                                    @php
                                        $isSelected =
                                            old(
                                                $stepData['field'],
                                                $data[$stepData['field']] ?? ''
                                            ) === $value;
                                    @endphp

                                    <label
                                        class="block cursor-pointer group"
                                    >

                                        <input
                                            type="radio"
                                            name="{{ $stepData['field'] }}"
                                            value="{{ $value }}"
                                            class="peer sr-only"
                                            {{ $isSelected ? 'checked' : '' }}
                                        >

                                        <div
                                            class="
                                                relative
                                                flex
                                                items-center
                                                gap-4
                                                w-full
                                                min-h-[68px]
                                                p-4
                                                sm:p-5
                                                rounded-xl
                                                border
                                                transition-all
                                                duration-200

                                                border-[#E5EAF2]
                                                bg-white

                                                group-hover:border-[#B8C4D6]
                                                group-hover:shadow-sm

                                                peer-focus-visible:ring-2
                                                peer-focus-visible:ring-[#D71920]
                                                peer-focus-visible:ring-offset-2

                                                peer-checked:border-[#D71920]
                                                peer-checked:bg-[#FFF7F7]
                                                peer-checked:shadow-[0_4px_16px_rgba(215,25,32,0.08)]
                                            "
                                        >

                                            {{-- Selection indicator --}}
                                            <div
                                                class="
                                                    flex-shrink-0
                                                    w-6
                                                    h-6
                                                    rounded-full
                                                    border-2
                                                    border-[#CBD5E1]
                                                    flex
                                                    items-center
                                                    justify-center
                                                    transition-all
                                                    duration-200

                                                    peer-checked:border-[#D71920]
                                                "
                                            >

                                                <div
                                                    class="
                                                        w-2.5
                                                        h-2.5
                                                        rounded-full
                                                        bg-[#D71920]
                                                        opacity-0
                                                        scale-50
                                                        transition-all
                                                        duration-200
                                                        peer-checked:opacity-100
                                                        peer-checked:scale-100
                                                    "
                                                ></div>

                                            </div>


                                            {{-- Label --}}
                                            <div class="flex-1 min-w-0">

                                                <p
                                                    class="text-sm sm:text-base font-semibold text-[#111827] leading-5"
                                                >
                                                    {{ $label }}
                                                </p>

                                            </div>


                                            {{-- Selected check --}}
                                            <div
                                                class="
                                                    flex-shrink-0
                                                    w-7
                                                    h-7
                                                    rounded-full
                                                    bg-[#D71920]
                                                    text-white
                                                    flex
                                                    items-center
                                                    justify-center
                                                    opacity-0
                                                    scale-75
                                                    transition-all
                                                    duration-200
                                                    peer-checked:opacity-100
                                                    peer-checked:scale-100
                                                "
                                            >

                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>

                                            </div>

                                        </div>

                                    </label>

                                @endforeach

                            </div>


                        {{-- =====================================
                            PERSONAL INFORMATION
                        ====================================== --}}
                        @elseif($stepData['type'] === 'personal')

                            <div class="space-y-6">

                                {{-- Full Name --}}
                                <div>

                                    <label
                                        for="name"
                                        class="block text-sm font-semibold text-[#111827] mb-2"
                                    >
                                        Full Name
                                    </label>

                                    <input
                                        id="name"
                                        type="text"
                                        name="name"
                                        value="{{ old('name', $data['name'] ?? '') }}"
                                        required
                                        autocomplete="name"
                                        class="
                                            w-full
                                            h-12
                                            px-4
                                            rounded-xl
                                            border
                                            border-[#D9E0EA]
                                            bg-white
                                            text-[#111827]
                                            text-sm sm:text-base
                                            placeholder:text-[#9CA3AF]
                                            outline-none
                                            transition
                                            focus:border-[#D71920]
                                            focus:ring-2
                                            focus:ring-[#D71920]/10
                                        "
                                        placeholder="Enter your full name"
                                    >

                                </div>


                                {{-- Email --}}
                                <div>

                                    <label
                                        for="email"
                                        class="block text-sm font-semibold text-[#111827] mb-2"
                                    >
                                        Email Address
                                    </label>

                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email', $data['email'] ?? '') }}"
                                        required
                                        autocomplete="email"
                                        class="
                                            w-full
                                            h-12
                                            px-4
                                            rounded-xl
                                            border
                                            border-[#D9E0EA]
                                            bg-white
                                            text-[#111827]
                                            text-sm sm:text-base
                                            placeholder:text-[#9CA3AF]
                                            outline-none
                                            transition
                                            focus:border-[#D71920]
                                            focus:ring-2
                                            focus:ring-[#D71920]/10
                                        "
                                        placeholder="you@example.com"
                                    >

                                    <p class="mt-2 text-xs text-[#6B7280]">
                                        We'll use this to keep your learning information connected to your account.
                                    </p>

                                </div>


                                {{-- WhatsApp --}}
                                <div>

                                    <label
                                        for="whatsapp"
                                        class="block text-sm font-semibold text-[#111827] mb-2"
                                    >
                                        WhatsApp Number
                                        <span class="font-normal text-[#9CA3AF]">
                                            (Optional)
                                        </span>
                                    </label>

                                    <input
                                        id="whatsapp"
                                        type="tel"
                                        name="whatsapp"
                                        value="{{ old('whatsapp', $data['whatsapp'] ?? '') }}"
                                        autocomplete="tel"
                                        class="
                                            w-full
                                            h-12
                                            px-4
                                            rounded-xl
                                            border
                                            border-[#D9E0EA]
                                            bg-white
                                            text-[#111827]
                                            text-sm sm:text-base
                                            placeholder:text-[#9CA3AF]
                                            outline-none
                                            transition
                                            focus:border-[#D71920]
                                            focus:ring-2
                                            focus:ring-[#D71920]/10
                                        "
                                        placeholder="+254 7XX XXX XXX"
                                    >

                                    <p class="mt-2 text-xs text-[#6B7280]">
                                        Optional — useful if we need to contact you about your learning journey.
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- =====================================
                            VALIDATION ERRORS
                        ====================================== --}}
                        @if($errors->any())

                            <div
                                class="mt-7 rounded-xl border border-red-200 bg-[#FFF7F7] p-4"
                                role="alert"
                            >

                                <div class="flex items-start gap-3">

                                    <div
                                        class="flex-shrink-0 w-6 h-6 rounded-full bg-[#D71920] text-white flex items-center justify-center mt-0.5"
                                    >

                                        <svg
                                            class="w-3.5 h-3.5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>

                                    </div>


                                    <div>

                                        <p class="text-sm font-semibold text-[#B51218]">
                                            Please check the information below.
                                        </p>

                                        <ul
                                            class="mt-2 text-sm text-[#B51218] space-y-1"
                                        >

                                            @foreach($errors->all() as $error)

                                                <li>
                                                    {{ $error }}
                                                </li>

                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        @endif


                        {{-- =====================================
                            NAVIGATION
                        ====================================== --}}
                        <div
                            class="
                                mt-8
                                sm:mt-10
                                pt-6
                                border-t
                                border-[#E5EAF2]

                                flex
                                flex-col-reverse
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-3
                            "
                        >

                            {{-- Back --}}
                            @if($step > 1)

                                <a
                                    href="{{ route('ai.onboarding.step', $step - 1) }}"
                                    class="
                                        inline-flex
                                        items-center
                                        justify-center
                                        gap-2
                                        min-h-[48px]
                                        px-5
                                        rounded-xl
                                        border
                                        border-[#D9E0EA]
                                        bg-white
                                        text-[#071A4D]
                                        text-sm
                                        font-semibold
                                        transition
                                        hover:bg-[#F7F9FC]
                                        hover:border-[#B8C4D6]
                                        focus:outline-none
                                        focus:ring-2
                                        focus:ring-[#D71920]/20
                                    "
                                >

                                    <svg
                                        class="w-4 h-4"
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

                                    Back

                                </a>

                            @else

                                <div class="hidden sm:block"></div>

                            @endif


                            {{-- Continue --}}
                            <button
                                type="submit"
                                class="
                                    w-full
                                    sm:w-auto
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
                                    min-h-[50px]
                                    px-7
                                    rounded-xl
                                    bg-[#D71920]
                                    hover:bg-[#B51218]
                                    active:bg-[#B51218]
                                    text-white
                                    text-sm
                                    font-semibold
                                    shadow-sm
                                    transition-all
                                    duration-200
                                    hover:shadow-md
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-[#D71920]/30
                                    focus:ring-offset-2
                                "
                            >

                                @if($step === $totalSteps)

                                    See My AI Path

                                @else

                                    Continue

                                @endif


                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 12h14M13 6l6 6-6 6"
                                    />
                                </svg>

                            </button>

                        </div>

                    </form>

                </div>


                {{-- =============================================
                    MOBILE TRUST MESSAGE
                ============================================== --}}
                <div
                    class="lg:hidden mt-5 bg-white border border-[#E5EAF2] rounded-xl px-4 py-4"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-lg bg-[#071A4D] flex items-center justify-center"
                        >

                            <svg
                                class="w-4 h-4 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-[#071A4D]">
                                Practical AI learning
                            </p>

                            <p class="text-xs leading-5 text-[#6B7280] mt-0.5">
                                Your answers help us personalize your learning experience.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    FOOTER
                ============================================== --}}
                <div class="text-center mt-6">

                    <p class="text-[11px] sm:text-xs text-[#8A94A6]">
                        Moose Loon AI Academy
                        <span class="mx-1">•</span>
                        Canadian Practical AI Skills
                    </p>

                </div>

            </main>

        </div>

    </div>

</div>

@endsection