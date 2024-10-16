<!DOCTYPE html>

<html lang="en" class="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to INX10!</title>
        <link rel="icon" href="{{ URL('images/logo_title.png') }}" type="image/png">

        @vite('resources/css/app.css')
        <style>
            .sidebar-item {
                transition: transform 0.2s ease-in-out, font-weight 0.2s ease-in-out;
            }
            .section {
                display: none;
            }

            .active {
                display: block;
            }
            .tooltip {
            max-width: 200px; 
            white-space: normal; 
            z-index: 10; 
            }
            .blur-content > *:not(#searchModal) {
                filter: blur(5px);
            }

            /* Add this to your CSS file or in a <style> tag in your HTML */
            .pre-wrap {
                white-space: pre-wrap; /* Preserve whitespace and line breaks */
                word-wrap: break-word; /* Allow long words to break */
            }
        </style>
    </head>

    <body class="bg-[#ededed] dark:bg-gray-900 flex">

            <!-- User Profile -->
            <div class="flex w-full flex-row justify-end space-x-2 items-center  fixed right-5 top-7">
                <button class="hover:scale-110 transition duration-200">
                    <img src="{{ URL('images/defaultprofpic.png') }}" alt="" class="w-9 h-9">
                </button>
                <h2 class="text-lg dark:text-white">
                     {{ Auth::user()->employeeInfo->first_name }} {{ Auth::user()->employeeInfo->last_name }}
                </h2> <!-- Display user name -->
                <div x-data="{ open: false }" class="relative">
                    <button @click.stop="open = !open" class="hover:scale-110 transition duration-200">
                        <img src="{{ URL('images/dropdownprofile.png') }}" 
                            data-light-src="{{ URL('images/dropdownprofile.png') }}" 
                            data-dark-src="{{ URL('images/dropdownprofile_dark.png') }}" 
                            alt="" 
                            class="w-9 h-9">
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" 
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                        <div class="py-2">
                            <button class="w-full text-left px-4 py-2 text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" onclick="navigateTo('settings', this)">
                                Settings
                            </button>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm" onsubmit="showLoadingSpinner()">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <script src="//unpkg.com/alpinejs" defer></script>

            </div>

           <!--side panel-->
            <aside class="w-1/4 h-screen bg-white dark:bg-gray-800 dark:opacity-80 shadow-lg  flex flex-col items-start p-4">
                <div class="mb-10 mt-5 flex justify-center">
                    <img src="{{ URL('images/inx10_final_logo.png') }}" alt="INX10 Logo" data-light-src="{{URL('images/inx10_final_logo.png')}}" data-dark-src="{{URL('images/inx10_final_logo_dark.png')}}" class="w-40 h-auto ml-14 hidden lg:block">
                    <img src="{{ URL('images/INX10_soloLogo.png') }}" alt="INX10 Solo Logo" class="w-10 h-auto mb-1 block lg:hidden">
                </div>

                <nav class="w-full h-auto">
                    <ul>
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300 " onclick="navigateTo('dashboard', this)">
                                <img src="{{URL('images/dashboard.png')}}" alt="dashboard logo"  data-light-src="{{URL('images/dashboard.png')}}" data-dark-src="{{URL('images/dashboard_dark.png')}}" class="w-8 h-auto mr-2">
                                <span class="hidden lg:block lg:text-lg dark:text-white">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('calendar', this)">
                                <img src="{{URL('images/calendar.png')}}" alt="calendar logo" data-light-src="{{URL('images/calendar.png')}}" data-dark-src="{{URL('images/calendar_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Calendar</span>
                            </a>
                        </li>
                        <li class="mt-6 text-gray-500 text-sm lg:text-xs font-semibold dark:text-white">Basics:</li>
                        
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('yourperformance', this)">
                                <img src="{{URL('images/performanceManagement.png')}}" alt="performance evaluation logo" data-light-src="{{URL('images/performanceManagement.png')}}" data-dark-src="{{URL('images/performanceManagement_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Your Performance</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('yourattendance', this)">
                                <img src="{{URL('images/attendance.png')}}" alt="attendance logo" data-light-src="{{URL('images/attendance.png')}}" data-dark-src="{{URL('images/attendance_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Your Attendance</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('leave-absence', this)">
                                <img src="{{URL('images/leaveAbsence.png')}}" alt="leave and absence logo" data-light-src="{{URL('images/leaveAbsence.png')}}" data-dark-src="{{URL('images/leaveAbsence_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Leave & Absence</span>
                            </a>
                        </li>
                        <li class="mt-6 text-gray-500 text-sm lg:text-xs dark:text-white font-semibold">EXTENSIONS:</li>
                    
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('settings', this)">
                                <img src="{{URL('images/settings.png')}}" alt="settings logo" data-light-src="{{URL('images/settings.png')}}" data-dark-src="{{URL('images/settings_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

        <!--Overview Contents-->
        <section class="section active w-full p-3" id="dashboard-content">
             <!--Darkmode and dashboard title-->
            <div class="flex flex-row items-center gap-4 w-full mb-6">

                    <h1 class="text-3xl font-bold sticky dark:text-white">Overview</h1>

                    <div class="flex items-center ">
                        <button id="darkModeToggle" class="focus:outline-none bg-gray-300 dark:bg-gray-600 p-2 rounded-full z-10 hover:scale-110 duration transition-200 shadow-lg">
                            <img id="sunIcon" src="{{ URL('images/sun.png') }}" alt="Sun Icon" class="h-6 w-6 dark:hidden">
                            <img id="moonIcon" src="{{ URL('images/moon.png') }}" alt="Moon Icon" class="h-6 w-6 hidden dark:block">
                        </button>
                    </div>
                        
                   <!-- Script for dark mode -->
                    <script>
                        // Function to initialize theme
                        function initializeTheme() {
                            const theme = localStorage.getItem('theme');

                            // Default to light mode if no theme is set
                            if (theme === 'dark') {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                                localStorage.setItem('theme', 'light'); // Set light as default in localStorage
                            }

                            updateImages();
                        }

                        // Function to toggle dark mode
                        function toggleDarkMode() {
                            document.documentElement.classList.toggle('dark');
                            if (document.documentElement.classList.contains('dark')) {
                                localStorage.setItem('theme', 'dark');
                            } else {
                                localStorage.setItem('theme', 'light');
                            }
                            updateImages();
                        }

                        // Function to update images based on the mode
                        function updateImages() {
                            document.querySelectorAll('img[data-light-src], img[data-dark-src]').forEach(img => {
                                if (document.documentElement.classList.contains('dark')) {
                                    img.src = img.getAttribute('data-dark-src');
                                } else {
                                    img.src = img.getAttribute('data-light-src');
                                }
                            });
                        }

                        // Event listener for the dark mode toggle button
                        document.getElementById('darkModeToggle').addEventListener('click', toggleDarkMode);

                        // Initialize the theme on page load
                        initializeTheme();

                        // Handle section toggles and reapply dark mode
                        document.querySelectorAll('[data-toggle-section]').forEach(button => {
                            button.addEventListener('click', function() {
                                const targetSectionId = this.getAttribute('data-toggle-section');
                                const targetSection = document.getElementById(targetSectionId);

                                if (targetSection) {
                                    // Hide all sections first
                                    document.querySelectorAll('.section').forEach(section => {
                                        section.classList.add('hidden');
                                    });

                                    // Show the target section
                                    targetSection.classList.remove('hidden');

                                    // Reapply the dark mode logic to the newly visible section
                                    initializeTheme();
                                }
                            });
                        });

                        
                        document.getElementById('logoutForm').addEventListener('submit', function() {
                            // Clear the theme from localStorage when logging out
                            localStorage.removeItem('theme');
                        });
                    </script>
            </div>
            
            <!--Whole section-->
            <div class="flex flex-row w-full h-auto gap-3.5">
                <!--left panel-->
                <div class="w-4/5 h-full mt-3">

                    <!--status, payday and buttons -->
                    <div class="w-full h-auto flex flex-row space-x-6">
                        @php
                        $today = now();
                        if ($today->day <= 5) {
                                $nextPayDate = $today->copy()->day(5);
                            } elseif ($today->day <= 20) {
                                $nextPayDate = $today->copy()->day(20);
                            } else {
                                // If today's date is after the 20th, the next payday will be the 5th of the next month
                                $nextPayDate = $today->copy()->addMonth()->day(5);
                            }
                            $isPayday = ($today->day === 5 || $today->day === 20);
                        @endphp
                        
                        <div class="flex w-full flex-row gap-5 justify-center mb-4">
                            <button class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl hover:scale-105 transition duration-200">
                                <h1 class="text-sm font-medium dark:text-white">Request Status</h1>
                                <p class="text-2xl font-bold font-sans dark:text-white">APPROVE</p>
                            </button>
                            <div class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl">
                            @if($isPayday)
                                <h1 class="text-2xl font-bold font-sans dark:text-white">It's pay day!!</h1>
                            @else
                                <h1 class="text-sm font-medium dark:text-white">Next pay date</h1>
                                <p class="text-2xl font-bold font-sans dark:text-white">{{ $nextPayDate->format('m/d/Y') }}</p>
                            @endif
                            </div>
                        </div>

                        <!--button requests and search-->
                        <div class="flex w-full justify-end items-center mb-3 space-x-6 ">
                            <button class="w-12 h-12 p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200"  data-toggle-section="leave-form-content"  onclick="navigateTo('leave-form', this)">
                                <img src="{{ URL('images/requests.png') }}" alt="request" class="w-7 h-7">
                            </button>
                            <button class="w-12 h-12 p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200 search-button">
                                <img src="{{ URL('images/search.png') }}" alt="search" class="w-7 h-7">
                            </button>
                        </div>
                    </div>

                    <!--announcement-->
                    <div class="flex flex-col w-full md:h-[40vh] bg-white dark:bg-gray-700 p-6 gap-3 justify-start shadow-lg rounded-2xl mb-3">

                        <div class="w-full flex items-start justify-start relative mb-3">
                            <h1 class="fixed text-xl font-bold font-sans mx-auto flex-1 text-center dark:text-white">
                                ANNOUNCEMENTS
                            </h1>
                            <button class="absolute right-0 hover:scale-125 transition-all duration-300" onclick="navigateTo('announcement', this)" data-toggle-section="announcement-content">
                                <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7" >
                            </button>
                        </div>

                        <!-- TABLE FOR ANNOUNCEMENTS -->
                        <div class="w-full max-h-64 overflow-visible mt-4">
                            <table class="w-full table-fixed text-left">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-600 text-white text-left">
                                        <th class="px-4 py-2 font-normal text-sm text-black opacity-60 w-1/2 dark:text-white">Title</th>
                                        <th class="px-4 py-2 font-normal text-sm text-black opacity-60 w-1/4 text-center dark:text-white">Date</th>
                                    </tr>
                                </thead>
                            <tbody id="announcement-list">
                                    <!-- Announcements will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                            <!--script for announcement overview-->
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                fetchAnnouncements();

                                function fetchAnnouncements() {
                                    fetch("{{ route('employee.dashboard') }}", {
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        const announcementList = document.getElementById('announcement-list');
                                        announcementList.innerHTML = ''; // Clear existing announcements

                                        if (data.announcements.length > 0) {
                                            data.announcements.forEach(announcement => {
                                                 const truncatedBody = announcement.announce_body.length > 100 
                                                    ? announcement.announce_body.substring(0, 100) + '...' 
                                                    : announcement.announce_body;
                                                const announcementRow = `
                                                     <tr class="border-b border-gray-200 hover:bg-gray-200 dark:border-white">
                                                            <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                                                <a href="#" onclick="showAnnouncement('${announcement.announce_subject}', '${announcement.announce_body}')">
                                                                    <span class="dark:text-white">${announcement.announce_subject}</span>
                                                                </a>
                                                                <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                                                    ${truncatedBody}
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                                                <span class="italic opacity-40 dark:text-white">${new Date(announcement.date).toLocaleDateString()}</span>
                                                            </td>
                                                        </tr>
                                                    `;
                                                announcementList.innerHTML += announcementRow;
                                            });
                                        } else {
                                            announcementList.innerHTML = `
                                                <tr>
                                                    <td colspan="2" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">No announcements available</td>
                                                </tr>
                                            `;
                                        }
                                    })
                                    .catch(error => console.error('Error fetching announcements:', error));
                                }
                            });
                        </script>
                    </div>
                </div>

                <!--right Panel-->
                <div class="w-2/5 flex flex-col mt-5">

                    <!--date & time-->
                    <div class="w-full flex flex-row justify-end items-end space-x-3 mb-5">
                        <div class="h-auto flex flex-col items-end">
                            <p class="text-medium font-medium dark:text-white" id="current-date">
                             
                            </p>
                            <p class="text-medium font-medium dark:text-white" id="current-time">
            
                            </p>
                        </div>

                        <script>
    
                            function formatTime(date) {
                                    return date.toLocaleTimeString('en-US', {
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit',
                                        hour12: true
                            });
                            } 
                            function formatDate(date) {
                                return date.toLocaleDateString('en-US', {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                            });
                            }
                            function updateDateTime() {
                                const now = new Date();
                                const dateElement = document.getElementById('current-date');
                                const timeElement = document.getElementById('current-time');

                                dateElement.textContent = formatDate(now);
                                timeElement.textContent = formatTime(now);
                            }
                            document.addEventListener('DOMContentLoaded', () => {
                            updateDateTime(); 
                            setInterval(updateDateTime, 1000); 
                            });
                        </script>

                        <button class="h-auto flex justify-end items-end transition hover:scale-110 duration-200">
                            <img src="{{URL('images/calendar_side.png')}}" alt="" class="w-14 h-14">
                        </button>
                    </div>

                </div>
            </div>
        </section>

        <!--Calender Contents-->
        <section class="section active w-full p-3" id ="calendar-content">
        </section>

        <!--your attendance-->
        <section class="section active w-full p-3" id ="yourattendance-content">
        </section>

        <!--your performance-->
        <section class="section active w-full p-3" id ="yourperformance-content">
        </section>

        <!--leave form section-->
        <section id = "leave-form-content" class="section hidden w-full h-screen p-7">
            
            <!--whole section-->
            <div class="w-full md:h-[40vh] p-4 flex flex-col gap-3">
                <!--goback-->
                <div class="w-full flex flex-row items-center p-3 gap-5">
                    <button class=" hover:scale-125 transition duration-200">
                        <img src="{{URL('images/goback.png')}}" alt="" data-light-src="{{URL('images/goback.png')}}" data-dark-src="{{URL('images/goback_dark.png')}}" class="w-10" onclick="navigateTo('leave-absence', this)">
                    </button>
                </div>
                <!--leave balance and leave form-->
                <div class="w-full flex flex-row gap-4 justify-start">
                    <!--leave form-->
                    <div class="w-full flex flex-row gap-4 items-start justify-start">
                        <div class="w-full h-[80vh] bg-white dark:bg-gray-700 rounded-xl shadow-2xl p-3 space-y-2">
                            <h1 class="text-lg font-bold text-black dark:text-white">LEAVE REQUESTS</h1>

                            <form action="{{ route('submitLeaveRequest') }}" method="POST" class="space-y-2 w-full">
                                @csrf
                                <!-- Leave Type Dropdown -->
                                <div class="mb-4">
                                    <label for="leave-type" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Leave Type</label>
                                    <select id="leave_type" name="leave_type" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" onchange="handleLeaveTypeChange()">
                                        <option value="" disabled selected>Select a leave type</option>  
                                        @foreach ($leaveTypes as $type)
                                            <option value="{{ $type->leave_type }}">{{ $type->value }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <script>
                                    function handleLeaveTypeChange() {
                                        const leaveTypeSelect = document.getElementById('leave_type');
                                        const otherLeaveTypeContainer = document.getElementById('other-leave-type-container');
                                        const submitButton = document.getElementById('submit-button');

                                        // If "Other" is selected, show the other leave type input field
                                        if (leaveTypeSelect.value === 'other') {
                                            otherLeaveTypeContainer.classList.remove('hidden');
                                        } else {
                                            // Hide the other leave type input field if it's not "Other"
                                            otherLeaveTypeContainer.classList.add('hidden');
                                        }

                                        // Enable the submit button if a leave type is selected
                                        submitButton.disabled = leaveTypeSelect.value === '';
                                    }
                                </script>

                                <!-- Other Leave Type Textbox (Initially Hidden) -->
                                <div id="other-leave-type-container" class="mb-4 hidden">
                                    <label for="other-leave-type" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Please Specify</label>
                                    <input type="text" id="other-leave-type" name="other-leave-type" maxlength="20" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-black dark:text-white">
                                </div>

                                <!-- Reason Textbox -->
                                <div class="mb-4">
                                    <label for="reason" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Reason</label>
                                    <textarea id="reason" name="reason" class="w-full p-2 border border-gray-300 dark:border-white rounded-md h-32 resize-none bg-white dark:bg-gray-800 text-black dark:text-white" placeholder="Enter the reason for your leave..."></textarea>
                                </div>

                                <!-- Start Date Calendar -->
                                <div class="mb-4">
                                    <label for="start-date" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Start Date</label>
                                    <input type="date" id="start-date" name="leave_from" class="w-full p-2 border border-gray-300 dark:border-white rounded-md bg-white dark:bg-gray-800 text-black dark:text-white" onchange="validateDates()">
                                    <p id="start-date-error" class="text-red-600 hidden">Start date cannot be in the past or after the end date.</p>
                                </div>

                                <!-- End Date Calendar -->
                                <div class="mb-6">
                                    <label for="end-date" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">End Date</label>
                                    <input type="date" id="end-date" name="leave_to" class="w-full p-2 border border-gray-300 dark:border-white rounded-md bg-white dark:bg-gray-800 text-black dark:text-white" onchange="validateDates()">
                                    <p id="end-date-error" class="text-red-600 hidden">End date cannot be before the start date.</p>
                                </div>

                                  <!-- Submit Button -->
                                <button type="submit" id="submit-button" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-200" disabled>
                                    Submit
                                </button>
                            </form>

                            <script>
                                function validateDates() {
                                    const startDateInput = document.getElementById('start-date');
                                    const endDateInput = document.getElementById('end-date');
                                    const startDateError = document.getElementById('start-date-error');
                                    const endDateError = document.getElementById('end-date-error');
                                    const submitButton = document.getElementById('submit-button');

                                    const today = new Date().setHours(0, 0, 0, 0); // Set to midnight for accurate comparison
                                    const startDate = new Date(startDateInput.value).setHours(0, 0, 0, 0);
                                    const endDate = new Date(endDateInput.value).setHours(0, 0, 0, 0);

                                    // Reset error messages and disable submit button initially
                                    startDateError.classList.add('hidden');
                                    endDateError.classList.add('hidden');
                                    submitButton.disabled = true;

                                    // Check if the start date is after today
                                    if (startDate < today) {
                                        startDateError.classList.remove('hidden');
                                        return;
                                    }

                                    // Check if end date is before start date
                                    if (endDate < startDate) {
                                        endDateError.classList.remove('hidden');
                                        return;
                                    }

                                    // Enable submit button if both dates are valid
                                    submitButton.disabled = false;
                                }
                            </script>
                        </div>

                        <!--leave balance-->
                        <div class="w-[20vh] h-[17vh] flex flex-col item-center p-3 justify-start bg-white dark:bg-gray-700 rounded-xl shadow-2xl">
                            <h1 class="text-xl font-bold text-black dark:text-white">BALANCES:</h1>

                            <span class="w-full flex flex-col items-center justify-center gap-2 p-2">
                                <span class="w-14 h-14 bg-blue-500 flex items-center justify-center rounded-full shadow-xl">
                                    <h1 class="text-lg font-bold text-white">{{ number_format($leaveBalance->balance, 2) }}</h1>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            
        </section>
        
        <!--announcement page section-->
        <section id ="announcement-content" class = "section hidden w-full h-screen p-7">
             <div class="w-full h-[85vh] h-[calc(100vh-100px)] overflow-y-auto p-5 mt-16 bg-white dark:bg-gray-700 rounded-xl">
                <h1 class="font-bold text-2xl text-black dark:text-white">ANNOUNCEMENTS</h1>
                
                <!-- Announcement List Table -->
                <table class="w-full table-fixed text-left mt-5">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-600 text-white text-left">
                            <th class="px-4 py-2 font-normal text-sm text-black opacity-60 w-1/2 dark:text-white">Title</th>
                            <th class="px-4 py-2 font-normal text-sm text-black opacity-60 w-1/4 text-center dark:text-white">Date</th>
                            <th class="px-4 py-2 font-normal text-sm text-black opacity-60 w-1/4 text-center dark:text-white"></th>
                        </tr>
                    </thead>
                    <tbody id="full-announcement-list">
                        <!-- Announcements will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>

            <!--script for full announcement page-->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                        fetchFullAnnouncements(); // Fetch announcements when the page loads
                    });

                    // Fetch announcements from the backend and display them
                    function fetchFullAnnouncements() {
                        fetch('{{ route('employee.getAllAnnouncements') }}') // Use the route for employee announcements
                            .then(response => response.json())
                            .then(data => {
                                const announcements = data.announcements;
                                const announcementList = document.getElementById('full-announcement-list');
                                announcementList.innerHTML = ''; // Clear existing content

                                if (announcements.length > 0) {
                                    announcements.forEach(announcement => {
                                        const employee = announcement.employee;
                                        const employeeName = employee ? `${employee.first_name} ${employee.last_name}`.trim() : 'Unknown'; // Combine names
                                        const employeeDept = 'HR/Admin Department';
                                        const row = `
                                            <tr class="border-b border-gray-200 hover:bg-gray-200 dark:border-white opacity-70">
                                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white opacity-100">
                                                    ${announcement.announce_subject}
                                                    <span class="block text-xs italic text-gray-500 dark:text-white opacity-60 font-light">
                                                        By: ${employeeName} - ${employeeDept}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-700 text-center dark:text-white">
                                                    ${new Date(announcement.date).toLocaleDateString()}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-700 text-center">
                                                    <button class="text-blue-500 hover:underline dark:text-red-400" onclick="expandAnnouncement(${announcement.announce_ID})">View Details</button>
                                                </td>
                                            </tr>

                                            <!-- Hidden row for expanded details -->
                                            <tr id="announcement-details-${announcement.announce_ID}" class="hidden">
                                                <td colspan="3" class="px-4 py-2">
                                                    <div class="announcement-scroll" style="max-height: 200px; overflow-y: auto; padding: 8px; border-radius: 8px;">
                                                        <p class="text-sm text-gray-700 dark:text-white pre-wrap">${announcement.announce_body}</p>
                                                    </div>
                                                    <button class="mt-2 text-red-500 hover:underline" onclick="collapseAnnouncement(${announcement.announce_ID})">Close</button>
                                                </td>
                                            </tr>
                                        `;
                                        announcementList.insertAdjacentHTML('beforeend', row);
                                    });
                                } else {
                                    announcementList.innerHTML = `<tr><td colspan="3" class="text-center py-4 text-gray-500">No announcements available</td></tr>`;
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching announcements:', error);
                                document.getElementById('full-announcement-list').innerHTML = `<tr><td colspan="3" class="text-center py-4 text-red-500">Error loading announcements</td></tr>`;
                            });
                    }

                    // Expand announcement details
                    function expandAnnouncement(announceId) {
                        const allDetails = document.querySelectorAll('[id^="announcement-details-"]');
                        allDetails.forEach(detail => {
                            if (!detail.classList.contains('hidden')) {
                                detail.classList.add('hidden');
                            }
                        });
                        const detailsRow = document.getElementById(`announcement-details-${announceId}`);
                        detailsRow.classList.remove('hidden'); // Show the details
                    }

                    // Collapse announcement details
                    function collapseAnnouncement(announceId) {
                        const detailsRow = document.getElementById(`announcement-details-${announceId}`);
                        detailsRow.classList.add('hidden'); // Hide the details
                    }

            </script>   
        </section>
        
        <!--scripts for sections-->
        <script>
            // Prevent the default form submission (remove this line if it causes issues)
            // event.preventDefault();

            // Store the last section visited
            let lastSection = 'dashboard'; // Default to dashboard on initial load

            // Function to handle navigation clicks
            function navigateTo(sectionId, element) {
                // Hide all sections
                const sections = document.querySelectorAll('.section');
                sections.forEach(section => {
                    section.classList.remove('active');
                });

                // Show the clicked section
                const activeSection = document.getElementById(sectionId + '-content');
                if (activeSection) {
                    activeSection.classList.add('active');
                }

                // Save the current section as the last section before moving
                if (sectionId !== 'add-employee') {
                    lastSection = sectionId;
                }

                // Update the document title based on the clicked element
                document.title = element.textContent.trim() + ' - INX10';

                // Optional: Update the active class on navigation
                const navItems = document.querySelectorAll('.sidebar-item');
                navItems.forEach(item => {
                    item.classList.remove('font-bold');
                });
                if (element) {
                    element.classList.add('font-bold');
                }
            }

            // Function to handle the "Go Back" button in the Add Employee section
            function goBack() {
                // Navigate to the last section stored
                navigateTo(lastSection, document.querySelector(`[data-toggle-section="${lastSection}"]`));
            }

            // Initial load: Activate the default section (Dashboard) or check session
            document.addEventListener('DOMContentLoaded', () => {
                @if(session('section') === 'add-employee')
                    navigateTo('add-employee', document.querySelector(`[data-toggle-section="add-employee"]`));
                @else
                    navigateTo('dashboard', document.querySelector('.sidebar-item'));
                @endif
            });

            // Event listener for submit button
            const form = document.querySelector('form'); // Make sure to select your form correctly
            form.addEventListener('submit', function(event) {
                lastSection = 'add-employee'; // Update last section before form submission
                // You can remove event.preventDefault() if it's causing issues
            });
        </script>

    </body>
</html>