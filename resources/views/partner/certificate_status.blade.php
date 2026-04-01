@extends('layouts.partner')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Certificate Status</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-2xl border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Request ID</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Students</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Total Amount</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Payment Status</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Certificate Status</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Requested At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($requests as $request)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $request->id }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $request->student_count }}</td>
                        <td class="px-6 py-4 text-gray-700">KES {{ number_format($request->total_amount, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($request->payment_status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                            @else
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Paid</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($request->certificate_status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                            @elseif($request->certificate_status === 'printing')
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">Printing</span>
                            @else
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Shipped</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $request->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">No certificate requests yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection