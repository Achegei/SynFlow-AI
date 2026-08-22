@extends('layouts.public')

@section('title', 'Moose Loon AI Academy | Canadian Practical AI Education')

<style>
    :root {
        --ml-navy: #00104B;
        --ml-navy-dark: #000A32;
        --ml-blue: #002A6B;
        --ml-red: #C90000;
        --ml-red-dark: #A90000;
        --ml-light: #F7F9FC;
        --ml-border: #E5E9F0;
        --ml-text: #101828;
        --ml-muted: #667085;
    }

    /* ---------------------------------------------------------
       BRAND UTILITIES
    --------------------------------------------------------- */

    .ml-navy {
        color: var(--ml-navy);
    }

    .ml-red {
        color: var(--ml-red);
    }

    .ml-bg-navy {
        background-color: var(--ml-navy);
    }

    .ml-bg-light {
        background-color: var(--ml-light);
    }

    .ml-border {
        border-color: var(--ml-border);
    }

    .ml-container {
        width: 100%;
        max-width: 1280px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }

    @media (min-width: 640px) {
        .ml-container {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .ml-container {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }


    /* ---------------------------------------------------------
       IMAGE SLIDER
    --------------------------------------------------------- */

    .ml-image-slide {
        transition:
            opacity 1s ease-in-out,
            transform 5s ease-out;
        transform: scale(1.015);
    }

    .ml-image-slide.opacity-100 {
        opacity: 1;
        transform: scale(1);
    }

    .ml-image-slide.opacity-0 {
        opacity: 0;
        transform: scale(1.015);
    }


    /* ---------------------------------------------------------
       SCROLL REVEAL
    --------------------------------------------------------- */

    .ml-reveal {
        opacity: 0;
        transform: translateY(18px);
        transition:
            opacity 0.75s ease,
            transform 0.75s cubic-bezier(.22, 1, .36, 1);
    }

    .ml-reveal.ml-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .ml-reveal-left {
        opacity: 0;
        transform: translateX(-22px);
        transition:
            opacity 0.85s ease,
            transform 0.85s cubic-bezier(.22, 1, .36, 1);
    }

    .ml-reveal-left.ml-visible {
        opacity: 1;
        transform: translateX(0);
    }

    .ml-reveal-right {
        opacity: 0;
        transform: translateX(22px);
        transition:
            opacity 0.85s ease,
            transform 0.85s cubic-bezier(.22, 1, .36, 1);
    }

    .ml-reveal-right.ml-visible {
        opacity: 1;
        transform: translateX(0);
    }

    .ml-delay-1 {
        transition-delay: 100ms;
    }

    .ml-delay-2 {
        transition-delay: 180ms;
    }

    .ml-delay-3 {
        transition-delay: 260ms;
    }

    .ml-delay-4 {
        transition-delay: 340ms;
    }

    .ml-delay-5 {
        transition-delay: 420ms;
    }


    /* ---------------------------------------------------------
       SUBTLE HOVER INTERACTIONS
    --------------------------------------------------------- */

    .ml-card {
        transition:
            transform 250ms ease,
            border-color 250ms ease,
            box-shadow 250ms ease;
    }

    .ml-card:hover {
        transform: translateY(-3px);
    }

    .ml-number {
        transition:
            background-color 250ms ease,
            transform 250ms ease;
    }

    .ml-card:hover .ml-number {
        transform: translateY(-2px);
    }


    /* ---------------------------------------------------------
       IMAGE REVEAL
    --------------------------------------------------------- */

    .ml-image-reveal {
        opacity: 0;
        transform: translateX(-20px);
        transition:
            opacity 0.9s ease,
            transform 0.9s cubic-bezier(.22, 1, .36, 1);
    }

    .ml-image-reveal.ml-visible {
        opacity: 1;
        transform: translateX(0);
    }


    /* ---------------------------------------------------------
       MARQUEE
    --------------------------------------------------------- */

    @keyframes ml-marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .ml-marquee {
        animation: ml-marquee 35s linear infinite;
    }

    .ml-marquee-wrapper {
        position: relative;
    }

    .ml-marquee-wrapper::before,
    .ml-marquee-wrapper::after {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100px;
        z-index: 2;
        pointer-events: none;
    }

    .ml-marquee-wrapper::before {
        left: 0;
        background: linear-gradient(
            to right,
            #ffffff,
            rgba(255, 255, 255, 0)
        );
    }

    .ml-marquee-wrapper::after {
        right: 0;
        background: linear-gradient(
            to left,
            #ffffff,
            rgba(255, 255, 255, 0)
        );
    }


    /* ---------------------------------------------------------
       FINAL CTA MOTION
    --------------------------------------------------------- */

    @keyframes ml-orbit-soft {
        0%, 100% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(-10px, 8px);
        }
    }

    .ml-orbit-soft {
        animation: ml-orbit-soft 12s ease-in-out infinite;
    }


    /* ---------------------------------------------------------
       ACCESSIBILITY / MOTION
    --------------------------------------------------------- */

    @media (prefers-reduced-motion: reduce) {

        .ml-marquee,
        .ml-orbit-soft {
            animation: none;
        }

        .ml-image-slide,
        .ml-reveal,
        .ml-reveal-left,
        .ml-reveal-right,
        .ml-image-reveal,
        .ml-card,
        .ml-number {
            transition: none;
        }

        .ml-reveal,
        .ml-reveal-left,
        .ml-reveal-right,
        .ml-image-reveal {
            opacity: 1;
            transform: none;
        }

        .ml-image-slide {
            transform: none;
        }
    }
</style>

@section('content')

    {{-- =========================================================
         HERO
    ========================================================== --}}
    <section class="relative overflow-hidden bg-white">
        <div class="ml-container">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center py-16 sm:py-20 lg:py-24">

                {{-- LEFT --}}
                <div class="max-w-3xl">

                    <div class="inline-flex items-center gap-2 mb-7 ml-reveal">
                        <span class="w-2 h-2 rounded-full bg-[#C90000]"></span>

                        <span class="text-sm font-semibold tracking-wide text-[#00104B] uppercase">
                            Canadian AI Education
                        </span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-[4rem] font-extrabold tracking-tight leading-[1.08] text-[#00104B] ml-reveal ml-delay-1">
                        Learn AI.
                        <span class="block text-[#C90000]">
                            Build with AI.
                        </span>
                        <span class="block">
                            Prepare for what comes next.
                        </span>
                    </h1>

                    <p class="mt-7 text-lg sm:text-xl leading-8 text-slate-600 max-w-2xl ml-reveal ml-delay-2">
                        Moose Loon AI Academy provides practical, career-focused AI education
                        for students, professionals, entrepreneurs, and organizations preparing
                        for an AI-powered world.
                    </p>

                    <p class="mt-5 text-base leading-7 text-slate-500 max-w-2xl ml-reveal ml-delay-3">
                        Learn through structured courses, practical projects, modern AI tools,
                        automation workflows, and hands-on application—not theory alone.
                    </p>

                    {{-- CTA --}}
                    <div class="mt-9 flex flex-wrap gap-4 ml-reveal ml-delay-4">

                        <a href="{{ route('ai.onboarding.step', ['step' => 1]) }}"
                           class="inline-flex items-center justify-center px-7 py-3.5 rounded-lg bg-[#C90000] text-white font-semibold shadow-sm hover:bg-[#A90000] transition duration-200">
                            Start Learning
                            <span class="ml-2 text-lg leading-none">→</span>
                        </a>

                        <a href="{{ route('contactus') }}"
                           class="inline-flex items-center justify-center px-7 py-3.5 rounded-lg border border-[#00104B] text-[#00104B] font-semibold hover:bg-[#00104B] hover:text-white transition duration-200">
                            Partner with us
                        </a>

                    </div>

                    {{-- TRUST POINTS --}}
                    <div class="mt-9 flex flex-wrap gap-x-7 gap-y-3 text-sm text-slate-500 ml-reveal ml-delay-5">

                        <div>
                            Practical AI training
                        </div>

                        <div>
                            Project-based learning
                        </div>

                        <div>
                            Professional certification
                        </div>

                    </div>

                </div>


                {{-- RIGHT: ACADEMIC VISUAL --}}
                <div class="relative ml-reveal-right">

                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-xl bg-[#F7F9FC]">

                        <div class="absolute top-0 left-0 right-0 h-1 bg-[#C90000] z-20"></div>

                        <img src="{{ asset('images/feature1.png') }}"
                             alt="Students learning artificial intelligence at Moose Loon AI Academy"
                             class="w-full h-[420px] sm:h-[500px] lg:h-[560px] object-cover ml-image-slide opacity-100">

                        <img src="{{ asset('images/feature2.png') }}"
                             alt="Practical AI learning and technology education"
                             class="absolute inset-0 w-full h-[420px] sm:h-[500px] lg:h-[560px] object-cover ml-image-slide opacity-0">

                        <img src="{{ asset('images/feature3.png') }}"
                             alt="AI education and practical learning"
                             class="absolute inset-0 w-full h-[420px] sm:h-[500px] lg:h-[560px] object-cover ml-image-slide opacity-0">

                    </div>

                    {{-- SMALL ACADEMIC CARD --}}
                    <div class="absolute -bottom-5 left-5 sm:left-8 bg-white border border-slate-200 shadow-xl rounded-xl px-5 py-4 max-w-xs ml-reveal ml-delay-3">

                        <div>
                            <p class="font-bold text-[#00104B]">
                                Learn by building
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                Practical projects designed around modern AI applications.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>


    {{-- =========================================================
         CREDIBILITY / POSITIONING STRIP
    ========================================================== --}}
    <section class="border-y border-slate-200 bg-[#F7F9FC]">
        <div class="ml-container">
            <div class="py-7 grid grid-cols-2 md:grid-cols-4 gap-6">

                <div class="text-center md:text-left ml-reveal">
                    <p class="text-sm font-semibold text-[#00104B]">
                        PRACTICAL
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Learn through application
                    </p>
                </div>

                <div class="text-center md:text-left ml-reveal ml-delay-1">
                    <p class="text-sm font-semibold text-[#00104B]">
                        PROJECT-BASED
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Build real AI solutions
                    </p>
                </div>

                <div class="text-center md:text-left ml-reveal ml-delay-2">
                    <p class="text-sm font-semibold text-[#00104B]">
                        CAREER-FOCUSED
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Skills for modern work
                    </p>
                </div>

                <div class="text-center md:text-left ml-reveal ml-delay-3">
                    <p class="text-sm font-semibold text-[#00104B]">
                        GLOBAL
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Canadian academy, global outlook
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- =========================================================
         WHO WE SERVE
    ========================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="ml-container">

            <div class="max-w-3xl ml-reveal">

                <span class="text-sm font-bold uppercase tracking-widest text-[#C90000]">
                    Education for the AI era
                </span>

                <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold text-[#00104B] leading-tight">
                    AI skills are becoming essential across every field.
                </h2>

                <p class="mt-5 text-lg text-slate-600 leading-8">
                    Our programs are designed for people who want to understand AI,
                    work effectively with AI tools, and build practical solutions that
                    solve real problems.
                </p>

            </div>


            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- CARD --}}
                <div class="ml-card ml-reveal border border-slate-200 rounded-xl p-6 hover:border-[#00104B] hover:shadow-lg">

                    <h3 class="font-bold text-lg text-[#00104B]">
                        Students & Graduates
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 leading-6">
                        Build practical AI skills that complement your academic background.
                    </p>

                </div>


                {{-- CARD --}}
                <div class="ml-card ml-reveal ml-delay-1 border border-slate-200 rounded-xl p-6 hover:border-[#00104B] hover:shadow-lg">

                    <h3 class="font-bold text-lg text-[#00104B]">
                        Professionals
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 leading-6">
                        Learn how AI can improve productivity, workflows, and professional capability.
                    </p>

                </div>


                {{-- CARD --}}
                <div class="ml-card ml-reveal ml-delay-2 border border-slate-200 rounded-xl p-6 hover:border-[#00104B] hover:shadow-lg">

                    <h3 class="font-bold text-lg text-[#00104B]">
                        Entrepreneurs
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 leading-6">
                        Understand how AI can be applied to products, processes, and new opportunities.
                    </p>

                </div>


                {{-- CARD --}}
                <div class="ml-card ml-reveal ml-delay-3 border border-slate-200 rounded-xl p-6 hover:border-[#00104B] hover:shadow-lg">

                    <h3 class="font-bold text-lg text-[#00104B]">
                        Organizations
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 leading-6">
                        Equip teams and institutions with practical AI knowledge for the modern workplace.
                    </p>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         WHY MOOSE LOON
    ========================================================== --}}
    <section class="bg-[#00104B] text-white py-20 sm:py-24">
        <div class="ml-container">

            <div class="grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">

                {{-- LEFT IMAGE --}}
                <div class="relative order-2 lg:order-1 ml-image-reveal">

                    <div class="rounded-2xl overflow-hidden border border-white/10 shadow-2xl">
                        <img src="{{ asset('images/AI-Solutions.png') }}"
                             alt="Practical AI education at Moose Loon AI Academy"
                             class="w-full h-[380px] sm:h-[480px] object-cover">
                    </div>

                    <div class="absolute -bottom-6 -right-4 sm:right-6 bg-white text-[#00104B] rounded-xl shadow-xl p-5 max-w-xs ml-reveal ml-delay-2">

                        <p class="text-xs font-bold uppercase tracking-widest text-[#C90000]">
                            Our approach
                        </p>

                        <p class="mt-2 font-bold">
                            Learn the concepts. Build the systems. Apply the skills.
                        </p>

                    </div>

                </div>


                {{-- RIGHT --}}
                <div class="order-1 lg:order-2">

                    <div class="ml-reveal">

                        <span class="text-sm font-bold uppercase tracking-widest text-red-300">
                            Why Moose Loon AI Academy
                        </span>

                        <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold leading-tight">
                            AI education designed around practical capability.
                        </h2>

                        <p class="mt-6 text-lg text-blue-100 leading-8">
                            AI changes quickly. Learning how to use today's tools is useful,
                            but understanding how to apply AI to real problems is what creates
                            lasting capability.
                        </p>

                    </div>

                    <div class="mt-10 space-y-7">

                        <div class="flex gap-4 ml-reveal ml-delay-1">

                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-red-300 font-bold">
                                01
                            </div>

                            <div>
                                <h3 class="font-bold text-lg">
                                    Structured learning
                                </h3>

                                <p class="mt-1 text-blue-100/80">
                                    Clear learning pathways that move from fundamentals
                                    to practical implementation.
                                </p>
                            </div>

                        </div>


                        <div class="flex gap-4 ml-reveal ml-delay-2">

                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-red-300 font-bold">
                                02
                            </div>

                            <div>
                                <h3 class="font-bold text-lg">
                                    Hands-on projects
                                </h3>

                                <p class="mt-1 text-blue-100/80">
                                    Students apply concepts by building useful AI-powered
                                    applications and workflows.
                                </p>
                            </div>

                        </div>


                        <div class="flex gap-4 ml-reveal ml-delay-3">

                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-red-300 font-bold">
                                03
                            </div>

                            <div>
                                <h3 class="font-bold text-lg">
                                    Career relevance
                                </h3>

                                <p class="mt-1 text-blue-100/80">
                                    Training focuses on skills that can be applied across
                                    modern workplaces and emerging AI roles.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         WHAT STUDENTS LEARN
    ========================================================== --}}
    <section class="bg-[#F7F9FC] py-20 sm:py-24">
        <div class="ml-container">

            <div class="text-center max-w-3xl mx-auto ml-reveal">

                <span class="text-sm font-bold uppercase tracking-widest text-[#C90000]">
                    What you will learn
                </span>

                <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold text-[#00104B]">
                    Build a foundation for working with modern AI.
                </h2>

                <p class="mt-5 text-lg text-slate-600 leading-8">
                    Our learning experience brings together AI concepts, modern tools,
                    automation, integrations, and practical projects.
                </p>

            </div>


            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                @php
                    $learningAreas = [
                        [
                            'number' => '01',
                            'title' => 'Artificial Intelligence Fundamentals',
                            'text' => 'Understand core AI concepts, models, applications, and how intelligent systems are being used across industries.'
                        ],
                        [
                            'number' => '02',
                            'title' => 'Prompt Engineering',
                            'text' => 'Learn how to communicate effectively with modern AI models and design reliable prompts for different tasks.'
                        ],
                        [
                            'number' => '03',
                            'title' => 'Generative AI & LLMs',
                            'text' => 'Explore large language models and learn how they can support content, analysis, reasoning, and applications.'
                        ],
                        [
                            'number' => '04',
                            'title' => 'AI Agents',
                            'text' => 'Understand agentic systems and how AI can reason through tasks, use tools, and participate in workflows.'
                        ],
                        [
                            'number' => '05',
                            'title' => 'Workflow Automation',
                            'text' => 'Design practical automated workflows that connect AI models with applications, services, and business processes.'
                        ],
                        [
                            'number' => '06',
                            'title' => 'APIs & Integrations',
                            'text' => 'Learn how applications communicate through APIs, webhooks, integrations, and connected systems.'
                        ],
                        [
                            'number' => '07',
                            'title' => 'AI Chatbots & Assistants',
                            'text' => 'Build conversational AI experiences designed around real user needs and practical use cases.'
                        ],
                        [
                            'number' => '08',
                            'title' => 'AI Voice Applications',
                            'text' => 'Explore how AI voice technologies can be incorporated into modern applications and workflows.'
                        ],
                        [
                            'number' => '09',
                            'title' => 'Practical AI Projects',
                            'text' => 'Apply what you learn by developing projects that demonstrate your understanding and practical capability.'
                        ],
                    ];
                @endphp

                @foreach($learningAreas as $index => $area)

                    <div class="ml-card ml-reveal {{ $index % 3 === 1 ? 'ml-delay-1' : ($index % 3 === 2 ? 'ml-delay-2' : '') }} bg-white border border-slate-200 rounded-xl p-6 hover:border-[#00104B] hover:shadow-md">

                        <div class="flex items-start gap-4">

                            <div class="ml-number flex-shrink-0 w-9 h-9 rounded-lg bg-[#00104B] text-white flex items-center justify-center text-xs font-bold">
                                {{ $area['number'] }}
                            </div>

                            <div>

                                <h3 class="font-bold text-lg text-[#00104B]">
                                    {{ $area['title'] }}
                                </h3>

                                <p class="mt-2 text-sm text-slate-500 leading-6">
                                    {{ $area['text'] }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>
    </section>


    {{-- =========================================================
         BUILD REAL PROJECTS
    ========================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="ml-container">

            <div class="grid lg:grid-cols-2 gap-14 items-center">

                <div>

                    <div class="ml-reveal">

                        <span class="text-sm font-bold uppercase tracking-widest text-[#C90000]">
                            Learning by doing
                        </span>

                        <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold text-[#00104B] leading-tight">
                            Don't just study AI. Learn how to build with it.
                        </h2>

                        <p class="mt-6 text-lg text-slate-600 leading-8">
                            Practical projects give learners an opportunity to move from
                            concepts to implementation and demonstrate what they can actually do.
                        </p>

                    </div>

                    <div class="mt-9 space-y-4">

                        @foreach([
                            'AI assistants and chatbots',
                            'AI-powered customer support experiences',
                            'Workflow automation systems',
                            'AI agent workflows',
                            'API and webhook integrations',
                            'Practical business and productivity applications'
                        ] as $index => $project)

                            <div class="flex items-center gap-3 ml-reveal {{ $index % 3 === 1 ? 'ml-delay-1' : ($index % 3 === 2 ? 'ml-delay-2' : '') }}">

                                <span class="w-1.5 h-1.5 rounded-full bg-[#C90000] flex-shrink-0"></span>

                                <span class="text-slate-700">
                                    {{ $project }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>


                <div class="relative ml-reveal-right">

                    <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-xl">
                        <img src="{{ asset('images/agent.jpg') }}"
                             alt="AI project development and practical learning"
                             class="w-full h-[420px] sm:h-[500px] object-cover">
                    </div>

                    <div class="absolute -bottom-6 -left-5 sm:left-6 bg-[#00104B] text-white rounded-xl shadow-xl p-5 max-w-xs ml-reveal ml-delay-2">

                        <p class="text-xs uppercase tracking-widest text-red-300 font-bold">
                            Student experience
                        </p>

                        <p class="mt-2 font-semibold">
                            From learning the concept to applying it in a working project.
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         LEARNING MODEL
    ========================================================== --}}
    <section class="bg-[#00104B] py-20 sm:py-24 text-white">
        <div class="ml-container">

            <div class="max-w-3xl ml-reveal">

                <span class="text-sm font-bold uppercase tracking-widest text-red-300">
                    Our learning model
                </span>

                <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold leading-tight">
                    A clear path from understanding to application.
                </h2>

                <p class="mt-5 text-lg text-blue-100 leading-8">
                    Students progress through a practical learning cycle designed to
                    help them understand AI concepts, apply them, and demonstrate their
                    capabilities through projects.
                </p>

            </div>


            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="ml-card ml-reveal rounded-xl border border-white/10 bg-white/5 p-7">

                    <span class="text-4xl font-extrabold text-white/20">
                        01
                    </span>

                    <h3 class="mt-5 text-xl font-bold">
                        Learn
                    </h3>

                    <p class="mt-3 text-blue-100/80 leading-7">
                        Build an understanding of the principles, tools, technologies,
                        and methods behind modern AI.
                    </p>

                </div>


                <div class="ml-card ml-reveal ml-delay-1 rounded-xl border border-white/10 bg-white/5 p-7">

                    <span class="text-4xl font-extrabold text-white/20">
                        02
                    </span>

                    <h3 class="mt-5 text-xl font-bold">
                        Build
                    </h3>

                    <p class="mt-3 text-blue-100/80 leading-7">
                        Turn concepts into practical projects using AI models,
                        automation tools, APIs, and connected systems.
                    </p>

                </div>


                <div class="ml-card ml-reveal ml-delay-2 rounded-xl border border-white/10 bg-white/5 p-7">

                    <span class="text-4xl font-extrabold text-white/20">
                        03
                    </span>

                    <h3 class="mt-5 text-xl font-bold">
                        Apply
                    </h3>

                    <p class="mt-3 text-blue-100/80 leading-7">
                        Develop the confidence to use AI skills in academic,
                        professional, entrepreneurial, and organizational settings.
                    </p>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         TECHNOLOGY ECOSYSTEM
    ========================================================== --}}
    <section id="industries" class="bg-white py-20 sm:py-24 overflow-hidden">
        <div class="ml-container">

            <div class="text-center max-w-3xl mx-auto ml-reveal">

                <span class="text-sm font-bold uppercase tracking-widest text-[#C90000]">
                    Modern AI ecosystem
                </span>

                <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold text-[#00104B]">
                    Learn with the tools shaping modern AI work.
                </h2>

                <p class="mt-5 text-lg text-slate-600 leading-8">
                    Our practical learning environment introduces students to modern
                    AI and automation technologies used across today's digital ecosystem.
                </p>

            </div>


            <div class="mt-12 relative ml-marquee-wrapper overflow-hidden">

                <div class="flex items-center gap-16 whitespace-nowrap ml-marquee w-max">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/N8n-logo-new.png') }}"
                         alt="n8n">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Make-Logo.png') }}"
                         alt="Make">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Zapier_Logo.png') }}"
                         alt="Zapier">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Canva_Logo.png') }}"
                         alt="Canva">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Amazon_Web_Services_Logo.png') }}"
                         alt="Amazon Web Services">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Relevance_AI_Logo.png') }}"
                         alt="Relevance AI">

                    {{-- DUPLICATE FOR CONTINUOUS MARQUEE --}}

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/N8n-logo-new.png') }}"
                         alt="n8n">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Make-Logo.png') }}"
                         alt="Make">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Zapier_Logo.png') }}"
                         alt="Zapier">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Canva_Logo.png') }}"
                         alt="Canva">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Amazon_Web_Services_Logo.png') }}"
                         alt="Amazon Web Services">

                    <img class="h-10 sm:h-12 w-auto grayscale opacity-60 hover:opacity-100 transition"
                         src="{{ asset('images/Relevance_AI_Logo.png') }}"
                         alt="Relevance AI">

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         CAREER OUTCOMES
    ========================================================== --}}
    <section class="bg-[#F7F9FC] py-20 sm:py-24">
        <div class="ml-container">

            <div class="grid lg:grid-cols-2 gap-14 items-start">

                <div class="ml-reveal">

                    <span class="text-sm font-bold uppercase tracking-widest text-[#C90000]">
                        Career development
                    </span>

                    <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold text-[#00104B] leading-tight">
                        Build skills that can travel with you.
                    </h2>

                    <p class="mt-6 text-lg text-slate-600 leading-8">
                        AI is becoming part of how organizations operate across industries.
                        Our training helps learners develop practical capabilities that can
                        support multiple career directions.
                    </p>

                    <div class="mt-8">
                        <a href="{{ route('ai.onboarding.step', ['step' => 1]) }}"
                           class="inline-flex items-center px-6 py-3 rounded-lg bg-[#00104B] text-white font-semibold hover:bg-[#002A6B] transition">
                            Start Your Learning Journey
                        </a>
                    </div>

                </div>


                <div class="grid sm:grid-cols-2 gap-4">

                    @foreach([
                        'AI Automation Specialist',
                        'AI Solutions Developer',
                        'Prompt Engineering',
                        'AI Operations',
                        'Workflow Automation',
                        'AI Consulting',
                        'AI Product Development',
                        'AI Freelancing'
                    ] as $index => $career)

                        <div class="ml-card ml-reveal {{ $index % 4 === 1 ? 'ml-delay-1' : ($index % 4 === 2 ? 'ml-delay-2' : ($index % 4 === 3 ? 'ml-delay-3' : '')) }} bg-white border border-slate-200 rounded-xl px-5 py-4">

                            <span class="font-semibold text-[#00104B]">
                                {{ $career }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         CERTIFICATION
    ========================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="ml-container">

            <div class="rounded-2xl bg-[#00104B] overflow-hidden ml-reveal">

                <div class="grid lg:grid-cols-2">

                    <div class="p-8 sm:p-12 lg:p-14">

                        <span class="text-sm font-bold uppercase tracking-widest text-red-300">
                            Professional development
                        </span>

                        <h2 class="mt-4 text-3xl sm:text-4xl font-extrabold text-white">
                            Demonstrate what you have learned.
                        </h2>

                        <p class="mt-5 text-blue-100 leading-8">
                            Learners who successfully complete the applicable program
                            requirements can receive a professional certificate of completion
                            reflecting their participation and learning journey.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">

                            <div class="px-4 py-2 rounded-lg bg-white/10 text-sm text-white">
                                Practical learning
                            </div>

                            <div class="px-4 py-2 rounded-lg bg-white/10 text-sm text-white">
                                Project experience
                            </div>

                            <div class="px-4 py-2 rounded-lg bg-white/10 text-sm text-white">
                                Certificate of completion
                            </div>

                        </div>

                    </div>


                    <div class="bg-white/5 p-8 sm:p-12 lg:p-14 flex items-center">

                        <div class="w-full border border-white/15 rounded-xl p-7 sm:p-8 ml-reveal ml-delay-2">

                            <div class="text-center">

                                <p class="text-xs uppercase tracking-[0.25em] text-red-300 font-bold">
                                    Moose Loon AI Academy
                                </p>

                                <div class="mt-5 h-px bg-white/10"></div>

                                <p class="mt-7 text-sm text-blue-100">
                                    Professional Certificate
                                </p>

                                <h3 class="mt-2 text-2xl font-bold text-white">
                                    Artificial Intelligence & Automation Systems
                                </h3>

                                <div class="mt-7 h-px bg-white/10"></div>

                                <p class="mt-5 text-xs text-blue-100/70">
                                    Issued upon successful completion of the applicable
                                    program requirements.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         TESTIMONIALS
    ========================================================== --}}
    <section class="bg-[#F7F9FC] py-20 sm:py-24">
        <div class="ml-container">

            <div class="text-center max-w-3xl mx-auto ml-reveal">

                <span class="text-sm font-bold uppercase tracking-widest text-[#C90000]">
                    Student experience
                </span>

                <h2 class="mt-4 text-3xl sm:text-4xl lg:text-[2.9rem] font-extrabold text-[#00104B]">
                    Learning should create confidence.
                </h2>

                <p class="mt-5 text-lg text-slate-600 leading-8">
                    Hear from learners as they develop practical skills and discover
                    new ways to work with AI.
                </p>

            </div>


            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="ml-card ml-reveal bg-white border border-slate-200 rounded-xl p-7">

                    <div class="text-[#C90000] text-3xl font-serif">
                        “
                    </div>

                    <p class="mt-3 text-slate-600 leading-7">
                        The practical approach helped me move beyond simply
                        understanding AI and start thinking about how I could apply
                        it to real work.
                    </p>

                    <div class="mt-6 pt-5 border-t border-slate-100">
                        <p class="font-bold text-[#00104B]">
                            Wekesa Mark Tobbie
                        </p>

                        <p class="font-bold text-[#00104B]">
                            Student
                        </p>

                        <p class="text-sm text-slate-500 mt-1">
                            Moose Loon AI Academy
                        </p>

                    </div>

                </div>


                <div class="ml-card ml-reveal ml-delay-1 bg-white border border-slate-200 rounded-xl p-7">

                    <div class="text-[#C90000] text-3xl font-serif">
                        “
                    </div>

                    <p class="mt-3 text-slate-600 leading-7">
                        Building projects made the learning experience much more
                        meaningful. I could see how the concepts connected to
                        practical applications.
                    </p>

                    <div class="mt-6 pt-5 border-t border-slate-100">
                        <p class="font-bold text-[#00104B]">
                            Abdiweli Ali Musse
                        </p>
                        <p class="font-bold text-[#00104B]">
                            Learner
                        </p>

                        <p class="text-sm text-slate-500 mt-1">
                            Moose Loon AI Academy
                        </p>

                    </div>

                </div>


                <div class="ml-card ml-reveal ml-delay-2 bg-white border border-slate-200 rounded-xl p-7">

                    <div class="text-[#C90000] text-3xl font-serif">
                        “
                    </div>

                    <p class="mt-3 text-slate-600 leading-7">
                        The focus on modern AI tools and workflows gave me a clearer
                        understanding of where these technologies fit into today's
                        professional environment.
                    </p>

                    <div class="mt-6 pt-5 border-t border-slate-100">
                        <p class="font-bold text-[#00104B]">
                            Joseph Juma
                        </p>
                        <p class="font-bold text-[#00104B]">
                            Learner
                        </p>

                        <p class="text-sm text-slate-500 mt-1">
                            Moose Loon AI Academy
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         INSTITUTIONAL PARTNERSHIP
    ========================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="ml-container">

            <div class="rounded-2xl border border-slate-200 overflow-hidden ml-reveal">

                <div class="grid lg:grid-cols-2">

                    <div class="bg-[#00104B] text-white p-8 sm:p-12 lg:p-14">

                        <span class="text-sm font-bold uppercase tracking-widest text-red-300">
                            Institutional learning
                        </span>

                        <h2 class="mt-4 text-3xl sm:text-4xl font-extrabold leading-tight">
                            Bring practical AI education to your institution.
                        </h2>

                        <p class="mt-5 text-blue-100 leading-8">
                            Schools, colleges, universities, and training organizations
                            can explore academic partnership opportunities with
                            Moose Loon AI Academy.
                        </p>

                        <div class="mt-8">

                            <a href="{{ route('contactus') }}"
                               class="inline-flex items-center px-6 py-3 rounded-lg bg-[#C90000] text-white font-semibold hover:bg-[#A90000] transition">
                                Become an Academic Partner
                            </a>

                        </div>

                    </div>


                    <div class="p-8 sm:p-12 lg:p-14 bg-[#F7F9FC]">

                        <h3 class="text-xl font-bold text-[#00104B] ml-reveal">
                            Designed for educational environments
                        </h3>

                        <div class="mt-7 space-y-5">

                            <div class="flex gap-4 ml-reveal ml-delay-1">

                                <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-[#C90000] font-bold">
                                    1
                                </span>

                                <div>
                                    <h4 class="font-semibold text-[#00104B]">
                                        Structured curriculum
                                    </h4>

                                    <p class="mt-1 text-sm text-slate-500">
                                        A clear pathway for delivering practical AI education.
                                    </p>
                                </div>

                            </div>


                            <div class="flex gap-4 ml-reveal ml-delay-2">

                                <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-[#C90000] font-bold">
                                    2
                                </span>

                                <div>
                                    <h4 class="font-semibold text-[#00104B]">
                                        Flexible delivery
                                    </h4>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Suitable for online, guided, hybrid, or institutional learning models.
                                    </p>
                                </div>

                            </div>


                            <div class="flex gap-4 ml-reveal ml-delay-3">

                                <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-[#C90000] font-bold">
                                    3
                                </span>

                                <div>
                                    <h4 class="font-semibold text-[#00104B]">
                                        Practical outcomes
                                    </h4>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Students develop applied AI knowledge through projects and practical exercises.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         FINAL ADMISSIONS CTA
    ========================================================== --}}
    <section class="bg-[#F7F9FC] py-20 sm:py-24">
        <div class="ml-container">

            <div class="relative overflow-hidden rounded-2xl bg-[#00104B] px-7 py-12 sm:px-12 sm:py-16 text-center ml-reveal">

                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 ml-orbit-soft"></div>

                <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#C90000]/20 rounded-full translate-y-1/2 -translate-x-1/3 ml-orbit-soft"
                     style="animation-delay: -6s;"></div>

                <div class="relative">

                    <span class="text-sm font-bold uppercase tracking-[0.2em] text-red-300">
                        Admissions
                    </span>

                    <h2 class="mt-5 text-3xl sm:text-4xl lg:text-[3rem] font-extrabold text-white leading-tight max-w-4xl mx-auto">
                        Your future with AI starts with learning.
                    </h2>

                    <p class="mt-5 text-lg text-blue-100 max-w-2xl mx-auto leading-8">
                        Explore practical AI education designed to help you understand
                        the technology, build with it, and apply it with confidence.
                    </p>

                    <div class="mt-9 flex flex-wrap justify-center gap-4">

                        <a href="{{ route('ai.onboarding.step', ['step' => 1]) }}"
                           class="inline-flex items-center justify-center px-7 py-3.5 rounded-lg bg-[#C90000] text-white font-semibold hover:bg-[#A90000] transition">
                            Start Learning
                        </a>

                        <a href="{{ route('contactus') }}"
                           class="inline-flex items-center justify-center px-7 py-3.5 rounded-lg border border-white/30 text-white font-semibold hover:bg-white/10 transition">
                            Partner with us
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
         SCROLL REVEAL + IMAGE ROTATOR
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /*
             * ----------------------------------------------------
             * SCROLL REVEAL
             * ----------------------------------------------------
             */

            const revealElements = document.querySelectorAll(
                '.ml-reveal, .ml-reveal-left, .ml-reveal-right, .ml-image-reveal'
            );

            if ('IntersectionObserver' in window) {

                const revealObserver = new IntersectionObserver(
                    function (entries, observer) {

                        entries.forEach(function (entry) {

                            if (entry.isIntersecting) {

                                entry.target.classList.add('ml-visible');

                                observer.unobserve(entry.target);
                            }

                        });

                    },
                    {
                        threshold: 0.12,
                        rootMargin: '0px 0px -40px 0px'
                    }
                );

                revealElements.forEach(function (element) {
                    revealObserver.observe(element);
                });

            } else {

                revealElements.forEach(function (element) {
                    element.classList.add('ml-visible');
                });

            }


            /*
             * ----------------------------------------------------
             * HERO IMAGE ROTATOR
             * ----------------------------------------------------
             */

            const slides = document.querySelectorAll('.ml-image-slide');

            if (!slides.length) {
                return;
            }

            let currentSlide = 0;

            setInterval(function () {

                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');

                currentSlide = (currentSlide + 1) % slides.length;

                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');

            }, 5000);

        });
    </script>

@endsection