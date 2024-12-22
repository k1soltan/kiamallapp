import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import faLocale from '@fullcalendar/core/locales/fa'; // Import Persian locale
import moment from 'moment-jalaali'; // Import moment-jalaali for Jalali support
import axios from 'axios';

// Enable Persian (Jalali) support in moment
moment.loadPersian({ usePersianDigits: true });

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            editable: true,
            selectable: true,
            locale: faLocale.code, // Set the locale to Persian
            events: {
                url: '/admin/api/calendar-events',
                failure: function () {
                    alert('Failed to load events. Please try again.');
                },
            },

            // Display events with Jalali dates
            eventContent: function (info) {
                const startJalali = moment(info.event.start).format('jYYYY/jMM/jDD');
                const endJalali = info.event.end
                    ? moment(info.event.end).format('jYYYY/jMM/jDD')
                    : null;

                return {
                    html: `
                        <div>
                            <strong>${info.event.title}</strong><br/>
                            ${startJalali}${endJalali ? ' - ' + endJalali : ''}
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

            // Handle event clicks
            eventClick: function (info) {
                const qrCodeUrl = info.event.extendedProps.qr_code_url;

                if (qrCodeUrl) {
                    window.open(qrCodeUrl, '_blank');
                } else {
                    alert(`Event: ${info.event.title}`);
                }
            },

            // Handle event drag-and-drop updates
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
                    alert('Error updating event: ' + error.response?.data?.message || error.message);
                    info.revert(); // Revert position on error
                });
            },
        });

        calendar.render();
    }
});
document.addEventListener("DOMContentLoaded", () => {
    // Common selectors
    const themeToggle = document.getElementById("theme-toggle");
    const darkIcon = document.getElementById("theme-toggle-dark-icon");
    const lightIcon = document.getElementById("theme-toggle-light-icon");

    const themeToggleDesktop = document.getElementById("theme-toggle-desktop");
    const themeToggleMobile = document.getElementById("theme-toggle-mobile");

    const themeIconDesktop = document.getElementById("theme-toggle-icon-desktop");
    const themeIconMobile = document.getElementById("theme-toggle-icon-mobile");

    // Utility function to update icons
    const updateIcons = (isDark) => {
        if (darkIcon && lightIcon) {
            if (isDark) {
                darkIcon.classList.add("hidden");
                lightIcon.classList.remove("hidden");
            } else {
                lightIcon.classList.add("hidden");
                darkIcon.classList.remove("hidden");
            }
        }

        if (themeIconDesktop) {
            themeIconDesktop.className = `fas ${isDark ? "fa-sun" : "fa-moon"} text-lg`;
        }

        if (themeIconMobile) {
            themeIconMobile.className = `fas ${isDark ? "fa-sun" : "fa-moon"} text-lg`;
        }
    };

    // Check the current theme
    const userTheme = localStorage.getItem("theme");
    const systemPrefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    const isDark = userTheme === "dark" || (!userTheme && systemPrefersDark);

    // Initialize theme
    if (isDark) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
    updateIcons(isDark);

    // Toggle theme function
    const toggleTheme = () => {
        const isDarkMode = document.documentElement.classList.toggle("dark");
        localStorage.setItem("theme", isDarkMode ? "dark" : "light");
        updateIcons(isDarkMode);
    };

    // Add event listeners if elements exist
    if (themeToggle) themeToggle.addEventListener("click", toggleTheme);
    if (themeToggleDesktop) themeToggleDesktop.addEventListener("click", toggleTheme);
    if (themeToggleMobile) themeToggleMobile.addEventListener("click", toggleTheme);
});



const searchInput = document.getElementById('searchInput');
const autocompleteResults = document.getElementById('autocompleteResults');

// Translation strings passed from Blade


searchInput.addEventListener('input', async function () {
    const query = this.value.trim();

    if (query.length > 0) {
        try {
            const response = await fetch(`/admin/users?search=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();

            autocompleteResults.innerHTML = '';
            autocompleteResults.classList.remove('hidden');

            if (data.results.length > 0) {
                data.results.forEach(user => {
                    const li = document.createElement('li');
                    li.classList.add('px-4', 'py-2', 'hover:bg-gray-100', 'dark:hover:bg-gray-700', 'cursor-pointer');
                    li.innerHTML = `<a href="/admin/users/${user.id}/edit/">${user.name} - ${user.email}</a>`;
                    autocompleteResults.appendChild(li);
                });

                const seeMore = document.createElement('li');
                seeMore.classList.add('px-4', 'py-2', 'hover:bg-gray-100', 'dark:hover:bg-gray-700', 'cursor-pointer');
                seeMore.innerHTML = `<a href="/admin/users?search=${query}">${seeMoreText}</a>`;
                autocompleteResults.appendChild(seeMore);
            } else {
                const noResults = document.createElement('li');
                noResults.classList.add('px-4', 'py-2', 'text-gray-500', 'dark:text-gray-400');
                noResults.innerText = noResultsText;
                autocompleteResults.appendChild(noResults);
            }
        } catch (error) {
            console.error('Error fetching autocomplete results:', error);
        }
    } else {
        autocompleteResults.classList.add('hidden');
    }
});




