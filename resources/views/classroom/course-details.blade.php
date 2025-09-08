@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- Back Button -->
    <a href="{{ route('classroom') }}" class="flex items-center text-blue-500 hover:underline mb-6">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Back to Courses
    </a>

    <!-- Course Header -->
    <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
        <img src="{{ $course->image_url }}" alt="Course image for {{ $course->title }}" class="w-full sm:w-48 h-auto rounded-xl object-cover">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
            <p class="mt-2 text-gray-600">{{ $course->description }}</p>
            <div class="mt-4">
                <span class="text-sm font-medium text-gray-500">
                    Course Progress: {{ number_format($course->progress_percentage) }}%
                </span>
                <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $course->progress_percentage }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Player -->
    <div id="video-player" class="mt-8 hidden">
        <div id="youtube-player" class="w-full h-64 rounded-lg"></div>
    </div>

    <!-- Episodes List -->
    <div class="mt-8 space-y-4">
        <h2 class="text-2xl font-semibold text-gray-900">Episodes</h2>
        @foreach ($episodes as $episode)
            <div class="bg-gray-100 rounded-xl p-4 flex items-center justify-between hover:bg-gray-200 transition">
                <div class="flex items-center space-x-4 cursor-pointer"
                    onclick="playEpisode('{{ $episode->youtube_id }}', {{ $episode->id }})">
                    <span class="text-lg font-semibold text-gray-700">{{ $loop->iteration }}.</span>
                    <span class="text-lg font-semibold text-gray-700">{{ $episode->title }}</span>
                </div>

                <!-- Manual Toggle -->
                <form action="{{ route('episodes.toggle', $episode->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1 rounded text-sm font-medium
                        {{ $episode->is_completed ? 'bg-green-200 text-green-700' : 'bg-yellow-200 text-yellow-700' }}">
                        {{ $episode->is_completed ? 'Completed' : 'Mark as Watched' }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>

<!-- YouTube API -->
<script src="https://www.youtube.com/iframe_api"></script>
<script>
    let player;
    let currentEpisodeId = null;

    function playEpisode(videoId, episodeId) {
        currentEpisodeId = episodeId;
        document.getElementById('video-player').classList.remove('hidden');
        document.getElementById('video-player').scrollIntoView({ behavior: 'smooth' });

        if (player) {
            player.loadVideoById(videoId);
        } else {
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
            // 🔥 Mark as watched automatically
            fetch(`/episodes/${currentEpisodeId}/watched`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log('Episode marked as watched!');
                    location.reload();
                }
            });
        }
    }
</script>
@endsection
