@props([
    'course',
    'user' => null,
])

<aside class="h-full">

    <div
        class="
            overflow-hidden
            rounded-2xl
            border
            border-slate-200
            bg-white
            shadow-sm
            lg:sticky
            lg:top-6
        "
    >

        {{-- =========================================================
             SIDEBAR HEADER
        ========================================================== --}}

        <div class="border-b border-slate-200 px-5 py-5">

            <div class="flex items-center justify-between gap-4">

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

                    <h2 class="mt-1 text-lg font-extrabold text-[#061638]">
                        Course Content
                    </h2>

                </div>

                <span
                    class="
                        rounded-full
                        bg-slate-100
                        px-2.5
                        py-1
                        text-xs
                        font-bold
                        text-slate-500
                    "
                >
                    {{ $course->modules->count() }}
                    {{ \Illuminate\Support\Str::plural('Unit', $course->modules->count()) }}
                </span>

            </div>


            {{-- Progress --}}

            <div class="mt-5">

                <div class="flex items-center justify-between text-xs">

                    <span class="font-semibold text-slate-500">
                        Your progress
                    </span>

                    <span class="font-extrabold text-[#123A78]">
                        {{ number_format($course->progress_percentage) }}%
                    </span>

                </div>

                <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="h-full rounded-full bg-[#2F6BFF] transition-all"
                        style="width: {{ min(100, max(0, $course->progress_percentage)) }}%"
                    ></div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             CURRICULUM
        ========================================================== --}}

        <nav
            class="
                max-h-[calc(100vh-220px)]
                overflow-y-auto
                overscroll-contain
            "
            aria-label="Course curriculum"
        >

            @php
                $curriculumGroups = $course->stages->isNotEmpty()
                    ? $course->stages->map(function ($stage) use ($course) {
                        return [
                            'stage' => $stage,
                            'modules' => $course->modules
                                ->where('course_stage_id', $stage->id)
                                ->sortBy('position')
                                ->values(),
                        ];
                    })
                    : collect([
                        [
                            'stage' => null,
                            'modules' => $course->modules
                                ->sortBy('position')
                                ->values(),
                        ],
                    ]);
            @endphp

            @foreach ($curriculumGroups as $group)

                @php
                    $stage = $group['stage'];
                    $stageModules = $group['modules'];
                @endphp

                @if ($stage)

                    <div class="border-b border-slate-200 bg-slate-50 px-4 py-3">

                        <div class="flex items-center justify-between gap-3">

                            <div class="min-w-0">

                                <p class="text-sm font-extrabold text-[#061638]">
                                    {{ $stage->title }}
                                </p>

                                <p class="mt-0.5 text-[11px] font-medium text-slate-400">
                                    {{ $stageModules->count() }}
                                    {{ \Illuminate\Support\Str::plural('module', $stageModules->count()) }}
                                </p>

                            </div>

                            <span class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-[#123A78]">
                                Stage {{ $stage->position }}
                            </span>

                        </div>

                    </div>

                @endif

                @forelse ($stageModules as $module)

                <div
                    x-data="{ open: {{ $loop->parent->first && $loop->first ? 'true' : 'false' }} }"
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
                            hover:bg-slate-50
                            focus:outline-none
                            focus:ring-2
                            focus:ring-inset
                            focus:ring-blue-100
                        "
                    >

                        <span
                            class="
                                flex
                                h-8
                                w-8
                                shrink-0
                                items-center
                                justify-center
                                rounded-lg
                                bg-blue-50
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
                                    text-sm
                                    font-bold
                                    leading-5
                                    text-[#061638]
                                "
                            >
                                {{ $module->title }}
                            </span>

                            <span
                                class="
                                    mt-1
                                    block
                                    text-xs
                                    text-slate-400
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
                                text-slate-400
                                transition-transform
                            "
                            :class="{ 'rotate-180': open }"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
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

                                {{-- Completion state --}}

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
                                            text-[13px]
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
                                            text-[13px]
                                            font-semibold
                                            leading-5
                                            text-slate-700
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
                                            text-purple-500
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
                                            text-[13px]
                                            font-semibold
                                            leading-5
                                            text-slate-700
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
                                            text-amber-600
                                        "
                                    >
                                        Assignment
                                    </span>

                                </span>

                            </button>

                        @endforeach


                        {{-- Empty module --}}

                        @if (
                            $module->episodes->isEmpty() &&
                            $module->quizzes->isEmpty() &&
                            $module->assignments->isEmpty()
                        )

                            <div class="border-t border-slate-100 px-5 py-4">

                                <p class="text-xs text-slate-400">
                                    Content coming soon.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

                @empty

                    <div class="border-b border-slate-100 px-5 py-5">

                        <p class="text-xs text-slate-400">
                            {{ $stage ? 'No modules have been added to this stage yet.' : 'No course content has been added yet.' }}
                        </p>

                    </div>

                @endforelse

            @endforeach

        </nav>

    </div>

</aside>
