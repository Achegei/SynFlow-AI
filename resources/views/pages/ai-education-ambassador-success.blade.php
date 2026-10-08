@extends('layouts.app')

@section('title', 'Application Received — Moose Loon AI Academy')

@section('content')
<div class="min-h-[70vh] bg-slate-50 px-6 py-20">

    <div class="mx-auto max-w-2xl">

        <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm sm:p-12">

            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">
                Moose Loon AI Academy
            </p>

            <h1 class="mt-5 text-3xl font-semibold tracking-tight text-slate-950">
                Application Received
            </h1>

            <p class="mt-4 leading-7 text-slate-600">
                Thank you for your interest in becoming an AI Education Ambassador
                with Moose Loon AI Academy.
            </p>

            <div class="mt-8 rounded-xl bg-slate-50 p-6">

                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">
                    Application Reference
                </p>

                <p class="mt-2 text-2xl font-semibold text-slate-950">
                    {{ $applicationReference }}
                </p>

            </div>

            <p class="mt-6 text-sm leading-6 text-slate-500">
                We will review your application and contact you if you meet the
                requirements for the next stage of the selection process.
            </p>

            <a
                href="{{ route('careers') }}"
                class="mt-8 inline-flex rounded-xl bg-slate-950 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800"
            >
                Return to Careers
            </a>

        </div>

    </div>

</div>
@endsection
