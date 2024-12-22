import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import axios from 'axios';
import moment from 'moment-jalaali';

document.addEventListener('DOMContentLoaded', function () {
    // Enable Persian (Jalali) support in moment
    moment.loadPersian({ usePersianDigits: true });

    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            editable: true,
            selectable: true,
            locale: 'fa', // Set locale for Persian text
            events: '/admin/api/calendar-events', // Fetch events dynamically

            // Handle drag-and-drop event updates
            eventDrop: function (info) {
                axios.post('/admin/api/calendar-events/update', {
                    id: info.event.id,
                    start: info.event.start.toISOString(),
                    end: info.event.end ? info.event.end.toISOString() : null,
                })
                    .then(response => {
                        alert('Event updated successfully.');
                    })
                    .catch(error => {
                        alert('Error updating event: ' + error.response.data.message);
                        info.revert(); // Revert to original position on error
                    });
            },

            // Customize event content to include Jalali dates and QR code links
            eventContent: function (info) {
                const { title, extendedProps } = info.event;

                const startJalali = moment(info.event.start).format('jYYYY/jMM/jDD');
                const endJalali = info.event.end
                    ? moment(info.event.end).format('jYYYY/jMM/jDD')
                    : null;

                // QR code link from the event's extended properties
                const qrCodeUrl = extendedProps.qr_code_url;

                return {
                    html: `
                        <div>
                            <strong>${title}</strong><br/>
                            ${startJalali}${endJalali ? ' - ' + endJalali : ''}
                            <br/>
                            <a href="${qrCodeUrl}" target="_blank">View QR Code</a>
                        </div>
                    `,
                };
            },

            // Log displayed date range in Jalali
            datesSet: function (info) {
                const startJalali = moment(info.start).format('jYYYY/jMM/jDD');
                const endJalali = moment(info.end).format('jYYYY/jMM/jDD');

                console.log(`Displayed Range: ${startJalali} - ${endJalali}`);
            },

            // Event click behavior: open QR code in a new tab
            eventClick: function (info) {
                const qrCodeUrl = info.event.extendedProps.qr_code_url;

                if (qrCodeUrl) {
                    window.open(qrCodeUrl, '_blank');
                } else {
                    alert('QR Code not available for this event.');
                }
            },
        });

        calendar.render();
    }
});
