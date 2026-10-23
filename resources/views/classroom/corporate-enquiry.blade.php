@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-10 sm:py-16">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        <a href="{{ route('classroom') }}"
           class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-[#123A78]">
            <span aria-hidden="true">&larr;</span>
            Back to Classroom
        </a>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="bg-[#061638] px-6 py-10 text-white sm:px-12 sm:py-14">
                <span class="inline-flex rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-blue-100">
                    Corporate & Institutional Training
                </span>

                <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight tracking-tight sm:text-5xl">
                    {{ $course->title }}
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">
                    Equip your team with the knowledge and practical skills to adopt
                    artificial intelligence responsibly, confidently and effectively.
                </p>
            </div>

            <div class="grid gap-10 px-6 py-10 sm:px-12 sm:py-12 lg:grid-cols-5">

                <div class="lg:col-span-3">
                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#D71920]">
                        Exclusive Training Programme
                    </p>

                    <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-[#061638] sm:text-3xl">
                        Designed for organisations, not individual enrolment.
                    </h2>

                    <p class="mt-5 text-sm leading-8 text-slate-600 sm:text-base">
                        This programme is available exclusively to companies,
                        government institutions, educational institutions and other
                        organisations seeking structured AI training for their teams.
                    </p>

                    <p class="mt-4 text-sm leading-8 text-slate-600 sm:text-base">
                        Contact Moose Loon AI Academy to discuss your organisation's
                        training needs, preferred delivery arrangements, team size
                        and a tailored proposal.
                    </p>

                    <div class="mt-8 rounded-2xl border border-blue-100 bg-blue-50 px-5 py-5">
                        <p class="font-bold text-[#061638]">
                            Looking to train your team?
                        </p>
                        <p class="mt-2 text-sm leading-7 text-slate-600">
                            Our team will guide you through the available corporate
                            training options and help you plan a suitable programme.
                        </p>
                    </div>
                </div>

                <aside class="lg:col-span-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-7">
                        <h3 class="text-xl font-extrabold text-[#061638]">
                            Discuss Corporate Training
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            Speak with our team about training your employees
                            or institutional staff.
                        </p>

                        <a href="mailto:aisolutions@mooseloonai.ca?subject=Corporate%20AI%20Training%20Enquiry"
                           class="mt-6 flex w-full items-center justify-center rounded-xl bg-[#D71920] px-5 py-3.5 text-center text-sm font-bold text-white transition hover:bg-[#b9151b]">
                            Enquire About Corporate Training
                        </a>

                        <a href="tel:+254119066667"
                           class="mt-3 flex w-full items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3.5 text-center text-sm font-bold text-[#061638] transition hover:border-blue-300 hover:text-[#123A78]">
                            Call +254 119 066 667
                        </a>

                        <div class="mt-7 space-y-5 border-t border-slate-200 pt-6">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Email
                                </p>
                                <a href="mailto:aisolutions@mooseloonai.ca"
                                   class="mt-1 block break-all text-sm font-semibold text-[#123A78] hover:underline">
                                    aisolutions@mooseloonai.ca
                                </a>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Visit Our Office
                                </p>
                                <address class="mt-1 text-sm not-italic leading-7 text-slate-700">
                                    Kipro Centre, Westlands, Nairobi<br>
                                    2nd Floor, Office B20B
                                </address>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <p class="mt-6 text-center text-xs leading-6 text-slate-500">
            Corporate training is arranged directly with Moose Loon AI Academy.
            Individual checkout and self-service enrolment are unavailable for this programme.
        </p>
    </div>
</div>
@endsection
