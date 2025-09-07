@extends('layouts.public')

@section('title', 'Our Process - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')
<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500 flex items-center justify-center gap-2">
                <img src="{{ asset('images/laban.jpeg') }}" alt="Laban Ekitela" 
                     class="w-9 h-9 rounded-full object-cover shadow-sm">
                <span class="flex items-center space-x-2">
                    <span>Laban Ekitela</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>Co-Founder</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>May 18th, 2025</span>
                </span>
            </p>
        <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">Our Process</h1>
    </header>

    <div class="mt-12 text-center max-w-3xl mx-auto">
        <p class="text-lg text-gray-600">
            At SynFlow AI, we're not just a service provider—we're your long-term partner in AI transformation. Our deeply collaborative approach ensures that every system we develop is tailored to your business vision, designed to scale with your growth, and built to deliver a measurable impact across your organization. We aim to move beyond simple use cases to find where AI can create true, lasting value.
        </p>
        <div class="mt-8 rounded-lg overflow-hidden shadow-lg">
            <!-- Optional content or image can go here -->
        </div>
    </div>


    <hr class="my-12 border-gray-300">

    <!-- Discovery Phase Section -->
    <section class="text-center max-w-3xl mx-auto mt-12">
        <h2 class="text-3xl font-bold text-gray-900">Discovery & Strategy</h2>
        <p class="mt-4 text-lg text-gray-600">
            We start by immersing ourselves in your world to understand your team, workflows, and goals. This deep dive helps us identify where AI can have the most immediate and profound impact on your business. During this phase, we focus on:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600 text-left mx-auto">
            <li><span class="font-semibold text-gray-800">Organizational Understanding:</span> We learn your business model, internal processes, and key decision-making workflows.</li>
            <li><span class="font-semibold text-gray-800">Strategic Roadmapping:</span> We help you chart a high-impact AI roadmap that balances quick wins with long-term goals.</li>
            <li><span class="font-semibold text-gray-800">Security & Compliance:</span> We assess data handling requirements, access controls, and infrastructure needs to ensure a secure foundation.</li>
        </ul>
    </section>


    <hr class="my-12 border-gray-300">

    <!-- Rapid Development Section -->
    <section class="text-center max-w-3xl mx-auto mt-12">
        <h2 class="text-3xl font-bold text-gray-900">Rapid Iteration & Continuous Delivery</h2>
        <p class="mt-4 text-lg text-gray-600">
            We believe the true power of AI lies in its ability to evolve. Our development process is centered on agility and modularity, with systems co-created in fast, feedback-driven cycles.
        </p>

        <div class="text-left mt-8 space-y-6">
            <h3 class="text-xl font-semibold text-gray-800">Agile Development Framework</h3>
            <p class="text-gray-600">
                Our lean sprints deliver working systems quickly and allow for continuous improvement. This includes regular sprint planning and review calls to keep our teams aligned and transparent.
            </p>

            <h3 class="text-xl font-semibold text-gray-800">Modular Architecture</h3>
            <p class="text-gray-600">
                We build our systems to be flexible and extensible, so you are never locked into a rigid solution. Our API-first approach and independent components allow for easy integration and future upgrades.
            </p>
        </div>
    </section>

    <hr class="my-12 border-gray-300">
    
    <!-- Quality Assurance & Deployment Section -->
    <section class="text-center max-w-3xl mx-auto mt-12">
            <h2 class="text-3xl font-bold text-gray-900">Quality Assurance & Deployment</h2>
            <p class="mt-4 text-lg text-gray-600">
                The final stage of our lifecycle focuses on rigorous testing, secure deployment, and long-term reliability. We combine automated pipelines with human evaluation to ensure your system performs consistently in production.
            </p>

            <div class="text-left mt-8 space-y-6">
                <h3 class="text-xl font-semibold text-gray-800">Quality Assurance Process</h3>
                <p class="text-gray-600">
                    We use a multi-tiered QA process to evaluate AI systems for accuracy, performance, and safety. This includes automated testing, hallucination prevention, and prompt injection defense.
                </p>

                <h3 class="text-xl font-semibold text-gray-800">Deployment Workflows</h3>
                <p class="text-gray-600">
                    We offer full-service deployment and management, including setting up staging and production environments, automated pipelines, and continuous monitoring to ensure optimal performance.
                </p>

                <h3 class="text-xl font-semibold text-gray-800">Ongoing Support & Optimization</h3>
                <p class="text-gray-600">
                    AI systems are a continuous journey. We provide ongoing oversight and enhancements through live system monitoring, scheduled QA cycles, and direct support channels.
                </p>
            </div>
    </section>

</div>
</div>
@endsection
