@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    @php
    $user = auth()->user()?->load('courses');

    $isFreeCourse = (int) $course->id === 1;

    $hasAccess = $isFreeCourse
        ? true
        : ($user && $user->courses->contains($course->id));

    $pendingPayment = (!$isFreeCourse && $user)
        ? \App\Models\Payment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'pending')
            ->where('provider', 'intasend')
            ->where('created_at', '>=', now()->subMinutes(1))
            ->exists()
        : false;
    @endphp

    <!-- Back Button -->
    <a href="{{ route('classroom') }}"
       class="flex items-center text-blue-600 hover:underline mb-6">

        <svg class="w-4 h-4 mr-1"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 19l-7-7 7-7">
            </path>
        </svg>

        Back to Courses
    </a>

    <!-- Pending Payment -->
    @if (!$hasAccess && $pendingPayment)

        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg">
            ⏳ Your M-PESA payment is being processed. The course will unlock once confirmed.
        </div>

    @endif

    <!-- Locked Course -->
    @if (!$hasAccess && !$pendingPayment)

        <div class="text-center bg-gray-100 p-6 rounded-2xl shadow mb-6">

            <p class="text-lg text-gray-700 mb-4">
                You need to complete payment to access this course.
            </p>

            <form action="{{ route('purchase.course', $course->id) }}" method="POST">
                @csrf

                <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Pay with M-PESA to Unlock
                </button>
            </form>

        </div>

    @endif

    @if ($hasAccess)

    <div x-data="{ showCertificateModal: false }">

        <!-- Course Header -->
        <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-md mb-6 overflow-hidden">

            <div class="flex flex-col lg:flex-row gap-6">

                <img src="{{ $course->image_url }}"
                     class="w-full lg:w-72 h-52 object-cover rounded-xl">

                <div class="flex-1">

                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $course->title }}
                    </h1>

                    <div x-data="{ expanded: false }" class="mt-3">

    <p class="text-gray-600 leading-relaxed">
        <span x-show="!expanded">
            {{ \Illuminate\Support\Str::limit($course->description, 180) }}
        </span>

        <span x-show="expanded">
            {{ $course->description }}
        </span>
    </p>

    <button
        @click="expanded = !expanded"
        class="text-blue-600 text-sm mt-2 font-medium hover:underline"
    >
        <span x-text="expanded ? 'View less' : 'View more'"></span>
    </button>

</div>

                    <!-- Progress -->
                    <div class="mt-6">

                        <div class="flex items-center justify-between mb-2">

                            <span class="text-sm font-medium text-gray-600">
                                Course Progress
                            </span>

                            <span class="text-sm font-bold text-blue-600">
                                {{ number_format($course->progress_percentage) }}%
                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full"
                                 style="width: {{ $course->progress_percentage }}%">
                            </div>
                        </div>

                    </div>

                    <!-- Certificate -->
                    @if (!$isFreeCourse && $course->progress_percentage == 100)

                        <button
                            @click="showCertificateModal = true"
                            class="mt-6 bg-green-600 text-white px-5 py-3 rounded-lg shadow hover:bg-green-700"
                        >
                            🎉 Download Your Certificate
                        </button>

                    @endif

                </div>

            </div>

        </div>

        <!-- Certificate Modal -->
        @if (!$isFreeCourse && $course->progress_percentage == 100)

        <div
            x-show="showCertificateModal"
            x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        >

            <div class="bg-white rounded-2xl p-6 max-w-md w-full">

                <h3 class="text-xl font-semibold mb-4">
                    Enter Your Official Name
                </h3>

                <form action="{{ route('certificate.download', $course->id) }}" method="POST">

                    @csrf

                    <input
                        type="text"
                        name="full_name"
                        required
                        class="w-full border rounded-lg px-4 py-3 mb-4"
                        placeholder="e.g. John Doe"
                    >

                    <div class="flex justify-end space-x-2">

                        <button
                            type="button"
                            @click="showCertificateModal = false"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                        >
                            Download
                        </button>

                    </div>

                </form>

            </div>

        </div>

        @endif

    </div>

    <!-- Video Player -->
    <div id="video-player" class="mt-8 hidden">

        <div class="bg-white rounded-2xl shadow-lg p-4">

            <div id="youtube-player" class="w-full h-[450px] rounded-xl overflow-hidden"></div>

        </div>

    </div>

    <!-- Modules -->
<!-- MODULES -->
<div class="mt-10">

    <h2 class="text-4xl font-bold text-gray-900 mb-8">
        Course Modules
    </h2>

    @forelse ($course->modules as $module)

    <div
        x-data="{ open: {{ $loop->first ? 'true' : 'false' }}, tab: 'lessons' }"
        class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-8"
    >

        <!-- MODULE HEADER -->
        <div
            @click="open = !open"
            class="p-8 cursor-pointer hover:bg-gray-50 transition"
        >

            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

                <!-- LEFT -->
                <div class="flex-1">

                    <div class="flex items-center gap-4 mb-4">

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl font-bold">
                            {{ $loop->iteration }}
                        </div>

                        <div>

                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $module->title }}
                            </h3>

                            <div class="flex flex-wrap gap-3 mt-3">

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $module->episodes->count() }} Lessons
                                </span>

                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $module->quizzes->count() }} Quizzes
                                </span>

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $module->assignments->count() }} Assignments
                                </span>

                            </div>

                        </div>

                    </div>

                    @if($module->description)

                    <div x-data="{ expanded: false }">

                        <p class="text-gray-600 leading-relaxed">

                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit($module->description, 220) }}
                            </span>

                            <span x-show="expanded">
                                {{ $module->description }}
                            </span>

                        </p>

                        <button
                            @click.stop="expanded = !expanded"
                            class="text-blue-600 text-sm mt-2 font-medium hover:underline"
                        >
                            <span x-text="expanded ? 'View less' : 'View more'"></span>
                        </button>

                    </div>

                    @endif

                </div>

                <!-- RIGHT -->
                <div class="shrink-0">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-400 transition"
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

        </div>

        <!-- MODULE CONTENT -->
        <div
            x-show="open"
            x-transition
            class="border-t border-gray-100"
        >

            <!-- TABS -->
            <div class="px-8 pt-6">

                <div class="flex gap-6 border-b overflow-x-auto">

                    <button
                        @click="tab='lessons'"
                        class="pb-4 text-sm font-semibold whitespace-nowrap"
                        :class="tab==='lessons'
                            ? 'text-blue-600 border-b-2 border-blue-600'
                            : 'text-gray-500'"
                    >
                        📺 Lessons
                    </button>

                    <button
                        @click="tab='quizzes'"
                        class="pb-4 text-sm font-semibold whitespace-nowrap"
                        :class="tab==='quizzes'
                            ? 'text-purple-600 border-b-2 border-purple-600'
                            : 'text-gray-500'"
                    >
                        🧠 Quizzes
                    </button>

                    <button
                        @click="tab='assignments'"
                        class="pb-4 text-sm font-semibold whitespace-nowrap"
                        :class="tab==='assignments'
                            ? 'text-green-600 border-b-2 border-green-600'
                            : 'text-gray-500'"
                    >
                        📝 Assignments
                    </button>

                </div>

            </div>

            <!-- LESSONS -->
            <div
                x-show="tab==='lessons'"
                class="p-8 space-y-5"
            >

                @forelse ($module->episodes as $episode)

                <div
                    onclick="playEpisode('{{ \Illuminate\Support\Str::contains($episode->video_url, 'youtube')
                        ? \Illuminate\Support\Str::after($episode->video_url, 'v=')
                        : $episode->video_url }}', {{ $episode->id }})"
                    class="border rounded-2xl p-5 hover:border-blue-300 hover:shadow-md transition cursor-pointer group"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex gap-4">

                            <!-- ICON -->
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0 group-hover:bg-blue-600 transition">

                                <svg
                                    class="w-6 h-6 text-blue-600 group-hover:text-white"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path d="M6 4l10 6-10 6V4z"></path>
                                </svg>

                            </div>

                            <!-- INFO -->
                            <div>

                                <h4 class="font-bold text-gray-900 text-lg group-hover:text-blue-600 transition">
                                    {{ $episode->title }}
                                </h4>

                                @if($episode->description)

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $episode->description }}
                                </p>

                                @endif

                                <div class="flex flex-wrap gap-2 mt-3">

                                    <span class="text-xs bg-gray-100 px-3 py-1 rounded-full">
                                        📺 Video Lesson
                                    </span>

                                    @if($episode->pdf_path)

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

                        <!-- STATUS -->
                        <div class="shrink-0">

                            @if(auth()->user()->watchedEpisodes->contains($episode->id))

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


              <!-- QUIZZES -->
<div x-show="tab==='quizzes'" class="space-y-6">

    @forelse ($module->quizzes as $quiz)

        @php
            $attempt = auth()->user()
                ? auth()->user()
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

            <!-- Header -->
            <div class="flex items-center justify-between mb-4">

                <div>
                    <h4 class="text-xl font-bold text-purple-800">
                        🧠 {{ $quiz->title }}
                    </h4>

                    @if($quiz->description)
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $quiz->description }}
                        </p>
                    @endif
                </div>

                @if($attempt)

                    <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                        ✅ Completed
                    </div>

                @endif

            </div>

            <!-- Questions -->
            <div class="space-y-6">

                @foreach($quiz->questions as $question)

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
                        @foreach($options as $key => $option)

                        @php
                            $key = strtoupper(trim($key));
                        @endphp

                        <button
                            @click="checkAnswer(
                                {{ $question->id }},
                                '{{ $key }}',
                                '{{  $question->correct_answer }}'
                            )"
                            :disabled="answers[{{ $question->id }}]"
                            class="w-full text-left px-4 py-3 rounded-xl border transition"
                            :class="getButtonClass(
                                {{ $question->id }},
                                '{{ $key }}',
                                '{{  $question->correct_answer }}'
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

                        <!-- Feedback -->
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

            <!-- Submit -->
            <div class="mt-6">

                <button
                    @click="submitQuiz"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold"
                >
                    Submit Quiz
                </button>

            </div>

            <!-- Result -->
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
                    <span x-text="passed ? 'Quiz Completed ✅' : 'Please Retry Incorrect Answers'"></span>
                </p>

            </div>

        </div>

    @empty

        <p class="text-gray-500">
            No quizzes yet.
        </p>

    @endforelse

</div>

                <!-- ASSIGNMENTS -->
              <!-- ASSIGNMENTS -->
<div x-show="tab==='assignments'" class="space-y-6 p-8">

    @forelse ($module->assignments as $assignment)

        <div class="bg-white border border-green-100 rounded-2xl p-6 shadow-sm">

            <div class="flex items-start gap-4">

                <!-- ICON -->
                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center shrink-0">

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

                <!-- CONTENT -->
                <div class="flex-1">

                    <div class="flex items-center justify-between gap-4 flex-wrap">

                        <h4 class="text-xl font-bold text-gray-900">
                            📝 {{ $assignment->title }}
                        </h4>

                        <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            Assignment
                        </span>

                    </div>

                    @if($assignment->instructions)

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

</div>

<!-- YouTube API -->
<script src="https://www.youtube.com/iframe_api"></script>

<script>

    let player;
let currentEpisodeId = null;
let youtubeReady = false;

function onYouTubeIframeAPIReady()
{
    youtubeReady = true;
}

function playEpisode(videoId, episodeId)
{
    currentEpisodeId = episodeId;
    markedCompleted = false;

    const playerContainer = document.getElementById('video-player');

   playerContainer.classList.remove('hidden');

window.scrollTo({
    top: playerContainer.offsetTop - 100,
    behavior: 'smooth'
});

    // Wait until YouTube API is fully loaded
    if (!youtubeReady)
    {
        setTimeout(() => {
            playEpisode(videoId, episodeId);
        }, 500);

        return;
    }

    if (player)
    {
        player.loadVideoById(videoId);
    }
    else
    {
        player = new YT.Player('youtube-player', {

            height: '450',
            width: '100%',
            videoId: videoId,

            playerVars: {
                autoplay: 1
            },

            events: {
                'onStateChange': onPlayerStateChange
            }

        });
    }
}

  let progressChecker = null;
let markedCompleted = false;

function onPlayerStateChange(event)
{
    if (event.data === YT.PlayerState.PLAYING)
    {
        progressChecker = setInterval(() => {

            if (!player || markedCompleted) return;

            const currentTime = player.getCurrentTime();
            const duration = player.getDuration();

            if (!duration) return;

            const watchedPercent = (currentTime / duration) * 100;

            // Auto complete at 80%
            if (watchedPercent >= 80)
            {
                markedCompleted = true;

                fetch(`/episodes/${currentEpisodeId}/watched`, {

                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }

                })
                .then(res => res.json())
                .then(data => {

                    if (data.status === 'success')
                    {
                        location.reload();
                    }

                });

                clearInterval(progressChecker);
            }

        }, 5000);
    }

    if (
        event.data === YT.PlayerState.PAUSED
        || event.data === YT.PlayerState.ENDED
    )
    {
        clearInterval(progressChecker);
    }
}

    function quizComponent(quizId)
{
    return {

        answers: {},
        feedback: {},
        score: 0,
        passed: false,
        resultVisible: false,

        checkAnswer(questionId, selected, correct)
        {
            if (selected === correct)
            {
                this.answers[questionId] = selected;
                this.feedback[questionId] = 'correct';
            }
            else
            {
                this.feedback[questionId] = 'wrong';
            }
        },

        getButtonClass(questionId, option, correct)
        {
            if (!this.feedback[questionId]) {
                return 'border-gray-200 hover:border-purple-400 hover:bg-purple-50';
            }

            if (
                this.feedback[questionId] === 'correct'
                && option === correct
            ) {
                return 'bg-blue-600 text-white border-blue-600';
            }

            if (
                this.feedback[questionId] === 'wrong'
                && option === correct
            ) {
                return 'bg-green-100 border-green-400 text-green-700';
            }

            return 'border-gray-200';
        },

        async submitQuiz()
{
    try {

        const response = await fetch(`/quizzes/${quizId}/submit`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                answers: this.answers || {}
            })
        });

        if (!response.ok) {
            const errorText = await response.text();
            console.error('Server Error:', errorText);
            alert('Server error. Check console.');
            return;
        }

        const data = await response.json();

        this.score = data.score;
        this.passed = data.passed;
        this.resultVisible = true;

        if (data.passed) {
            setTimeout(() => location.reload(), 1500);
        }

    } catch (err) {
        console.error('Fetch Error:', err);
        alert('Quiz submission failed');
    }
}
    }
}

</script>

@endsection