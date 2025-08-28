@extends('layouts.public')

@section('title', 'About Us - SynFlow AI')

@section('content')
    <div class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block">SynFlow AI</span>
            <span class="block text-indigo-600">Your Partner in AI Transformation</span>
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 md:mt-5 md:text-xl">
            We are not just another AI company—we are your trusted partner in becoming an AI-first organization. By placing artificial intelligence at the core of everything we do, we provide a holistic approach to help your business thrive in the digital age.
        </p>
    </div>

    <!-- Our Holistic Approach Section -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                A Comprehensive Approach to AI
            </h2>
            <p class="mt-4 max-w-3xl mx-auto text-gray-500">
                At SynFlow AI, we believe that true AI transformation requires more than just a single solution. It requires a complete strategy that integrates technology, education, and development. That's why we've built our services around a proven, three-step journey.
            </p>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Step 1: Identify -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 2m0 0l-2-2m2 2V9m6 6h-2M9 9h2m2-2h-2m2 2h2m0 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Identify</h3>
                    <p class="mt-2 text-gray-500">
                        We begin by helping you pinpoint high-impact AI opportunities within your organization. We work with you to develop a strategic, step-by-step roadmap to bring these transformative ideas to life.
                    </p>
                </div>

                <!-- Step 2: Educate -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.433 9.356 5 8 5c-2.432 0-4.417 1.229-5.188 3.018A6.832 6.832 0 002 9c0 1.954.753 3.734 1.944 5L12 22 20.056 14C21.247 12.266 22 10.485 22 9c0-1.282-.572-2.417-1.47-3.267C19.583 5.229 17.568 5 15.188 5c-1.356 0-2.832.433-4.004 1.253z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Educate</h3>
                    <p class="mt-2 text-gray-500">
                        We empower your team with the knowledge and tools they need to embed AI across your entire organization. Our training and support ensure your people are equipped for the future of work.
                    </p>
                </div>

                <!-- Step 3: Develop -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Develop</h3>
                    <p class="mt-2 text-gray-500">
                        Leveraging our extensive experience and network, we build custom AI solutions that are designed to deliver tangible results and move the needle for your business.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Closing Statement -->
    <div class="container mx-auto px-4 py-16 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Ready to Become an AI-First Company?
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Let's start your transformation journey together. Whether you're just starting out or ready to build your next-generation AI system, SynFlow AI is here to guide you every step of the way.
            </p>
            <div class="mt-8">
                <a href="{{ route('contactus') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Contact Us Today
                </a>
            </div>
        </div>
    </div>
@endsection
