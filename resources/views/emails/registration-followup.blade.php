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
    Ready to Continue Your Journey, {{ $user->name }}?
</h2>

<p>
    Hello {{ $user->name }},
</p>

<p>
    You recently created your Moose Loon AI account, but it looks like
    you haven't completed the next step of your enrollment yet.
</p>

<p>
    Your account is ready. You can continue from where you left off
    and choose the learning programme and access option that works
    best for you.
</p>

@if($course || $package)
    <div style="margin:25px 0; padding:20px; background:#f4f6f8; border-radius:8px;">

        <p style="margin:0 0 12px 0;">
            <strong>Your Journey So Far</strong>
        </p>

        <p style="margin:6px 0;">
            <strong>Stage:</strong>
            Registration completed
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
    <strong>What happens next?</strong>
</p>

<p>
    Continue your enrollment, select your preferred access option,
    and proceed to payment. Once your payment is confirmed, your
    access will be activated automatically.
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
        Continue My Enrollment
    </a>

</div>

<p>
    If you stopped because you were unsure which course or package
    to choose, or if something prevented you from continuing, simply
    reply to this email. Our team will be happy to help.
</p>

<p>
    We hope to see you continue your journey with Moose Loon AI.
</p>

<p>
    Best regards,<br>
    <strong>Moose Loon AI Academy</strong>
</p>

@endsection