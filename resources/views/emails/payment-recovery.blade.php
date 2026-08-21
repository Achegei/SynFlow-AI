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
    Complete Your Enrollment
</h2>

<p>
    Hello {{ $user->name }},
</p>

<p>
    We noticed that you started your enrollment with
    <strong>Moose Loon AI Academy</strong>, but your payment has not yet
    been completed.
</p>

@if($course)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 10px 0;">
            <strong>Enrollment Details</strong>
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
    You were almost there. Once your payment is completed,
    your access can be activated and you can continue with your
    learning.
</p>

<p>
    If you experienced any difficulty while making the payment,
    don't worry. Our team is available to help you complete the process.
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
        Complete My Enrollment
    </a>

</div>

<p>
    If you have any questions, simply reply to this email and
    our team will be happy to assist you.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection