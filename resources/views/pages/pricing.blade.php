@extends('layouts.public')

@section('title', 'AI & Automation Curriculum - Moose Loon AI Academy')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden bg-white">

    <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-100 rounded-full blur-3xl opacity-40"></div>
    </div>

    <div class="relative container mx-auto px-6 py-24">

        <div class="max-w-4xl mx-auto text-center">

            <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold text-sm">
                FUTURE-READY AI EDUCATION
            </div>

            <h1 class="mt-8 text-5xl sm:text-6xl font-black tracking-tight text-gray-900 leading-tight">
                Artificial Intelligence <br>
                & Automation Systems
            </h1>

            <p class="mt-8 text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Learn practical Artificial Intelligence, AI Agents, automation systems, workflow design, APIs, and real-world AI deployment through a flexible online learning experience designed for modern learners.
            </p>

            <div class="mt-10 flex flex-wrap justify-center gap-4">

                <div class="px-5 py-3 rounded-2xl bg-gray-100 text-gray-700 font-medium">
                    100% Online
                </div>

                <div class="px-5 py-3 rounded-2xl bg-gray-100 text-gray-700 font-medium">
                    Self-Paced Learning
                </div>

                <div class="px-5 py-3 rounded-2xl bg-gray-100 text-gray-700 font-medium">
                    Beginner Friendly
                </div>

                <div class="px-5 py-3 rounded-2xl bg-gray-100 text-gray-700 font-medium">
                    Real-World Projects
                </div>

                <div class="px-5 py-3 rounded-2xl bg-gray-100 text-gray-700 font-medium">
                    Practical AI Skills
                </div>

            </div>

            <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4">

                <a href="{{route('contactus')}}"
                   class="inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition shadow-xl shadow-indigo-200">
                    Make an Enquiry
                </a>

                <a href="#curriculum"
                   class="inline-flex items-center justify-center px-8 py-4 rounded-2xl border border-gray-300 bg-white text-gray-800 font-semibold hover:bg-gray-50 transition">
                    Explore Curriculum
                </a>

            </div>

            <p class="mt-6 text-sm text-gray-500">
                Want to know the program investment or enrollment process?
                <a href="{{route('contactus')}}" class="text-indigo-600 font-semibold hover:underline">
                    Send us an enquiry
                </a>
            </p>

        </div>

    </div>

</section>

<!-- WHY SECTION -->
<section class="py-24 bg-gray-50">

    <div class="container mx-auto px-6">

        <div class="max-w-3xl mx-auto text-center">

            <h2 class="text-4xl font-black text-gray-900">
                Built for Modern Learners
            </h2>

            <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                Our learning experience is designed to be flexible, affordable, practical, and career-focused — allowing students to build real AI skills without traditional learning limitations.
            </p>

        </div>

        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">

            <!-- CARD -->
            <div class="group bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">

                <div class="w-16 h-16 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl shadow-lg">
                    🌍
                </div>

                <h3 class="mt-8 text-2xl font-bold text-gray-900">
                    Learn From Anywhere
                </h3>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Study online from anywhere at your own pace using structured lessons and guided practical learning.
                </p>

            </div>

            <!-- CARD -->
            <div class="group bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">

                <div class="w-16 h-16 rounded-2xl bg-cyan-600 text-white flex items-center justify-center text-2xl shadow-lg">
                    💡
                </div>

                <h3 class="mt-8 text-2xl font-bold text-gray-900">
                    Practical Skills
                </h3>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Build AI workflows, automation systems, AI chat agents, integrations, and portfolio-ready projects.
                </p>

            </div>

            <!-- CARD -->
            <div class="group bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">

                <div class="w-16 h-16 rounded-2xl bg-purple-600 text-white flex items-center justify-center text-2xl shadow-lg">
                    🚀
                </div>

                <h3 class="mt-8 text-2xl font-bold text-gray-900">
                    Career Focused
                </h3>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Learn modern AI skills relevant to freelancing, remote work, consulting, entrepreneurship, and digital careers.
                </p>

            </div>

            <!-- CARD -->
            <div class="group bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">

                <div class="w-16 h-16 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-2xl shadow-lg">
                    ⏱️
                </div>

                <h3 class="mt-8 text-2xl font-bold text-gray-900">
                    Flexible Learning
                </h3>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    No rigid schedules. Learn progressively through guided modules designed for busy students and professionals.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- PROGRAM OVERVIEW -->
<section class="py-24 bg-white">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <div class="inline-flex px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold text-sm">
                    PROGRAM OVERVIEW
                </div>

                <h2 class="mt-6 text-4xl font-black text-gray-900 leading-tight">
                    Learn AI Beyond Theory
                </h2>

                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    This program is designed to equip learners with practical and industry-relevant skills in Artificial Intelligence, workflow automation, AI systems, APIs, integrations, and intelligent business automation.
                </p>

                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Students progress from foundational AI concepts to advanced automation workflows and real-world deployment projects.
                </p>

                <div class="mt-10 space-y-4">

                    <div class="flex items-start gap-4">
                        <div class="text-indigo-600 font-bold text-xl">✓</div>
                        <p class="text-gray-700">Build AI-powered workflows and intelligent systems</p>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-indigo-600 font-bold text-xl">✓</div>
                        <p class="text-gray-700">Learn APIs, integrations, automation logic, and AI tools</p>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-indigo-600 font-bold text-xl">✓</div>
                        <p class="text-gray-700">Develop portfolio-ready practical projects</p>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-indigo-600 font-bold text-xl">✓</div>
                        <p class="text-gray-700">Gain skills relevant to modern AI careers and business automation</p>
                    </div>

                </div>

            </div>

            <!-- SIDE STATS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                    <h3 class="text-5xl font-black text-indigo-600">
                        19
                    </h3>
                    <p class="mt-3 text-gray-700 font-medium">
                        Structured Learning Modules
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                    <h3 class="text-5xl font-black text-cyan-600">
                        8
                    </h3>
                    <p class="mt-3 text-gray-700 font-medium">
                        Weeks Duration
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                    <h3 class="text-5xl font-black text-purple-600">
                        100%
                    </h3>
                    <p class="mt-3 text-gray-700 font-medium">
                        Practical & Hands-On
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                    <h3 class="text-5xl font-black text-emerald-600">
                        Online
                    </h3>
                    <p class="mt-3 text-gray-700 font-medium">
                        Flexible Learning Experience
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

<!-- CURRICULUM -->
<section id="curriculum" class="py-24 bg-gray-50">

    <div class="container mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto">

            <h2 class="text-4xl font-black text-gray-900">
                Curriculum Breakdown
            </h2>

            <p class="mt-6 text-lg text-gray-600">
                Structured modules designed to progressively build practical AI and automation competency.
            </p>

        </div>

        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition">
                <div class="text-indigo-600 font-bold text-sm">MODULES 1 – 4</div>
                <h3 class="mt-4 text-2xl font-bold text-gray-900">
                    AI Foundations
                </h3>

                <ul class="mt-6 space-y-3 text-gray-700">
                    <li>✓ Introduction to Artificial Intelligence</li>
                    <li>✓ AI in Business & Industry</li>
                    <li>✓ Prompt Engineering Fundamentals</li>
                    <li>✓ Markdown for AI Communication</li>
                </ul>
            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition">
                <div class="text-cyan-600 font-bold text-sm">MODULES 5 – 8</div>
                <h3 class="mt-4 text-2xl font-bold text-gray-900">
                    Automation & APIs
                </h3>

                <ul class="mt-6 space-y-3 text-gray-700">
                    <li>✓ No-Code Automation Tools</li>
                    <li>✓ APIs & System Integrations</li>
                    <li>✓ Working with External Tools</li>
                    <li>✓ Large Language Models (LLMs)</li>
                </ul>
            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition">
                <div class="text-purple-600 font-bold text-sm">MODULES 9 – 12</div>
                <h3 class="mt-4 text-2xl font-bold text-gray-900">
                    Workflow Systems
                </h3>

                <ul class="mt-6 space-y-3 text-gray-700">
                    <li>✓ Error Handling & Debugging</li>
                    <li>✓ Automation with n8n</li>
                    <li>✓ Building AI Workflows</li>
                    <li>✓ Webhooks & Real-Time Automation</li>
                </ul>
            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition">
                <div class="text-pink-600 font-bold text-sm">MODULES 13 – 16</div>
                <h3 class="mt-4 text-2xl font-bold text-gray-900">
                    AI Agents & Integrations
                </h3>

                <ul class="mt-6 space-y-3 text-gray-700">
                    <li>✓ Agentic AI Workflows</li>
                    <li>✓ AI Chat Agents</li>
                    <li>✓ WhatsApp AI Agents</li>
                    <li>✓ CRM Integration & Data Logging</li>
                </ul>
            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition">
                <div class="text-emerald-600 font-bold text-sm">MODULES 17 – 19</div>
                <h3 class="mt-4 text-2xl font-bold text-gray-900">
                    Projects & Career Skills
                </h3>

                <ul class="mt-6 space-y-3 text-gray-700">
                    <li>✓ Final AI System Project</li>
                    <li>✓ Client Delivery Skills</li>
                    <li>✓ Freelancing & Consulting</li>
                    <li>✓ Real-World AI Applications</li>
                </ul>
            </div>

            <!-- CARD -->
            <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl p-8 text-white shadow-xl">

                <div class="text-sm font-bold text-indigo-100">
                    CERTIFICATION
                </div>

                <h3 class="mt-4 text-3xl font-black">
                    Certificate Awarded
                </h3>

                <p class="mt-6 text-indigo-100 leading-relaxed">
                    Students who successfully complete all modules and the final project receive:
                </p>

                <div class="mt-6 text-xl font-bold">
                    Certificate in Artificial Intelligence & Automation Systems
                </div>

            </div>

        </div>

    </div>

</section>

<!-- LEARNING OUTCOMES -->
<section class="py-24 bg-white">

    <div class="container mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto">

            <h2 class="text-4xl font-black text-gray-900">
                What Students Will Be Able To Do
            </h2>

            <p class="mt-6 text-lg text-gray-600">
                Graduates develop practical skills applicable to real business environments and modern digital work.
            </p>

        </div>

        <div class="mt-16 grid md:grid-cols-2 gap-8">

            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">
                    Technical Skills
                </h3>

                <ul class="mt-6 space-y-4 text-gray-700">
                    <li>✓ Build AI-powered automation systems</li>
                    <li>✓ Design AI chat agents and workflows</li>
                    <li>✓ Integrate APIs and external tools</li>
                    <li>✓ Deploy intelligent automation systems</li>
                    <li>✓ Build WhatsApp AI workflows</li>
                    <li>✓ Create production-ready AI systems</li>
                </ul>
            </div>

            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">
                    Career & Business Skills
                </h3>

                <ul class="mt-6 space-y-4 text-gray-700">
                    <li>✓ Deliver AI solutions for businesses</li>
                    <li>✓ Conduct client discovery sessions</li>
                    <li>✓ Package AI automation services</li>
                    <li>✓ Build freelance-ready portfolios</li>
                    <li>✓ Understand modern AI business systems</li>
                    <li>✓ Apply AI to real-world business problems</li>
                </ul>
            </div>

        </div>

    </div>

</section>

<!-- FINAL CTA -->
<section class="relative overflow-hidden bg-gray-900 py-24 text-white">

    <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600 rounded-full blur-3xl opacity-20"></div>

    <div class="relative container mx-auto px-6 text-center">

        <h2 class="text-5xl font-black leading-tight">
            Start Your AI Journey
        </h2>

        <p class="mt-8 text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
            Flexible online learning designed to help you build practical AI skills, real-world automation systems, and future-ready digital capabilities.
        </p>

        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">

            <a href="{{route('contactus')}}"
               class="inline-flex items-center justify-center px-10 py-4 rounded-2xl bg-white text-gray-900 font-bold hover:bg-gray-100 transition">
                Make an Enquiry
            </a>

            <a href="#curriculum"
               class="inline-flex items-center justify-center px-10 py-4 rounded-2xl border border-white/20 bg-white/10 backdrop-blur text-white font-semibold hover:bg-white/20 transition">
                View Curriculum
            </a>

        </div>

        <p class="mt-8 text-sm text-gray-400">
            Want to know the program investment, enrollment process, or certification details?
        </p>

        <p class="mt-2 text-indigo-300 font-semibold">
            Send us an enquiry through the contact form and our team will guide you.
        </p>

    </div>

</section>

@endsection