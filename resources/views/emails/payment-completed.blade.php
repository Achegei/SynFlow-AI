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
    Payment Successful, {{ $user->name }}!
</h2>

<p>
    Great news — we've successfully received your payment and your
    Moose Loon AI Academy enrollment is now confirmed.
</p>

@if($course || $package || $amount)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 12px 0;">
            <strong>Enrollment Details</strong>
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
                <strong>Amount Paid:</strong>
                {{ $currency }} {{ number_format((float) $amount, 2) }}
            </p>
        @endif

    </div>
@endif

<p>
    <strong>Your access has been activated.</strong>
</p>

<p>
    You can now log in to your Moose Loon AI account and begin using
    the learning resources available to you.
</p>

<div style="text-align:center; margin:30px 0;">

    <a href="{{route('classroom')}}"
       style="
            display:inline-block;
            padding:14px 28px;
            background:#111827;
            color:#ffffff;
            text-decoration:none;
            border-radius:6px;
            font-weight:bold;
       ">
        Go to My Dashboard
    </a>

</div>

<p>
    Keep your account details secure and make the most of your access.
    If you experience any problem accessing your programme, reply to
    this email and our team will assist you.
</p>

<p>
    Thank you for choosing Moose Loon AI. We're excited to have you
    with us.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection