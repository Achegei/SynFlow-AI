@extends('layouts.ai-onboarding')

@section('title')
Your AI Learning Path | Moose Loon AI Academy
@endsection

@section('content')

<div class="w-full max-w-5xl mx-auto px-2 sm:px-0">

    {{-- =========================================================
        BRAND / PAGE INTRO
    ========================================================== --}}
    <div class="text-center mb-8 sm:mb-10">

        {{-- Brand Mark --}}
        <div class="mx-auto mb-5 flex items-center justify-center">
            <div class="relative w-16 h-16 sm:w-20 sm:h-20">

                {{-- Outer shield --}}
                <div class="absolute inset-0 rounded-[1.4rem] border-[4px] border-[#D71920] rotate-45"></div>

                {{-- Inner shield --}}
                <div class="absolute inset-[6px] rounded-[1rem] border-[3px] border-[#061B49] rotate-45 bg-white"></div>

                {{-- AI Mark --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-xl sm:text-2xl font-black text-[#061B49]">
                        AI
                    </span>
                </div>

            </div>
        </div>


        {{-- Small brand label --}}
        <p class="text-xs sm:text-sm font-bold uppercase tracking-[0.22em] text-[#D71920]">
            Moose Loon AI Academy
        </p>


        {{-- Main heading --}}
        <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#061B49]">
            Your AI Learning Path
        </h1>


        <p class="mt-4 max-w-2xl mx-auto text-sm sm:text-base lg:text-lg leading-relaxed text-slate-600">
            We've used your answers to identify the areas where AI can create
            the greatest value for your career, business and future.
        </p>

    </div>


    {{-- =========================================================
        PERSONALIZATION BANNER
    ========================================================== --}}
    <div class="mb-8 rounded-2xl border border-[#061B49]/10 bg-[#061B49] p-5 sm:p-6 shadow-lg">

        <div class="flex items-start gap-4">

            <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-white/10 border border-white/10 flex items-center justify-center">
                <svg
                    class="w-6 h-6 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636-.707.707M21 12h-1M4 12H3m3.343-6.364-.707-.707M6.343 17.657l-.707.707M17.657 17.657l.707.707M12 7a5 5 0 0 0-5 5c0 1.657.805 3.126 2.05 4.05.596.442.95 1.145.95 1.887V18h4v-.063c0-.742.354-1.445.95-1.887A4.993 4.993 0 0 0 17 12a5 5 0 0 0-5-5Z"
                    />
                </svg>
            </div>

            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#F03A3E]">
                    Personalized Recommendation
                </p>

                <h2 class="mt-1 text-base sm:text-lg font-bold text-white">
                    Choose the direction that best matches your goals.
                </h2>

                <p class="mt-1 text-sm leading-relaxed text-slate-300">
                    You can change your choice before selecting your learning plan.
                </p>
            </div>

        </div>

    </div>


    {{-- =========================================================
        PATH SELECTION
    ========================================================== --}}
    <form
        method="GET"
        action="{{ route('ai.packages') }}"
        id="pathSelectionForm"
    >

        {{-- Selected path --}}
        <input
            type="hidden"
            name="path"
            id="selectedPath"
            value=""
        >


        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6">


            {{-- =====================================================
                PATH 1 — PRACTICAL AI
            ====================================================== --}}
            <button
                type="button"
                data-path="practical-ai"
                data-title="Practical AI"
                class="path-card group relative text-left rounded-2xl border-2 border-slate-200 bg-white p-6 sm:p-7 transition-all duration-200 hover:-translate-y-1 hover:border-[#061B49]/40 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#061B49]/10"
            >

                {{-- Recommended badge --}}
                <div class="absolute top-4 right-4 hidden selected-badge">
                    <span class="inline-flex items-center gap-1 rounded-full bg-[#D71920] px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-white">
                        Selected
                    </span>
                </div>


                {{-- Icon --}}
                <div class="path-icon w-14 h-14 rounded-2xl bg-[#061B49] flex items-center justify-center transition-all duration-200">

                    <svg
                        class="w-7 h-7 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 6V3m0 18v-3M6 12H3m18 0h-3M5.636 5.636l2.121 2.121m8.486 8.486 2.121 2.121M5.636 18.364l2.121-2.121m8.486-8.486 2.121-2.121"
                        />
                        <circle
                            cx="12"
                            cy="12"
                            r="3.5"
                            stroke-width="1.8"
                        />
                    </svg>

                </div>


                <p class="mt-6 text-xs font-bold uppercase tracking-[0.16em] text-[#D71920]">
                    Path 01
                </p>


                <h3 class="mt-2 text-xl font-black text-[#061B49]">
                    Practical AI
                </h3>


                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Learn how to use modern AI tools to work faster, solve
                    problems and improve your everyday productivity.
                </p>


                <div class="mt-6 space-y-3">

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        AI productivity
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        Prompt engineering
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        AI tools & workflows
                    </div>

                </div>


                <div class="mt-7 pt-5 border-t border-slate-100 flex items-center justify-between">

                    <span class="text-xs font-semibold text-slate-500">
                        Best for practical users
                    </span>

                    <span class="path-arrow text-[#061B49] transition-transform duration-200">
                        →
                    </span>

                </div>

            </button>


            {{-- =====================================================
                PATH 2 — CAREER & BUSINESS
            ====================================================== --}}
            <button
                type="button"
                data-path="career-business"
                data-title="Career & Business"
                class="path-card group relative text-left rounded-2xl border-2 border-slate-200 bg-white p-6 sm:p-7 transition-all duration-200 hover:-translate-y-1 hover:border-[#061B49]/40 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#061B49]/10"
            >

                <div class="absolute top-4 right-4 hidden selected-badge">
                    <span class="inline-flex items-center gap-1 rounded-full bg-[#D71920] px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-white">
                        Selected
                    </span>
                </div>


                <div class="path-icon w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center transition-all duration-200">

                    <svg
                        class="w-7 h-7 text-[#061B49]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 21h18M5 21V10h4v11M15 21V3h4v18M9 21v-7h6v7"
                        />
                    </svg>

                </div>


                <p class="mt-6 text-xs font-bold uppercase tracking-[0.16em] text-[#D71920]">
                    Path 02
                </p>


                <h3 class="mt-2 text-xl font-black text-[#061B49]">
                    Career & Business
                </h3>


                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Apply AI to your career or business to automate work,
                    increase efficiency and create new opportunities.
                </p>


                <div class="mt-6 space-y-3">

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        Business automation
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        AI workflows
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        AI for business growth
                    </div>

                </div>


                <div class="mt-7 pt-5 border-t border-slate-100 flex items-center justify-between">

                    <span class="text-xs font-semibold text-slate-500">
                        Best for professionals
                    </span>

                    <span class="path-arrow text-[#061B49] transition-transform duration-200">
                        →
                    </span>

                </div>

            </button>


            {{-- =====================================================
                PATH 3 — AI SKILLS
            ====================================================== --}}
            <button
                type="button"
                data-path="ai-skills"
                data-title="AI Skills"
                class="path-card group relative text-left rounded-2xl border-2 border-slate-200 bg-white p-6 sm:p-7 transition-all duration-200 hover:-translate-y-1 hover:border-[#061B49]/40 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#061B49]/10"
            >

                <div class="absolute top-4 right-4 hidden selected-badge">
                    <span class="inline-flex items-center gap-1 rounded-full bg-[#D71920] px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-white">
                        Selected
                    </span>
                </div>


                <div class="path-icon w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center transition-all duration-200">

                    <svg
                        class="w-7 h-7 text-[#061B49]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 3v18M3 12h18M5.636 5.636l12.728 12.728M18.364 5.636 5.636 18.364"
                        />
                        <circle
                            cx="12"
                            cy="12"
                            r="3"
                            stroke-width="1.8"
                        />
                    </svg>

                </div>


                <p class="mt-6 text-xs font-bold uppercase tracking-[0.16em] text-[#D71920]">
                    Path 03
                </p>


                <h3 class="mt-2 text-xl font-black text-[#061B49]">
                    AI Skills
                </h3>


                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Build practical, job-ready AI capabilities that can help
                    you enter and compete in the growing AI economy.
                </p>


                <div class="mt-6 space-y-3">

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        AI automation
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        AI agents & APIs
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-700">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#061B49] flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 4 4L19 6"/>
                            </svg>
                        </span>
                        Portfolio projects
                    </div>

                </div>


                <div class="mt-7 pt-5 border-t border-slate-100 flex items-center justify-between">

                    <span class="text-xs font-semibold text-slate-500">
                        Best for aspiring specialists
                    </span>

                    <span class="path-arrow text-[#061B49] transition-transform duration-200">
                        →
                    </span>

                </div>

            </button>

        </div>


        {{-- =========================================================
            SELECTED PATH SUMMARY
        ========================================================== --}}
        <div
            id="selectionSummary"
            class="hidden mt-8 rounded-2xl border border-[#D71920]/20 bg-red-50 p-5 sm:p-6"
        >

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-[#D71920]">
                        Your selected direction
                    </p>

                    <p
                        id="selectedPathTitle"
                        class="mt-1 text-lg font-black text-[#061B49]"
                    >
                    </p>

                    <p class="mt-1 text-sm text-slate-600">
                        Continue to choose the learning plan that fits your schedule.
                    </p>

                </div>


                <div class="flex-shrink-0">

                    <svg
                        class="w-9 h-9 text-[#D71920]"
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

                </div>

            </div>

        </div>


        {{-- =========================================================
            CTA
        ========================================================== --}}
        <div class="mt-8">

            <button
                type="submit"
                id="continueButton"
                disabled
                class="w-full flex items-center justify-center gap-3
                       rounded-2xl py-4 sm:py-5
                       bg-slate-200 text-slate-400
                       font-bold text-base sm:text-lg
                       cursor-not-allowed
                       transition-all duration-200"
            >

                <span id="continueButtonText">
                    Select a learning path to continue
                </span>

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
                        d="M5 12h14m-6-6 6 6-6 6"
                    />
                </svg>

            </button>

        </div>

    </form>


    {{-- =========================================================
        TRUST / SUPPORT
    ========================================================== --}}
    <div class="mt-8 text-center">

        <div class="inline-flex items-center gap-2 text-xs sm:text-sm text-slate-500">

            <svg
                class="w-4 h-4 text-[#D71920]"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2Zm2-7V7a4 4 0 0 1 8 0v5"
                />
            </svg>

            Your learning direction can be changed before payment.

        </div>

        <p class="mt-2 text-xs text-slate-400">
            Moose Loon AI Academy · Canadian Practical AI Skills
        </p>

    </div>

</div>


{{-- =============================================================
    INTERACTION
============================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const cards = document.querySelectorAll('.path-card');

    const selectedPathInput = document.getElementById('selectedPath');

    const selectionSummary = document.getElementById('selectionSummary');

    const selectedPathTitle = document.getElementById('selectedPathTitle');

    const continueButton = document.getElementById('continueButton');

    const continueButtonText = document.getElementById('continueButtonText');


    cards.forEach(function (card) {

        card.addEventListener('click', function () {

            /*
            |--------------------------------------------------------------------------
            | Remove selected state from all cards
            |--------------------------------------------------------------------------
            */

            cards.forEach(function (item) {

                item.classList.remove(
                    'border-[#D71920]',
                    'bg-[#061B49]/[0.02]',
                    'shadow-xl',
                    'ring-2',
                    'ring-[#D71920]/20'
                );

                item.classList.add(
                    'border-slate-200',
                    'bg-white'
                );


                const badge = item.querySelector('.selected-badge');

                if (badge) {
                    badge.classList.add('hidden');
                }


                const icon = item.querySelector('.path-icon');

                if (icon) {

                    icon.classList.remove(
                        'bg-[#D71920]'
                    );

                    icon.classList.add(
                        'bg-slate-100'
                    );


                    const svg = icon.querySelector('svg');

                    if (svg) {

                        svg.classList.remove(
                            'text-white'
                        );

                        svg.classList.add(
                            'text-[#061B49]'
                        );

                    }

                }


                const arrow = item.querySelector('.path-arrow');

                if (arrow) {
                    arrow.classList.remove(
                        'translate-x-1',
                        'text-[#D71920]'
                    );
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Apply selected state
            |--------------------------------------------------------------------------
            */

            card.classList.remove(
                'border-slate-200',
                'bg-white'
            );

            card.classList.add(
                'border-[#D71920]',
                'bg-[#061B49]/[0.02]',
                'shadow-xl',
                'ring-2',
                'ring-[#D71920]/20'
            );


            const badge = card.querySelector('.selected-badge');

            if (badge) {
                badge.classList.remove('hidden');
            }


            const icon = card.querySelector('.path-icon');

            if (icon) {

                icon.classList.remove(
                    'bg-slate-100'
                );

                icon.classList.add(
                    'bg-[#D71920]'
                );


                const svg = icon.querySelector('svg');

                if (svg) {

                    svg.classList.remove(
                        'text-[#061B49]'
                    );

                    svg.classList.add(
                        'text-white'
                    );

                }

            }


            const arrow = card.querySelector('.path-arrow');

            if (arrow) {

                arrow.classList.add(
                    'translate-x-1',
                    'text-[#D71920]'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Store selected path
            |--------------------------------------------------------------------------
            */

            const path = card.dataset.path;

            const title = card.dataset.title;

            selectedPathInput.value = path;

            selectedPathTitle.textContent = title;


            /*
            |--------------------------------------------------------------------------
            | Show summary
            |--------------------------------------------------------------------------
            */

            selectionSummary.classList.remove('hidden');


            /*
            |--------------------------------------------------------------------------
            | Enable CTA
            |--------------------------------------------------------------------------
            */

            continueButton.disabled = false;

            continueButton.classList.remove(
                'bg-slate-200',
                'text-slate-400',
                'cursor-not-allowed'
            );

            continueButton.classList.add(
                'bg-[#D71920]',
                'hover:bg-[#B9151B]',
                'text-white',
                'shadow-lg',
                'hover:shadow-xl',
                'hover:-translate-y-0.5'
            );


            continueButtonText.textContent =
                'Continue with ' + title + ' →';

        });

    });

});

</script>

{{-- =============================================================
    INTERACTION
============================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const cards = document.querySelectorAll('.path-card');

    const selectedPathInput =
        document.getElementById('selectedPath');

    const selectionSummary =
        document.getElementById('selectionSummary');

    const selectedPathTitle =
        document.getElementById('selectedPathTitle');

    const continueButton =
        document.getElementById('continueButton');

    const continueButtonText =
        document.getElementById('continueButtonText');


    cards.forEach(function (card) {

        card.addEventListener('click', function () {

            /*
            |--------------------------------------------------------------------------
            | Remove selected state from all cards
            |--------------------------------------------------------------------------
            */

            cards.forEach(function (item) {

                item.classList.remove(
                    'border-[#D71920]',
                    'bg-[#061B49]/[0.02]',
                    'shadow-xl',
                    'ring-2',
                    'ring-[#D71920]/20'
                );

                item.classList.add(
                    'border-slate-200',
                    'bg-white'
                );


                const badge =
                    item.querySelector('.selected-badge');

                if (badge) {
                    badge.classList.add('hidden');
                }


                const icon =
                    item.querySelector('.path-icon');

                if (icon) {

                    icon.classList.remove(
                        'bg-[#D71920]'
                    );

                    icon.classList.add(
                        'bg-slate-100'
                    );

                    const svg =
                        icon.querySelector('svg');

                    if (svg) {

                        svg.classList.remove(
                            'text-white'
                        );

                        svg.classList.add(
                            'text-[#061B49]'
                        );

                    }
                }


                const arrow =
                    item.querySelector('.path-arrow');

                if (arrow) {

                    arrow.classList.remove(
                        'translate-x-1',
                        'text-[#D71920]'
                    );

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Apply selected state
            |--------------------------------------------------------------------------
            */

            card.classList.remove(
                'border-slate-200',
                'bg-white'
            );

            card.classList.add(
                'border-[#D71920]',
                'bg-[#061B49]/[0.02]',
                'shadow-xl',
                'ring-2',
                'ring-[#D71920]/20'
            );


            const badge =
                card.querySelector('.selected-badge');

            if (badge) {
                badge.classList.remove('hidden');
            }


            const icon =
                card.querySelector('.path-icon');

            if (icon) {

                icon.classList.remove(
                    'bg-slate-100'
                );

                icon.classList.add(
                    'bg-[#D71920]'
                );


                const svg =
                    icon.querySelector('svg');

                if (svg) {

                    svg.classList.remove(
                        'text-[#061B49]'
                    );

                    svg.classList.add(
                        'text-white'
                    );

                }

            }


            const arrow =
                card.querySelector('.path-arrow');

            if (arrow) {

                arrow.classList.add(
                    'translate-x-1',
                    'text-[#D71920]'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Store selected path
            |--------------------------------------------------------------------------
            */

            const path =
                card.dataset.path;

            const title =
                card.dataset.title;

            selectedPathInput.value =
                path;

            selectedPathTitle.textContent =
                title;


            /*
            |--------------------------------------------------------------------------
            | Show summary
            |--------------------------------------------------------------------------
            */

            selectionSummary.classList.remove(
                'hidden'
            );


            /*
            |--------------------------------------------------------------------------
            | Enable CTA
            |--------------------------------------------------------------------------
            */

            continueButton.disabled =
                false;

            continueButton.classList.remove(
                'bg-slate-200',
                'text-slate-400',
                'cursor-not-allowed'
            );

            continueButton.classList.add(
                'bg-[#D71920]',
                'hover:bg-[#B9151B]',
                'text-white',
                'shadow-lg',
                'hover:shadow-xl',
                'hover:-translate-y-0.5'
            );

            continueButtonText.textContent =
                'Continue with ' + title + ' →';

        });

    });

});
</script>


{{-- =============================================================
    LEAD TRACKING
    PLACE THIS AFTER THE INTERACTION SCRIPT
    ============================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    function trackLeadEvent(eventName, metadata = {}) {
        return fetch('{{ route('lead.track') }}', {
            method: 'POST',
            credentials: 'same-origin',
            keepalive: true,

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },

            body: JSON.stringify({
                event: eventName,
                metadata: {
                    ...metadata,
                    page_url: window.location.href
                }
            })
        }).catch(function (error) {
            console.debug('Lead tracking failed:', error);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | 1. LEARNING PATH VIEWED
    |--------------------------------------------------------------------------
    */

    trackLeadEvent('ai_learning_path_viewed', {
        step: 8,
        stage: 'ai_learning_path',
        onboarding_completed: true
    });


    /*
    |--------------------------------------------------------------------------
    | 2. LEARNING PATH SELECTED
    |--------------------------------------------------------------------------
    */

    const cards = document.querySelectorAll('.path-card');

    cards.forEach(function (card) {

        card.addEventListener('click', function () {

            const path = card.dataset.path;
            const title = card.dataset.title;

            trackLeadEvent('ai_learning_path_selected', {
                stage: 'ai_learning_path',
                path: path,
                path_title: title,
                step: 8
            });

        });

    });


    /*
    |--------------------------------------------------------------------------
    | 3. CONTINUE TO PACKAGES
    |
    | IMPORTANT:
    | Wait for tracking to finish BEFORE navigation.
    |--------------------------------------------------------------------------
    */

    const pathForm = document.getElementById('pathSelectionForm');

    const selectedPathInput =
        document.getElementById('selectedPath');

    const selectedPathTitle =
        document.getElementById('selectedPathTitle');


    if (pathForm) {

        pathForm.addEventListener('submit', async function (event) {

            event.preventDefault();

            const selectedPath =
                selectedPathInput.value;

            const selectedTitle =
                selectedPathTitle.textContent;


            if (!selectedPath) {
                return;
            }


            await trackLeadEvent(
                'ai_learning_path_continue_clicked',
                {
                    stage: 'ai_learning_path',
                    step: 8,
                    path: selectedPath,
                    path_title: selectedTitle,
                    next_stage: 'ai_packages'
                }
            );


            /*
            |--------------------------------------------------------------------------
            | Tracking is now sent.
            | Continue with the original form submission.
            |--------------------------------------------------------------------------
            */

            pathForm.submit();

        });

    }

});
</script>


@endsection