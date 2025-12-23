@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

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
            ->where('created_at', '>=', now()->subMinutes(2))
            ->exists()
        : false;
    @endphp

    <!-- Back Button -->
    <a href="{{ route('classroom') }}" class="flex items-center text-blue-500 hover:underline mb-6">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Courses
    </a>

    <!-- Pending Payment -->
    @if (!$hasAccess && $pendingPayment)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
            ⏳ Your M-PESA payment is being processed. The course will unlock once confirmed.
        </div>
    @endif

    <!-- Locked Course CTA -->
    @if (!$hasAccess && !$pendingPayment)
        <div class="text-center bg-gray-100 p-6 rounded-xl shadow mb-6">
            <p class="text-lg text-gray-700 mb-4">You need to complete payment to access this course.</p>
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
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-6">
            <img src="{{ $course->image_url }}" class="w-full sm:w-48 h-auto rounded-xl object-cover">

            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
                <p class="mt-2 text-gray-600">{{ $course->description }}</p>

                <div class="mt-4">
                    <span class="text-sm font-medium text-gray-500">
                        Course Progress: {{ number_format($course->progress_percentage) }}%
                    </span>

                    {{-- Certificate button only for non-free courses --}}
                    @if (!$isFreeCourse && $course->progress_percentage == 100)
                        <button
                            @click="showCertificateModal = true"
                            class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700"
                        >
                            🎉 Download Your Certificate
                        </button>
                    @endif

                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $course->progress_percentage }}%;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Certificate Modal --}}
        @if (!$isFreeCourse && $course->progress_percentage == 100)
        <div
            x-show="showCertificateModal"
            x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        >
            <div class="bg-white rounded-xl p-6 max-w-md w-full">
                <h3 class="text-xl font-semibold mb-4">Enter Your Official Name</h3>

                <form action="{{ route('certificate.download', $course->id) }}" method="POST">
                    @csrf
                    <input type="text" name="full_name" required class="w-full border rounded px-3 py-2 mb-4" placeholder="e.g. John Doe">

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showCertificateModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Download</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </div>

    <!-- Video Player -->
    <div id="video-player" class="mt-8 hidden">
        <div id="youtube-player" class="w-full h-64 rounded-lg"></div>
    </div>

    <!-- Episodes -->
    <div class="mt-8 space-y-4">
        <h2 class="text-2xl font-semibold text-gray-900">Modules</h2>

        @foreach ($episodes as $episode)
            <div class="bg-gray-100 rounded-xl p-4 flex flex-col sm:flex-row items-center justify-between hover:bg-gray-200 transition">

                <div class="flex items-center space-x-4 cursor-pointer"
                     onclick="playEpisode('{{ $episode->youtube_id }}', {{ $episode->id }})">
                    <span class="text-lg font-semibold text-gray-700">{{ $loop->iteration }}.</span>
                    <span class="text-lg font-semibold text-gray-700">{{ $episode->title }}</span>
                </div>

                <form action="{{ route('episodes.toggle', $episode->id) }}" method="POST">
                    @csrf
                    <button class="px-3 py-1 rounded text-sm font-medium {{ $episode->is_completed ? 'bg-green-200 text-green-700' : 'bg-yellow-200 text-yellow-700' }}">
                        {{ $episode->is_completed ? 'Completed' : 'Mark as Watched' }}
                    </button>
                </form>

                @if ($episode->pdf_path)
                    <a href="{{ asset('storage/' . $episode->pdf_path) }}" target="_blank" class="text-blue-600 hover:underline font-medium">
                        📄 PDF Notes
                    </a>
                @endif

            </div>
        @endforeach
    </div>

    @endif
</div>

<script src="https://www.youtube.com/iframe_api"></script>
<script>
    let player;
    let currentEpisodeId = null;

    function playEpisode(videoId, episodeId) {
        currentEpisodeId = episodeId;
        document.getElementById('video-player').classList.remove('hidden');

        if (player) player.loadVideoById(videoId);
        else {
            player = new YT.Player('youtube-player', {
                height: '360',
                width: '100%',
                videoId: videoId,
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
        }
    }

    function onPlayerStateChange(event) {
        if (event.data === YT.PlayerState.ENDED && currentEpisodeId) {
            fetch(`/episodes/${currentEpisodeId}/watched`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') location.reload();
            });
        }
    }
</script>
@endsection
