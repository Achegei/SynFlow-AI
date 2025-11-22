@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">
        Moose Loon AI Solutions
    </h1>

        @php
        $user = auth()->user()?->fresh('courses'); // reload user courses
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($courses as $course)
        @php
            $hasAccess = $user && $user->courses->contains($course->id);
        @endphp

        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                 class="w-full h-48 object-cover rounded-t-2xl {{ !$hasAccess ? 'opacity-60' : '' }}">

            <div class="p-6">
                <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                <p class="mt-2 text-sm text-gray-600">{{ $course->description }}</p>

                @if ($hasAccess)
                    <a href="{{ route('classroom.show', $course->id) }}"
                       class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mt-4">
                        Continue Course
                    </a>
                @else
                    <form action="{{ route('purchase.course', $course->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                                class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Buy Course to Unlock
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection
