@extends('layouts.public')

@section('title', 'Moose Loon AI Academy Partnership Program')

@section('content')

<style>
    .hero-bg{
        background:
        radial-gradient(circle at top left, rgba(11, 11, 11, 0.87), transparent 35%),
        radial-gradient(circle at bottom right, rgba(168,85,247,.35), transparent 35%),
        linear-gradient(135deg,#0f172a 0%, #111827 45%, #1e1b4b 100%);
    }

    .glass{
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        background: rgba(15, 14, 14, 0.88);
        border: 1px solid rgba(255,255,255,.12);
    }

    .card-hover{
        transition: all .35s ease;
    }

    .card-hover:hover{
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0,0,0,.12);
    }

    .gradient-border{
        position: relative;
        isolation: isolate;
        border-radius: 30px;
    }

    .gradient-border::before{
        content:'';
        position:absolute;
        inset:-1px;
        padding:1px;
        border-radius:30px;
        background: linear-gradient(135deg,#6366f1,#a855f7,#ec4899);
        pointer-events:none;
        z-index:-1;

        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);

        -webkit-mask-composite: xor;
        mask-composite: exclude;
    }

    .gradient-border > div{
        position: relative;
        z-index: 1;
    }

    .grid-pattern{
        background-image:
            linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);

        background-size: 40px 40px;
    }

    .glow{
        box-shadow: 0 0 40px rgba(99,102,241,.25);
    }
</style>

<div class="bg-[#f8fafc] overflow-x-hidden">

    <!-- HERO -->
   <section class="hero-bg grid-pattern relative overflow-hidden">
    <div class="absolute inset-0 bg-black/5"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-24 lg:py-32">

            <div class="grid lg:grid-cols-2 gap-14 items-center lg:pr-8">

                <div>

                    <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-md border border-gray-200 text-black px-4 py-2 rounded-full text-sm font-semibold mb-6 shadow-lg">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        Partnership Opportunities Open Across Kenya
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-black leading-tight">
                        Build an
                        <span class="bg-gradient-to-r from-black via-gray-800 to-gray-600 bg-clip-text text-transparent">
                            AI Training Business
                        </span>
                        With Moose Loon AI Academy
                    </h1>

                    <p class="mt-8 text-xl text-gray-900 leading-relaxed max-w-2xl">
                        Launch and scale AI training programs under an international AI education brand.
                        Deliver high-demand AI courses, earn from every student enrolled, and become part of Kenya’s fastest-growing AI education network.
                    </p>

                    <div class="mt-10 flex flex-wrap gap-4">

                        <a href="#apply"
                           class="bg-white text-gray-900 px-8 py-4 rounded-2xl font-bold text-lg hover:scale-105 transition shadow-2xl">
                            Apply for Partnership
                        </a>

                        <a href="https://wa.me/254119066667"
                           class="glass text-white px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-white/10 transition">
                            WhatsApp Us
                        </a>

                    </div>

                    <div class="mt-10 grid sm:grid-cols-3 gap-4">

                        <div class="glass rounded-2xl p-5">
                            <div class="text-3xl font-black text-white">AI</div>
                            <p class="text-sm text-gray-300 mt-2">
                                Industry-focused training programs
                            </p>
                        </div>

                        <div class="glass rounded-2xl p-5">
                            <div class="text-3xl font-black text-white">100%</div>
                            <p class="text-sm text-gray-300 mt-2">
                                Online & scalable learning delivery
                            </p>
                        </div>

                        <div class="glass rounded-2xl p-5">
                            <div class="text-3xl font-black text-white">KES</div>
                            <p class="text-sm text-gray-300 mt-2">
                                Revenue-sharing partnership model
                            </p>
                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="relative">

                    <div class="gradient-border rounded-[30px]">
                        <div class="bg-white rounded-[30px] p-8 lg:p-10 shadow-2xl">

                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <p class="text-sm font-semibold text-indigo-600 uppercase tracking-widest">
                                        Featured Program
                                    </p>
                                    <h3 class="text-3xl font-black text-gray-900 mt-2">
                                        AI & Workflow Automation
                                    </h3>
                                </div>

                                <div class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl text-sm font-bold">
                                    15 Modules
                                </div>
                            </div>

                            <div class="space-y-4">

                                <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50">
                                    <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold">
                                        01
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Prompt Engineering & AI Systems</h4>
                                        <p class="text-gray-600 text-sm mt-1">
                                            Teach practical AI usage, workflows, automation logic, and intelligent systems.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50">
                                    <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold">
                                        02
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">AI Chat Agents & WhatsApp Automation</h4>
                                        <p class="text-gray-600 text-sm mt-1">
                                            Students build real AI assistants integrated with workflows and CRM systems.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50">
                                    <div class="w-12 h-12 rounded-xl bg-pink-600 text-white flex items-center justify-center font-bold">
                                        03
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Industry-Ready Practical Skills</h4>
                                        <p class="text-gray-600 text-sm mt-1">
                                            Real-world projects designed for freelancers, institutions, and businesses.
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-8 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-6 text-white">
                                <p class="font-bold text-lg">
                                    “You focus on learners and growth.
                                    Moose Loon AI handles curriculum, systems, certification, and standards.”
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- WHY THIS MATTERS -->
    <section class="py-24 px-6 bg-white">

        <div class="max-w-7xl mx-auto">

            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold text-sm">
                    Why Institutions & Trainers Are Joining
                </div>

                <h2 class="text-5xl font-black text-gray-900 mt-6">
                    AI Education Is Becoming Essential
                </h2>

                <p class="mt-6 text-xl text-gray-600 leading-relaxed">
                    Businesses are rapidly adopting AI systems, automation, intelligent chat agents, and workflow tools.
                    Students are actively looking for practical AI skills that lead to income, employment, and business opportunities.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-16">

                <div class="bg-gray-50 rounded-3xl p-8 card-hover">
                    <div class="text-5xl mb-5">🚀</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        High Demand
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        AI skills are becoming a priority across business, education, customer support, marketing, and operations.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 card-hover">
                    <div class="text-5xl mb-5">💼</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        Revenue Opportunity
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Run cohorts, workshops, or institutional training programs while generating sustainable income.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 card-hover">
                    <div class="text-5xl mb-5">🌍</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        International Positioning
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Operate under Moose Loon AI Academy with globally verifiable certification systems.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 card-hover">
                    <div class="text-5xl mb-5">⚡</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        Fast Deployment
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Launch quickly without creating your own curriculum, systems, or certification infrastructure.
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- PROGRAM -->
    <section class="py-24 px-6 bg-[#0f172a]">

        <div class="max-w-7xl mx-auto">

            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-300 font-semibold text-sm">
                    Partnership Program
                </div>

                <h2 class="text-5xl font-black text-white mt-6">
                    AI Agents & Workflow Automation Certification Program
                </h2>

                <p class="mt-6 text-xl text-gray-300 leading-relaxed">
                    A practical AI training program designed for modern business environments,
                    automation systems, intelligent workflows, AI chat agents, and digital operations.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-16">

                <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                    <div class="text-indigo-300 text-5xl mb-5">🧠</div>

                    <h3 class="text-2xl font-bold text-white mb-5">
                        Core AI Foundations
                    </h3>

                    <ul class="space-y-3 text-gray-300">
                        <li>• Introduction to Artificial Intelligence</li>
                        <li>• AI in Business & Industry</li>
                        <li>• Prompt Engineering</li>
                        <li>• Markdown for AI Communication</li>
                        <li>• Large Language Models (LLMs)</li>
                    </ul>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                    <div class="text-purple-300 text-5xl mb-5">⚙️</div>

                    <h3 class="text-2xl font-bold text-white mb-5">
                        Automation & Systems
                    </h3>

                    <ul class="space-y-3 text-gray-300">
                        <li>• APIs & Integrations</li>
                        <li>• n8n Workflow Automation</li>
                        <li>• Webhooks & Real-Time Systems</li>
                        <li>• Error Handling & Debugging</li>
                        <li>• Workflow Design</li>
                    </ul>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                    <div class="text-pink-300 text-5xl mb-5">🤖</div>

                    <h3 class="text-2xl font-bold text-white mb-5">
                        Advanced AI Applications
                    </h3>

                    <ul class="space-y-3 text-gray-300">
                        <li>• AI Chat Agents</li>
                        <li>• WhatsApp AI Systems</li>
                        <li>• CRM Integration</li>
                        <li>• Agentic AI Workflows</li>
                        <li>• Real-World AI Projects</li>
                    </ul>
                </div>

            </div>

        </div>

    </section>

    <!-- WHAT WE HANDLE -->
    <section class="py-24 px-6 bg-white">

        <div class="max-w-7xl mx-auto">

            <div class="grid lg:grid-cols-2 gap-14">

                <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-[32px] p-10 text-white shadow-2xl">

                    <div class="inline-flex px-4 py-2 rounded-full bg-white/10 text-white text-sm font-semibold">
                        Moose Loon AI Academy
                    </div>

                    <h2 class="text-4xl font-black mt-6">
                        What We Handle
                    </h2>

                    <div class="mt-10 space-y-5">

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                                🎓
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Curriculum & Training Systems</h4>
                                <p class="text-indigo-100 mt-1">
                                    Structured AI training programs aligned with industry needs.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                                📜
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Certification</h4>
                                <p class="text-indigo-100 mt-1">
                                    Globally verifiable certification and student credential systems.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                                🧩
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Learning Platform Access</h4>
                                <p class="text-indigo-100 mt-1">
                                    Online learning systems, onboarding, and technical support.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                                🛡️
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Brand Standards & Quality</h4>
                                <p class="text-indigo-100 mt-1">
                                    Maintaining credibility, training quality, and institutional standards.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="bg-gray-50 rounded-[32px] p-10">

                    <div class="inline-flex px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">
                        Your Role
                    </div>

                    <h2 class="text-4xl font-black mt-6 text-gray-900">
                        What Partners Focus On
                    </h2>

                    <div class="mt-10 space-y-5">

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                                👥
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900">Student Recruitment</h4>
                                <p class="text-gray-600 mt-1">
                                    Build cohorts, recruit learners, and grow your local presence.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                                🏫
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900">Facilitate AI learning</h4>
                                <p class="text-gray-600 mt-1">
                                    Facilitate AI learning through creating awareness of the program.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                                📈
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900">Business Growth</h4>
                                <p class="text-gray-600 mt-1">
                                    Scale AI education opportunities within your institution or network.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                                🤝
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900">Professional Partnership</h4>
                                <p class="text-gray-600 mt-1">
                                    Maintain professionalism, ethics, and institutional credibility.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- PARTNERSHIP DELIVERY MODEL -->
<section class="py-24 px-6 bg-gradient-to-br from-gray-900 via-slate-900 to-black text-white overflow-hidden">

    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="text-center max-w-4xl mx-auto">

            <div class="inline-flex items-center px-5 py-2 rounded-full bg-white/10 border border-white/10 text-indigo-200 text-sm font-semibold tracking-wide">
                Institutional Partnership Framework
            </div>

            <h2 class="mt-8 text-4xl md:text-6xl font-black leading-tight">
                How The Partnership Works
            </h2>

            <p class="mt-6 text-xl text-gray-300 leading-relaxed">
                Moose Loon AI Academy works closely with institutions to help students
                access practical AI training, structured learning systems,
                and globally aligned digital skills programs.
            </p>

        </div>

        <!-- FLOW -->
        <div class="mt-20 grid lg:grid-cols-3 gap-8">

            <!-- STEP 1 -->
            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-10 hover:border-indigo-400/40 transition duration-300">

                <div class="absolute top-6 right-6 text-6xl font-black text-white/5">
                    01
                </div>

                <div class="w-16 h-16 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-3xl mb-8">
                    📢
                </div>

                <h3 class="text-3xl font-black mb-5">
                    Institution Awareness & Student Mobilization
                </h3>

                <p class="text-gray-300 leading-relaxed mb-6">
                    Partner institutions introduce students to the AI training opportunity
                    through internal communication channels, workshops, orientations,
                    digital campaigns, and academic announcements.
                </p>

                <div class="space-y-4">

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-indigo-400 mt-2"></div>
                        <p class="text-gray-300">Student awareness campaigns</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-indigo-400 mt-2"></div>
                        <p class="text-gray-300">Campus and online information sessions</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-indigo-400 mt-2"></div>
                        <p class="text-gray-300">Guidance on AI career opportunities</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-indigo-400 mt-2"></div>
                        <p class="text-gray-300">Student onboarding coordination</p>
                    </div>

                </div>

            </div>

            <!-- STEP 2 -->
            <div class="relative bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-10 shadow-2xl">

                <div class="absolute top-6 right-6 text-6xl font-black text-white/10">
                    02
                </div>

                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-3xl mb-8">
                    🎓
                </div>

                <h3 class="text-3xl font-black mb-5">
                    Student Enrollment & Platform Access
                </h3>

                <p class="text-indigo-100 leading-relaxed mb-6">
                    Once learners are organized and enrolled through the institution,
                    Moose Loon AI Academy facilitates onboarding into the learning ecosystem.
                </p>

                <div class="space-y-4">

                    <div class="bg-white/10 rounded-2xl p-4">
                        Student records and enrollment information are submitted
                        for onboarding and verification.
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4">
                        Learners receive access credentials, communication instructions,
                        and platform guidance.
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4">
                        Students access structured modules, guided learning,
                        and practical AI training resources.
                    </div>

                </div>

            </div>

            <!-- STEP 3 -->
            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-10 hover:border-purple-400/40 transition duration-300">

                <div class="absolute top-6 right-6 text-6xl font-black text-white/5">
                    03
                </div>

                <div class="w-16 h-16 rounded-2xl bg-purple-500/20 flex items-center justify-center text-3xl mb-8">
                    🤝
                </div>

                <h3 class="text-3xl font-black mb-5">
                    Continuous Academic Collaboration
                </h3>

                <p class="text-gray-300 leading-relaxed mb-6">
                    The partnership creates a continuous relationship between
                    the institution, enrolled learners, and Moose Loon AI Academy
                    throughout the learning process.
                </p>

                <div class="space-y-4">

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-purple-400 mt-2"></div>
                        <p class="text-gray-300">Student support and coordination</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-purple-400 mt-2"></div>
                        <p class="text-gray-300">Academic communication channels</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-purple-400 mt-2"></div>
                        <p class="text-gray-300">Progress monitoring and completion support</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-purple-400 mt-2"></div>
                        <p class="text-gray-300">Certification and learning verification</p>
                    </div>

                </div>

            </div>

        </div>

        <!-- BOTTOM STRATEGIC SECTION -->
        <div class="mt-20 bg-white/5 border border-white/10 rounded-[2rem] p-10 md:p-14">

            <div class="grid lg:grid-cols-2 gap-14 items-center">

                <div>

                    <div class="inline-flex px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-200 text-sm font-semibold mb-6">
                        Partnership Structure
                    </div>

                    <h3 class="text-4xl font-black leading-tight">
                        A Structured Collaboration Between Institutions & Moose Loon AI Academy
                    </h3>

                    <p class="mt-6 text-gray-300 text-lg leading-relaxed">
                        Institutions play a key role in learner mobilization,
                        organization, and communication while Moose Loon AI Academy
                        manages the digital learning infrastructure,
                        curriculum systems, onboarding processes,
                        and certification pathways.
                    </p>

                </div>

                <div class="space-y-5">

                    <div class="bg-black/30 border border-white/10 rounded-2xl p-6">
                        <h4 class="font-bold text-xl mb-2 text-indigo-300">
                            Institution Role
                        </h4>

                        <p class="text-gray-300 leading-relaxed">
                            Student engagement, awareness creation, learner coordination,
                            communication support, and institutional facilitation.
                        </p>
                    </div>

                    <div class="bg-black/30 border border-white/10 rounded-2xl p-6">
                        <h4 class="font-bold text-xl mb-2 text-purple-300">
                            Moose Loon AI Academy Role
                        </h4>

                        <p class="text-gray-300 leading-relaxed">
                            Platform access, curriculum delivery, onboarding systems,
                            technical support, learning structure,
                            and certification management.
                        </p>
                    </div>

                    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl p-6">
                        <h4 class="font-bold text-xl mb-2">
                            Shared Mission
                        </h4>

                        <p class="text-indigo-100 leading-relaxed">
                            Expanding practical AI education access and preparing learners
                            with modern, industry-relevant digital skills.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
    <!-- WHO SHOULD APPLY -->
    <section class="py-24 px-6 bg-white">

        <div class="max-w-7xl mx-auto">

            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">
                    Ideal Partners
                </div>

                <h2 class="text-5xl font-black text-gray-900 mt-6">
                    Who Should Apply
                </h2>

                <p class="mt-6 text-xl text-gray-600">
                    We are building partnerships with organizations and individuals
                    capable of scaling AI education across Kenya and beyond.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-16">

                @php
                    $partners = [
                        ['🏫','Educational Institutions'],
                        ['👨‍🏫','Trainers & Educators'],
                        ['🏢','Corporate Training Firms'],
                        ['🌍','NGOs & Community Programs'],
                    ];
                @endphp

                @foreach($partners as $partner)
                    <div class="bg-gray-50 rounded-3xl p-8 card-hover">
                        <div class="text-5xl mb-5">{{ $partner[0] }}</div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $partner[1] }}
                        </h3>
                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <!-- PROCESS -->
    <section class="py-24 px-6 bg-[#0f172a]">

        <div class="max-w-7xl mx-auto">

            <div class="text-center">
                <div class="inline-flex px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-300 text-sm font-semibold">
                    Partnership Process
                </div>

                <h2 class="text-5xl font-black text-white mt-6">
                    How The Partnership Works
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-8 mt-16">

                @php
                    $steps = [
                        'Submit Application',
                        'Application Review',
                        'Partner Approval',
                        'Onboarding & Setup',
                        'Launch Student Enrollment'
                    ];
                @endphp

                @foreach($steps as $index => $step)
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 text-center relative overflow-hidden">

                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl"></div>

                        <div class="relative z-10">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white mx-auto flex items-center justify-center text-2xl font-black glow">
                                {{ $index + 1 }}
                            </div>

                            <h3 class="text-xl font-bold text-white mt-6">
                                {{ $step }}
                            </h3>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="py-24 px-6 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white text-center">

        <div class="max-w-4xl mx-auto">

            <h2 class="text-5xl font-black leading-tight">
                Become Part of Kenya’s AI Education Future
            </h2>

            <p class="mt-8 text-xl text-indigo-100 leading-relaxed">
                Build a sustainable training business, empower learners with practical AI skills,
                and scale under a globally positioned AI education brand.
            </p>

            <div class="mt-10 flex flex-wrap justify-center gap-5">

                <a href="#apply"
                   class="bg-white text-gray-900 px-10 py-4 rounded-2xl font-black text-lg hover:scale-105 transition">
                    Apply for Partnership
                </a>

                <a href="https://wa.me/254119066667"
                   class="border border-white/30 bg-white/10 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-white/20 transition">
                    WhatsApp Us
                </a>

            </div>

        </div>

    </section>

    <!-- FORM -->
    <section id="apply" class="py-24 px-6 bg-[#f8fafc]">

        <div class="max-w-3xl mx-auto">

            <div class="bg-white rounded-[32px] shadow-2xl overflow-hidden">

                <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-10 text-white text-center">
                    <h2 class="text-4xl font-black">
                        Partner Application
                    </h2>

                    <p class="mt-4 text-indigo-100 text-lg">
                        Submit your application and our team will review your partnership suitability.
                    </p>
                </div>

                <div class="p-10">

                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-2xl mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 text-red-800 p-4 rounded-2xl mb-6">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('partner.apply') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    Full Name / Institution Name
                                </label>

                                <input type="text"
                                       name="name"
                                       required
                                       placeholder="Enter name"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    Email Address
                                </label>

                                <input type="email"
                                       name="email"
                                       required
                                       placeholder="Enter email"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                        </div>

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    Phone Number
                                </label>

                                <input type="text"
                                       name="phone"
                                       required
                                       placeholder="Phone number"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    Location
                                </label>

                                <input type="text"
                                       name="location"
                                       placeholder="City / County"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Current Student Population / Audience Reach
                            </label>

                            <input type="text"
                                   name="current_student_population"
                                   placeholder="Approximate reach"
                                   class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Additional Information
                            </label>

                            <textarea name="additional_info"
                                      rows="6"
                                      placeholder="Tell us about your institution, audience, training experience, or partnership goals..."
                                      class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-5 rounded-2xl font-black text-lg hover:scale-[1.01] transition shadow-xl">
                            Submit Partnership Application
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection