@extends('layouts.public')

@section('title', 'AI & Automation Curriculum - Moose Loon AI Academy')

@section('content')


{{-- ============================================================
     HERO
============================================================ --}}

<section class="relative overflow-hidden bg-[#0B1F3A]">

    {{-- Background structure --}}
    <div class="absolute inset-0 pointer-events-none">

        <div class="absolute inset-y-0 right-0 w-1/2 bg-white/[0.018]"></div>

        <div class="absolute top-0 right-0 h-px w-1/2 bg-white/10"></div>

        <div class="absolute bottom-0 left-0 right-0 h-px bg-white/10"></div>

        <div class="absolute top-0 left-[12%] h-full w-px bg-white/[0.025]"></div>

        <div class="absolute top-0 right-[18%] h-full w-px bg-white/[0.025]"></div>

    </div>


    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">

        <div class="grid grid-cols-1 lg:grid-cols-[0.92fr_1.08fr] gap-12 lg:gap-20 items-center">


            {{-- ====================================================
                 LEFT — EDITORIAL INTRODUCTION
            ===================================================== --}}

            <div class="hero-fade-up max-w-xl">

                <div class="flex items-center gap-3
                            text-xs sm:text-sm
                            font-semibold
                            uppercase
                            tracking-[0.16em]
                            text-blue-200">

                    <span class="h-px w-10 bg-[#E31837]"></span>

                    Moose Loon AI Academy

                </div>


                <h1 class="mt-7
                           text-[2.7rem]
                           sm:text-5xl
                           lg:text-[3.45rem]
                           font-bold
                           leading-[1.08]
                           tracking-tight
                           text-white">

                    Certificate in
                    <span class="block text-blue-300">
                        Artificial Intelligence
                    </span>
                    <span class="block text-white">
                        & Automation Systems
                    </span>

                </h1>


                <p class="mt-7
                          text-lg
                          sm:text-xl
                          font-medium
                          text-white/85
                          leading-relaxed">

                    AI & Workflow Automation

                </p>


                <p class="mt-5
                          max-w-lg
                          text-base
                          sm:text-lg
                          leading-8
                          text-slate-300">

                    Build practical skills in Artificial Intelligence, AI agents,
                    workflow automation, APIs, intelligent systems, WhatsApp AI,
                    voice AI, agentic workflows, and real-world AI deployment.

                </p>


                {{-- Program facts --}}
                <div class="mt-8 flex flex-wrap gap-x-6 gap-y-3
                            text-xs sm:text-sm
                            text-blue-100/70">

                    <span>17 Structured Modules</span>

                    <span class="text-white/20">•</span>

                    <span>Practical Learning</span>

                    <span class="text-white/20">•</span>

                    <span>Real-World Projects</span>

                    <span class="text-white/20">•</span>

                    <span>Career & Business Skills</span>

                </div>


                {{-- CTA --}}
                <div class="mt-9 flex flex-wrap items-center gap-4">

                    <a href="{{ route('contactus') }}"
                       class="inline-flex items-center justify-center
                              rounded-full
                              bg-white
                              px-7 py-3.5
                              text-sm
                              font-bold
                              text-[#0B1F3A]
                              shadow-lg
                              hover:-translate-y-0.5
                              hover:shadow-xl
                              transition-all
                              duration-300">

                        Make an Enquiry

                    </a>


                    <a href="#curriculum"
                       class="inline-flex items-center justify-center
                              rounded-full
                              border
                              border-white/20
                              px-7 py-3.5
                              text-sm
                              font-semibold
                              text-white
                              hover:bg-white/10
                              hover:border-white/30
                              transition-all
                              duration-300">

                        Explore Curriculum

                    </a>

                </div>


                <p class="mt-6 text-xs sm:text-sm text-slate-400">

                    Want to know the program investment,
                    enrollment process, or certification requirements?

                    <a href="{{ route('contactus') }}"
                       class="font-semibold text-blue-200 hover:text-white transition-colors">

                        Contact our team.

                    </a>

                </p>

            </div>


            {{-- ====================================================
                 RIGHT — PROGRAM STRUCTURE PANEL
            ===================================================== --}}

            <div class="hero-panel-in relative">

                <div class="relative
                            rounded-2xl
                            border border-white/10
                            bg-white/[0.045]
                            p-5 sm:p-7
                            backdrop-blur-sm">

                    {{-- Header --}}
                    <div class="flex items-center justify-between
                                pb-5
                                border-b border-white/10">

                        <div>

                            <p class="text-xs
                                      uppercase
                                      tracking-[0.16em]
                                      font-semibold
                                      text-blue-200/70">

                                Program Structure

                            </p>

                            <p class="mt-1 text-sm text-white/80">

                                From foundations to deployment

                            </p>

                        </div>


                        <div class="text-xs font-semibold text-white/40">

                            01 — 17

                        </div>

                    </div>


                    {{-- Learning pathway --}}
                    <div class="mt-5 space-y-2">


                        {{-- ITEM 01 --}}
                        <div class="hero-module-card
                                    flex items-center gap-4
                                    rounded-xl
                                    border border-white/10
                                    bg-white/[0.035]
                                    px-4 py-4
                                    hover:bg-white/[0.07]
                                    hover:border-white/20
                                    transition-all duration-300">

                            <div class="w-9 shrink-0
                                        text-xs
                                        font-bold
                                        tracking-widest
                                        text-[#E31837]">

                                01

                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-white">
                                    AI Foundations
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Concepts, industry context & business applications
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 02 --}}
                        <div class="hero-module-card
                                    flex items-center gap-4
                                    rounded-xl
                                    border border-white/10
                                    bg-white/[0.035]
                                    px-4 py-4
                                    hover:bg-white/[0.07]
                                    hover:border-white/20
                                    transition-all duration-300">

                            <div class="w-9 shrink-0
                                        text-xs
                                        font-bold
                                        tracking-widest
                                        text-[#E31837]">

                                02

                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-white">
                                    Prompt Engineering
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Structured communication with modern AI systems
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 03 --}}
                        <div class="hero-module-card
                                    flex items-center gap-4
                                    rounded-xl
                                    border border-white/10
                                    bg-white/[0.035]
                                    px-4 py-4
                                    hover:bg-white/[0.07]
                                    hover:border-white/20
                                    transition-all duration-300">

                            <div class="w-9 shrink-0
                                        text-xs
                                        font-bold
                                        tracking-widest
                                        text-[#E31837]">

                                03

                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-white">
                                    Automation & APIs
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    n8n, webhooks, APIs and system integrations
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 04 --}}
                        <div class="hero-module-card
                                    flex items-center gap-4
                                    rounded-xl
                                    border border-white/10
                                    bg-white/[0.035]
                                    px-4 py-4
                                    hover:bg-white/[0.07]
                                    hover:border-white/20
                                    transition-all duration-300">

                            <div class="w-9 shrink-0
                                        text-xs
                                        font-bold
                                        tracking-widest
                                        text-[#E31837]">

                                04

                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-white">
                                    AI Agents
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Chat, WhatsApp, voice and outbound agents
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 05 --}}
                        <div class="hero-module-card
                                    flex items-center gap-4
                                    rounded-xl
                                    border border-white/10
                                    bg-white/[0.035]
                                    px-4 py-4
                                    hover:bg-white/[0.07]
                                    hover:border-white/20
                                    transition-all duration-300">

                            <div class="w-9 shrink-0
                                        text-xs
                                        font-bold
                                        tracking-widest
                                        text-[#E31837]">

                                05

                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-white">
                                    Agentic Workflows
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Intelligent systems that reason, connect and act
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 06 --}}
                        <div class="hero-module-card
                                    flex items-center gap-4
                                    rounded-xl
                                    border border-white/10
                                    bg-white/[0.035]
                                    px-4 py-4
                                    hover:bg-white/[0.07]
                                    hover:border-white/20
                                    transition-all duration-300">

                            <div class="w-9 shrink-0
                                        text-xs
                                        font-bold
                                        tracking-widest
                                        text-[#E31837]">

                                06

                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-white">
                                    Projects & Commercial Skills
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Build, price and take solutions to market
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Bottom information --}}
                    <div class="mt-5
                                flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-3
                                border-t border-white/10
                                pt-5">

                        <p class="text-xs sm:text-sm text-slate-400">

                            Learn. Build. Deploy.

                        </p>

                        <p class="text-xs font-semibold text-blue-200/60">

                            Practical AI education

                        </p>

                    </div>

                </div>


                {{-- Floating label --}}
                <div class="absolute
                            -bottom-5
                            -left-4
                            sm:-left-6
                            rounded-lg
                            border border-white/10
                            bg-[#102B4D]
                            px-4 py-3
                            shadow-xl">

                    <p class="text-[10px]
                              uppercase
                              tracking-[0.15em]
                              font-semibold
                              text-blue-200/60">

                        Professional Certificate

                    </p>

                    <p class="mt-1 text-sm font-semibold text-white">

                        Built for practical application

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
     PROGRAM OVERVIEW
============================================================ --}}

<section class="py-20 sm:py-24 bg-[#F7FAFC]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">


            {{-- TEXT --}}

            <div class="scroll-reveal">

                <div class="inline-flex items-center gap-2
                            text-[#E31837]
                            font-bold
                            text-xs
                            uppercase
                            tracking-[0.18em]">

                    <span class="h-px w-8 bg-[#E31837]"></span>

                    Program Overview

                </div>


                <h2 class="mt-5
                           text-3xl
                           sm:text-4xl
                           lg:text-5xl
                           font-extrabold
                           tracking-tight
                           text-[#0B1F3A]
                           leading-tight">

                    Learn AI Beyond Theory

                </h2>


                <p class="mt-6 text-lg text-slate-600 leading-relaxed">

                    The Certificate in Artificial Intelligence & Automation
                    Systems is designed to provide learners with comprehensive
                    knowledge and practical skills in Artificial Intelligence,
                    automation, and intelligent systems.

                </p>


                <p class="mt-5 text-lg text-slate-600 leading-relaxed">

                    The program focuses on real-world applications, enabling
                    learners to design, build, integrate, and deploy
                    AI-driven solutions for modern business environments.

                </p>


                <p class="mt-5 text-lg text-slate-600 leading-relaxed">

                    Learners progressively move from understanding AI concepts
                    and prompt engineering to building automation workflows,
                    AI chat agents, WhatsApp agents, voice systems, outbound
                    calling agents, and agentic workflows.

                </p>


                <div class="mt-9 space-y-4">

                    <div class="flex items-start gap-3">

                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#E31837]"></span>

                        <p class="text-slate-700">
                            Understand Artificial Intelligence and its business applications
                        </p>

                    </div>


                    <div class="flex items-start gap-3">

                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#E31837]"></span>

                        <p class="text-slate-700">
                            Build AI-powered automation workflows using modern tools
                        </p>

                    </div>


                    <div class="flex items-start gap-3">

                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#E31837]"></span>

                        <p class="text-slate-700">
                            Integrate APIs, webhooks, AI models, and third-party services
                        </p>

                    </div>


                    <div class="flex items-start gap-3">

                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#E31837]"></span>

                        <p class="text-slate-700">
                            Develop AI agents for real-world business use cases
                        </p>

                    </div>


                    <div class="flex items-start gap-3">

                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#E31837]"></span>

                        <p class="text-slate-700">
                            Learn how to price, package, and sell AI automation solutions
                        </p>

                    </div>

                </div>

            </div>


            {{-- STATS --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                <div class="stat-card bg-white rounded-2xl p-7
                            border border-slate-200
                            shadow-[0_8px_30px_rgba(11,31,58,0.05)]
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="text-4xl font-extrabold text-[#1E73BE]">
                        17
                    </div>

                    <p class="mt-3 text-slate-700 font-semibold">
                        Structured Learning Modules
                    </p>

                </div>


                <div class="stat-card bg-white rounded-2xl p-7
                            border border-slate-200
                            shadow-[0_8px_30px_rgba(11,31,58,0.05)]
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="text-4xl font-extrabold text-[#0B1F3A]">
                        AI
                    </div>

                    <p class="mt-3 text-slate-700 font-semibold">
                        Artificial Intelligence & Intelligent Systems
                    </p>

                </div>


                <div class="stat-card bg-white rounded-2xl p-7
                            border border-slate-200
                            shadow-[0_8px_30px_rgba(11,31,58,0.05)]
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="text-4xl font-extrabold text-[#E31837]">
                        100%
                    </div>

                    <p class="mt-3 text-slate-700 font-semibold">
                        Practical & Application-Focused
                    </p>

                </div>


                <div class="stat-card bg-white rounded-2xl p-7
                            border border-slate-200
                            shadow-[0_8px_30px_rgba(11,31,58,0.05)]
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="text-4xl font-extrabold text-[#1E73BE]">
                        Real
                    </div>

                    <p class="mt-3 text-slate-700 font-semibold">
                        Business Projects & AI Deployments
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
     WHAT YOU WILL LEARN
============================================================ --}}

<section class="py-20 sm:py-24 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl mb-14 scroll-reveal">

            <div class="flex items-center gap-3
                        text-[#E31837]
                        font-bold
                        text-xs
                        uppercase
                        tracking-[0.18em]">

                <span class="h-px w-8 bg-[#E31837]"></span>

                What You Will Learn

            </div>


            <h2 class="mt-5
                       text-3xl
                       sm:text-4xl
                       lg:text-5xl
                       font-extrabold
                       text-[#0B1F3A]
                       tracking-tight">

                From AI Foundations to Intelligent Automation

            </h2>


            <p class="mt-6 text-lg text-slate-600 leading-relaxed">

                The curriculum is structured to progressively develop
                technical, practical, commercial, and problem-solving
                capabilities.

            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">


            <div class="content-card scroll-reveal
                        bg-[#F7FAFC]
                        rounded-2xl
                        p-7
                        border border-slate-200
                        hover:-translate-y-1
                        hover:shadow-lg
                        transition-all duration-300">

                <div class="text-xs font-bold tracking-widest text-[#E31837]">
                    01
                </div>

                <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                    AI Foundations
                </h3>

                <p class="mt-3 text-slate-600 leading-relaxed">
                    Understand AI concepts, capabilities, history,
                    industry adoption, and emerging technologies.
                </p>

            </div>


            <div class="content-card scroll-reveal
                        bg-[#F7FAFC]
                        rounded-2xl
                        p-7
                        border border-slate-200
                        hover:-translate-y-1
                        hover:shadow-lg
                        transition-all duration-300">

                <div class="text-xs font-bold tracking-widest text-[#E31837]">
                    02
                </div>

                <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                    Automation
                </h3>

                <p class="mt-3 text-slate-600 leading-relaxed">
                    Build automated workflows and connect business
                    systems using n8n, APIs, webhooks, and integrations.
                </p>

            </div>


            <div class="content-card scroll-reveal
                        bg-[#F7FAFC]
                        rounded-2xl
                        p-7
                        border border-slate-200
                        hover:-translate-y-1
                        hover:shadow-lg
                        transition-all duration-300">

                <div class="text-xs font-bold tracking-widest text-[#E31837]">
                    03
                </div>

                <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                    AI Agents
                </h3>

                <p class="mt-3 text-slate-600 leading-relaxed">
                    Create intelligent chat agents, WhatsApp agents,
                    voice receptionists, outbound agents, and agentic systems.
                </p>

            </div>


            <div class="content-card scroll-reveal
                        bg-[#F7FAFC]
                        rounded-2xl
                        p-7
                        border border-slate-200
                        hover:-translate-y-1
                        hover:shadow-lg
                        transition-all duration-300">

                <div class="text-xs font-bold tracking-widest text-[#E31837]">
                    04
                </div>

                <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                    AI Business Skills
                </h3>

                <p class="mt-3 text-slate-600 leading-relaxed">
                    Learn how to price AI systems, identify opportunities,
                    acquire clients, and deliver automation solutions.
                </p>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
     CURRICULUM
============================================================ --}}

<section id="curriculum" class="py-20 sm:py-24 bg-[#F7FAFC]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl mb-14 scroll-reveal">

            <div class="flex items-center gap-3
                        text-[#E31837]
                        font-bold
                        text-xs
                        uppercase
                        tracking-[0.18em]">

                <span class="h-px w-8 bg-[#E31837]"></span>

                Detailed Curriculum

            </div>


            <h2 class="mt-5
                       text-3xl
                       sm:text-4xl
                       lg:text-5xl
                       font-extrabold
                       text-[#0B1F3A]
                       tracking-tight">

                17 Modules. One Practical AI Journey.

            </h2>


            <p class="mt-6 text-lg text-slate-600 leading-relaxed">

                Each module builds toward the ability to design,
                develop, deploy, and commercialize AI automation systems.

            </p>

        </div>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-7">


            {{-- MODULE 1 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 01
                </div>

                <h3 class="module-title">
                    Introduction to AI & Industry Context
                </h3>

                <ul class="module-list">

                    <li>Definition and core concepts of Artificial Intelligence</li>
                    <li>Learning, reasoning, perception, and language processing</li>
                    <li>Narrow AI, General AI, and Superintelligent AI</li>
                    <li>History and evolution of AI</li>
                    <li>Data, compute, and Large Language Models</li>
                    <li>Business impact of AI across industries</li>
                    <li>AI agents, automation, and multimodal systems</li>
                    <li>Global adoption and job-market relevance</li>

                </ul>

            </div>


            {{-- MODULE 2 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 02
                </div>

                <h3 class="module-title">
                    Understanding AI in Business
                </h3>

                <ul class="module-list">

                    <li>AI in Sales</li>
                    <li>AI in Marketing</li>
                    <li>AI in Customer Experience</li>
                    <li>AI in Business Operations</li>
                    <li>AI Agents and Automation</li>
                    <li>WhatsApp AI integration</li>
                    <li>Real-world business AI use cases</li>

                </ul>

            </div>


            {{-- MODULE 3 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 03
                </div>

                <h3 class="module-title">
                    Prompt Engineering Fundamentals
                </h3>

                <ul class="module-list">

                    <li>Prompt Engineering Foundations</li>
                    <li>How AI understands instructions</li>
                    <li>Advanced prompting techniques</li>
                    <li>Constraints and guardrails</li>
                    <li>Safety considerations</li>
                    <li>Iterative prompt improvement</li>

                </ul>

            </div>


            {{-- MODULE 4 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 04
                </div>

                <h3 class="module-title">
                    Markdown for AI Communication
                </h3>

                <ul class="module-list">

                    <li>Structured AI communication</li>
                    <li>Markdown fundamentals</li>
                    <li>Organizing AI instructions and outputs</li>
                    <li>Structuring information for AI systems</li>

                </ul>

            </div>


            {{-- MODULE 5 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 05
                </div>

                <h3 class="module-title">
                    Tools for AI Automation — No-Code
                </h3>

                <ul class="module-list">

                    <li>Introduction to no-code automation</li>
                    <li>Introduction to n8n</li>
                    <li>n8n Beginner Course</li>
                    <li>n8n Advanced Course</li>
                    <li>Building practical automation workflows</li>

                </ul>

            </div>


            {{-- MODULE 6 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 06
                </div>

                <h3 class="module-title">
                    APIs & Integrations
                </h3>

                <ul class="module-list">

                    <li>Understanding APIs</li>
                    <li>HTTP requests</li>
                    <li>How systems communicate</li>
                    <li>Connecting external applications</li>
                    <li>APIs in automation systems</li>

                </ul>

            </div>


            {{-- MODULE 7 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 07
                </div>

                <h3 class="module-title">
                    Large Language Models
                </h3>

                <ul class="module-list">

                    <li>Introduction to LLMs</li>
                    <li>How modern language models work</li>
                    <li>LLM capabilities</li>
                    <li>Applying LLMs to automation</li>

                </ul>

            </div>


            {{-- MODULE 8 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 08
                </div>

                <h3 class="module-title">
                    Building AI-Powered Automation Workflows with n8n
                </h3>

                <ul class="module-list">

                    <li>Designing AI-powered workflows</li>
                    <li>Connecting AI models to automation</li>
                    <li>Building multi-step workflows</li>
                    <li>Practical n8n implementation</li>
                    <li>Real-world workflow automation</li>

                </ul>

            </div>


            {{-- MODULE 9 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 09
                </div>

                <h3 class="module-title">
                    Webhooks
                </h3>

                <ul class="module-list">

                    <li>Webhook fundamentals</li>
                    <li>Receiving external events</li>
                    <li>Triggering automation workflows</li>
                    <li>Real-time automation concepts</li>

                </ul>

            </div>


            {{-- MODULE 10 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 10
                </div>

                <h3 class="module-title">
                    AI Chat Agents
                </h3>

                <ul class="module-list">

                    <li>Designing intelligent AI chat agents</li>
                    <li>Conversational AI systems</li>
                    <li>Connecting agents to workflows</li>
                    <li>Practical AI assistant development</li>

                </ul>

            </div>


            {{-- MODULE 11 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 11
                </div>

                <h3 class="module-title">
                    WhatsApp AI Agent
                </h3>

                <ul class="module-list">

                    <li>Building AI-powered WhatsApp agents</li>
                    <li>WhatsApp automation</li>
                    <li>Customer engagement workflows</li>
                    <li>AI-powered customer support</li>

                </ul>

            </div>


            {{-- MODULE 12 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 12
                </div>

                <h3 class="module-title">
                    AI Voice Receptionist
                </h3>

                <ul class="module-list">

                    <li>Building an AI voice receptionist</li>
                    <li>Voice-based customer interactions</li>
                    <li>Automated call handling</li>
                    <li>Connecting voice systems to workflows</li>

                </ul>

            </div>


            {{-- MODULE 13 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 13
                </div>

                <h3 class="module-title">
                    Outbound Call AI Agent
                </h3>

                <ul class="module-list">

                    <li>Building outbound AI calling agents</li>
                    <li>Automated outbound conversations</li>
                    <li>Lead engagement workflows</li>
                    <li>AI-powered call automation</li>

                </ul>

            </div>


            {{-- MODULE 14 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 14
                </div>

                <h3 class="module-title">
                    Agentic Workflows
                </h3>

                <ul class="module-list">

                    <li>Introduction to agentic workflows</li>
                    <li>AI systems that reason and act</li>
                    <li>Connecting agents with tools</li>
                    <li>Building intelligent multi-step systems</li>

                </ul>

            </div>


            {{-- MODULE 15 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#E31837]">
                    MODULE 15
                </div>

                <h3 class="module-title">
                    Final Project
                </h3>

                <p class="mt-5 text-slate-600 leading-relaxed">

                    Learners identify a local business within their area
                    and develop a complete WhatsApp AI agent supported by
                    an automation workflow.

                </p>

                <div class="mt-6 p-5 rounded-xl bg-[#F7FAFC]
                            border border-slate-200
                            text-[#0B1F3A] font-semibold">

                    Final practical project:
                    Build a complete AI automation solution
                    for a real-world business.

                </div>

            </div>


            {{-- MODULE 16 --}}

            <div class="curriculum-card">

                <div class="module-number text-[#1E73BE]">
                    MODULE 16
                </div>

                <h3 class="module-title">
                    Pricing AI Automation & Workflow Systems
                </h3>

                <ul class="module-list">

                    <li>Understanding AI automation project pricing</li>
                    <li>Pricing workflow systems</li>
                    <li>Packaging AI automation services</li>
                    <li>Understanding value-based delivery</li>

                </ul>

            </div>


            {{-- MODULE 17 --}}

            <div class="curriculum-card
                        bg-[#0B1F3A]
                        border-[#0B1F3A]
                        text-white">

                <div class="text-xs font-bold tracking-widest text-blue-200">
                    MODULE 17
                </div>

                <h3 class="mt-4 text-2xl font-extrabold">
                    Get Your First AI Automation Client
                </h3>

                <p class="mt-5 text-slate-300 leading-relaxed">

                    Learn how to identify potential clients and approach
                    businesses using an outbound client-acquisition method.

                </p>

                <ul class="mt-6 space-y-3 text-slate-200 list-disc list-inside">

                    <li>Identify potential AI automation clients</li>
                    <li>Build an outbound prospecting process</li>
                    <li>Present AI automation opportunities</li>
                    <li>Start conversations with businesses</li>
                    <li>Convert opportunities into projects</li>

                </ul>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
     LEARNING OUTCOMES
============================================================ --}}

<section class="py-20 sm:py-24 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl mb-14 scroll-reveal">

            <div class="flex items-center gap-3
                        text-[#E31837]
                        font-bold
                        text-xs
                        uppercase
                        tracking-[0.18em]">

                <span class="h-px w-8 bg-[#E31837]"></span>

                Learning Outcomes

            </div>


            <h2 class="mt-5
                       text-3xl
                       sm:text-4xl
                       lg:text-5xl
                       font-extrabold
                       text-[#0B1F3A]
                       tracking-tight">

                What You Will Be Able To Do

            </h2>


            <p class="mt-6 text-lg text-slate-600 leading-relaxed">

                Upon completion of the program, learners will have
                practical capabilities that can be applied to real
                business and technology environments.

            </p>

        </div>


        @php

            $outcomes = [

                'Explain core Artificial Intelligence concepts and technologies.',

                'Apply prompt engineering techniques to improve AI system performance.',

                'Design and implement AI-powered automation workflows.',

                'Integrate APIs, webhooks, and third-party services into business processes.',

                'Build and deploy AI chat agents and conversational systems.',

                'Develop WhatsApp-based AI assistants for customer engagement.',

                'Implement AI voice receptionists and outbound calling agents.',

                'Create agentic workflows using modern automation platforms.',

                'Design end-to-end AI solutions for real-world business challenges.',

                'Evaluate the ethical, operational, and commercial implications of AI deployment.',

            ];

        @endphp


        <div class="grid md:grid-cols-2 gap-4 max-w-5xl">

            @foreach($outcomes as $index => $outcome)

                <div class="outcome-card
                            scroll-reveal
                            bg-[#F7FAFC]
                            rounded-xl
                            p-5
                            border border-slate-200
                            hover:border-[#1E73BE]/30
                            hover:-translate-y-0.5
                            transition-all duration-300">

                    <div class="flex items-start gap-4">

                        <span class="shrink-0
                                     text-xs
                                     font-bold
                                     tracking-widest
                                     text-[#E31837]">

                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                        </span>

                        <p class="text-slate-700 leading-relaxed font-medium">
                            {{ $outcome }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>



{{-- ============================================================
     CAREER / COMMERCIAL VALUE
============================================================ --}}

<section class="py-20 sm:py-24 bg-[#F7FAFC]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">


            <div class="scroll-reveal">

                <div class="flex items-center gap-3
                            text-[#E31837]
                            font-bold
                            text-xs
                            uppercase
                            tracking-[0.18em]">

                    <span class="h-px w-8 bg-[#E31837]"></span>

                    Beyond Technical Skills

                </div>


                <h2 class="mt-5
                           text-3xl
                           sm:text-4xl
                           lg:text-5xl
                           font-extrabold
                           text-[#0B1F3A]
                           leading-tight
                           tracking-tight">

                    Learn How to Turn AI Skills Into Real Opportunities

                </h2>


                <p class="mt-6 text-lg text-slate-600 leading-relaxed">

                    The program does not stop at teaching learners how to
                    build AI systems. It also introduces the commercial
                    skills required to take those systems into the market.

                </p>


                <p class="mt-5 text-lg text-slate-600 leading-relaxed">

                    Learners explore AI automation pricing, client acquisition,
                    project delivery, and practical business applications.

                </p>

            </div>


            <div class="grid sm:grid-cols-2 gap-5">


                <div class="content-card
                            bg-white
                            rounded-2xl
                            p-7
                            border border-slate-200
                            hover:-translate-y-1
                            hover:shadow-lg
                            transition-all duration-300">

                    <div class="text-xs font-bold tracking-widest text-[#E31837]">
                        01
                    </div>

                    <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                        Pricing
                    </h3>

                    <p class="mt-3 text-slate-600">
                        Understand how AI automation and workflow systems can be priced and packaged.
                    </p>

                </div>


                <div class="content-card
                            bg-white
                            rounded-2xl
                            p-7
                            border border-slate-200
                            hover:-translate-y-1
                            hover:shadow-lg
                            transition-all duration-300">

                    <div class="text-xs font-bold tracking-widest text-[#E31837]">
                        02
                    </div>

                    <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                        Client Acquisition
                    </h3>

                    <p class="mt-3 text-slate-600">
                        Learn an outbound approach for finding potential AI automation clients.
                    </p>

                </div>


                <div class="content-card
                            bg-white
                            rounded-2xl
                            p-7
                            border border-slate-200
                            hover:-translate-y-1
                            hover:shadow-lg
                            transition-all duration-300">

                    <div class="text-xs font-bold tracking-widest text-[#E31837]">
                        03
                    </div>

                    <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                        Project Delivery
                    </h3>

                    <p class="mt-3 text-slate-600">
                        Develop practical systems that solve real business problems.
                    </p>

                </div>


                <div class="content-card
                            bg-white
                            rounded-2xl
                            p-7
                            border border-slate-200
                            hover:-translate-y-1
                            hover:shadow-lg
                            transition-all duration-300">

                    <div class="text-xs font-bold tracking-widest text-[#E31837]">
                        04
                    </div>

                    <h3 class="mt-4 text-xl font-bold text-[#0B1F3A]">
                        Global Opportunity
                    </h3>

                    <p class="mt-3 text-slate-600">
                        Build skills applicable to businesses, freelancing, consulting, and digital work.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
     CERTIFICATION
============================================================ --}}

<section class="py-20 sm:py-24 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="relative overflow-hidden
                    rounded-3xl
                    bg-[#0B1F3A]
                    p-8 sm:p-10 lg:p-14
                    text-white
                    shadow-[0_20px_60px_rgba(11,31,58,0.15)]
                    scroll-reveal">

            {{-- Structural line --}}
            <div class="absolute top-0 right-0
                        h-full w-1/3
                        border-l border-white/[0.06]">
            </div>

            <div class="relative max-w-4xl">

                <div class="flex items-center gap-3
                            text-blue-200
                            text-xs
                            uppercase
                            tracking-[0.18em]
                            font-bold">

                    <span class="h-px w-8 bg-[#E31837]"></span>

                    Certification

                </div>


                <h2 class="mt-6
                           text-3xl
                           sm:text-4xl
                           lg:text-5xl
                           font-extrabold
                           leading-tight">

                    Certificate in Artificial Intelligence
                    & Automation Systems

                </h2>


                <p class="mt-6 max-w-3xl
                          text-lg text-slate-300
                          leading-relaxed">

                    Learners who successfully complete the required
                    learning activities and practical project work are
                    eligible for the program certificate.

                </p>


                <div class="mt-9
                            inline-flex
                            rounded-lg
                            border border-white/15
                            bg-white/[0.05]
                            px-5 py-4">

                    <span class="font-semibold text-white">

                        Certificate in Artificial Intelligence
                        & Automation Systems

                    </span>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
     INSTITUTION / CONTACT
============================================================ --}}

<section class="py-20 sm:py-24 bg-[#F7FAFC]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl mb-14 scroll-reveal">

            <div class="flex items-center gap-3
                        text-[#E31837]
                        font-bold
                        text-xs
                        uppercase
                        tracking-[0.18em]">

                <span class="h-px w-8 bg-[#E31837]"></span>

                Moose Loon AI Academy

            </div>


            <h2 class="mt-5
                       text-3xl
                       sm:text-4xl
                       font-extrabold
                       text-[#0B1F3A]">

                Connect With Our Team

            </h2>


            <p class="mt-5 text-lg text-slate-600">

                Enquire about enrollment, program delivery,
                certification, or other Academy opportunities.

            </p>

        </div>


        <div class="grid md:grid-cols-2 gap-6 max-w-5xl">


            {{-- CANADA --}}

            <div class="content-card
                        bg-white
                        rounded-2xl
                        p-8
                        border border-slate-200
                        shadow-[0_8px_30px_rgba(11,31,58,0.04)]">

                <div class="text-xs
                            uppercase
                            tracking-[0.16em]
                            font-bold
                            text-[#E31837]">

                    Canada

                </div>

                <h3 class="mt-4 text-2xl font-extrabold text-[#0B1F3A]">
                    Edmonton, AB Canada
                </h3>


                <div class="mt-5 space-y-3 text-slate-600">

                    <p>
                        <strong class="text-[#0B1F3A]">
                            Phone:
                        </strong>

                        +1 780-800-1824
                    </p>


                    <p>
                        <strong class="text-[#0B1F3A]">
                            Email:
                        </strong>

                        aisolutions@mooseloonai.ca
                    </p>


                    <p>
                        <strong class="text-[#0B1F3A]">
                            Website:
                        </strong>

                        <a href="https://mooseloonai.ca/"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-[#1E73BE] font-semibold hover:underline">

                            mooseloonai.ca

                        </a>

                    </p>

                </div>

            </div>


            {{-- KENYA --}}

            <div class="content-card
                        bg-white
                        rounded-2xl
                        p-8
                        border border-slate-200
                        shadow-[0_8px_30px_rgba(11,31,58,0.04)]">

                <div class="text-xs
                            uppercase
                            tracking-[0.16em]
                            font-bold
                            text-[#E31837]">

                    Kenya

                </div>

                <h3 class="mt-4 text-2xl font-extrabold text-[#0B1F3A]">
                    Nairobi, Kenya
                </h3>


                <div class="mt-5 space-y-3 text-slate-600">

                    <p>
                        <strong class="text-[#0B1F3A]">
                            Office:
                        </strong>
                    </p>

                    <p>
                        Kipro Centre – Westlands, Nairobi
                    </p>

                    <p>
                        <strong class="text-[#0B1F3A]">
                            Phone:
                        </strong>

                        +254 119 066 667
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
     FINAL CTA
============================================================ --}}

<section class="relative overflow-hidden
                bg-[#0B1F3A]
                py-20 sm:py-24
                text-white">

    <div class="absolute inset-0 pointer-events-none">

        <div class="absolute top-0 right-1/4
                    h-px w-48
                    bg-white/10">
        </div>

        <div class="absolute bottom-0 left-1/4
                    h-px w-48
                    bg-white/10">
        </div>

    </div>


    <div class="relative max-w-4xl mx-auto
                px-4 sm:px-6
                text-center
                scroll-reveal">

        <div class="flex items-center justify-center gap-3
                    text-blue-200
                    font-bold
                    text-xs
                    uppercase
                    tracking-[0.18em]">

            <span class="h-px w-8 bg-[#E31837]"></span>

            Start Building

            <span class="h-px w-8 bg-[#E31837]"></span>

        </div>


        <h2 class="mt-6
                   text-3xl
                   sm:text-4xl
                   lg:text-5xl
                   font-extrabold
                   leading-tight">

            Ready to Build Real AI Systems?

        </h2>


        <p class="mt-6
                  text-lg
                  sm:text-xl
                  text-slate-300
                  max-w-3xl
                  mx-auto
                  leading-relaxed">

            Join Moose Loon AI Academy and develop practical
            Artificial Intelligence and workflow automation skills
            designed for the modern digital economy.

        </p>


        <div class="mt-9 flex flex-col
                    sm:flex-row
                    justify-center
                    gap-4">

            <a href="{{ route('contactus') }}"
               class="inline-flex items-center justify-center
                      px-8 py-3.5
                      rounded-full
                      bg-white
                      text-[#0B1F3A]
                      font-bold
                      hover:-translate-y-0.5
                      hover:shadow-xl
                      transition-all
                      duration-300">

                Make an Enquiry

            </a>


            <a href="#curriculum"
               class="inline-flex items-center justify-center
                      px-8 py-3.5
                      rounded-full
                      border border-white/20
                      text-white
                      font-semibold
                      hover:bg-white/10
                      hover:border-white/30
                      transition-all
                      duration-300">

                View Curriculum

            </a>

        </div>


        <p class="mt-8 text-sm text-slate-400">

            Moose Loon AI Academy

            <span class="mx-2 text-white/20">
                •
            </span>

            Edmonton, AB Canada

            <span class="mx-2 text-white/20">
                •
            </span>

            Nairobi, Kenya

        </p>

    </div>

</section>



{{-- ============================================================
     ANIMATION / DESIGN SYSTEM
============================================================ --}}

<style>

    /*
    |--------------------------------------------------------------------------
    | Hero entrance animations
    |--------------------------------------------------------------------------
    */

    .hero-fade-up {
        opacity: 0;
        transform: translateY(20px);
        animation: heroFadeUp 0.8s cubic-bezier(.22,1,.36,1) forwards;
    }


    .hero-panel-in {
        opacity: 0;
        transform: translateX(24px);
        animation: heroPanelIn 0.9s cubic-bezier(.22,1,.36,1) 120ms forwards;
    }


    .hero-module-card {
        opacity: 0;
        transform: translateY(8px);
        animation: moduleIn 0.55s cubic-bezier(.22,1,.36,1) forwards;
    }


    .hero-module-card:nth-child(1) {
        animation-delay: 250ms;
    }

    .hero-module-card:nth-child(2) {
        animation-delay: 320ms;
    }

    .hero-module-card:nth-child(3) {
        animation-delay: 390ms;
    }

    .hero-module-card:nth-child(4) {
        animation-delay: 460ms;
    }

    .hero-module-card:nth-child(5) {
        animation-delay: 530ms;
    }

    .hero-module-card:nth-child(6) {
        animation-delay: 600ms;
    }


    /*
    |--------------------------------------------------------------------------
    | Scroll reveal
    |--------------------------------------------------------------------------
    */

    .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition:
            opacity 0.7s ease,
            transform 0.7s cubic-bezier(.22,1,.36,1);
    }


    .scroll-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }


    /*
    |--------------------------------------------------------------------------
    | Curriculum cards
    |--------------------------------------------------------------------------
    */

    .curriculum-card {
        background: white;
        border: 1px solid rgb(226 232 240);
        border-radius: 1.25rem;
        padding: 2rem;
        box-shadow: 0 8px 30px rgba(11,31,58,0.04);

        opacity: 0;
        transform: translateY(18px);

        animation: curriculumIn 0.65s cubic-bezier(.22,1,.36,1) forwards;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease,
            border-color 0.3s ease;
    }


    .curriculum-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(11,31,58,0.08);
        border-color: rgba(30,115,190,0.25);
    }


    .curriculum-card:nth-child(1)  { animation-delay: 60ms; }
    .curriculum-card:nth-child(2)  { animation-delay: 100ms; }
    .curriculum-card:nth-child(3)  { animation-delay: 140ms; }
    .curriculum-card:nth-child(4)  { animation-delay: 180ms; }
    .curriculum-card:nth-child(5)  { animation-delay: 220ms; }
    .curriculum-card:nth-child(6)  { animation-delay: 260ms; }
    .curriculum-card:nth-child(7)  { animation-delay: 300ms; }
    .curriculum-card:nth-child(8)  { animation-delay: 340ms; }
    .curriculum-card:nth-child(9)  { animation-delay: 380ms; }
    .curriculum-card:nth-child(10) { animation-delay: 420ms; }
    .curriculum-card:nth-child(11) { animation-delay: 460ms; }
    .curriculum-card:nth-child(12) { animation-delay: 500ms; }
    .curriculum-card:nth-child(13) { animation-delay: 540ms; }
    .curriculum-card:nth-child(14) { animation-delay: 580ms; }
    .curriculum-card:nth-child(15) { animation-delay: 620ms; }
    .curriculum-card:nth-child(16) { animation-delay: 660ms; }
    .curriculum-card:nth-child(17) { animation-delay: 700ms; }


    .module-number {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.12em;
    }


    .module-title {
        margin-top: 0.75rem;
        font-size: 1.5rem;
        line-height: 1.25;
        font-weight: 800;
        color: #0B1F3A;
    }


    .module-list {
        margin-top: 1.5rem;
        padding-left: 1.1rem;
        list-style-type: disc;
        color: rgb(71 85 105);
    }


    .module-list li {
        margin-bottom: 0.65rem;
        line-height: 1.55;
    }


    /*
    |--------------------------------------------------------------------------
    | Generic cards
    |--------------------------------------------------------------------------
    */

    .content-card,
    .stat-card,
    .outcome-card {
        will-change: transform;
    }


    /*
    |--------------------------------------------------------------------------
    | Keyframes
    |--------------------------------------------------------------------------
    */

    @keyframes heroFadeUp {

        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    @keyframes heroPanelIn {

        from {
            opacity: 0;
            transform: translateX(24px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }

    }


    @keyframes moduleIn {

        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    @keyframes curriculumIn {

        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Accessibility
    |--------------------------------------------------------------------------
    */

    @media (prefers-reduced-motion: reduce) {

        .hero-fade-up,
        .hero-panel-in,
        .hero-module-card,
        .curriculum-card {

            animation: none;
            opacity: 1;
            transform: none;

        }


        .scroll-reveal {

            opacity: 1;
            transform: none;
            transition: none;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Mobile refinement
    |--------------------------------------------------------------------------
    */

    @media (max-width: 640px) {

        .curriculum-card {
            padding: 1.5rem;
        }

    }

</style>



{{-- ============================================================
     SCROLL REVEAL SCRIPT
============================================================ --}}

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
                rootMargin: '0px 0px -40px 0px'
            }

        );


        revealElements.forEach(function (element) {

            observer.observe(element);

        });

    });

</script>


@endsection