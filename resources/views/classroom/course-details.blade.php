@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    @php
        $user = auth()->user();
        $hasAccess = $user && $user->courses->contains($course->id);
        $pendingPayment = $user 
            ? \App\Models\Payment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->where('status', 'pending')
                ->where('provider', 'intasend')
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

        <div class="bg-gray-50 p-6 rounded-lg shadow mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Sales Associate Training & AI Solutions Overview</h2>

        <p class="text-gray-800 mb-4">
            Welcome to the <span class="font-semibold">Moose Loon AI Solutions Sales Associate Team</span>.
        </p>

        <p class="text-gray-800 mb-2">
            As part of your onboarding, you will be introduced to nine (9) core AI business solutions through structured video lessons, each supported by a short course. These materials provide foundational and practical understanding of how Artificial Intelligence is applied to solve real-world business challenges.
        </p>

        <p class="text-gray-800 mb-2">
            <span class="font-semibold">Objective:</span> The training is not to make you an AI developer, but to ensure you clearly understand how AI delivers value to businesses, including:
        </p>
        <ul class="list-disc list-inside text-gray-800 mb-4 space-y-1">
            <li>How AI solves everyday operational and customer challenges</li>
            <li>How AI helps organizations increase revenue, reduce costs, and save time</li>
            <li>How AI automates repetitive tasks and operates 24/7 without breaks</li>
            <li>How Moose Loon AI positions and delivers these solutions to businesses in Kenya</li>
        </ul>

        <p class="text-gray-800 mb-2">
            Through this exposure, you will see multiple ways AI creates impact across industries such as sales, customer service, operations, administration, and data handling.
        </p>

        <hr class="my-4 border-gray-300">

        <h3 class="text-xl font-semibold text-gray-900 mb-2">Your Role as a Sales Associate</h3>
        <p class="text-gray-800 mb-2">
            Your primary responsibility is business introduction, discovery, and opportunity creation — not technical implementation.
        </p>
        <ul class="list-decimal list-inside text-gray-800 mb-4 space-y-1">
            <li>Introduce businesses to Moose Loon AI Solutions, a Canadian AI innovation company helping Kenyan businesses adopt practical AI solutions</li>
            <li>Engage business owners and decision-makers to listen, assess, and collect pain points</li>
            <li>Identify opportunities where AI can:
                <ul class="list-disc list-inside ml-5 space-y-1">
                    <li>Increase sales and revenue</li>
                    <li>Reduce operational costs</li>
                    <li>Eliminate repetitive manual work</li>
                    <li>Improve customer response time and efficiency</li>
                </ul>
            </li>
            <li>Accurately communicate collected business pain data to the Moose Loon AI Solutions team</li>
        </ul>

        <hr class="my-4 border-gray-300">

        <h3 class="text-xl font-semibold text-gray-900 mb-2">Solution Design, Handover & Next Steps</h3>
        <p class="text-gray-800 mb-2">
            Once business pain points are collected, Moose Loon AI Solutions takes full responsibility for:
        </p>
        <ul class="list-disc list-inside text-gray-800 mb-2 space-y-1">
            <li>Designing the appropriate AI solution</li>
            <li>Determining the technical approach</li>
            <li>Defining the implementation strategy</li>
            <li>Setting pricing and engagement models</li>
        </ul>
        <p class="text-gray-800 mb-2">
            Your role ends at discovery, introduction, and opportunity creation. Solution design, deployment, and pricing are handled entirely by the expert AI team.
        </p>
        <p class="text-gray-800 mb-2">
            After the company finalizes the proposed solution:
        </p>
        <ul class="list-disc list-inside text-gray-800 mb-2 space-y-1">
            <li>A complete AI solution package tailored to the business’s needs is prepared</li>
            <li>The package includes a clear implementation roadmap, outlining:
                <ul class="list-disc list-inside ml-5 space-y-1">
                    <li>The business problem addressed</li>
                    <li>The AI solution approach</li>
                    <li>Expected impact and outcomes</li>
                    <li>The recommended way forward</li>
                </ul>
            </li>
        </ul>
        <p class="text-gray-800 mb-2">
            Once approved internally, the solution brief is shared with you. Your responsibility then becomes to:
        </p>
        <ul class="list-disc list-inside text-gray-800 mb-2 space-y-1">
            <li>Schedule and facilitate a follow-up appointment with the business</li>
            <li>Present and explain the impact of the proposed solution in clear, non-technical language</li>
            <li>Guide discussions on next steps, timelines, and readiness for engagement</li>
            <li>Act as the primary relationship link between the business and Moose Loon AI Solutions</li>
        </ul>

        <hr class="my-4 border-gray-300">

        <h3 class="text-xl font-semibold text-gray-900 mb-2">Why This Matters</h3>
        <p class="text-gray-800 mb-2">
            You are the bridge between businesses and AI-powered transformation.
        </p>
        <p class="text-gray-800 mb-2">
            By understanding AI at a high level and mastering pain-point discovery, you become a critical driver of business growth, efficiency, and innovation across Kenya — without carrying technical burden.
        </p>
        <p class="text-gray-800 mb-2 font-semibold">
            You are not selling software. You are opening the path to AI-powered business transformation.
        </p>
        <p class="text-gray-800">
            Welcome to a role where AI works 24/7 — and you open the door for it to work for businesses.
        </p>
    </div>

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

                    @if ($course->progress_percentage == 100)
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

        <!-- Modal -->
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
