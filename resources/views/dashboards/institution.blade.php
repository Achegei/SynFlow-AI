<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $institution->name }} - Dashboard</title>

    @vite(['resources/css/app.css'])

    <style>
        body {
            background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
        }
    </style>
</head>

<body class="text-gray-800">

<!-- TOP NAV (FIXED LAYOUT) -->
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LEFT -->
        <div>
            <h1 class="text-xl font-semibold tracking-tight">
                {{ $institution->name }} Dashboard
            </h1>
            <p class="text-xs text-gray-500">
                Institution overview & analytics
            </p>
        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-4">

            <div class="text-right leading-tight">
                <p class="text-sm font-medium">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500">
                    Institution Admin
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-4 py-2 rounded-xl bg-black text-white text-sm hover:bg-gray-800 transition">
                    Logout
                </button>
            </form>

        </div>

    </div>
</header>


<main class="max-w-7xl mx-auto px-6 py-10">

    <!-- PAGE HEADER -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold tracking-tight">
            Overview
        </h2>
        <p class="text-gray-500 mt-1">
            Track students, revenue, and institutional performance in real time
        </p>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <!-- Students -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <p class="text-sm text-gray-500">Students</p>
            <h2 class="text-3xl font-semibold mt-2">
                {{ $students->count() }}
            </h2>
            <p class="text-xs text-gray-400 mt-2">Active enrolled learners</p>
        </div>

        <!-- Revenue -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h2 class="text-3xl font-semibold mt-2">
                KES {{ number_format($institutionShare) }}
            </h2>
            <p class="text-xs text-gray-400 mt-2">All-time earnings</p>
        </div>

        <!-- Share -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <p class="text-sm text-gray-500">Institution Share (40%)</p>
            <h2 class="text-3xl font-semibold mt-2 text-green-600">
                KES {{ number_format($institutionShare) }}
            </h2>
            <p class="text-xs text-gray-400 mt-2">Your revenue share</p>
        </div>

        <form method="POST"
            action="{{ route('institution.request-payout') }}"
            class="mt-4">
            @csrf

            <button
                class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700">
                Request Payout
            </button>
        </form>

    </div>


    <!-- STUDENTS SECTION -->
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <div>
                <h3 class="text-lg font-semibold">Students</h3>
                <p class="text-sm text-gray-500">
                    All learners under this institution
                </p>
            </div>

            <div class="text-sm text-gray-400">
                {{ $students->count() }} total
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Name</th>
                        <th class="text-left px-6 py-3">Email</th>
                        <th class="text-left px-6 py-3">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                @forelse($students as $student)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium">
                            {{ $student->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $student->email }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-50 text-green-600">
                                Active
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <div class="text-3xl">👥</div>
                                <p class="font-medium">No students yet</p>
                                <p class="text-sm">Students will appear here once they enroll</p>
                            </div>
                        </td>
                    </tr>
                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>

</body>
</html>