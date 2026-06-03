<!DOCTYPE html>
<html>
<head>
    <title>Sales Executive Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

<div class="max-w-7xl mx-auto p-6">

    {{-- FLASH MESSAGES --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex justify-between items-start mb-8">

        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Good {{ now()->format('H') < 12 ? 'Morning' : (now()->format('H') < 18 ? 'Afternoon' : 'Evening') }},
                {{ Auth::user()->name }}
            </h1>
            <p class="text-gray-500 mt-1">
                Track your performance, institutions, and earnings in real time
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-4 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
                Logout
            </button>
        </form>

    </div>

    {{-- KPI GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Wallet Balance</p>
            <p class="text-3xl font-bold text-green-600 mt-2">
                KES {{ number_format($walletBalance, 2) }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Institutions</p>
            <p class="text-3xl font-bold mt-2">
                {{ $institutions->count() }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Commission Rate</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">
                {{ $commission }}%
            </p>
        </div>

    </div>

    {{-- ACTION SECTION --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm mb-8 flex items-center justify-between">

        <div>
            <h2 class="text-lg font-semibold">Withdraw Earnings</h2>
            <p class="text-sm text-gray-500">
                Request payout from your available wallet balance
            </p>
        </div>

        <form method="POST" action="{{ route('sales.request-payout') }}">
            @csrf
            <button class="px-5 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">
                Request Withdrawal
            </button>
        </form>

    </div>

    {{-- INSTITUTIONS --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">

        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold">Your Institutions</h2>
                <p class="text-sm text-gray-500">Paginated list of assigned institutions</p>
            </div>

            <span class="text-sm text-gray-400">
                Total: {{ $institutions->total() ?? $institutions->count() }}
            </span>
        </div>

        <div class="p-6">

            @if($institutions->count() > 0)

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    @foreach($institutions as $institution)
                        <div class="flex items-center justify-between px-4 py-3 border rounded-xl hover:bg-gray-50 transition">

                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ $institution->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $institution->email ?? 'No email' }}
                                </p>
                            </div>

                            <span class="text-xs px-3 py-1 bg-blue-50 text-blue-600 rounded-full">
                                Active
                            </span>

                        </div>
                    @endforeach

                </div>

                {{-- PAGINATION --}}
                <div class="mt-6">
                    {{ $institutions->links() }}
                </div>

            @else

                <div class="text-center py-10 text-gray-500">
                    No institutions assigned yet.
                </div>

            @endif

        </div>

    </div>

</div>

</body>
</html>