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

    /*
    |--------------------------------------------------------------------------
    | Translate technical payment failures into customer-friendly language.
    |--------------------------------------------------------------------------
    */

    $failedCode = $emailMetadata['failed_code'] ?? null;
    $failedReason = $emailMetadata['failed_reason'] ?? null;

    $paymentMessage = match ((string) $failedCode) {
        '1037' =>
            'Your payment could not be initiated. Please make sure your phone is on, your Safaricom SIM is active, and try the payment again.',

        default =>
            'We were unable to complete your payment. Please try again, and if the problem continues, our team will be happy to help.',
    };
@endphp

<h2 style="margin-top:0;">
    Let's Help You Complete Your Payment
</h2>

<p>
    Hello {{ $user->name }},
</p>

<p>
    We noticed that your recent payment attempt was unsuccessful.
    Don't worry — your enrollment is still available and you can
    try again.
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

<div style="margin:25px 0; padding:18px; background:#fff7ed; border-left:4px solid #f59e0b;">

    <p style="margin:0;">
        <strong>What happened?</strong>
    </p>

    <p style="margin:10px 0 0 0;">
        {{ $paymentMessage }}
    </p>

</div>

<p>
    You can try the payment again and continue with your enrollment.
    If you are still experiencing a problem, please contact our team
    and we'll help you resolve it.
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
        Try Payment Again
    </a>

</div>

<p>
    We look forward to having you continue your learning journey
    with Moose Loon AI Academy.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection