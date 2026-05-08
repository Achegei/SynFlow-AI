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
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">

            <div class="flex flex-col lg:flex-row gap-6">

                <img src="{{ $course->image_url }}"
                     class="w-full lg:w-72 h-52 object-cover rounded-xl">

                <div class="flex-1">

                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $course->title }}
                    </h1>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        {{ $course->description }}
                    </p>

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
    <div class="mt-10">

        <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Course Modules
        </h2>

        @forelse ($course->modules as $module)

            <div class="bg-white rounded-2xl shadow-md p-6 mb-8">

                <!-- Module Header -->
                <div class="mb-6">

                    <div class="flex items-center justify-between">

                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $module->title }}
                        </h3>

                        <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">
                            {{ $module->episodes->count() }} Lessons
                        </span>

                    </div>

                    @if($module->description)

                        <p class="text-gray-600 mt-2">
                            {{ $module->description }}
                        </p>

                    @endif

                </div>

                <!-- Episodes -->
                <div class="space-y-4">

                    @forelse ($module->episodes as $episode)

                        <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 hover:bg-gray-100 transition">

                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                                <!-- Left -->
                                <div
                                    class="flex items-start space-x-4 cursor-pointer flex-1"
                                    onclick="playEpisode('{{ $episode->youtube_id }}', {{ $episode->id }})"
                                >

                                    <div class="bg-blue-600 text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>

                                        <h4 class="text-lg font-semibold text-gray-800">
                                            {{ $episode->title }}
                                        </h4>

                                        @if($episode->description)

                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ $episode->description }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                                <!-- Right -->
                                <div class="flex items-center gap-3">

                                    <!-- PDF -->
                                    @if ($episode->pdf_path)

                                        <a
                                            href="{{ asset('storage/' . $episode->pdf_path) }}"
                                            target="_blank"
                                            class="text-blue-600 hover:underline font-medium"
                                        >
                                            📄 Notes
                                        </a>

                                    @endif

                                    <!-- Completion -->
                                    <form action="{{ route('episodes.toggle', $episode->id) }}" method="POST">

                                        @csrf

                                        <button
                                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                            {{ $episode->is_completed
                                                ? 'bg-green-200 text-green-700 hover:bg-green-300'
                                                : 'bg-yellow-200 text-yellow-700 hover:bg-yellow-300'
                                            }}"
                                        >

                                            {{ $episode->is_completed ? 'Completed' : 'Mark as Watched' }}

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded-xl">
                            No lessons added to this module yet.
                        </div>

                    @endforelse

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

    function playEpisode(videoId, episodeId)
    {
        currentEpisodeId = episodeId;

        document
            .getElementById('video-player')
            .classList
            .remove('hidden');

        window.scrollTo({
            top: document.getElementById('video-player').offsetTop - 100,
            behavior: 'smooth'
        });

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

                events: {
                    'onStateChange': onPlayerStateChange
                }

            });
        }
    }

    function onPlayerStateChange(event)
    {
        if (
            event.data === YT.PlayerState.ENDED
            && currentEpisodeId
        )
        {
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
        }
    }

</script>

@endsection