@extends('layouts.public')

@php
    $curriculum = json_decode(
        file_get_contents(resource_path('data/academy_curriculum.json')),
        true,
        512,
        JSON_THROW_ON_ERROR
    );

    $pathway = $curriculum[$stage];

    $extras = [
        'foundation' => [
            'audience' => 'Beginners and professionals exploring AI. Basic computer literacy is recommended; programming experience is not required.',
            'objectives' => [
                'Explain core AI concepts, generative AI models and their practical applications.',
                'Create, evaluate and improve prompts for professional tasks.',
                'Recognize hallucinations and verify AI-generated information.',
                'Understand chatbot design, human escalation and responsible AI use.',
                'Describe workflows, JSON, APIs, webhooks and connected systems.',
            ],
            'activities' => [
                'Write and refine prompts using the Task + Context + Details + Format formula.',
                'Analyze a real business problem and identify an appropriate AI use case.',
                'Map a chatbot or automation, including inputs, outputs and information sources.',
                'Complete the Foundation Capstone and Readiness Assessment.',
            ],
            'outcome' => 'You will be able to use AI tools responsibly, create effective prompts, identify practical opportunities and explain how an AI-powered workflow is structured.',
        ],
        'intermediate' => [
            'audience' => 'Learners ready to understand how AI integrations work and how to build, test and troubleshoot them.',
            'objectives' => [
                'Trace data through connected automation systems.',
                'Understand JSON, HTTP APIs, webhooks and authentication.',
                'Design integration tests and investigate execution logs.',
                'Apply introductory Python, machine learning and database concepts.',
                'Improve workflow reliability, security and monitoring.',
            ],
            'activities' => [
                'Build a multi-step workflow using structured data and integrations.',
                'Test an API or webhook connection with representative inputs.',
                'Investigate deliberately introduced workflow failures and document fixes.',
                'Complete the Intermediate Capstone and Final Examination.',
            ],
            'outcome' => 'You will be able to analyze data flows, test integrations, troubleshoot automation failures and explain essential security and reliability controls.',
        ],
        'advanced' => [
            'audience' => 'Learners progressing toward complete business automation solutions and client-facing AI projects.',
            'objectives' => [
                'Design and build AI-powered automation workflows with n8n.',
                'Integrate language models, APIs and webhooks.',
                'Understand chat agents, WhatsApp agents and AI voice applications.',
                'Apply practical security and privacy safeguards to AI systems.',
                'Develop project delivery, pricing and client acquisition skills.',
            ],
            'activities' => [
                'Design a WhatsApp AI agent and automation workflow for a local business.',
                'Define the business requirements and integrate relevant systems.',
                'Test the solution, document safeguards and demonstrate its value.',
                'Complete the Final Project and explore pricing and outbound client outreach.',
            ],
            'outcome' => 'You will be able to design and demonstrate an integrated AI automation solution and explain how to package and present its value to a prospective client.',
        ],
    ];

    $extra = $extras[$stage];
    $moduleCount = count($pathway['modules']);
@endphp

@section('title', $pathway['title'] . ' Curriculum - Moose Loon AI Academy')

@section('content')

<section class="bg-[#00104B] py-16 sm:py-24 text-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}"
           class="text-sm font-medium text-blue-100 hover:text-white">
            &larr; Back to homepage
        </a>

        <div class="mt-10 max-w-3xl">
            <span class="inline-block rounded-full border border-white/20 px-4 py-2 text-xs font-bold uppercase tracking-widest text-blue-100">
                {{ $moduleCount }} curriculum modules
            </span>

            <h1 class="mt-6 text-4xl sm:text-5xl font-bold">
                {{ $pathway['title'] }}
            </h1>

            <p class="mt-4 text-xl text-blue-100">
                {{ $pathway['subtitle'] }}
            </p>

            <p class="mt-7 text-lg leading-8 text-blue-100">
                {{ $pathway['description'] }}
            </p>

            <a href="{{ route('choose.university') }}"
               class="mt-9 inline-flex rounded-xl bg-[#C90000] px-7 py-4 text-sm font-bold text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-white/40">
                Start Learning
            </a>
        </div>
    </div>
</section>

<section class="bg-white py-16 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <span class="text-xs font-bold uppercase tracking-widest text-[#C90000]">
                    Learning objectives
                </span>

                <h2 class="mt-3 text-3xl font-bold text-[#00104B]">
                    What you will learn
                </h2>

                <ul class="mt-7 space-y-4">
                    @foreach($extra['objectives'] as $objective)
                        <li class="flex items-start gap-3 text-slate-700 leading-7">
                            <span class="mt-1 font-bold text-[#C90000]" aria-hidden="true">✓</span>
                            <span>{{ $objective }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <aside class="rounded-2xl bg-[#F7F9FC] p-7 h-fit">
                <h2 class="text-lg font-bold text-[#00104B]">
                    Who is this stage for?
                </h2>
                <p class="mt-4 text-slate-600 leading-7">
                    {{ $extra['audience'] }}
                </p>

                <div class="mt-6 border-t border-slate-200 pt-6">
                    <p class="text-sm font-bold text-[#00104B]">
                        {{ $moduleCount }} modules
                    </p>
                    <p class="mt-2 text-sm text-slate-600">
                        Part of the Certificate in Artificial Intelligence &amp; Automation Systems learning pathway.
                    </p>
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="bg-[#F7F9FC] py-16 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-[#C90000]">
            Full module breakdown
        </span>

        <h2 class="mt-3 text-3xl font-bold text-[#00104B]">
            Explore all {{ $moduleCount }} modules
        </h2>

        <p class="mt-4 max-w-3xl text-slate-600 leading-7">
            The following titles reflect the curriculum for this stage.
            Each module contributes to the practical skills developed throughout the programme.
        </p>

        <ol class="mt-9 grid gap-3 md:grid-cols-2">
            @foreach($pathway['modules'] as $index => $module)
                <li class="flex items-start gap-4 rounded-xl border border-slate-200 bg-white p-5">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#00104B] text-xs font-bold text-white">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="pt-1 font-semibold leading-6 text-[#00104B]">
                        {{ $module }}
                    </span>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="bg-white py-16 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#C90000]">
                    Learning by doing
                </span>
                <h2 class="mt-3 text-3xl font-bold text-[#00104B]">
                    Practical assignments &amp; assessment
                </h2>

                <ul class="mt-7 space-y-4">
                    @foreach($extra['activities'] as $activity)
                        <li class="flex gap-3 text-slate-700 leading-7">
                            <span class="font-bold text-[#C90000]" aria-hidden="true">✓</span>
                            <span>{{ $activity }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-2xl bg-[#00104B] p-8 text-white">
                <h2 class="text-2xl font-bold">
                    Expected learning outcome
                </h2>
                <p class="mt-5 text-blue-100 leading-8">
                    {{ $extra['outcome'] }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="bg-[#F7F9FC] py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-[#00104B]">
            Continue your AI learning journey
        </h2>

        <div class="mt-7 grid gap-4 md:grid-cols-3">
            @foreach($curriculum as $slug => $other)
                <a href="{{ route('curriculum.stage', ['stage' => $slug]) }}"
                   @if($slug === $stage) aria-current="page" @endif
                   class="rounded-xl border p-5 transition hover:shadow-md {{ $slug === $stage ? 'border-[#00104B] bg-blue-50' : 'border-slate-200 bg-white hover:border-[#00104B]' }}">
                    <span class="text-xs font-bold text-[#C90000]">
                        {{ count($other['modules']) }} modules
                    </span>
                    <h3 class="mt-2 text-lg font-bold text-[#00104B]">
                        {{ $other['title'] }}
                    </h3>
                    <p class="mt-2 text-sm text-slate-600">
                        {{ $other['subtitle'] }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
