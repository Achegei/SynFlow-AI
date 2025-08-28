{{--
    resources/views/classroom/index.blade.php

    This file displays a grid of course cards. Each card represents a course
    and contains an image, a title, a description, and a progress bar.
    Clicking a card will take the user to the course details page.

    This view assumes the following data is passed from a ClassroomController:
    - $courses: A collection of Course objects. Each object should have properties like
               `id`, `title`, `description`, `image_url`, and `progress_percentage`.
--}}

@extends('layouts.app')

@section('content')
    <!-- Main Container for the Classroom Page -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Classroom</h1>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Loop through each course passed from the controller --}}
            @foreach ($courses as $course)
                <!-- Course Card -->
                <a href="{{ route('classroom.course-details', $course->id) }}" class="block">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        {{-- Course Image --}}
                        <img src="{{ $course->image_url }}" alt="Course image for {{ $course->title }}" class="w-full h-48 object-cover rounded-t-2xl">
                        
                        <div class="p-6">
                            {{-- Course Title --}}
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $course->title }}</h2>
                            
                            {{-- Course Description --}}
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $course->description }}</p>

                            {{-- Progress Bar --}}
                            <div class="mt-4">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                    Progress: {{ number_format($course->progress_percentage) }}%
                                </span>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-1">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $course->progress_percentage }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
