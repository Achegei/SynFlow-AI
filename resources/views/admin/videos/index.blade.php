@extends('layouts.app')

@section('content')

<div class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
{{-- Video List Section --}}
<div class="container mx-auto px-4 py-8">
<div class="flex justify-between items-center mb-6">
<h1 class="text-3xl font-bold text-gray-800">Video List</h1>
{{-- Check if the user is an admin before showing the 'Add New Video' button --}}
@if(auth()->check() && auth()->user()->is_admin)
<a href="{{ route('admin.videos.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">Add New Video</a>
@endif
</div>

    {{-- Session Message --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($videos as $video)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $video->order }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $video->title }}</div>
                            <div class="text-xs text-gray-500">{{ Str::limit($video->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($video->is_published)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Yes</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- Check if the user is an admin before showing the 'Edit' and 'Delete' buttons --}}
                            @if(auth()->check() && auth()->user()->is_admin)
                            <a href="{{ route('admin.videos.edit', $video->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this video?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                            @else
                                <span class="text-gray-400">No actions</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No videos found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Sales Copy Section --}}
<div class="max-w-4xl mx-auto text-center mb-12">
    <div class="bg-white p-8 rounded-lg shadow-xl border border-gray-200">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
            Interested in starting an AI business?
        </h1>
        <p class="text-lg sm:text-xl text-gray-600 mb-8">
            If so, you're in the right place.
        </p>

        <div class="text-left text-gray-700 space-y-6">
            <p>I'm <strong class="text-blue-600 font-semibold">Laban Ekitela</strong>, the #1 AI business expert on YouTube (600,000+ subscribers) and creator of the AI Automation Agency model.</p>

            <p>2 years ago, I started with zero generative AI knowledge. Now I've built multiple AI businesses generating <strong class="text-green-600 font-semibold">$7M+ in revenue</strong> with a team of 65+ people.</p>

            <p>Just like every business needed a website in the 90s, today they need AI to stay competitive. I've created this community to teach you how to capitalize on this opportunity - even with zero coding experience.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Join now to get:</h2>
            <ul class="list-disc list-inside space-y-3 pl-4">
                <li><strong class="font-medium text-gray-900">📚 Complete AI Automation Agency Course:</strong> 8 modules, 57 videos, 60+ hours of content</li>
                <li><strong class="font-medium text-gray-900">🎯 Weekly Live Q&As with Me:</strong> Get your AI business questions answered directly</li>
                <li><strong class="font-medium text-gray-900">💼 50+ Templates & Resources:</strong> Proven contracts, proposals, and guides to close deals</li>
                <li><strong class="font-medium text-gray-900">🤝 Elite Network:</strong> Access 100,000+ AI professionals, developers, and potential partners</li>
            </ul>

            <p class="text-center font-semibold text-lg sm:text-xl text-gray-800 mt-10">
                Ready to start?
            </p>

            <div class="text-center">
                <button class="w-full sm:w-auto px-10 py-4 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition-colors duration-200 shadow-lg transform hover:scale-105">
                    Click "Join"
                </button>
                <p class="text-xs text-gray-500 mt-2">and you'll be let in within 1-2 minutes.</p>
            </div>

            <p class="text-center text-gray-600 mt-8">See you inside.</p>
        </div>
    </div>
</div>

</div>
@endsection
