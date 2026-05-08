@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50">

    <!-- Top Gradient -->
    <div class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-blue-100 text-sm mb-6">

                <a href="{{ route('classroom') }}" class="hover:text-white transition">
                    Classroom
                </a>

                <span>/</span>

                <span class="text-white font-medium">
                    Quiz
                </span>

            </div>

            <!-- Header -->
            <div class="max-w-3xl">

                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-full text-sm font-medium mb-5">

                    🧠 Interactive Quiz

                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">

                    {{ $quiz->title }}

                </h1>

                @if($quiz->description)

                    <p class="mt-5 text-lg text-blue-100 leading-relaxed">

                        {{ $quiz->description }}

                    </p>

                @endif

                <!-- Stats -->
                <div class="flex flex-wrap items-center gap-6 mt-8 text-white/90 text-sm">

                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                        {{ $quiz->questions->count() }} Questions
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-yellow-300"></span>
                        Instant Feedback
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-pink-300"></span>
                        Auto Progress Tracking
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Quiz Container -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 pb-16">

        <div class="bg-white rounded-[28px] shadow-2xl shadow-gray-200/60 border border-gray-100 overflow-hidden">

            <!-- Result Alert -->
            @if(session('success'))

                <div class="
                    px-6 py-5 border-b
                    {{ session('passed')
                        ? 'bg-green-50 border-green-100'
                        : 'bg-yellow-50 border-yellow-100'
                    }}
                ">

                    <div class="flex items-center justify-between flex-wrap gap-4">

                        <div>

                            <h3 class="font-bold text-lg
                                {{ session('passed') ? 'text-green-700' : 'text-yellow-700' }}
                            ">

                                {{ session('passed') ? '🎉 Quiz Passed' : '⚠️ Try Again' }}

                            </h3>

                            <p class="text-sm mt-1
                                {{ session('passed') ? 'text-green-600' : 'text-yellow-700' }}
                            ">

                                You scored
                                {{ session('score') }}/{{ session('total') }}

                            </p>

                        </div>

                        <div class="text-3xl font-black
                            {{ session('passed') ? 'text-green-600' : 'text-yellow-600' }}
                        ">

                            {{ round((session('score') / session('total')) * 100) }}%

                        </div>

                    </div>

                </div>

            @endif

            <!-- Form -->
            <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">

                @csrf

                <div class="p-6 md:p-10 space-y-8">

                    @foreach($quiz->questions as $question)

                        <div
                            x-data="{
                                selected: '',
                                correct: '{{ $question->correct_answer }}'
                            }"
                            class="group border border-gray-200 rounded-3xl p-6 md:p-8 hover:border-blue-300 hover:shadow-lg transition duration-300"
                        >

                            <!-- Question Header -->
                            <div class="flex items-start gap-4 mb-8">

                                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg shrink-0">

                                    {{ $loop->iteration }}

                                </div>

                                <div>

                                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 leading-relaxed">

                                        {{ $question->question }}

                                    </h2>

                                </div>

                            </div>

                            <!-- Options -->
                            <div class="space-y-4">

                                @foreach($question->options as $key => $option)

                                    <label
                                        class="relative flex items-center justify-between border-2 rounded-2xl px-5 py-5 cursor-pointer transition-all duration-200 hover:border-blue-400 hover:bg-blue-50/40"
                                        :class="{
                                            'border-blue-500 bg-blue-50': selected === '{{ $key }}' && selected === correct,
                                            'border-red-500 bg-red-50': selected === '{{ $key }}' && selected !== correct,
                                            'border-gray-200': selected !== '{{ $key }}'
                                        }"
                                    >

                                        <div class="flex items-center gap-4">

                                            <!-- Custom Radio -->
                                            <div
                                                class="w-7 h-7 rounded-full border-2 flex items-center justify-center transition"
                                                :class="{
                                                    'border-blue-600': selected === '{{ $key }}' && selected === correct,
                                                    'border-red-600': selected === '{{ $key }}' && selected !== correct,
                                                    'border-gray-300': selected !== '{{ $key }}'
                                                }"
                                            >

                                                <div
                                                    x-show="selected === '{{ $key }}'"
                                                    class="w-3 h-3 rounded-full"
                                                    :class="{
                                                        'bg-blue-600': selected === correct,
                                                        'bg-red-600': selected !== correct
                                                    }"
                                                ></div>

                                            </div>

                                            <input
                                                type="radio"
                                                name="answers[{{ $question->id }}]"
                                                value="{{ $key }}"
                                                @click="selected = '{{ $key }}'"
                                                class="hidden"
                                            >

                                            <div>

                                                <div class="font-bold uppercase text-gray-900">

                                                    {{ $key }}

                                                </div>

                                                <div class="text-gray-700 mt-1">

                                                    {{ $option }}

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Status -->
                                        <template x-if="selected === '{{ $key }}'">

                                            <div>

                                                <template x-if="selected === correct">

                                                    <div class="flex items-center gap-2 text-blue-600 font-semibold">

                                                        <span>✓</span>
                                                        <span>Correct</span>

                                                    </div>

                                                </template>

                                                <template x-if="selected !== correct">

                                                    <div class="flex items-center gap-2 text-red-600 font-semibold">

                                                        <span>✗</span>
                                                        <span>Wrong</span>

                                                    </div>

                                                </template>

                                            </div>

                                        </template>

                                    </label>

                                @endforeach

                            </div>

                            <!-- Correct Answer -->
                            <div
                                x-show="selected && selected !== correct"
                                x-transition
                                class="mt-5 bg-red-50 border border-red-100 rounded-2xl px-5 py-4"
                            >

                                <div class="text-sm text-red-700">

                                    Correct answer:

                                    <span class="font-bold uppercase ml-1">
                                        <span x-text="correct"></span>
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                <!-- Sticky Footer -->
                <div class="sticky bottom-0 bg-white/95 backdrop-blur-md border-t border-gray-100 px-6 md:px-10 py-5">

                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                        <div class="text-sm text-gray-500">

                            Answer all questions before submitting.

                        </div>

                        <button
                            type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-2xl transition-all duration-200 shadow-lg shadow-blue-500/20 hover:scale-[1.02]"
                        >

                            <span>Submit Quiz</span>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13 7l5 5m0 0l-5 5m5-5H6" />

                            </svg>

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection