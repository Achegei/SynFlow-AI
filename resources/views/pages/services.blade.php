@extends('layouts.public')

@section('title', 'Services - MooseLoon AI Academy')

@section('content')

<!-- HERO SECTION -->
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-indigo-900 to-indigo-700 py-24">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-72 h-72 bg-indigo-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-400 rounded-full blur-3xl"></div>
    </div>

    <div class="relative container mx-auto px-6 text-center">
        <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-sm font-medium text-indigo-100 ring-1 ring-white/20 backdrop-blur">
            AI Education • Automation • AI Agents • Career Skills
        </span>

        <h1 class="mt-8 text-5xl md:text-6xl font-extrabold tracking-tight text-white leading-tight">
            Build Real AI Skills With
            <span class="bg-gradient-to-r from-cyan-300 to-indigo-200 bg-clip-text text-transparent">
                MooseLoon AI Academy
            </span>
        </h1>

        <p class="mt-8 max-w-3xl mx-auto text-lg md:text-xl text-indigo-100 leading-relaxed">
            We train students, professionals, and businesses in practical Artificial Intelligence,
            AI agents, workflow automation, APIs, prompt engineering, and no-code systems that solve real-world problems.
        </p>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('contact') }}"
               class="inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-base font-semibold text-indigo-700 shadow-xl hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                Enroll or Book Consultation
            </a>

            <a href="#programs"
               class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-8 py-4 text-base font-semibold text-white backdrop-blur hover:bg-white/20 transition">
                Explore Programs
            </a>
        </div>
    </div>
</section>

<!-- WHAT WE OFFER -->
<section class="bg-white py-24">
    <div class="container mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto mb-20">
            <span class="text-indigo-600 font-semibold uppercase tracking-widest">
                What We Offer
            </span>

            <h2 class="mt-4 text-4xl md:text-5xl font-extrabold text-gray-900">
                Industry-Focused AI Training & Automation
            </h2>

            <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                Our programs are designed for practical implementation — helping learners and businesses use AI tools,
                automation systems, and intelligent workflows effectively.
            </p>
        </div>

        <div id="programs" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">

            <!-- CARD 1 -->
            <div class="group relative overflow-hidden rounded-3xl border border-indigo-100 bg-white p-8 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="absolute top-0 right-0 h-32 w-32 rounded-full bg-indigo-100 blur-3xl opacity-70"></div>

                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-lg">
                        🤖
                    </div>

                    <h3 class="mt-8 text-2xl font-bold text-gray-900">
                        AI Agents & Workflow Automation
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Learn how to build intelligent AI agents and automated systems using modern no-code and low-code tools.
                    </p>

                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="text-indigo-600">✓</span>
                            <span>AI Agents & Assistants</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-indigo-600">✓</span>
                            <span>n8n Workflow Automation</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-indigo-600">✓</span>
                            <span>Webhooks & APIs</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="group relative overflow-hidden rounded-3xl border border-indigo-100 bg-white p-8 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-cyan-100 blur-3xl opacity-70"></div>

                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-cyan-600 text-white flex items-center justify-center shadow-lg">
                        🎓
                    </div>

                    <h3 class="mt-8 text-2xl font-bold text-gray-900">
                        AI Certification Programs
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Structured certification programs designed to equip learners with practical and employable AI skills.
                    </p>

                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="text-cyan-600">✓</span>
                            <span>Prompt Engineering</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-cyan-600">✓</span>
                            <span>AI Fundamentals</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-cyan-600">✓</span>
                            <span>Practical AI Projects</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="group relative overflow-hidden rounded-3xl border border-indigo-100 bg-white p-8 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="absolute top-0 left-0 h-32 w-32 rounded-full bg-purple-100 blur-3xl opacity-70"></div>

                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-purple-600 text-white flex items-center justify-center shadow-lg">
                        ⚙️
                    </div>

                    <h3 class="mt-8 text-2xl font-bold text-gray-900">
                        Business AI Automation
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Students learn how businesses use AI to automate operations, reduce manual work, and improve efficiency. Our graduates help organizations implement real-world AI systems like customer support and CRM automation.
                    </p>

                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="text-purple-600">✓</span>
                            <span>Build WhatsApp AI Automation Systems</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-purple-600">✓</span>
                            <span>Integrate AI with CRM Platforms</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-purple-600">✓</span>
                            <span>Design AI Customer Support Solutions</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="group relative overflow-hidden rounded-3xl border border-indigo-100 bg-white p-8 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="absolute bottom-0 right-0 h-32 w-32 rounded-full bg-pink-100 blur-3xl opacity-70"></div>

                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-pink-600 text-white flex items-center justify-center shadow-lg">
                        💼
                    </div>

                    <h3 class="mt-8 text-2xl font-bold text-gray-900">
                        Career & Freelancing Skills
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Students learn how to turn AI skills into income through freelancing, remote work, and consulting. Our graduates build portfolios and offer AI services to clients and businesses globally.
                    </p>

                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="text-pink-600">✓</span>
                            <span>Work on Real Client Project Workflows</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-pink-600">✓</span>
                            <span>Build a Job-Ready AI Portfolio</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-pink-600">✓</span>
                            <span>Package and Sell AI Services Professionally</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CARD 5 -->
                <div class="group relative overflow-hidden rounded-3xl border border-indigo-100 bg-white p-8 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="absolute top-0 right-0 h-32 w-32 rounded-full bg-emerald-100 blur-3xl opacity-70"></div>

                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shadow-lg">
                            🌐
                        </div>

                        <h3 class="mt-8 text-2xl font-bold text-gray-900">
                            AI-Powered Websites
                        </h3>

                        <p class="mt-4 text-gray-600 leading-relaxed">
                            Students learn how to build modern websites powered by AI systems, automation, and chat assistants. Our graduates create smart websites that help businesses capture leads and engage customers 24/7.
                        </p>

                        <ul class="mt-6 space-y-3 text-gray-700">
                            <li class="flex items-start gap-3">
                                <span class="text-emerald-600">✓</span>
                                <span>Build Lead Capture Systems for Real Businesses</span>
                            </li>

                            <li class="flex items-start gap-3">
                                <span class="text-emerald-600">✓</span>
                                <span>Integrate AI Chat Assistants into Websites</span>
                            </li>

                            <li class="flex items-start gap-3">
                                <span class="text-emerald-600">✓</span>
                                <span>Design Automated Website Workflows</span>
                            </li>
                        </ul>
                    </div>
                </div>

            <!-- CARD 6 -->
            <div class="group relative overflow-hidden rounded-3xl border border-indigo-100 bg-white p-8 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-orange-100 blur-3xl opacity-70"></div>

                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-orange-500 text-white flex items-center justify-center shadow-lg">
                        🚀
                    </div>

                    <h3 class="mt-8 text-2xl font-bold text-gray-900">
                        AI Transformation Consulting
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Students learn how organizations adopt AI to improve operations and decision-making. Our graduates support businesses and institutions in planning and implementing AI transformation strategies.
                    </p>

                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="text-orange-500">✓</span>
                            <span>Develop AI Adoption Strategies for Organizations</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-orange-500">✓</span>
                            <span>Optimize Business Workflows Using AI Tools</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <span class="text-orange-500">✓</span>
                            <span>Support Institutional AI Training & Implementation</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FEATURE STRIP -->
<section class="bg-indigo-950 py-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">

            <div>
                <h3 class="text-5xl font-extrabold text-white">15</h3>
                <p class="mt-3 text-indigo-200 text-lg">
                    Practical AI Learning Modules
                </p>
            </div>

            <div>
                <h3 class="text-5xl font-extrabold text-white">120+</h3>
                <p class="mt-3 text-indigo-200 text-lg">
                    Hours of Hands-On Learning
                </p>
            </div>

            <div>
                <h3 class="text-5xl font-extrabold text-white">Real</h3>
                <p class="mt-3 text-indigo-200 text-lg">
                    Automation Projects & Deployments
                </p>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="relative overflow-hidden bg-gradient-to-r from-indigo-700 to-indigo-500 py-24 text-center">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute left-0 top-0 h-72 w-72 rounded-full bg-white blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-72 w-72 rounded-full bg-cyan-200 blur-3xl"></div>
    </div>

    <div class="relative container mx-auto px-6 max-w-4xl">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white">
            Start Your AI Journey Today
        </h2>

        <p class="mt-6 text-lg md:text-xl text-indigo-100 leading-relaxed">
            Whether you're a student, entrepreneur, institution, or business,
            MooseLoon AI Academy helps you build practical AI skills for the future.
        </p>

        <div class="mt-10">
            <a href="{{ route('contact') }}"
               class="inline-flex items-center justify-center rounded-full bg-white px-10 py-4 text-lg font-semibold text-indigo-700 shadow-xl hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                Contact MooseLoon AI Academy
            </a>
        </div>
    </div>
</section>

@endsection