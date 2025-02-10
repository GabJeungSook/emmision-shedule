<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Schedules
    </div>
    <span class="italic">Select a date to create an application</span>
    <div class="mt-10">
        <ul role="list" class="space-y-3">
            @forelse ($schedules as $schedule)
            @php
            $slot_taken = $transactions
            ->where('application.schedule_id', $schedule->id)
            ->filter(function ($transaction) use ($schedule) {
                return $transaction->application->whereIn('hour', json_decode($schedule->hours));
            })->where('status', 'Approved')
            ->count();
            @endphp
            <li class="overflow-hidden bg-white px-4 py-4 shadow-lg sm:rounded-md sm:px-6 hover:bg-gray-300 rounded-md">
                <a href="{{ route('user.create-transaction', ['record' => $schedule->id]) }}">
                    <span class="font-semibold text-lg">{{ Carbon\Carbon::parse($schedule->date)->format('F d, Y') }}</span>
                    <p>
                        @foreach (json_decode($schedule->hours) as $hour)
                        @php
                        $hour_display = match($hour) {
                            1 => '8-9am',
                            2 => '9-10am',
                            3 => '10-11am',
                            4 => '11am-12pm',
                            5 => '12-1pm',
                            6 => '1-2pm',
                            7 => '2-3pm',
                            8 => '3-4pm',
                            9 => '4-5pm',
                            default => 'Invalid hour',
                        };

                        $hour_slot_taken = $transactions
                        ->where('application.schedule_id', $schedule->id)
                        ->where('application.hour', $hour)
                        ->where('status', 'Approved')
                        ->count();
                        @endphp
                        {{ $hour_display }} = {{ $schedule->slots - $hour_slot_taken }}  @if (!$loop->last) | @endif
                        @endforeach
                    </p>
                    <p>Total Slots Remaining: {{ ($schedule->slots * count(json_decode($schedule->hours))) - $slot_taken }}</p>
                </a>
            </li>
            @empty
                <li class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <span>No schedules available</span>
                </li>
            @endforelse
            <!-- More items... -->
          </ul>

    </div>
    {{-- <span class="italic">Click a date to create a transaction</span>
    <div class="p-4 mt-5">
        <div id='calendar'></div>
    </div> --}}
    @php
        $transactions = \App\Models\Transaction::get();

        $events = [];
        foreach ($schedules as $schedule) {
            $slot_taken = $transactions->where('schedule_id', $schedule->id)->whereIn('hour', json_decode($schedule->hours))->count();
            $events[] = [
                'title' => 'Create Transaction',
                'start' => $schedule->date,
                'end' => $schedule->date,
                'url' => route('user.create-transaction', ['record' => $schedule->id]),
                'available_slots' => ($schedule->slots * count(json_decode($schedule->hours))) - $slot_taken,
            ];
        }

        $available_slots = $schedules->sum('slots');
    @endphp
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: @json($events),
        eventContent: function(arg) {
            let eventDiv = document.createElement('div');
            eventDiv.style.backgroundColor = 'green';
            eventDiv.style.color = 'white';
            eventDiv.style.textAlign = 'center';
            eventDiv.style.padding = '5px';
            eventDiv.style.borderRadius = '5px';
            eventDiv.style.cursor = 'pointer';
            eventDiv.innerHTML = arg.event.title;

            // Create a span to show the slots
            let slotsSpan = document.createElement('span');
            slotsSpan.style.display = 'block';
            slotsSpan.style.marginTop = '35px';
            slotsSpan.innerHTML = 'Slots Available: ' + arg.event.extendedProps.available_slots;
            eventDiv.appendChild(slotsSpan);

            return { domNodes: [eventDiv] };
        },
        dateClick: function(info) {
            var day = info.date.getDay();
            var hasEvent = @json($events).some(event => event.start === info.dateStr);
            if (day !== 0 && day !== 6 && !hasEvent) { // 0 is Sunday, 6 is Saturday, and no event on the date
                //redirect to route
              //  window.location.href = '{{ route('admin.create-schedule') }}?date=' + info.dateStr;
            } else if (hasEvent) {
                // alert('This date already has a schedule.');
            } else {
                alert('Saturdays & Sundays are unavailable');
            }
        },
        eventClick: function(info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate
            var eventObj = info.event;
            if (eventObj.url) {
                window.location.href = eventObj.url;
            }
        }
    });
    calendar.render();
});

</script>


