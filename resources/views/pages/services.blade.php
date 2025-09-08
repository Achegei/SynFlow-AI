@extends('layouts.public')

@section('title', 'Services - SynFlow AI')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-indigo-50 to-white py-20 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Our Services</span>
                <span class="block bg-gradient-to-r from-indigo-600 to-indigo-400 bg-clip-text text-transparent">
                    Driving Your AI-First Transformation
                </span>
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600 md:text-xl">
                At SynFlow AI, we offer a full suite of services designed to help your business navigate the complexities of AI,
                from initial strategy to custom development and team education.
            </p>
        </div>
    </div>

    <!-- Services Grid Section -->
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-3">

                <!-- Service 1: AI Strategy & Consulting -->
                <div class="group rounded-2xl p-[1px] bg-gradient-to-br from-indigo-700/40 to-indigo-400/40 hover:from-indigo-700 hover:to-indigo-500 transition">
                    <div class="h-full bg-white rounded-2xl shadow-lg p-8 transition duration-300 group-hover:-translate-y-2 group-hover:shadow-2xl">
                        <div class="mx-auto w-16 h-16 grid place-content-center rounded-2xl bg-indigo-700/10 text-indigo-700 ring-1 ring-indigo-700/20">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <!-- original icon path kept -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-2xl font-bold text-gray-900 text-center">AI Strategy & Consulting</h3>
                        <p class="mt-4 text-gray-500 text-center">
                            We help you identify the most impactful AI opportunities and develop a strategic roadmap to implement them successfully. Our consultants guide you from vision to execution, ensuring a clear path to value.
                        </p>
                        <ul class="mt-6 text-left text-gray-700 space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Opportunity Mapping</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Roadmap Development</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>ROI Analysis</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 2: AI Development & Integration -->
                <div class="group rounded-2xl p-[1px] bg-gradient-to-br from-indigo-700/40 to-indigo-400/40 hover:from-indigo-700 hover:to-indigo-500 transition">
                    <div class="h-full bg-white rounded-2xl shadow-lg p-8 transition duration-300 group-hover:-translate-y-2 group-hover:shadow-2xl">
                        <div class="mx-auto w-16 h-16 grid place-content-center rounded-2xl bg-indigo-700/10 text-indigo-700 ring-1 ring-indigo-700/20">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <!-- original icon path kept -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-2xl font-bold text-gray-900 text-center">AI Development & Integration</h3>
                        <p class="mt-4 text-gray-500 text-center">
                            Our expert team designs and builds bespoke AI systems, from autonomous agents to enterprise-level chatbots, tailored to your unique business needs to drive tangible results.
                        </p>
                        <ul class="mt-6 text-left text-gray-700 space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Custom Model Creation</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Autonomous Agents</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Chatbot & RAG Development</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 3: AI Education & Training -->
                <div class="group rounded-2xl p-[1px] bg-gradient-to-br from-indigo-700/40 to-indigo-400/40 hover:from-indigo-700 hover:to-indigo-500 transition">
                    <div class="h-full bg-white rounded-2xl shadow-lg p-8 transition duration-300 group-hover:-translate-y-2 group-hover:shadow-2xl">
                        <div class="mx-auto w-16 h-16 grid place-content-center rounded-2xl bg-indigo-700/10 text-indigo-700 ring-1 ring-indigo-700/20">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <!-- original icon path kept -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.433 9.356 5 8 5c-2.432 0-4.417 1.229-5.188 3.018A6.832 6.832 0 002 9c0 1.954.753 3.734 1.944 5L12 22 20.056 14C21.247 12.266 22 10.485 22 9c0-1.282-.572-2.417-1.47-3.267C19.583 5.229 17.568 5 15.188 5c-1.356 0-2.832.433-4.004 1.253z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-2xl font-bold text-gray-900 text-center">AI Education & Training</h3>
                        <p class="mt-4 text-gray-500 text-center">
                            We empower your team with the knowledge and skills they need to use AI effectively. Our customized workshops and training programs ensure your people are ready for an AI-first future.
                        </p>
                        <ul class="mt-6 text-left text-gray-700 space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Customized Workshops</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Team Training</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-indigo-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Tool & Technology Guidance</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="bg-gradient-to-r from-indigo-700 to-indigo-500 py-20 text-center text-white">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-3xl md:text-4xl font-extrabold">Ready to Get Started?</h2>
            <p class="mt-4 text-lg/8 opacity-90">
                Contact our team today to discuss your unique business needs and discover how SynFlow AI can help you achieve your goals.
            </p>
            <div class="mt-8">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-semibold bg-white text-indigo-700 hover:bg-gray-100 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                    Contact Us Today
                </a>
            </div>
        </div>
    </div>
@endsection
