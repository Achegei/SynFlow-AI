@extends('layouts.partner')

@section('content')
<div class="container mx-auto p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">{{ Auth::user()->name }} Dashboard</h1>
        <a href="{{ route('partner.certificate.request.form') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
            Request Certificates
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-medium">Total Students</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalStudents }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18V3H3z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between">
            <div>
                <p class="text-gray-500 font-medium">Pending Certificates</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $pendingCertificates }}</p>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between">
            <div>
                <p class="text-gray-500 font-medium">Completed Certificates</p>
                <p class="text-2xl font-bold text-green-600">{{ $completedCertificates }}</p>
            </div>
        </div>
    </div>

    <!-- Certificate Requests Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Certificate Requests</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Certificate Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($requests as $request)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $request->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $request->student_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">KES{{ number_format($request->total_amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $request->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($request->payment_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $request->certificate_status === 'delivered' ? 'bg-green-100 text-green-800' :
                                       ($request->certificate_status === 'printing' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($request->certificate_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $request->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-400">No certificate requests yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection