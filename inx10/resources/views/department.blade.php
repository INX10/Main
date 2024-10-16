

<html lang="en" class="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <div class="flex w-full flex-row justify-end space-x-2 items-center fixed right-5 top-7 z-50">
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
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('attendance', this)">
                                <img src="{{URL('images/attendance.png')}}" alt="performance evaluation logo" data-light-src="{{URL('images/attendance.png')}}" data-dark-src="{{URL('images/attendance_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Your Attendance</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('employeemanagement', this)">
                                <img src="{{URL('images/employeeManagement.png')}}" alt="attendance logo" data-light-src="{{URL('images/employeeManagement.png')}}" data-dark-src="{{URL('images/employeeManagement_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Employee Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('performancemanagement', this)">
                                <img src="{{URL('images/performanceManagement.png')}}" alt="attendance logo" data-light-src="{{URL('images/performanceManagement.png')}}" data-dark-src="{{URL('images/performanceManagement_dark.png')}}" class="w-7 h-auto mr-2">
                                <span class="hidden lg:block dark:text-white">Performance Evaluation</span>
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

            <!--Overview-->
            <section  class="section active w-full p-3" id="dashboard-content">
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
                
                <!--wholesection-->
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
                                    <h1 class="text-sm font-medium dark:text-white">Pending Requests</h1>
                                    <p class="text-2xl font-bold font-sans dark:text-white">1</p>
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
                                <button class="w-12 h-12 p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200"  data-toggle-section="leave-form-content"  onclick="navigateTo('leave-form', this)">
                                    <img src="{{ URL('images/evaluate.png') }}" alt="request" class="w-7 h-7">
                                </button>
                                <button class="w-12 h-12 p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200 search-button">
                                    <img src="{{ URL('images/search.png') }}" alt="search" class="w-7 h-7">
                                </button>
                            </div>
                        </div>
                        
                        <!--first row left panel-->
                        <div class="flex flex-row gap-3.5">
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

            <!--calendar-->
            <section class="section active w-full p-3" id="calendar-content">
            
            </section>

            <!--attendance-->
            <section class="section active w-full p-3" id="attendance-content">
            
            </section>

            <!--employeeManagement-->
            <section class="section active w-full p-3" id="employeemanagement-content">
              
            </section>

            <!--performancemanagement-->
            <section class="section active w-full p-3" id="performancemanagement-content">
            
            </section>

            <!--leave and absence-->
            <section class="section active w-full p-3" id="leave-absence-content">
                  <div class="w-full h-[84vh] p-4 mt-20 bg-white dark:bg-gray-700 rounded-xl">
                    <div id="leaveRequestsContainer" class="w-full p-3 h-[calc(90vh-100px)]">

                        <h1 class ="text-xl font-bold text-normal text-black mb-4 dark:text-white">REQUEST OVERVIEW</h1>
                        <table id="leaveRequestsTable" class="w-full hidden">
                            <thead class="bg-gray-100 dark:bg-gray-500">
                                <tr>
                                    <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-white">ID</th>
                                    <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-white">EMPLOYEE NAME</th>
                                    <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-white">REQUEST</th>
                                    <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-white"></th>
                                </tr>
                            </thead>
                            <tbody id="leaveRequestsBody">
                                <!-- Data will be injected here -->
                            </tbody>
                        </table>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Fetch leave requests when the page loads
                            fetchLeaveRequests();
                        });

                        function fetchLeaveRequests() {
                            fetch("{{ route('department.leave.requests.ajax') }}")
                                .then(response => response.json())
                                .then(data => {
                                    // Check if data is available
                                    if (data.length > 0) {
                                        document.getElementById('leaveRequestsTable').classList.remove('hidden');
                                        renderLeaveRequests(data);
                                    } else {
                                        // Optionally show a message if no data is available
                                        document.getElementById('leaveRequestsContainer').innerHTML = "<p>No leave requests available.</p>";
                                    }
                                })
                                .catch(error => {
                                    console.error("Error fetching leave requests:", error);
                                });
                        }

                        function renderLeaveRequests(leaveRequests) {
                                const tbody = document.getElementById('leaveRequestsBody');
                                tbody.innerHTML = '';  // Clear any existing rows

                                leaveRequests.forEach(request => {
                                    const leaveType = request.leave_type_value || 'N/A';

                                    const row = document.createElement('tr');
                                    row.classList.add('border-b', 'hover:bg-gray-200');

                                    row.innerHTML = `
                                        <td class="text-center text-normal text-sm font-bold py-2 px-2 dark:text-white">${request.leave_ID || 'N/A'}</td>
                                        <td class="text-normal text-sm font-bold py-2 px-2 text-center dark:text-white">${request.first_name} ${request.last_name}</td>
                                        <td class="text-normal text-sm font-bold py-2 px-2 text-center dark:text-white">${leaveType}</td>
                                        <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">
                                            <a href="#" class="text-normal text-sm font-normal underline hover:text-red-500 transition duration-200" 
                                            data-leave-id="${request.leave_ID}" 
                                            data-employee-name="${request.first_name} ${request.last_name}" 
                                            data-date-requested="${request.date_applied}" 
                                            data-start-date="${request.leave_from}" 
                                            data-end-date="${request.leave_to}" 
                                            data-leave-type="${leaveType}" 
                                            data-reason="${request.reason}" 
                                            onclick="showModal(event)">View Details...</a>
                                        </td>
                                    `;

                                    tbody.appendChild(row);
                                });
                            }


                            function showModal(event) {
                            event.preventDefault();  // Prevent the default link action

                            const link = event.currentTarget;
                            const leaveID = link.getAttribute('data-leave-id');  // Retrieve the leave ID
                            const employeeName = link.getAttribute('data-employee-name');
                            const dateRequested = link.getAttribute('data-date-requested');
                            const startDate = link.getAttribute('data-start-date');
                            const endDate = link.getAttribute('data-end-date');
                            const leaveType = link.getAttribute('data-leave-type');
                            const reason = link.getAttribute('data-reason');

                            // Populate the modal with the data
                            document.querySelector('#displayRequests h1').textContent = `${leaveID}`;  // Display leave ID here
                            document.getElementById('employeeName').textContent = employeeName;
                            document.getElementById('requestedDate').innerText = dateRequested;
                            document.getElementById('startDate').innerText = startDate;
                            document.getElementById('endDate').innerText = endDate;
                            document.getElementById('leaveType').innerText = leaveType;
                            document.getElementById('leaveReason').innerText = reason;

                            // Show the modal
                            document.getElementById('displayRequests').classList.remove('hidden');
                        }

                        function closeModal() {
                            document.getElementById('displayRequests').classList.add('hidden');
                        }

                        
                    </script>
                </div>
            </section>

            <!--settings-->
            <section class="section active w-full p-3" id="settings-content">
            
            </section>

            <!--employee leave request modal display-->
            <section id="displayRequests" class="fixed flex items-center inset-0 bg-white bg-opacity-80 items-center justify-center hidden z-50">
                <div class="flex flex-col gap-3 bg-gray-200 dark:dark-gray-700 p-6 rounded-lg shadow-lg max-w-md w-full justify-center">
                    <div class="flex flex-col p-2 gap-3">
                        <!-- Display Leave ID and Employee Name -->
                        <div class="flex flex-row items-center gap-3">
                            <h1 class="text-xl font-normal text-black dark:text-white"></h1> <!-- Leave ID will be displayed here -->
                            <h1 id="employeeName" class="text-2xl font-bold text-black dark:text-white">Employee Name</h1>
                        </div>

                        <!-- Rest of the modal details -->
                        <div class="flex flex-row items-center gap-4">
                            <p class="text-md font-bold text-black dark:text-white">Date Requested: </p>
                            <span class="text-black text-md dark:text-white" id="requestedDate"></span>
                        </div>
                        <div class="flex flex-row items-center gap-4">
                            <p class="text-md font-bold text-black dark:text-white">Start Date: </p>
                            <span class="text-black text-md dark:text-white" id="startDate"></span>
                        </div>
                        <div class="flex flex-row items-center gap-4">
                            <p class="text-md font-bold text-black dark:text-white">End Date: </p>
                            <span class="text-black text-md dark:text-white" id="endDate"></span>
                        </div>
                        <div class="flex flex-row items-center gap-4">
                            <p class="text-md font-bold text-black dark:text-white">Leave Type: </p>
                            <span class="text-black text-md dark:text-white" id="leaveType"></span>
                        </div>
                            <p class="text-md font-bold text-black dark:text-white">Reason: </p>
                            <span class="text-black text-md dark:text-white" id="leaveReason"></span>
                        </div>

                        <!-- Modal Buttons -->
                        <div class="flex flex-row align-center items-center gap-3 justify-end">
                            <button id="approve-btn" class="w-[10vh] h-[5vh] rounded-lg bg-green-600 text-center font-semibold shadow-lg text-white hover:bg-green-500 hover:scale-105 transition duration-200">Approve</button>
                            <button id="reject-btn" class="w-[10vh] h-[5vh] rounded-lg bg-red-600 text-center font-semibold shadow-lg text-white hover:bg-red-500 hover:scale-105 transition duration-200">Reject</button>
                            <button id="close-btn" class="w-[10vh] h-[5vh] rounded-lg text-center font-semibold text-black hover:scale-105 transition duration-200" onclick="closeModal()">Close</button>
                        </div>
                    </div>
                </div>
            </section>

        <script>
         document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('approve-btn').addEventListener('click', function() {
                const leaveID = document.querySelector('#displayRequests h1').textContent; // Ensure it targets the correct h1


                // Send AJAX request to approve the leave
                fetch('/department/leave/approve', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ leave_ID: leaveID })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    closeModal(); // Optionally close the modal after approval
                })
                .catch(error => console.error('Error:', error));
            });

            document.getElementById('reject-btn').addEventListener('click', function() {
            const leaveID = document.querySelector('#displayRequests h1').textContent;

                // Send AJAX request to reject the leave
                fetch('/department/leave/reject', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ leave_ID: leaveID })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    closeModal(); // Optionally close the modal after rejection
                })
                .catch(error => console.error('Error:', error));
            });
            });

        </script>


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