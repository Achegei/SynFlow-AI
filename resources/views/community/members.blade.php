{{--
    resources/views/community/members.blade.php

    This file contains the front-end layout for the community members page.
    It now correctly extends a base layout and uses Laravel Blade syntax
    to dynamically display a list of all community members.

    This view assumes the following data is passed from a Laravel controller:
    - $members: A paginated list of all community members.
    - $onlineMembers: A collection of online user objects.
    - $adminsCount: The total count of admins.
    - $membersCount: The total count of all members.
    - NOTE: This version also assumes the member objects have new properties like
            `level`, `points`, `contributions`, `followers_count`, and `following_count`.
--}}

@extends('layouts.app')

@section('content')
    <!-- Main Container for the Members List -->
    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header Section -->
        <header class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-lg">
            <div class="flex items-center space-x-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Members <span class="text-blue-600 dark:text-blue-400">{{ number_format($membersCount) }}</span></span>
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Admins <span class="text-yellow-600 dark:text-yellow-400">{{ number_format($adminsCount) }}</span></span>
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Online <span class="text-green-600 dark:text-green-400">{{ number_format(count($onlineMembers)) }}</span></span>
            </div>
            <button class="mt-4 sm:mt-0 px-6 py-2 bg-blue-500 text-white font-bold rounded-full hover:bg-blue-600 transition duration-300">
                Invite
            </button>
        </header>

        <!-- Members List -->
        <div class="space-y-4">
            {{-- To efficiently check for online status, create a list of online member IDs --}}
            @php
                $onlineMemberIds = $onlineMembers->pluck('id')->toArray();
            @endphp
            
            {{-- Loop through each member passed from the controller's main query --}}
            @foreach ($members as $member)
                <!-- Member Card -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-lg">
                    <div class="flex-shrink-0">
                        {{-- Use the profile photo URL from the member object --}}
                        <img src="{{ $member->profile_photo_url }}" alt="{{ $member->name }} avatar" class="w-16 h-16 rounded-full object-cover border-2 border-indigo-500" />
                    </div>
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $member->name }}</h3>
                        {{-- Display a username if available --}}
                        @if ($member->username)
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ '@' . $member->username }}</p>
                        @endif
                        {{-- Display a bio if available --}}
                        @if ($member->bio)
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $member->bio }}</p>
                        @endif
                        
                        {{-- Display level and points --}}
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300 mt-2 space-x-2">
                            @if (isset($member->level))
                                <span class="font-bold">Level {{ $member->level }}</span>
                            @endif
                            @if (isset($member->points))
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $member->points }} points to level up</span>
                            @endif
                        </div>

                        {{-- Check if the member is currently online --}}
                        @if (in_array($member->id, $onlineMemberIds))
                            <div class="flex items-center text-sm text-green-600 dark:text-green-400 mt-2">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Online now
                            </div>
                        @endif
                        
                        {{-- Display joined date --}}
                        <p class="text-xs text-gray-500 mt-1">Joined {{ $member->created_at->format('M d, Y') }}</p>

                        {{-- Display contributions, followers, and following counts --}}
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-2 space-x-4">
                            @if (isset($member->contributions_count))
                                <div class="text-center">
                                    <span class="block font-semibold text-gray-800 dark:text-gray-100">{{ $member->contributions_count }}</span>
                                    <span class="block text-xs">Contributions</span>
                                </div>
                            @endif
                            @if (isset($member->followers_count))
                                <div class="text-center">
                                    <span class="block font-semibold text-gray-800 dark:text-gray-100">{{ $member->followers_count }}</span>
                                    <span class="block text-xs">Followers</span>
                                </div>
                            @endif
                            @if (isset($member->following_count))
                                <div class="text-center">
                                    <span class="block font-semibold text-gray-800 dark:text-gray-100">{{ $member->following_count }}</span>
                                    <span class="block text-xs">Following</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Only show the Chat button if the member is not the current authenticated user --}}
                    @if (auth()->check() && auth()->user()->id !== $member->id)
                        <button class="px-4 py-1.5 text-sm bg-gray-300 text-gray-700 rounded-full hover:bg-gray-400 transition duration-300">
                            Chat
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
