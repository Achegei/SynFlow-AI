@extends('layouts.public')

@section('title', 'AI Education Ambassador — Moose Loon AI Academy')

@section('content')

<style>
    .ambassador-page .form-label {
        display:block;
        margin-bottom:.5rem;
        font-size:.875rem;
        line-height:1.25rem;
        font-weight:600;
        color:#0f172a;
    }

    .ambassador-page .form-input {
        display:block;
        width:100%;
        border:1px solid #cbd5e1;
        border-radius:.75rem;
        background:#fff;
        padding:.75rem .875rem;
        font-size:.9375rem;
        line-height:1.5rem;
        color:#0f172a;
        outline:none;
        transition:border-color .15s ease,box-shadow .15s ease;
    }

    .ambassador-page .form-input::placeholder {
        color:#94a3b8;
    }

    .ambassador-page .form-input:hover {
        border-color:#94a3b8;
    }

    .ambassador-page .form-input:focus {
        border-color:#475569;
        box-shadow:0 0 0 3px rgb(15 23 42 / 8%);
    }

    .ambassador-page textarea.form-input {
        min-height:8rem;
        resize:vertical;
    }

    .ambassador-page .choice-label {
        display:flex;
        align-items:flex-start;
        gap:.75rem;
        width:100%;
        border:1px solid #e2e8f0;
        border-radius:.75rem;
        background:#fff;
        padding:.75rem .875rem;
        font-size:.875rem;
        line-height:1.4rem;
        color:#334155;
        cursor:pointer;
        transition:border-color .15s ease,background-color .15s ease;
    }

    .ambassador-page .choice-label:hover {
        border-color:#94a3b8;
        background:#f8fafc;
    }

    .ambassador-page .choice-label input {
        flex:0 0 auto;
        margin-top:.15rem;
        width:1rem;
        height:1rem;
        accent-color:#0f172a;
    }

    @media (max-width:640px) {
        .ambassador-page .hero-title {
            font-size:2.25rem;
            line-height:2.5rem;
        }

        .ambassador-page .application-card {
            border-radius:1rem;
            padding:1.125rem;
        }

        .ambassador-page .sidebar-card {
            border-radius:1rem;
            padding:1.25rem;
        }

        .ambassador-page .form-input {
            min-height:3rem;
            font-size:1rem;
        }

        .ambassador-page .choice-label {
            min-height:3rem;
        }
    }
</style>
<div class="ambassador-page min-h-screen bg-slate-50">

    {{-- Hero --}}
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-6 py-16 lg:px-8 lg:py-20">
            <div class="max-w-3xl">

                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">
                    Moose Loon AI Academy
                </p>

                <h1 class="hero-title mt-4 text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                    AI Education Ambassador
                </h1>

                <p class="mt-6 text-lg leading-8 text-slate-600">
                    Help bring practical, responsible and future-ready AI education
                    to educational institutions across Kenya.
                </p>

                <p class="mt-4 leading-7 text-slate-600">
                    We are looking for education professionals and institutional
                    representatives who can help us initiate conversations with
                    schools, colleges, TVET institutions and universities about
                    AI education partnerships.
                </p>

            </div>
        </div>
    </section>

    {{-- Application --}}
    <section class="mx-auto max-w-6xl px-6 py-12 lg:px-8">

        <div class="grid gap-10 lg:grid-cols-[0.8fr_1.2fr]">

            {{-- Sidebar --}}
            <aside class="h-fit lg:sticky lg:top-8">

                <div class="sidebar-card rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">

                    <h2 class="text-lg font-semibold text-slate-950">
                        Who we're looking for
                    </h2>

                    <ul class="mt-5 space-y-3 text-sm leading-6 text-slate-600">
                        <li>Teachers and educators</li>
                        <li>School and college administrators</li>
                        <li>University staff and faculty</li>
                        <li>ICT and training personnel</li>
                        <li>Education-sector professionals</li>
                        <li>Professionals with institutional relationships</li>
                    </ul>

                    <div class="mt-8 border-t border-slate-200 pt-6">

                        <h3 class="text-sm font-semibold text-slate-950">
                            What matters most
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Your ability to identify the appropriate decision-makers
                            and facilitate a meaningful introduction to Moose Loon AI
                            Academy.
                        </p>

                    </div>

                </div>

            </aside>

            {{-- Form --}}
            <div class="application-card rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="border-b border-slate-200 pb-6">

                    <h2 class="text-2xl font-semibold text-slate-950">
                        Application Form
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Please answer all applicable questions accurately.
                        Your responses will help us assess your current role,
                        institutional connections and ability to facilitate
                        an introduction.
                    </p>

                </div>

                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4">

                        <p class="font-medium text-red-800">
                            Please correct the following:
                        </p>

                        <ul class="mt-2 list-disc pl-5 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('careers.ai-education-ambassador.store') }}"
                    class="mt-8 space-y-10"
                >

                    @csrf

                    {{-- 1 --}}
                    <div>

                        <h3 class="text-base font-semibold text-slate-950">
                            1. Personal Information
                        </h3>

                        <div class="mt-5 grid gap-5 sm:grid-cols-2">

                            <div class="sm:col-span-2">

                                <label class="form-label">
                                    Full Name *
                                </label>

                                <input
                                    type="text"
                                    name="full_name"
                                    value="{{ old('full_name') }}"
                                    required
                                    class="form-input"
                                >

                            </div>

                            <div>

                                <label class="form-label">
                                    Email Address *
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    class="form-input"
                                >

                            </div>

                            <div>

                                <label class="form-label">
                                    Phone / WhatsApp Number *
                                </label>

                                <input
                                    type="text"
                                    name="phone_whatsapp"
                                    value="{{ old('phone_whatsapp') }}"
                                    required
                                    class="form-input"
                                >

                            </div>

                        </div>

                    </div>

                    {{-- 2 --}}
                    <div>

                        <h3 class="text-base font-semibold text-slate-950">
                            2. Employment & Institution
                        </h3>

                        <div class="mt-5">

                            <label class="form-label">
                                Are you currently employed by an educational institution in Kenya? *
                            </label>

                            <div class="mt-3 space-y-3">

                                <label class="choice-label">
                                    <input
                                        type="radio"
                                        name="employed_by_educational_institution"
                                        value="1"
                                        {{ old('employed_by_educational_institution') === '1' ? 'checked' : '' }}
                                        required
                                    >
                                    <span>Yes</span>
                                </label>

                                <label class="choice-label">
                                    <input
                                        type="radio"
                                        name="employed_by_educational_institution"
                                        value="0"
                                        {{ old('employed_by_educational_institution') === '0' ? 'checked' : '' }}
                                    >
                                    <span>No</span>
                                </label>

                            </div>

                        </div>

                        <div class="mt-6 grid gap-5 sm:grid-cols-2">

                            <div>

                                <label class="form-label">
                                    Institution Type
                                </label>

                                <select
                                    name="institution_type"
                                    class="form-input"
                                >

                                    <option value="">
                                        Select institution type
                                    </option>

                                    @foreach ([
                                        'High School',
                                        'College / TVET',
                                        'University',
                                        'Other Educational Institution',
                                    ] as $type)

                                        <option
                                            value="{{ $type }}"
                                            {{ old('institution_type') === $type ? 'selected' : '' }}
                                        >
                                            {{ $type }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                <label class="form-label">
                                    Name of Current Institution
                                </label>

                                <input
                                    type="text"
                                    name="institution_name"
                                    value="{{ old('institution_name') }}"
                                    class="form-input"
                                >

                            </div>

                            <div>

                                <label class="form-label">
                                    City / Town
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    value="{{ old('city') }}"
                                    class="form-input"
                                >

                            </div>

                            <div>

                                <label class="form-label">
                                    County
                                </label>

                                <input
                                    type="text"
                                    name="county"
                                    value="{{ old('county') }}"
                                    class="form-input"
                                >

                            </div>

                            <div>

                                <label class="form-label">
                                    Current Position / Title
                                </label>

                                <input
                                    type="text"
                                    name="current_position"
                                    value="{{ old('current_position') }}"
                                    class="form-input"
                                >

                            </div>

                            <div>

                                <label class="form-label">
                                    How long have you worked at your institution?
                                </label>

                                <select
                                    name="tenure"
                                    class="form-input"
                                >

                                    <option value="">
                                        Select
                                    </option>

                                    @foreach ([
                                        'Less than 1 year',
                                        '1–3 years',
                                        '4–6 years',
                                        '7+ years',
                                    ] as $tenure)

                                        <option
                                            value="{{ $tenure }}"
                                            {{ old('tenure') === $tenure ? 'selected' : '' }}
                                        >
                                            {{ $tenure }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                    {{-- 3 --}}
                    <div>

                        <h3 class="text-base font-semibold text-slate-950">
                            3. Institutional Access
                        </h3>

                        <div class="mt-5">

                            <label class="form-label">
                                Do you have access to the appropriate leadership to introduce
                                Moose Loon AI Academy and facilitate an initial discussion
                                about an AI education partnership? *
                            </label>

                            <select
                                name="leadership_access"
                                class="form-input"
                                required
                            >

                                <option value="">
                                    Select an option
                                </option>

                                @foreach ([
                                    'Yes, I have direct access',
                                    'Yes, I can arrange an introduction',
                                    'Possibly, with some assistance',
                                    'No',
                                ] as $access)

                                    <option
                                        value="{{ $access }}"
                                        {{ old('leadership_access') === $access ? 'selected' : '' }}
                                    >
                                        {{ $access }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mt-6">

                            <label class="form-label">
                                Which institutional leader(s) would you be able to introduce
                                Moose Loon AI Academy to?
                            </label>

                            <div class="mt-3 grid gap-3 sm:grid-cols-2">

                                @foreach ([
                                    'Principal / Headteacher',
                                    'Director / Management',
                                    'Dean / Faculty Leadership',
                                    'Head of Department',
                                    'Vice-Chancellor / University Leadership',
                                    'ICT / Training Leadership',
                                ] as $leader)

                                    <label class="choice-label">

                                        <input
                                            type="checkbox"
                                            name="leadership_types[]"
                                            value="{{ $leader }}"
                                            @checked(in_array($leader, old('leadership_types', [])))
                                        >

                                        <span>{{ $leader }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                        <div class="mt-6">

                            <label class="form-label">
                                Other relevant decision-maker — please specify name and position
                            </label>

                            <textarea
                                name="decision_maker_details"
                                rows="3"
                                class="form-input"
                            >{{ old('decision_maker_details') }}</textarea>

                        </div>

                    </div>

                    {{-- 4 --}}
                    <div>

                        <h3 class="text-base font-semibold text-slate-950">
                            4. Partnership Approach
                        </h3>

                        <div class="mt-5">

                            <label class="form-label">
                                In 2–3 sentences, briefly explain how you would introduce
                                Moose Loon AI Academy and help initiate a partnership
                                discussion within your institution. *
                            </label>

                            <textarea
                                name="introduction_plan"
                                rows="7"
                                required
                                class="form-input"
                                placeholder="Explain how you would approach the relevant leader, introduce the Academy and initiate the partnership discussion."
                            >{{ old('introduction_plan') }}</textarea>

                        </div>

                    </div>

                    {{-- Submit --}}
                    <div class="border-t border-slate-200 pt-6">

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-xl bg-slate-950 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-slate-800 sm:w-auto"
                        >
                            Submit Application
                        </button>

                        <p class="mt-3 text-xs leading-5 text-slate-500">
                            Only applicants who meet the requirements will be contacted
                            regarding the next stage of the selection process.
                        </p>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

<style>
    .form-label {
        display: block;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: rgb(15 23 42);
    }

    .form-input {
        display: block;
        width: 100%;
        margin-top: 0.5rem;
        border-radius: 0.75rem;
        border: 1px solid rgb(203 213 225);
        background: white;
        padding: 0.75rem 0.875rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: rgb(15 23 42);
        outline: none;
    }

    .form-input:focus {
        border-color: rgb(71 85 105);
        box-shadow: 0 0 0 3px rgb(148 163 184 / 0.2);
    }

    .choice-label {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: rgb(51 65 85);
    }
</style>
@endsection
