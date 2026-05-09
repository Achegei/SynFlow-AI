@extends('layouts.public')

@section('title', 'Home - MooseLoon AI')
<style>
/* CSS for the sliding animation */
@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-slide {
    animation: slide 30s linear infinite;
}

/* Accordion transition */
.accordion-content {
    transition: max-height 0.3s ease-in-out;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}
/* Floating card */
@keyframes float {
    0%,100% { transform: translateY(-50%) translateX(-50%); }
    50% { transform: translateY(calc(-50% - 8px)) translateX(-50%); }
}
.animate-float {
    animation: float 4s ease-in-out infinite;
}

/* Dashboard zoom */
@keyframes zoomGlow {
    0%,100% { transform: scale(1); }
    50% { transform: scale(1.04); }
}
.animate-zoom-glow {
    animation: zoomGlow 6s ease-in-out infinite;
}

/* Glow pulse */
@keyframes glow {
    0%,100% { opacity: 0.2; }
    50% { opacity: 0.5; }
}
.animate-glow {
    animation: glow 4s ease-in-out infinite;
}

@keyframes floatSlow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.animate-float-slow {
    animation: floatSlow 6s ease-in-out infinite;
}
</style>

@section('content')
  <!-- HERO SECTION (REPOSITIONED FOR ACADEMY) -->
<section class="relative min-h-screen bg-[#050816] flex items-center justify-center px-4 sm:px-6 lg:px-8 overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/aiherobg.jpg') }}" 
            class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/60 to-black"></div>
    </div>
        <!-- HERO GLOW EFFECTS -->
    <div class="absolute top-[-250px] left-1/2 -translate-x-1/2 
                w-[900px] h-[900px] 
                bg-indigo-600/20 blur-[180px] rounded-full">
    </div>

    <div class="absolute bottom-[-300px] right-[-100px]
                w-[500px] h-[500px]
                bg-purple-600/10 blur-[160px] rounded-full">
    </div>

    <div class="relative z-10 max-w-5xl text-center">

        <!-- HEADLINE -->
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mt-20">
            Artificial Intelligence & Automation Certification Program
            <span class="block text-indigo-500 mt-2">
                Delivered by Moose Loon AI Academy (Canada)
            </span>
        </h1>

        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto">
            A structured, self-paced training program in AI Agents & Workflow Automation designed for 
            schools, colleges, and training institutions ready to equip students with future-ready digital skills.
        </p>

        <!-- KEY VALUE -->
        <p class="mt-4 text-gray-400 max-w-2xl mx-auto">
            Based on a 19-module curriculum covering AI fundamentals, prompt engineering, APIs, automation systems, 
            n8n workflows, AI agents, CRM integration, and real-world deployment.
        </p>

        <!-- CTA -->
        <div class="mt-8 flex justify-center gap-4 flex-wrap">
            <a href="{{route('contactus')}}" class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 
            text-white font-semibold rounded-2xl 
            shadow-[0_0_40px_rgba(99,102,241,0.35)]
            hover:scale-[1.03] hover:shadow-[0_0_60px_rgba(99,102,241,0.45)]
            transition-all duration-300">
                Become an Academic Partner
            </a>

            <a href="{{route('contactus')}}" class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-2xl shadow-[0_0_40px_rgba(99,102,241,0.35)]hover:scale-[1.03] hover:shadow-[0_0_60px_rgba(99,102,241,0.45)]
            transition-all duration-300">
                Request Program Proposal
            </a>
        </div>

        <p class="mt-6 text-sm text-gray-400">
            ⭐ Accredited-ready curriculum • Built for institutional delivery • Industry aligned AI training
        </p>

    </div>
</section>

  <!-- WHY INSTITUTIONS NEED AI TRAINING -->
<section class="py-20 bg-[#050816] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT CONTENT -->
            <div>

                <p class="text-indigo-400 font-semibold mb-4 uppercase tracking-wider">
                    Future-Ready Education
                </p>

                <h2 class="text-3xl sm:text-4xl font-bold leading-tight">
                    Prepare students for the AI-powered workforce
                </h2>

                <p class="mt-6 text-gray-300 text-lg">
                    Artificial Intelligence is rapidly transforming business, communication, customer service, operations, and digital work. Institutions that integrate AI training today position their students for tomorrow’s opportunities.
                </p>

                <!-- FEATURES -->
                <div class="mt-8 space-y-6">

                    <div>
                        <h4 class="font-semibold text-indigo-400">
                            Industry-Relevant Skills
                        </h4>
                        <p class="text-gray-300">
                            Students learn practical AI automation, workflows, APIs, AI agents, and business systems.
                        </p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-indigo-400">
                            Self-Paced Online Delivery
                        </h4>
                        <p class="text-gray-300">
                            Flexible learning structure designed for schools, colleges, and training centers.
                        </p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-indigo-400">
                            Real-World Implementation
                        </h4>
                        <p class="text-gray-300">
                            Learners build AI workflows, automation systems, WhatsApp AI agents, and CRM-integrated solutions.
                        </p>
                    </div>

                </div>

                <p class="mt-8 text-gray-400">
                    Moose Loon AI Academy helps institutions introduce modern AI education without requiring deep technical infrastructure or software engineering departments.
                </p>
            </div>

            <!-- RIGHT IMAGE ROTATOR (UNCHANGED) -->
            <div class="relative w-full h-[350px] sm:h-[400px] lg:h-[450px]">

                <img src="{{ asset('images/feature1.png') }}" 
                     class="absolute inset-0 w-full h-full object-cover rounded-xl shadow-2xl transition-opacity duration-1000 opacity-100 image-slide">

                <img src="{{ asset('images/feature2.png') }}" 
                     class="absolute inset-0 w-full h-full object-cover rounded-xl shadow-2xl transition-opacity duration-1000 opacity-0 image-slide">

                <img src="{{ asset('images/feature3.png') }}" 
                     class="absolute inset-0 w-full h-full object-cover rounded-xl shadow-2xl transition-opacity duration-1000 opacity-0 image-slide">

                <div class="absolute inset-0 rounded-xl blur-2xl bg-indigo-500 opacity-20"></div>

            </div>

        </div>
    </div>
</section>

<!-- Unified Inbox Section -->
<section class="relative py-24 bg-[#0B1120]">

    <!-- FLOATING CONTAINER -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-[#050816] rounded-2xl shadow-2xl border border-gray-800 p-8 sm:p-12 
                    -mt-32 z-10">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- LEFT IMAGE -->
                <div class="relative">
                    <img src="{{ asset('images/unified-inbox.png') }}" 
                         class="rounded-xl shadow-2xl border border-gray-800 animate-float-slow">

                    <!-- subtle glow -->
                    <div class="absolute inset-0 rounded-xl blur-2xl bg-indigo-500 opacity-20"></div>
                </div>

                <!-- RIGHT TEXT -->
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                        Structured AI learning built for modern institutions
                    </h2>

                    <p class="mt-6 text-gray-300 text-lg">
                       Moose Loon AI Academy delivers a guided learning experience that combines AI theory, workflow automation, practical implementation, and real-world deployment projects.
                    </p>

                    <p class="mt-6 text-gray-400">
                    The program is designed for flexible institutional delivery through self-paced online learning, guided instruction, hybrid workshops, and project-based practical training.
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>

<section class="bg-[#050816] py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto text-center">

        <!-- TOP CONTENT -->
        <p class="text-indigo-500 font-semibold mb-4">
            AI built on a trusted foundation
        </p>

        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
           What students learn in the program
        </h2>

        <p class="mt-4 text-gray-400 text-lg max-w-3xl mx-auto">
            Students gain practical skills in AI systems, automation workflows, prompt engineering, APIs, AI chat agents, CRM integration, and intelligent business automation.
        </p>

        <!-- 🎥 VIDEO (CENTERED BETWEEN CONTENT) -->
        <div class="mt-14 relative">

            <!-- VIDEO -->
            <div class="aspect-video max-w-4xl mx-auto rounded-2xl overflow-hidden border border-gray-800 shadow-2xl relative z-10">

                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/wVR9lYTiAAo"
                    title="AI Agents Demo"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>

            </div>

            <!-- Glow (non-blocking) -->
            <div class="absolute -inset-2 bg-indigo-600/20 blur-2xl rounded-2xl pointer-events-none"></div>

        </div>

        <!-- 🔥 FEATURE CARDS -->
        <!-- PREMIUM FEATURE CARDS -->
<div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">

    <!-- CARD -->
    <div class="group bg-white/5 border border-white/10 rounded-2xl p-8 
                backdrop-blur-sm hover:border-indigo-500/40 
                hover:bg-white/[0.07] transition duration-300">

        <div class="w-14 h-14 rounded-xl bg-indigo-600/20 
                    flex items-center justify-center mb-6
                    group-hover:scale-110 transition">

            <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.75 3v4.5m4.5-4.5V6m-9 12.75h13.5A2.25 2.25 0 0021 16.5V7.5A2.25 2.25 0 0018.75 5.25H5.25A2.25 2.25 0 003 7.5v9a2.25 2.25 0 002.25 2.25z"/>
            </svg>

        </div>

        <h3 class="text-white font-semibold text-xl">
            AI Agents & Workflow Automation
        </h3>

        <p class="text-gray-400 mt-4 leading-relaxed">
            Learn how to design intelligent AI workflows, automation systems, 
            and customer interaction agents using modern no-code platforms.
        </p>

    </div>

    <!-- CARD -->
    <div class="group bg-white/5 border border-white/10 rounded-2xl p-8 
                backdrop-blur-sm hover:border-indigo-500/40 
                hover:bg-white/[0.07] transition duration-300">

        <div class="w-14 h-14 rounded-xl bg-indigo-600/20 
                    flex items-center justify-center mb-6
                    group-hover:scale-110 transition">

            <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M7.5 12h9m-9 4.5h5.25m-5.25-9h9m3 4.5A9 9 0 1112 3a9 9 0 019 9z"/>
            </svg>

        </div>

        <h3 class="text-white font-semibold text-xl">
            APIs, Integrations & Real-Time Systems
        </h3>

        <p class="text-gray-400 mt-4 leading-relaxed">
            Students learn how systems communicate through APIs, webhooks, 
            automation pipelines, and integrated AI workflows.
        </p>

    </div>

    <!-- CARD -->
    <div class="group bg-white/5 border border-white/10 rounded-2xl p-8 
                backdrop-blur-sm hover:border-indigo-500/40 
                hover:bg-white/[0.07] transition duration-300">

        <div class="w-14 h-14 rounded-xl bg-indigo-600/20 
                    flex items-center justify-center mb-6
                    group-hover:scale-110 transition">

            <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6l4 2m6-2A9 9 0 1112 3a9 9 0 0110 9z"/>
            </svg>

        </div>

        <h3 class="text-white font-semibold text-xl">
            Career & Business Application
        </h3>

        <p class="text-gray-400 mt-4 leading-relaxed">
            The curriculum prepares learners for freelancing, AI consulting, 
            automation services, and real-world implementation opportunities.
        </p>

    </div>

</div>

        <!-- CTA -->
        <div class="mt-12">
            <a href="{{ route('contactus') }}" 
               class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:bg-indigo-700 transition">
                View Partnership Opportunities
            </a>
        </div>

    </div>
</section>

<!-- PREMIUM INSTITUTIONAL PARTNERSHIP SECTION -->
<section class="relative py-28 bg-gray-950 overflow-hidden">

    <!-- BACKGROUND GLOW -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-indigo-600/20 blur-[140px] rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- TOP LABEL -->
        <div class="text-center">

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 text-indigo-300 text-sm font-medium backdrop-blur-xl">
                <span class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></span>
                Institutional Partnership Program
            </div>

            <!-- HEADING -->
            <h2 class="mt-8 text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-tight max-w-5xl mx-auto">
                Bring AI Certification Into Your Institution
            </h2>

            <p class="mt-8 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Moose Loon AI Academy partners with schools, colleges, and training institutions to deliver a modern
                <span class="text-white font-semibold">Artificial Intelligence & Automation Systems Certification Program</span>
                built for practical skills, employability, and future-ready education.
            </p>

            <!-- STATS -->
            <div class="mt-12 flex flex-wrap justify-center gap-4">

                <div class="px-6 py-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xl">
                    <p class="text-3xl font-black text-white">19</p>
                    <p class="text-sm text-gray-400 mt-1">Structured Modules</p>
                </div>

                <div class="px-6 py-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xl">
                    <p class="text-3xl font-black text-white">8</p>
                    <p class="text-sm text-gray-400 mt-1">Weeks Duration</p>
                </div>

                <div class="px-6 py-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xl">
                    <p class="text-3xl font-black text-white">100%</p>
                    <p class="text-sm text-gray-400 mt-1">Self-Paced Delivery</p>
                </div>

            </div>

        </div>

        <!-- VIDEO -->
        <div class="mt-20 relative">

            <!-- glow -->
            <div class="absolute -inset-6 bg-indigo-600/20 blur-3xl rounded-[40px]"></div>

            <div class="relative aspect-video max-w-5xl mx-auto rounded-[28px] overflow-hidden border border-white/10 shadow-[0_30px_100px_rgba(0,0,0,0.6)]">

                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/MDrVJ-IU-Dc"
                    title="Institutional AI Program"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>

            </div>
        </div>

        <!-- VALUE GRID -->
        <div class="mt-24 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- CARD -->
            <div class="group p-8 rounded-3xl bg-white/[0.04] border border-white/10 backdrop-blur-xl hover:bg-white/[0.07] transition duration-300">

                <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-2xl mb-6">
                    📘
                </div>

                <h3 class="text-xl font-bold text-white">
                    Structured Curriculum
                </h3>

                <p class="mt-4 text-gray-400 leading-relaxed">
                    A complete 19-module AI certification framework covering automation systems, AI agents, APIs, workflows, integrations, and deployment.
                </p>

            </div>

            <!-- CARD -->
            <div class="group p-8 rounded-3xl bg-white/[0.04] border border-white/10 backdrop-blur-xl hover:bg-white/[0.07] transition duration-300">

                <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-2xl mb-6">
                    ⚡
                </div>

                <h3 class="text-xl font-bold text-white">
                    Practical AI Training
                </h3>

                <p class="mt-4 text-gray-400 leading-relaxed">
                    Students build real AI workflows, automation systems, WhatsApp AI agents, and business-ready implementations.
                </p>

            </div>

            <!-- CARD -->
            <div class="group p-8 rounded-3xl bg-white/[0.04] border border-white/10 backdrop-blur-xl hover:bg-white/[0.07] transition duration-300">

                <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-2xl mb-6">
                    🎓
                </div>

                <h3 class="text-xl font-bold text-white">
                    Institution-Ready Delivery
                </h3>

                <p class="mt-4 text-gray-400 leading-relaxed">
                    Flexible self-paced implementation designed for colleges, universities, technical institutions, and training centers.
                </p>

            </div>

        </div>

        <!-- HOW IT WORKS -->
        <div class="mt-28">

            <div class="text-center mb-14">

                <p class="text-indigo-400 font-semibold uppercase tracking-widest">
                    Partnership Workflow
                </p>

                <h3 class="mt-4 text-4xl font-black text-white">
                    How Institutions Partner With Us
                </h3>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- STEP -->
                <div class="relative p-8 rounded-3xl bg-gradient-to-b from-white/[0.08] to-white/[0.03] border border-white/10">

                    <div class="absolute top-6 right-6 text-5xl font-black text-white/10">
                        01
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-2xl mb-6">
                        🏫
                    </div>

                    <h4 class="text-2xl font-bold text-white">
                        Institution Onboarding
                    </h4>

                    <p class="mt-4 text-gray-400 leading-relaxed">
                        We align the certification program with your academic structure, intake model, and institutional delivery framework.
                    </p>

                </div>

                <!-- STEP -->
                <div class="relative p-8 rounded-3xl bg-gradient-to-b from-white/[0.08] to-white/[0.03] border border-white/10">

                    <div class="absolute top-6 right-6 text-5xl font-black text-white/10">
                        02
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-2xl mb-6">
                        💻
                    </div>

                    <h4 class="text-2xl font-bold text-white">
                        Student Learning
                    </h4>

                    <p class="mt-4 text-gray-400 leading-relaxed">
                        Learners access guided modules, AI projects, automation systems, assessments, and practical implementation training.
                    </p>

                </div>

                <!-- STEP -->
                <div class="relative p-8 rounded-3xl bg-gradient-to-b from-white/[0.08] to-white/[0.03] border border-white/10">

                    <div class="absolute top-6 right-6 text-5xl font-black text-white/10">
                        03
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-2xl mb-6">
                        🚀
                    </div>

                    <h4 class="text-2xl font-bold text-white">
                        Certification Outcomes
                    </h4>

                    <p class="mt-4 text-gray-400 leading-relaxed">
                        Students complete practical projects and earn the Certificate in Artificial Intelligence & Automation Systems.
                    </p>

                </div>

            </div>

        </div>

        <!-- FINAL CTA -->
        <div class="mt-28">

            <div class="relative overflow-hidden rounded-[36px] border border-white/10 bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-700 p-10 sm:p-16 text-center">

                <!-- overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.2),transparent_40%)]"></div>

                <div class="relative">

                    <p class="text-indigo-100 font-semibold uppercase tracking-[0.3em]">
                        Start Your Partnership
                    </p>

                    <h3 class="mt-6 text-4xl sm:text-5xl font-black text-white leading-tight">
                        Launch AI Certification For Your Students
                    </h3>

                    <p class="mt-6 text-lg text-indigo-100 max-w-2xl mx-auto">
                        Introduce future-ready AI education into your institution with a structured curriculum, practical learning framework, and modern automation training.
                    </p>

                    <div class="mt-10 flex flex-wrap justify-center gap-4">

                        <a href="{{route('contactus')}}"
                           class="px-8 py-4 rounded-2xl bg-white text-gray-900 font-bold hover:scale-105 transition duration-300 shadow-2xl">
                            Request Partnership Proposal
                        </a>

                        <a href="#industries"
                           class="px-8 py-4 rounded-2xl border border-white/30 text-white font-semibold hover:bg-white/10 transition">
                            Explore Program Areas
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>



    <!-- ============================= -->
<!-- INDUSTRY TOOLS + ECOSYSTEM -->
<!-- ============================= -->

<section class="relative bg-gray-950 overflow-hidden py-28">

    <!-- Background Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[700px] bg-indigo-600/20 blur-3xl rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- HEADER -->
        <div class="text-center max-w-4xl mx-auto">

            <span class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-sm font-semibold">
                AI Tools Used Across Modern Industry
            </span>

            <h2 class="mt-8 text-4xl sm:text-5xl font-extrabold text-white leading-tight">
                Students train using real-world AI platforms
            </h2>

            <p class="mt-6 text-xl text-gray-400 leading-relaxed">
                Learn automation, AI workflows, integrations, and intelligent systems using the same platforms powering modern businesses and digital operations.
            </p>

        </div>

        <!-- LOGO CLOUD -->
        <div class="mt-20 relative overflow-hidden">

            <!-- Fade Edges -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-gray-950 to-transparent z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-gray-950 to-transparent z-10"></div>

            <div class="flex items-center gap-20 animate-slide whitespace-nowrap">

                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/N8n-logo-new.png')}}" alt="n8n">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Make-Logo.png')}}" alt="Make">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Zapier_Logo.png')}}" alt="Zapier">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Canva_Logo.png')}}" alt="Canva">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Amazon_Web_Services_Logo.png')}}" alt="AWS">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Relevance_AI_Logo.png')}}" alt="Relevance AI">

                <!-- duplicate -->
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/N8n-logo-new.png')}}" alt="n8n">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Make-Logo.png')}}" alt="Make">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Zapier_Logo.png')}}" alt="Zapier">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Canva_Logo.png')}}" alt="Canva">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Amazon_Web_Services_Logo.png')}}" alt="AWS">
                <img class="h-14 w-auto opacity-70 hover:opacity-100 transition duration-300" src="{{asset('images/Relevance_AI_Logo.png')}}" alt="Relevance AI">

            </div>
        </div>

    </div>
</section>





<!-- ============================= -->
<!-- ECOSYSTEM SECTION -->
<!-- ============================= -->

<section class="relative bg-white py-28 overflow-hidden">

    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-100 blur-3xl rounded-full opacity-40"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-20 items-center">

            <!-- LEFT -->
            <div>

                <span class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">
                    Complete AI Learning Ecosystem
                </span>

                <h2 class="mt-4 text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                    A premium learning experience designed for modern AI education
                </h2>

                <p class="mt-6 text-xl text-gray-600 leading-relaxed">
                    Structured learning, guided implementation, workflow automation, AI systems, and practical deployment — all integrated into one institutional-ready platform.
                </p>

                <!-- FEATURES -->
                <div class="mt-12 space-y-5">

                    <div class="flex items-start gap-5 bg-gray-50 border border-gray-100 rounded-2xl p-6 hover:shadow-xl transition duration-300">

                        <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-lg font-bold">
                            AI
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                AI Learning & Practical Implementation
                            </h3>

                            <p class="mt-2 text-gray-600">
                                Students learn how to build and deploy real AI-powered systems through guided projects and hands-on implementation.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-start gap-5 bg-gray-50 border border-gray-100 rounded-2xl p-6 hover:shadow-xl transition duration-300">

                        <div class="w-12 h-12 rounded-xl bg-black text-white flex items-center justify-center text-lg font-bold">
                            API
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Automation & Workflow Systems
                            </h3>

                            <p class="mt-2 text-gray-600">
                                Learners connect tools, APIs, CRMs, and automation engines to create scalable AI workflows.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-start gap-5 bg-gray-50 border border-gray-100 rounded-2xl p-6 hover:shadow-xl transition duration-300">

                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-lg font-bold">
                            ✓
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Industry-Aligned Certification
                            </h3>

                            <p class="mt-2 text-gray-600">
                                Built around modern AI skill requirements, automation systems, and real-world digital business implementation.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative">

                <!-- Main Image -->
                <div class="relative z-10">
                    <img class="rounded-3xl shadow-2xl border border-gray-200"
                         src="{{asset('images/AI-Solutions.png')}}"
                         alt="AI Learning Platform">
                </div>

                <!-- Floating Card -->
                <div class="absolute -bottom-10 -left-10 bg-white rounded-2xl shadow-2xl border border-gray-100 p-6 w-72 z-20 hidden lg:block">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500">
                                Student Learning Progress
                            </p>

                            <h4 class="text-3xl font-extrabold text-gray-900 mt-1">
                                94%
                            </h4>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-green-600 text-2xl">
                            ↑
                        </div>

                    </div>

                    <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full w-[94%] bg-indigo-600 rounded-full"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>






<!-- ============================= -->
<!-- DELIVERY PROCESS -->
<!-- ============================= -->

<section class="bg-gray-50 py-28">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- HEADER -->
        <div class="text-center max-w-3xl mx-auto">

            <span class="text-indigo-600 font-semibold uppercase tracking-wider text-sm">
                Program Delivery Framework
            </span>

            <h2 class="mt-4 text-4xl sm:text-5xl font-extrabold text-gray-900">
                How institutions deliver the certification program
            </h2>

            <p class="mt-6 text-xl text-gray-600">
                A structured educational workflow designed for scalable institutional deployment.
            </p>

        </div>

        <!-- STEPS -->
        <div class="mt-20 grid lg:grid-cols-3 gap-8">

            <!-- STEP -->
            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 hover:shadow-2xl transition duration-500">

                <div class="w-16 h-16 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl font-bold">
                    1
                </div>

                <h3 class="mt-8 text-2xl font-bold text-gray-900">
                    Enrollment & Setup
                </h3>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Institutions onboard students into a guided AI certification pathway with structured curriculum access.
                </p>

                <img class="mt-8 rounded-2xl shadow-lg"
                     src="{{asset('images/Discovery-Phase.png')}}">

            </div>

            <!-- STEP -->
            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 hover:shadow-2xl transition duration-500">

                <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center text-2xl font-bold">
                    2
                </div>

                <h3 class="mt-8 text-2xl font-bold text-gray-900">
                    Learning & Development
                </h3>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Students progress through AI fundamentals, APIs, automation systems, workflows, and agentic AI implementation.
                </p>

                <img class="mt-8 rounded-2xl shadow-lg"
                     src="{{asset('images/Development-Process.png')}}">

            </div>

            <!-- STEP -->
            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 hover:shadow-2xl transition duration-500">

                <div class="w-16 h-16 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-2xl font-bold">
                    3
                </div>

                <h3 class="mt-8 text-2xl font-bold text-gray-900">
                    Certification & Outcomes
                </h3>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Learners complete practical assessments and real-world projects to earn certification.
                </p>

                <img class="mt-8 rounded-2xl shadow-lg"
                     src="{{asset('images/Deployment.png')}}">

            </div>

        </div>

    </div>
</section>







<!-- ============================= -->
<!-- AI COMPONENTS -->
<!-- ============================= -->

<section class="bg-gray-950 py-28 overflow-hidden relative">

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-600/20 blur-3xl rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-20 items-center">

            <!-- LEFT -->
            <div>

                <span class="text-indigo-400 uppercase tracking-wider font-semibold text-sm">
                    AI System Foundations
                </span>

                <h2 class="mt-4 text-4xl sm:text-5xl font-extrabold text-white leading-tight">
                    Core components students learn to build with AI
                </h2>

                <p class="mt-6 text-xl text-gray-400">
                    Understanding how intelligent systems operate, connect, remember, and automate real-world workflows.
                </p>

                <div class="mt-12 space-y-6">

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">
                        <h3 class="text-xl font-bold text-white">
                            🧠 Decision Systems
                        </h3>

                        <p class="mt-3 text-gray-400">
                            Learn how AI models interpret prompts, process information, and generate intelligent outputs.
                        </p>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">
                        <h3 class="text-xl font-bold text-white">
                            💾 Context Systems
                        </h3>

                        <p class="mt-3 text-gray-400">
                            Understand memory, context retention, and how AI systems maintain continuity across workflows.
                        </p>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">
                        <h3 class="text-xl font-bold text-white">
                            🛠️ Integration Systems
                        </h3>

                        <p class="mt-3 text-gray-400">
                            Connect APIs, CRMs, databases, automation engines, and external tools into AI ecosystems.
                        </p>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative">

                <img src="{{asset('images/agent.jpg')}}"
                     class="rounded-3xl shadow-2xl border border-white/10">

                <div class="absolute -bottom-8 -right-8 bg-white rounded-2xl shadow-2xl p-6 hidden lg:block">

                    <p class="text-sm text-gray-500">
                        AI Workflow Systems
                    </p>

                    <h4 class="mt-2 text-2xl font-extrabold text-gray-900">
                        Live Integrations
                    </h4>

                    <div class="mt-4 flex gap-3">
                        <div class="w-10 h-10 rounded-xl bg-green-500"></div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-600"></div>
                        <div class="w-10 h-10 rounded-xl bg-yellow-500"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select all elements with the 'data-counter' class.
            const counters = document.querySelectorAll('.data-counter');

            // Set up a new IntersectionObserver to watch for elements entering the viewport.
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    // Check if the element is currently visible.
                    if (entry.isIntersecting) {
                        const counterElement = entry.target;
                        // Get the target number from the 'data-target' attribute.
                        const target = parseInt(counterElement.dataset.target, 10);
                        const duration = 2000; // Animation duration in milliseconds.
                        const startTimestamp = performance.now();
                        
                        // Define the update function for the animation frame.
                        const updateCount = (timestamp) => {
                            const elapsed = timestamp - startTimestamp;
                            const progress = Math.min(elapsed / duration, 1);
                            const currentValue = Math.floor(progress * target);
                            
                            // Format the number based on its size and add the appropriate suffix.
                            let formattedValue;
                            if (target >= 1000) {
                                formattedValue = (currentValue / 1000).toFixed(1) + 'K+';
                            } else {
                                formattedValue = currentValue + '+';
                            }
                            
                            counterElement.textContent = formattedValue;
                            
                            // Continue the animation until progress is 1.
                            if (progress < 1) {
                                requestAnimationFrame(updateCount);
                            }
                        };
                        
                        // Start the animation.
                        requestAnimationFrame(updateCount);

                        // Stop observing the element after the animation has started.
                        observer.unobserve(counterElement);
                    }
                });
            }, {
                // The threshold determines how much of the element needs to be visible to trigger the observer.
                threshold: 0.5
            });

            // Tell the observer to watch each counter element.
            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
         function toggleAccordion(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-45');
        }

        document.addEventListener("DOMContentLoaded", function () {
            const slides = document.querySelectorAll(".image-slide");
            let index = 0;

            setInterval(() => {
                slides[index].classList.remove("opacity-100");
                slides[index].classList.add("opacity-0");

                index = (index + 1) % slides.length;

                slides[index].classList.remove("opacity-0");
                slides[index].classList.add("opacity-100");
            }, 3000); // change every 3s
        });
    </script>
@endsection