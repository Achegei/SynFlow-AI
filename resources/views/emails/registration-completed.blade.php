@extends('layouts.email')

@section('content')

@php
    $course = !empty($emailMetadata['course_id'])
        ? \App\Models\Course::find($emailMetadata['course_id'])
        : null;

    $package = !empty($emailMetadata['package_id'])
        ? \App\Models\Package::find($emailMetadata['package_id'])
        : null;
@endphp

<h2 style="margin-top:0;">
    Welcome to Moose Loon AI Academy, {{ $user->name }}!
</h2>

<p>
    Thank you for creating your account with Moose Loon AI Academy.
    Your registration has been successfully completed.
</p>

@if($course || $package)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 12px 0;">
            <strong>Your Selected Learning Path</strong>
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

    </div>
@endif

<p>
    Your account is ready. The next step is to complete your enrollment
    so that you can gain access to your selected learning programme.
</p>

<p>
    <strong>What happens next?</strong>
</p>

<ul>
    <li>Review your selected learning programme.</li>
    <li>Choose your preferred access option.</li>
    <li>Complete your enrollment payment.</li>
    <li>Once payment is confirmed, your access will be activated automatically.</li>
</ul>

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
    If you're unsure which course or package is right for you, or if
    something is preventing you from continuing, simply reply to this
    email and our team will be happy to assist you.
</p>

<p>
    We look forward to having you learn with us.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection