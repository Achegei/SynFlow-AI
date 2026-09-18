@props([
    'course',
    'user' => null,
])

@php
    $curriculumGroups = $course->stages->isNotEmpty()
        ? $course->stages
            ->sortBy('position')
            ->map(function ($stage) use ($course) {
                return [
                    'stage' => $stage,
                    'modules' => $course->modules
                        ->where('course_stage_id', $stage->id)
                        ->sortBy('position')
                        ->values(),
                ];
            })
            ->values()
        : collect([
            [
                'stage' => null,
                'modules' => $course->modules
                    ->sortBy('position')
                    ->values(),
            ],
        ]);

    $initialStage = $curriculumGroups->first()['stage']?->slug ?? 'all';
@endphp

<aside
    class="h-full"
    x-data="{ activeStage: '{{ $initialStage }}' }"
>
    <div
        class="
            overflow-hidden
            rounded-2xl
            border
            border-slate-200
            bg-white
            shadow-[0_12px_35px_rgba(6,22,56,0.07)]
            lg:sticky
            lg:top-6
        "
    >

        {{-- =========================================================
             SIDEBAR HEADER
        ========================================================== --}}

        <div class="border-b border-slate-200 bg-white px-4 pt-5">

            <div class="flex items-start justify-between gap-3 px-1">
                <div>
                    <p
                        class="
                            text-[11px]
                            font-extrabold
                            uppercase
                            tracking-[0.18em]
                            text-[#D71920]
                        "
                    >
                        Curriculum
                    </p>

                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-[#061638]">
                        Course Content
                    </h2>
                </div>

                <span
                    class="
                        rounded-full
                        bg-blue-50
                        px-3
                        py-1.5
                        text-xs
                        font-extrabold
                        text-[#123A78]
                    "
                >
                    {{ $course->modules->count() }}
                    {{ \Illuminate\Support\Str::plural('Unit', $course->modules->count()) }}
                </span>
            </div>

            {{-- Progress --}}

            <div class="mt-5 px-1 pb-5">
                <div class="flex items-center justify-between text-base">
                    <span class="font-semibold text-slate-600">
                        Your progress
                    </span>

                    <span class="font-extrabold text-[#123A78]">
                        {{ number_format($course->progress_percentage) }}%
                    </span>
                </div>

                <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-200">
                    <div
                        class="h-full rounded-full bg-[#2563EB] transition-all"
                        style="width: {{ min(100, max(0, $course->progress_percentage)) }}%"
                    ></div>
                </div>
            </div>

            {{-- =====================================================
                 STAGE NAVIGATION
            ====================================================== --}}

            @if ($course->stages->isNotEmpty())
                <div
                    class="
                        -mx-4
                        flex
                        overflow-x-auto
                        border-t
                        border-slate-200
                        bg-white
                        px-4
                        scrollbar-thin
                    "
                    role="tablist"
                    aria-label="Course stages"
                >
                    @foreach ($curriculumGroups as $group)
                        @php
                            $stage = $group['stage'];
                            $stageSlug = $stage?->slug ?? 'all';
                            $stageModules = $group['modules'];
                        @endphp

                        <button
                            type="button"
                            role="tab"
                            :aria-selected="activeStage === '{{ $stageSlug }}'"
                            @click="activeStage = '{{ $stageSlug }}'"
                            class="
                                relative
                                shrink-0
                                px-4
                                py-3.5
                                text-base
                                font-extrabold
                                transition
                                focus:outline-none
                                focus-visible:ring-2
                                focus-visible:ring-inset
                                focus-visible:ring-blue-200
                            "
                            :class="
                                activeStage === '{{ $stageSlug }}'
                                    ? 'text-[#123A78]'
                                    : 'text-slate-400 hover:text-slate-700'
                            "
                        >
                            {{ $stage?->title ?? 'Course' }}

                            <span
                                class="
                                    ml-1
                                    text-xs
                                    font-bold
                                    text-slate-400
                                "
                            >
                                {{ $stageModules->count() }}
                            </span>

                            <span
                                class="
                                    absolute
                                    inset-x-2
                                    bottom-0
                                    h-0.5
                                    rounded-full
                                    bg-[#123A78]
                                    transition-opacity
                                "
                                :class="
                                    activeStage === '{{ $stageSlug }}'
                                        ? 'opacity-100'
                                        : 'opacity-0'
                                "
                            ></span>
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- =========================================================
             CURRICULUM CONTENT
        ========================================================== --}}

        <nav
            class="
                max-h-[calc(100vh-300px)]
                overflow-y-auto
                overscroll-contain
            "
            aria-label="Course curriculum"
        >

            @foreach ($curriculumGroups as $group)
                @php
                    $stage = $group['stage'];
                    $stageModules = $group['modules'];
                    $stageSlug = $stage?->slug ?? 'all';
                @endphp

                <div
                    x-show="activeStage === '{{ $stageSlug }}'"
                    x-cloak
                >

                    {{-- Stage context --}}

                    @if ($stage)
                        <div class="border-b border-slate-200 bg-white px-4 py-3">
                            <div class="flex items-center justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-base font-extrabold tracking-tight text-[#061638]">
                                        {{ $stage->title }}
                                    </p>

                                    <p class="mt-0.5 text-xs font-semibold text-slate-500">
                                        {{ $stageModules->count() }}
                                        {{ \Illuminate\Support\Str::plural('module', $stageModules->count()) }}
                                    </p>
                                </div>

                                <span
                                    class="
                                        text-[10px]
                                        font-extrabold
                                        uppercase
                                        tracking-[0.14em]
                                        text-[#123A78]
                                    "
                                >
                                    Stage {{ $stage->position }}
                                </span>
                            </div>
                        </div>
                    @endif

                    @forelse ($stageModules as $module)

                        <div
                            x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }"
                            class="border-b border-slate-100 last:border-b-0"
                        >

                            {{-- MODULE / UNIT --}}

                            <button
                                type="button"
                                @click="open = !open"
                                class="
                                    flex
                                    w-full
                                    items-start
                                    gap-3
                                    px-4
                                    py-4
                                    text-left
                                    transition
                                    hover:bg-blue-50/50
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-inset
                                    focus:ring-blue-100
                                "
                            >

                                <span
                                    class="
                                        flex
                                        h-9
                                        w-9
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-blue-100
                                        text-xs
                                        font-extrabold
                                        text-[#123A78]
                                    "
                                >
                                    {{ $loop->iteration }}
                                </span>

                                <span class="min-w-0 flex-1">

                                    <span
                                        class="
                                            block
                                            text-base
                                            font-extrabold
                                            leading-6
                                            text-[#061638]
                                        "
                                    >
                                        {{ $module->title }}
                                    </span>

                                    <span
                                        class="
                                            mt-1
                                            block
                                            text-sm
                                            font-medium
                                            text-slate-600
                                        "
                                    >
                                        {{ $module->episodes->count() }}
                                        {{ \Illuminate\Support\Str::plural('lesson', $module->episodes->count()) }}

                                        @if ($module->quizzes->count())
                                            · {{ $module->quizzes->count() }}
                                            {{ \Illuminate\Support\Str::plural('quiz', $module->quizzes->count()) }}
                                        @endif

                                        @if ($module->assignments->count())
                                            · {{ $module->assignments->count() }}
                                            {{ \Illuminate\Support\Str::plural('assignment', $module->assignments->count()) }}
                                        @endif
                                    </span>

                                </span>

                                <svg
                                    class="
                                        mt-1
                                        h-4
                                        w-4
                                        shrink-0
                                        text-slate-500
                                        transition-transform
                                    "
                                    :class="{ 'rotate-180': open }"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7"
                                    />
                                </svg>

                            </button>

                            {{-- =================================================
                                 UNIT CONTENT
                            ================================================== --}}

                            <div
                                x-show="open"
                                x-transition
                                class="bg-slate-50/70"
                            >

                                {{-- LESSONS --}}

                                @foreach ($module->episodes as $episode)

                                    @php
                                        $completed =
                                            $user &&
                                            $user->watchedEpisodes->contains($episode->id);

                                        parse_str(
                                            parse_url(
                                                $episode->video_url,
                                                PHP_URL_QUERY
                                            ) ?? '',
                                            $youtubeParams
                                        );

                                        $videoId =
                                            $youtubeParams['v']
                                            ?? $episode->video_url;

                                        $learningType =
                                            $episode->video_url
                                                ? 'video'
                                                : 'lesson';
                                    @endphp

                                    <button
                                        type="button"
                                        data-learning-nav-type="{{ $learningType }}"
                                        data-learning-nav-id="{{ $episode->id }}"
                                        data-learning-nav-title="{{ $episode->title }}"
                                        data-learning-nav-module="{{ $module->title }}"
                                        data-video-id="{{ $videoId }}"
                                        data-episode-id="{{ $episode->id }}"
                                        data-lesson-title="{{ $episode->title }}"
                                        data-module-title="{{ $module->title }}"
                                        onclick="
                                            if (this.dataset.learningNavType === 'video') {
                                                playEpisode(
                                                    this.dataset.videoId,
                                                    Number(this.dataset.episodeId),
                                                    this.dataset.lessonTitle,
                                                    this.dataset.moduleTitle
                                                );
                                            } else {
                                                showLesson(
                                                    Number(this.dataset.episodeId),
                                                    this.dataset.lessonTitle,
                                                    this.dataset.moduleTitle
                                                );
                                            }
                                        "
                                        class="
                                            group
                                            flex
                                            w-full
                                            items-start
                                            gap-3
                                            border-t
                                            border-slate-100
                                            px-5
                                            py-3.5
                                            text-left
                                            transition
                                            hover:bg-blue-50
                                        "
                                    >

                                        @if ($completed)

                                            <span
                                                data-completion-indicator
                                                class="
                                                    mt-0.5
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    bg-emerald-500
                                                    text-[10px]
                                                    font-bold
                                                    text-white
                                                "
                                            >
                                                ✓
                                            </span>

                                        @else

                                            <span
                                                data-completion-indicator
                                                class="
                                                    mt-0.5
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    border-2
                                                    border-slate-300
                                                    bg-white
                                                    transition
                                                    group-hover:border-[#2F6BFF]
                                                "
                                            ></span>

                                        @endif

                                        <span class="min-w-0 flex-1">

                                            <span
                                                class="
                                                    block
                                                    text-sm
                                                    font-semibold
                                                    leading-5
                                                    text-slate-700
                                                    transition
                                                    group-hover:text-[#123A78]
                                                "
                                            >
                                                {{ $episode->title }}
                                            </span>

                                            <span
                                                class="
                                                    mt-0.5
                                                    block
                                                    text-[11px]
                                                    font-medium
                                                    text-slate-400
                                                "
                                            >
                                                {{ $learningType === 'video' ? 'Video lesson' : 'Lesson' }}
                                            </span>

                                        </span>

                                    </button>

                                @endforeach

                                {{-- QUIZZES --}}

                                @foreach ($module->quizzes as $quiz)

                                    @php
                                        $quizPassed = $user
                                            ? $user
                                                ->quizAttempts()
                                                ->where('quiz_id', $quiz->id)
                                                ->where('passed', true)
                                                ->exists()
                                            : false;
                                    @endphp

                                    <button
                                        type="button"
                                        data-learning-nav-type="quiz"
                                        data-learning-nav-id="{{ $quiz->id }}"
                                        data-learning-nav-title="{{ $quiz->title }}"
                                        data-learning-nav-module="{{ $module->title }}"
                                        onclick="showLearningItem('quiz', {{ $quiz->id }})"
                                        class="
                                            group
                                            flex
                                            w-full
                                            items-start
                                            gap-3
                                            border-t
                                            border-slate-100
                                            px-5
                                            py-3.5
                                            text-left
                                            transition
                                            hover:bg-purple-50
                                        "
                                    >

                                        @if ($quizPassed)

                                            <span
                                                class="
                                                    mt-0.5
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    bg-emerald-500
                                                    text-[10px]
                                                    font-bold
                                                    text-white
                                                "
                                            >
                                                ✓
                                            </span>

                                        @else

                                            <span
                                                class="
                                                    mt-0.5
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-md
                                                    bg-purple-100
                                                    text-[10px]
                                                    font-extrabold
                                                    text-purple-700
                                                "
                                            >
                                                Q
                                            </span>

                                        @endif

                                        <span class="min-w-0 flex-1">

                                            <span
                                                class="
                                                    block
                                                    text-sm
                                                    font-semibold
                                                    leading-5
                                                    text-slate-700
                                                    transition
                                                    group-hover:text-purple-700
                                                "
                                            >
                                                {{ $quiz->title }}
                                            </span>

                                            <span
                                                class="
                                                    mt-0.5
                                                    block
                                                    text-[11px]
                                                    font-medium
                                                    text-slate-400
                                                "
                                            >
                                                Quiz
                                            </span>

                                        </span>

                                    </button>

                                @endforeach

                                {{-- ASSIGNMENTS --}}

                                @foreach ($module->assignments as $assignment)

                                    <button
                                        type="button"
                                        data-learning-nav-type="assignment"
                                        data-learning-nav-id="{{ $assignment->id }}"
                                        data-learning-nav-title="{{ $assignment->title }}"
                                        data-learning-nav-module="{{ $module->title }}"
                                        onclick="showLearningItem('assignment', {{ $assignment->id }})"
                                        class="
                                            group
                                            flex
                                            w-full
                                            items-start
                                            gap-3
                                            border-t
                                            border-slate-100
                                            px-5
                                            py-3.5
                                            text-left
                                            transition
                                            hover:bg-amber-50
                                        "
                                    >

                                        <span
                                            class="
                                                mt-0.5
                                                flex
                                                h-5
                                                w-5
                                                shrink-0
                                                items-center
                                                justify-center
                                                rounded-md
                                                bg-amber-100
                                                text-[10px]
                                                font-extrabold
                                                text-amber-700
                                            "
                                        >
                                            A
                                        </span>

                                        <span class="min-w-0 flex-1">

                                            <span
                                                class="
                                                    block
                                                    text-sm
                                                    font-semibold
                                                    leading-5
                                                    text-slate-700
                                                    transition
                                                    group-hover:text-amber-700
                                                "
                                            >
                                                {{ $assignment->title }}
                                            </span>

                                            <span
                                                class="
                                                    mt-0.5
                                                    block
                                                    text-[11px]
                                                    font-medium
                                                    text-slate-400
                                                "
                                            >
                                                Assignment
                                            </span>

                                        </span>

                                    </button>

                                @endforeach

                            </div>

                        </div>

                    @empty

                        <div class="px-5 py-10 text-center">
                            <p class="text-sm font-semibold text-slate-500">
                                No modules in this stage yet.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Course content will appear here once modules are added.
                            </p>
                        </div>

                    @endforelse

                </div>

            @endforeach

        </nav>
    </div>
</aside>
