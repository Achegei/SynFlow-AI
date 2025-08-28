@extends('layouts.public')

@section('title', 'Services - SynFlow AI')

@section('content')
    <div class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block">Our Services</span>
            <span class="block text-indigo-600">Driving Your AI-First Transformation</span>
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 md:mt-5 md:text-xl">
            At SynFlow AI, we offer a full suite of services designed to help your business navigate the complexities of AI, from initial strategy to custom development and team education.
        </p>
    </div>

    <!-- Services Grid Section -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-3">
                <!-- Service 1: AI Strategy & Consulting -->
                <div class="bg-white rounded-lg shadow-lg p-8 transform transition duration-500 hover:scale-105">
                    <div class="flex-shrink-0">
                        <svg class="h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-2xl font-bold text-gray-900">AI Strategy & Consulting</h3>
                    <p class="mt-4 text-gray-500">
                        We help you identify the most impactful AI opportunities and develop a strategic roadmap to implement them successfully. Our consultants guide you from vision to execution, ensuring a clear path to value.
                    </p>
                    <ul class="mt-4 text-left text-gray-600 space-y-2">
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Opportunity Mapping</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Roadmap Development</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>ROI Analysis</span>
                        </li>
                    </ul>
                </div>

                <!-- Service 2: AI Development & Integration -->
                <div class="bg-white rounded-lg shadow-lg p-8 transform transition duration-500 hover:scale-105">
                    <div class="flex-shrink-0">
                        <svg class="h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-2xl font-bold text-gray-900">AI Development & Integration</h3>
                    <p class="mt-4 text-gray-500">
                        Our expert team designs and builds bespoke AI systems, from autonomous agents to enterprise-level chatbots, tailored to your unique business needs to drive tangible results.
                    </p>
                    <ul class="mt-4 text-left text-gray-600 space-y-2">
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Custom Model Creation</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Autonomous Agents</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Chatbot & RAG Development</span>
                        </li>
                    </ul>
                </div>

                <!-- Service 3: AI Education & Training -->
                <div class="bg-white rounded-lg shadow-lg p-8 transform transition duration-500 hover:scale-105">
                    <div class="flex-shrink-0">
                        <svg class="h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.433 9.356 5 8 5c-2.432 0-4.417 1.229-5.188 3.018A6.832 6.832 0 002 9c0 1.954.753 3.734 1.944 5L12 22 20.056 14C21.247 12.266 22 10.485 22 9c0-1.282-.572-2.417-1.47-3.267C19.583 5.229 17.568 5 15.188 5c-1.356 0-2.832.433-4.004 1.253z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-2xl font-bold text-gray-900">AI Education & Training</h3>
                    <p class="mt-4 text-gray-500">
                        We empower your team with the knowledge and skills they need to use AI effectively. Our customized workshops and training programs ensure your people are ready for an AI-first future.
                    </p>
                    <ul class="mt-4 text-left text-gray-600 space-y-2">
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Customized Workshops</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Team Training</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Tool & Technology Guidance</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="container mx-auto px-4 py-16 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Ready to Get Started?
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Contact our team today to discuss your unique business needs and discover how SynFlow AI can help you achieve your goals.
            </p>
            <div class="mt-8">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Contact Us Today
                </a>
            </div>
        </div>
    </div>
@endsection
