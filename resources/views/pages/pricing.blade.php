@extends('layouts.public')

@section('title', 'AI Development Partner Package - MooseLoon')

@section('content')
   <div class="container mx-auto px-4 py-12 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-5xl">
                <span class="block text-indigo-600">Your Strategic AI Development Partner</span>
            </h1>

            <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-700 md:text-xl">
                MooseLoon AI is your <span class="font-semibold text-indigo-600">dedicated AI partner</span>, We help Canadian businesses unlock measurable impact with AI — cutting costs, streamlining workflows, and preparing for global competition..
            </p>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-4xl mx-auto text-left">
                <div class="flex items-start space-x-3">
                    <svg class="h-6 w-6 text-indigo-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p><span class="font-semibold text-gray-900">Reclaim hours:</span> Free up your team by automating repetitive work and eliminating bottlenecks.</p>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="h-6 w-6 text-indigo-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p><span class="font-semibold text-gray-900">Scale easily:</span> AI that adapts as you grow — smarter systems for scaling seamlessly.</p>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="h-6 w-6 text-indigo-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p><span class="font-semibold text-gray-900">Maximize efficiency:</span> Turn efficiency into measurable gains — higher productivity, lower costs.</p>
                </div>
            </div>
    </div>


    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Flexible Partnerships for Every Growth Stage
            </h2>
            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2">
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <span class="text-xs font-semibold text-white bg-indigo-600 px-2.5 py-0.5 rounded-full">POPULAR</span>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Business Partner</h3>
                    <p class="mt-2 text-4xl font-extrabold text-indigo-600">$10,000/month</p>
                    <ul class="mt-4 text-left space-y-2 text-gray-600">
                        <li>Dedicated AI Engineer</li>
                        <li>VIP support queue</li>
                        <li>Documentation and user guides</li>
                        <li>Live debugging and solution management</li>
                        <li>Client portal</li>
                    </ul>
                    <a href="{{ route('contactus') }}" class="mt-8 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Get Started
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Enterprise Partner</h3>
                    <p class="mt-2 text-4xl font-extrabold text-indigo-600">Custom</p>
                    <p class="mt-4 text-gray-500">Includes all Business Partner features, plus:</p>
                    <ul class="mt-4 text-left space-y-2 text-gray-600">
                        <li>Dedicated Project Manager</li>
                        <li>Weekly 60 minute meetings with our executive team</li>
                        <li>Strategic roadmap review</li>
                        <li>Team training and enablement sessions</li>
                        <li>Documentation of all completed work</li>
                        <li>Quarterly executive briefing</li>
                        <li>Everything customized for you and your business</li>
                    </ul>
                    <a href="{{ route('contactus') }}" class="mt-8 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </div>

   <div class="py-16">
    <div class="container mx-auto px-4"> {{-- Removed text-center from container --}}
        <div class="md:flex md:items-center md:space-x-8"> {{-- Flex container for text and image --}}
            <div class="md:w-1/2 md:text-left"> {{-- Text content on the left --}}
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Post-Deployment Solution Management
                </h2>
                <p class="mt-4 text-gray-500 max-w-full md:max-w-none"> {{-- Removed mx-auto for left alignment --}}
                    Launching your AI solution is just the beginning. At MooseLoon, we offer comprehensive post-deployment support to ensure your systems continue to perform reliably as your business evolves.
                </p>
                <p class="mt-2 text-gray-500 max-w-full md:max-w-none"> {{-- Removed mx-auto for left alignment --}}
                    From ongoing system monitoring and performance optimization to adapting workflows as new challenges arise, our team stays engaged to keep your AI solutions running at peak efficiency.
                </p>
            </div>
            <div class="mt-8 md:mt-0 md:w-1/2 flex justify-center"> {{-- Image on the right --}}
                <img src="{{ asset('images/post_deployment_management.png') }}" alt="Post-Deployment Solution Management" class="max-w-full h-auto rounded-lg shadow-lg">
            </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 py-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    What Sets Our Development Partnership Apart
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-gray-500">
                    Every MooseLoon development partnership includes access to:
                </p>
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                    
                    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
                        <div class="w-30 h-30 bg-none rounded-lg mb-4 flex items-center justify-center">
                            <img src="{{ asset('images/ai_ml.png') }}" alt="AI/ML Engineers" class="w-30 h-30 object-contain">
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">AI/ML Engineers</h3>
                    </div>
                    
                    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
                        <div class="w-30 h-30 bg-none rounded-lg mb-4 flex items-center justify-center">
                            <img src="{{ asset('images/business_consultant.png') }}" alt="Business Process Consultants" class="w-30 h-30 object-contain">
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Business Process Consultants</h3>
                    </div>
                    
                    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
                        <div class="w-30 h-30 bg-none rounded-lg mb-4 flex items-center justify-center">
                            <img src="{{ asset('images/data_scientist.png') }}" alt="Data Scientists" class="w-30 h-30 object-contain">
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Data Scientists</h3>
                    </div>
                    
                    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
                        <div class="w-30 h-30 bg-none rounded-lg mb-4 flex items-center justify-center">
                            <img src="{{ asset('images/solution_architect.png') }}" alt="Solution Architects" class="w-30 h-30 object-contain">
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Solution Architects</h3>
                    </div>
                    
                    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
                        <div class="w-30 h-30 bg-none rounded-lg mb-4 flex items-center justify-center">
                            <img src="{{ asset('images/project_manager.png') }}" alt="Project Managers" class="w-30 h-30 object-contain">
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Project Managers</h3>
                    </div>
                    
                    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
                        <div class="w-30 h-30 bg-none rounded-lg mb-4 flex items-center justify-center">
                            <img src="{{ asset('images/ui_ux_specialist.png') }}" alt="UX/UI Specialists" class="w-30 h-30 object-contain">
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">UX/UI Specialists</h3>
                    </div>
                </div>
            </div>
    </div>


    <div class="py-16 bg-gray-50">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Flexible Resource Allocation
                </h2>
                <p class="mt-4 text-gray-500 max-w-2xl mx-auto">
                    Allocate your monthly hours across multiple AI and business initiatives:
                </p>

                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-start space-x-4 p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-700 font-medium">Custom AI system development</p>
                    </div>

                    <div class="flex items-start space-x-4 p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-700 font-medium">Integration with existing systems and data sources</p>
                    </div>

                    <div class="flex items-start space-x-4 p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-700 font-medium">Data pipeline engineering and optimization</p>
                    </div>

                    <div class="flex items-start space-x-4 p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-700 font-medium">Business process optimization and automation</p>
                    </div>

                    <div class="flex items-start space-x-4 p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-700 font-medium">Team training and knowledge transfer</p>
                    </div>
                </div>
            </div>
        </div>


    <div class="bg-indigo-50 py-16 text-indigo-600">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                    Transparent Process
                </h2>
                <p class="mt-4 text-gray-700 max-w-2xl mx-auto">
                    Our process is designed to keep you informed, involved, and confident every step of the way.
                </p>

                <!-- Workflow -->
                <div class="mt-12 flex flex-col md:flex-row items-center justify-center space-y-6 md:space-y-0 md:space-x-6">
                    
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center bg-white rounded-lg shadow-md p-6 w-64">
                        <div class="bg-indigo-600 text-white font-bold rounded-full w-12 h-12 flex items-center justify-center mb-4">1</div>
                        <p class="text-lg font-medium">Clear documentation of all work completed</p>
                    </div>
                    
                    <!-- Arrow -->
                    <div class="hidden md:flex items-center">
                        <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="flex flex-col items-center bg-white rounded-lg shadow-md p-6 w-64">
                        <div class="bg-indigo-600 text-white font-bold rounded-full w-12 h-12 flex items-center justify-center mb-4">2</div>
                        <p class="text-lg font-medium">Regular progress updates and demonstrations</p>
                    </div>
                    
                    <!-- Arrow -->
                    <div class="hidden md:flex items-center">
                        <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="flex flex-col items-center bg-white rounded-lg shadow-md p-6 w-64">
                        <div class="bg-indigo-600 text-white font-bold rounded-full w-12 h-12 flex items-center justify-center mb-4">3</div>
                        <p class="text-lg font-medium">Collaborative planning sessions</p>
                    </div>
                    
                    <!-- Arrow -->
                    <div class="hidden md:flex items-center">
                        <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    
                    <!-- Step 4 -->
                    <div class="flex flex-col items-center bg-white rounded-lg shadow-md p-6 w-64">
                        <div class="bg-indigo-600 text-white font-bold rounded-full w-12 h-12 flex items-center justify-center mb-4">4</div>
                        <p class="text-lg font-medium">Detailed time tracking and reporting</p>
                    </div>

                </div>
            </div>
        </div>

    <div class="py-16 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Unlock Hidden Value with AI
            </h2>
            <p class="mt-4 max-w-3xl mx-auto text-lg text-gray-500">
                Harness AI responsibly to cut costs, improve resilience, and future-proof your business.
            </p>
            <div class="mt-8">
                <a href="{{ route('contactus') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Get Started
                </a>
            </div>
        </div>
    </div>
@endsection