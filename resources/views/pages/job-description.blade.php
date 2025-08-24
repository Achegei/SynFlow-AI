@extends('layouts.public')

@section('title', $career['title'])

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg p-8 sm:p-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $career['title'] }}</h1>
        </div>

        <div class="prose max-w-none mb-8">
            <p>{{ $career['description'] }}</p>

            @if (!empty($career['responsibilities']))
                <h3 class="text-2xl font-bold mt-8 mb-4">What You'll Do</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach ($career['responsibilities'] as $responsibility)
                        <li>{{ $responsibility }}</li>
                    @endforeach
                </ul>
            @endif

            @if (!empty($career['requirements']))
                <h3 class="text-2xl font-bold mt-8 mb-4">Who We're Looking For</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach ($career['requirements'] as $requirement)
                        <li>{{ $requirement }}</li>
                    @endforeach
                </ul>
            @endif

            @if (!empty($career['desirable']))
                <h3 class="text-2xl font-bold mt-8 mb-4">Bonus Points</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach ($career['desirable'] as $desirable)
                        <li>{{ $desirable }}</li>
                    @endforeach
                </ul>
            @endif

            @if (!empty($career['we_offer']))
                <h3 class="text-2xl font-bold mt-8 mb-4">What We Offer</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach ($career['we_offer'] as $offer)
                        <li>{{ $offer }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <hr class="my-8 border-t border-gray-200">

        <!-- Apply Now Button -->
        <div class="flex justify-center">
            <a href="{{ route('careers.apply', ['position' => $career['slug']]) }}" class="w-full sm:w-auto py-3 px-8 rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors text-center font-medium">
                Apply Now
            </a>
        </div>
    </div>
</div>
@endsection
