document.addEventListener('DOMContentLoaded', () => {
    // --- Sidebar Toggle Logic ---
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    if (toggleSidebar && sidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            // Apply transition and transform for the toggle icon
            toggleSidebar.style.transition = 'all 0.3s ease';
            toggleSidebar.style.transform = sidebar.classList.contains('active') ? 'rotate(90deg)' : 'rotate(0deg)';
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (event) => {
            // Check if the screen width is mobile size (Bootstrap's md breakpoint is 768px)
            if (window.innerWidth <= 767.98 &&
                // Check if the click was outside the sidebar and outside the toggle button
                !sidebar.contains(event.target) &&
                !toggleSidebar.contains(event.target)) {
                sidebar.classList.remove('active');
                toggleSidebar.style.transform = 'rotate(0deg)'; // Reset toggle icon rotation
            }
        });

        // Smooth scroll effect for sidebar links
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                // Only prevent default and scroll if the link is an anchor to an ID
                if (link.getAttribute('href').startsWith('#')) {
                    e.preventDefault(); // Prevent default anchor jump
                    const targetId = link.getAttribute('href').substring(1); // Get the ID without '#'
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        // Scroll smoothly to the target element
                        targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            });
        });
    }

    // --- Card Hover Animation Logic ---
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            // These transitions are primarily handled by CSS, but keeping this
            // ensures the JS doesn't interfere if there were other JS-driven animations.
            // For pure CSS animations/transitions, these lines can be removed.
            card.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            const icon = card.querySelector('.fs-1');
            if (icon) icon.style.transition = 'all 0.3s ease';
        });
        card.addEventListener('mouseleave', () => {
            // Reset transforms on mouse leave, also largely handled by CSS.
            card.style.transform = 'translateY(0)';
            const icon = card.querySelector('.fs-1');
            if (icon) icon.style.transform = 'scale(1)';
        });
    });

    // --- Dynamic Welcome Message Date and Time Logic ---
    const dateElement = document.getElementById('current-date');
    const timeElement = document.getElementById('current-time'); // New element for time

    if (dateElement && timeElement) {
        function updateDateTime() {
            const now = new Date();

            // Update date
            const dateOptions = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const dateFormatter = new Intl.DateTimeFormat('id-ID', dateOptions);
            dateElement.textContent = dateFormatter.format(now);

            // Update time (HH:MM:SS AM/PM format)
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true }; // Changed to 12-hour format
            const timeFormatter = new Intl.DateTimeFormat('id-ID', timeOptions);
            timeElement.textContent = timeFormatter.format(now);
        }

        // Initial call to display date and time immediately
        updateDateTime();

        // Update date and time every second
        setInterval(updateDateTime, 1000);
    }


    // --- Simulated Weather Data Fetch and Update Logic ---
    // This is mock data. In a real application, you would fetch this from a weather API.
    const mockWeatherData = {
        jakarta: { temp: 32, condition: 'Patchy rain nearby', humidity: 63 },
        sumenep: { temp: 30, condition: 'Partly cloudy', humidity: 70 }
    };

    // Update weather data elements on the page
    document.getElementById('jakarta-temp').textContent = `${mockWeatherData.jakarta.temp}°C`;
    document.getElementById('jakarta-condition').textContent = mockWeatherData.jakarta.condition;
    document.getElementById('jakarta-humidity').textContent = `${mockWeatherData.jakarta.humidity}%`;
    document.getElementById('sumenep-temp').textContent = `${mockWeatherData.sumenep.temp}°C`;
    document.getElementById('sumenep-condition').textContent = mockWeatherData.sumenep.condition;
    document.getElementById('sumenep-humidity').textContent = `${mockWeatherData.sumenep.humidity}%`;

    // Note: For real-time weather, integrate with an API like OpenWeatherMap
    /*
    // Example of how to fetch real weather data (requires an API key)
    async function fetchWeather(city, elementPrefix) {
        try {
            const apiKey = 'YOUR_API_KEY'; // Replace with your actual API key
            const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city},ID&appid=${apiKey}&units=metric`);
            const data = await response.json();
            document.getElementById(`${elementPrefix}-temp`).textContent = `${Math.round(data.main.temp)}°C`;
            document.getElementById(`${elementPrefix}-condition`).textContent = data.weather[0].description;
            document.getElementById(`${elementPrefix}-humidity`).textContent = `${data.main.humidity}%`;
        } catch (error) {
            console.error(`Error fetching weather for ${city}:`, error);
        }
    }
    // Call the function for each city
    fetchWeather('Jakarta', 'jakarta');
    fetchWeather('Sumenep', 'sumenep');
    */

    // --- Live Calendar for National Holidays Logic ---
    const calendarContainer = document.getElementById('calendar-container');
    const calendarMonthYear = document.getElementById('calendar-month-year');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    const holidayLegend = document.querySelector('.holiday-legend');

    // Initialize current month and year to today's date
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    // Data for National Holidays in 2025 (Date, Month, Name)
    // Note: Month in JavaScript is 0-indexed (January=0, December=11)
    const nationalHolidays = [
        { date: 1, month: 0, name: 'Tahun Baru 2025' },
        { date: 27, month: 0, name: 'Tahun Baru Imlek' },
        { date: 27, month: 2, name: 'Idul Fitri' }, // 27-28 Maret
        { date: 28, month: 2, name: 'Idul Fitri' },
        { date: 31, month: 2, name: 'Hari Raya Nyepi' },
        { date: 18, month: 3, name: 'Wafat Isa Almasih' },
        { date: 1, month: 4, name: 'Hari Buruh Internasional' },
        { date: 29, month: 4, name: 'Kenaikan Isa Almasih' },
        { date: 1, month: 5, name: 'Hari Lahir Pancasila' },
        { date: 4, month: 5, name: 'Idul Adha' }, // 4-5 Juni
        { date: 5, month: 5, name: 'Idul Adha' },
        { date: 26, month: 6, name: 'Tahun Baru Islam' },
        { date: 17, month: 7, name: 'Hari Kemerdekaan Indonesia' },
        { date: 14, month: 8, name: 'Maulid Nabi Muhammad' },
        { date: 25, month: 11, name: 'Hari Natal' }
    ];

    /**
     * Generates and displays the calendar for a given month and year.
     * Marks today's date and national holidays.
     * @param {number} month - The month (0-11).
     * @param {number} year - The full year (e.g., 2025).
     */
    function generateCalendar(month, year) {
        calendarContainer.innerHTML = ''; // Clear existing calendar days
        holidayLegend.innerHTML = ''; // Clear existing holiday legend

        const today = new Date(); // Get today's date for marking
        const firstDayOfMonth = new Date(year, month, 1); // First day of the current month
        const lastDayOfMonth = new Date(year, month + 1, 0); // Last day of the current month
        const daysInMonth = lastDayOfMonth.getDate(); // Number of days in the current month

        // Array of month names for display
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                            "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // Array of day names for the calendar header
        const dayNames = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];

        // Update the calendar title with the current month and year
        calendarMonthYear.textContent = `${monthNames[month]} ${year}`;

        // Add day names header to the calendar grid
        dayNames.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.classList.add('calendar-day', 'calendar-header');
            dayHeader.textContent = day;
            calendarContainer.appendChild(dayHeader);
        });

        // Add empty cells for days before the first day of the month
        // getDay() returns 0 for Sunday, 1 for Monday, ..., 6 for Saturday
        const startDayIndex = firstDayOfMonth.getDay();
        for (let i = 0; i < startDayIndex; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('calendar-day', 'other-month'); // Style for days from previous/next month
            calendarContainer.appendChild(emptyDay);
        }

        // Add days of the month to the calendar grid
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.classList.add('calendar-day');
            dayElement.textContent = day;

            // Check if the current day is today's date
            if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                dayElement.classList.add('today');
            }

            // Check if the current day is a national holiday
            // We filter the nationalHolidays array to find if any holiday matches the current day and month
            const holidayForThisMonth = nationalHolidays.find(h => h.date === day && h.month === month);
            if (holidayForThisMonth) {
                dayElement.classList.add('holiday'); // Add 'holiday' class for styling
            }
            calendarContainer.appendChild(dayElement);
        }

        // Populate the holiday legend for the current month
        // Filter holidays that fall within the current month
        const currentMonthHolidays = nationalHolidays.filter(h => h.month === month);
        currentMonthHolidays.sort((a, b) => a.date - b.date); // Sort holidays by date for better readability

        if (currentMonthHolidays.length > 0) {
            // If there are holidays in the current month, add them to the legend
            currentMonthHolidays.forEach(holiday => {
                const li = document.createElement('li');
                li.innerHTML = `<i class="bi bi-calendar-check"></i> ${holiday.date} ${monthNames[holiday.month]}: ${holiday.name}`;
                holidayLegend.appendChild(li);
            });
        } else {
            // If no holidays, display a message
            const li = document.createElement('li');
            li.textContent = 'Tidak ada hari libur nasional di bulan ini.';
            holidayLegend.appendChild(li);
        }
    }

    // Initial call to generate the calendar for the current month and year
    generateCalendar(currentMonth, currentYear);

    // Event listeners for month navigation buttons
    prevMonthBtn.addEventListener('click', () => {
        currentMonth--; // Decrement month
        if (currentMonth < 0) { // If month goes below January, go to previous year's December
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear); // Re-generate calendar
    });

    nextMonthBtn.addEventListener('click', () => {
        currentMonth++; // Increment month
        if (currentMonth > 11) { // If month goes above December, go to next year's January
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear); // Re-generate calendar
    });
});
