<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Partner Dashboard')</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="flex min-h-screen bg-gray-100 font-sans">

    <!-- Sidebar -->
    <aside class="w-64 h-screen sticky top-0 bg-gradient-to-b from-indigo-600 to-blue-500 text-white shadow-lg">
        <div class="p-6 text-2xl font-bold border-b border-indigo-400">Partner Panel</div>
        <nav class="mt-6">
            <ul>
                <li>
                    <a href="{{ route('partner.dashboard') }}" class="flex items-center p-4 mb-2 rounded-lg hover:bg-indigo-500 transition-colors {{ request()->routeIs('partner.dashboard') ? 'bg-indigo-700 font-semibold' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('partner.certificate.request.form') }}" class="flex items-center p-4 mb-2 rounded-lg hover:bg-indigo-500 transition-colors {{ request()->routeIs('partner.certificate.request.form') ? 'bg-indigo-700 font-semibold' : '' }}">
                        Request Certificate
                    </a>
                </li>
                <li>
                    <a href="{{ route('partner.certificate.status') }}" class="flex items-center p-4 mb-2 rounded-lg hover:bg-indigo-500 transition-colors {{ request()->routeIs('partner.certificate.status') ? 'bg-indigo-700 font-semibold' : '' }}">
                        Certificate Status
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left p-4 mb-2 rounded-lg hover:bg-red-500 transition-colors">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>