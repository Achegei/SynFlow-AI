{{-- resources/views/calendar.blade.php --}}
@extends('layouts.app')

@section('title', $month . ' Calendar - SynFlow AI')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('calendar', ['month' => $date->copy()->subMonth()->format('Y-m')]) }}" class="text-indigo-600">&laquo; Prev</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $month }} Calendar
            </h2>
            <a href="{{ route('calendar', ['month' => $date->copy()->addMonth()->format('Y-m')]) }}" class="text-indigo-600">Next &raquo;</a>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-3">
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $dayDate = $date->copy()->day($day)->toDateString();
                    $dayEvents = $events[$dayDate] ?? collect();
                @endphp

                <!-- Day Card -->
                <div class="p-3 border rounded-lg shadow-sm {{ $dayEvents->count() ? 'bg-green-50' : 'bg-white' }}">
                    <strong class="text-gray-700">{{ $day }}</strong>

                    <!-- Events -->
                    @foreach ($dayEvents as $event)
                        <div 
                            class="mt-2 p-2 bg-blue-100 rounded text-sm cursor-pointer hover:bg-blue-200"
                            onclick='openEventModal(JSON.parse(String.raw`@json($event)`))'
                        >
                            <p class="font-semibold text-blue-800">{{ $event->title }}</p>
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</div>

<!-- Event Modal -->
<div id="eventModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg shadow-lg relative">

        <!-- Close Button -->
        <button onclick="closeEventModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">
            ✕
        </button>

        <!-- Event Image (static asset) -->
        <div class="mb-4">
            <img id="modalEventImage" src="{{ asset('images/uson.png') }}"
                 alt="Event Icon"
                 class="rounded-lg w-full h-48 object-cover">
        </div>

        <!-- Title -->
        <h3 id="modalEventTitle" class="text-xl font-semibold mb-1">Event Title</h3>

        <!-- Date & Time -->
        <p id="modalEventDateTime" class="text-gray-600 mb-2"></p>

        <!-- Meeting Link -->
        <p class="mb-3">
            <a id="modalEventLink" href="#" target="_blank" class="text-indigo-600 underline hidden">Join Google Meet</a>
            <span id="modalLiveTag" class="ml-2 px-2 py-0.5 text-xs bg-red-500 text-white rounded-full hidden">LIVE</span>
        </p>

        <!-- Description -->
        <p id="modalEventDescription" class="text-gray-700 mb-4"></p>

        <!-- Add to Calendar Buttons -->
        <div class="flex flex-wrap gap-3" id="calendarButtons"></div>
    </div>
</div>
@endsection


<script>
    function openEventModal(event) {
        // Title & Description
        document.getElementById('modalEventTitle').textContent = event.title;
        document.getElementById('modalEventDescription').textContent = event.description || '';

        // Date & Time
        let start = event.start_time ? new Date(event.event_date + 'T' + event.start_time) : null;
        let end   = event.end_time ? new Date(event.event_date + 'T' + event.end_time) : null;
        if (start && end) {
            document.getElementById('modalEventDateTime').textContent = 
                start.toLocaleDateString(undefined, { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) +
                " • " +
                start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) +
                " - " +
                end.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        } else {
            document.getElementById('modalEventDateTime').textContent = "Date/Time: TBD";
        }

        // Link
        if (event.link) {
            document.getElementById('modalEventLink').href = event.link;
            document.getElementById('modalEventLink').classList.remove('hidden');
        } else {
            document.getElementById('modalEventLink').classList.add('hidden');
        }

        // Live Tag
        if (event.is_live) {
            document.getElementById('modalLiveTag').classList.remove('hidden');
        } else {
            document.getElementById('modalLiveTag').classList.add('hidden');
        }

        // Calendar Links
        const calendarDiv = document.getElementById('calendarButtons');
        calendarDiv.innerHTML = ''; 

        const startISO = start ? start.toISOString().replace(/-|:|\.\d+/g, '') : '';
        const endISO   = end ? end.toISOString().replace(/-|:|\.\d+/g, '') : '';
        const title    = encodeURIComponent(event.title);
        const desc     = encodeURIComponent(event.description || '');
        const link     = encodeURIComponent(event.link || '');

        // Google
        calendarDiv.innerHTML += `<a href="https://www.google.com/calendar/render?action=TEMPLATE&text=${title}&dates=${startISO}/${endISO}&details=${desc}&location=${link}" 
            target="_blank" class="px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Google</a>`;

        // Outlook
        calendarDiv.innerHTML += `<a href="https://outlook.live.com/owa/?path=/calendar/action/compose&rru=addevent&subject=${title}&body=${desc}&startdt=${start?.toISOString()}&enddt=${end?.toISOString()}&location=${link}" 
            target="_blank" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Outlook</a>`;

        // Yahoo
        calendarDiv.innerHTML += `<a href="https://calendar.yahoo.com/?v=60&view=d&type=20&title=${title}&st=${startISO}&et=${endISO}&desc=${desc}&in_loc=${link}" 
            target="_blank" class="px-3 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 text-sm">Yahoo</a>`;

        // Apple (ICS)
        const icsContent = `BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
SUMMARY:${event.title}
DTSTART:${startISO}
DTEND:${endISO}
DESCRIPTION:${event.description || ''}
LOCATION:${event.link || ''}
END:VEVENT
END:VCALENDAR`;
        const icsData = encodeURIComponent(icsContent);
        calendarDiv.innerHTML += `<a href="data:text/calendar;charset=utf8,${icsData}" download="${event.title}.ics"
            class="px-3 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">Apple</a>`;

        // Show modal
        document.getElementById('eventModal').classList.remove('hidden');
    }

    function closeEventModal() {
        document.getElementById('eventModal').classList.add('hidden');
    }
</script>
