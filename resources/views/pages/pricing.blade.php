@extends('layouts.public')

@section('title', 'AI Development Partner Package - MooseLoon')

@section('content')

<!-- HERO -->
<div class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">
        <span class="text-indigo-600 block">Your Strategic AI Development Partner</span>
    </h1>

    <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-gray-700">
        MooseLoon AI is your <span class="font-semibold text-indigo-600">dedicated AI partner</span>.
        We help businesses unlock measurable impact with AI — cutting costs, streamlining workflows,
        and preparing for global competition.
    </p>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-4xl mx-auto text-left">
        @foreach([
            ['Reclaim hours:', 'Free up your team by automating repetitive work and eliminating bottlenecks.'],
            ['Scale easily:', 'AI that adapts as you grow — smarter systems for scaling seamlessly.'],
            ['Maximize efficiency:', 'Turn efficiency into measurable gains — higher productivity, lower costs.']
        ] as $benefit)
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>
            <p>
                <span class="font-semibold text-gray-900">{{ $benefit[0] }}</span>
                {{ $benefit[1] }}
            </p>
        </div>
        @endforeach
    </div>
</div>


<!-- PRICING -->
<div class="bg-gradient-to-b from-white to-gray-50 py-24">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900">Flexible Plans for Every Business</h2>
        <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">
            Start small or scale big — our AI-powered chatbot plans grow with your needs.
        </p>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-10">

            <x-pricing-card
                title="Starter"
                price="$49"
                color="indigo"
                description="Perfect for small businesses testing AI automation."
                button="Get Started"
                :features="['500 messages per month','Basic chatbot training','Email support','Easy setup in minutes']"
            />

            <x-pricing-card
                popular="true"
                title="Growth"
                price="$99"
                color="indigo"
                description="Best for growing brands who want deeper insights."
                button="Choose Plan"
                :features="['2,000 messages per month','Advanced analytics dashboard','Priority support','Multiple chatbot profiles']"
            />

            <x-pricing-card
                title="Pro"
                price="$199"
                color="indigo"
                type="outline"
                description="Unlimited power for teams ready to scale AI automation."
                button="Contact Sales"
                :features="['Unlimited messages','RAG integration','Dedicated AI assistant setup','Full analytics & API access']"
            />

            <x-pricing-card
                title="Enterprise"
                price="Custom"
                color="indigo"
                description="Tailored AI solutions for large teams and special integrations."
                button="Let’s Talk"
                :features="['Unlimited messages + custom features','Private deployment','Dedicated technical manager','On-site/cloud integration','Team training included']"
            />

        </div>
    </div>
</div>


<!-- POST DEPLOYMENT SECTION -->
<div class="py-20">
    <div class="container mx-auto px-4 md:flex md:space-x-10 md:items-center">

        <div class="md:w-1/2 md:text-left">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                Post-Deployment Solution Management
            </h2>

            <p class="mt-4 text-gray-600 leading-relaxed">
                Launching your AI solution is just the beginning. We offer comprehensive post-deployment
                support to ensure your systems continue to perform reliably as your business evolves.
            </p>

            <p class="mt-4 text-gray-600 leading-relaxed">
                From ongoing monitoring to performance optimization and workflow adjustments,
                we keep your systems running at peak efficiency.
            </p>
        </div>

        <div class="mt-10 md:mt-0 md:w-1/2 flex justify-center">
            <img src="{{ asset('images/post_deployment_management.png') }}"
                 class="rounded-xl shadow-lg w-full max-w-lg" alt="Post Deployment">
        </div>

    </div>
</div>


<!-- OUR TEAM -->
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
            What Sets Our Development Partnership Apart
        </h2>
        <p class="mt-3 max-w-3xl mx-auto text-gray-600">
            Every MooseLoon development partnership includes access to:
        </p>

        <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach([
                ['AI/ML Engineers','ai_ml.png'],
                ['Business Process Consultants','business_consultant.png'],
                ['Data Scientists','data_scientist.png'],
                ['Solution Architects','solution_architect.png'],
                ['Project Managers','project_manager.png'],
                ['UX/UI Specialists','ui_ux_specialist.png'],
            ] as $item)
            <div class="border border-indigo-600 rounded-xl p-6 flex flex-col items-center hover:-translate-y-1 transition-transform bg-white">
                <img src="{{ asset('images/'.$item[1]) }}" class="w-16 h-16 mb-4" alt="">
                <h3 class="text-lg font-semibold">{{ $item[0] }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- RESOURCE ALLOCATION -->
<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 text-center">

        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">Flexible Resource Allocation</h2>
        <p class="mt-3 max-w-xl mx-auto text-gray-600">
            Allocate your monthly hours across multiple AI and business initiatives:
        </p>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach([
                'Custom AI system development',
                'Integrations with existing systems and data sources',
                'Data pipeline engineering and optimization',
                'Business process automation & optimization',
                'Team training and knowledge transfer'
            ] as $task)
            <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg flex items-start space-x-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4"/>
                </svg>
                <p class="text-gray-700 font-medium">{{ $task }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- PROCESS -->
<div class="bg-indigo-50 py-20 text-indigo-600">
    <div class="container mx-auto px-4 text-center">

        <h2 class="text-3xl sm:text-4xl font-extrabold">Transparent Process</h2>
        <p class="mt-4 text-gray-700 max-w-2xl mx-auto">
            Our process keeps you informed, involved, and confident every step of the way.
        </p>

        <div class="mt-14 flex flex-col md:flex-row justify-center items-center md:space-x-6 space-y-8 md:space-y-0">

            @foreach([
                'Clear documentation of all work completed',
                'Weekly progress updates',
                'Monthly strategy review call'
            ] as $i => $step)
            <div class="bg-white rounded-lg shadow-md p-6 w-64 flex flex-col items-center">
                <div class="w-12 h-12 bg-indigo-600 text-white font-bold rounded-full flex items-center justify-center mb-4">
                    {{ $i+1 }}
                </div>
                <p class="text-gray-800 font-medium">{{ $step }}</p>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
