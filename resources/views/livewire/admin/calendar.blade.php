<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Schedules
    </div>
    <span class="italic">Click a date to add a schedule</span>
    <div class="p-4 mt-5">
        <div id='calendar'></div>
    </div>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            // {
            //     title: 'Event 1',
            //     start: '2023-10-01'
            // },
            // {
            //     title: 'Event 2',
            //     start: '2023-10-05',
            //     end: '2023-10-07'
            // }
        ],
        dateClick: function(info) {
            var day = info.date.getDay();
            if (day !== 0 && day !== 6) { // 0 is Sunday, 6 is Saturday
               //redirect to route
                window.location.href = '{{ route('admin.create-schedule') }}?date=' + info.dateStr;
            }else{
                alert('Saturdays & Sundays are unavailable');
            }
        }
    });
    calendar.render();
});

</script>

