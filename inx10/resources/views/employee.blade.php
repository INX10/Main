<!DOCTYPE html>

<html lang="en" class="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to INX10!</title>
        <link rel="icon" href="{{ URL('images/logo_title.png') }}" type="image/png">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">



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

            .progress-circle-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
                height:30vh;
                widht:30vh
            }
            .chart-center-text {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 1.5rem;
                font-weight: bold;
                color: black;
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
                    
                    <div class="w-full h-[75vh]  p-4 rounded-xl shadow-lg bg-white dark:bg-gray-700">
                        <div class="w-full flex items-center relative mb-3 left-0">
                            <h1 class="text-2xl font-bold font-sans mx-auto flex-1 text-center dark:text-white">
                                This Year's Performance
                            </h1>
                            <button class="absolute right-0 hover:scale-125 transition-all duration-300" onclick="navigateTo('yourperformance', this)" data-toggle-section="yourperformance-content">
                                <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7" >
                            </button>
                        </div>

                        <div class="flex flex-col w-full h-[65vh] p-6 bg-gray-200 dark:bg-gray-600 rounded-xl shadow-lg justify-center items-center gap-3">
                            <div class="relative">
                                <canvas id="ratingChart" width="300" height="300"></canvas>
                                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                    <span id="performanceRatingText" class="text-lg font-semibold text-black dark:text-white"></span>
                                </div>
                            </div>
                            <div class="flex flex-row w-full h-auto p-6 gap-[20vh] ">
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Evaluated By:</h2>
                                        <h2 id="evaluatedby" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Evaluation type:</h2>
                                        <h2 id="evaluationtype" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Start Date:</h2>
                                        <h2 id="startdate" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">End Date:</h2>
                                        <h2 id="enddate" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Remark Offense:</h2>
                                        <h2 id="offense" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Remark Accomplishments:</h2>
                                        <h2 id="accomplishments" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Remark for Improvement:</h2>
                                        <h2 id="improvement" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Rater Comment/s:</h2>
                                        <h2 id="ratercomm" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Ratee Comment/s:</h2>
                                        <h2 id="rateecomm" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                    <div class="flex flex-row gap-2">
                                        <h2 class="text-lg font-bold text-black dark:text-white">Recommended action:</h2>
                                        <h2 id="action" class="text-lg font-normal text-black dark:text-white"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                        fetch('/performance-evaluation')
                                            .then(response => response.json())
                                            .then(data => {
                                                console.log('Data:', data); // Log the data

                                                if (data.error) {
                                                    console.error(data.error);
                                                    return;
                                                }

                                                // Populate the fields with the fetched data
                                                document.getElementById('evaluatedby').innerText = data.evaluated_by;
                                                document.getElementById('evaluationtype').innerText = data.evaluation_type;
                                                document.getElementById('startdate').innerText = data.evaluation_start;
                                                document.getElementById('enddate').innerText = data.evaluation_end;
                                                document.getElementById('offense').innerText = data.remark_offense;
                                                document.getElementById('accomplishments').innerText = data.remark_accomplish;
                                                document.getElementById('improvement').innerText = data.remark_forimprove;
                                                document.getElementById('ratercomm').innerText = data.comment_rater;
                                                document.getElementById('rateecomm').innerText = data.comment_ratee;
                                                document.getElementById('action').innerText = data.recommended_action;

                                                // Get the performance rating and render the doughnut chart
                                                const performanceRating = parseFloat(data.performance_rating); // Rating between 0 and 5
                                                const ratingText = `${performanceRating} / 5`;

                                                // Update the text in the center of the chart
                                                document.getElementById('performanceRatingText').innerText = ratingText;

                                                // Create the doughnut chart using Chart.js
                                                const ctx = document.getElementById('ratingChart').getContext('2d');
                                                const ratingChart = new Chart(ctx, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ['Rating'],
                                                        datasets: [{
                                                            data: [performanceRating, 5 - performanceRating], // Full doughnut, filled according to rating
                                                            backgroundColor: ['#007FFF', '#E0E0E0'],  // Green for the rating, gray for the remainder
                                                            borderColor: ['#007FFF', '#E0E0E0'],
                                                            borderWidth: 2
                                                        }]
                                                    },
                                                    options: {
                                                        cutout: '70%', // This defines the doughnut hole size
                                                    rotation: 360,
                                                                    circumference: 360,
                                                        plugins: {
                                                            tooltip: { enabled: false }, // Disable tooltip
                                                            legend: { display: false } // Hide legend
                                                        },
                                                        responsive: true,
                                                        maintainAspectRatio: false
                                                    }
                                                });
                                            })
                                            .catch(error => console.error('Error fetching performance evaluation:', error));
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

                      <!-- Birthday Overview Section -->
                        <div class="w-full md:h-[35vh] bg-white dark:bg-gray-700 p-4 rounded-xl shadow-xl flex flex-col justify-center items-center gap-1">
                            <h1 class="text-2xl font-bold font-sans mx-auto flex-1 text-center dark:text-white">
                                BIRTHDAYS
                            </h1>
                            <div id="birthday-list" class="w-full flex flex-col justify-center items-center text-center dark:text-white h-full">
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                    fetchBirthdayOverview();
                                });

                                function fetchBirthdayOverview() {
                                    fetch('/employee/birthday-overview')
                                        .then(response => response.json())
                                        .then(data => {
                                            const birthdayList = document.getElementById('birthday-list');
                                            birthdayList.innerHTML = ''; // Clear current content

                                            if (data.birthdayToday) {
                                                // Display today's birthday highlight
                                                const todayEmployee = document.createElement('div');
                                                todayEmployee.classList.add('p-4', 'rounded-md', 'text-xl', 'font-bold', 'flex','flex-col', 'justify-center', 'items-center', 'h-full', 'gap-4');

                                                // Add profile picture if available
                                                if (data.birthdayToday.picture) {
                                                    const profileImage = document.createElement('img');
                                                    profileImage.src = `data:image/jpeg;base64,${data.birthdayToday.picture}`; // Base64 string in src
                                                    profileImage.alt = `${data.birthdayToday.first_name}'s Picture`;
                                                    profileImage.classList.add('w-[20vh]', 'h-[20vh]', 'rounded-full', 'object-cover'); // Circular cropped image
                                                    todayEmployee.appendChild(profileImage);
                                                }

                                                // Add employee's name
                                                const nameText = document.createElement('span');
                                                nameText.innerHTML = `🎉${data.birthdayToday.first_name} ${data.birthdayToday.last_name} 🎉`;
                                                todayEmployee.appendChild(nameText);

                                                birthdayList.appendChild(todayEmployee);
                                            } else if (data.monthlyBirthdays.length > 0) {
                                                // Display list of upcoming birthdays for the rest of the month
                                                data.monthlyBirthdays.forEach(employee => {
                                                    const employeeDiv = document.createElement('div');
                                                    employeeDiv.classList.add('text-lg', 'p-1');
                                                    employeeDiv.innerText = `${employee.first_name} ${employee.last_name} - ${new Date(employee.birth_date).getDate()}`;
                                                    birthdayList.appendChild(employeeDiv);
                                                });
                                            } else {
                                                // Show message if no more birthdays this month
                                                const noBirthdayMessage = document.createElement('div');
                                                noBirthdayMessage.classList.add('text-gray-500', 'italic', 'text-lg', 'flex', 'justify-center', 'items-center', 'h-full');
                                                noBirthdayMessage.innerText = 'No birthdays the rest of the month';
                                                birthdayList.appendChild(noBirthdayMessage);
                                            }
                                        })
                                        .catch(error => console.error('Error fetching birthday data:', error));
                                }


                        </script>

                </div>
            </div>
        </section>

         <!--CALENDAR contents-->
        <section class="section w-full p-4" id="calendar-content">
            <h1 class="text-3xl font-bold mb-3 dark:text-white">Calendar</h1>
                <div>

                <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
                <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

                <style>
                    [x-cloak] {
                        display: none;
                    }
                </style>

                <div class="mt-10">
                <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                    <div class="container mx-auto px-4 py-2">
                        
                        <!-- <div class="font-bold text-gray-800 text-xl mb-4">
                            Schedule Tasks
                        </div> -->

                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden">

                            <div class="flex items-center justify-between py-2 px-6">
                                <div>
                                    <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800 dark:text-white"></span>
                                    <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal dark:text-white"></span>
                                </div>
                                <div class="border rounded-lg px-1" style="padding-top: 2px;">
                                    <button 
                                        type="button"
                                        class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-200 p-1 items-center" 
                                        :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                        :disabled="month == 0 ? true : false"
                                        @click="month--; getNoOfDays()">
                                        <svg class="h-6 w-6 text-gray-500 dark:text-white inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>  
                                    </button>
                                    <div class="border-r inline-flex h-6"></div>		
                                    <button 
                                        type="button"
                                        class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
                                        :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                        :disabled="month == 11 ? true : false"
                                        @click="month++; getNoOfDays()">
                                        <svg class="h-6 w-6 text-gray-500 dark:text-white inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>									  
                                    </button>
                                </div>
                            </div>	

                            <div class="-mx-1 -mb-1">
                                <div class="flex flex-wrap" style="margin-bottom: -40px;">
                                    <template x-for="(day, index) in DAYS" :key="index">	
                                        <div style="width: 14.26%" class="px-2 py-2">
                                            <div
                                                x-text="day" 
                                                class="text-gray-600 dark:text-white text-sm uppercase tracking-wide font-bold text-center"></div>
                                        </div>
                                    </template>
                                </div>

                                <div class="flex flex-wrap border-t border-l">
                                    <template x-for="blankday in blankdays">
                                        <div 
                                            style="width: 14.28%; height: 120px"
                                            class="text-center dark:text-white border-r border-b px-4 pt-2"	
                                        ></div>
                                    </template>	
                                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">	
                                        <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                                            <div
                                                @click="showEventModal(date)"
                                                x-text="date"
                                                class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                                :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 dark:text-white hover:bg-blue-200': isToday(date) == false }"	
                                            ></div>
                                            <div style="height: 80px;" class="overflow-y-auto mt-1">
                                                <!-- <div 
                                                    class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                                                    x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
                                                    x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div> -->

                                                <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">	
                                                    <div
                                                        class="px-2 py-1 rounded-lg mt-1 overflow-hidden border"
                                                        :class="{
                                                            'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
                                                            'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
                                                            'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
                                                            'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
                                                            'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'
                                                        }"
                                                    >
                                                        <p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
                        <div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
                            <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                                x-on:click="openEventModal = !openEventModal">
                                <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                                </svg>
                            </div>

                            <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
                                
                                <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Add Event Details</h2>
                            
                                <div class="mb-4">
                                    <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event title</label>
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_title">
                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event date</label>
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
                                </div>

                                <div class="inline-block w-64 mb-4">
                                    <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Select a theme</label>
                                    <div class="relative">
                                        <select @change="event_theme = $event.target.value;" x-model="event_theme" class="block appearance-none w-full bg-gray-200 border-2 border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-gray-700">
                                                <template x-for="(theme, index) in themes">
                                                    <option :value="theme.value" x-text="theme.label"></option>
                                                </template>
                                            
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 text-right">
                                    <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openEventModal = !openEventModal">
                                        Cancel
                                    </button>	
                                    <button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm" @click="addEvent()">
                                        Save Event
                                    </button>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--script for calendar-->
                <script>
                    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                    function app() {
                        return {
                            month: '',
                            year: '',
                            no_of_days: [],
                            blankdays: [],
                            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                            events: [
                                {
                                    event_date: new Date(2020, 3, 1),
                                    event_title: "April Fool's Day",
                                    event_theme: 'blue'
                                },

                                {
                                    event_date: new Date(2020, 3, 10),
                                    event_title: "Birthday",
                                    event_theme: 'red'
                                },

                                {
                                    event_date: new Date(2020, 3, 16),
                                    event_title: "Upcoming Event",
                                    event_theme: 'green'
                                }
                            ],
                            event_title: '',
                            event_date: '',
                            event_theme: 'blue',

                            themes: [
                                {
                                    value: "blue",
                                    label: "Blue Theme"
                                },
                                {
                                    value: "red",
                                    label: "Red Theme"
                                },
                                {
                                    value: "yellow",
                                    label: "Yellow Theme"
                                },
                                {
                                    value: "green",
                                    label: "Green Theme"
                                },
                                {
                                    value: "purple",
                                    label: "Purple Theme"
                                }
                            ],

                            openEventModal: false,

                            initDate() {
                                let today = new Date();
                                this.month = today.getMonth();
                                this.year = today.getFullYear();
                                this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                            },

                            isToday(date) {
                                const today = new Date();
                                const d = new Date(this.year, this.month, date);

                                return today.toDateString() === d.toDateString() ? true : false;
                            },

                            showEventModal(date) {
                                // open the modal
                                this.openEventModal = true;
                                this.event_date = new Date(this.year, this.month, date).toDateString();
                            },

                            addEvent() {
                                if (this.event_title == '') {
                                    return;
                                }

                                this.events.push({
                                    event_date: this.event_date,
                                    event_title: this.event_title,
                                    event_theme: this.event_theme
                                });

                                console.log(this.events);

                                // clear the form data
                                this.event_title = '';
                                this.event_date = '';
                                this.event_theme = 'blue';

                                //close the modal
                                this.openEventModal = false;
                            },

                            getNoOfDays() {
                                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                                // find where to start calendar day of week
                                let dayOfWeek = new Date(this.year, this.month).getDay();
                                let blankdaysArray = [];
                                for ( var i=1; i <= dayOfWeek; i++) {
                                    blankdaysArray.push(i);
                                }

                                let daysArray = [];
                                for ( var i=1; i <= daysInMonth; i++) {
                                    daysArray.push(i);
                                }
                                
                                this.blankdays = blankdaysArray;
                                this.no_of_days = daysArray;
                            }
                        }
                    }
                </script>

            </div>
        </section>

         <!--Leave Absences Contents-->
        <section class="section active w-full p-3" id ="leave-absence-content">
            <div class="w-full h-auto flex flex-col gap-3">
                <h1 class="text-3xl font-bold sticky dark:text-white">Leave & Absences</h1>

                <div class="w-full h-auto flex flex-row justify-start items-center mt-8">
                    <button class="flex flex-row items-center justify-center gap-2 bg-white dark:bg-gray-700 rounded-xl shadow-lg w-[25vh] h-[8vh] hover:scale-105 transition duration-300"  data-toggle-section="leave-form-content"  onclick="navigateTo('leave-form', this)">
                        <img src="{{ URL('images/requests.png') }}" alt="request" class="w-7 h-7">
                        <h2 class="text-md font-normal text-black dark:text-white">Request a Leave</h2>
                    </button>
                </div>

                <div class="flex flex-col w-full h-[75vh] bg-white dark:bg-gray-800 rounded-lg shadow-xl">
                    <div class="flex flex-col p-5 w-full h-[calc(85vh-100px)] overflow-y-auto">
                        <h1 class="text-xl font-bold text-black dark:text-white mb-3">Your Leave Requests</h1>

                        <table>
                            <thead class="w-full h-auto bg-gray-100 dark:bg-gray-500">
                                <th class="text-medium py-3 font-medium dark:text-gray-200">DATE APPLIED</th>
                                <th class="text-medium py-3 font-medium dark:text-gray-200">LEAVE TYPE</th>
                                <th class="text-medium py-3 font-medium dark:text-gray-200">START/END DATE</th>
                                <th class="text-medium py-3 font-medium dark:text-gray-200">Appraisal of Supervisor</th>
                                <th class="text-medium py-3 font-medium dark:text-gray-200">Appraisal of HR </th>
                            </thead>
                            <tbody id="leave-requests-tbody">
                            
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                       document.addEventListener('DOMContentLoaded', function () {
                        // Fetch leave requests when the page loads
                        fetch('/employee/leave-requests')
                            .then(response => response.json())
                            .then(data => {
                                if (data.error) {
                                    alert(data.error);
                                    return;
                                }

                                let leaveRequestsTbody = document.getElementById('leave-requests-tbody');
                                leaveRequestsTbody.innerHTML = ''; // Clear the table body

                                // Iterate over the leave requests and append them to the table
                                data.forEach(function (leaveRequest) {
                                    let row = document.createElement('tr');
                                    row.classList.add('border-b', 'border-gray-300', 'dark:border-gray-600', 'cursor-pointer','hover:bg-gray-200','transition','duration-200');
                                    row.innerHTML = `
                                        <td class="py-3 text-center dark:text-white">${leaveRequest.date_applied}</td>
                                        <td class="py-3 text-center "><span class="bg-blue-500 font-semibold text-sm px-3 py-1 text-white rounded-lg shadow-lg">${leaveRequest.leave_type == 0 ? leaveRequest.leave_type_other : (leaveRequest.leave_type ? leaveRequest.value : 'N/A')}</span></td>
                                        
                                        <td class="py-3 text-center dark:text-white">${leaveRequest.leave_from} / ${leaveRequest.leave_to}</td>
                                        <td class="py-3 text-center">
                                            <span class="${leaveRequest.manager_approval === 1 ? 'bg-green-600 text-sm font-bold px-2 py-1 text-white rounded-lg shadow-lg' : (leaveRequest.manager_approval === 0 ? 'bg-red-500 text-sm font-bold px-3 py-1 text-white rounded-lg shadow-lg' : 'bg-yellow-500 text-sm font-bold px-3 py-1 text-white rounded-lg shadow-lg')}">
                                                ${leaveRequest.manager_approval === 1 ? 'Approved' : (leaveRequest.manager_approval === 0 ? 'Rejected' : 'Pending')}
                                            </span>
                                        </td>
                                        <td class="py-3 text-center">
                                            <span class="${leaveRequest.hr_approval === 1 ? 'bg-green-600 text-sm font-bold px-2 py-1 text-white rounded-lg shadow-lg' : (leaveRequest.hr_approval === 0 ? 'bg-red-500 text-sm font-bold px-3 py-1 text-white rounded-lg shadow-lg' : 'bg-yellow-500 text-sm font-bold px-3 py-1 text-white rounded-lg shadow-lg')}">
                                                ${leaveRequest.hr_approval === 1 ? 'Approved' : (leaveRequest.hr_approval === 0 ? 'Rejected' : 'Pending')}
                                            </span>
                                        </td>
                                    `;

                                    // Add a click event listener to the row
                                    row.addEventListener('click', function() {
                                        // Fetch the leave reason based on leave ID
                                        fetch(`/employee/leave-reason/${leaveRequest.leave_ID}`) // Adjust this endpoint as necessary
                                            .then(response => response.json())
                                            .then(reasonData => {
                                                if (reasonData.error) {
                                                    alert(reasonData.error);
                                                    return;
                                                }

                                                // Update the modal content
                                                document.getElementById('leave-reason-text').innerText = reasonData.reason;

                                                // Show the modal
                                                document.getElementById('leave-reason-modal').classList.remove('hidden');
                                            })
                                            .catch(error => {
                                                console.error('Error fetching leave reason:', error);
                                            });
                                    });

                                    leaveRequestsTbody.appendChild(row);
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching leave requests:', error);
                            });

                        // Close modal functionality
                        document.getElementById('close-modal').addEventListener('click', function() {
                            document.getElementById('leave-reason-modal').classList.add('hidden');
                        });
                    });
                </script>
            </div>
        </section>
        
        <!-- Leave request reason modal -->
        <div id="leave-reason-modal" class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-80 shadow-2xl">
            <div class="flex flex-col justify-start items-center bg-white shadow-xl rounded-2xl dark:bg-gray-700 max-w-md w-full h-auto p-5">
                <h1 class="text-xl font-bold text-black dark:text-white mb-4">YOUR REASON:</h1>
                <p id="leave-reason-text" class="text-lg font-normal text-black dark:text-white mb-5"></p> 

                <button id="close-modal" class="bg-red-600 text-lg font-semibold text-white hover:scale-105 transition duration-200 rounded-lg shadow-xl w-[8vh] h-[4vh]">
                    Close
                </button>
            </div>
        </div>

        <!-- Your Attendance -->
        <section class="section active w-full p-3" id="yourattendance-content">
            <h1 class="text-3xl font-bold mb-3 dark:text-white">Your Attendance</h1>
            <!--whole section-->
            <div class="w-full h-auto p-4 flex flex-col gap-3">
                <!--first row-->
                <div class="w-full h-auto flex flex-row">

                </div>

                <!--second row-->
                <div class="w-full h-[76vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl p-3">
                    <div class="flex flex-col w-full h-auto p-3 gap-3">
                        <div class="flex flex-row w-full h-auto items-center">
                            <h1 class="text-lg font-bold dark:text-white">ATTENDANCE OVERVIEW</h1>
                        </div>

                <!--table for attendace over view-->        
                <table class="p-4">
                    <thead class="bg-gray-100 dark:bg-gray-500">
                        <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">DATE</th>
                        <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">TIME-IN</th>
                        <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">TIME-OUT</th>
                    </thead>
                        <tbody id="attendance-table-body">        
                        </tbody>
                </table>
            </section>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const tableBody = document.getElementById('attendance-table-body');

                // Fetch attendance records
                fetch('/employee/attendance')
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        // Clear existing rows
                        tableBody.innerHTML = '';

                        // Populate table rows
                        data.forEach(record => {
                            const row = document.createElement('tr');

                            // Create cells for each data point
                            const dateCell = document.createElement('td');
                            dateCell.className = 'py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white';
                            dateCell.textContent = record.date;

                            const timeInCell = document.createElement('td');
                            timeInCell.className = 'py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white';
                            timeInCell.textContent = record.time_in;

                            const timeOutCell = document.createElement('td');
                            timeOutCell.className = 'py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white';
                            timeOutCell.textContent = record.time_out;


                            // Append cells to the row
                            row.appendChild(dateCell);
                            row.appendChild(timeInCell);
                            row.appendChild(timeOutCell);

                            // Append row to the table body
                            tableBody.appendChild(row);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching attendance:', error);
                        alert('Failed to fetch attendance data. Please try again.');
                    });
            });
        </script>


        <!--your performance-->
        <section class="section active w-full p-3" id="yourperformance-content">
            <div class="mt-10 p-6 w-full flex flex-col gap-3">
                <h1 class="text-2xl font-bold text-black dark:text-white">Your Performance Evaluations</h1>
                <div class="w-full h-[calc(90vh-100px)] overflow-y-auto bg-white rounded-xl shadow-lg dark:bg-gray-800">
                    <table class="p-6 w-full h-auto">
                        <thead class="w-full h-auto bg-gray-100 dark:bg-gray-500">
                            <tr>
                                <th class="text-xl py-3 font-bold dark:text-gray-200">RATER</th>
                                <th class="text-xl py-3 font-bold dark:text-gray-200">RATING</th>
                                <th class="text-xl py-3 font-bold dark:text-gray-200">DATE</th>
                                <th class="text-lg py-3 font-bold dark:text-gray-200">RECOMMENDED ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="employeeBodyPerformanceAll">
                            <!-- Data will be injected here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Structure -->
            <div id="evaluationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Evaluation Details</h2>
                    <p><strong>Rater:</strong> <span id="modalRaterName"></span></p>
                    <p><strong>Rating:</strong> <span id="modalRating"></span></p>
                    <p><strong>Date Evaluated:</strong> <span id="modalDate"></span></p>
                    <p><strong>Recommended Action:</strong> <span id="modalRecommendedAction"></span></p>

                    <p><strong>Evaluation Type:</strong> <span id="modalEvaluationType"></span></p>
                    <p><strong>Evaluation Start:</strong> <span id="modalEvaluationStart"></span></p>
                    <p><strong>Evaluation End:</strong> <span id="modalEvaluationEnd"></span></p>

                    <p><strong>Remark (Offense):</strong> <span id="modalRemarkOffense"></span></p>
                    <p><strong>Remark (Accomplishment):</strong> <span id="modalRemarkAccomplish"></span></p>
                    <p><strong>Remark (For Improvement):</strong> <span id="modalRemarkForImprove"></span></p>

                    <p><strong>Rater Comments:</strong> <span id="modalCommentRater"></span></p>
                    <p><strong>Ratee Comments:</strong> <span id="modalCommentRatee"></span></p>

                    <button id="closeModalEVAL" class="mt-4 p-2 bg-red-500 text-white rounded">Close</button>
                </div>
            </div>

        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('/evaluationsDept')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Fetched data:', data); // Log fetched data
                        const tbody = document.getElementById('employeeBodyPerformanceAll');
                        tbody.innerHTML = '';
                        
                        if (data.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-2">No evaluations found.</td></tr>';
                            return;
                        }

                        data.forEach(evaluation => {
                            const row = document.createElement('tr');
                             row.classList.add("border-b", "border-gray-300","hover:bg-gray-300","cursor-pointer");
                            
                            row.innerHTML = `
                                <td class="text-center py-4 border-b border-gray-300 text-lg font-semibold">${evaluation.rater_name}</td>
                                <td class="text-center py-4 border-b border-gray-300 text-lg font-semibold"><span class="py-2 px-2 rounded-lg shadow-lg bg-green-500 text-white font-bold">${evaluation.rating}</span></td>
                                <td class="text-center py-4 border-b border-gray-300 text-lg font-semibold">${evaluation.date}</td>
                                <td class="text-center py-4 border-b border-gray-300 text-lg font-semibold"><span class=" py-2 px-2 rounded-lg shadow-lg bg-blue-600 text-white font-bold">${evaluation.recommended_action}</span></td>
                            `;

                             // Add click event to open modal with evaluation details
                            row.addEventListener('click', function () {
                                openModal(evaluation);
                            });

                            
                            tbody.appendChild(row);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching evaluations:', error);
                        const tbody = document.getElementById('employeeBodyPerformanceAll');
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-2 text-red-500">Error loading data</td></tr>';
                    });
            });
            // Function to open the modal and display the evaluation details
                function openModal(evaluation) {
                    // Populate modal with evaluation details
                    document.getElementById('modalRaterName').textContent = evaluation.rater_name;
                    document.getElementById('modalRating').textContent = evaluation.rating;
                    document.getElementById('modalDate').textContent = evaluation.date;
                    document.getElementById('modalRecommendedAction').textContent = evaluation.recommended_action;

                    // Additional fields
                    document.getElementById('modalEvaluationType').textContent = evaluation.evaluation_type;
                    document.getElementById('modalEvaluationStart').textContent = evaluation.evaluation_start;
                    document.getElementById('modalEvaluationEnd').textContent = evaluation.evaluation_end;
                    document.getElementById('modalRemarkOffense').textContent = evaluation.remark_offense || 'N/A';
                    document.getElementById('modalRemarkAccomplish').textContent = evaluation.remark_accomplish || 'N/A';
                    document.getElementById('modalRemarkForImprove').textContent = evaluation.remark_forimprove || 'N/A';
                    document.getElementById('modalCommentRater').textContent = evaluation.comment_rater || 'N/A';
                    document.getElementById('modalCommentRatee').textContent = evaluation.comment_ratee || 'N/A';

                    // Show the modal
                    document.getElementById('evaluationModal').classList.remove('hidden');
                    
                }
                // Close the modal when the "Close" button is clicked
                document.getElementById('closeModalEVAL').addEventListener('click', function () {
                    document.getElementById('evaluationModal').classList.add('hidden');
                });
        </script>


         <!--leave form section-->
        <section id = "leave-form-content" class="section hidden w-full h-screen p-7">
            
            <!--whole section-->
            <div class="w-full md:h-[40vh] p-4 flex flex-col gap-3">
                <!--goback-->
                <div class="w-full flex flex-row items-center p-3 gap-5">
                    <button class=" hover:scale-125 transition duration-200" >
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
                                    <label for="leave-type" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Leave Type <span class="text-red-400">*</span></label>
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
                                    <label for="other-leave-type" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Please Specify<span class="text-red-400">*</span></label>
                                    <input type="text" id="other-leave-type" name="other-leave-type" maxlength="20" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-black dark:text-white">
                                </div>

                                <script>
                                    document.getElementById('other-leave-type').addEventListener('input', function(e) {
                                        let value = e.target.value;
                                        // Format the input value to sentence case
                                        if (value.length > 0) {
                                            e.target.value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
                                        }
                                    });
                                </script>

                                <!-- Reason Textbox -->
                                <div class="mb-4">
                                    <label for="reason" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Reason <span class="text-red-400">*</span></label>
                                    <textarea id="reason" name="reason" maxlength="255" class="w-full p-2 border border-gray-300 dark:border-white rounded-md h-32 resize-none bg-white dark:bg-gray-800 text-black dark:text-white" placeholder="Enter the reason for your leave..." required></textarea>
                                </div>

                                <!-- Start Date Calendar -->
                                <div class="mb-4">
                                    <label for="start-date" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Start Date <span class="text-red-400">*</span></label>
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
                                    <h1 id="leaveBalanceCounter" class="text-lg font-bold text-white"></h1>
                                    
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