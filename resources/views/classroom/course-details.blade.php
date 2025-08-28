{{--
    resources/views/classroom/course-details.blade.php

    This file displays the details for a specific course, including a list of episodes.
    Each episode is a clickable link. It also shows the overall progress for the course.

    This view assumes the following data is passed from a ClassroomController:
    - $course: A single Course object with properties like `title`, `description`, `image_url`, and `progress_percentage`.
    - $episodes: A collection of Episode objects related to the course. Each object
                should have properties like `id`, `title`, `video_url`, and `is_completed`.
--}}

@extends('layouts.app')

@section('content')
    <!-- Main Container for the Course Details Page -->
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <a href="{{ route('classroom.index') }}" class="flex items-center text-blue-500 hover:underline mb-6">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Courses
        </a>

        <!-- Course Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
            <img src="{{ $course->image_url }}" alt="Course image for {{ $course->title }}" class="w-full sm:w-48 h-auto rounded-xl object-cover">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $course->title }}</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $course->description }}</p>
                <div class="mt-4">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Course Progress: {{ number_format($course->progress_percentage) }}%
                    </span>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-1">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $course->progress_percentage }}%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Episodes List -->
        <div class="mt-8 space-y-4">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Episodes</h2>
            @foreach ($episodes as $episode)
                <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-4 flex items-center justify-between">
                    <a href="{{ $episode->video_url }}" class="flex-grow flex items-center space-x-4">
                        <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ $loop->iteration }}.</span>
                        <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ $episode->title }}</span>
                    </a>
                    @if ($episode->is_completed)
                        <span class="text-sm font-medium text-green-600 dark:text-green-400">Completed</span>
                    @else
                        <span class="text-sm font-medium text-yellow-600 dark:text-yellow-400">Not Watched</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
