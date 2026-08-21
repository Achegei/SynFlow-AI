@extends('layouts.public')

@section('title', 'Services - MooseLoon AI Academy')

@section('content')

{{-- ================================================================
     HERO
================================================================ --}}

<section class="relative overflow-hidden bg-[#0B1F3A]">

    {{-- Subtle background structure --}}
    <div class="absolute inset-0 pointer-events-none">

        <div
            class="absolute inset-y-0 right-0 w-1/2 bg-white/[0.015]
                   hero-bg-right"
        ></div>

        <div
            class="absolute top-0 right-0 h-px w-1/2 bg-white/10"
        ></div>

        <div
            class="absolute bottom-0 left-0 right-0 h-px bg-white/10"
        ></div>

        {{-- Very subtle ambient light --}}
        <div
            class="absolute
                   -top-40
                   right-10
                   h-80
                   w-80
                   rounded-full
                   bg-[#1E73BE]/10
                   blur-3xl
                   hero-glow"
        ></div>

        <div
            class="absolute
                   -bottom-40
                   left-10
                   h-72
                   w-72
                   rounded-full
                   bg-[#E31837]/5
                   blur-3xl
                   hero-glow hero-glow-delay"
        ></div>

    </div>


    <div
        class="relative
               max-w-7xl
               mx-auto
               px-4
               sm:px-6
               lg:px-8
               py-16
               sm:py-20
               lg:py-24"
    >

        <div
            class="grid
                   grid-cols-1
                   lg:grid-cols-[0.9fr_1.1fr]
                   gap-12
                   lg:gap-20
                   items-center"
        >

            {{-- ====================================================
                 LEFT — EDITORIAL INTRODUCTION
            ===================================================== --}}

            <div class="max-w-xl hero-intro">

                <div
                    class="flex
                           items-center
                           gap-3
                           text-xs
                           sm:text-sm
                           font-semibold
                           uppercase
                           tracking-[0.16em]
                           text-blue-200
                           hero-item"
                >

                    <span class="h-px w-10 bg-[#E31837]"></span>

                    MooseLoon AI Academy

                </div>


                <h1
                    class="mt-7
                           text-4xl
                           sm:text-5xl
                           lg:text-[3.4rem]
                           font-bold
                           leading-[1.08]
                           tracking-tight
                           text-white
                           hero-item"
                >
                    Practical education
                    <span class="text-blue-300">
                        for modern AI.
                    </span>
                </h1>


                <p
                    class="mt-6
                           max-w-lg
                           text-base
                           sm:text-lg
                           leading-8
                           text-slate-300
                           hero-item"
                >
                    We train students, professionals, and organizations to
                    understand AI, build intelligent systems, and apply
                    automation to real-world work.
                </p>


                <div
                    class="mt-8
                           flex
                           flex-wrap
                           items-center
                           gap-4
                           hero-item"
                >

                    <a
                        href="{{ route('contact') }}"
                        class="inline-flex
                               items-center
                               justify-center
                               rounded-full
                               bg-white
                               px-7
                               py-3.5
                               text-sm
                               font-bold
                               text-[#0B1F3A]
                               shadow-lg
                               hover:-translate-y-1
                               hover:shadow-xl
                               transition-all
                               duration-300"
                    >
                        Enroll or Book Consultation
                    </a>


                    <a
                        href="#programs"
                        class="inline-flex
                               items-center
                               justify-center
                               rounded-full
                               border
                               border-white/20
                               px-7
                               py-3.5
                               text-sm
                               font-semibold
                               text-white
                               hover:bg-white/10
                               hover:border-white/30
                               hover:-translate-y-0.5
                               transition-all
                               duration-300"
                    >
                        Explore Programs
                    </a>

                </div>


                <div
                    class="mt-9
                           flex
                           flex-wrap
                           gap-x-6
                           gap-y-2
                           text-xs
                           sm:text-sm
                           text-blue-200/70
                           hero-item"
                >

                    <span>AI Education</span>

                    <span class="text-white/20">•</span>

                    <span>Automation</span>

                    <span class="text-white/20">•</span>

                    <span>AI Agents</span>

                    <span class="text-white/20">•</span>

                    <span>Career Skills</span>

                </div>

            </div>


            {{-- ====================================================
                 RIGHT — PROGRAM OVERVIEW PANEL
            ===================================================== --}}

            <div class="relative hero-panel-wrapper">

                <div
                    class="relative
                           rounded-2xl
                           border
                           border-white/10
                           bg-white/[0.045]
                           p-5
                           sm:p-7
                           backdrop-blur-sm
                           hero-panel"
                >

                    <div
                        class="flex
                               items-center
                               justify-between
                               pb-5
                               border-b
                               border-white/10"
                    >

                        <div>

                            <p
                                class="text-xs
                                       uppercase
                                       tracking-[0.16em]
                                       font-semibold
                                       text-blue-200/70"
                            >
                                Areas of learning
                            </p>

                            <p
                                class="mt-1
                                       text-sm
                                       text-white/80"
                            >
                                From fundamentals to implementation
                            </p>

                        </div>


                        <div
                            class="text-xs
                                   font-semibold
                                   text-white/40"
                        >
                            01 — 06
                        </div>

                    </div>


                    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">


                        {{-- ITEM 01 --}}
                        <div
                            class="hero-learning-card
                                   group
                                   rounded-xl
                                   border
                                   border-white/10
                                   bg-white/[0.035]
                                   p-5
                                   hover:bg-white/[0.07]
                                   hover:border-white/20
                                   hover:-translate-y-1
                                   transition-all
                                   duration-500"
                        >

                            <div
                                class="text-xs
                                       font-semibold
                                       tracking-widest
                                       text-[#E31837]"
                            >
                                01
                            </div>

                            <h3
                                class="mt-4
                                       font-semibold
                                       text-white"
                            >
                                AI Agents
                            </h3>

                            <p
                                class="mt-2
                                       text-sm
                                       leading-6
                                       text-slate-400"
                            >
                                Intelligent assistants and agentic systems.
                            </p>

                        </div>


                        {{-- ITEM 02 --}}
                        <div
                            class="hero-learning-card
                                   group
                                   rounded-xl
                                   border
                                   border-white/10
                                   bg-white/[0.035]
                                   p-5
                                   hover:bg-white/[0.07]
                                   hover:border-white/20
                                   hover:-translate-y-1
                                   transition-all
                                   duration-500"
                        >

                            <div
                                class="text-xs
                                       font-semibold
                                       tracking-widest
                                       text-[#E31837]"
                            >
                                02
                            </div>

                            <h3
                                class="mt-4
                                       font-semibold
                                       text-white"
                            >
                                Automation
                            </h3>

                            <p
                                class="mt-2
                                       text-sm
                                       leading-6
                                       text-slate-400"
                            >
                                Workflows that connect tools and processes.
                            </p>

                        </div>


                        {{-- ITEM 03 --}}
                        <div
                            class="hero-learning-card
                                   group
                                   rounded-xl
                                   border
                                   border-white/10
                                   bg-white/[0.035]
                                   p-5
                                   hover:bg-white/[0.07]
                                   hover:border-white/20
                                   hover:-translate-y-1
                                   transition-all
                                   duration-500"
                        >

                            <div
                                class="text-xs
                                       font-semibold
                                       tracking-widest
                                       text-[#E31837]"
                            >
                                03
                            </div>

                            <h3
                                class="mt-4
                                       font-semibold
                                       text-white"
                            >
                                AI Development
                            </h3>

                            <p
                                class="mt-2
                                       text-sm
                                       leading-6
                                       text-slate-400"
                            >
                                Build useful applications around AI.
                            </p>

                        </div>


                        {{-- ITEM 04 --}}
                        <div
                            class="hero-learning-card
                                   group
                                   rounded-xl
                                   border
                                   border-white/10
                                   bg-white/[0.035]
                                   p-5
                                   hover:bg-white/[0.07]
                                   hover:border-white/20
                                   hover:-translate-y-1
                                   transition-all
                                   duration-500"
                        >

                            <div
                                class="text-xs
                                       font-semibold
                                       tracking-widest
                                       text-[#E31837]"
                            >
                                04
                            </div>

                            <h3
                                class="mt-4
                                       font-semibold
                                       text-white"
                            >
                                Prompt Engineering
                            </h3>

                            <p
                                class="mt-2
                                       text-sm
                                       leading-6
                                       text-slate-400"
                            >
                                Work effectively with modern AI models.
                            </p>

                        </div>


                        {{-- ITEM 05 --}}
                        <div
                            class="hero-learning-card
                                   group
                                   rounded-xl
                                   border
                                   border-white/10
                                   bg-white/[0.035]
                                   p-5
                                   hover:bg-white/[0.07]
                                   hover:border-white/20
                                   hover:-translate-y-1
                                   transition-all
                                   duration-500"
                        >

                            <div
                                class="text-xs
                                       font-semibold
                                       tracking-widest
                                       text-[#E31837]"
                            >
                                05
                            </div>

                            <h3
                                class="mt-4
                                       font-semibold
                                       text-white"
                            >
                                APIs & Integrations
                            </h3>

                            <p
                                class="mt-2
                                       text-sm
                                       leading-6
                                       text-slate-400"
                            >
                                Connect applications and intelligent services.
                            </p>

                        </div>


                        {{-- ITEM 06 --}}
                        <div
                            class="hero-learning-card
                                   group
                                   rounded-xl
                                   border
                                   border-white/10
                                   bg-white/[0.035]
                                   p-5
                                   hover:bg-white/[0.07]
                                   hover:border-white/20
                                   hover:-translate-y-1
                                   transition-all
                                   duration-500"
                        >

                            <div
                                class="text-xs
                                       font-semibold
                                       tracking-widest
                                       text-[#E31837]"
                            >
                                06
                            </div>

                            <h3
                                class="mt-4
                                       font-semibold
                                       text-white"
                            >
                                Career Skills
                            </h3>

                            <p
                                class="mt-2
                                       text-sm
                                       leading-6
                                       text-slate-400"
                            >
                                Turn practical AI knowledge into opportunity.
                            </p>

                        </div>

                    </div>


                    <div
                        class="mt-5
                               flex
                               items-center
                               justify-between
                               border-t
                               border-white/10
                               pt-5"
                    >

                        <p
                            class="text-xs
                                   sm:text-sm
                                   text-slate-400"
                        >
                            Learn. Build. Apply.
                        </p>

                        <p
                            class="text-xs
                                   font-semibold
                                   text-blue-200/60"
                        >
                            Practical learning
                        </p>

                    </div>

                </div>


                {{-- Floating badge --}}
                <div
                    class="absolute
                           -bottom-5
                           -left-4
                           sm:-left-6
                           rounded-lg
                           border
                           border-white/10
                           bg-[#102B4D]
                           px-4
                           py-3
                           shadow-xl
                           hero-badge"
                >

                    <p
                        class="text-[10px]
                               uppercase
                               tracking-[0.15em]
                               font-semibold
                               text-blue-200/60"
                    >
                        Canadian AI Education
                    </p>

                    <p
                        class="mt-1
                               text-sm
                               font-semibold
                               text-white"
                    >
                        Built for practical application
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ================================================================
     HERO + SCROLL ANIMATIONS
================================================================ --}}

<style>

    /* ------------------------------------------------------------
       Hero entrance
    ------------------------------------------------------------ */

    .hero-item {
        opacity: 0;
        transform: translateY(18px);
        animation: heroFadeUp 0.75s cubic-bezier(.22,1,.36,1) forwards;
    }

    .hero-item:nth-child(1) {
        animation-delay: 100ms;
    }

    .hero-item:nth-child(2) {
        animation-delay: 220ms;
    }

    .hero-item:nth-child(3) {
        animation-delay: 340ms;
    }

    .hero-item:nth-child(4) {
        animation-delay: 460ms;
    }

    .hero-item:nth-child(5) {
        animation-delay: 580ms;
    }


    @keyframes heroFadeUp {

        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    /* ------------------------------------------------------------
       Hero panel entrance
    ------------------------------------------------------------ */

    .hero-panel-wrapper {
        opacity: 0;
        transform: translateX(28px);
        animation: heroPanelIn 0.9s cubic-bezier(.22,1,.36,1) 250ms forwards;
    }


    @keyframes heroPanelIn {

        from {
            opacity: 0;
            transform: translateX(28px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }

    }


    /* ------------------------------------------------------------
       Gentle panel floating
    ------------------------------------------------------------ */

    .hero-panel {
        animation:
            heroPanelFloat 7s ease-in-out 1.2s infinite;
    }


    @keyframes heroPanelFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }

    }


    /* ------------------------------------------------------------
       Learning cards staggered entrance
    ------------------------------------------------------------ */

    .hero-learning-card {
        opacity: 0;
        transform: translateY(12px);
        animation: heroCardIn 0.65s cubic-bezier(.22,1,.36,1) forwards;
    }

    .hero-learning-card:nth-child(1) {
        animation-delay: 550ms;
    }

    .hero-learning-card:nth-child(2) {
        animation-delay: 650ms;
    }

    .hero-learning-card:nth-child(3) {
        animation-delay: 750ms;
    }

    .hero-learning-card:nth-child(4) {
        animation-delay: 850ms;
    }

    .hero-learning-card:nth-child(5) {
        animation-delay: 950ms;
    }

    .hero-learning-card:nth-child(6) {
        animation-delay: 1050ms;
    }


    @keyframes heroCardIn {

        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    /* ------------------------------------------------------------
       Floating badge
    ------------------------------------------------------------ */

    .hero-badge {
        animation: badgeFloat 5s ease-in-out 1.3s infinite;
    }


    @keyframes badgeFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-4px);
        }

    }


    /* ------------------------------------------------------------
       Background ambient movement
    ------------------------------------------------------------ */

    .hero-glow {
        animation: glowMove 10s ease-in-out infinite;
    }

    .hero-glow-delay {
        animation-delay: -5s;
    }


    @keyframes glowMove {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
            opacity: .65;
        }

        50% {
            transform: translate(-18px, 12px) scale(1.06);
            opacity: .9;
        }

    }


    /* ------------------------------------------------------------
       Right-side subtle movement
    ------------------------------------------------------------ */

    .hero-bg-right {
        animation: backgroundShift 12s ease-in-out infinite;
    }


    @keyframes backgroundShift {

        0%,
        100% {
            opacity: .65;
        }

        50% {
            opacity: 1;
        }

    }


    /* ------------------------------------------------------------
       Scroll reveal
    ------------------------------------------------------------ */

    .scroll-reveal {
        opacity: 0;
        transform: translateY(28px);
        transition:
            opacity .8s cubic-bezier(.22,1,.36,1),
            transform .8s cubic-bezier(.22,1,.36,1);
    }

    .scroll-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }


    /* ------------------------------------------------------------
       Reduced motion accessibility
    ------------------------------------------------------------ */

    @media (prefers-reduced-motion: reduce) {

        .hero-item,
        .hero-panel-wrapper,
        .hero-learning-card,
        .hero-panel,
        .hero-badge,
        .hero-glow,
        .hero-bg-right {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }

        .scroll-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }

    }

</style>


{{-- ================================================================
     WHAT WE OFFER
================================================================ --}}

<section class="bg-[#F7FAFC] py-20 sm:py-24">

    <div
        class="max-w-7xl
               mx-auto
               px-4
               sm:px-6
               lg:px-8"
    >

        <div
            class="max-w-3xl
                   mx-auto
                   text-center
                   mb-16
                   sm:mb-20
                   scroll-reveal"
        >

            <div
                class="inline-flex
                       items-center
                       gap-2
                       text-[#E31837]
                       font-bold
                       text-xs
                       uppercase
                       tracking-[0.18em]"
            >

                <span class="h-px w-8 bg-[#E31837]"></span>

                What We Offer

                <span class="h-px w-8 bg-[#E31837]"></span>

            </div>


            <h2
                class="mt-5
                       text-3xl
                       sm:text-4xl
                       lg:text-5xl
                       font-extrabold
                       tracking-tight
                       text-[#0B1F3A]"
            >
                Industry-Focused AI Training & Automation
            </h2>


            <p
                class="mt-6
                       text-base
                       sm:text-lg
                       leading-relaxed
                       text-slate-600"
            >
                Our programs are designed for practical implementation —
                helping learners and businesses use AI tools, automation systems,
                and intelligent workflows effectively.
            </p>

        </div>


        <div
            id="programs"
            class="grid
                   grid-cols-1
                   md:grid-cols-2
                   xl:grid-cols-3
                   gap-7
                   lg:gap-8"
        >


            {{-- ====================================================
                 CARD 1
            ===================================================== --}}

            <div
                class="service-card
                       group
                       relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-slate-200
                       bg-white
                       p-8
                       shadow-[0_8px_30px_rgba(11,31,58,0.06)]
                       hover:-translate-y-2
                       hover:border-[#1E73BE]/30
                       hover:shadow-[0_20px_45px_rgba(11,31,58,0.12)]
                       transition-all
                       duration-500
                       scroll-reveal"
            >

                <div
                    class="absolute
                           -top-10
                           -right-10
                           h-32
                           w-32
                           rounded-full
                           bg-[#1E73BE]/10
                           blur-3xl"
                ></div>

                <div class="relative">

                    <h3 class="text-2xl font-extrabold text-[#0B1F3A]">
                        AI Agents & Workflow Automation
                    </h3>

                    <p class="mt-4 leading-relaxed text-slate-600">
                        Learn how to build intelligent AI agents and automated
                        systems using modern no-code and low-code tools.
                    </p>

                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li>AI Agents & Assistants</li>
                        <li>n8n Workflow Automation</li>
                        <li>Webhooks & APIs</li>
                    </ul>

                </div>

            </div>


            {{-- ====================================================
                 CARD 2
            ===================================================== --}}

            <div
                class="service-card
                       group
                       relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-slate-200
                       bg-white
                       p-8
                       shadow-[0_8px_30px_rgba(11,31,58,0.06)]
                       hover:-translate-y-2
                       hover:border-[#1E73BE]/30
                       hover:shadow-[0_20px_45px_rgba(11,31,58,0.12)]
                       transition-all
                       duration-500
                       scroll-reveal"
            >

                <div
                    class="absolute
                           -bottom-10
                           -left-10
                           h-32
                           w-32
                           rounded-full
                           bg-[#1E73BE]/10
                           blur-3xl"
                ></div>

                <div class="relative">

                    <h3 class="text-2xl font-extrabold text-[#0B1F3A]">
                        AI Certification Programs
                    </h3>

                    <p class="mt-4 leading-relaxed text-slate-600">
                        Structured certification programs designed to equip
                        learners with practical and employable AI skills.
                    </p>

                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li>Prompt Engineering</li>
                        <li>AI Fundamentals</li>
                        <li>Practical AI Projects</li>
                    </ul>

                </div>

            </div>


            {{-- ====================================================
                 CARD 3
            ===================================================== --}}

            <div
                class="service-card
                       group
                       relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-slate-200
                       bg-white
                       p-8
                       shadow-[0_8px_30px_rgba(11,31,58,0.06)]
                       hover:-translate-y-2
                       hover:border-[#E31837]/25
                       hover:shadow-[0_20px_45px_rgba(11,31,58,0.12)]
                       transition-all
                       duration-500
                       scroll-reveal"
            >

                <div
                    class="absolute
                           -top-10
                           -left-10
                           h-32
                           w-32
                           rounded-full
                           bg-[#E31837]/10
                           blur-3xl"
                ></div>

                <div class="relative">

                    <h3 class="text-2xl font-extrabold text-[#0B1F3A]">
                        Business AI Automation
                    </h3>

                    <p class="mt-4 leading-relaxed text-slate-600">
                        Students learn how businesses use AI to automate
                        operations, reduce manual work, and improve efficiency.
                        Our graduates help organizations implement real-world
                        AI systems like customer support and CRM automation.
                    </p>

                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li>Build WhatsApp AI Automation Systems</li>
                        <li>Integrate AI with CRM Platforms</li>
                        <li>Design AI Customer Support Solutions</li>
                    </ul>

                </div>

            </div>


            {{-- ====================================================
                 CARD 4
            ===================================================== --}}

            <div
                class="service-card
                       group
                       relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-slate-200
                       bg-white
                       p-8
                       shadow-[0_8px_30px_rgba(11,31,58,0.06)]
                       hover:-translate-y-2
                       hover:border-[#1E73BE]/30
                       hover:shadow-[0_20px_45px_rgba(11,31,58,0.12)]
                       transition-all
                       duration-500
                       scroll-reveal"
            >

                <div
                    class="absolute
                           -bottom-10
                           -right-10
                           h-32
                           w-32
                           rounded-full
                           bg-[#1E73BE]/10
                           blur-3xl"
                ></div>

                <div class="relative">

                    <h3 class="text-2xl font-extrabold text-[#0B1F3A]">
                        Career & Freelancing Skills
                    </h3>

                    <p class="mt-4 leading-relaxed text-slate-600">
                        Students learn how to turn AI skills into income through
                        freelancing, remote work, and consulting. Our graduates
                        build portfolios and offer AI services to clients and
                        businesses globally.
                    </p>

                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li>Work on Real Client Project Workflows</li>
                        <li>Build a Job-Ready AI Portfolio</li>
                        <li>Package and Sell AI Services Professionally</li>
                    </ul>

                </div>

            </div>


            {{-- ====================================================
                 CARD 5
            ===================================================== --}}

            <div
                class="service-card
                       group
                       relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-slate-200
                       bg-white
                       p-8
                       shadow-[0_8px_30px_rgba(11,31,58,0.06)]
                       hover:-translate-y-2
                       hover:border-[#1E73BE]/30
                       hover:shadow-[0_20px_45px_rgba(11,31,58,0.12)]
                       transition-all
                       duration-500
                       scroll-reveal"
            >

                <div
                    class="absolute
                           -top-10
                           -right-10
                           h-32
                           w-32
                           rounded-full
                           bg-[#1E73BE]/10
                           blur-3xl"
                ></div>

                <div class="relative">

                    <h3 class="text-2xl font-extrabold text-[#0B1F3A]">
                        AI-Powered Websites
                    </h3>

                    <p class="mt-4 leading-relaxed text-slate-600">
                        Students learn how to build modern websites powered by
                        AI systems, automation, and chat assistants. Our graduates
                        create smart websites that help businesses capture leads
                        and engage customers 24/7.
                    </p>

                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li>Build Lead Capture Systems for Real Businesses</li>
                        <li>Integrate AI Chat Assistants into Websites</li>
                        <li>Design Automated Website Workflows</li>
                    </ul>

                </div>

            </div>


            {{-- ====================================================
                 CARD 6
            ===================================================== --}}

            <div
                class="service-card
                       group
                       relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-slate-200
                       bg-white
                       p-8
                       shadow-[0_8px_30px_rgba(11,31,58,0.06)]
                       hover:-translate-y-2
                       hover:border-[#E31837]/25
                       hover:shadow-[0_20px_45px_rgba(11,31,58,0.12)]
                       transition-all
                       duration-500
                       scroll-reveal"
            >

                <div
                    class="absolute
                           -bottom-10
                           -left-10
                           h-32
                           w-32
                           rounded-full
                           bg-[#E31837]/10
                           blur-3xl"
                ></div>

                <div class="relative">

                    <h3 class="text-2xl font-extrabold text-[#0B1F3A]">
                        AI Transformation Consulting
                    </h3>

                    <p class="mt-4 leading-relaxed text-slate-600">
                        Students learn how organizations adopt AI to improve
                        operations and decision-making. Our graduates support
                        businesses and institutions in planning and implementing
                        AI transformation strategies.
                    </p>

                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li>Develop AI Adoption Strategies for Organizations</li>
                        <li>Optimize Business Workflows Using AI Tools</li>
                        <li>Support Institutional AI Training & Implementation</li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ================================================================
     FEATURE / IMPACT STRIP
================================================================ --}}

<section class="relative overflow-hidden bg-[#0B1F3A] py-20">

    <div
        class="absolute
               inset-0
               bg-[radial-gradient(circle_at_center,rgba(30,115,190,0.15),transparent_60%)]"
    ></div>


    <div
        class="relative
               max-w-7xl
               mx-auto
               px-4
               sm:px-6
               lg:px-8"
    >

        <div
            class="grid
                   grid-cols-1
                   md:grid-cols-3
                   gap-10
                   md:gap-6
                   text-center
                   scroll-reveal"
        >

            <div class="relative">

                <h3
                    class="text-5xl
                           sm:text-6xl
                           font-extrabold
                           text-white"
                >
                    17
                </h3>

                <p
                    class="mt-3
                           text-base
                           sm:text-lg
                           text-blue-200"
                >
                    Practical AI Learning Modules
                </p>

            </div>


            <div
                class="relative
                       md:border-l
                       md:border-r
                       md:border-white/10"
            >

                <h3
                    class="text-5xl
                           sm:text-6xl
                           font-extrabold
                           text-white"
                >
                    120+
                </h3>

                <p
                    class="mt-3
                           text-base
                           sm:text-lg
                           text-blue-200"
                >
                    Hours of Hands-On Learning
                </p>

            </div>


            <div class="relative">

                <h3
                    class="text-5xl
                           sm:text-6xl
                           font-extrabold
                           text-white"
                >
                    Real
                </h3>

                <p
                    class="mt-3
                           text-base
                           sm:text-lg
                           text-blue-200"
                >
                    Automation Projects & Deployments
                </p>

            </div>

        </div>

    </div>

</section>


{{-- ================================================================
     CTA
================================================================ --}}

<section
    class="relative
           overflow-hidden
           bg-white
           py-24
           sm:py-28"
>

    <div
        class="absolute
               -top-32
               -left-32
               h-80
               w-80
               rounded-full
               bg-[#1E73BE]/10
               blur-3xl
               cta-glow"
    ></div>


    <div
        class="absolute
               -bottom-32
               -right-32
               h-80
               w-80
               rounded-full
               bg-[#E31837]/10
               blur-3xl
               cta-glow cta-glow-delay"
    ></div>


    <div
        class="relative
               max-w-4xl
               mx-auto
               px-4
               sm:px-6
               text-center
               scroll-reveal"
    >

        <div
            class="inline-flex
                   items-center
                   gap-2
                   text-[#E31837]
                   font-bold
                   text-xs
                   uppercase
                   tracking-[0.18em]"
        >

            <span class="h-px w-8 bg-[#E31837]"></span>

            Start Building

            <span class="h-px w-8 bg-[#E31837]"></span>

        </div>


        <h2
            class="mt-5
                   text-4xl
                   sm:text-5xl
                   font-extrabold
                   tracking-tight
                   text-[#0B1F3A]"
        >
            Start Your AI Journey Today
        </h2>


        <p
            class="mt-6
                   max-w-3xl
                   mx-auto
                   text-base
                   sm:text-lg
                   leading-relaxed
                   text-slate-600"
        >
            Whether you're a student, entrepreneur, institution, or business,
            MooseLoon AI Academy helps you build practical AI skills for the future.
        </p>


        <div class="mt-10">

            <a
                href="{{ route('contact') }}"
                class="inline-flex
                       items-center
                       justify-center
                       rounded-full
                       bg-[#0B1F3A]
                       px-9
                       py-4
                       text-base
                       font-bold
                       text-white
                       shadow-xl
                       hover:bg-[#12345C]
                       hover:-translate-y-1
                       hover:shadow-2xl
                       transition-all
                       duration-300"
            >

                Contact MooseLoon AI Academy

            </a>

        </div>

    </div>

</section>


{{-- ================================================================
     SCROLL REVEAL + FINAL ANIMATIONS
================================================================ --}}

<style>

    .cta-glow {
        animation: ctaGlow 9s ease-in-out infinite;
    }

    .cta-glow-delay {
        animation-delay: -4.5s;
    }

    @keyframes ctaGlow {

        0%,
        100% {
            transform: scale(1);
            opacity: .6;
        }

        50% {
            transform: scale(1.08);
            opacity: .9;
        }

    }


    @media (prefers-reduced-motion: reduce) {

        .cta-glow {
            animation: none !important;
        }

    }

</style>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const revealElements =
            document.querySelectorAll('.scroll-reveal');

        if (!('IntersectionObserver' in window)) {

            revealElements.forEach(function (element) {

                element.classList.add('is-visible');

            });

            return;

        }


        const observer = new IntersectionObserver(
            function (entries, observer) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('is-visible');

                        observer.unobserve(entry.target);

                    }

                });

            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -60px 0px'
            }
        );


        revealElements.forEach(function (element) {

            observer.observe(element);

        });

    });

</script>

@endsection