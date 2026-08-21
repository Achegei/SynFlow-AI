@extends('layouts.ai-onboarding')

@section('title')
    Your AI Learning Path | Moose Loon AI Academy
@endsection

@section('content')

<div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- =========================================================
        PAGE INTRO
    ========================================================== --}}
    <div class="text-center mb-8 sm:mb-10">

        <div class="inline-flex items-center justify-center mb-5">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-[#061B49] flex items-center justify-center shadow-lg">
                <span class="text-xl sm:text-2xl font-black text-white">
                    AI
                </span>
            </div>
        </div>

        <p class="text-xs sm:text-sm font-bold uppercase tracking-[0.22em] text-[#D71920]">
            Moose Loon AI Academy
        </p>

        <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#061B49]">
            Your AI Learning Path
        </h1>

        <p class="mt-4 max-w-2xl mx-auto text-sm sm:text-base lg:text-lg leading-relaxed text-slate-600">
            Based on your answers, we've identified the AI skills and
            capabilities that can create the greatest value for you.
        </p>

    </div>


    {{-- =========================================================
        RECOMMENDED PATH
    ========================================================== --}}
    <div class="rounded-3xl border-2 border-[#D71920] bg-white shadow-[0_12px_40px_rgba(7,26,77,0.08)] overflow-hidden">

        {{-- Header --}}
        <div class="bg-[#061B49] px-6 sm:px-8 lg:px-10 py-7 sm:py-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#F03A3E]">
                        Recommended Learning Path
                    </p>

                    <h2 class="mt-2 text-2xl sm:text-3xl font-black text-white">
                        Practical AI
                    </h2>

                    <p class="mt-3 max-w-2xl text-sm sm:text-base leading-relaxed text-slate-300">
                        Learn how to use modern AI tools to work faster,
                        solve problems, automate repetitive tasks and
                        improve your everyday productivity.
                    </p>

                </div>

                <div class="flex-shrink-0">

                    <span class="inline-flex items-center rounded-full bg-[#D71920] px-4 py-2 text-xs font-bold uppercase tracking-wide text-white">
                        Recommended for you
                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
            WHAT YOU WILL LEARN
        ====================================================== --}}
        <div class="px-6 sm:px-8 lg:px-10 py-7 sm:py-9">

            <div class="mb-6">

                <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#D71920]">
                    What you'll learn
                </p>

                <h3 class="mt-2 text-xl sm:text-2xl font-black text-[#061B49]">
                    Practical AI skills for real-world work
                </h3>

                <p class="mt-2 text-sm leading-relaxed text-slate-600 max-w-2xl">
                    The focus is not just on understanding AI.
                    You'll learn how to actually use it to produce better
                    results in your work, career and business.
                </p>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                {{-- AI Productivity --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        AI Productivity
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Use AI to save time and complete everyday tasks more efficiently.
                    </p>
                </div>


                {{-- Prompt Engineering --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        Prompt Engineering
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Learn how to communicate effectively with modern AI systems.
                    </p>
                </div>


                {{-- AI Tools --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        AI Tools & Workflows
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Connect AI tools to practical workflows and business processes.
                    </p>
                </div>


                {{-- Automation --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        AI Automation
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Automate repetitive tasks and build systems that work for you.
                    </p>
                </div>


                {{-- AI Agents --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        AI Agents & Chatbots
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Understand how AI assistants and agents can handle useful tasks.
                    </p>
                </div>


                {{-- Research --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        Research & Documents
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Use AI to research, summarize, organize and work with information.
                    </p>
                </div>


                {{-- Data --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        Data & Analysis
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Use AI to understand data, identify patterns and support decisions.
                    </p>
                </div>


                {{-- Marketing --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-bold text-sm text-[#061B49]">
                        Marketing & Sales
                    </p>

                    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Apply AI to content, marketing, customer engagement and sales.
                    </p>
                </div>

            </div>


            {{-- =================================================
                HANDS-ON LEARNING
            ================================================== --}}
            <div class="mt-8 rounded-2xl bg-[#061B49] p-5 sm:p-6">

                <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#F03A3E]">
                    Learn by doing
                </p>

                <h3 class="mt-2 text-lg sm:text-xl font-black text-white">
                    Build practical AI solutions
                </h3>

                <p class="mt-2 text-sm leading-relaxed text-slate-300">
                    You won't just learn concepts. The learning experience
                    is designed around practical exercises, workflows and
                    projects that demonstrate how AI can be applied to
                    real-world problems.
                </p>

            </div>

        </div>


        {{-- =====================================================
            NEXT
        ====================================================== --}}
        <div class="border-t border-slate-200 bg-slate-50 px-6 sm:px-8 lg:px-10 py-6">

            <form
                method="GET"
                action="{{ route('ai.packages') }}"
            >

                <input
                    type="hidden"
                    name="path"
                    value="practical-ai"
                >

                <button
                    type="submit"
                    id="continueButton"
                    class="
                        w-full
                        flex
                        items-center
                        justify-center
                        gap-3
                        rounded-xl
                        py-4
                        sm:py-5
                        bg-[#D71920]
                        hover:bg-[#B9151B]
                        active:bg-[#B9151B]
                        text-white
                        font-bold
                        text-base
                        sm:text-lg
                        shadow-lg
                        hover:shadow-xl
                        transition-all
                        duration-200
                    "
                >

                    <span>
                        Next
                    </span>

                    <span class="text-xl">
                        →
                    </span>

                </button>

            </form>

        </div>

    </div>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <div class="mt-8 pb-8 text-center">

        <p class="text-xs sm:text-sm text-slate-400">
            Moose Loon AI Academy
            <span class="mx-1">·</span>
            Canadian Practical AI Skills
        </p>

    </div>

</div>


{{-- =============================================================
    LEAD TRACKING
============================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    function trackLeadEvent(eventName, metadata = {}) {

        return fetch('{{ route('lead.track') }}', {
            method: 'POST',
            credentials: 'same-origin',
            keepalive: true,

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },

            body: JSON.stringify({
                event: eventName,
                metadata: {
                    ...metadata,
                    page_url: window.location.href
                }
            })

        }).catch(function (error) {

            console.debug(
                'Lead tracking failed:',
                error
            );

        });

    }


    /*
    |--------------------------------------------------------------------------
    | LEARNING PATH VIEWED
    |--------------------------------------------------------------------------
    */

    trackLeadEvent(
        'ai_learning_path_viewed',
        {
            stage: 'ai_learning_path',
            path: 'practical-ai',
            path_title: 'Practical AI',
            onboarding_completed: true
        }
    );


    /*
    |--------------------------------------------------------------------------
    | NEXT BUTTON
    |--------------------------------------------------------------------------
    */

    const form =
        document.querySelector(
            'form[action="{{ route('ai.packages') }}"]'
        );


    if (form) {

        form.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                await trackLeadEvent(
                    'ai_learning_path_continue_clicked',
                    {
                        stage: 'ai_learning_path',
                        path: 'practical-ai',
                        path_title: 'Practical AI',
                        next_stage: 'ai_packages'
                    }
                );


                form.submit();

            }
        );

    }

});

</script>

@endsection