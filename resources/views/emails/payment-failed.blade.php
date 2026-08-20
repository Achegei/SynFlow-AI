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
    $failedReason = strtolower($emailMetadata['failed_reason'] ?? '');

    /*
    |--------------------------------------------------------------------------
    | Translate technical payment failures into customer-friendly language.
    |--------------------------------------------------------------------------
    */

    if (
        str_contains($failedReason, 'phone') ||
        str_contains($failedReason, 'sim') ||
        str_contains($failedReason, 'safaricom')
    ) {
        $failureMessage = 'The payment request could not be completed on your phone. Please make sure your phone is switched on, your SIM is active, and you are able to receive payment prompts before trying again.';
    } elseif (
        str_contains($failedReason, 'timeout') ||
        str_contains($failedReason, 'timed out')
    ) {
        $failureMessage = 'The payment request took too long to complete. Please try again when you are ready.';
    } else {
        $failureMessage = 'We were unable to complete your payment. Please try again, and if the problem continues, our team will be happy to help.';
    }
@endphp

<h2 style="margin-top:0;">
    We Couldn't Complete Your Payment
</h2>

<p>
    Hello {{ $user->name }},
</p>

<p>
    We attempted to process your payment for
    @if($course)
        <strong>{{ $course->title }}</strong>
    @else
        your selected course
    @endif
    @if($package)
        with <strong>{{ $package->name }}</strong> access
    @endif
    @if($amount)
        for <strong>{{ $currency }} {{ number_format((float) $amount, 2) }}</strong>
    @endif
    , but the payment was not completed.
</p>

@if($course || $package || $amount)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 10px 0;">
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

    </div>
@endif

<p>
    {{ $failureMessage }}
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
    If you continue experiencing difficulties, please contact our support
    team and we'll help you complete your enrollment.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection