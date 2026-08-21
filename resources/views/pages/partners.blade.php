@extends('layouts.public')

@section('title', 'Partnerships | Moose Loon AI Academy')

@section('content')

<div class="bg-white text-slate-900 overflow-x-hidden">

    {{-- HERO --}}
    <section class="bg-[#00104B]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-20">

            <div class="max-w-4xl reveal-left">

                <p class="text-sm font-semibold tracking-[0.18em] uppercase text-red-400 mb-5">
                    Institutional Partnerships
                </p>

                <h6 class="text-4xl md:text-5xl lg:text-[3.5rem] font-bold tracking-tight leading-[1.08] text-white max-w-4xl">
                    Bring practical AI education to your learners and workforce.
                </h6>

                <p class="mt-6 text-lg md:text-xl leading-relaxed text-blue-100 max-w-3xl">
                    Moose Loon AI Academy partners with educational institutions and organizations
                    to deliver practical, structured AI training for students, professionals, and employees.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">

                    <a href="#apply"
                       class="inline-flex items-center justify-center rounded-lg bg-[#C40000] px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-[#a90000]">
                        Discuss a Partnership
                    </a>

                    <a href="#partnership-models"
                       class="inline-flex items-center justify-center rounded-lg border border-white/30 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">
                        Explore Partnership Models
                    </a>

                </div>

            </div>

        </div>
    </section>


    {{-- INTRODUCTION --}}
    <section class="py-16 lg:py-20 bg-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-[0.8fr_1.2fr] gap-12 lg:gap-20 items-start">

                <div class="reveal-left">
                    <p class="text-sm font-semibold tracking-[0.16em] uppercase text-[#C40000]">
                        Why Partner With Us
                    </p>

                    <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-[#00104B] leading-tight">
                        AI capability is becoming an essential part of modern education and work.
                    </h2>
                </div>

                <div class="space-y-5 text-lg leading-relaxed text-slate-600 reveal-right">

                    <p>
                        Artificial intelligence is changing how people learn, work, communicate,
                        analyze information, and solve problems. Institutions and organizations
                        increasingly need practical ways to prepare their communities for that change.
                    </p>

                    <p>
                        Moose Loon AI Academy works with partners who want to make practical AI
                        education accessible to their learners or employees without having to build
                        an AI training program from scratch.
                    </p>

                    <p>
                        Depending on your organization, we can support structured learner programs,
                        professional development, employee capacity building, workshops, and practical
                        AI training initiatives.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- PARTNERSHIP MODELS --}}
    <section id="partnership-models" class="py-16 lg:py-20 bg-slate-50">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="max-w-3xl">

                <p class="text-sm font-semibold tracking-[0.16em] uppercase text-[#C40000]">
                    Partnership Models
                </p>

                <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-[#00104B]">
                    Two ways organizations can work with the Academy.
                </h2>

                <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                    Our partnerships are designed around the needs of the people you want to train.
                </p>

            </div>


            <div class="grid lg:grid-cols-2 gap-8 mt-12 stagger">

                {{-- EDUCATION --}}
                <article class="bg-white border border-slate-200 rounded-2xl p-8 lg:p-10">

                    <p class="text-sm font-semibold uppercase tracking-wider text-[#C40000]">
                        Education Partnerships
                    </p>

                    <h3 class="mt-4 text-2xl md:text-3xl font-bold text-[#00104B]">
                        Equip your learners with practical AI skills.
                    </h3>

                    <p class="mt-5 text-slate-600 leading-relaxed">
                        We work with universities, colleges, training institutions, schools,
                        and other education providers that want to introduce practical AI
                        education to their learners.
                    </p>

                    <div class="mt-8 border-t border-slate-200 pt-7">

                        <p class="text-sm font-semibold text-slate-900 mb-4">
                            Partnership activities may include
                        </p>

                        <ul class="space-y-3 text-slate-600">

                            <li>
                                Practical AI training programs for learners
                            </li>

                            <li>
                                AI workshops and institutional training sessions
                            </li>

                            <li>
                                Structured learning programs alongside existing education
                            </li>

                            <li>
                                Practical projects and applied learning
                            </li>

                            <li>
                                Student onboarding and learning support
                            </li>

                        </ul>

                    </div>

                </article>


                {{-- CORPORATE --}}
                <article class="bg-[#00104B] rounded-2xl p-8 lg:p-10 text-white">

                    <p class="text-sm font-semibold uppercase tracking-wider text-red-300">
                        Corporate Capacity Building
                    </p>

                    <h3 class="mt-4 text-2xl md:text-3xl font-bold">
                        Build AI capability across your workforce.
                    </h3>

                    <p class="mt-5 text-blue-100 leading-relaxed">
                        Organizations can engage Moose Loon AI Academy to train employees
                        in practical AI skills relevant to their roles, workflows, and
                        organizational objectives.
                    </p>

                    <div class="mt-8 border-t border-white/15 pt-7">

                        <p class="text-sm font-semibold text-white mb-4">
                            Training can be structured around
                        </p>

                        <ul class="space-y-3 text-blue-100">

                            <li>
                                Generative AI and responsible workplace use
                            </li>

                            <li>
                                AI productivity and knowledge work
                            </li>

                            <li>
                                Workflow automation and AI-assisted processes
                            </li>

                            <li>
                                AI agents and practical business applications
                            </li>

                            <li>
                                Role-specific AI capacity building
                            </li>

                        </ul>

                    </div>

                </article>

            </div>

        </div>

    </section>


    {{-- WHAT WE CAN DELIVER --}}
    <section class="py-16 lg:py-20 bg-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-[0.75fr_1.25fr] gap-12 lg:gap-20">

                <div class="reveal-left">

                    <p class="text-sm font-semibold tracking-[0.16em] uppercase text-[#C40000]">
                        Training Support
                    </p>

                    <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-[#00104B]">
                        From structured programs to targeted capacity building.
                    </h2>

                    <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                        The scope of a partnership can be adapted to your audience,
                        objectives, schedule, and level of AI experience.
                    </p>

                </div>


               <div class="grid sm:grid-cols-2 gap-x-10 gap-y-10 stagger">

                    <div class="border-t-2 border-[#00104B] pt-5">
                        <h3 class="text-xl font-bold text-[#00104B]">
                            AI Foundations
                        </h3>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Build a practical understanding of artificial intelligence,
                            generative AI, large language models, and modern AI tools.
                        </p>
                    </div>


                    <div class="border-t-2 border-[#00104B] pt-5">
                        <h3 class="text-xl font-bold text-[#00104B]">
                            Generative AI
                        </h3>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Develop practical skills for using AI to research, create,
                            analyze, communicate, and improve everyday work.
                        </p>
                    </div>


                    <div class="border-t-2 border-[#00104B] pt-5">
                        <h3 class="text-xl font-bold text-[#00104B]">
                            AI Automation
                        </h3>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Introduce learners and teams to workflows, integrations,
                            APIs, automation platforms, and practical AI systems.
                        </p>
                    </div>


                    <div class="border-t-2 border-[#00104B] pt-5">
                        <h3 class="text-xl font-bold text-[#00104B]">
                            AI Agents
                        </h3>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Explore how agentic systems can be designed and applied
                            to practical organizational and business problems.
                        </p>
                    </div>


                    <div class="border-t-2 border-[#00104B] pt-5">
                        <h3 class="text-xl font-bold text-[#00104B]">
                            Practical Projects
                        </h3>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Move beyond theory through applied projects that allow
                            participants to build and work with real AI systems.
                        </p>
                    </div>


                    <div class="border-t-2 border-[#00104B] pt-5">
                        <h3 class="text-xl font-bold text-[#00104B]">
                            Professional Development
                        </h3>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Help employees and professionals develop AI capabilities
                            relevant to the changing workplace.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- HOW IT WORKS --}}
    <section class="py-16 lg:py-20 bg-[#00104B] text-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="max-w-3xl">

                <p class="text-sm font-semibold tracking-[0.16em] uppercase text-red-300">
                    Partnership Process
                </p>

                <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight">
                    A straightforward path from conversation to training.
                </h2>

            </div>


           <div class="grid md:grid-cols-4 gap-8 mt-12 stagger">

                @php
                    $steps = [
                        [
                            'number' => '01',
                            'title' => 'Tell us your objectives',
                            'description' => 'Share who you want to train, what you want them to achieve, and the type of program you have in mind.'
                        ],
                        [
                            'number' => '02',
                            'title' => 'Design the engagement',
                            'description' => 'We discuss the appropriate training format, curriculum, delivery approach, schedule, and participant requirements.'
                        ],
                        [
                            'number' => '03',
                            'title' => 'Prepare your participants',
                            'description' => 'Participants are organized and provided with the information they need before training begins.'
                        ],
                        [
                            'number' => '04',
                            'title' => 'Deliver and support learning',
                            'description' => 'Training is delivered through the agreed structure, with appropriate academic and technical support.'
                        ],
                    ];
                @endphp

                @foreach($steps as $step)

                    <div class="border-t border-white/25 pt-5">

                        <span class="text-sm font-bold text-red-300">
                            {{ $step['number'] }}
                        </span>

                        <h3 class="mt-4 text-xl font-bold">
                            {{ $step['title'] }}
                        </h3>

                        <p class="mt-3 text-blue-100 leading-relaxed">
                            {{ $step['description'] }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- WHO WE PARTNER WITH --}}
    <section class="py-16 lg:py-20 bg-slate-50">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto">

                <p class="text-sm font-semibold tracking-[0.16em] uppercase text-[#C40000]">
                    Potential Partners
                </p>

                <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-[#00104B]">
                    Built for organizations that want to develop AI capability.
                </h2>

            </div>


           <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-12 stagger">

                @php
                    $partners = [
                        'Universities and colleges',
                        'Schools and training institutions',
                        'Corporations and employers',
                        'Non-governmental organizations',
                        'Professional associations',
                        'Training and development organizations',
                        'Public and private institutions',
                        'Organizations building digital skills'
                    ];
                @endphp

                @foreach($partners as $partner)

                    <div class="bg-white border border-slate-200 rounded-xl px-6 py-6 partner-card">
                        <h3 class="font-semibold text-[#00104B]">
                            {{ $partner }}
                        </h3>
                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- PARTNERSHIP VALUE --}}
    <section class="py-16 lg:py-20 bg-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

           <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

               <div class="reveal-left">

                    <p class="text-sm font-semibold tracking-[0.16em] uppercase text-[#C40000]">
                        A Practical Partnership
                    </p>

                    <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-[#00104B]">
                        Your organization understands your people. We bring the AI education.
                    </h2>

                    <p class="mt-6 text-lg text-slate-600 leading-relaxed">
                        Effective training works best when the education is connected to
                        the context in which people learn and work.
                    </p>

                    <p class="mt-4 text-lg text-slate-600 leading-relaxed">
                        Our partnership model allows organizations to identify their
                        training needs while Moose Loon AI Academy provides the relevant
                        educational expertise and practical AI learning experience.
                    </p>

                </div>


               <div class="bg-[#00104B] rounded-2xl p-8 lg:p-10 text-white reveal-right">

                    <p class="text-sm font-semibold uppercase tracking-wider text-red-300">
                        The shared objective
                    </p>

                    <h3 class="mt-4 text-2xl font-bold">
                        Develop people who can use AI effectively and responsibly.
                    </h3>

                    <p class="mt-5 text-blue-100 leading-relaxed">
                        Whether the participants are university students preparing
                        for the workforce or employees adapting to AI-enabled work,
                        the goal is practical capability — not simply exposure to AI concepts.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- FAQ --}}
    <section class="py-16 lg:py-20 bg-slate-50">

        <div class="max-w-4xl mx-auto px-6 lg:px-8">

            <div class="text-center">

                <p class="text-sm font-semibold tracking-[0.16em] uppercase text-[#C40000]">
                    Partnership Questions
                </p>

                <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-[#00104B]">
                    Frequently asked questions
                </h2>

            </div>


            <div class="mt-12 divide-y divide-slate-200 border-y border-slate-200 reveal">

                <details class="py-6 group">
                    <summary class="flex items-center justify-between cursor-pointer list-none">
                        <span class="text-lg font-semibold text-[#00104B]">
                            Who can partner with Moose Loon AI Academy?
                        </span>

                        <span class="text-slate-400 text-xl">
                            +
                        </span>
                    </summary>

                    <p class="mt-4 text-slate-600 leading-relaxed max-w-3xl">
                        We work with educational institutions, corporations, professional
                        organizations, NGOs, training organizations, and other institutions
                        that want to develop practical AI capability among their learners
                        or workforce.
                    </p>
                </details>


                <details class="py-6 group">
                    <summary class="flex items-center justify-between cursor-pointer list-none">
                        <span class="text-lg font-semibold text-[#00104B]">
                            Can you train our employees directly?
                        </span>

                        <span class="text-slate-400 text-xl">
                            +
                        </span>
                    </summary>

                    <p class="mt-4 text-slate-600 leading-relaxed max-w-3xl">
                        Yes. Organizations can engage the Academy for employee training
                        and AI capacity-building programs. The training can be structured
                        around the organization's workforce and learning objectives.
                    </p>
                </details>


                <details class="py-6 group">
                    <summary class="flex items-center justify-between cursor-pointer list-none">
                        <span class="text-lg font-semibold text-[#00104B]">
                            Can an educational institution train its students through the partnership?
                        </span>

                        <span class="text-slate-400 text-xl">
                            +
                        </span>
                    </summary>

                    <p class="mt-4 text-slate-600 leading-relaxed max-w-3xl">
                        Yes. Educational institutions can work with the Academy to make
                        practical AI programs available to their learners through an
                        agreed partnership and delivery structure.
                    </p>
                </details>


                <details class="py-6 group">
                    <summary class="flex items-center justify-between cursor-pointer list-none">
                        <span class="text-lg font-semibold text-[#00104B]">
                            Can the training be customized?
                        </span>

                        <span class="text-slate-400 text-xl">
                            +
                        </span>
                    </summary>

                    <p class="mt-4 text-slate-600 leading-relaxed max-w-3xl">
                        Training requirements vary by audience. During the partnership
                        discussion, we can determine the appropriate program, delivery
                        format, schedule, and learning objectives.
                    </p>
                </details>

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <section class="py-16 lg:py-20 bg-white">

        <div class="max-w-5xl mx-auto px-6 lg:px-8 text-center reveal-scale">

            <p class="text-sm font-semibold tracking-[0.16em] uppercase text-[#C40000]">
                Start a Conversation
            </p>

            <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-[#00104B]">
                Let's discuss how AI education can support your organization.
            </h2>

            <p class="mt-5 text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto">
                Tell us about your learners, employees, training objectives, and
                organization. Our team can discuss an appropriate partnership approach.
            </p>

            <div class="mt-8 flex flex-wrap justify-center gap-4">

                <a href="#apply"
                   class="inline-flex items-center justify-center rounded-lg bg-[#C40000] px-7 py-3.5 text-sm font-semibold text-white transition hover:bg-[#a90000]">
                    Discuss a Partnership
                </a>

                <a href="https://wa.me/254119066667"
                   class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-7 py-3.5 text-sm font-semibold text-[#00104B] transition hover:bg-slate-50">
                    Contact Us on WhatsApp
                </a>

            </div>

        </div>

    </section>


    {{-- APPLICATION FORM --}}
    <section id="apply" class="py-16 lg:py-20 bg-slate-50">

       <div class="max-w-4xl mx-auto px-6 lg:px-8 reveal-scale">

            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

                <div class="bg-[#00104B] px-8 py-10 lg:px-12">

                    <p class="text-sm font-semibold tracking-[0.16em] uppercase text-red-300">
                        Partnership Inquiry
                    </p>

                    <h2 class="mt-4 text-3xl md:text-4xl font-bold text-white">
                        Tell us about your organization.
                    </h2>

                    <p class="mt-4 text-blue-100 text-lg leading-relaxed max-w-2xl">
                        Submit the form below and our team will review your requirements
                        and follow up to discuss the appropriate partnership structure.
                    </p>

                </div>


                <div class="p-8 lg:p-12">

                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl mb-8">
                            {{ session('success') }}
                        </div>
                    @endif


                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-xl mb-8">
                            {{ session('error') }}
                        </div>
                    @endif


                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-xl mb-8">
                            <p class="font-semibold mb-2">
                                Please review the following:
                            </p>

                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('partner.apply') }}" method="POST" class="space-y-7">

                        @csrf


                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-800 mb-2">
                                    Name / Organization
                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="Your name or organization"
                                    class="w-full rounded-lg border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:border-[#002A6B] focus:outline-none focus:ring-2 focus:ring-[#002A6B]/20"
                                >
                            </div>


                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-800 mb-2">
                                    Email Address
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="name@organization.com"
                                    class="w-full rounded-lg border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:border-[#002A6B] focus:outline-none focus:ring-2 focus:ring-[#002A6B]/20"
                                >
                            </div>

                        </div>


                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-slate-800 mb-2">
                                    Phone Number
                                </label>

                                <input
                                    id="phone"
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    required
                                    placeholder="Phone number"
                                    class="w-full rounded-lg border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:border-[#002A6B] focus:outline-none focus:ring-2 focus:ring-[#002A6B]/20"
                                >
                            </div>


                            <div>
                                <label for="location" class="block text-sm font-semibold text-slate-800 mb-2">
                                    Location
                                </label>

                                <input
                                    id="location"
                                    type="text"
                                    name="location"
                                    value="{{ old('location') }}"
                                    placeholder="City / Country"
                                    class="w-full rounded-lg border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:border-[#002A6B] focus:outline-none focus:ring-2 focus:ring-[#002A6B]/20"
                                >
                            </div>

                        </div>


                        <div>
                            <label for="current_student_population" class="block text-sm font-semibold text-slate-800 mb-2">
                                Approximate Learner / Employee Audience
                            </label>

                            <input
                                id="current_student_population"
                                type="text"
                                name="current_student_population"
                                value="{{ old('current_student_population') }}"
                                placeholder="For example: 500 students, 120 employees, or an estimated audience"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:border-[#002A6B] focus:outline-none focus:ring-2 focus:ring-[#002A6B]/20"
                            >
                        </div>


                        <div>
                            <label for="additional_info" class="block text-sm font-semibold text-slate-800 mb-2">
                                Tell us about your training needs
                            </label>

                            <textarea
                                id="additional_info"
                                name="additional_info"
                                rows="6"
                                placeholder="Tell us whether you are looking to train students, employees, or another audience, and what you would like the training to achieve."
                                class="w-full rounded-lg border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:border-[#002A6B] focus:outline-none focus:ring-2 focus:ring-[#002A6B]/20"
                            >{{ old('additional_info') }}</textarea>
                        </div>


                        <button
                            type="submit"
                            class="w-full rounded-lg bg-[#C40000] px-6 py-4 text-sm font-semibold text-white transition hover:bg-[#a90000] focus:outline-none focus:ring-2 focus:ring-[#C40000]/30"
                        >
                            Submit Partnership Inquiry
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

<style>
    /* =========================================================
       SCROLL REVEAL ANIMATIONS
       ========================================================= */

    .reveal {
        opacity: 0;
        transform: translateY(45px);
        transition:
            opacity 0.8s ease,
            transform 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .reveal-left {
        opacity: 0;
        transform: translateX(-60px);
        transition:
            opacity 0.8s ease,
            transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .reveal-right {
        opacity: 0;
        transform: translateX(60px);
        transition:
            opacity 0.8s ease,
            transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .reveal-scale {
        opacity: 0;
        transform: scale(0.94) translateY(25px);
        transition:
            opacity 0.8s ease,
            transform 0.9s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .reveal.is-visible,
    .reveal-left.is-visible,
    .reveal-right.is-visible,
    .reveal-scale.is-visible {
        opacity: 1;
        transform: none;
    }

    /* Staggered children */

    .stagger > * {
        opacity: 0;
        transform: translateY(35px);
        transition:
            opacity 0.7s ease,
            transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .stagger.is-visible > * {
        opacity: 1;
        transform: none;
    }

    .stagger.is-visible > *:nth-child(1) {
        transition-delay: 0.05s;
    }

    .stagger.is-visible > *:nth-child(2) {
        transition-delay: 0.12s;
    }

    .stagger.is-visible > *:nth-child(3) {
        transition-delay: 0.19s;
    }

    .stagger.is-visible > *:nth-child(4) {
        transition-delay: 0.26s;
    }

    .stagger.is-visible > *:nth-child(5) {
        transition-delay: 0.33s;
    }

    .stagger.is-visible > *:nth-child(6) {
        transition-delay: 0.40s;
    }

    .stagger.is-visible > *:nth-child(7) {
        transition-delay: 0.47s;
    }

    .stagger.is-visible > *:nth-child(8) {
        transition-delay: 0.54s;
    }


    /* Slight movement when hovering interactive cards */

    .partner-card {
        transition:
            transform 0.35s ease,
            box-shadow 0.35s ease,
            border-color 0.35s ease;
    }

    .partner-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
    }


    /* CTA entrance */

    .cta-content {
        transition:
            opacity 0.9s ease,
            transform 0.9s cubic-bezier(0.22, 1, 0.36, 1);
    }


    /* Respect accessibility settings */

    @media (prefers-reduced-motion: reduce) {

        .reveal,
        .reveal-left,
        .reveal-right,
        .reveal-scale,
        .stagger > *,
        .cta-content {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }

        .partner-card:hover {
            transform: none;
        }

    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const animatedElements = document.querySelectorAll(
            '.reveal, .reveal-left, .reveal-right, .reveal-scale, .stagger, .cta-content'
        );

        if (!('IntersectionObserver' in window)) {
            animatedElements.forEach(function (element) {
                element.classList.add('is-visible');
            });

            return;
        }

        const observer = new IntersectionObserver(
            function (entries, observer) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('is-visible');

                        /*
                         * Once an element has appeared, stop observing it.
                         * This keeps the animation smooth instead of replaying
                         * every time the user scrolls past the section.
                         */
                        observer.unobserve(entry.target);
                    }

                });

            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -60px 0px'
            }
        );

        animatedElements.forEach(function (element) {
            observer.observe(element);
        });

    });
</script>

@endsection