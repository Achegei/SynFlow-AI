@extends('layouts.app')

@section('title', 'Verify Certificate')

@section('content')
<div class="max-w-2xl mx-auto mt-16 bg-white shadow-lg rounded-lg p-8">

    <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">
        Certificate Verification
    </h2>

    <form action="{{ route('certificate.verify.post') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-lg font-medium text-gray-700 mb-2">
                Enter Certificate Number
            </label>

            <input 
                type="text" 
                name="certificate_number" 
                required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Example: CERT-AB12CD34"
            >
        </div>

        <div class="text-center">
            <button 
                type="submit"
                class="bg-indigo-600 hover:bg-red-700 text-white px-6 py-3 rounded-md font-semibold transition">
                Verify Certificate
            </button>
        </div>
    </form>

    @if(session('message'))
        <div class="mt-6 text-center text-lg font-semibold text-green-600">
            {{ session('message') }}
        </div>
    @endif

</div>
@endsection