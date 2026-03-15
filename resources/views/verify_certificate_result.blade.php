@extends('layouts.app')

@section('title', 'Certificate Verification Result')

@section('content')
<div class="max-w-2xl mx-auto mt-16 bg-white shadow-lg rounded-lg p-8">
    @if($valid)
        <h2 class="text-3xl font-bold text-center text-green-600 mb-6">✅ Certificate Valid!</h2>
        <p><strong>Name:</strong> {{ $certificate->full_name }}</p>
        <p><strong>Course:</strong> {{ $certificate->course->title }}</p>
        <p><strong>Issued:</strong> {{ $certificate->issued_at->format('F d, Y') }}</p>
        <p><strong>Certificate ID:</strong> {{ $certificate->certificate_number }}</p>
    @else
        <h2 class="text-3xl font-bold text-center text-red-600 mb-6">❌ Invalid Certificate</h2>
        <p>The certificate number you scanned does not exist in our records.</p>
    @endif
</div>
@endsection