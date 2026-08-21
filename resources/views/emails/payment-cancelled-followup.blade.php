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
    Your Enrollment Is Still Waiting for You
</h2>

<p>
    Hello {{ $user->name }},
</p>

<p>
    We noticed that the payment for your Moose Loon AI enrollment
    was cancelled before it could be completed.
</p>

<p>
    No problem — your enrollment is still available, and you can
    continue whenever you're ready.
</p>

@if($course)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 10px 0;">
            <strong>Your Enrollment</strong>
        </p>

        <p style="margin:6px 0;">
            <strong>Course:</strong>
            {{ $course->title }}
        </p>

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

    </div>
@endif

<p>
    If you cancelled the payment intentionally, there's nothing else
    you need to do right now.
</p>

<p>
    If you still want to join the programme, simply return and
    complete your payment to activate your access.
</p>

<div style="text-align:center; margin:30px 0;">

    <a href="{{ route('ai.packages') }}"
       style="
            display:inline-block;
            padding:14px 28px;
            background:#111827;
            color:#ffffff;
            text-decoration:none;
            border-radius:6px;
            font-weight:bold;
       ">
        Continue My Enrollment
    </a>

</div>

<p>
    If you cancelled because you experienced a problem or have
    questions about the programme, reply to this email and our team
    will be happy to assist you.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection