<x-filament::page>
    <div class="space-y-4 p-6 bg-white rounded-xl shadow">
        <h1 class="text-2xl font-bold">{{ $record->title }}</h1>

        <p class="text-gray-600">
            {{ $record->event_date->format('l, F jS') }}
            @ {{ $record->start_time->format('g:ia') }} - {{ $record->end_time->format('g:ia') }}
            (Nairobi time)
        </p>

        @if ($record->link)
            <p class="mt-2">
                <a href="{{ $record->link }}" target="_blank" class="text-blue-600 underline">
                    {{ $record->link }}
                </a>
            </p>
        @endif

        <p class="mt-4">{{ $record->description }}</p>

        <div class="mt-6">
            <a href="https://www.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($record->title) }}&dates={{ $record->event_date->format('Ymd') }}T{{ $record->start_time->format('His') }}/{{ $record->event_date->format('Ymd') }}T{{ $record->end_time->format('His') }}&details={{ urlencode($record->description) }}&location={{ urlencode($record->link ?? '') }}"
               target="_blank"
               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Add to Calendar
            </a>
        </div>
    </div>
</x-filament::page>
