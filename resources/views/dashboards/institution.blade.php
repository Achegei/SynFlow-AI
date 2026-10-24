<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $institution->name }} | Institution Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
@php
    $maximumTrend = max(1, collect($registrationTrend)->max('count') ?? 1);
@endphp

<div class="min-h-screen">

    {{-- HEADER --}}
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5 sm:px-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-700">
                    Moose Loon AI Academy
                </p>
                <h1 class="mt-1 text-xl font-bold tracking-tight sm:text-2xl">
                    Institution Dashboard
                </h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">Institution Administrator</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl space-y-8 px-5 py-8 sm:px-8">

        {{-- NOTIFICATIONS --}}
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

        {{-- INTRO --}}
        <section class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    {{ now()->format('l, j F Y') }}
                </p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">
                    {{ $institution->name }}
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Monitor student registrations, learning activity, enrollments and institutional earnings.
                </p>
            </div>

            <span class="rounded-full border border-blue-100 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-800">
                {{ number_format($institutionPercentage, 0) }}% institution revenue share
            </span>
        </section>

        {{-- PRIMARY KPIs --}}
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach([
                ['label' => 'Total Students', 'value' => number_format($totalStudents), 'note' => 'Unique historical and new students'],
                ['label' => 'Paid Enrollments', 'value' => number_format($paidEnrollments), 'note' => 'Confirmed course enrollments'],
                ['label' => 'Institution Earnings', 'value' => 'KES '.number_format($institutionShare, 2), 'note' => 'Recorded lifetime commission earnings'],
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

        {{-- REGISTRATION KPIs --}}
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

        {{-- FINANCIAL OVERVIEW --}}
        <section class="grid gap-5 lg:grid-cols-3">
            <article class="rounded-2xl bg-slate-900 p-7 text-white lg:col-span-2">
                <p class="text-sm font-medium text-slate-300">Institution Financial Performance</p>

                <p class="mt-3 text-4xl font-bold tracking-tight">
                    KES {{ number_format($institutionShare, 2) }}
                </p>
                <p class="mt-2 text-sm text-slate-300">
                    Lifetime institutional earnings recorded in the commission ledger.
                </p>

                <div class="mt-7 grid gap-5 border-t border-slate-700 pt-5 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-slate-300">Attributed Transaction Revenue</p>
                        <p class="mt-2 text-xl font-bold">
                            KES {{ number_format($totalRevenue, 2) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-300">Institution Share</p>
                        <p class="mt-2 text-xl font-bold">
                            {{ number_format($institutionPercentage, 0) }}%
                        </p>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-7">
                <h3 class="text-lg font-bold">Request Payout</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Withdraw funds from your available institutional wallet.
                </p>

                <p class="mt-5 text-2xl font-bold">
                    KES {{ number_format($walletBalance, 2) }}
                </p>

                <form method="POST" action="{{ route('institution.request-payout') }}" class="mt-6">
                    @csrf
                    <button type="submit"
                        class="w-full rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800">
                        Request Payout
                    </button>
                </form>
            </article>
        </section>

        {{-- LEARNING ACTIVITY --}}
        <section>
            <div class="mb-4">
                <h3 class="text-lg font-bold">Student Learning Activity</h3>
                <p class="mt-1 text-sm text-slate-500">
                    Engagement indicators based on recorded student activity.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                @foreach([
                    ['label' => 'Active Today', 'value' => $activeToday, 'note' => 'Activity recorded today'],
                    ['label' => 'Active Last 7 Days', 'value' => $activeThisWeek, 'note' => 'Activity within the past seven days'],
                    ['label' => 'Inactive 14+ Days', 'value' => $inactiveStudents, 'note' => 'Students who may need follow-up'],
                ] as $metric)
                    <article class="rounded-2xl border border-slate-200 bg-white p-6">
                        <p class="text-sm font-medium text-slate-500">{{ $metric['label'] }}</p>
                        <p class="mt-3 text-3xl font-bold">{{ number_format($metric['value']) }}</p>
                        <p class="mt-2 text-xs text-slate-500">{{ $metric['note'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- REGISTRATION TREND --}}
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

        {{-- STUDENT DIRECTORY --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 px-6 py-5">
                <div>
                    <h3 class="text-lg font-bold">Student Directory</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Historical and newly enrolled students associated with this institution.
                    </p>
                </div>
                <span class="text-sm text-slate-500">
                    {{ number_format($totalStudents) }} students
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Student</th>
                            <th class="px-6 py-4 font-semibold">Registered</th>
                            <th class="px-6 py-4 font-semibold">Last Activity</th>
                            <th class="px-6 py-4 font-semibold">Activity Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($students as $student)
                            @php
                                $lastActivity = $student->last_activity_at
                                    ? \Illuminate\Support\Carbon::parse($student->last_activity_at)
                                    : null;

                                $isRecentlyActive = $lastActivity
                                    && $lastActivity->gte(now()->subDays(7));
                            @endphp

                            <tr>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $student->name }}</p>
                                    <p class="mt-1 text-xs text-slate-500">{{ $student->email }}</p>
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $student->created_at?->format('d M Y') ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $lastActivity?->diffForHumans() ?? 'No recorded activity' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($isRecentlyActive)
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Recently Active
                                        </span>
                                    @else
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            No Recent Activity
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    No students associated with this institution yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($students->hasPages())
                <div class="border-t border-slate-200 px-6 py-5">
                    {{ $students->links() }}
                </div>
            @endif
        </section>

        <footer class="pb-4 text-center text-xs text-slate-400">
            Moose Loon AI Academy · Institution Performance Dashboard
        </footer>

    </main>
</div>
</body>
</html>
