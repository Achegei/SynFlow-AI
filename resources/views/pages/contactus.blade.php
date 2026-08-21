@extends('layouts.public')

@section('title', 'Contact Us - MooseLoon AI Academy')

@section('content')

{{-- ================================================================
     BREADCRUMB
================================================================ --}}

<section class="bg-white border-b border-slate-200 reveal-section">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="py-5 flex items-center gap-2 text-sm reveal-item reveal-left">

            <a
                href="{{ url('/') }}"
                class="text-slate-500 hover:text-[#1E73BE] transition"
            >
                Home
            </a>

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 text-slate-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="font-medium text-[#0B1F3A]">
                Contact Us
            </span>

        </div>

    </div>

</section>


{{-- ================================================================
     PAGE INTRO
================================================================ --}}

<section class="bg-[#F7FAFC] border-b border-slate-200 reveal-section">

    <div
        class="max-w-7xl
               mx-auto
               px-4
               sm:px-6
               lg:px-8
               py-14
               sm:py-16"
    >

        <div class="max-w-3xl">

            <div
                class="flex
                       items-center
                       gap-3
                       text-[#E31837]
                       text-xs
                       font-bold
                       uppercase
                       tracking-[0.16em]
                       reveal-item
                       reveal-left"
            >

                <span class="h-px w-8 bg-[#E31837]"></span>

                Contact MooseLoon AI Academy

            </div>


            <h1
                class="mt-5
                       text-3xl
                       sm:text-4xl
                       lg:text-[2.7rem]
                       font-extrabold
                       leading-tight
                       tracking-tight
                       text-[#0B1F3A]
                       reveal-item
                       reveal-left
                       reveal-delay-1"
            >
                Let's discuss your training,
                <span class="text-[#1E73BE]">
                    AI and automation goals.
                </span>
            </h1>


            <p
                class="mt-5
                       max-w-2xl
                       text-base
                       sm:text-lg
                       leading-relaxed
                       text-slate-600
                       reveal-item
                       reveal-left
                       reveal-delay-2"
            >
                Whether you are looking for professional training,
                institutional programs, or practical AI and automation
                solutions, our team is ready to discuss how we can help.
            </p>

        </div>

    </div>

</section>


{{-- ================================================================
     CONTACT CONTENT
================================================================ --}}

<section class="bg-white py-16 sm:py-20 reveal-section">

    <div
        class="max-w-7xl
               mx-auto
               px-4
               sm:px-6
               lg:px-8"
    >

        <div
            class="grid
                   grid-cols-1
                   lg:grid-cols-[0.82fr_1.18fr]
                   gap-12
                   xl:gap-20
                   items-start"
        >


            {{-- ========================================================
                 LEFT INFORMATION
            ========================================================= --}}

            <div>

                <h2
                    class="text-2xl
                           sm:text-3xl
                           font-extrabold
                           tracking-tight
                           text-[#0B1F3A]
                           reveal-item
                           reveal-left"
                >
                    How can we help?
                </h2>


                <p
                    class="mt-4
                           text-base
                           leading-relaxed
                           text-slate-600
                           max-w-xl
                           reveal-item
                           reveal-left
                           reveal-delay-1"
                >
                    Tell us what you are looking for and a member of our
                    team will get back to you with the appropriate
                    information or next steps.
                </p>


                {{-- Highlights --}}

                <div class="mt-8 space-y-4">

                    <div
                        class="flex
                               items-start
                               gap-4
                               rounded-2xl
                               border
                               border-slate-200
                               bg-slate-50
                               p-5
                               reveal-item
                               reveal-left
                               reveal-delay-1
                               hover:-translate-y-1
                               hover:shadow-md
                               transition-all
                               duration-300"
                    >

                        <div
                            class="flex
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-xl
                                bg-[#0B1F3A]
                                text-sm
                                font-bold
                                text-white"
                        >
                            01
                        </div>

                        <div>

                            <h3
                                class="font-bold
                                       text-[#0B1F3A]"
                            >
                                Practical Training
                            </h3>

                            <p
                                class="mt-1
                                       text-sm
                                       leading-relaxed
                                       text-slate-600"
                            >
                                Explore our AI, automation and digital
                                skills training programs.
                            </p>

                        </div>

                    </div>


                    <div
                        class="flex
                               items-start
                               gap-4
                               rounded-2xl
                               border
                               border-slate-200
                               bg-slate-50
                               p-5
                               reveal-item
                               reveal-left
                               reveal-delay-2
                               hover:-translate-y-1
                               hover:shadow-md
                               transition-all
                               duration-300"
                    >

                        <div
                        class="flex
                            h-11
                            w-11
                            shrink-0
                            items-center
                            justify-center
                            rounded-xl
                            bg-[#1E73BE]
                            text-sm
                            font-bold
                            text-white"
                    >
                        02
                    </div>

                        <div>

                            <h3
                                class="font-bold
                                       text-[#0B1F3A]"
                            >
                                Institutional Training
                            </h3>

                            <p
                                class="mt-1
                                       text-sm
                                       leading-relaxed
                                       text-slate-600"
                            >
                                Discuss training opportunities for
                                universities, colleges and organizations.
                            </p>

                        </div>

                    </div>


                    <div
                        class="flex
                               items-start
                               gap-4
                               rounded-2xl
                               border
                               border-slate-200
                               bg-slate-50
                               p-5
                               reveal-item
                               reveal-left
                               reveal-delay-3
                               hover:-translate-y-1
                               hover:shadow-md
                               transition-all
                               duration-300"
                    >

                        <div
                            class="flex
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-xl
                                bg-[#E31837]
                                text-sm
                                font-bold
                                text-white"
                        >
                            03
                        </div>
                        <div>

                            <h3
                                class="font-bold
                                       text-[#0B1F3A]"
                            >
                                AI & Automation Solutions
                            </h3>

                            <p
                                class="mt-1
                                       text-sm
                                       leading-relaxed
                                       text-slate-600"
                            >
                                Discuss automation, AI systems,
                                integrations and digital transformation.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Quick facts --}}

                <div
                    class="mt-8
                           border-t
                           border-slate-200
                           pt-7
                           reveal-item
                           reveal-left
                           reveal-delay-3"
                >

                    <div
                        class="grid
                               grid-cols-3
                               divide-x
                               divide-slate-200"
                    >

                        <div class="pr-4 quick-fact">

                            <p
                                class="text-2xl
                                       font-extrabold
                                       text-[#0B1F3A]"
                            >
                                17
                            </p>

                            <p
                                class="mt-1
                                       text-xs
                                       leading-relaxed
                                       text-slate-500"
                            >
                                Training Modules
                            </p>

                        </div>


                        <div class="px-4 quick-fact">

                            <p
                                class="text-2xl
                                       font-extrabold
                                       text-[#0B1F3A]"
                            >
                                8
                            </p>

                            <p
                                class="mt-1
                                       text-xs
                                       leading-relaxed
                                       text-slate-500"
                            >
                                Week Program
                            </p>

                        </div>


                        <div class="pl-4 quick-fact">

                            <p
                                class="text-2xl
                                       font-extrabold
                                       text-[#0B1F3A]"
                            >
                                100%
                            </p>

                            <p
                                class="mt-1
                                       text-xs
                                       leading-relaxed
                                       text-slate-500"
                            >
                                Practical Focus
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                 RIGHT FORM
            ========================================================= --}}

            <div
                class="rounded-3xl
                       border
                       border-slate-200
                       bg-white
                       shadow-[0_12px_45px_rgba(11,31,58,0.08)]
                       overflow-hidden
                       reveal-item
                       reveal-right"
            >

                {{-- Form header --}}

                <div
                    class="border-b
                           border-slate-200
                           bg-[#F7FAFC]
                           px-6
                           py-7
                           sm:px-8"
                >

                    <h2
                        class="text-2xl
                               font-extrabold
                               text-[#0B1F3A]
                               reveal-item
                               reveal-right
                               reveal-delay-1"
                    >
                        Send us an inquiry
                    </h2>

                    <p
                        class="mt-2
                               text-sm
                               leading-relaxed
                               text-slate-600
                               reveal-item
                               reveal-right
                               reveal-delay-2"
                    >
                        Complete the form below and provide a few details
                        about what you need.
                    </p>

                </div>


                <div class="p-6 sm:p-8">

                    @if(session('success'))

                        <div
                            class="mb-7
                                   flex
                                   items-start
                                   gap-3
                                   rounded-2xl
                                   border
                                   border-green-200
                                   bg-green-50
                                   p-4
                                   text-sm
                                   text-green-700
                                   reveal-item
                                   reveal-right"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            <span>
                                {{ session('success') }}
                            </span>

                        </div>

                    @endif


                    <form
                        action="{{ route('contact.submit') }}"
                        method="POST"
                        class="space-y-6"
                    >

                        @csrf


                        {{-- Name + Email --}}

                        <div
                            class="grid
                                   grid-cols-1
                                   md:grid-cols-2
                                   gap-5
                                   reveal-item
                                   reveal-right"
                        >

                            <div>

                                <label
                                    for="name"
                                    class="block
                                           text-sm
                                           font-semibold
                                           text-slate-800
                                           mb-2"
                                >
                                    Your Name
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    required
                                    placeholder="John Doe"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                                >

                            </div>


                            <div>

                                <label
                                    for="email"
                                    class="block
                                           text-sm
                                           font-semibold
                                           text-slate-800
                                           mb-2"
                                >
                                    Work Email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    required
                                    placeholder="you@company.com"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                                >

                            </div>

                        </div>


                        {{-- Role + Company --}}

                        <div
                            class="grid
                                   grid-cols-1
                                   md:grid-cols-2
                                   gap-5
                                   reveal-item
                                   reveal-right
                                   reveal-delay-1"
                        >

                            <div>

                                <label
                                    for="role"
                                    class="block
                                           text-sm
                                           font-semibold
                                           text-slate-800
                                           mb-2"
                                >
                                    Your Role / Title
                                </label>

                                <input
                                    type="text"
                                    id="role"
                                    name="role"
                                    placeholder="Director, Lecturer, Founder..."
                                    class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                                >

                            </div>


                            <div>

                                <label
                                    for="company_name"
                                    class="block
                                           text-sm
                                           font-semibold
                                           text-slate-800
                                           mb-2"
                                >
                                    Institution / Company Name
                                </label>

                                <input
                                    type="text"
                                    id="company_name"
                                    name="company_name"
                                    placeholder="Your organization"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                                >

                            </div>

                        </div>


                        {{-- Website --}}

                        <div class="reveal-item reveal-right reveal-delay-2">

                            <label
                                for="company_website"
                                class="block
                                       text-sm
                                       font-semibold
                                       text-slate-800
                                       mb-2"
                            >
                                Website
                                <span class="font-normal text-slate-400">
                                    (Optional)
                                </span>
                            </label>

                            <input
                                type="url"
                                id="company_website"
                                name="company_website"
                                placeholder="https://example.com"
                                class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                            >

                        </div>


                        {{-- Company details --}}

                        <div
                            class="grid
                                   grid-cols-1
                                   md:grid-cols-3
                                   gap-5
                                   reveal-item
                                   reveal-right
                                   reveal-delay-2"
                        >

                            <div>

                                <label
                                    for="company_size"
                                    class="block
                                           text-sm
                                           font-semibold
                                           text-slate-800
                                           mb-2"
                                >
                                    Team Size
                                </label>

                                <select
                                    id="company_size"
                                    name="company_size"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-700 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                                >

                                    <option value="">
                                        Select size
                                    </option>

                                    <option value="Less than 20">
                                        Less than 20
                                    </option>

                                    <option value="20-50">
                                        20-50
                                    </option>

                                    <option value="50-100">
                                        50-100
                                    </option>

                                    <option value="100-500">
                                        100-500
                                    </option>

                                    <option value="More than 500">
                                        More than 500
                                    </option>

                                </select>

                            </div>


                            <div>

                                <label
                                    for="revenue"
                                    class="block
                                           text-sm
                                           font-semibold
                                           text-slate-800
                                           mb-2"
                                >
                                    Revenue
                                </label>

                                <select
                                    id="revenue"
                                    name="revenue"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-700 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                                >

                                    <option value="">
                                        Select range
                                    </option>

                                    <option value="Less than KES 100K">
                                        Less than KES 100K
                                    </option>

                                    <option value="KES100K-KES500K">
                                        KES 100K - KES 500K
                                    </option>

                                    <option value="KES500K-KES1M">
                                        KES 500K - KES 1M
                                    </option>

                                    <option value="KES1M-KES2M">
                                        KES 1M - KES 2M
                                    </option>

                                    <option value="More than KES2M">
                                        More than KES 2M
                                    </option>

                                </select>

                            </div>


                            <div>

                                <label
                                    for="budget"
                                    class="block
                                           text-sm
                                           font-semibold
                                           text-slate-800
                                           mb-2"
                                >
                                    Budget
                                </label>

                                <select
                                    id="budget"
                                    name="budget"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-300 bg-white text-sm text-slate-700 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10"
                                >

                                    <option value="">
                                        Select budget
                                    </option>

                                    <option value="Under 20K">
                                        Under KES 20K
                                    </option>

                                    <option value="KES20K-KES 50K">
                                        KES 20K - KES 50K
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- Services --}}

                        <fieldset class="reveal-item reveal-right reveal-delay-3">

                            <legend
                                class="text-sm
                                       font-semibold
                                       text-slate-800
                                       mb-3"
                            >
                                What can we help you with?
                            </legend>


                            <div class="space-y-3">

                                <label
                                    class="flex
                                           items-start
                                           gap-3
                                           rounded-xl
                                           border
                                           border-slate-200
                                           p-4
                                           cursor-pointer
                                           transition
                                           hover:border-[#1E73BE]/40
                                           hover:bg-[#F7FAFC]"
                                >

                                    <input
                                        type="checkbox"
                                        id="service1"
                                        name="services[]"
                                        value="Identifying AI opportunities"
                                        class="mt-1 h-4 w-4 rounded border-slate-300 text-[#1E73BE] focus:ring-[#1E73BE]"
                                    >

                                    <div>

                                        <p class="text-sm font-semibold text-[#0B1F3A]">
                                            AI Opportunity Discovery
                                        </p>

                                        <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                            Identify practical AI and automation opportunities.
                                        </p>

                                    </div>

                                </label>


                                <label
                                    class="flex
                                           items-start
                                           gap-3
                                           rounded-xl
                                           border
                                           border-slate-200
                                           p-4
                                           cursor-pointer
                                           transition
                                           hover:border-[#1E73BE]/40
                                           hover:bg-[#F7FAFC]"
                                >

                                    <input
                                        type="checkbox"
                                        id="service2"
                                        name="services[]"
                                        value="Educating your team on AI"
                                        class="mt-1 h-4 w-4 rounded border-slate-300 text-[#1E73BE] focus:ring-[#1E73BE]"
                                    >

                                    <div>

                                        <p class="text-sm font-semibold text-[#0B1F3A]">
                                            AI Training & Certification
                                        </p>

                                        <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                            Upskill teams and learners through structured programs.
                                        </p>

                                    </div>

                                </label>


                                <label
                                    class="flex
                                           items-start
                                           gap-3
                                           rounded-xl
                                           border
                                           border-slate-200
                                           p-4
                                           cursor-pointer
                                           transition
                                           hover:border-[#1E73BE]/40
                                           hover:bg-[#F7FAFC]"
                                >

                                    <input
                                        type="checkbox"
                                        id="service3"
                                        name="services[]"
                                        value="Developing custom AI solutions"
                                        class="mt-1 h-4 w-4 rounded border-slate-300 text-[#1E73BE] focus:ring-[#1E73BE]"
                                    >

                                    <div>

                                        <p class="text-sm font-semibold text-[#0B1F3A]">
                                            Custom AI Systems
                                        </p>

                                        <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                            Build tailored AI workflows, agents and integrations.
                                        </p>

                                    </div>

                                </label>

                            </div>

                        </fieldset>


                        {{-- Message --}}

                        <div class="reveal-item reveal-right reveal-delay-3">

                            <label
                                for="message"
                                class="block
                                       text-sm
                                       font-semibold
                                       text-slate-800
                                       mb-2"
                            >
                                Tell us about your goals
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="5"
                                placeholder="Share your training needs, AI challenges, automation ideas, or certification interests..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-[#1E73BE] focus:ring-4 focus:ring-[#1E73BE]/10 resize-none"
                            ></textarea>

                        </div>


                        {{-- Submit --}}

                        <div class="pt-1 reveal-item reveal-right reveal-delay-4">

                            <button
                                type="submit"
                                class="inline-flex
                                       w-full
                                       h-13
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       bg-[#0B1F3A]
                                       px-6
                                       py-4
                                       text-sm
                                       font-bold
                                       text-white
                                       shadow-lg
                                       hover:bg-[#12345C]
                                       hover:-translate-y-0.5
                                       hover:shadow-xl
                                       transition-all
                                       duration-200"
                            >

                                Submit Inquiry

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"
                                    />
                                </svg>

                            </button>

                        </div>


                        <p
                            class="text-center
                                   text-xs
                                   text-slate-400
                                   reveal-item
                                   reveal-right
                                   reveal-delay-4"
                        >
                            We use the information you provide only to respond
                            to your inquiry.
                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ================================================================
     BOTTOM CTA
================================================================ --}}

<section class="bg-[#0B1F3A] reveal-section">

    <div
        class="max-w-7xl
               mx-auto
               px-4
               sm:px-6
               lg:px-8
               py-12"
    >

        <div
            class="flex
                   flex-col
                   md:flex-row
                   md:items-center
                   md:justify-between
                   gap-6"
        >

            <div class="reveal-item reveal-left">

                <p
                    class="text-xs
                           font-bold
                           uppercase
                           tracking-[0.16em]
                           text-blue-200"
                >
                    MooseLoon AI Academy
                </p>

                <h2
                    class="mt-2
                           text-xl
                           sm:text-2xl
                           font-bold
                           text-white"
                >
                    Practical skills for the future of work.
                </h2>

            </div>


            <a
                href="{{ route('contact') }}"
                class="inline-flex
                       shrink-0
                       items-center
                       justify-center
                       rounded-full
                       bg-white
                       px-6
                       py-3
                       text-sm
                       font-bold
                       text-[#0B1F3A]
                       hover:bg-blue-50
                       transition
                       reveal-item
                       reveal-right
                       reveal-delay-1"
            >
                Get in Touch

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="ml-2 h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3"
                    />
                </svg>

            </a>

        </div>

    </div>

</section>

@endsection


{{-- ================================================================
     FORM VALIDATION
================================================================ --}}

@push('scripts')

<style>
    /* ============================================================
       SCROLL REVEAL ANIMATIONS
    ============================================================ */

    .reveal-item {
        opacity: 0;
        transition:
            opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1),
            transform 0.75s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .reveal-left {
        transform: translateX(-45px);
    }

    .reveal-right {
        transform: translateX(45px);
    }

    .reveal-up {
        transform: translateY(35px);
    }

    .reveal-item.is-visible {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }

    .reveal-delay-1 {
        transition-delay: 0.10s;
    }

    .reveal-delay-2 {
        transition-delay: 0.20s;
    }

    .reveal-delay-3 {
        transition-delay: 0.30s;
    }

    .reveal-delay-4 {
        transition-delay: 0.40s;
    }


    /* ============================================================
       QUICK FACTS
    ============================================================ */

    .quick-fact {
        opacity: 0;
        transform: translateY(20px);
        transition:
            opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1),
            transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .quick-fact.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .quick-fact:nth-child(1) {
        transition-delay: 0.10s;
    }

    .quick-fact:nth-child(2) {
        transition-delay: 0.20s;
    }

    .quick-fact:nth-child(3) {
        transition-delay: 0.30s;
    }


    /* ============================================================
       ACCESSIBILITY
    ============================================================ */

    @media (prefers-reduced-motion: reduce) {

        .reveal-item,
        .quick-fact {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }

    }


    /* ============================================================
       MOBILE
    ============================================================ */

    @media (max-width: 640px) {

        .reveal-left,
        .reveal-right {
            transform: translateY(25px);
        }

    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       SCROLL REVEAL
    ============================================================ */

    const revealItems = document.querySelectorAll(
        '.reveal-item, .quick-fact'
    );

    if ('IntersectionObserver' in window) {

        const revealObserver = new IntersectionObserver(
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


        revealItems.forEach(function (item) {
            revealObserver.observe(item);
        });

    } else {

        revealItems.forEach(function (item) {
            item.classList.add('is-visible');
        });

    }


    /* ============================================================
       FORM VALIDATION
    ============================================================ */

    const form = document.querySelector('form[action="{{ route('contact.submit') }}"]');

    if (!form) {
        return;
    }

    form.addEventListener('submit', function (e) {

        const checkboxes = form.querySelectorAll(
            "input[name='services[]']"
        );

        let checked = false;

        checkboxes.forEach(function (box) {
            if (box.checked) {
                checked = true;
            }
        });

        if (!checked) {
            e.preventDefault();

            alert('Please select at least one service.');
        }

    });

});
</script>

@endpush