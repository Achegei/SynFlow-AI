{{-- resources/views/classroom/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">
        Moose Loon AI Academy — AI Courses
    </h1>

    <!-- Courses Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($courses as $course)
            @php
                $user = auth()->user();
                $hasAccess = $user && $user->courses->contains($course->id);
            @endphp

            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                {{-- Course Image --}}
                <img 
                    src="{{ $course->image_url }}" 
                    alt="Course image for {{ $course->title }}" 
                    class="w-full h-48 object-cover rounded-t-2xl {{ !$hasAccess ? 'opacity-60' : '' }}"
                >

                <div class="p-6">
                    {{-- Course Title --}}
                    <h2 class="text-xl font-semibold text-gray-800">{{ $course->title }}</h2>

                    {{-- Course Description --}}
                    <p class="mt-2 text-sm text-gray-600">{{ $course->description }}</p>

                    {{-- Progress Bar --}}
                    @if ($hasAccess)
                        <div class="mt-4">
                            <span class="text-xs font-medium text-gray-500">
                                Progress: {{ number_format($course->progress_percentage) }}%
                            </span>
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                <div 
                                    class="bg-blue-500 h-2 rounded-full"
                                    style="width: {{ $course->progress_percentage }}%;"
                                ></div>
                            </div>
                        </div>
                    @endif

                    {{-- Access Button --}}
                    <div class="mt-4">
                        @if ($hasAccess)
                            <a href="{{ route('classroom.show', $course->id) }}"
                               class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Continue Course
                            </a>
                        @else
                            {{-- Buy Button: Redirect to /purchase/{course} --}}
                            <form action="{{ route('purchase.course', $course->id) }}" method="GET">
                                <button type="submit"
                                        class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200"
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="w-4 h-4 inline-block mr-1 text-gray-600" 
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 11c0-1.105.895-2 2-2h.5A1.5 1.5 0 0116 10.5V11m-4 0v2m0 0a2 2 0 11-4 0v-2a2 2 0 114 0z" />
                                    </svg>
                                    Buy Course to Unlock
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
