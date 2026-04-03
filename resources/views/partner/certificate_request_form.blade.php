@extends('layouts.partner')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Request Certificates</h1>

    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
        <p class="mb-4 text-gray-600">Fill in the number of students and the total amount will be calculated automatically.</p>

        <form action="{{ route('partner.certificate.request.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="space-y-5">
            @csrf

            <div>
                <label class="block mb-2 font-medium text-gray-700">Number of Students</label>
                <input type="number" name="student_count" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" 
                    min="1" required>
            </div>

            <!-- NEW: Upload Student List -->
            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Upload Student List (Excel/CSV)
                </label>
                <input type="file" name="student_file" 
                    class="w-full px-4 py-3 border rounded-lg bg-white"
                    accept=".csv,.xlsx,.xls" required>

                <p class="text-sm text-gray-500 mt-1">
                    Upload a file with student names and details.
                </p>
            </div>

            <div>
                <label class="block mb-2 font-medium text-gray-700">Total Amount (KES 2,000 per student)</label>
                <input type="text" name="total_amount" id="totalAmount" 
                    class="w-full px-4 py-3 border rounded-lg bg-gray-100 text-gray-800" 
                    value="0" readonly>
            </div>

            <button type="submit" 
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg">
                Submit Request
            </button>
        </form>
    </div>
</div>

<script>
    const studentInput = document.querySelector('input[name="student_count"]');
    const totalAmountInput = document.getElementById('totalAmount');

    studentInput.addEventListener('input', function() {
        const count = parseInt(this.value) || 0;
        totalAmountInput.value = (count * 2000).toLocaleString('en-KE', { style: 'currency', currency: 'KES' });
    });
</script>
@endsection