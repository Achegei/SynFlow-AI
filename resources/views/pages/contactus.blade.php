@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- GRID WRAPPER -->
 <div class="grid grid-cols-1 lg:grid-cols-[1.05fr_.95fr] gap-16 items-start">

    <!-- LEFT SIDE -->
    <div class="relative">

        <!-- Glow -->
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>

        <div class="relative z-10">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-indigo-200 bg-indigo-50 text-indigo-700 text-sm font-semibold mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                AI Education • Automation Systems • Institutional Training
            </div>

            <!-- Heading -->
            <h2 class="text-4xl sm:text-5xl font-black tracking-tight text-gray-900 leading-tight">
                Build Future-Ready AI Skills with
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                    Moose Loon AI Academy
                </span>
            </h2>

            <!-- Paragraph -->
            <p class="mt-6 text-xl leading-relaxed text-gray-600 max-w-2xl">
                Partner with Moose Loon AI Academy to deliver practical Artificial Intelligence & Automation training designed for real-world careers, business systems, and modern digital workplaces.
            </p>

            <!-- Stats -->
            <div class="mt-8 grid grid-cols-3 gap-4">

                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-3xl font-black text-gray-900">19</p>
                    <p class="text-sm text-gray-500 mt-1">
                        AI Training Modules
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-3xl font-black text-gray-900">12–16</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Weeks Program Duration
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-3xl font-black text-gray-900">100%</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Practical Learning Focus
                    </p>
                </div>

            </div>

            <!-- Feature Cards -->
            <div class="mt-10 space-y-4">

                <div class="group bg-white/80 backdrop-blur border border-gray-200 hover:border-indigo-300 rounded-2xl p-5 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl font-bold">
                            🤖
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                AI Agents & Automation Systems
                            </h3>

                            <p class="text-gray-600 mt-1">
                                Students learn to build AI-powered workflows, automation systems, APIs, and intelligent business processes.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="group bg-white/80 backdrop-blur border border-gray-200 hover:border-indigo-300 rounded-2xl p-5 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl font-bold">
                            🎓
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Structured Certification Program
                            </h3>

                            <p class="text-gray-600 mt-1">
                                A guided curriculum covering AI fundamentals, prompt engineering, workflows, APIs, integrations, and deployment systems.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="group bg-white/80 backdrop-blur border border-gray-200 hover:border-indigo-300 rounded-2xl p-5 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center text-xl font-bold">
                            🚀
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Industry-Ready Digital Skills
                            </h3>

                            <p class="text-gray-600 mt-1">
                                Learners gain hands-on experience using modern AI platforms and automation tools used across global industries.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

        <!-- RIGHT SIDE FORM -->
<div class="relative">

    <!-- Glow -->
    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 blur-3xl rounded-[40px]"></div>

    <div class="relative bg-white/90 backdrop-blur-xl border border-white/40 shadow-2xl rounded-[32px] overflow-hidden">

        <!-- Top Accent -->
        <div class="h-2 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500"></div>

        <div class="p-8 sm:p-12 lg:p-14">

            <!-- Header -->
            <div class="mb-10">

                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-sm font-semibold mb-5">
                    <span class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse"></span>
                    Contact Moose Loon AI Academy
                </div>

                <h3 class="text-4xl font-black tracking-tight text-gray-900 leading-tight">
                    Let's Build Something
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                        Intelligent
                    </span>
                </h3>

                <p class="mt-4 text-lg leading-relaxed text-gray-600 max-w-2xl">
                    Tell us about your institution, organization, or AI goals. We’ll help you explore certification programs, AI systems, automation workflows, and deployment opportunities.
                </p>

            </div>

            @if(session('success'))
                <div class="mb-8 p-5 bg-green-50 border border-green-200 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">
                            Your Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            placeholder="John Doe"
                            class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">
                            Work Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            placeholder="you@company.com"
                            class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                        >
                    </div>

                </div>

                <!-- Role -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-800 mb-2">
                            Your Role / Title
                        </label>

                        <input
                            type="text"
                            id="role"
                            name="role"
                            placeholder="Director, Lecturer, Founder..."
                            class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                        >
                    </div>

                    <div>
                        <label for="company_name" class="block text-sm font-semibold text-gray-800 mb-2">
                            Institution / Company Name
                        </label>

                        <input
                            type="text"
                            id="company_name"
                            name="company_name"
                            placeholder="Your organization"
                            class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                        >
                    </div>

                </div>

                <!-- Website -->
                <div>

                    <label for="company_website" class="block text-sm font-semibold text-gray-800 mb-2">
                        Website (Optional)
                    </label>

                    <input
                        type="url"
                        id="company_website"
                        name="company_website"
                        placeholder="https://example.com"
                        class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                    >

                </div>

                <!-- Selects -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div>
                        <label for="company_size" class="block text-sm font-semibold text-gray-800 mb-2">
                            Team Size
                        </label>

                        <select
                            id="company_size"
                            name="company_size"
                            class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                        >
                            <option value="">Select size</option>
                            <option value="Less than 20">Less than 20</option>
                            <option value="20-50">20-50</option>
                            <option value="50-100">50-100</option>
                            <option value="100-500">100-500</option>
                            <option value="More than 500">More than 500</option>
                        </select>
                    </div>

                    <div>
                        <label for="revenue" class="block text-sm font-semibold text-gray-800 mb-2">
                            Revenue
                        </label>

                        <select
                            id="revenue"
                            name="revenue"
                            class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                        >
                            <option value="">Select range</option>
                            <option value="Less than KES 100K">Less than KES 100K</option>
                            <option value="KES100K-KES500K">KES 100K - KES 500K</option>
                            <option value="KES500K-KES1M">KES 500K - KES 1M</option>
                            <option value="KES1M-KES2M">KES 1M - KES 2M</option>
                            <option value="More than KES2M">More than KES 2M</option>
                        </select>
                    </div>

                    <div>
                        <label for="budget" class="block text-sm font-semibold text-gray-800 mb-2">
                            Budget
                        </label>

                        <select
                            id="budget"
                            name="budget"
                            class="w-full h-14 px-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"
                        >
                            <option value="">Select budget</option>
                            <option value="Under 20K">Under KES 20K</option>
                            <option value="KES20K-KES 50K">KES 20K - KES 50K</option>
                        </select>
                    </div>

                </div>

                <!-- Services -->
                <fieldset>

                    <legend class="text-sm font-semibold text-gray-800 mb-4">
                        What can we help you with?
                    </legend>

                    <div class="grid gap-4">

                        <label class="group flex items-start gap-4 p-5 rounded-2xl border border-gray-200 bg-gray-50 hover:border-indigo-300 hover:bg-indigo-50 transition cursor-pointer">

                            <input type="checkbox" id="service1" name="services[]" value="Identifying AI opportunities" class="mt-1 h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

                            <div>
                                <p class="font-semibold text-gray-900">
                                    AI Opportunity Discovery
                                </p>

                                <p class="text-sm text-gray-600 mt-1">
                                    Identify practical AI systems and automation opportunities for your organization.
                                </p>
                            </div>

                        </label>

                        <label class="group flex items-start gap-4 p-5 rounded-2xl border border-gray-200 bg-gray-50 hover:border-indigo-300 hover:bg-indigo-50 transition cursor-pointer">

                            <input type="checkbox" id="service2" name="services[]" value="Educating your team on AI" class="mt-1 h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

                            <div>
                                <p class="font-semibold text-gray-900">
                                    AI Training & Certification
                                </p>

                                <p class="text-sm text-gray-600 mt-1">
                                    Upskill teams and students with structured AI & automation training.
                                </p>
                            </div>

                        </label>

                        <label class="group flex items-start gap-4 p-5 rounded-2xl border border-gray-200 bg-gray-50 hover:border-indigo-300 hover:bg-indigo-50 transition cursor-pointer">

                            <input type="checkbox" id="service3" name="services[]" value="Developing custom AI solutions" class="mt-1 h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

                            <div>
                                <p class="font-semibold text-gray-900">
                                    Custom AI Systems
                                </p>

                                <p class="text-sm text-gray-600 mt-1">
                                    Build tailored AI workflows, agents, automation systems, and integrations.
                                </p>
                            </div>

                        </label>

                    </div>

                </fieldset>

                <!-- Message -->
                <div>

                    <label for="message" class="block text-sm font-semibold text-gray-800 mb-2">
                        Tell us about your goals
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        placeholder="Share your institution goals, AI challenges, automation ideas, or certification interests..."
                        class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition resize-none"
                    ></textarea>

                </div>

                <!-- CTA -->
                <div class="pt-2">

                    <button
                        type="submit"
                        class="group relative overflow-hidden w-full h-16 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-lg font-bold shadow-xl hover:shadow-2xl transition duration-300 hover:scale-[1.01]"
                    >

                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Submit Inquiry
                            <span class="group-hover:translate-x-1 transition">→</span>
                        </span>

                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition"></div>

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection

<script>
document.querySelector("form").addEventListener("submit", function (e) {
    const checkboxes = document.querySelectorAll("input[name='services[]']");
    let checked = false;

    checkboxes.forEach((box) => {
        if (box.checked) checked = true;
    });

    if (!checked) {
        e.preventDefault();
        alert("Please select at least one service.");
    }
});
</script>