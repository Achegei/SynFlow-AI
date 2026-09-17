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
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s3.332.477 4.5 1.253"
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
                        "
                    >

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

                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                            Available

                        </span>

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
                                    class="w-4 h-4 text-[#2F6BFF]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s3.332.477 4.5 1.253"
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
                                    Open Course
                                </span>

                                <svg
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