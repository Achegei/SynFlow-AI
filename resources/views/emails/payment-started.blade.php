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
    Your Payment Is Waiting for You
</h2>

<p>
    Hello {{ $user->name }},
</p>

<p>
    You recently started the enrollment process with Moose Loon AI.
    Your payment request has been initiated, but we haven't received
    confirmation of a completed payment yet.
</p>

@if($course || $package || $amount)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 10px 0;">
            <strong>Your Enrollment</strong>
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

    </div>
@endif

<p>
    <strong>What happens next?</strong>
</p>

<p>
    Complete the payment request on your phone. Once your payment is
    successfully confirmed, your access will be activated automatically.
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
        Complete My Payment
    </a>

</div>

<p>
    If you have already completed the payment, there's no need to make
    another payment. Please allow a short time for the confirmation to
    reach our system.
</p>

<p>
    If you did not initiate this payment, you can safely ignore this email.
</p>

<p>
    If you need help completing your enrollment, reply to this email
    and our team will be happy to assist you.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection