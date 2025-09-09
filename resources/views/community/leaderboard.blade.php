@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">Community Leaderboard</h1>
    
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <p class="text-gray-600">
            Last updated: {{ now()->format('M jS Y H:ia') }} | 
            Total Members: {{ $totalMembers }}
        </p>
    </div>

    {{-- Top Member --}}
    <div class="bg-blue-50 rounded-lg p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Top Member</h2>
        @if($topMember)
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="{{ $topMember->avatar ?? asset('images/default-avatar.png') }}" alt="Avatar" class="w-12 h-12 rounded-full">
                    <span class="font-medium text-gray-700">{{ $topMember->name }}</span>
                </div>
                <span class="text-gray-600">
                    Points to level up: {{ $topMember->pointsToNextLevel }} |
                    Ahead of {{ $topMember->percentAhead }}% of members
                </span>
            </div>
        @else
            <p class="text-gray-500">No top member yet.</p>
        @endif
    </div>

    {{-- Logged-in User --}}
    @if(auth()->check())
    <div class="bg-green-50 rounded-lg p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Your Stats</h2>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Avatar" class="w-12 h-12 rounded-full">
                <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
            </div>
            <span class="text-gray-600">
                Position: {{ $userRank ?? 'N/A' }} |
                Points: {{ auth()->user()->points }}
            </span>
        </div>
    </div>
    @endif

    {{-- Level Distribution --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Levels Distribution</h2>
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">Level</th>
                    <th class="border px-4 py-2 text-left">% of Members</th>
                </tr>
            </thead>
            <tbody>
                @foreach($levels as $level => $percent)
                    <tr>
                        <td class="border px-4 py-2">{{ $level }}</td>
                        <td class="border px-4 py-2">{{ $percent }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Leaderboards --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Leaderboards</h2>
        @foreach(['7-day', '30-day', 'all-time'] as $period)
            <div class="mb-4">
                <h3 class="font-medium mb-2">{{ ucfirst($period) }}</h3>
                @if(empty($leaderboards[$period]))
                    <p class="text-gray-500">No data available.</p>
                @else
                    <ul class="list-disc list-inside">
                        @foreach($leaderboards[$period] as $entry)
                            <li class="{{ auth()->id() === $entry->id ? 'bg-green-100 px-2 rounded' : '' }}">
                                <img src="{{ $entry->avatar ?? asset('images/default-avatar.png') }}" alt="Avatar" class="inline w-6 h-6 rounded-full mr-2">
                                {{ $entry->name }} - {{ $entry->points }} pts
                                @if(auth()->id() === $entry->id)
                                    <span class="text-sm text-green-700 font-semibold">(You)</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
