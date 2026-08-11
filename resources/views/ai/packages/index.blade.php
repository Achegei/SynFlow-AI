@extends('layouts.ai-onboarding')

@section('title')
    Choose Your AI Learning Plan | Moose Loon AI Academy
@endsection

@section('content')

<div class="min-h-[calc(100vh-9rem)] bg-[#f7f9fc]">

    {{-- ============================================================
         BRAND HEADER / TOP ACCENT
    ============================================================= --}}

    <div class="h-1.5 bg-[#d71920]"></div>

    <div class="px-4 py-8 sm:px-6 sm:py-12 lg:px-8">

        <div class="mx-auto w-full max-w-6xl">

            {{-- ====================================================
                 HEADER
            ===================================================== --}}

            <div class="mx-auto max-w-3xl text-center">

                {{-- Brand Badge --}}
                <div
                    class="mx-auto inline-flex items-center gap-2
                           rounded-full
                           border border-[#d71920]/20
                           bg-white
                           px-4 py-2
                           shadow-sm"
                >

                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full
                               bg-[#071d49]
                               text-[10px]
                               font-black
                               text-white"
                    >
                        AI
                    </span>

                    <span
                        class="text-xs
                               font-bold
                               uppercase
                               tracking-[0.16em]
                               text-[#071d49]"
                    >
                        Moose Loon AI Academy
                    </span>

                </div>


                {{-- Progress / Stage --}}
                <div
                    class="mt-6
                           inline-flex items-center gap-2
                           text-xs
                           font-semibold
                           uppercase
                           tracking-wider
                           text-gray-500"
                >

                    <span
                        class="flex h-5 w-5 items-center justify-center
                               rounded-full
                               bg-[#071d49]
                               text-[10px]
                               font-bold
                               text-white"
                    >
                        ✓
                    </span>

                    AI Learning Path Complete

                </div>


                {{-- Main Heading --}}
                <h1
                    class="mt-5
                           text-3xl
                           font-black
                           tracking-tight
                           text-[#071d49]
                           sm:text-4xl
                           lg:text-5xl"
                >
                    Choose Your
                    <span class="text-[#d71920]">
                        Learning Plan
                    </span>
                </h1>


                {{-- Subtitle --}}
                <p
                    class="mx-auto mt-4
                           max-w-2xl
                           text-sm
                           leading-7
                           text-gray-600
                           sm:text-base"
                >
                    Your personalized AI learning path is ready.
                    Choose the access period that fits your goals,
                    schedule, and learning pace.
                </p>

            </div>


            {{-- ====================================================
                 PERSONALIZATION MESSAGE
            ===================================================== --}}

            <div
                class="mx-auto mt-8
                       max-w-3xl
                       overflow-hidden
                       rounded-2xl
                       border
                       border-[#071d49]/10
                       bg-white
                       shadow-sm"
            >

                <div class="flex">

                    {{-- Brand Accent --}}
                    <div class="w-1.5 shrink-0 bg-[#d71920]"></div>

                    <div class="flex flex-1 items-start gap-4 p-5 sm:p-6">

                        <div
                            class="flex h-11 w-11 shrink-0
                                   items-center justify-center
                                   rounded-xl
                                   bg-[#071d49]
                                   text-white
                                   shadow-sm"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9.75 3.75h4.5m-6.75 3h9m-10.5 3h12m-10.5 3h9m-6.75 3h4.5M5.25 6.75a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h13.5a2.25 2.25 0 002.25-2.25V9a2.25 2.25 0 00-2.25-2.25"
                                />
                            </svg>
                        </div>

                        <div>

                            <h2
                                class="text-sm
                                       font-bold
                                       text-[#071d49]
                                       sm:text-base"
                            >
                                Your AI learning experience is ready
                            </h2>

                            <p
                                class="mt-1
                                       text-xs
                                       leading-5
                                       text-gray-500
                                       sm:text-sm"
                            >
                                Select a plan below to continue.
                                You can start learning once your payment
                                has been successfully confirmed.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 PLAN SECTION
            ===================================================== --}}

            @if($packages->count())

                <div class="mt-10 sm:mt-12">

                    {{-- Section Heading --}}
                    <div class="mb-6 flex items-end justify-between">

                        <div>

                            <p
                                class="text-[11px]
                                       font-bold
                                       uppercase
                                       tracking-[0.18em]
                                       text-[#d71920]"
                            >
                                Learning Access
                            </p>

                            <h2
                                class="mt-1
                                       text-xl
                                       font-black
                                       text-[#071d49]
                                       sm:text-2xl"
                            >
                                Select your preferred period
                            </h2>

                        </div>

                        <div
                            class="hidden
                                   text-xs
                                   font-medium
                                   text-gray-400
                                   sm:block"
                        >
                            {{ $packages->count() }}
                            {{ $packages->count() === 1 ? 'option' : 'options' }}
                        </div>

                    </div>


                    {{-- =================================================
                         PACKAGE GRID
                    ================================================== --}}

                    <div
                        class="grid
                               grid-cols-1
                               gap-5
                               md:grid-cols-3
                               md:gap-6"
                    >

                        @foreach($packages as $package)

                            @php
                                $isPopular = $package->slug === 'weekly-ai-access';
                            @endphp


                            {{-- =========================================
                                 PACKAGE CARD
                            ========================================== --}}

                            <div
                                class="
                                    group
                                    relative
                                    flex
                                    flex-col
                                    overflow-hidden
                                    rounded-3xl
                                    bg-white
                                    transition-all
                                    duration-300
                                    hover:-translate-y-1
                                    hover:shadow-2xl

                                    {{ $isPopular
                                        ? 'border-2 border-[#d71920] shadow-xl shadow-[#071d49]/10'
                                        : 'border border-gray-200 shadow-md'
                                    }}
                                "
                            >

                                {{-- Popular Badge --}}
                                @if($isPopular)

                                    <div
                                        class="absolute
                                               left-1/2
                                               top-0
                                               z-10
                                               -translate-x-1/2
                                               -translate-y-0
                                               rounded-b-xl
                                               bg-[#d71920]
                                               px-5
                                               py-2
                                               text-[10px]
                                               font-black
                                               uppercase
                                               tracking-[0.16em]
                                               text-white
                                               shadow-md"
                                    >
                                        Most Popular
                                    </div>

                                @endif


                                {{-- =====================================
                                     CARD TOP
                                ====================================== --}}

                                <div
                                    class="
                                        relative
                                        px-6
                                        pb-6
                                        pt-8
                                        sm:px-7
                                        sm:pb-7
                                        {{ $isPopular ? 'pt-14' : '' }}
                                    "
                                >

                                    {{-- Decorative Brand Line --}}
                                    <div
                                        class="absolute
                                               left-6
                                               top-0
                                               h-1
                                               w-12
                                               rounded-b-full
                                               {{ $isPopular
                                                    ? 'bg-[#d71920]'
                                                    : 'bg-[#071d49]'
                                               }}"
                                    ></div>


                                    {{-- Plan Identity --}}
                                    <div>

                                        <div
                                            class="mb-3
                                                   flex
                                                   h-12
                                                   w-12
                                                   items-center
                                                   justify-center
                                                   rounded-2xl
                                                   {{ $isPopular
                                                        ? 'bg-red-50 text-[#d71920]'
                                                        : 'bg-[#071d49]/5 text-[#071d49]'
                                                   }}"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 6v12m6-9H6m12 3H6m10.5-9.75A4.5 4.5 0 0112 6a4.5 4.5 0 01-4.5-3.75M16.5 21.75A4.5 4.5 0 0112 18a4.5 4.5 0 01-4.5 3.75"
                                                />
                                            </svg>

                                        </div>


                                        <h3
                                            class="text-xl
                                                   font-black
                                                   tracking-tight
                                                   text-[#071d49]"
                                        >
                                            {{ $package->name }}
                                        </h3>


                                        <p
                                            class="mt-1
                                                   text-xs
                                                   font-bold
                                                   uppercase
                                                   tracking-[0.14em]
                                                   text-gray-400"
                                        >
                                            {{ $package->duration_days }}
                                            {{ $package->duration_days == 1 ? 'Day' : 'Days' }}
                                            Learning Access
                                        </p>

                                    </div>


                                    {{-- =================================
                                         PRICE
                                    ================================== --}}

                                    <div
                                        class="mt-6
                                               rounded-2xl
                                               border
                                               border-gray-100
                                               bg-[#f8fafc]
                                               px-5
                                               py-5"
                                    >

                                        <p
                                            class="text-[10px]
                                                   font-bold
                                                   uppercase
                                                   tracking-[0.15em]
                                                   text-gray-400"
                                        >
                                            Investment
                                        </p>


                                        <div
                                            class="mt-1
                                                   flex
                                                   items-baseline
                                                   gap-1"
                                        >

                                            <span
                                                class="text-sm
                                                       font-bold
                                                       text-gray-500"
                                            >
                                                KES
                                            </span>

                                            <span
                                                class="text-3xl
                                                       font-black
                                                       tracking-tight
                                                       text-[#071d49]
                                                       sm:text-4xl"
                                            >
                                                {{ number_format($package->price, 0) }}
                                            </span>

                                        </div>

                                    </div>


                                    {{-- =================================
                                         DESCRIPTION
                                    ================================== --}}

                                    <div class="mt-5 min-h-[60px]">

                                        @if($package->description)

                                            <p
                                                class="text-sm
                                                       leading-6
                                                       text-gray-500"
                                            >
                                                {{ $package->description }}
                                            </p>

                                        @else

                                            <p
                                                class="text-sm
                                                       leading-6
                                                       text-gray-500"
                                            >
                                                Access practical AI training
                                                designed for real-world
                                                application.
                                            </p>

                                        @endif

                                    </div>


                                    {{-- =================================
                                         FEATURES
                                    ================================== --}}

                                    <div class="mt-6 space-y-3">

                                        <div
                                            class="flex items-center gap-3
                                                   text-xs
                                                   font-medium
                                                   text-gray-600"
                                        >

                                            <span
                                                class="flex h-5 w-5
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-red-50
                                                       text-[#d71920]"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3 w-3"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="3"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>
                                            </span>

                                            Practical AI learning

                                        </div>


                                        <div
                                            class="flex items-center gap-3
                                                   text-xs
                                                   font-medium
                                                   text-gray-600"
                                        >

                                            <span
                                                class="flex h-5 w-5
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-red-50
                                                       text-[#d71920]"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3 w-3"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="3"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>
                                            </span>

                                            Real-world AI applications

                                        </div>


                                        <div
                                            class="flex items-center gap-3
                                                   text-xs
                                                   font-medium
                                                   text-gray-600"
                                        >

                                            <span
                                                class="flex h-5 w-5
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-red-50
                                                       text-[#d71920]"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3 w-3"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="3"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>
                                            </span>

                                            Flexible learning access

                                        </div>

                                    </div>


                                    {{-- =================================
                                         CTA
                                    ================================== --}}

                                    <form
                                        action="{{ route('ai.packages.select', $package->id) }}"
                                        method="POST"
                                        class="mt-7"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="
                                                group/btn
                                                flex
                                                w-full
                                                items-center
                                                justify-center
                                                gap-2
                                                rounded-xl
                                                px-5
                                                py-3.5
                                                text-sm
                                                font-bold
                                                transition-all
                                                duration-200

                                                {{ $isPopular
                                                    ? 'bg-[#d71920] text-white shadow-lg shadow-[#d71920]/20 hover:bg-[#b9151b] hover:shadow-xl'
                                                    : 'bg-[#071d49] text-white hover:bg-[#0b2b68] hover:shadow-lg'
                                                }}
                                            "
                                        >

                                            <span>
                                                Choose {{ $package->name }}
                                            </span>

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 transition-transform duration-200 group-hover/btn:translate-x-1"
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


                                    {{-- Secure Payment --}}
                                    <div
                                        class="mt-4
                                               flex
                                               items-center
                                               justify-center
                                               gap-1.5
                                               text-[10px]
                                               font-medium
                                               text-gray-400"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-3.5 w-3.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-1V4a3 3 0 00-6 0v1H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                        Secure payment

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    {{-- =================================================
                         MOBILE GUIDANCE
                    ================================================== --}}

                    <div class="mt-5 text-center md:hidden">

                        <div
                            class="inline-flex
                                   items-center
                                   gap-2
                                   rounded-full
                                   bg-white
                                   px-4
                                   py-2
                                   text-[11px]
                                   font-medium
                                   text-gray-500
                                   shadow-sm
                                   ring-1
                                   ring-gray-100"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3.5 w-3.5 text-[#d71920]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 12h8m-8-4h5m-5 8h5M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                />
                            </svg>

                            Choose a plan to continue

                        </div>

                    </div>


                    {{-- =================================================
                         VALUE / TRUST SECTION
                    ================================================== --}}

                    <div
                        class="mx-auto mt-10
                               max-w-3xl
                               rounded-2xl
                               border
                               border-[#071d49]/10
                               bg-[#071d49]
                               px-5
                               py-6
                               text-center
                               shadow-lg
                               sm:px-8"
                    >

                        <div
                            class="mx-auto flex h-10 w-10
                                   items-center justify-center
                                   rounded-full
                                   bg-white/10
                                   text-[#d71920]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>


                        <h3
                            class="mt-3
                                   text-sm
                                   font-bold
                                   text-white
                                   sm:text-base"
                        >
                            Start building practical AI skills
                        </h3>


                        <p
                            class="mx-auto mt-2
                                   max-w-xl
                                   text-xs
                                   leading-5
                                   text-white/65
                                   sm:text-sm"
                        >
                            Once your payment is confirmed, your learning
                            access will become available and you can begin
                            your AI learning journey.
                        </p>

                    </div>


                {{-- ====================================================
                     NO PACKAGES
                ===================================================== --}}

            @else

                <div
                    class="mx-auto mt-10
                           max-w-md
                           rounded-3xl
                           border
                           border-gray-200
                           bg-white
                           p-8
                           text-center
                           shadow-sm"
                >

                    <div
                        class="mx-auto flex h-16 w-16
                               items-center justify-center
                               rounded-2xl
                               bg-[#071d49]/5"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-[#071d49]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6.75a5.25 5.25 0 015.25 5.25v1.5A2.25 2.25 0 0019.5 15.75h.75a2.25 2.25 0 012.25 2.25v.75A2.25 2.25 0 0120.25 21H3.75A2.25 2.25 0 011.5 18.75V18a2.25 2.25 0 012.25-2.25h.75a2.25 2.25 0 002.25-2.25V12A5.25 5.25 0 0112 6.75z"
                            />
                        </svg>

                    </div>


                    <h2
                        class="mt-5
                               text-xl
                               font-black
                               text-[#071d49]"
                    >
                        No Learning Plans Available
                    </h2>


                    <p
                        class="mt-2
                               text-sm
                               leading-6
                               text-gray-500"
                    >
                        There are currently no active learning plans available.
                        Please check again later.
                    </p>

                </div>

            @endif


            {{-- ====================================================
                 PAYMENT TRUST FOOTER
            ===================================================== --}}

            <div class="mt-8 text-center sm:mt-10">

                <div
                    class="inline-flex
                           flex-wrap
                           items-center
                           justify-center
                           gap-x-4
                           gap-y-2
                           text-[10px]
                           font-medium
                           text-gray-400
                           sm:text-xs"
                >

                    <span class="flex items-center gap-1.5">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3.5 w-3.5 text-[#d71920]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-1V4a3 3 0 00-6 0v1H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>

                        Secure payment

                    </span>


                    <span class="hidden h-3 w-px bg-gray-200 sm:block"></span>


                    <span>
                        Powered by
                        <strong class="text-gray-500">
                            IntaSend
                        </strong>
                    </span>


                    <span class="hidden h-3 w-px bg-gray-200 sm:block"></span>


                    <span>
                        Moose Loon AI Academy
                    </span>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection