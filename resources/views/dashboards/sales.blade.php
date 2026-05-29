<!DOCTYPE html>
<html>
<head>
    <title>Sales Executive Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<div class="max-w-6xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
           Good {{ now()->format('H') < 12 ? 'Morning' : (now()->format('H') < 18 ? 'Afternoon' : 'Evening') }}
           {{ Auth::user()->name }},  Welcome to your Dashboard
        </h1>
        <p class="text-gray-500">
            Track your performance, institutions, and earnings
        </p>
    </div>

    <!-- LOGOUT BUTTON -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit"
            class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-sm font-medium">
            Logout
        </button>

    </form>

    </div>

        <!-- STATS -->
        <div class="grid grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Wallet Balance</p>
                <p class="text-2xl font-bold text-green-600">
                    KES {{ number_format($walletBalance, 2) }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Institutions</p>
                <p class="text-2xl font-bold">
                    {{ $institutions->count() }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Commission</p>
                <p class="text-2xl font-bold text-blue-600">
                    {{ $commission }}%
                </p>
            </div>

        </div>

    <!-- INSTITUTIONS LIST -->
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-bold mb-4">
            Your Institutions
        </h2>

        @if($institutions->count() > 0)

            <div class="flex flex-wrap gap-3">

                @foreach($institutions as $institution)
                    <div class="px-4 py-2 bg-blue-50 border border-blue-200 rounded-full text-blue-700 text-sm font-medium">
                        {{ $institution->name }}
                    </div>
                @endforeach

            </div>

        @else

            <p class="text-gray-500">
                No institutions assigned yet.
            </p>

        @endif

    </div>

</div>

</body>
</html>