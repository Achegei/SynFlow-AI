{{--
    resources/views/community/dashboard.blade.php

    This file contains the front-end layout for the community dashboard,
    now correctly extending a base layout and using Laravel Blade syntax
    for dynamic content.

    This file assumes the existence of 'resources/views/layouts/app.blade.php'.

    This view assumes the following data is passed from a Laravel controller:
    - $posts: An array of post objects.
    - $recentPosts: An array of recent post objects for the sidebar.
    - $onlineMembers: An array of strings with member names.
    - $adminsCount: An integer.
    - $leaderboard: An array of user objects with a 'score' property.
    - $membersCount: The total count of members.
    - $postsCount: The total count of posts.
    - $qnaEventText: A string for the Q&A banner.
    - $allCategories: An array of category strings.
--}}

@extends('layouts.app')

@section('content')
    <style>
        /* Hide scrollbar for the category bar, but allow scrolling */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
        /* Add a subtle animation for posts */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .post-card {
            animation: fadeIn 0.5s ease-out forwards;
        }
        /* A slight hover effect on leaderboard list items */
        .leaderboard-list li:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        /* Custom scrollbar styling for leaderboard sections */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1f2937; /* */
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #4b5563; /* */
            border-radius: 4px;
            border: 2px solid #1f2937;
        }
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #4b5563 #1f2937;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 2rem;
        }
        @media (min-width: 768px) {
            .card-container {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-2/3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div id="welcome-banner" class="mb-8 bg-indigo-50 text-indigo-700 p-6 rounded-lg shadow-inner flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4">
                            <div class="text-left flex-1">
                                <div class="font-bold text-lg">Welcome! Start here</div>
                                <p class="text-sm mt-1">
                                    Find a post you like and leave a comment, or start your own discussion.
                                </p>
                            </div>
                            <div class="flex flex-wrap items-center justify-center md:justify-end gap-3">
                                <button class="inline-flex items-center px-4 py-2 bg-indigo-200 hover:bg-indigo-300 text-sm font-medium rounded-full transition-colors">
                                    <a href="{{route('auth-about')}}">Watch 60 sec intro video</a>
                                </button>
                            </div>
                        </div>

                        <div class="mb-8 bg-indigo-600 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                {{-- Use dynamic variable with a fallback --}}
                                <span id="qna-banner-text" class="font-semibold">
                                    {{ $qnaEventText ?? 'Q&A is happening soon' }}
                                </span>

                            </div>
                            <button class="bg-white text-indigo-600 px-4 py-2 rounded-full font-semibold text-sm hover:bg-gray-100 transition-colors">
                                <a href="{{route('calendar')}}">Join Now</a>
                            </button>
                        </div>

                        <div class="mb-8 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <button
                                    id="open-dialog-btn"
                                    class="flex items-center space-x-2 px-4 py-2 rounded-full bg-indigo-600 text-white font-semibold shadow-md hover:bg-indigo-700 transition-colors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M17 2.121a3 3 0 0 1 5.364 1.415L17.5 12.5 12 13l.4-5.365 4.5-8.484z"/></svg>
                                    <span>New Post</span>
                                </button>
                            </div>
                        </div>

                        <div class="flex overflow-x-auto hide-scrollbar pb-2 mb-8">
                            <div id="category-filter" class="flex space-x-3 whitespace-nowrap">
                                {{-- Use a Blade loop to dynamically generate category buttons from the controller --}}
                                @foreach($allCategories as $category)
                                    <button class="bg-gray-200 text-gray-800 rounded-full px-4 py-2 text-sm font-medium hover:bg-gray-300 transition-colors">
                                        {{ $category }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                         
                        <div id="posts-container" class="space-y-6">
                            {{-- Use a Blade loop to dynamically generate posts --}}
                            @foreach($posts as $post)
                                <div class="post-card bg-white rounded-xl shadow p-6 space-y-4">
                                    <div class="flex items-start space-x-4">
                                        <img src="{{ $post->author->profile_photo_url }}" alt="{{ $post->author->name }} avatar" class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500" />
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h3 class="font-bold text-gray-900">{{ $post->author->name }}</h3>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $post->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2 py-1 rounded-full">
                                                    {{ $post->category->name }}
                                                </div>
                                            </div>
                                            <h4 class="mt-2 font-semibold text-gray-900">{{ $post->title }}</h4>
                                            <p class="mt-1 text-gray-700 leading-relaxed">{{ $post->content }}</p>
                                            <div class="flex items-center space-x-4 mt-4 text-gray-500">
                                                <div class="flex items-center space-x-1 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M7 10v12c0 .6.4 1 1 1h3v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3V3a6 6 0 0 0-6-6v3"/></svg>
                                                    <span>{{ $post->likes->count() }}</span>
                                                </div>
                                                <div class="flex items-center space-x-1 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                                    <span>{{ $post->comments->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-8">
                            <button id="load-more-btn" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-colors">
                                {{$posts->links()}}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3 space-y-8">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Recent Posts</h3>
                        <div id="recent-posts-container" class="space-y-4">
                            {{-- Use a Blade loop to dynamically generate recent posts --}}
                            @foreach($recentPosts as $recentPost)
                                <div class="flex items-start space-x-3">
                                    <img src="{{ $recentPost->author->profile_photo_url }}" alt="{{ $recentPost->author->name }}" class="w-8 h-8 rounded-full">
                                    <div class="flex-1">
                                        <p class="text-xs font-semibold text-gray-900">{{ $recentPost->author->name }}</p>
                                        <p class="text-sm text-gray-700 line-clamp-2">{{ $recentPost->content }}</p>
                                        <span class="text-xs text-gray-500">
                                            {{ $recentPost->created_at->diffForHumans() }} in <span class="text-indigo-600">{{ $recentPost->category->name }}</span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Community Stats --}}
                    <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
                        <h4 class="text-md font-bold flex items-center space-x-2 text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-indigo-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span>Community Stats</span>
                        </h4>
                        <div class="grid grid-cols-2 gap-4 text-sm font-medium text-gray-900">
                            <div class="bg-gray-100 p-3 rounded-lg text-center">
                                <p class="text-2xl font-bold">{{ $membersCount }}</p>
                                <p class="text-gray-500">Members</p>
                            </div>
                            <div class="bg-gray-100 p-3 rounded-lg text-center">
                                <p class="text-2xl font-bold">{{ $postsCount }}</p>
                                <p class="text-gray-500">Posts</p>
                            </div>
                            <div class="bg-gray-100 p-3 rounded-lg text-center flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-green-500"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                <p class="text-lg font-bold">{{ count($onlineMembers) }}</p>
                                <p class="text-gray-500">Online</p>
                            </div>
                            <div class="bg-gray-100 p-3 rounded-lg text-center flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-yellow-500"><path d="m14 19-3 3v-2.18l-5.69-5.69a1 1 0 0 1 0-1.42l5.69-5.69a1 1 0 0 1 1.42 0L19 12l3 3h-2.18l-5.69 5.69a1 1 0 0 1-1.42 0L14 19Z"/><circle cx="12" cy="12" r="2"/></svg>
                                <p class="text-lg font-bold">{{ $adminsCount }}</p>
                                <p class="text-gray-500">Admins</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <h5 class="text-sm font-semibold mb-2 text-gray-900">Online Now</h5>
                            <ul class="space-y-1 text-sm text-gray-700">
                                @foreach ($onlineMembers as $member)
                                    <li class="flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-green-500 rounded-full block"></span>
                                        <span>{{ $member }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Leaderboard --}}
                    <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
                        <h4 class="text-md font-bold flex items-center space-x-2 text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-yellow-500"><path d="M12 8V4l-6 8h4L8 20l6-8H10z"/><path d="M18 10h4l-3-6H15zM21 16h-4l3 6h4z"/></svg>
                            <span>Leaderboard</span>
                        </h4>
                        <ul class="space-y-3">
                            @foreach ($leaderboard as $key => $user)
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <span class="font-bold text-lg text-gray-500 w-6 text-center">{{ $key + 1 }}</span>
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }} avatar" class="w-8 h-8 rounded-full object-cover" />
                                        <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span>
                                    </div>
                                    <span class="text-sm text-gray-600 font-semibold">{{ $user->score }} pts</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="post-dialog" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900 bg-opacity-75 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl transform scale-95 md:scale-100 transition-transform duration-300">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">Create a New Post</h2>
                <button id="close-dialog-btn" class="p-1 rounded-full hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
            <form id="post-form" class="p-6 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        {{-- Use dynamic avatar for the current user --}}
                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            alt="{{ auth()->user()->name }}"
                            class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500"
                        />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">
                            {{ auth()->user()->name }} posting in <span class="font-semibold text-indigo-600">SynFlow AI</span>
                        </p>
                        <p class="text-xs text-gray-500">Public post</p>
                    </div>
                </div>
                <div>
                    <input
                        type="text"
                        id="post-title"
                        placeholder="Post title"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        required
                    />
                </div>
                <div>
                    <textarea
                        id="post-content"
                        placeholder="Write something..."
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none transition-colors"
                        required
                    ></textarea>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition-colors" title="Add Image">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                        </button>
                        <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition-colors" title="Add Link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07L12 6M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07L12 18"/></svg>
                        </button>
                        <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition-colors" title="Add Video">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><path d="m22 8-6 4 6 4V8Z"/><path d="M14 12c0 1.2-1.35 2-3 2H5c-1.7 0-3-1.2-3-2V8c0-1.2 1.35-2 3-2h6c1.7 0 3 .8 3 2v4Z"/></svg>
                        </button>
                        <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition-colors" title="Add Emoji">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>
                        </button>
                    </div>
                    <div class="relative flex-grow">
                        <select
                            id="post-category"
                            class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors pr-8 text-sm"
                            required
                        >
                            <option value="" disabled selected>Select a category</option>
                            {{-- Use a Blade loop to dynamically generate categories from the controller --}}
                            @foreach($allCategories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-500"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <button
                        type="button"
                        id="cancel-post-btn"
                        class="px-6 py-2 rounded-full text-gray-700 bg-gray-200 hover:bg-gray-300 transition-colors"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        id="submit-post-btn"
                        class="px-6 py-2 rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition-colors disabled:opacity-50"
                    >
                        Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
