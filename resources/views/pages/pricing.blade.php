@extends('layouts.public')

@section('title', 'AI Development Partner Package - TrueHorizon')

@section('content')
    <div class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block">AI Development Partner Package</span>
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 md:mt-5 md:text-xl">
            At SynFlow AI, we act as your dedicated AI partner—focused on identifying and executing the highest ROI opportunities for automation within your business.
        </p>
        <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 md:mt-5 md:text-xl">
            Our mission is to help you and your team reclaim valuable hours each week by designing intelligent systems that eliminate repetitive tasks, streamline workflows, and scale with your operations. Over time, these time savings compound into massive gains in efficiency, productivity, and growth.
        </p>
    </div>

    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Choose Your Partnership
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
                    Launching your AI solution is just the beginning. At SynfloW, we offer comprehensive post-deployment support to ensure your systems continue to perform reliably as your business evolves.
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
                Every SynFlow development partnership includes access to:
            </p>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-600 rounded-lg mb-3 md:mb-4 flex items-center justify-center">
            <img src="public/assets/ai_ml.png" alt="AI/ML Engineers" class="w-8 h-8 md:w-10 md:h-10 object-contain">
        </div>
        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">AI/ML Engineers</h3>
    </div>
    
    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-600 rounded-lg mb-3 md:mb-4 flex items-center justify-center">
            <img src="public/assets/business_consultant.png" alt="Business Process Consultants" class="w-8 h-8 md:w-10 md:h-10 object-contain">
        </div>
        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Business Process Consultants</h3>
    </div>

    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-600 rounded-lg mb-3 md:mb-4 flex items-center justify-center">
            <img src="public/assets/data_scientist.png" alt="Data Scientists" class="w-8 h-8 md:w-10 md:h-10 object-contain">
        </div>
        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Data Scientists</h3>
    </div>

    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-600 rounded-lg mb-3 md:mb-4 flex items-center justify-center">
            <img src="public/assets/solution_architect.png" alt="Solution Architects" class="w-8 h-8 md:w-10 md:h-10 object-contain">
        </div>
        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Solution Architects</h3>
    </div>
    
    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-600 rounded-lg mb-3 md:mb-4 flex items-center justify-center">
            <img src="public/assets/project_manager.png" alt="Project Managers" class="w-8 h-8 md:w-10 md:h-10 object-contain">
        </div>
        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">Project Managers</h3>
    </div>
    
    <div class="border border-indigo-600 rounded-xl p-4 md:p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-600 rounded-lg mb-3 md:mb-4 flex items-center justify-center">
            <img src="public/assets/ui_ux_specialist.png" alt="UX/UI Specialists" class="w-8 h-8 md:w-10 md:h-10 object-contain">
        </div>
        <h3 class="text-lg md:text-xl font-bold text-gray-900 text-center">UX/UI Specialists</h3>
    </div>
</div>
        </div>
    </div>

    <div class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-start">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Flexible Resource Allocation
                </h2>
                <p class="mt-4 text-gray-500">
                    Allocate your monthly hours across:
                </p>
            </div>
            <div>
                <ul class="space-y-4 text-lg text-gray-700">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Custom AI system development</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Integration with existing systems and data sources</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Data pipeline engineering and optimization</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Business process optimization and automation</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Team training and knowledge transfer</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

    <div class="bg-light-600 py-16 text-indigo-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
            Transparent Process
        </h2>
        
        <div class="mt-8 overflow-x-auto whitespace-nowrap scrollbar-hide">
            <ul class="inline-flex space-x-6 lg:space-x-12 px-2">
                <li class="inline-block p-4 bg-indigo-50 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <p class="text-lg font-medium">Clear documentation of all work completed</p>
                </li>
                <li class="inline-block p-4 bg-indigo-50 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <p class="text-lg font-medium">Regular progress updates and demonstrations</p>
                </li>
                <li class="inline-block p-4 bg-indigo-50 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <p class="text-lg font-medium">Collaborative planning sessions</p>
                </li>
                <li class="inline-block p-4 bg-indigo-50 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <p class="text-lg font-medium">Detailed time tracking and reporting</p>
                </li>
            </ul>
        </div>
        
    </div>
</div>
    <div class="py-16 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Unlock hidden potential within your business
            </h2>
            <p class="mt-4 max-w-3xl mx-auto text-lg text-gray-500">
                Unlock untapped potential with safe, responsible, and powerful AI solutions.
            </p>
            <div class="mt-8">
                <a href="{{ route('contactus') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Get Started
                </a>
            </div>
        </div>
    </div>
@endsection