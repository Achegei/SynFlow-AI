@extends('layouts.email')

@section('content')

@php
    $course = !empty($emailMetadata['course_id'])
        ? \App\Models\Course::find($emailMetadata['course_id'])
        : null;

    $package = !empty($emailMetadata['package_id'])
        ? \App\Models\Package::find($emailMetadata['package_id'])
        : null;

    $amount = $emailMetadata['amount'] ?? null;
    $currency = $emailMetadata['currency'] ?? 'KES';
@endphp

<h2 style="margin-top:0;">
    Your Payment Was Cancelled
</h2>

<p>
    Hello {{ $user->name }},
</p>

<p>
    We noticed that the payment you started with Moose Loon AI was
    cancelled before it could be completed.
</p>

@if($course || $package || $amount)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 12px 0;">
            <strong>Payment Details</strong>
        </p>

        @if($course)
            <p style="margin:6px 0;">
                <strong>Course:</strong>
                {{ $course->title }}
            </p>
        @endif

        @if($package)
            <p style="margin:6px 0;">
                <strong>Access:</strong>
                {{ $package->name }}

                @if($package->duration_days)
                    ({{ $package->duration_days }}
                    {{ $package->duration_days == 1 ? 'day' : 'days' }})
                @endif
            </p>
        @endif

        @if($amount)
            <p style="margin:6px 0;">
                <strong>Amount:</strong>
                {{ $currency }} {{ number_format((float) $amount, 2) }}
            </p>
        @endif

        <p style="margin:6px 0;">
            <strong>Status:</strong>
            Payment cancelled
        </p>

    </div>
@endif

<p>
    No payment was completed from this transaction, and your enrollment
    has not been activated.
</p>

<p>
    If you cancelled the payment intentionally, no further action is
    required.
</p>

<p>
    If you still want to continue with your enrollment, you can return
    to Moose Loon AI and start the payment process again.
</p>

<div style="text-align:center; margin:30px 0;">

    <a href="{{ url('/courses') }}"
       style="
            display:inline-block;
            padding:14px 28px;
            background:#111827;
            color:#ffffff;
            text-decoration:none;
            border-radius:6px;
            font-weight:bold;
       ">
        Try Payment Again
    </a>

</div>

<p>
    If you cancelled because something went wrong or you need help
    choosing a course or package, simply reply to this email and our
    team will be happy to assist you.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection