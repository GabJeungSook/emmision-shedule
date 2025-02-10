<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Schedules
    </div>
    <span class="italic">Click a date to add a schedule</span>
    <div class="p-4 mt-5">
        <div  wire:ignore id='calendar'></div>
    </div>
    @php
        $events = [];
        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => 'View Schedule Details',
                'start' => $schedule->date,
                'end' => $schedule->date,
                'url' => route('admin.view-schedule', ['record' => $schedule->id]),
            ];
        }
    @endphp
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (document.readyState === 'complete') {
        initializeCalendar();
    } else {
        window.addEventListener('load', initializeCalendar);
    }

    function initializeCalendar() {
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
                return { domNodes: [eventDiv] };
            },
            dateClick: function(info) {
                var day = info.date.getDay();
                var hasEvent = @json($events).some(event => event.start === info.dateStr);
                var today = new Date();
                today.setHours(0, 0, 0, 0); // Set time to midnight to compare only dates
                var clickedDate = new Date(info.dateStr);

                if (clickedDate < today) {
                    alert('Cannot select a past date.');
                    return;
                }

                if (day !== 0 && day !== 6 && !hasEvent) { // 0 is Sunday, 6 is Saturday, and no event on the date
                    //redirect to route
                    window.location.href = '{{ route('admin.create-schedule') }}?date=' + info.dateStr;
                } else if (hasEvent) {
                    // alert('This date already has a schedule.');
                } else {
                    alert('Saturdays & Sundays are unavailable');
                }
            },
        });
        calendar.render();
    }
});
</script>

