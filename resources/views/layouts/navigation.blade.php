<nav
    x-data="{ open: false }"
    class="bg-white border-b border-[#E5EAF2] shadow-[0_2px_12px_rgba(7,26,77,0.04)]"
>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-20">

            <!-- Left side: Logo + Links -->
            <div class="flex items-center">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a
                        href="{{ route('classroom') }}"
                        class="flex items-center rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D71920] focus:ring-offset-2"
                        aria-label="Moose Loon AI Academy"
                    >
                        <img
                            src="{{ asset('images/synflowlogo2.jpeg') }}"
                            alt="Moose Loon AI Academy"
                            class="block h-11 sm:h-12 w-auto object-contain"
                        >
                    </a>
                </div>


                <!-- Desktop Navigation -->
                <div class="hidden sm:flex items-center ms-10 space-x-1">

                    <a
                        href="{{ route('classroom') }}"
                        class="
                            inline-flex items-center
                            px-4 py-2
                            rounded-lg
                            text-sm font-semibold
                            transition duration-200
                            {{ request()->routeIs('classroom')
                                ? 'bg-[#F7F9FC] text-[#071A4D] border border-[#E5EAF2]'
                                : 'text-[#5B6472] hover:text-[#071A4D] hover:bg-[#F7F9FC]'
                            }}
                        "
                    >
                        <svg
                            class="w-4 h-4 me-2 {{ request()->routeIs('classroom') ? 'text-[#D71920]' : 'text-[#071A4D]' }}"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 19.5A2.5 2.5 0 016.5 17H20"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"
                            />
                        </svg>

                        {{ __('Classroom') }}
                    </a>


                    <a
                        href="{{ route('auth-about') }}"
                        class="
                            inline-flex items-center
                            px-4 py-2
                            rounded-lg
                            text-sm font-semibold
                            transition duration-200
                            {{ request()->routeIs('auth-about')
                                ? 'bg-[#F7F9FC] text-[#071A4D] border border-[#E5EAF2]'
                                : 'text-[#5B6472] hover:text-[#071A4D] hover:bg-[#F7F9FC]'
                            }}
                        "
                    >
                        <svg
                            class="w-4 h-4 me-2 {{ request()->routeIs('auth-about') ? 'text-[#D71920]' : 'text-[#071A4D]' }}"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="9" />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 10v6"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 7.5h.01"
                            />
                        </svg>

                        {{ __('About') }}
                    </a>


                    {{-- =====================================================
                         EXISTING NAVIGATION — KEPT COMMENTED OUT
                         ===================================================== --}}

                    <!--<x-responsive-nav-link :href="route('community')" :active="request()->routeIs('community')">
                        {{ __('Community') }}
                    </x-responsive-nav-link> -->

                    <!--<x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                        {{ __('Calendar') }}
                    </x-responsive-nav-link> -->

                    <!--<x-responsive-nav-link :href="route('members')" :active="request()->routeIs('members')">
                        {{ __('Members') }}
                    </x-responsive-nav-link> -->

                    <!--<x-responsive-nav-link :href="route('map')" :active="request()->routeIs('map')">
                        {{ __('Map') }}
                    </x-responsive-nav-link>-->

                    <!--<x-responsive-nav-link :href="route('leaderboards')" :active="request()->routeIs('leaderboards')">
                        {{ __('Leaderboards') }}
                    </x-responsive-nav-link> -->

                </div>
            </div>


            <!-- Right side: User Dropdown -->
            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="
                                inline-flex items-center
                                min-h-[44px]
                                px-3 py-2
                                rounded-lg
                                border border-[#E5EAF2]
                                bg-white
                                text-sm font-medium
                                text-[#071A4D]
                                hover:bg-[#F7F9FC]
                                hover:border-[#D9E0EA]
                                focus:outline-none
                                focus:ring-2
                                focus:ring-[#D71920]
                                focus:ring-offset-2
                                transition duration-200
                            "
                        >

                            <!-- User Initial -->
                            <span
                                class="
                                    flex items-center justify-center
                                    w-8 h-8
                                    rounded-full
                                    bg-[#071A4D]
                                    text-white
                                    text-xs
                                    font-bold
                                    me-2
                                "
                                aria-hidden="true"
                            >
                                {{ strtoupper(substr(Auth::user()?->name ?? 'U', 0, 1)) }}
                            </span>

                            <div class="text-[#071A4D] font-semibold">
                                {{ Auth::user()?->name }}
                            </div>

                            <div class="ms-2 text-[#5B6472]">

                                <svg
                                    class="fill-current h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                            </div>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <div class="px-4 py-3 border-b border-[#E5EAF2]">

                            <p class="text-xs font-semibold uppercase tracking-wide text-[#5B6472]">
                                Moose Loon AI Academy
                            </p>

                            <p class="mt-1 text-sm font-semibold text-[#071A4D] truncate">
                                {{ Auth::user()?->name }}
                            </p>

                            <p class="text-xs text-[#5B6472] truncate">
                                {{ Auth::user()?->email }}
                            </p>

                        </div>


                        <x-dropdown-link
                            :href="route('profile.edit')"
                            class="text-[#071A4D] hover:bg-[#F7F9FC]"
                        >
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-[#B51218] hover:bg-red-50"
                            >
                                {{ __('Log Out') }}
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            <!-- Hamburger (mobile menu button) -->
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="
                        inline-flex items-center justify-center
                        min-w-[44px] min-h-[44px]
                        p-2
                        rounded-lg
                        text-[#071A4D]
                        hover:bg-[#F7F9FC]
                        hover:text-[#D71920]
                        focus:outline-none
                        focus:ring-2
                        focus:ring-[#D71920]
                        focus:ring-offset-2
                        transition duration-200
                    "
                    aria-label="Toggle navigation menu"
                    :aria-expanded="open.toString()"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >

                        <path
                            :class="{
                                'hidden': open,
                                'inline-flex': !open
                            }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{
                                'hidden': !open,
                                'inline-flex': open
                            }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div
        :class="{
            'block': open,
            'hidden': !open
        }"
        class="hidden sm:hidden border-t border-[#E5EAF2] bg-white"
    >

        <div class="px-4 pt-4 pb-3 space-y-1">

            <x-responsive-nav-link
                :href="route('classroom')"
                :active="request()->routeIs('classroom')"
                class="text-[#071A4D]"
            >
                {{ __('Classroom') }}
            </x-responsive-nav-link>


            <!--<x-responsive-nav-link :href="route('community')" :active="request()->routeIs('community')">
                {{ __('Community') }}
            </x-responsive-nav-link> -->


            <!--<x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                {{ __('Calendar') }}
            </x-responsive-nav-link> -->


            <!--<x-responsive-nav-link :href="route('members')" :active="request()->routeIs('members')">
                {{ __('Members') }}
            </x-responsive-nav-link> -->


            <!--<x-responsive-nav-link :href="route('map')" :active="request()->routeIs('map')">
                {{ __('Map') }}
            </x-responsive-nav-link>-->


            <!--<x-responsive-nav-link :href="route('leaderboards')" :active="request()->routeIs('leaderboards')">
                {{ __('Leaderboards') }}
            </x-responsive-nav-link> -->


            <x-responsive-nav-link
                :href="route('auth-about')"
                :active="request()->routeIs('auth-about')"
                class="text-[#071A4D]"
            >
                {{ __('About') }}
            </x-responsive-nav-link>

        </div>


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-[#E5EAF2]">

            <div class="px-4">

                <div class="flex items-center gap-3">

                    <span
                        class="
                            flex items-center justify-center
                            w-10 h-10
                            rounded-full
                            bg-[#071A4D]
                            text-white
                            text-sm
                            font-bold
                            shrink-0
                        "
                        aria-hidden="true"
                    >
                        {{ strtoupper(substr(Auth::user()?->name ?? 'U', 0, 1)) }}
                    </span>

                    <div class="min-w-0">

                        <div class="font-semibold text-base text-[#071A4D] truncate">
                            {{ Auth::user()?->name }}
                        </div>

                        <div class="font-medium text-sm text-[#5B6472] truncate">
                            {{ Auth::user()?->email }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="mt-4 px-3 space-y-1">

                <x-responsive-nav-link
                    :href="route('profile.edit')"
                    class="text-[#071A4D]"
                >
                    {{ __('Profile') }}
                </x-responsive-nav-link>


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="
                            event.preventDefault();
                            this.closest('form').submit();
                        "
                        class="text-[#B51218]"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>