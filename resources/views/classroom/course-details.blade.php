@extends('layouts.app')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATED LEARNER
    |--------------------------------------------------------------------------
    |
    | Course content is now available directly inside the LMS.
    | We still refresh the learner so existing progress tracking continues
    | to work correctly.
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
    | Course ID 1 is the paid certification course. Access is granted through
    | either permanent course enrollment or an active AI learning package.
    | Other courses remain open.
    |
    */

    $isPaidCourse = (int) $course->id === 1;

    $hasAiAccess = ! is_null($learningAccess);

    $hasCourseAccess = $user
        ? $user->courses->contains('id', (int) $course->id)
        : false;

    $hasAccess = ! $isPaidCourse
        || $hasCourseAccess
        || $hasAiAccess;

    /*
    |--------------------------------------------------------------------------
    | PENDING PAYMENT
    |--------------------------------------------------------------------------
    */

    $pendingPayment = false;

    if ($isPaidCourse && $user && ! $hasAccess) {
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
         LMS COURSE HEADER
    ============================================================= --}}

    <header class="border-b border-slate-200 bg-white">

        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-5">

            {{-- Breadcrumb / navigation --}}

            <div class="flex flex-wrap items-center justify-between gap-4">

                <a
                    href="{{ route('classroom') }}"
                    class="
                        inline-flex
                        items-center
                        gap-2
                        text-sm
                        font-semibold
                        text-slate-500
                        transition
                        hover:text-[#123A78]
                    "
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    All Courses

                </a>


                @if ($hasAccess)

                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2
                            rounded-full
                            bg-emerald-50
                            px-3
                            py-1.5
                            text-xs
                            font-bold
                            text-emerald-700
                        "
                    >
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        Learning in Progress
                    </div>

                @else

                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2
                            rounded-full
                            bg-slate-100
                            px-3
                            py-1.5
                            text-xs
                            font-bold
                            text-slate-600
                        "
                    >
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>

                        Access Required
                    </div>

                @endif

            </div>


            {{-- Main course heading --}}

            <div
                class="
                    mt-5
                    flex
                    flex-col
                    gap-6
                    lg:flex-row
                    lg:items-end
                    lg:justify-between
                "
            >

                <div class="max-w-4xl">

                    <p
                        class="
                            text-xs
                            font-extrabold
                            uppercase
                            tracking-[0.18em]
                            text-[#D71920]
                        "
                    >
                        Moose Loon AI Academy
                    </p>


                    <h1
                        class="
                            mt-2
                            text-2xl
                            font-extrabold
                            tracking-tight
                            text-[#061638]
                            sm:text-3xl
                            lg:text-4xl
                        "
                    >
                        {{ $course->title }}
                    </h1>


                    <p
                        class="
                            mt-3
                            max-w-3xl
                            text-sm
                            leading-6
                            text-slate-500
                            sm:text-base
                        "
                    >
                        {{ \Illuminate\Support\Str::limit($course->description, 180) }}
                    </p>

                </div>


                {{-- Progress / access summary --}}

                <div class="w-full lg:w-80">

                    @if ($hasAccess)

                        <div class="flex items-center justify-between">

                            <span class="text-sm font-semibold text-slate-600">
                                Course Progress
                            </span>

                            <span class="text-sm font-extrabold text-[#123A78]">
                                {{ number_format($course->progress_percentage) }}%
                            </span>

                        </div>


                        <div
                            class="
                                mt-2
                                h-2.5
                                overflow-hidden
                                rounded-full
                                bg-slate-100
                            "
                        >

                            <div
                                class="
                                    h-full
                                    rounded-full
                                    bg-[#2F6BFF]
                                    transition-all
                                    duration-500
                                "
                                style="width: {{ min(100, max(0, $course->progress_percentage)) }}%"
                            ></div>

                        </div>


                        <div
                            class="
                                mt-3
                                flex
                                items-center
                                justify-between
                                text-xs
                                text-slate-400
                            "
                        >

                            <span>
                                {{ $course->modules->count() }} modules
                            </span>

                            <span>
                                Continue where you left off
                            </span>

                        </div>

                    @else

                        <div class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-4">

                            <p class="text-sm font-bold text-[#061638]">
                                Course Access
                            </p>

                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                Payment is required before you can begin this course.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </header>


    {{-- ============================================================
         LMS WORKSPACE
    ============================================================= --}}

    <main
        class="
            max-w-[1600px]
            mx-auto
            px-4
            py-6
            sm:px-6
            lg:px-8
            lg:py-8
        "
    >

        @if (! $hasAccess)

            <div class="mx-auto max-w-2xl py-8 sm:py-12">

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#D71920]">
                            Course Access Required
                        </p>

                        <h2 class="mt-2 text-2xl font-extrabold text-[#061638]">
                            Unlock This Course
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Complete your payment to access the full classroom,
                            including lessons, quizzes and assignments.
                        </p>
                    </div>

                    <div class="px-6 py-6 sm:px-8">

                        <div class="flex flex-col gap-4 border-b border-slate-100 pb-6 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm font-semibold text-slate-500">
                                    Course Fee
                                </p>

                                <p class="mt-1 text-3xl font-extrabold text-[#061638]">
                                    KES 10,000
                                </p>
                            </div>

                            <p class="max-w-xs text-sm leading-6 text-slate-500 sm:text-right">
                                Secure payment through M-PESA.
                            </p>
                        </div>

                        @if ($pendingPayment)

                            <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-5">
                                <p class="font-bold text-amber-800">
                                    Payment is being processed
                                </p>

                                <p class="mt-1 text-sm leading-6 text-amber-700">
                                    We have received your payment request.
                                    Once M-PESA confirms the payment, your course
                                    will automatically unlock.
                                </p>
                            </div>

                        @else

                            <form
                                action="{{ route('purchase.course', $course->id) }}"
                                method="POST"
                                class="mt-6"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-xl bg-[#D71920] px-6 py-3.5 text-sm font-bold text-white transition hover:bg-[#b9151b] focus:outline-none focus:ring-4 focus:ring-red-100 sm:w-auto"
                                >
                                    Pay KES 10,000 with M-PESA
                                </button>
                            </form>

                        @endif

                    </div>

                </div>

            </div>

        @else

            {{-- ====================================================
                 CERTIFICATE MODAL
            ===================================================== --}}

            @if ($course->progress_percentage == 100)

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
                 LMS TWO-COLUMN WORKSPACE
            ===================================================== --}}

            <div
                x-data="{ curriculumOpen: false }"
                @learning-selected.window="curriculumOpen = false"
                class="mt-8"
            >

                {{-- Mobile curriculum button --}}

                <div class="mb-5 lg:hidden">

                    <button
                        type="button"
                        @click="curriculumOpen = true"
                        class="
                            inline-flex
                            w-full
                            items-center
                            justify-between
                            rounded-2xl
                            border
                            border-slate-200
                            bg-white
                            px-4
                            py-3.5
                            text-left
                            shadow-sm
                        "
                    >

                        <span>

                            <span
                                class="
                                    block
                                    text-[11px]
                                    font-extrabold
                                    uppercase
                                    tracking-[0.16em]
                                    text-[#D71920]
                                "
                            >
                                Curriculum
                            </span>

                            <span
                                class="
                                    mt-0.5
                                    block
                                    text-sm
                                    font-extrabold
                                    text-[#061638]
                                "
                            >
                                View Course Content
                            </span>

                        </span>


                        <svg
                            class="h-5 w-5 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>

                    </button>

                </div>


                {{-- Mobile curriculum drawer --}}

                <div
                    x-show="curriculumOpen"
                    x-cloak
                    @keydown.escape.window="curriculumOpen = false"
                    class="fixed inset-0 z-50 lg:hidden"
                    aria-modal="true"
                    role="dialog"
                >

                    <div
                        x-show="curriculumOpen"
                        x-transition.opacity
                        @click="curriculumOpen = false"
                        class="absolute inset-0 bg-slate-950/50 backdrop-blur-[1px]"
                    ></div>


                    <div
                        x-show="curriculumOpen"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="-translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="-translate-x-full"
                        class="
                            relative
                            h-full
                            w-[88%]
                            max-w-sm
                            overflow-y-auto
                            bg-white
                            shadow-2xl
                        "
                    >

                        <div
                            class="
                                sticky
                                top-0
                                z-10
                                flex
                                items-center
                                justify-between
                                border-b
                                border-slate-200
                                bg-white
                                px-4
                                py-4
                            "
                        >

                            <div>
                                <p
                                    class="
                                        text-[11px]
                                        font-extrabold
                                        uppercase
                                        tracking-[0.16em]
                                        text-[#D71920]
                                    "
                                >
                                    Curriculum
                                </p>

                                <p
                                    class="
                                        mt-0.5
                                        text-sm
                                        font-extrabold
                                        text-[#061638]
                                    "
                                >
                                    Course Content
                                </p>
                            </div>


                            <button
                                type="button"
                                @click="curriculumOpen = false"
                                class="
                                    inline-flex
                                    h-10
                                    w-10
                                    items-center
                                    justify-center
                                    rounded-xl
                                    border
                                    border-slate-200
                                    text-slate-500
                                    transition
                                    hover:bg-slate-50
                                    hover:text-[#061638]
                                "
                                aria-label="Close curriculum"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>

                        </div>


                        <div class="p-4">
                            <x-learning.course-sidebar
                                :course="$course"
                                :user="$user"
                            />
                        </div>

                    </div>

                </div>


                {{-- Main LMS layout --}}

                <div
                    class="
                        grid
                        grid-cols-1
                        gap-6
                        lg:grid-cols-[320px_minmax(0,1fr)]
                        xl:grid-cols-[350px_minmax(0,1fr)]
                    "
                >

                    {{-- =================================================
                         DESKTOP CURRICULUM
                    ================================================== --}}

                    <div class="hidden lg:block">

                        <x-learning.course-sidebar
                            :course="$course"
                            :user="$user"
                        />

                    </div>


                    {{-- =================================================
                         MAIN LEARNING WORKSPACE
                    ================================================== --}}

                    <section class="min-w-0">

                        <div
                            class="
                                overflow-hidden
                                rounded-3xl
                                border
                                border-slate-200
                                bg-white
                                shadow-sm
                            "
                        >

                            {{-- Workspace header --}}

                            <div
                                class="
                                    border-b
                                    border-slate-200
                                    px-5
                                    py-5
                                    sm:px-7
                                "
                            >

                                <div
                                    class="
                                        flex
                                        flex-col
                                        gap-4
                                        sm:flex-row
                                        sm:items-end
                                        sm:justify-between
                                    "
                                >

                                    <div>

                                        <p
                                            id="workspace-eyebrow"
                                            class="
                                                text-[11px]
                                                font-extrabold
                                                uppercase
                                                tracking-[0.18em]
                                                text-[#D71920]
                                            "
                                        >
                                            Learning Workspace
                                        </p>

                                        <h2
                                            id="workspace-title"
                                            class="
                                                mt-1
                                                text-2xl
                                                font-extrabold
                                                tracking-tight
                                                text-[#061638]
                                                sm:text-3xl
                                            "
                                        >
                                            Course Modules
                                        </h2>

                                        <p
                                            id="workspace-subtitle"
                                            class="
                                                mt-2
                                                max-w-2xl
                                                text-sm
                                                leading-6
                                                text-slate-500
                                            "
                                        >
                                            Work through each lesson, complete the activities,
                                            and finish the assessments at your own pace.
                                        </p>

                                    </div>


                                    <div
                                        id="workspace-context"
                                        class="
                                            shrink-0
                                            text-sm
                                            font-semibold
                                            text-slate-400
                                        "
                                    >
                                        {{ $course->modules->count() }}
                                        {{ \Illuminate\Support\Str::plural('module', $course->modules->count()) }}
                                    </div>

                                </div>

                            </div>


                            {{-- Existing module system stays here --}}

                            <div class="p-4 sm:p-6">


                                {{-- =============================================
                                     ACTIVE LESSON VIDEO
                                ============================================== --}}

                                <div
                                    id="video-player"
                                    class="mb-6 hidden"
                                >

                                    <div
                                        class="
                                            overflow-hidden
                                            rounded-2xl
                                            border
                                            border-slate-200
                                            bg-[#020617]
                                            shadow-sm
                                        "
                                    >

                                        {{-- YouTube target --}}

                                        <div
                                            id="youtube-player"
                                            class="
                                                aspect-video
                                                w-full
                                                bg-black
                                            "
                                        ></div>

                                    </div>

                                </div>



                                @php
                                    $firstModule = $course->modules->first();
                                    $firstEpisode = $firstModule?->episodes->first();

                                    $episodeMetadata = $course->modules
                                        ->flatMap(function ($module) use ($user) {
                                            return $module->episodes->mapWithKeys(function ($episode) use ($module, $user) {
                                                return [
                                                    'episode_' . $episode->id => [
                                                        'title' => $episode->title,
                                                        'module_title' => $module->title,
                                                        'description' => $episode->description,
                                                        'pdf_url' => $episode->pdf_path
                                                            ? asset('storage/' . $episode->pdf_path)
                                                            : null,
                                                        'completed' => $user
                                                            ? $user->watchedEpisodes->contains($episode->id)
                                                            : false,
                                                        'blocks' => $episode->blocks->map(function ($block) {
                                                            return [
                                                                'id' => $block->id,
                                                                'type' => $block->type,
                                                                'title' => $block->title,
                                                                'content' => $block->content,
                                                                'metadata' => $block->metadata,
                                                                'position' => $block->position,
                                                            ];
                                                        })->values(),
                                                    ],
                                                ];
                                            });
                                        });
                                @endphp

                                <script>
                                    window.episodeMetadata = @json($episodeMetadata);
                                </script>


                                {{-- =============================================
                                     ACTIVE LESSON DETAILS
                                ============================================== --}}

                                <div
                                    id="lesson-details"
                                    class="
                                        rounded-2xl
                                        border
                                        border-slate-200
                                        bg-white
                                    "
                                >

                                    <div class="px-5 py-6 sm:px-7 sm:py-7">

                                        @if ($firstEpisode)

                                            <div
                                                class="
                                                    flex
                                                    flex-col
                                                    gap-4
                                                    sm:flex-row
                                                    sm:items-start
                                                    sm:justify-between
                                                "
                                            >

                                                <div class="min-w-0">

                                                    @if ($firstModule)

                                                        <p
                                                            id="active-module-title"
                                                            class="
                                                                text-sm
                                                                font-semibold
                                                                text-slate-400
                                                            "
                                                        >
                                                            {{ $firstModule->title }}
                                                        </p>

                                                    @endif

                                                    <h3
                                                        id="active-lesson-title"
                                                        class="sr-only"
                                                    >
                                                        {{ $firstEpisode->title }}
                                                    </h3>

                                                </div>


                                                <div class="shrink-0">

                                                    @if (
                                                        $user &&
                                                        $user->watchedEpisodes->contains($firstEpisode->id)
                                                    )

                                                        <span
                                                            id="active-lesson-status"
                                                            class="
                                                                inline-flex
                                                                items-center
                                                                gap-2
                                                                rounded-full
                                                                bg-emerald-50
                                                                px-3
                                                                py-1.5
                                                                text-xs
                                                                font-bold
                                                                text-emerald-700
                                                            "
                                                        >
                                                            <span
                                                                class="
                                                                    flex
                                                                    h-4
                                                                    w-4
                                                                    items-center
                                                                    justify-center
                                                                    rounded-full
                                                                    bg-emerald-500
                                                                    text-[9px]
                                                                    text-white
                                                                "
                                                            >
                                                                ✓
                                                            </span>

                                                            Completed
                                                        </span>

                                                    @else

                                                        <span
                                                            id="active-lesson-status"
                                                            class="
                                                                inline-flex
                                                                items-center
                                                                gap-2
                                                                rounded-full
                                                                bg-slate-100
                                                                px-3
                                                                py-1.5
                                                                text-xs
                                                                font-bold
                                                                text-slate-500
                                                            "
                                                        >
                                                            Not Started
                                                        </span>

                                                    @endif

                                                </div>

                                            </div>


                                            {{-- Lesson description --}}

                                            <div
                                                id="active-lesson-description"
                                                class="
                                                    mt-6
                                                    border-t
                                                    border-slate-100
                                                    pt-6
                                                "
                                            >

                                                <h4
                                                    class="
                                                        text-sm
                                                        font-extrabold
                                                        text-[#061638]
                                                    "
                                                >
                                                    About this lesson
                                                </h4>


                                                @if ($firstEpisode->description)

                                                    <p
                                                        class="
                                                            mt-3
                                                            max-w-3xl
                                                            text-[15px]
                                                            leading-7
                                                            text-slate-600
                                                        "
                                                    >
                                                        {{ $firstEpisode->description }}
                                                    </p>

                                                @else

                                                    <p
                                                        class="
                                                            mt-3
                                                            text-sm
                                                            leading-6
                                                            text-slate-400
                                                        "
                                                    >
                                                        Watch the lesson above and continue through
                                                        the course content when you are ready.
                                                    </p>

                                                @endif

                                            </div>


                                            {{-- Lesson resources --}}

                                                <div
                                                    id="active-lesson-resources"
                                                    class="
                                                        mt-6
                                                        rounded-2xl
                                                        border
                                                        border-blue-100
                                                        bg-blue-50/60
                                                        p-4
                                                        {{ $firstEpisode->pdf_path ? '' : 'hidden' }}
                                                    "
                                                >

                                                    <div
                                                        class="
                                                            flex
                                                            flex-col
                                                            gap-3
                                                            sm:flex-row
                                                            sm:items-center
                                                            sm:justify-between
                                                        "
                                                    >

                                                        <div>

                                                            <p
                                                                class="
                                                                    text-sm
                                                                    font-extrabold
                                                                    text-[#061638]
                                                                "
                                                            >
                                                                Lesson Notes
                                                            </p>

                                                            <p
                                                                class="
                                                                    mt-1
                                                                    text-xs
                                                                    text-slate-500
                                                                "
                                                            >
                                                                Review the supporting material for this lesson.
                                                            </p>

                                                        </div>


                                                        <a
                                                            id="active-lesson-pdf-link"
                                                            href="{{ $firstEpisode->pdf_path ? asset('storage/' . $firstEpisode->pdf_path) : '#' }}"
                                                            target="_blank"
                                                            class="
                                                                inline-flex
                                                                items-center
                                                                justify-center
                                                                rounded-xl
                                                                bg-[#123A78]
                                                                px-4
                                                                py-2.5
                                                                text-sm
                                                                font-bold
                                                                text-white
                                                                transition
                                                                hover:bg-[#0d2d61]
                                                            "
                                                        >
                                                            Open Notes
                                                        </a>

                                                    </div>

                                                </div>


                                            {{-- Future theory content anchor --}}

                                            <div
                                                id="lesson-content-blocks"
                                                class="
                                                    mt-8
                                                    border-t
                                                    border-slate-100
                                                    pt-7
                                                "
                                            >

                                                <div
                                                    class="
                                                        rounded-2xl
                                                        border
                                                        border-dashed
                                                        border-slate-200
                                                        bg-slate-50
                                                        px-5
                                                        py-5
                                                    "
                                                >

                                                    <p
                                                        class="
                                                            text-sm
                                                            font-bold
                                                            text-[#061638]
                                                        "
                                                    >
                                                        Lesson learning content
                                                    </p>

                                                    <p
                                                        class="
                                                            mt-2
                                                            text-sm
                                                            leading-6
                                                            text-slate-500
                                                        "
                                                    >
                                                        Theory, examples, activities, prompt cards,
                                                        code blocks and other learning materials will
                                                        appear here as we introduce the new lesson
                                                        content system.
                                                    </p>

                                                </div>

                                            </div>


                                            {{-- Lesson navigation --}}

                                            <div
                                                id="lesson-navigation"
                                                class="
                                                    mt-7
                                                    flex
                                                    flex-col
                                                    gap-3
                                                    border-t
                                                    border-slate-100
                                                    pt-6
                                                    sm:flex-row
                                                    sm:items-center
                                                    sm:justify-between
                                                "
                                            >

                                                <button
                                                    type="button"
                                                    id="previous-lesson-button"
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        gap-2
                                                        rounded-xl
                                                        border
                                                        border-slate-200
                                                        bg-white
                                                        px-4
                                                        py-3
                                                        text-sm
                                                        font-bold
                                                        text-slate-600
                                                        transition
                                                        hover:border-slate-300
                                                        hover:bg-slate-50
                                                        disabled:cursor-not-allowed
                                                        disabled:opacity-40
                                                    "
                                                >
                                                    <span aria-hidden="true">←</span>
                                                    Previous
                                                </button>


                                                <button
                                                    type="button"
                                                    id="mark-lesson-complete-button"
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        gap-2
                                                        rounded-xl
                                                        bg-[#123A78]
                                                        px-5
                                                        py-3
                                                        text-sm
                                                        font-extrabold
                                                        text-white
                                                        transition
                                                        hover:bg-[#0d2d61]
                                                        disabled:cursor-not-allowed
                                                        disabled:opacity-60
                                                    "
                                                >
                                                    <span aria-hidden="true">✓</span>
                                                    <span id="mark-lesson-complete-label">
                                                        Mark Complete
                                                    </span>
                                                </button>


                                                <button
                                                    type="button"
                                                    id="next-lesson-button"
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        gap-2
                                                        rounded-xl
                                                        border
                                                        border-[#123A78]
                                                        bg-white
                                                        px-4
                                                        py-3
                                                        text-sm
                                                        font-bold
                                                        text-[#123A78]
                                                        transition
                                                        hover:bg-blue-50
                                                        disabled:cursor-not-allowed
                                                        disabled:opacity-40
                                                    "
                                                >
                                                    Next
                                                    <span aria-hidden="true">→</span>
                                                </button>

                                            </div>

                                        @else

                                            <div
                                                class="
                                                    px-4
                                                    py-10
                                                    text-center
                                                "
                                            >

                                                <h3
                                                    class="
                                                        text-lg
                                                        font-extrabold
                                                        text-[#061638]
                                                    "
                                                >
                                                    No lessons available yet
                                                </h3>

                                                <p
                                                    class="
                                                        mt-2
                                                        text-sm
                                                        text-slate-400
                                                    "
                                                >
                                                    Course content will appear here once lessons are added.
                                                </p>

                                            </div>

                                        @endif

                                    </div>

                                </div>


                                {{-- =============================================
                                     ASSIGNMENT PANELS
                                ============================================== --}}

                                @foreach ($course->modules as $module)

                                    @foreach ($module->assignments as $assignment)

                                        <div
                                            id="assignment-panel-{{ $assignment->id }}"
                                            data-learning-panel="assignment"
                                            class="hidden rounded-2xl border border-amber-100 bg-amber-50/60 p-6"
                                        >

                                            <div class="min-w-0">

                                                @if ($assignment->instructions)

                                                        <div
                                                            class="
                                                                mt-5
                                                                rounded-xl
                                                                border
                                                                border-amber-100
                                                                bg-white
                                                                p-5
                                                            "
                                                        >

                                                            <h4
                                                                class="
                                                                    text-sm
                                                                    font-extrabold
                                                                    text-[#061638]
                                                                "
                                                            >
                                                                Instructions
                                                            </h4>

                                                            <div
                                                                class="
                                                                    mt-3
                                                                    whitespace-pre-line
                                                                    text-[15px]
                                                                    leading-7
                                                                    text-slate-600
                                                                "
                                                            >
                                                                {{ $assignment->instructions }}
                                                            </div>

                                                        </div>

                                                    @else

                                                        <p
                                                            class="
                                                                mt-4
                                                                text-sm
                                                                leading-6
                                                                text-slate-500
                                                            "
                                                        >
                                                            No assignment instructions have been added yet.
                                                        </p>

                                                @endif

                                            </div>

                                        </div>

                                    @endforeach

                                @endforeach


                                {{-- =============================================
                                     QUIZ PANELS
                                ============================================== --}}

                                @foreach ($course->modules as $module)

                                    @foreach ($module->quizzes as $quiz)

                                        @php

                                            $attempt = $user
                                                ? $user
                                                    ->quizAttempts()
                                                    ->where('quiz_id', $quiz->id)
                                                    ->where('passed', true)
                                                    ->latest()
                                                    ->first()
                                                : null;

                                            $isExamMode = $quiz->questions->contains(
                                                fn ($question) => in_array(
                                                    $question->type,
                                                    ['short_answer', 'practical'],
                                                    true
                                                )
                                            );

                                            $pendingExamAttempt = $user && $isExamMode
                                                ? $user
                                                    ->quizAttempts()
                                                    ->with('answers')
                                                    ->where('quiz_id', $quiz->id)
                                                    ->where('status', 'pending_review')
                                                    ->latest()
                                                    ->first()
                                                : null;

                                            $savedExamAnswers = $pendingExamAttempt
                                                ? $pendingExamAttempt
                                                    ->answers
                                                    ->pluck('answer', 'quiz_question_id')
                                                    ->mapWithKeys(
                                                        fn ($answer, $questionId) => [
                                                            (string) $questionId => $answer,
                                                        ]
                                                    )
                                                    ->all()
                                                : [];

                                            $examSubmitted = (bool) $pendingExamAttempt;

                                        @endphp


                                        <div
                                            id="quiz-panel-{{ $quiz->id }}"
                                            data-learning-panel="quiz"
                                            class="hidden rounded-2xl border border-purple-100 bg-purple-50 p-6"
                                            x-data="quizComponent(
                                                {{ $quiz->id }},
                                                {{ $isExamMode ? 'true' : 'false' }},
                                                {{ $quiz->questions->count() }},
                                                {{ $examSubmitted ? 'true' : 'false' }},
                                                @js($savedExamAnswers)
                                            )"
                                        >

                                            <div class="flex items-start justify-between gap-4">

                                                <div class="min-w-0 flex-1">

                                                    @if ($quiz->description)

                                                        <p class="text-sm leading-6 text-slate-600">
                                                            {{ $quiz->description }}
                                                        </p>

                                                    @endif

                                                </div>


                                                @if ($attempt)

                                                    <span class="shrink-0 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                                        Completed
                                                    </span>

                                                @endif

                                            </div>


                                            <div class="mt-6 space-y-6">

                                                @foreach ($quiz->questions as $question)

                                                    <div class="rounded-xl bg-white p-4 shadow-sm">

                                                        <h4 class="mb-4 font-semibold text-slate-800">
                                                            {{ $loop->iteration }}.
                                                            {{ $question->question }}
                                                        </h4>

                                                        @if ($question->type === 'multiple_choice')

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
                                                                        @if ($isExamMode)
                                                                            null
                                                                        @else
                                                                            @js($question->correct_answer)
                                                                        @endif
                                                                    )"
                                                                    :disabled="submitting || (examMode && submitted) || (!examMode && answers[{{ $question->id }}])"
                                                                    class="w-full rounded-xl border px-4 py-3 text-left transition"
                                                                    :class="getButtonClass(
                                                                        {{ $question->id }},
                                                                        '{{ $key }}',
                                                                        @if ($isExamMode)
                                                                            null
                                                                        @else
                                                                            @js($question->correct_answer)
                                                                        @endif
                                                                    )"
                                                                >

                                                                    <div class="font-bold uppercase text-purple-600">
                                                                        {{ $key }}
                                                                    </div>

                                                                    <div class="text-slate-800">
                                                                        {{ $option }}
                                                                    </div>

                                                                </button>

                                                            @endforeach

                                                        </div>


                                                        @unless ($isExamMode)

                                                            <div
                                                                x-show="feedback[{{ $question->id }}]"
                                                                class="mt-4 text-sm"
                                                            >

                                                                <template x-if="feedback[{{ $question->id }}] === 'correct'">

                                                                    <div class="font-semibold text-blue-700">
                                                                        Correct Answer
                                                                    </div>

                                                                </template>


                                                                <template x-if="feedback[{{ $question->id }}] === 'wrong'">

                                                                    <div class="font-semibold text-red-600">
                                                                        Incorrect. Correct answer:
                                                                        {{ $question->correct_answer }}
                                                                    </div>

                                                                </template>

                                                            </div>

                                                        @endunless

                                                        @elseif ($question->type === 'short_answer')

                                                            <textarea
                                                                rows="5"
                                                                x-model="answers[{{ $question->id }}]"
                                                                :disabled="submitting || (examMode && submitted)"
                                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm leading-6 text-slate-800 outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100"
                                                                placeholder="Write your answer here."
                                                            ></textarea>

                                                        @elseif ($question->type === 'practical')

                                                            <textarea
                                                                rows="8"
                                                                x-model="answers[{{ $question->id }}]"
                                                                :disabled="submitting || (examMode && submitted)"
                                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 font-mono text-sm leading-6 text-slate-800 outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100"
                                                                placeholder="Write your practical response here."
                                                            ></textarea>

                                                        @endif

                                                    </div>

                                                @endforeach

                                            </div>


                                            <div class="mt-6">

                                                <button
                                                    type="button"
                                                    @click="submitQuiz"
                                                    :disabled="submitting || (examMode && submitted)"
                                                    class="rounded-xl bg-purple-600 px-6 py-3 font-semibold text-white transition hover:bg-purple-700 disabled:cursor-not-allowed disabled:opacity-60"
                                                    x-text="
                                                        submitting
                                                            ? 'Submitting...'
                                                            : (examMode && submitted)
                                                                ? 'Examination Submitted'
                                                                : 'Submit Quiz'
                                                    "
                                                >
                                                    Submit Quiz
                                                </button>

                                            </div>


                                            <div
                                                id="quiz-result-{{ $quiz->id }}"
                                                x-show="resultVisible"
                                                x-cloak
                                                class="mt-4 rounded-xl border border-slate-200 bg-white p-5"
                                            >

                                                <template x-if="requiresReview">
                                                    <div>
                                                        <h4 class="text-lg font-semibold text-slate-900">
                                                            Examination Submitted
                                                        </h4>

                                                        <p
                                                            class="mt-2 text-sm leading-6 text-slate-600"
                                                            x-text="resultMessage"
                                                        ></p>

                                                        <p class="mt-3 text-sm font-medium text-slate-700">
                                                            Your final score will be available after the written and practical responses have been reviewed.
                                                        </p>
                                                    </div>
                                                </template>

                                                <template x-if="!requiresReview">
                                                    <div>
                                                        <h4 class="text-lg font-bold text-slate-900">
                                                            Your Score:
                                                            <span x-text="score + '%'"></span>
                                                        </h4>

                                                        <p
                                                            class="mt-2 font-medium"
                                                            :class="passed ? 'text-green-600' : 'text-red-600'"
                                                        >
                                                            <span
                                                                x-text="passed
                                                                    ? 'Quiz Completed'
                                                                    : 'Please Retry Incorrect Answers'"
                                                            ></span>
                                                        </p>
                                                    </div>
                                                </template>

                                            </div>

                                        </div>

                                    @endforeach

                                @endforeach


                            </div>


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

{{-- ================================================================
     CLASSROOM JAVASCRIPT
     Video playback + episode progress + quiz functionality
================================================================ --}}

<script>

/*
|--------------------------------------------------------------------------
| YOUTUBE PLAYER
|--------------------------------------------------------------------------
| Robust YouTube player initialization.
| This section should NOT interfere with the quiz component.
|--------------------------------------------------------------------------
*/

let player = null;
let currentEpisodeId = null;
let progressChecker = null;
let markedCompleted = false;
let youtubeApiPromise = null;


/*
|--------------------------------------------------------------------------
| LESSON NAVIGATION HELPERS
|--------------------------------------------------------------------------
*/

function getLessonNavigationItems()
{
    return Array.from(
        document.querySelectorAll(
            '[data-learning-nav-type="video"]'
        )
    );
}


function openLessonByNavigationOffset(offset)
{
    const items =
        getLessonNavigationItems();

    const currentIndex =
        items.findIndex(
            function(item)
            {
                return Number(
                    item.dataset.learningNavId
                ) === Number(currentEpisodeId);
            }
        );

    const target =
        items[currentIndex + offset];

    if (!target)
    {
        return;
    }

    target.click();

    target.scrollIntoView({
        behavior: 'smooth',
        block: 'nearest'
    });
}


function bindLessonNavigationButtons()
{
    const previousButton =
        document.getElementById(
            'previous-lesson-button'
        );

    const nextButton =
        document.getElementById(
            'next-lesson-button'
        );

    const completeButton =
        document.getElementById(
            'mark-lesson-complete-button'
        );


    if (previousButton)
    {
        previousButton.addEventListener(
            'click',
            function()
            {
                openLessonByNavigationOffset(-1);
            }
        );
    }


    if (nextButton)
    {
        nextButton.addEventListener(
            'click',
            function()
            {
                openLessonByNavigationOffset(1);
            }
        );
    }


    if (completeButton)
    {
        completeButton.addEventListener(
            'click',
            function()
            {
                if (!currentEpisodeId)
                {
                    return;
                }

                markEpisodeWatched(
                    currentEpisodeId
                );
            }
        );
    }
}


function updateLessonNavigation()
{
    const items =
        getLessonNavigationItems();

    const previousButton =
        document.getElementById(
            'previous-lesson-button'
        );

    const nextButton =
        document.getElementById(
            'next-lesson-button'
        );

    const completeButton =
        document.getElementById(
            'mark-lesson-complete-button'
        );

    const completeLabel =
        document.getElementById(
            'mark-lesson-complete-label'
        );


    if (
        !currentEpisodeId ||
        items.length === 0
    )
    {
        if (previousButton)
        {
            previousButton.disabled = true;
        }

        if (nextButton)
        {
            nextButton.disabled = true;
        }

        return;
    }


    const currentIndex =
        items.findIndex(
            function(item)
            {
                return Number(
                    item.dataset.learningNavId
                ) === Number(currentEpisodeId);
            }
        );


    if (previousButton)
    {
        previousButton.disabled =
            currentIndex <= 0;
    }


    if (nextButton)
    {
        nextButton.disabled =
            currentIndex === -1 ||
            currentIndex >= items.length - 1;
    }


    const metadata =
        window.episodeMetadata?.[
            'episode_' + currentEpisodeId
        ];


    if (
        completeButton &&
        completeLabel
    )
    {
        const completed =
            Boolean(metadata?.completed);

        completeButton.disabled =
            completed;

        completeLabel.textContent =
            completed
                ? 'Completed'
                : 'Mark Complete';
    }
}


/*
|--------------------------------------------------------------------------
| LOAD YOUTUBE API
|--------------------------------------------------------------------------
|
| Instead of depending only on onYouTubeIframeAPIReady(),
| we explicitly detect whether the API already exists.
|
|--------------------------------------------------------------------------
*/

function renderLessonBlocks(blocks = [])
{
    const container =
        document.getElementById(
            'lesson-content-blocks'
        );

    if (!container) {
        return;
    }

    container.innerHTML = '';

    if (!blocks.length)
    {
        return;
    }

    blocks.forEach((block) => {
        if (block.type === 'text')
        {
            const wrapper =
                document.createElement('section');

            wrapper.className =
                'pt-7';

            if (block.title)
            {
                const title =
                    document.createElement('h4');

                title.className =
                    'text-base font-bold text-[#061638]';

                title.textContent =
                    block.title;

                wrapper.appendChild(title);
            }

            if (block.content)
            {
                const body =
                    document.createElement('div');

                body.className =
                    'mt-3 max-w-3xl whitespace-pre-line text-[15px] leading-7 text-slate-600';

                body.textContent =
                    block.content;

                wrapper.appendChild(body);
            }

            container.appendChild(wrapper);

            return;
        }


        if (block.type === 'prompt')
        {
            const card =
                document.createElement('section');

            card.className =
                'mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm';

            const header =
                document.createElement('div');

            header.className =
                'flex items-center justify-between gap-4 border-b border-slate-200 bg-slate-50 px-4 py-3 sm:px-5';

            const heading =
                document.createElement('div');

            const label =
                document.createElement('div');

            label.className =
                'text-[11px] font-extrabold uppercase tracking-wide text-[#2F6BFF]';

            label.textContent =
                block.metadata?.label ?? 'Prompt Example';

            heading.appendChild(label);

            if (block.title)
            {
                const title =
                    document.createElement('h4');

                title.className =
                    'mt-2 text-sm font-bold text-[#061638] sm:text-base';

                title.textContent =
                    block.title;

                heading.appendChild(title);
            }

            const copyButton =
                document.createElement('button');

            copyButton.type = 'button';

            copyButton.className =
                'shrink-0 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-[#061638] shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2F6BFF] focus:outline-none focus:ring-1 focus:ring-[#2F6BFF]';

            copyButton.textContent =
                'Copy';

            const contentArea =
                document.createElement('div');

            contentArea.className =
                'overflow-x-auto bg-[#081426] px-5 py-5';

            const pre =
                document.createElement('pre');

            pre.className =
                'm-0 min-w-full whitespace-pre-wrap break-words font-mono text-sm leading-7 text-slate-100';

            const code =
                document.createElement('code');

            code.textContent =
                block.content ?? '';

            pre.appendChild(code);
            contentArea.appendChild(pre);

            copyButton.addEventListener(
                'click',
                async () => {
                    try
                    {
                        await navigator.clipboard.writeText(
                            code.innerText.trim()
                        );

                        copyButton.textContent =
                            'Copied';

                        setTimeout(() => {
                            copyButton.textContent =
                                'Copy';
                        }, 1800);
                    }
                    catch (error)
                    {
                        console.error(
                            'Unable to copy content:',
                            error
                        );
                    }
                }
            );

            header.appendChild(heading);
            header.appendChild(copyButton);

            card.appendChild(header);
            card.appendChild(contentArea);

            container.appendChild(card);

            return;
        }


        if (block.type === 'code')
        {
            const card =
                document.createElement('section');

            card.className =
                'mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm';

            const header =
                document.createElement('div');

            header.className =
                'flex items-center justify-between gap-4 border-b border-slate-200 bg-slate-50 px-4 py-3 sm:px-5';

            const heading =
                document.createElement('div');

            const label =
                document.createElement('div');

            label.className =
                'text-[11px] font-extrabold uppercase tracking-wide text-slate-500';

            label.textContent =
                block.metadata?.language
                    ? String(block.metadata.language).toUpperCase()
                    : 'Code';

            heading.appendChild(label);

            if (block.title)
            {
                const title =
                    document.createElement('h4');

                title.className =
                    'mt-2 text-sm font-bold text-[#061638] sm:text-base';

                title.textContent =
                    block.title;

                heading.appendChild(title);
            }

            const copyButton =
                document.createElement('button');

            copyButton.type = 'button';

            copyButton.className =
                'shrink-0 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-[#061638] shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2F6BFF] focus:outline-none focus:ring-1 focus:ring-[#2F6BFF]';

            copyButton.textContent =
                'Copy';

            const contentArea =
                document.createElement('div');

            contentArea.className =
                'overflow-x-auto bg-[#081426] px-5 py-5';

            const pre =
                document.createElement('pre');

            pre.className =
                'm-0 min-w-full whitespace-pre font-mono text-sm leading-7 text-slate-100';

            const code =
                document.createElement('code');

            code.textContent =
                block.content ?? '';

            pre.appendChild(code);
            contentArea.appendChild(pre);

            copyButton.addEventListener(
                'click',
                async () => {
                    try
                    {
                        await navigator.clipboard.writeText(
                            code.innerText.trim()
                        );

                        copyButton.textContent =
                            'Copied';

                        setTimeout(() => {
                            copyButton.textContent =
                                'Copy';
                        }, 1800);
                    }
                    catch (error)
                    {
                        console.error(
                            'Unable to copy content:',
                            error
                        );
                    }
                }
            );

            header.appendChild(heading);
            header.appendChild(copyButton);

            card.appendChild(header);
            card.appendChild(contentArea);

            container.appendChild(card);

            return;
        }


        if (block.type === 'activity')
        {
            const card =
                document.createElement('section');

            card.className =
                'mt-6 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-5 sm:px-6';

            const label =
                document.createElement('div');

            label.className =
                'text-[11px] font-extrabold uppercase tracking-wide text-[#2F6BFF]';

            label.textContent =
                block.metadata?.label ?? 'Practice Activity';

            card.appendChild(label);

            if (block.title)
            {
                const title =
                    document.createElement('h4');

                title.className =
                    'mt-2 text-base font-bold text-[#061638]';

                title.textContent =
                    block.title;

                card.appendChild(title);
            }

            if (block.content)
            {
                const body =
                    document.createElement('div');

                body.className =
                    'mt-3 max-w-3xl whitespace-pre-line text-[15px] leading-7 text-slate-600';

                body.textContent =
                    block.content;

                card.appendChild(body);
            }

            container.appendChild(card);

            return;
        }


        if (block.type === 'tip')
        {
            const card =
                document.createElement('section');

            card.className =
                'mt-6 rounded-2xl border border-slate-200 bg-white px-5 py-5 sm:px-6';

            const label =
                document.createElement('div');

            label.className =
                'text-[11px] font-extrabold uppercase tracking-wide text-slate-500';

            label.textContent =
                block.metadata?.label ?? 'Tip';

            card.appendChild(label);

            if (block.title)
            {
                const title =
                    document.createElement('h4');

                title.className =
                    'mt-2 text-base font-bold text-[#061638]';

                title.textContent =
                    block.title;

                card.appendChild(title);
            }

            if (block.content)
            {
                const body =
                    document.createElement('div');

                body.className =
                    'mt-3 max-w-3xl whitespace-pre-line text-[15px] leading-7 text-slate-600';

                body.textContent =
                    block.content;

                card.appendChild(body);
            }

            container.appendChild(card);

            return;
        }


        if (block.type === 'warning')
        {
            const card =
                document.createElement('section');

            card.className =
                'mt-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-5 sm:px-6';

            const label =
                document.createElement('div');

            label.className =
                'text-[11px] font-extrabold uppercase tracking-wide text-[#D71920]';

            label.textContent =
                block.metadata?.label ?? 'Warning';

            card.appendChild(label);

            if (block.title)
            {
                const title =
                    document.createElement('h4');

                title.className =
                    'mt-2 text-base font-bold text-[#061638]';

                title.textContent =
                    block.title;

                card.appendChild(title);
            }

            if (block.content)
            {
                const body =
                    document.createElement('div');

                body.className =
                    'mt-3 max-w-3xl whitespace-pre-line text-[15px] leading-7 text-slate-700';

                body.textContent =
                    block.content;

                card.appendChild(body);
            }

            container.appendChild(card);

            return;
        }


        if (block.type === 'download')
        {
            const card =
                document.createElement('section');

            card.className =
                'mt-6 rounded-2xl border border-slate-200 bg-white px-5 py-5 sm:px-6';

            const label =
                document.createElement('div');

            label.className =
                'text-[11px] font-extrabold uppercase tracking-wide text-slate-500';

            label.textContent =
                block.metadata?.label ?? 'Resource';

            card.appendChild(label);

            if (block.title)
            {
                const title =
                    document.createElement('h4');

                title.className =
                    'mt-2 text-base font-bold text-[#061638]';

                title.textContent =
                    block.title;

                card.appendChild(title);
            }

            if (block.content)
            {
                const body =
                    document.createElement('div');

                body.className =
                    'mt-3 max-w-3xl whitespace-pre-line text-[15px] leading-7 text-slate-600';

                body.textContent =
                    block.content;

                card.appendChild(body);
            }

            if (block.metadata?.url)
            {
                const link =
                    document.createElement('a');

                link.href =
                    block.metadata.url;

                link.target =
                    '_blank';

                link.rel =
                    'noopener noreferrer';

                link.className =
                    'mt-4 inline-flex rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-[#061638] transition hover:border-blue-300 hover:bg-blue-50 hover:text-[#2F6BFF] focus:outline-none focus:ring-1 focus:ring-[#2F6BFF]';

                link.textContent =
                    block.metadata?.button_text ?? 'Download Resource';

                card.appendChild(link);
            }

            container.appendChild(card);

            return;
        }


        if (block.type === 'image')
        {
            const figure =
                document.createElement('figure');

            figure.className =
                'mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white';

            if (block.title)
            {
                const title =
                    document.createElement('div');

                title.className =
                    'border-b border-slate-200 px-5 py-4 text-base font-bold text-[#061638]';

                title.textContent =
                    block.title;

                figure.appendChild(title);
            }

            if (block.metadata?.url)
            {
                const image =
                    document.createElement('img');

                image.src =
                    block.metadata.url;

                image.alt =
                    block.metadata?.alt ?? block.title ?? '';

                image.loading =
                    'lazy';

                image.className =
                    'block h-auto w-full object-contain';

                figure.appendChild(image);
            }

            if (block.content)
            {
                const caption =
                    document.createElement('figcaption');

                caption.className =
                    'border-t border-slate-200 px-5 py-4 text-sm leading-6 text-slate-600';

                caption.textContent =
                    block.content;

                figure.appendChild(caption);
            }

            container.appendChild(figure);

            return;
        }


        if (block.type === 'video')
        {
            const card =
                document.createElement('section');

            card.className =
                'mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white';

            if (block.title)
            {
                const title =
                    document.createElement('div');

                title.className =
                    'border-b border-slate-200 px-5 py-4 text-base font-bold text-[#061638]';

                title.textContent =
                    block.title;

                card.appendChild(title);
            }

            const rawVideo =
                block.metadata?.youtube_id ??
                block.metadata?.url ??
                '';

            let videoId =
                rawVideo;

            try
            {
                if (rawVideo.includes('youtube.com'))
                {
                    const url =
                        new URL(rawVideo);

                    videoId =
                        url.searchParams.get('v') ?? rawVideo;
                }
                else if (rawVideo.includes('youtu.be'))
                {
                    const url =
                        new URL(rawVideo);

                    videoId =
                        url.pathname.replace('/', '');
                }
            }
            catch (error)
            {
                console.error(
                    'Unable to parse video URL:',
                    error
                );
            }

            if (videoId)
            {
                const wrapper =
                    document.createElement('div');

                wrapper.className =
                    'aspect-video w-full bg-black';

                const iframe =
                    document.createElement('iframe');

                iframe.src =
                    'https://www.youtube.com/embed/' +
                    encodeURIComponent(videoId);

                iframe.className =
                    'h-full w-full';

                iframe.title =
                    block.title ?? 'Lesson video';

                iframe.loading =
                    'lazy';

                iframe.allow =
                    'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';

                iframe.allowFullscreen =
                    true;

                wrapper.appendChild(iframe);
                card.appendChild(wrapper);
            }

            if (block.content)
            {
                const caption =
                    document.createElement('div');

                caption.className =
                    'border-t border-slate-200 px-5 py-4 text-sm leading-6 text-slate-600';

                caption.textContent =
                    block.content;

                card.appendChild(caption);
            }

            container.appendChild(card);
        }
    });
}


function loadYouTubeAPI()
{
    /*
    |--------------------------------------------------------------------------
    | API already available
    |--------------------------------------------------------------------------
    */

    if (
        window.YT &&
        typeof window.YT.Player === 'function'
    )
    {
        console.log('YouTube API already available.');

        return Promise.resolve();
    }


    /*
    |--------------------------------------------------------------------------
    | API is already being loaded
    |--------------------------------------------------------------------------
    */

    if (youtubeApiPromise)
    {
        return youtubeApiPromise;
    }


    /*
    |--------------------------------------------------------------------------
    | Create API loading promise
    |--------------------------------------------------------------------------
    */

    youtubeApiPromise = new Promise(function(resolve, reject)
    {

        /*
        |--------------------------------------------------------------------------
        | Preserve any existing callback
        |--------------------------------------------------------------------------
        */

        const previousCallback =
            window.onYouTubeIframeAPIReady;


        /*
        |--------------------------------------------------------------------------
        | YouTube callback
        |--------------------------------------------------------------------------
        */

        window.onYouTubeIframeAPIReady =
            function()
            {

                console.log(
                    'YouTube iframe API is ready.'
                );


                /*
                |--------------------------------------------------------------------------
                | Call previous callback if one existed
                |--------------------------------------------------------------------------
                */

                if (
                    typeof previousCallback ===
                    'function'
                )
                {
                    try
                    {
                        previousCallback();
                    }
                    catch (error)
                    {
                        console.warn(
                            'Previous YouTube callback failed:',
                            error
                        );
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Confirm API
                |--------------------------------------------------------------------------
                */

                if (
                    window.YT &&
                    typeof window.YT.Player ===
                    'function'
                )
                {
                    resolve();
                }
                else
                {
                    reject(
                        new Error(
                            'YouTube API loaded but YT.Player is unavailable.'
                        )
                    );
                }

            };


        /*
        |--------------------------------------------------------------------------
        | Check whether script already exists
        |--------------------------------------------------------------------------
        */

        const existingScript =
            document.querySelector(
                'script[src*="youtube.com/iframe_api"]'
            );


        /*
        |--------------------------------------------------------------------------
        | Script already exists
        |--------------------------------------------------------------------------
        */

        if (existingScript)
        {
            console.log(
                'YouTube API script already exists.'
            );


            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | The API may already have loaded before our callback was registered.
            |--------------------------------------------------------------------------
            */

            let attempts = 0;

            const checkExistingAPI =
                setInterval(function()
                {

                    attempts++;


                    if (
                        window.YT &&
                        typeof window.YT.Player ===
                        'function'
                    )
                    {
                        clearInterval(
                            checkExistingAPI
                        );

                        console.log(
                            'Detected already-loaded YouTube API.'
                        );

                        resolve();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Stop after approximately 10 seconds
                    |--------------------------------------------------------------------------
                    */

                    if (attempts >= 50)
                    {
                        clearInterval(
                            checkExistingAPI
                        );

                        reject(
                            new Error(
                                'YouTube API did not become available.'
                            )
                        );
                    }

                }, 200);


            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Create YouTube API script
        |--------------------------------------------------------------------------
        */

        const script =
            document.createElement('script');


        script.src =
            'https://www.youtube.com/iframe_api';


        script.async = true;


        script.onerror =
            function()
            {
                reject(
                    new Error(
                        'Unable to load YouTube iframe API.'
                    )
                );
            };


        document.head.appendChild(
            script
        );

    });


    return youtubeApiPromise;
}


/*
|--------------------------------------------------------------------------
| PLAY EPISODE
|--------------------------------------------------------------------------
*/

window.showLesson =
    function(episodeId, lessonTitle = null, moduleTitle = null)
{
    const activeLessonTitle =
        document.getElementById('active-lesson-title');

    const activeModuleTitle =
        document.getElementById('active-module-title');

    if (activeLessonTitle && lessonTitle)
    {
        activeLessonTitle.textContent = lessonTitle;
    }

    if (activeModuleTitle && moduleTitle)
    {
        activeModuleTitle.textContent = moduleTitle;
    }

    const metadata =
        window.episodeMetadata?.['episode_' + episodeId];

    if (metadata)
    {
        const descriptionContainer =
            document.getElementById('active-lesson-description');

        const resourceContainer =
            document.getElementById('active-lesson-resources');

        const pdfLink =
            document.getElementById('active-lesson-pdf-link');

        const statusBadge =
            document.getElementById('active-lesson-status');

        if (descriptionContainer)
        {
            const body =
                descriptionContainer.querySelector('p');

            if (body)
            {
                if (metadata.description)
                {
                    body.textContent = metadata.description;

                    body.className =
                        'mt-3 max-w-3xl text-[15px] leading-7 text-slate-600';
                }
                else
                {
                    body.textContent =
                        'Review the lesson content below and continue when you are ready.';

                    body.className =
                        'mt-3 text-sm leading-6 text-slate-400';
                }
            }
        }

        if (resourceContainer && pdfLink)
        {
            if (metadata.pdf_url)
            {
                pdfLink.href = metadata.pdf_url;

                resourceContainer.classList.remove('hidden');
            }
            else
            {
                pdfLink.href = '#';

                resourceContainer.classList.add('hidden');
            }
        }

        renderLessonBlocks(
            metadata.blocks ?? []
        );

        if (statusBadge)
        {
            if (metadata.completed)
            {
                statusBadge.innerHTML = 'Completed';

                statusBadge.className =
                    'inline-flex items-center rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700';
            }
            else
            {
                statusBadge.textContent = 'Not Started';

                statusBadge.className =
                    'inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-500';
            }
        }
    }

    currentEpisodeId =
        episodeId;

    updateLessonNavigation();

    markedCompleted =
        false;

    if (progressChecker)
    {
        clearInterval(progressChecker);

        progressChecker = null;
    }

    if (window.showLearningItem)
    {
        window.showLearningItem(
            'lesson',
            episodeId
        );
    }
};


window.playEpisode =
    async function(videoId, episodeId, lessonTitle = null, moduleTitle = null)
{

    console.log(
        'playEpisode() called:',
        {
            videoId: videoId,
            episodeId: episodeId,
            lessonTitle: lessonTitle,
            moduleTitle: moduleTitle
        }
    );


    /*
    |--------------------------------------------------------------------------
    | UPDATE ACTIVE LESSON UI
    |--------------------------------------------------------------------------
    */

    const activeLessonTitle =
        document.getElementById(
            'active-lesson-title'
        );


    const activeModuleTitle =
        document.getElementById(
            'active-module-title'
        );


    const videoLessonTitle =
        document.getElementById(
            'video-lesson-title'
        );


    if (
        activeLessonTitle &&
        lessonTitle
    )
    {
        activeLessonTitle.textContent =
            lessonTitle;
    }


    if (
        activeModuleTitle &&
        moduleTitle
    )
    {
        activeModuleTitle.textContent =
            moduleTitle;
    }


    if (
        videoLessonTitle &&
        lessonTitle
    )
    {
        videoLessonTitle.textContent =
            lessonTitle;
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE ACTIVE LESSON METADATA
    |--------------------------------------------------------------------------
    */

    const metadata =
        window.episodeMetadata?.['episode_' + episodeId];

    if (metadata)
    {
        const descriptionContainer =
            document.getElementById(
                'active-lesson-description'
            );

        const resourceContainer =
            document.getElementById(
                'active-lesson-resources'
            );

        const pdfLink =
            document.getElementById(
                'active-lesson-pdf-link'
            );

        const statusBadge =
            document.getElementById(
                'active-lesson-status'
            );


        if (descriptionContainer)
        {
            const body =
                descriptionContainer.querySelector('p');

            if (body)
            {
                if (metadata.description)
                {
                    body.textContent =
                        metadata.description;

                    body.className =
                        'mt-3 max-w-3xl text-[15px] leading-7 text-slate-600';
                }
                else
                {
                    body.textContent =
                        'Watch the lesson above and continue through the course content when you are ready.';

                    body.className =
                        'mt-3 text-sm leading-6 text-slate-400';
                }
            }
        }


        if (
            resourceContainer &&
            pdfLink
        )
        {
            if (metadata.pdf_url)
            {
                pdfLink.href =
                    metadata.pdf_url;

                resourceContainer.classList.remove(
                    'hidden'
                );
            }
            else
            {
                pdfLink.href = '#';

                resourceContainer.classList.add(
                    'hidden'
                );
            }
        }


        renderLessonBlocks(
            metadata.blocks ?? []
        );


        if (statusBadge)
        {
            if (metadata.completed)
            {
                statusBadge.innerHTML =
                    '<span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-500 text-[9px] text-white">✓</span> Completed';

                statusBadge.className =
                    'inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700';
            }
            else
            {
                statusBadge.textContent =
                    'Not Started';

                statusBadge.className =
                    'inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-500';
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Find containers
    |--------------------------------------------------------------------------
    */

    const playerContainer =
        document.getElementById(
            'video-player'
        );


    const youtubeContainer =
        document.getElementById(
            'youtube-player'
        );


    if (!playerContainer)
    {
        console.error(
            'ERROR: #video-player was not found.'
        );

        return;
    }


    if (!youtubeContainer)
    {
        console.error(
            'ERROR: #youtube-player was not found.'
        );

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Store current episode
    |--------------------------------------------------------------------------
    */

    currentEpisodeId =
        episodeId;


    updateLessonNavigation();


    markedCompleted =
        false;


    /*
    |--------------------------------------------------------------------------
    | Stop old progress checker
    |--------------------------------------------------------------------------
    */

    if (progressChecker)
    {
        clearInterval(
            progressChecker
        );

        progressChecker =
            null;
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW VIDEO WORKSPACE
    |--------------------------------------------------------------------------
    */

    if (window.showLearningItem)
    {
        window.showLearningItem(
            'video',
            episodeId
        );
    }
    else
    {
        playerContainer.classList.remove(
            'hidden'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Make sure player has dimensions
    |--------------------------------------------------------------------------
    */

    youtubeContainer.style.width =
        '100%';


    youtubeContainer.style.minHeight =
        '450px';


    /*
    |--------------------------------------------------------------------------
    | Scroll to player
    |--------------------------------------------------------------------------
    */

    setTimeout(function()
    {

        playerContainer.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });

    }, 100);


    /*
    |--------------------------------------------------------------------------
    | LOAD YOUTUBE API
    |--------------------------------------------------------------------------
    */

    try
    {

        console.log(
            'Loading/checking YouTube API...'
        );


        await loadYouTubeAPI();


        console.log(
            'YouTube API confirmed ready.'
        );

    }
    catch (error)
    {

        console.error(
            'YouTube API failed:',
            error
        );


        youtubeContainer.innerHTML = `
            <div class="flex items-center justify-center w-full min-h-[450px] bg-gray-100 rounded-xl">
                <div class="text-center p-6">
                    <p class="text-red-600 font-semibold">
                        Unable to load the video.
                    </p>
                    <p class="text-gray-500 text-sm mt-2">
                        Please refresh the page and try again.
                    </p>
                </div>
            </div>
        `;


        return;
    }


    /*
    |--------------------------------------------------------------------------
    | REUSE EXISTING PLAYER
    |--------------------------------------------------------------------------
    */

    if (player)
    {

        try
        {

            console.log(
                'Reusing existing YouTube player.'
            );


            player.loadVideoById({
                videoId: videoId
            });


            return;

        }
        catch (error)
        {

            console.warn(
                'Existing YouTube player could not be reused.',
                error
            );


            player = null;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | CLEAR CONTAINER
    |--------------------------------------------------------------------------
    */

    youtubeContainer.innerHTML =
        '';


    /*
    |--------------------------------------------------------------------------
    | CREATE YOUTUBE PLAYER
    |--------------------------------------------------------------------------
    */

    try
    {

        console.log(
            'Creating YouTube player...'
        );


        player =
            new YT.Player(
                'youtube-player',
                {

                    width: '100%',

                    height: '450',

                    videoId: videoId,


                    playerVars:
                    {
                        autoplay: 1,

                        rel: 0,

                        modestbranding: 1,

                        playsinline: 1
                    },


                    events:
                    {

                        onReady:
                            function(event)
                        {

                            console.log(
                                'YouTube player created successfully.'
                            );


                            event.target.playVideo();

                        },


                        onStateChange:
                            function(event)
                        {

                            onPlayerStateChange(
                                event
                            );

                        },


                        onError:
                            function(event)
                        {

                            console.error(
                                'YouTube player error:',
                                event.data
                            );

                        }

                    }

                }
            );

    }
    catch (error)
    {

        console.error(
            'Failed to create YouTube player:',
            error
        );

    }

};


/*
|--------------------------------------------------------------------------
| LEARNING WORKSPACE SWITCHER
|--------------------------------------------------------------------------
*/

window.showLearningItem = function(type, id = null)
{
    window.dispatchEvent(
        new CustomEvent('learning-selected')
    );

    const navItems =
        document.querySelectorAll(
            '[data-learning-nav-type][data-learning-nav-id]'
        );


    const activeNavItem =
        Array.from(navItems).find(
            function(item)
            {
                return (
                    item.dataset.learningNavType === type &&
                    item.dataset.learningNavId === String(id)
                );
            }
        );


    const workspaceEyebrow =
        document.getElementById(
            'workspace-eyebrow'
        );

    const workspaceTitle =
        document.getElementById(
            'workspace-title'
        );

    const workspaceSubtitle =
        document.getElementById(
            'workspace-subtitle'
        );

    const workspaceContext =
        document.getElementById(
            'workspace-context'
        );


    if (activeNavItem)
    {
        const title =
            activeNavItem.dataset.learningNavTitle || '';

        const moduleTitle =
            activeNavItem.dataset.learningNavModule || '';

        const labels =
        {
            lesson: 'Lesson',
            video: 'Lesson',
            quiz: 'Quiz',
            assignment: 'Assignment'
        };

        const subtitles =
        {
            lesson:
                'Review the lesson content and complete the learning activities when you are ready.',

            video:
                'Watch the lesson, review the supporting material, and continue when you are ready.',

            quiz:
                'Complete this knowledge check and submit your answers when you are ready.',

            assignment:
                'Review the activity instructions and complete the required work.'
        };


        if (workspaceEyebrow)
        {
            workspaceEyebrow.textContent =
                labels[type] || 'Learning Workspace';
        }

        if (
            workspaceTitle &&
            title
        )
        {
            workspaceTitle.textContent =
                title;
        }

        if (workspaceSubtitle)
        {
            workspaceSubtitle.textContent =
                subtitles[type] ||
                'Continue through your course content.';
        }

        if (workspaceContext)
        {
            workspaceContext.textContent =
                moduleTitle;
        }
    }

    navItems.forEach(function(item)
    {
        const isActive =
            item.dataset.learningNavType === type &&
            item.dataset.learningNavId === String(id);

        item.classList.toggle(
            'bg-blue-50',
            isActive && type === 'video'
        );

        item.classList.toggle(
            'bg-purple-50',
            isActive && type === 'quiz'
        );

        item.classList.toggle(
            'bg-amber-50',
            isActive && type === 'assignment'
        );

    });


    const lessonDetails =
        document.getElementById('lesson-details');

    const videoPlayer =
        document.getElementById('video-player');

    const quizPanels =
        document.querySelectorAll('[data-learning-panel="quiz"]');

    const assignmentPanels =
        document.querySelectorAll('[data-learning-panel="assignment"]');


    if (lessonDetails)
    {
        lessonDetails.classList.add('hidden');
    }


    if (videoPlayer)
    {
        videoPlayer.classList.add('hidden');
    }


    quizPanels.forEach(function(panel)
    {
        panel.classList.add('hidden');
    });


    assignmentPanels.forEach(function(panel)
    {
        panel.classList.add('hidden');
    });


    if (type === 'lesson')
    {
        if (lessonDetails)
        {
            lessonDetails.classList.remove('hidden');
        }

        return;
    }


    if (type === 'video')
    {
        if (lessonDetails)
        {
            lessonDetails.classList.remove('hidden');
        }

        if (videoPlayer)
        {
            videoPlayer.classList.remove('hidden');
        }

        return;
    }


    if (type === 'quiz')
    {
        const panel =
            document.getElementById('quiz-panel-' + id);

        if (panel)
        {
            panel.classList.remove('hidden');

            panel.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        return;
    }


    if (type === 'assignment')
    {
        const panel =
            document.getElementById('assignment-panel-' + id);

        if (panel)
        {
            panel.classList.remove('hidden');

            panel.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
};


/*
|--------------------------------------------------------------------------
| YOUTUBE PLAYER STATE CHANGE
|--------------------------------------------------------------------------
*/

function onPlayerStateChange(event)
{

    /*
    |--------------------------------------------------------------------------
    | PLAYING
    |--------------------------------------------------------------------------
    */

    if (
        event.data ===
        YT.PlayerState.PLAYING
    )
    {

        console.log(
            'Video playing.'
        );


        /*
        |--------------------------------------------------------------------------
        | Stop previous checker
        |--------------------------------------------------------------------------
        */

        if (progressChecker)
        {
            clearInterval(
                progressChecker
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Start progress checker
        |--------------------------------------------------------------------------
        */

        progressChecker =
            setInterval(
                function()
                {

                    if (
                        !player ||
                        markedCompleted ||
                        !currentEpisodeId
                    )
                    {
                        return;
                    }


                    let currentTime = 0;
                    let duration = 0;


                    try
                    {

                        currentTime =
                            player.getCurrentTime();


                        duration =
                            player.getDuration();

                    }
                    catch (error)
                    {

                        console.warn(
                            'Unable to read video progress.',
                            error
                        );

                        return;
                    }


                    if (!duration)
                    {
                        return;
                    }


                    const watchedPercent =
                        (
                            currentTime /
                            duration
                        ) * 100;


                    console.log(
                        'Video progress:',
                        watchedPercent.toFixed(1) + '%'
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | COMPLETE AT 80%
                    |--------------------------------------------------------------------------
                    */

                    if (
                        watchedPercent >= 80
                    )
                    {

                        markedCompleted =
                            true;


                        markEpisodeWatched(
                            currentEpisodeId
                        );


                        clearInterval(
                            progressChecker
                        );


                        progressChecker =
                            null;

                    }

                },
                5000
            );

    }


    /*
    |--------------------------------------------------------------------------
    | PAUSED
    |--------------------------------------------------------------------------
    */

    if (
        event.data ===
        YT.PlayerState.PAUSED
    )
    {

        console.log(
            'Video paused.'
        );


        if (progressChecker)
        {
            clearInterval(
                progressChecker
            );

            progressChecker =
                null;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | ENDED
    |--------------------------------------------------------------------------
    */

    if (
        event.data ===
        YT.PlayerState.ENDED
    )
    {

        console.log(
            'Video ended.'
        );


        if (progressChecker)
        {
            clearInterval(
                progressChecker
            );

            progressChecker =
                null;
        }


        /*
        |--------------------------------------------------------------------------
        | Mark complete if not already completed
        |--------------------------------------------------------------------------
        */

        if (
            !markedCompleted &&
            currentEpisodeId
        )
        {

            markedCompleted =
                true;


            markEpisodeWatched(
                currentEpisodeId
            );

        }

    }

}


/*
|--------------------------------------------------------------------------
| MARK EPISODE WATCHED
|--------------------------------------------------------------------------
*/

function markEpisodeWatched(episodeId)
{

    if (!episodeId)
    {
        return;
    }


    console.log(
        'Marking episode watched:',
        episodeId
    );


    fetch(
        "{{ url('/episodes') }}/" +
        episodeId +
        "/watched",
        {

            method: 'POST',

            headers:
            {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}",

                'Content-Type':
                    'application/json',

                'Accept':
                    'application/json',

                'X-Requested-With':
                    'XMLHttpRequest'
            },

            credentials:
                'same-origin',

            body:
                JSON.stringify({})
        }
    )
    .then(
        function(response)
        {

            if (!response.ok)
            {
                throw new Error(
                    'Episode completion request failed.'
                );
            }


            return response.json();

        }
    )
    .then(
        function(data)
        {

            console.log(
                'Episode completion response:',
                data
            );


            if (
                data &&
                data.status ===
                'success'
            )
            {

                /*
                |--------------------------------------------------------------------------
                | Update redesigned lesson status
                |--------------------------------------------------------------------------
                */

                const metadataKey =
                    'episode_' + episodeId;

                if (
                    window.episodeMetadata &&
                    window.episodeMetadata[metadataKey]
                )
                {
                    window.episodeMetadata[metadataKey].completed = true;
                }


                const activeStatus =
                    document.getElementById(
                        'active-lesson-status'
                    );

                if (
                    activeStatus &&
                    currentEpisodeId === Number(episodeId)
                )
                {
                    activeStatus.innerHTML =
                        '<span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-500 text-[9px] text-white">✓</span> Completed';

                    activeStatus.className =
                        'inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700';
                }


                const sidebarItem =
                    document.querySelector(
                        '[data-learning-nav-type="video"]' +
                        '[data-learning-nav-id="' +
                        episodeId +
                        '"]'
                    );

                if (sidebarItem)
                {
                    const indicator =
                        sidebarItem.querySelector(
                            '[data-completion-indicator]'
                        );

                    if (indicator)
                    {
                        indicator.innerHTML = '✓';

                        indicator.className =
                            'mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-bold text-white';
                    }
                }


                updateLessonNavigation();

            }

        }
    )
    .catch(
        function(error)
        {

            console.error(
                'Episode completion error:',
                error
            );

        }
    );

}


/*
|--------------------------------------------------------------------------
| INITIALIZATION DEBUG
|--------------------------------------------------------------------------
*/

console.log(
    'Classroom video JavaScript loaded.'
);

document.addEventListener(
    'DOMContentLoaded',
    function()
    {
        bindLessonNavigationButtons();
        updateLessonNavigation();
    }
);


/*
|--------------------------------------------------------------------------
| CHECK YOUTUBE STATUS
|--------------------------------------------------------------------------
*/

setTimeout(
    function()
    {

        if (
            window.YT &&
            typeof window.YT.Player ===
            'function'
        )
        {

            console.log(
                'YouTube API detected on page load.'
            );

        }
        else
        {

            console.log(
                'YouTube API not yet detected. It will be loaded when needed.'
            );

        }

    },
    500
);

/*
|--------------------------------------------------------------------------
| QUIZ COMPONENT
|--------------------------------------------------------------------------
|
| IMPORTANT:
| This function is global so Alpine can find it when
| x-data="quizComponent(...)"
| initializes.
|--------------------------------------------------------------------------
*/

window.quizComponent = function (
    quizId,
    examMode = false,
    questionCount = 0,
    initialSubmitted = false,
    initialAnswers = {}
)
{

    const hasSubmittedExam =
        Boolean(examMode) &&
        Boolean(initialSubmitted);

    return {

        /*
        |--------------------------------------------------------------------------
        | Quiz State
        |--------------------------------------------------------------------------
        */

        quizId: quizId,

        examMode: Boolean(examMode),

        questionCount: Number(questionCount),

        answers:
            initialAnswers &&
            typeof initialAnswers === 'object'
                ? initialAnswers
                : {},

        feedback: {},

        score: null,

        passed: null,

        requiresReview: hasSubmittedExam,

        submissionStatus:
            hasSubmittedExam
                ? 'pending_review'
                : null,

        resultMessage:
            hasSubmittedExam
                ? 'Your examination has been submitted and is awaiting instructor review.'
                : '',

        resultVisible: hasSubmittedExam,

        submitting: false,

        submitted: hasSubmittedExam,


        /*
        |--------------------------------------------------------------------------
        | Select Answer
        |--------------------------------------------------------------------------
        */

        checkAnswer: function (
            questionId,
            selectedAnswer,
            correctAnswer
        )
        {

            const selected =
                String(selectedAnswer)
                    .trim()
                    .toUpperCase();


            /*
            |--------------------------------------------------------------------------
            | ALWAYS save the selected answer
            |--------------------------------------------------------------------------
            */

            this.answers[questionId] =
                selected;


            /*
            |--------------------------------------------------------------------------
            | Examination Mode
            |--------------------------------------------------------------------------
            |
            | Record the learner's selection without processing or revealing
            | the correct answer. Final grading happens only after submission.
            |
            */

            if (this.examMode)
            {
                delete this.feedback[questionId];

                return;
            }


            const correct =
                String(correctAnswer)
                    .trim()
                    .toUpperCase();


            /*
            |--------------------------------------------------------------------------
            | Immediate feedback
            |--------------------------------------------------------------------------
            */

            if (
                selected === correct
            )
            {

                this.feedback[questionId] =
                    'correct';

            }
            else
            {

                this.feedback[questionId] =
                    'wrong';

            }


            console.log(
                'Quiz answer selected:',
                {
                    questionId:
                        questionId,

                    selected:
                        selected,

                    correct:
                        correct
                }
            );

        },


        /*
        |--------------------------------------------------------------------------
        | Check Selected Answer
        |--------------------------------------------------------------------------
        */

        isSelected: function (
            questionId,
            answer
        )
        {

            const selected =
                this.answers[questionId];


            if (!selected)
            {
                return false;
            }


            return (
                selected ===
                String(answer)
                    .trim()
                    .toUpperCase()
            );

        },


        /*
        |--------------------------------------------------------------------------
        | Answer Button Styling
        |--------------------------------------------------------------------------
        */

        getButtonClass: function (
            questionId,
            option,
            correctAnswer
        )
        {

            const selected =
                this.answers[questionId];


            const current =
                String(option)
                    .trim()
                    .toUpperCase();


            /*
            |--------------------------------------------------------------------------
            | Examination Mode
            |--------------------------------------------------------------------------
            |
            | Show which option the learner selected without processing or
            | exposing whether the selection is correct or incorrect.
            |
            */

            if (this.examMode)
            {
                if (selected === current)
                {
                    return [
                        'border-blue-600',
                        'bg-blue-50',
                        'text-slate-900'
                    ].join(' ');
                }

                return [
                    'border-gray-200',
                    'hover:border-blue-400',
                    'hover:bg-blue-50',
                    'cursor-pointer'
                ].join(' ');
            }


            const correct =
                String(correctAnswer)
                    .trim()
                    .toUpperCase();


            /*
            |--------------------------------------------------------------------------
            | Nothing selected
            |--------------------------------------------------------------------------
            */

            if (!selected)
            {

                return [
                    'border-gray-200',
                    'hover:border-purple-400',
                    'hover:bg-purple-50',
                    'cursor-pointer'
                ].join(' ');

            }


            /*
            |--------------------------------------------------------------------------
            | Selected correct answer
            |--------------------------------------------------------------------------
            */

            if (
                selected === current &&
                current === correct
            )
            {

                return [
                    'border-blue-600',
                    'bg-blue-600',
                    'text-white'
                ].join(' ');

            }


            /*
            |--------------------------------------------------------------------------
            | Selected wrong answer
            |--------------------------------------------------------------------------
            */

            if (
                selected === current &&
                current !== correct
            )
            {

                return [
                    'border-red-500',
                    'bg-red-50',
                    'text-red-700'
                ].join(' ');

            }


            /*
            |--------------------------------------------------------------------------
            | Correct answer after wrong selection
            |--------------------------------------------------------------------------
            */

            if (
                current === correct &&
                selected !== correct
            )
            {

                return [
                    'border-green-400',
                    'bg-green-50',
                    'text-green-700'
                ].join(' ');

            }


            return [
                'border-gray-200'
            ].join(' ');

        },


        /*
        |--------------------------------------------------------------------------
        | Submit Quiz
        |--------------------------------------------------------------------------
        */

        submitQuiz: async function ()
        {

            /*
            |--------------------------------------------------------------------------
            | Prevent double submission
            |--------------------------------------------------------------------------
            */

            if (
                this.submitting ||
                (this.examMode && this.submitted)
            )
            {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Check answers
            |--------------------------------------------------------------------------
            */

            const answerCount =
                Object.values(this.answers)
                    .filter(answer =>
                        String(answer ?? '').trim() !== ''
                    )
                    .length;


            if (answerCount < this.questionCount)
            {

                const remaining =
                    this.questionCount - answerCount;

                alert(
                    'Please answer every question before submitting. ' +
                    remaining +
                    (remaining === 1
                        ? ' question is still unanswered.'
                        : ' questions are still unanswered.')
                );

                return;

            }


            this.submitting = true;


            try
            {

                console.log(
                    'Submitting quiz:',
                    this.quizId
                );


                console.log(
                    'Answers:',
                    this.answers
                );


                /*
                |--------------------------------------------------------------------------
                | Submit to Laravel
                |--------------------------------------------------------------------------
                */

                const response =
                    await fetch(
                        "{{ url('/quizzes') }}/" +
                        this.quizId +
                        "/submit",
                        {

                            method: 'POST',

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    "{{ csrf_token() }}",

                                'X-Requested-With':
                                    'XMLHttpRequest'

                            },

                            credentials:
                                'same-origin',

                            body:
                                JSON.stringify({

                                    answers:
                                        this.answers

                                })

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Read server response
                |--------------------------------------------------------------------------
                */

                const responseText =
                    await response.text();


                console.log(
                    'Quiz HTTP status:',
                    response.status
                );


                console.log(
                    'Quiz raw response:',
                    responseText
                );


                let data;


                try
                {

                    data =
                        JSON.parse(
                            responseText
                        );

                }
                catch (parseError)
                {

                    console.error(
                        'Quiz response is not valid JSON:',
                        responseText
                    );


                    throw new Error(
                        'The server returned an invalid response.'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | HTTP error
                |--------------------------------------------------------------------------
                */

                if (!response.ok)
                {

                    throw new Error(
                        data.message ||
                        'Quiz submission failed.'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Application error
                |--------------------------------------------------------------------------
                */

                if (
                    data.success === false
                )
                {

                    throw new Error(
                        data.message ||
                        'Quiz could not be submitted.'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Store score
                |--------------------------------------------------------------------------
                */

                this.requiresReview =
                    Boolean(
                        data.requires_review
                    );


                this.submissionStatus =
                    data.status ?? null;


                this.resultMessage =
                    data.message ?? 'Your submission has been received.';


                this.score =
                    data.score === null ||
                    data.score === undefined
                        ? null
                        : Number(data.score);


                /*
                |--------------------------------------------------------------------------
                | Store pass status
                |--------------------------------------------------------------------------
                */

                this.passed =
                    data.passed === null ||
                    data.passed === undefined
                        ? null
                        : Boolean(data.passed);


                /*
                |--------------------------------------------------------------------------
                | Show result
                |--------------------------------------------------------------------------
                */

                this.resultVisible =
                    true;


                /*
                |--------------------------------------------------------------------------
                | Lock successful submission
                |--------------------------------------------------------------------------
                */

                this.submitted =
                    true;


                console.log(
                    'Quiz result:',
                    {
                        score:
                            this.score,

                        passed:
                            this.passed
                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Scroll to result
                |--------------------------------------------------------------------------
                */

                if (
                    this.$nextTick
                )
                {

                    this.$nextTick(
                        function ()
                        {

                            const result =
                                document.getElementById(
                                    'quiz-result-' + this.quizId
                                );


                            if (result)
                            {

                                result.scrollIntoView({
                                    behavior:
                                        'smooth',

                                    block:
                                        'center'
                                });

                            }

                        }
                    );

                }

            }
            catch (error)
            {

                console.error(
                    'Quiz submission error:',
                    error
                );


                alert(
                    error.message ||
                    'Unable to submit quiz. Please try again.'
                );

            }
            finally
            {

                this.submitting =
                    false;

            }

        }

    };

};


/*
|--------------------------------------------------------------------------
| DEBUG
|--------------------------------------------------------------------------
*/

console.log(
    'Classroom JavaScript loaded successfully.'
);

</script>

@endsection