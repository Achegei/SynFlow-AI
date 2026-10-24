<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sales Executive Dashboard | Moose Loon AI Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
@php
    $maximumTrend = max(1, collect($registrationTrend)->max('count') ?? 1);
@endphp

<div class="min-h-screen">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5 sm:px-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-700">
                    Moose Loon AI Academy
                </p>
                <h1 class="mt-1 text-xl font-bold tracking-tight sm:text-2xl">
                    Sales Executive Dashboard
                </h1>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                    Sign out
                </button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-7xl space-y-8 px-5 py-8 sm:px-8">
        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        <section class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    {{ now()->format('l, j F Y') }}
                </p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">
                    Welcome, {{ Auth::user()->name }}
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Your institutions, students, enrollments and earnings at a glance.
                </p>
            </div>
            <div class="rounded-full border border-blue-100 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-800">
                KES {{ number_format($commissionPerEnrollment, 0) }} per qualifying paid enrollment
            </div>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach([
                ['label' => 'Assigned Institutions', 'value' => number_format($totalInstitutions), 'note' => 'Colleges in your portfolio'],
                ['label' => 'Total Students', 'value' => number_format($totalStudents), 'note' => 'Unique historical and new students'],
                ['label' => 'Paid Enrollments', 'value' => number_format($paidEnrollments), 'note' => 'Confirmed course enrollments'],
                ['label' => 'Available Wallet', 'value' => 'KES '.number_format($walletBalance, 2), 'note' => 'Current withdrawable balance'],
            ] as $metric)
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">{{ $metric['label'] }}</p>
                    <p class="mt-3 break-words text-2xl font-bold tracking-tight sm:text-3xl">
                        {{ $metric['value'] }}
                    </p>
                    <p class="mt-2 text-xs text-slate-500">{{ $metric['note'] }}</p>
                </article>
            @endforeach
        </section>

        <section class="grid gap-4 sm:grid-cols-3">
            @foreach([
                ['label' => 'New Students Today', 'value' => $newToday],
                ['label' => 'New Students Yesterday', 'value' => $newYesterday],
                ['label' => 'New Students — Last 7 Days', 'value' => $newLast7Days],
            ] as $metric)
                <article class="rounded-2xl border border-slate-200 bg-white p-6">
                    <p class="text-sm font-medium text-slate-500">{{ $metric['label'] }}</p>
                    <p class="mt-3 text-3xl font-bold">{{ number_format($metric['value']) }}</p>
                    <p class="mt-2 text-xs text-slate-500">Based on student account registration date</p>
                </article>
            @endforeach
        </section>

        <section class="grid gap-5 lg:grid-cols-3">
            <article class="rounded-2xl bg-slate-900 p-7 text-white lg:col-span-2">
                <p class="text-sm font-medium text-slate-300">Lifetime Commission Earned</p>
                <p class="mt-3 text-4xl font-bold tracking-tight">
                    KES {{ number_format($totalCommissionEarned, 2) }}
                </p>
                <p class="mt-3 text-sm text-slate-300">
                    Based on recorded commission transactions. This is not your available wallet balance.
                </p>
                <div class="mt-6 border-t border-slate-700 pt-5">
                    <p class="text-sm text-slate-300">Commission per qualifying paid enrollment</p>
                    <p class="mt-1 text-xl font-bold">
                        KES {{ number_format($commissionPerEnrollment, 2) }}
                    </p>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-7">
                <h3 class="text-lg font-bold">Withdraw Earnings</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Request a payout from your available wallet balance.
                </p>
                <p class="mt-5 text-2xl font-bold">
                    KES {{ number_format($walletBalance, 2) }}
                </p>
                <form class="mt-6" method="POST" action="{{ route('sales.request-payout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800">
                        Request Withdrawal
                    </button>
                </form>
            </article>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 class="text-lg font-bold">Student Registration Activity</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Daily student account registrations over the last 30 days.
                    </p>
                </div>
                <span class="text-xs font-medium text-slate-500">Last 30 days</span>
            </div>

            <div class="mt-8 overflow-x-auto">
                <div class="flex h-48 min-w-[600px] items-end gap-2 border-b border-slate-200 pb-1">
                    @foreach($registrationTrend as $day)
                        <div class="group relative flex h-full min-w-0 flex-1 items-end"
                             title="{{ $day['date'] }}: {{ $day['count'] }} new students">
                            <div class="w-full rounded-t-md bg-blue-600 transition hover:bg-blue-800"
                                 style="height: {{ $day['count'] > 0 ? max(4, ($day['count'] / $maximumTrend) * 100) : 2 }}%">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 flex min-w-[600px] justify-between text-xs text-slate-500">
                    <span>{{ $registrationTrend[0]['date'] ?? '' }}</span>
                    <span>{{ $registrationTrend[14]['date'] ?? '' }}</span>
                    <span>{{ $registrationTrend[29]['date'] ?? '' }}</span>
                </div>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 px-6 py-5">
                <div>
                    <h3 class="text-lg font-bold">Institution Performance</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Assigned institutions and their student enrollment totals.
                    </p>
                </div>
                <span class="text-sm text-slate-500">
                    {{ number_format($totalInstitutions) }} institutions
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Institution</th>
                            <th class="px-6 py-4 font-semibold">Students</th>
                            <th class="px-6 py-4 font-semibold">Paid Enrollments</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($institutionPerformance as $performance)
                            <tr>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">
                                        {{ $performance['institution']->name }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $performance['institution']->email ?? 'No email available' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ number_format($performance['students']) }}
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ number_format($performance['paid_enrollments']) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                        {{ ucfirst($performance['institution']->status ?? 'Unknown') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    No institutions assigned yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($institutions->hasPages())
                <div class="border-t border-slate-200 px-6 py-5">
                    {{ $institutions->links() }}
                </div>
            @endif
        </section>

        <footer class="pb-4 text-center text-xs text-slate-400">
            Moose Loon AI Academy · Sales Performance Dashboard
        </footer>
    </main>
</div>
</body>
</html>
