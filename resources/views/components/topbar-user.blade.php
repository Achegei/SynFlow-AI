@php
    $user = filament()->auth()->user();
@endphp

<div class="flex items-center gap-x-3">
    {{-- Avatar --}}
    <x-filament-panels::avatar.user size="md" :user="$user" />

    {{-- Welcome + Name --}}
    <div class="hidden sm:flex flex-col">
        <span class="text-sm font-medium text-gray-900 dark:text-white">
            Welcome, {{ filament()->getUserName($user) }}
        </span>
    </div>

    {{-- Logout --}}
    <form action="{{ filament()->getLogoutUrl() }}" method="post" class="my-auto">
        @csrf
        <x-filament::button
            color="gray"
            icon="heroicon-m-arrow-left-on-rectangle"
            tag="button"
            type="submit"
            class="!px-2"
        >
            Sign out
        </x-filament::button>
    </form>
</div>
