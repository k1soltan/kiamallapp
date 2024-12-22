<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Include Vite assets -->


    <title>Calendar</title>
</head>
<body>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/api/calendar-events', // Route for fetching events
                editable: true, // Allow drag/drop
                selectable: true, // Allow selecting dates
                dateClick: function(info) {
                    alert('Selected date: ' + info.dateStr);
                },
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
