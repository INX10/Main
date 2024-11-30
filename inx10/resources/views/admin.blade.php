
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to INX10!</title>
    <link rel="icon" href="{{ URL('images/logo_title.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
        
    </style>

    
</head>


<body class="bg-[#ededed] dark:bg-gray-900 flex">
    
    <!-- User Profile -->
        <div class="flex w-full flex-row justify-end space-x-2 items-center mb-7 fixed right-5 top-7">
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
                <li class="mt-6 text-gray-500 text-sm lg:text-xs font-semibold dark:text-white">HRS:</li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('admin-management', this)">
                        <img src="{{URL('images/adminManagement.png')}}" alt="admin management logo" data-light-src="{{URL('images/adminManagement.png')}}" data-dark-src="{{URL('images/adminManagement_dark.png')}}" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block dark:text-white">Admin Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('employee-management', this)">
                        <img src="{{URL('images/employeeManagement.png')}}" alt="employee management logo" data-light-src="{{URL('images/employeeManagement.png')}}" data-dark-src="{{URL('images/employeeManagement_dark.png')}}" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block dark:text-white">Employee Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('performance-evaluation', this)">
                        <img src="{{URL('images/performanceManagement.png')}}" alt="performance evaluation logo" data-light-src="{{URL('images/performanceManagement.png')}}" data-dark-src="{{URL('images/performanceManagement_dark.png')}}" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block dark:text-white">Performance Evaluation</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('attendance', this)">
                        <img src="{{URL('images/attendance.png')}}" alt="attendance logo" data-light-src="{{URL('images/attendance.png')}}" data-dark-src="{{URL('images/attendance_dark.png')}}" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block dark:text-white">Attendance</span>
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

    <!--DASHBOARD contents-->
    <section class="section active w-full p-3" id="dashboard-content">
            
            <!--Darkmode and dashboard title-->
                <div class="flex flex-row items-center gap-4 w-full">

                        <h1 class="text-3xl font-bold sticky dark:text-white">Dashboard</h1>

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
            
        <!--whole section flex-->
                    <div class="flex flex-row w-full h-auto gap-3.5">
        <!--left panel content-->
                    <div class="w-4/5 h-full">
        <!--buttons (add,update,search)-->
                        <div class="flex w-full justify-end mb-3 space-x-6 ">
                            <button class="p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200"  data-toggle-section="add-employee-content" onclick="navigateTo('add-employee', this)">
                                <img src="{{ URL('images/add.png') }}" alt="add" class="w-7 h-7">
                            </button>
                            <button class="p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200" data-toggle-section="editDisplayEmployeRecords-content" onclick="navigateTo('editDisplayEmployeRecords', this)">
                                <img src="{{ URL('images/update.png') }}" alt="update" class="w-7 h-7">
                            </button>
                            <button class="p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200 search-button">
                                <img src="{{ URL('images/search.png') }}" alt="search" class="w-7 h-7">
                            </button>
                        </div>

        <!--number of emp, pending, next pay date-->
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

                        <div class="flex w-full flex-row gap-3 justify-center mb-4">
                            <div class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl">
                                <h1 class="text-sm font-medium dark:text-white">Number of Employees</h1>
                                <p id="employee-count" class="text-2xl font-bold font-sans dark:text-white">Loading...</p>
                            </div>
                            <div class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl">
                                <h1 class="text-sm font-medium dark:text-white">Pending Requests</h1>
                                <p id="pendingRequestsCounter" class="text-2xl font-bold font-sans dark:text-white">0</p>
                            </div>

                            <script>
                                // Gamitin ang fetch API upang mag-request ng data mula sa server
                                document.addEventListener('DOMContentLoaded', function() {
                                    fetch('/api/pending-leave-requests')
                                        .then(response => response.json())
                                        .then(data => {
                                            // I-update ang counter text sa pending requests
                                            document.getElementById('pendingRequestsCounter').innerText = data.pendingRequests;
                                        })
                                        .catch(error => console.error('Error fetching pending leave requests:', error));
                                });
                            </script>


                            <div class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl">
                            @if($isPayday)
                                <h1 class="text-2xl font-bold font-sans dark:text-white">It's pay day!!</h1>
                            @else
                                <h1 class="text-sm font-medium dark:text-white">Next pay date</h1>
                                <p class="text-2xl font-bold font-sans dark:text-white">{{ $nextPayDate->format('m/d/Y') }}</p>
                            @endif
                            </div>
                        </div>
                        <!--script for the number of employees-->
                        <script>
                            function fetchEmployeeCount() {
                                fetch('/employee-count')
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('Data:', data); // Check this in the browser console
                                        if (data.count !== undefined) {
                                            document.getElementById('employee-count').textContent = data.count;
                                        } else {
                                            document.getElementById('employee-count').textContent = '0';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching employee count:', error);
                                        document.getElementById('employee-count').textContent = '0';
                                    });
                            }

                            // Fetch the employee count when the page loads
                            document.addEventListener('DOMContentLoaded', fetchEmployeeCount);

                            // Optionally, refresh the count every minute
                            setInterval(fetchEmployeeCount, 60000); // 60000 ms = 1 minute
                        </script>
                    
        <!--departments-->
                        <div class="flex flex-col w-full md:h-[40vh] bg-white dark:bg-gray-700 p-6 gap-3 justify-start shadow-lg rounded-2xl mb-3">
                            <div class="w-full h-auto flex items-center justify-between ">
                                    <h1 class="text-lg font-bold font-sans dark:text-white">DEPARTMENTS:</h1>
                                    <button class="ml-auto hover:scale-125 transition-all duration-300"  onclick="navigateTo('department_page', this)" data-toggle-section="department_page-content">
                                        <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7">
                                    </button>
                            </div>
        <!--department_inside-->
                            <div class="flex flex-row w-full h-auto gap-4">

                                <button class="department-btn flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300" data-department-id="1">
                                    <img src="{{URL('images/admin.png')}}" alt="admin_department" class="w-[10vh]">
                                    <h1 class="text-lg font-bold dark:text-white">ADMIN</h1>
                                    <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                <h1 id="admin-count" class="text-4xl font-bold dark:text-white">Loading...</h1>
                                </button>

                                <button class="department-btn flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300" data-department-id="2">
                                    <img src="{{URL('images/msit.png')}}" alt="admin_department" class="w-[10vh]">
                                    <h1 class="text-lg font-bold dark:text-white">MS-IT</h1>
                                    <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                <h1 id="msit-count" class="text-4xl font-bold dark:text-white">Loading...</h1>
                                </button>
                        
                                <button class="department-btn flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300" data-department-id="11">
                                    <img src="{{URL('images/rollermill.png')}}" alt="admin_department" class="w-[10vh]">
                                    <h1 class="text-lg font-bold dark:text-white">ROLLER-MILL</h1>
                                    <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                    <h1 id="rollermill-count" class="text-4xl font-bold dark:text-white">Loading...</h1>
                                </button>
                        
                                <button class="department-btn flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300" data-department-id="8">
                                    <img src="{{URL('images/technical.png')}}" alt="admin_department" class="w-[10vh]">
                                    <h1 class="text-lg font-bold dark:text-white">TECHNICAL</h1>
                                    <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                <h1 id="technical-count" class="text-4xl font-bold dark:text-white">Loading...</h1>
                                </button>

                            </div>
                        </div>
                    <!--Script for counting employee in departments (dashboard overview only)-->
                        <script>
                            function fetchDepartmentEmployeeCounts() {
                                fetch('/department-employee-counts')
                                    .then(response => response.json())
                                    .then(data => {
                                        const counts = data.departmentEmployeeCounts;
                                        
                                        // Update the employee count for each department
                                        document.getElementById('admin-count').textContent = counts[1] || '0'; // Admin department ID = 1
                                        document.getElementById('msit-count').textContent = counts[2] || '0'; // MS-IT department ID = 2
                                        document.getElementById('rollermill-count').textContent = counts[11] || '0'; // Roller-Mill department ID = 11
                                        document.getElementById('technical-count').textContent = counts[7] || '0'; // Technical department ID = 7
                                    })
                                    .catch(error => {
                                        console.error('Error fetching department employee counts:', error);
                                        // Set default 0 if there's an error
                                        document.getElementById('admin-count').textContent = '0';
                                        document.getElementById('msit-count').textContent = '0';
                                        document.getElementById('rollermill-count').textContent = '0';
                                        document.getElementById('technical-count').textContent = '0';
                                    });
                            }

                            // Fetch department employee counts when the page loads
                            document.addEventListener('DOMContentLoaded', fetchDepartmentEmployeeCounts);

                            // Optionally, refresh the count every minute
                            setInterval(fetchDepartmentEmployeeCounts, 60000); // 60000 ms = 1 minute
                        </script>

        <!--performance eval & activity logs-->
                        <div class="flex flex-row w-full h-auto gap-3">
        <!--performance eval-->    
                            <div class="flex flex-col w-full md:h-[30vh] bg-white dark:bg-gray-700 p-4 gap-3 justify-start item-center shadow-lg rounded-2xl">
                                <div class="w-full h-auto flex items-center justify-between">
                                    <h1 class="text-lg font-bold font-sans sm:text-xs md:text-lg lg:text-lg text-sm dark:text-white">PERFORMANCE EVALUATION:</h1>
                                    <button class="ml-auto hover:scale-125 transition-all duration-300" onclick="navigateTo('viewAllEvaluation', this)" data-toggle-section="viewAllEvaluation-content">
                                        <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7">
                                    </button>
                                </div>
                                <!-- Performance list -->
                                <div id="evaluation-list" class="w-full h-[30vh] flex flex-col justify-start items-center gap-3">
                                    <!-- Rows will be populated dynamically by JavaScript -->
                                </div>
                            </div>

                                <script>
                                    // Function to fetch the latest evaluations and display them
                                    function loadLatestEvaluations() {
                                        fetch("{{ route('getLatestEvaluations') }}")
                                            .then(response => response.json())
                                            .then(data => {
                                                const evaluationList = document.getElementById("evaluation-list");
                                                evaluationList.innerHTML = ''; // Clear any previous content

                                                data.forEach(evaluation => {
                                                    const row = document.createElement("div");
                                                    row.className = "flex flex-row w-full md:h-[6vh] bg-[#ededed] dark:bg-gray-600 rounded-lg shadow-lg justify-centerp-2 items-center p-1 gap-2";

                                                    row.innerHTML = `
                                                        <img src="{{URL('images/identify.png')}}" alt="perf profile" class="w-[4vh] h-[4vh] rounded-full">
                                                        <div class="flex flex-col items-start flex-1">
                                                            <h1 class="text-sm font-medium dark:text-white">${evaluation.employee_first_name} ${evaluation.employee_last_name}</h1>
                                                            <p class="text-xs font-normal opacity-60 dark:text-white">Grade | ${evaluation.performance_rating}</p>
                                                        </div>
                                                        <div class="inline-block h-auto w-0.5 self-stretch opacity-50"></div>
                                                        <div class="flex flex-col justify-center items-center gap-1">
                                                            <h3 class="text-xs italic text-black dark:text-white">Recommended Action:</h3>
                                                            <p class="text-xs font-semibold dark:text-white text-black">${evaluation.recommended_action}</p>
                                                        </div>
                                                        <div class="flex flex-col ml-auto p-3 text-right">
                                                            <h1 class="text-sm font-normal opacity-60 dark:text-white">Evaluated by:</h1>
                                                            <p class="text-xs italic font-semibold opacity-60 dark:text-white">${evaluation.rater_first_name} ${evaluation.rater_last_name}</p>
                                                        </div>
                                                    `;

                                                    evaluationList.appendChild(row);
                                                });
                                            })
                                            .catch(error => console.error("Error fetching evaluations:", error));
                                    }

                                    // Load the latest evaluations when the page loads
                                    window.onload = loadLatestEvaluations;
                                </script>

        <!--activity logs-->  
                            <div class="flex flex-col w-full md:h-[30vh] bg-white dark:bg-gray-700 p-4 gap-3 justify-start shadow-lg rounded-2xl">
                                <div class="w-full h-auto flex items-center justify-between ">
                                    <h1 class="text-lg font-bold font-sans dark:text-white">ACTIVITY LOGS:</h1>
                                </div>
                                <div id="activityLogContainer" class="w-full h-auto flex flex-col justify-center gap-3">
                                    <!-- Activity log items will be appended here by JavaScript -->
                                </div>

                                <script src="{{ asset('js/activityLog.js') }}"></script>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        fetch('/admin/get-latest-activity')
                                            .then(response => response.json())
                                            .then(data => {
                                                const activityLogContainer = document.getElementById("activityLogContainer");
                                                activityLogContainer.innerHTML = '';  // Clear any existing logs

                                                data.forEach(activity => {
                                                    const button = document.createElement("button");
                                                    button.classList.add("flex", "flex-row", "w-full", "md:h-[6vh]", "bg-[#ededed]", "dark:bg-gray-600", "rounded-lg", "shadow-lg", "justify-start", "items-center", "p-1", "gap-4");

                                                    button.innerHTML = `
                                                        <img src="{{ URL('images/activityLog_user.png') }}" alt="log profiles" class="w-7 h-7 ml-3">
                                                        <div class="w-[20vh] flex flex-col items-start">
                                                            <p class="text-sm font-normal opacity-50 dark:text-white">${activity.first_name} ${activity.last_name}</p>
                                                            <h3 class="text-sm italic text-black dark:text-white">${activity.date}</h3>
                                                        </div>
                                                        <div class="border-b h-full bg-gray-400 w-0.5"></div>
                                                        <div class="flex flex-col justify-start items-start">
                                                            <h2 class="text-sm font-normal opacity-60 dark:text-white">Activity:</h2>
                                                            <h1 class="text-md font-bold opacity-70 dark:text-white">${activity.type}</h1>
                                                        </div>
                                                    `;

                                                    activityLogContainer.appendChild(button);
                                                });
                                            })
                                            .catch(error => console.error('Error fetching activity logs:', error));
                                    });


                                </script>

                            </div>


                        </div>

                    </div>


        <!--right panel content-->
                    <div class="w-2/5 flex flex-col mt-16">

        <!--date & time-->
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

        <!--announcements-->
                <div class="w-full md:h-[35vh] bg-white dark:bg-gray-700 p-4 rounded-xl shadow-xl flex justify-center flex-col mb-3">
                    <div class="w-full flex items-center justify-center relative mb-3">
                        <h1 class="text-2xl font-bold font-sans mx-auto flex-1 text-center dark:text-white">
                            ANNOUNCEMENTS
                        </h1>
                        <button class="absolute right-0 hover:scale-125 transition-all duration-300" onclick="navigateTo('announcement', this)" data-toggle-section="announcement-content">
                            <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7" >
                        </button>
                    </div>
                    <!-- TABLE FOR ANNOUNCEMENTS -->
                    <div class="w-full max-h-64 overflow-visible">
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

                    
                        <!-- Modal Structure -->
                    <div id="announcementModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-800 bg-opacity-50">
                        <div class="bg-white rounded-lg p-4 w-11/12 md:w-auto p-6">
                            <div class="flex flex-row items-center justify-start gap-2">
                                <h1 class="text-lg text-black font-bold">Subject: </h1> 
                                <h2 id="modalSubject" class="text-md"></h2>
                            </div>
                            <div class="flex flex-row items-center align-center justify-start gap-2">
                                <h1 class="text-lg text-black font-bold">Body: </h1> 
                                <h2 id="modalBody" class="text-md"></p>
                            </div>
                            <button id="closeModal" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Close</button>
                        </div>
                    </div>

                    
                        <!--Script for announcement view-->
                        <script>
                            function fetchAnnouncements() {
                                fetch('{{ route('admin.getAnnouncements') }}')
                                    .then(response => response.json())
                                    .then(data => {
                                        const announcements = data.announcements;
                                        const announcementList = document.getElementById('announcement-list');
                                        announcementList.innerHTML = ''; // Clear the existing content

                                        if (announcements.length > 0) {
                                            announcements.forEach(announcement => {
                                                const truncatedBody = truncateText(announcement.announce_body, 100); // Shorten the body to 100 characters
                                                const row = `
                                                    <tr class="border-b border-gray-200 hover:bg-gray-200 dark:border-white dark:hover:bg-gray-600">
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                                            <a href="#" onclick="showAnnouncement('${announcement.announce_subject}', '${announcement.announce_body}')"><span class="dark:text-white">${announcement.announce_subject}</span></a>
                                                            <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                                                ${truncatedBody}
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                                            <span class="italic opacity-40 dark:text-white">${new Date(announcement.date).toLocaleDateString()}</span>
                                                        </td>
                                                    </tr>
                                                `;
                                                announcementList.insertAdjacentHTML('beforeend', row);
                                            });
                                        } else {
                                            announcementList.innerHTML = `<tr><td colspan="2" class="text-center py-4 text-gray-500">No announcements available</td></tr>`;
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching announcements:', error);
                                        document.getElementById('announcement-list').innerHTML = `<tr><td colspan="2" class="text-center py-4 text-red-500">Error loading announcements</td></tr>`;
                                    });
                            }

                            function truncateText(text, maxLength) {
                                if (text.length <= maxLength) return text;
                                return text.substring(0, maxLength) + '...'; // Add ellipsis to indicate truncation
                            }

                            function showAnnouncement(subject, body) {
                                // Populate the modal with announcement details
                                document.getElementById('modalSubject').innerText = subject;
                                document.getElementById('modalBody').innerText = body;

                                // Show the modal
                                document.getElementById('announcementModal').classList.remove('hidden');
                            }

                            // Close the modal when the close button is clicked
                            document.getElementById('closeModal').addEventListener('click', function() {
                                document.getElementById('announcementModal').classList.add('hidden');
                            });

                            // Fetch announcements when the page loads
                            document.addEventListener('DOMContentLoaded', fetchAnnouncements);

                            // Optionally, you can refresh the announcements list periodically
                            setInterval(fetchAnnouncements, 60000); // Refresh every 1 minute
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
                                fetch('/admin/birthday-overview')
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

    <!--ADMIN Management Contents-->
    <section class="section w-full p-4" id="admin-management-content">
        <h1 class="text-3xl font-bold mb-4 dark:text-white">Admin Management</h1>
        <div clas="w-full p-5">
            <div class="w-full flex flex-col space-y-3 p-3">

                <!--first row-->
                <div class="w-1/2 h-[8vh] flex flex-row mb-2">

                    <!--buttons add access , update access and search-->
                    <div class="w-full flex flex-row gap-5">
                        <button class="w-full flex flex-row justify-center items-center h-auto bg-white dark:bg-gray-700 gap-2 rounded-2xl shadow-xl hover:scale-105 transition duration-200" onclick="navigateTo('add-access', this)">
                            <img src="{{URL('images/addaccess.png')}}" alt="addaccess Btn" class="w-8 h-8">    
                            <h2 class="text-medium font-normal dark:text-white">Add Access</h2>
                        </button>
                        <button class="w-full flex flex-row justify-center items-center gap-2 h-auto bg-white dark:bg-gray-700 rounded-2xl shadow-xl hover:scale-105 transition duration-200">
                            <img src="{{URL('images/updateaccess.png')}}" alt="addaccess Btn" class="w-8 h-8">    
                            <h2 class="text-medium font-normal dark:text-white">Update Access</h2>
                        </button>
                        <button class="flex justify-center items-center w-[23vh] h-auto bg-white dark:bg-gray-700 rounded-3xl shadow-xl hover:scale-105 transition duration-200 search-button">
                            <img src="{{URL('images/search.png')}}" alt="search Admin Management" class="w-8 h-8">
                        </button>
                        
                    </div>
                </div>

                <!--second row-->
                <div class="flex flex-col w-full h-[75vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl p-7 ">
                    <div class="p-4">
                        <table class="w-full h-[60vh]">
                            <thead class=" bg-gray-100 dark:bg-gray-500 ">
                                <th class="text-lg font-bold opacity-60 dark:text-white">NAME</th>
                                <th class="text-lg font-bold opacity-60 dark:text-white">DEPARTMENT</th>
                                <th class="text-lg font-bold opacity-60 dark:text-white">DATE CREATED</th>
                                <th class="text-lg font-bold opacity-60  dark:text-white">STATUS</th>
                            </thead>

                            <tbody id="overviewEmployeeStatus">
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        fetch("/admin/employee-overview")
                            .then(response => response.json())
                            .then(data => {
                                const tableBody = document.getElementById("overviewEmployeeStatus");
                                tableBody.innerHTML = ""; // Clear any existing rows

                                data.forEach(employee => {
                                    const row = document.createElement("tr");
                                    row.classList.add("border-b", "border-gray-300"); // Add border classes to the row

                                    // Employee Name
                                    const nameCell = document.createElement("td");
                                    nameCell.classList.add("px-2", "py-2",  "text-center","font-bold","dark:text-white");
                                    nameCell.textContent = `${employee.first_name} ${employee.middle_name} ${employee.last_name}`;
                                    row.appendChild(nameCell);

                                    // Department
                                    const deptCell = document.createElement("td");
                                    deptCell.classList.add("px-4", "py-2",  "text-center","font-bold","dark:text-white");
                                    deptCell.textContent = employee.department_name;
                                    row.appendChild(deptCell);

                                    // Start Date
                                    const dateCell = document.createElement("td");
                                    dateCell.classList.add("px-4", "py-2", "text-center","font-bold","dark:text-white");
                                    dateCell.textContent = employee.start_date;
                                    row.appendChild(dateCell);

                                    // Status
                                    const statusCell = document.createElement("td");
                                    statusCell.classList.add("px-4", "py-2", "text-center");

                                    // Create span for the status background
                                    const statusSpan = document.createElement("span");
                                    statusSpan.textContent = employee.status === 1 ? "Active" : "Inactive";
                                    statusSpan.classList.add(
                                        "px-4", "py-2", "rounded-xl", "text-white","font-bold",
                                        employee.status === 1 ? "bg-green-600" : "bg-red-500"
                                    );
                                    
                                    statusCell.appendChild(statusSpan);
                                    row.appendChild(statusCell);

                                    tableBody.appendChild(row);
                                });
                            })
                            .catch(error => console.error("Error fetching employee data:", error));
                    });
                </script>




            </div>
        </div>
    </section>

    <!--Add Access Contents-->
    <section class="section w-full" id="add-access-content">
        <div class="w-full h-full flex justify-center items-center overflow-hidden dark:bg-gray-900">
            <div id="formContainer" class="bg-white dark:bg-gray-700 rounded-2xl justify-center items-center shadow-xl w-[70vh] p-6 flex flex-col gap-3 transition-all duration-300">
                <h1 class="text-xl text-black font-bold text-center dark:text-white">CREATE AN ACCOUNT</h1>
                                 
                <form action="{{ route('access.store') }}" method="POST" class="flex flex-col p-4 gap-3 justify-center">
                    @csrf
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-row items-center gap-6">
                            <h2 class="text-lg font-bold text-black dark:text-white">Department:</h2>
                            <select id="departmentSelectAccess" class="w-[30vh] h-[5vh] p-2 bg-gray-100 dark:bg-gray-700 rounded-2xl shadow-xl" required>
                                <option value="select" disabled selected>Select Department</option>
                            </select>
                        </div>
                        <div class="flex flex-row items-center gap-3">
                            <h2 class="text-lg font-bold text-black dark:text-white">Employee Name:</h2>
                            <h2 id="empNameAccess" class="text-lg font-normal text-black dark:text-white"><span class="text-white bg-blue-500 rounded-2xl p-2"></span></h2>
                            <input type="hidden" id="selectedEmployeeID" name="selectedEmployeeID">

                        </div>

                        <div class="border-b w-full border-gray-300 w-full"></div>
                        
                        <span id="userTypeMessage" class="text-sm italic text-black dark:text-white" >Note: (Choose a user type first.)</span> 

                        <div class="flex flex-row items-center gap-6">
                            <h2 class="text-lg font-bold text-black dark:text-white">User Type:</h2>
                            <select id="userTypeAccess" name="userTypeAccess" class="w-[35vh] h-[5vh] p-2 bg-gray-100 dark:bg-gray-700 rounded-2xl shadow-xl" required>
                                <option value="selectUserType" disabled selected>Select User type</option>
                                <option value="1">Admin / HR</option>
                                <option value="2">Employee</option>
                                <option value="3">Department Head / Supervisor</option>
                            </select>
                        </div>
                        
                        <div class="flex flex-row items-center gap-3">
                            <h2 class="text-lg font-bold text-black dark:text-white">User ID:</h2>
                            <input type="text" id="userIdAccess" name="userIdAccess" class="w-[40vh] h-[5vh] p-2 bg-gray-100 dark:bg-gray-700 rounded-2xl shadow-xl" placeholder="Enter User ID..." required ></input>
                        </div>  

                        <div class="flex flex-row items-center gap-3">
                            <h2 class="text-lg font-bold text-black dark:text-white">User Password:</h2>
                            <input type="password" id="userPWAccess" name="userPWAccess" class="w-[40vh] h-[5vh] p-2 bg-gray-100 dark:bg-gray-700 rounded-2xl shadow-xl" placeholder="Enter new password..." required ></input>
                        </div>
                        <button id="submitButtonAccess" name="submitBtnAccess" class="w-[60vh] h-[5vh] text-center text-lg bg-blue-500 hover:bg-blue-700 text-white hover:font-bold rounded-xl shadow-xl transition duration-300">
                            Submit
                        </button>
                    </div>
                </form>

                <!-- Modal for displaying employees -->
                <div id="employeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
                    <div class="w-[40vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl p-6 mx-auto mt-20">
                        <h2 class="text-xl font-bold text-center dark:text-white">Employees in Selected Department</h2>
                        <div id="employeeList" class="mt-4"></div>
                        <button class="w-full bg-red-500 text-white hover:bg-red-700 rounded-lg py-2 mt-4" onclick="closeModal()">Close</button>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const departmentSelect = document.getElementById('departmentSelectAccess');

                        // Listen for change in department selection
                        departmentSelect.addEventListener('change', function() {
                            const departmentID = this.value;

                            // Check if a department is selected
                            if (departmentID !== "select") {
                                fetch(`/get-employees-by-department/${departmentID}`)
                                    .then(response => response.json())
                                    .then(employees => {
                                        // Display the modal with employee data
                                        const employeeList = document.getElementById('employeeList');
                                        employeeList.innerHTML = ''; // Clear previous data

                                        // Modify the loop where employees are listed
                                        employees.forEach(employee => {
                                            const div = document.createElement('div');
                                            div.classList.add('py-2', 'border-b', 'border-gray-200', 'text-center', 'cursor-pointer','hover:bg-gray-200');
                                            div.textContent = employee.name;

                                            // Add click event to set the employee name and employee ID
                                            div.addEventListener('click', function() {
                                                // Set the employee name
                                                document.getElementById('empNameAccess').innerHTML = `<span class="text-white bg-blue-500 rounded-2xl p-2">${employee.name}</span>`;

                                                // Optionally set employee ID in a hidden input or variable
                                                document.getElementById('selectedEmployeeID').value = employee.employee_ID;  // Add this line to set the employee ID

                                                // Close the modal
                                                document.getElementById('employeeModal').classList.add('hidden');
                                            });

                                            employeeList.appendChild(div);
                                        });


                                        // Show the modal
                                        document.getElementById('employeeModal').classList.remove('hidden');
                                    })
                                    .catch(error => console.error('Error fetching employees:', error));
                            }
                        });
                    });

                    document.addEventListener("DOMContentLoaded", function() {
                            const userTypeAccess = document.getElementById("userTypeAccess");
                            const userIdAccess = document.getElementById("userIdAccess");
                            const empNameAccess = document.getElementById("empNameAccess");

                            // Disable userIdAccess initially
                            userIdAccess.disabled = true;
                            userPWAccess.disabled = true;

                            // Listen for changes in userTypeAccess
                            userTypeAccess.addEventListener("change", function() {
                                const selectedType = userTypeAccess.value;
                                const employeeName = empNameAccess.textContent.trim();
                                const lastName = employeeName.split(" ").pop(); // Get last name

                                // Set prefix based on user type
                                let prefix = "";
                                if (selectedType === "1") {
                                    prefix = `01-${lastName}`;
                                } else if (selectedType === "2") {
                                    prefix = `02-${lastName}`;
                                } else if (selectedType === "3") {
                                    prefix = `03-${lastName}`;
                                }

                                // Enable userIdAccess and set value with prefix
                                userIdAccess.disabled = false;
                                userPWAccess.disabled = false;
                                userIdAccess.value = prefix + "-";
                                userIdAccess.focus(); // Optionally focus on the field

                                // Prevent users from removing the prefix
                                userIdAccess.addEventListener("input", function() {
                                    if (!userIdAccess.value.startsWith(prefix + "-")) {
                                        userIdAccess.value = prefix + "-";
                                    }
                                });
                            });
                        });
                    // Function to close the modal
                    function closeModal() {
                        document.getElementById('employeeModal').classList.add('hidden');
                    }
                </script>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch departments from the API
            fetch('/get-departments')
                .then(response => response.json())
                .then(departments => {
                    const departmentSelect = document.getElementById('departmentSelectAccess');

                    // Clear any previous options
                    departmentSelect.innerHTML = '<option value="select" disabled selected>Select Department</option>';

                    // Populate the dropdown with the department names
                    departments.forEach(department => {
                        const option = document.createElement('option');
                        option.value = department.department_ID;
                        option.textContent = department.department_name;
                        departmentSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching departments:', error);
                });
        });
    </script>

    <!--EMPLOYEE Management Contents-->
    <section class="section w-full p-4" id="employee-management-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Employee Management</h1>
        <div class="w-full p-3">
            <div class="w-full h-auto p-2 flex flex-col gap-6">

                <!--first row-->
                <div class="flex flex-row w-full">
                    <!--buttons / add, update, department,requests , announce -->
                    <div class="w-full h-auto flex flex-row justify-center gap-3">
                        <button class="w-full h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row justify-center items-center hover:translate-y-1.5 transition duration-200 space-x-3" data-toggle-section="add-employee-content" onclick="navigateTo('add-employee', this)">
                            <img src="{{URL('images/add.png')}}" alt="" class="w-7 w-7">
                            <h2 class="text-medium font-normal dark:text-white ">Add Employee</h2>
                        </button>
                        <button class="w-full h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row justify-center items-center hover:translate-y-1.5 transition duration-200 space-x-3"  onclick="navigateTo('editDisplayEmployeRecords', this)" data-toggle-section="editDisplayEmployeRecords-content">
                            <img src="{{URL('images/update.png')}}" alt="" class="w-7 w-7">
                            <h2 class="text-medium font-normal dark:text-white">Update Employee</h2>
                        </button>
                        <button class="w-full h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row justify-center items-center hover:translate-y-1.5 transition duration-200 space-x-3" onclick="navigateTo('department_page', this)" data-toggle-section="department_page-content">
                            <img src="{{URL('images/department.png')}}" alt="" class="w-7 w-7">
                            <h2 class="text-medium font-normal dark:text-white">Departments</h2>
                        </button>
                        <button id="announcementButton" class="w-full h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row justify-center items-center hover:translate-y-1.5 transition duration-200 space-x-3">
                            <img src="{{URL('images/announce.png')}}" alt="" class="w-7 w-7">
                            <h2 class="text-medium font-normal dark:text-white">Announce</h2>
                        </button>
 
                    </div>
                </div>
                
                <!--second row-->
                <div class="w-full h-[73vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-col justify-center items-center p-5">
                    <!--title, and search bar-->
                    <div class="w-full flex flex-row mb-4">
                        <h1 class="text-xl font-bold dark:text-white">EMPLOYEE PROFILES</h1>
                    </div>

                    <!--table for employee profiles-->
                    <div class="w-full">
                        <table class="w-full h-[60vh]">
                            <thead class="bg-gray-100 dark:bg-gray-500">
                                <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-gray-100">
                                    ID
                                </th>
                                <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-gray-100">
                                    NAME
                                </th>
                                <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-gray-100">
                                    DEPARTMENT
                                </th>
                                <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-gray-100">
                                    CONTACT
                                </th>
                                <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-gray-100">
                                    EMAIL
                                </th>
                                <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-gray-100">
                                    DATE HIRED
                                </th>
                            </thead>
                            <tbody id="employeeProfilesbody">
                                
                            </tbody>
                        </table>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            fetch('/admin/employee-management-overview')
                                .then(response => response.json())
                                .then(data => {
                                    const tableBody = document.getElementById('employeeProfilesbody');
                                    tableBody.innerHTML = ''; // Clear any existing content

                                    data.forEach(employee => {
                                        const row = document.createElement('tr');
                                        row.classList.add('border-b','border-gray-200','hover:bg-gray-200','dark:border-white', 'dark:hover:bg-gray-600');
                                        row.innerHTML = `
                                            <td class="px-4 py-2 text-center font-semibold text-black dark:text-white">${employee.employee_ID}</td>
                                            <td class="px-4 py-2 text-center font-semibold text-black dark:text-white">${employee.name}</td>
                                            <td class="px-4 py-2 text-center font-semibold text-black dark:text-white">${employee.department_name}</td>
                                            <td class="px-4 py-2 text-center font-semibold text-black dark:text-white">
                                                <span onclick="copyToClipboard('${employee.contact_no}', event)" class="dark:text-white cursor-pointer text-black text-decoration-none">
                                                    ${employee.contact_no}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 text-center font-semibold text-black dark:text-white">
                                                <span onclick="copyToClipboard('${employee.email}', event)" class="dark:text-white cursor-pointer text-black text-decoration-none">
                                                    ${employee.email}
                                                </span>
                                            </td>

                                            <td class="px-4 py-2 text-center font-semibold text-black dark:text-white">${employee.date_hired}</td>
                                        `;

                                        tableBody.appendChild(row);
                                    });
                                })
                                .catch(error => console.error('Error fetching employee data:', error));
                        });
                              function copyToClipboard(value, event) {
                                // Create a temporary input to hold the value for copying
                                const tempInput = document.createElement("input");
                                document.body.appendChild(tempInput);
                                tempInput.value = value;

                                // Select and copy the value
                                tempInput.select();
                                tempInput.setSelectionRange(0, 99999); // For mobile devices
                                document.execCommand("copy");

                                // Remove the temporary input
                                document.body.removeChild(tempInput);

                                // Create a tooltip at the cursor position
                                const tooltip = document.createElement("div");
                                tooltip.innerText = "Copied!";
                                tooltip.style.position = "fixed";
                                tooltip.style.background = "rgba(0, 0, 0, 0.7)";
                                tooltip.style.color = "#fff";
                                tooltip.style.padding = "4px 8px";
                                tooltip.style.borderRadius = "4px";
                                tooltip.style.fontSize = "12px";
                                tooltip.style.pointerEvents = "none";
                                tooltip.style.zIndex = "1000";
                                tooltip.style.top = `${event.clientY + 10}px`;
                                tooltip.style.left = `${event.clientX + 10}px`; // Offset to the bottom-right of the cursor

                                document.body.appendChild(tooltip);

                                // Fade out and remove the tooltip after 1 second
                                setTimeout(() => {
                                    tooltip.style.transition = "opacity 0.4s";
                                    tooltip.style.opacity = "0";
                                    setTimeout(() => tooltip.remove(), 400);
                                }, 800);
                            }

                        
                    </script>

                </div>
            </div>
        </div>
    </section>

    <!--Edit Employee Page contents display record-->
    <section id="editDisplayEmployeRecords-content" class="section w-full p-4">
        <div class="w-full flex flex-col gap-2 mt-14">

            <div class="flex flex-row gap-3 p-2 justify-start w-full h-auto items-center">
                <h1 class="text-lg font-bold text-black dark:text-white">Choose a department:</h1>
                <select id="chooseEditDepartment" class="bg-gray-200 w-[30vh] h-[4vh] p-2 rounded-lg border border-gray-500 shadow-md hover:bg-gray-100">
                    <option value="" disabled selected>Select a Department...</option>
                </select>
            </div>

            <!-- Employee List Modal -->
            <div id="employeeModalEditList" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-[60vh]">
                    <h2 class="text-xl font-bold mb-4">Employee List</h2>
                    <table class="w-full border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 border-b">Employee ID</th>
                                <th class="p-2 border-b">First Name</th>
                                <th class="p-2 border-b">Last Name</th>
                            </tr>
                        </thead>
                        <tbody id="employeeListTableBody">
                            <!-- Dynamic employee rows go here -->
                        </tbody>
                    </table>
                    <button id="closeModalButton" class="mt-4 bg-red-500 text-white p-2 rounded">Close</button>
                </div>
            </div>

            
            <div class="flex flex-row gap-3 items-center ">
                <button type="button" id="editButton" class="w-[10vh] h-[4vh] bg-blue-500 text-white font-bold rounded-lg shadow-lg hover:scale-106 hover:bg-blue-600 transition duration-200">
                    Edit
                </button>
                <button type="button" id="updateButton" class="w-[10vh] h-[4vh] bg-green-500 text-white font-bold rounded-lg shadow-lg hover:scale-106 hover:bg-green-600 transition duration-200">
                    Update
                </button>
                <button type="button" id="downloadButton" class="w-[15vh] h-[4vh] bg-red-500 text-white font-bold rounded-lg shadow-lg hover:scale-106 hover:bg-green-600 transition duration-200">
                    Download Files
                </button>
                <button type="button" id="doneButton" class="w-[10vh] h-[5vh] bg-blue-600 text-white text-lg hover:scale-105 font-bold rounded-lg shadow-lg hover:scale-106 hover:bg-blue-800 transition duration-200 ml-auto mr-6">
                    Done
                </button>
            </div>


            <div class="w-full h-[calc(87vh-100px)] overflow-y-auto bg-white rounded-xl shadow-xl p-3 flex flex-col justify-center">
                <h1 class="text-2xl font-bold text-black dark:text-white mb-4 mt-10">EMPLOYEE'S FORM 201</h1>
                <form  id="editForm201" method="POST" action="#" class="w-full h-auto flex flex-col gap-3">
                    <!-- Image of employee -->
                    <div class="flex flex-row gap-2 w-[30vh] items-center mt-6 relative left-[110vh] top-[25vh]">
                        <img id="employeeImage" src="" alt="Employee Image" class="w-[30vh] h-[30vh] object-cover border rounded-md">
                    </div>

                    <h2 class="text-2xl italic text-red-600 font-semibold">Personal Information:</h2>
                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">First Name:</label>
                        <input type="text" id="firstName" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>
                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Middle Name:</label>
                        <input type="text" id="middleName" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>
                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Last Name:</label>
                        <input type="text" id="lastName" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>
                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Suffix:</label>
                        <input type="text" id="suffix" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>

                    <input type="hidden" id="employeeId" name="employeeId">



                    <div class="flex flex-row gap-2 w-full items-center">
                        <label class="font-semibold text-lg">Birth Date:</label>
                        <input type="date" id="birthdate" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>

                    <!-- Error message container -->
                    <p id="birthError" class="text-red-600 font-semibold mt-2 hidden">Error message here...</p>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const birthdayInput = document.getElementById("birthdate");
                            const birthError = document.getElementById("birthError");

                            function validateBirthday() {
                                const birthDate = new Date(birthdayInput.value);
                                const currentDate = new Date();
                                const age18Date = new Date();
                                age18Date.setFullYear(currentDate.getFullYear() - 18); // Calculate date 18 years ago

                                // Clear previous error messages
                                birthError.textContent = "";
                                birthError.classList.add("hidden");

                                // Check if a date is selected
                                if (!birthdayInput.value) {
                                    return;
                                }

                                // Ensure the date is not in the future
                                if (birthDate > currentDate) {
                                    birthError.textContent = "Is the employee a time traveller?";
                                    birthError.classList.remove("hidden");
                                    return false;
                                }

                                // Ensure the employee is at least 18 years old
                                if (birthDate > age18Date) {
                                    birthError.textContent = "The employee should be 18 years old and above.";
                                    birthError.classList.remove("hidden");
                                    return false;
                                }

                                return true;
                            }

                            // Attach event listener to validate the birth date
                            birthdayInput.addEventListener("change", validateBirthday);
                        });
                    </script>


                    <div class="flex flex-row gap-2 w-full items-center">
                        <label class="font-semibold text-lg">Birth Place:</label>
                        <input type="text" id="birthplace" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>

                    <div class="flex flex-row gap-2 w-full items-center">
                        <label class="font-semibold text-lg">Civil Status:</label>
                        <input type="text" id="civilStatus" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                       
                    </div>


                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Email:</label>
                        <input type="text" id="email" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>

                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Contact Number:</label>
                        <input type="text" id="contactnumber" name="w_contactnumber" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        <span id="contactError" class="text-red-500 text-sm hidden">Please enter a valid contact number (11 digits starting with 09).</span>
                    </div>

                    <script>
                        document.getElementById('contactnumber').addEventListener('input', function() {
                            let contactNoInput = this.value;
                            
                            // Only allow numeric characters and limit to 11 digits
                            contactNoInput = contactNoInput.replace(/\D/g, '').slice(0, 11); // Remove non-numeric and limit to 11 digits

                            // Update the input value with the cleaned value
                            this.value = contactNoInput;

                            const contactError = document.getElementById('contactError');

                            // Check if the input is exactly 11 digits and starts with '09'
                            const isValid = contactNoInput.length === 11 && contactNoInput.startsWith('09');

                            // Show error if invalid, else hide the error
                            if (!isValid) {
                                contactError.classList.remove('hidden');
                            } else {
                                contactError.classList.add('hidden');
                            }
                        });
                    </script>


                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Telephone Number:</label>
                        <input type="text" id="telnumber" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>

                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Permanent Address:</label>
                        <input type="text" id="permanentAdd" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div>

                    <div class="flex flex-row gap-2  w-full items-center">
                        <label class="font-semibold text-lg">Current Address:</label>
                        <input type="text" id="currentAdd" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                    </div> 
                    
                    <h2 class="text-2xl italic text-red-600 font-semibold mt-10">Government IDs:</h2>

                    <div class="flex flex-row gap-6 w-full items-center">
                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">SSS Number:</label>
                            <input type="text" id="sssnumber" name="sssId" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div> 

                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">PhilHealth Number:</label>
                            <input type="text" id="philhealthnumber" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div>
                    </div>

                    <div class="flex flex-row gap-6 w-full items-center">
                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">Pagibig Number:</label>
                            <input type="text" id="pagibignumber"  class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div> 

                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">TIN Number:</label>
                            <input type="text" id="TINnumber" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div>
                    </div>

                    <script>
                        function applySSSMask(input) {
                                            input.value = input.value
                                                .replace(/\D/g, '') // Remove non-digit characters
                                                .replace(/^(\d{2})(\d{0,7})(\d{0,1})/, '$1-$2-$3') // Apply mask format
                                                .slice(0, 12); // Limit length
                                        }

                                        function applyPhilHealthMask(input) {
                                            input.value = input.value
                                                .replace(/\D/g, '')
                                                .replace(/^(\d{2})(\d{0,8})(\d{0,1})/, '$1-$2-$3')
                                                .slice(0, 13);
                                        }

                                        function applyPagibigMask(input) {
                                            input.value = input.value
                                                .replace(/\D/g, '')
                                                .replace(/^(\d{4})(\d{0,4})(\d{0,4})/, '$1-$2-$3')
                                                .slice(0, 14);
                                        }

                                        function applyTINMask(input) {
                                            input.value = input.value
                                                .replace(/\D/g, '')
                                                .replace(/^(\d{3})(\d{0,3})(\d{0,3})(\d{0,3})/, '$1-$2-$3-$4')
                                                .slice(0, 15);
                                        }

                                        // Event listeners to apply masks on input
                                        document.getElementById('sssnumber').addEventListener('input', function () {
                                            applySSSMask(this);
                                            validatePattern(this, /^\d{2}-\d{7}-\d{1}$/, 'sssError');
                                        });

                                        document.getElementById('philhealthnumber').addEventListener('input', function () {
                                            applyPhilHealthMask(this);
                                            validatePattern(this, /^\d{2}-\d{8}-\d{1}$/, 'philhealthError');
                                        });

                                        document.getElementById('pagibignumber').addEventListener('input', function () {
                                            applyPagibigMask(this);
                                            validatePattern(this, /^\d{4}-\d{4}-\d{4}$/, 'pagibigError');
                                        });

                                        document.getElementById('TINnumber').addEventListener('input', function () {
                                            applyTINMask(this);
                                            validatePattern(this, /^\d{3}-\d{3}-\d{3}-\d{3}$/, 'tinError');
                                        });
                    </script>

                    <h2 class="text-2xl italic text-red-600 font-semibold mt-10">Employement History:</h2>

                    <div class="flex flex-row gap-6 w-full items-center">
                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">Company:</label>
                            <input type="text" id="companyhistory" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div> 

                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">Job Position:</label>
                            <input type="text" id="position" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div>
                    </div>

                    <div class="flex flex-row gap-6 w-full items-center">
                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">Start date:</label>
                            <input type="date" id="startjob" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div> 

                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">End date:</label>
                            <input type="date" id="endjob" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div>
                    </div>

                    <!-- Error message container -->
                    <p id="dateError" class="text-red-600 font-semibold mt-2 hidden">Error message here...</p>

                    <script>
                       document.addEventListener("DOMContentLoaded", function () {
                            const startJobInput = document.getElementById("startjob");
                            const endJobInput = document.getElementById("endjob");
                            const dateError = document.getElementById("dateError");

                            function validateDates() {
                                const startDate = new Date(startJobInput.value);
                                const endDate = new Date(endJobInput.value);
                                const currentDate = new Date();

                                // Clear previous error messages
                                dateError.textContent = "";
                                dateError.classList.add("hidden");

                                // Ensure both dates are selected
                                if (!startJobInput.value || !endJobInput.value) {
                                    return;
                                }

                                // Check if the start date is before the end date
                                if (startDate > endDate) {
                                    dateError.textContent = "The start date must be before the end date.";
                                    dateError.classList.remove("hidden");
                                    return false;
                                }

                                // Check for at least 1 month duration
                                const oneMonthLater = new Date(startDate);
                                oneMonthLater.setMonth(startDate.getMonth() + 1);

                                if (endDate < oneMonthLater) {
                                    dateError.textContent = "The duration must be at least 1 month.";
                                    dateError.classList.remove("hidden");
                                    return false;
                                }

                                // Ensure the end date does not exceed the current date
                                if (endDate > currentDate) {
                                    dateError.textContent = "The end date cannot be in the future.";
                                    dateError.classList.remove("hidden");
                                    return false;
                                }

                                return true;
                            }

                            // Attach event listeners for validation
                            startJobInput.addEventListener("change", validateDates);
                            endJobInput.addEventListener("change", validateDates);
                        });

                    </script>

                    <h2 class="text-2xl italic text-red-600 font-semibold mt-10">Employee Education:</h2>

                    <div class="flex flex-row gap-6 w-full items-center">
                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">School:</label>
                            <input type="text" id="school" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div> 

                        <div class="flex flex-row gap-2 w-[80vh] items-center">
                            <label class="font-semibold text-lg">Educational Attainment:</label>
                            <input type="text" id="attainment" class="border border-gray-300 rounded p-2 w-[60vh] h-[3vh]" readonly>
                        </div>
                    </div>
                    <div class="flex flex-row gap-2">
                            <label>
                                <input type="radio" name="educationLevel" value="Senior High School"> Senior High School
                            </label>
                            <label>
                                <input type="radio" name="educationLevel" value="Old Curriculum"> Old Curriculum
                            </label>
                            <label>
                                <input type="radio" name="educationLevel" value="Grade School"> Grade School
                            </label>
                            <label>
                                <input type="radio" name="educationLevel" value="College"> College
                            </label>
                            <label>
                                <input type="radio" name="educationLevel" value="Undergraduate"> Undergraduate
                            </label>
                            <label>
                                <input type="radio" name="educationLevel" value="Vocational"> Vocational
                            </label>
                    </div>


                </form>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const departmentSelect = document.getElementById('chooseEditDepartment');
            const editButton = document.getElementById('editButton');
            const updateButton = document.getElementById('updateButton');
            const downloadButton = document.getElementById('downloadButton');
            const employeeModal = document.getElementById('employeeModalEditList');
            const employeeListTableBody = document.getElementById('employeeListTableBody');
            const closeModalButton = document.getElementById('closeModalButton');

            // Initially disable buttons if no department is selected
            toggleButtons(departmentSelect.value);

            // Event listener for department selection
            departmentSelect.addEventListener('change', function () {
                toggleButtons(departmentSelect.value);
            });

            // Function to enable/disable buttons based on department selection
            function toggleButtons(departmentId) {
                if (departmentId === "") {
                    editButton.disabled = true;
                    updateButton.disabled = true;
                    downloadButton.disabled = true;
                } else {
                    editButton.disabled = false;
                    updateButton.disabled = false;
                    downloadButton.disabled = false;
                }
            }

            // Fetch departments
            fetchDepartments();

            // Fetch the department list for the department dropdown
            function fetchDepartments() {
                fetch('/admin/edit-employee/departments')
                    .then(response => response.json())
                    .then(departments => {
                        departments.forEach(department => {
                            const option = document.createElement('option');
                            option.value = department.department_ID;
                            option.textContent = department.department_name;
                            departmentSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching departments:', error));
            }

            // Event listener for department change to fetch employees
            departmentSelect.addEventListener('change', function () {
                const departmentId = departmentSelect.value;
                if (departmentId) {
                    fetch(`/admin/edit-employee/${departmentId}/employees`)
                        .then(response => response.json())
                        .then(employees => {
                            employeeListTableBody.innerHTML = '';
                            employees.forEach(employee => {
                                const row = document.createElement('tr');
                                row.setAttribute('data-employee-id', employee.employee_ID);
                                row.innerHTML = `
                                    <td class="p-2 border-b">${employee.employee_ID}</td>
                                    <td class="p-2 border-b">${employee.first_name}</td>
                                    <td class="p-2 border-b">${employee.last_name}</td>
                                `;
                                employeeListTableBody.appendChild(row);
                            });
                            employeeModal.classList.remove('hidden');
                        })
                        .catch(error => console.error('Error fetching employees:', error));
                }
            });

            // Close modal button functionality
            closeModalButton.addEventListener('click', function () {
                employeeModal.classList.add('hidden');
            });

            // Load employee data into form
            employeeListTableBody.addEventListener('click', function (event) {
                const row = event.target.closest('tr');
                if (row) {
                    const employeeId = row.getAttribute('data-employee-id');
                    loadEmployeeData(employeeId);
                    employeeModal.classList.add('hidden');
                }
            });

            // Load employee data for editing
            function loadEmployeeData(employeeId) {
                fetch(`/admin/edit-employee/details/${employeeId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('firstName').value = data.first_name;
                        document.getElementById('firstName').setAttribute('data-original-value', data.first_name);
                        document.getElementById('middleName').value = data.middle_name;
                        document.getElementById('middleName').setAttribute('data-original-value', data.middle_name);
                        document.getElementById('lastName').value = data.last_name;
                        document.getElementById('lastName').setAttribute('data-original-value', data.last_name);
                        document.getElementById('suffix').value = data.suffix || '';
                        document.getElementById('suffix').setAttribute('data-original-value', data.suffix);
                        document.getElementById('employeeId').value = employeeId;
                        document.getElementById('birthdate').value = data.birth_date;
                        document.getElementById('birthdate').setAttribute('data-original-value', data.birth_date);
                        document.getElementById('birthplace').value = data.birth_place;
                        document.getElementById('birthplace').setAttribute('data-original-value', data.birth_place);
                        document.getElementById('civilStatus').value = data.civil_status;
                        document.getElementById('civilStatus').setAttribute('data-original-value', data.civil_status);
                        document.getElementById('email').value = data.email;
                         document.getElementById('email').setAttribute('data-original-value', data.email);
                        document.getElementById('contactnumber').value = data.contact_no;
                         document.getElementById('contactnumber').setAttribute('data-original-value', data.contact_no);
                        document.getElementById('telnumber').value = data.telephone_no;
                         document.getElementById('telnumber').setAttribute('data-original-value', data.telephone_no);
                        document.getElementById('permanentAdd').value = data.permanent_address;
                         document.getElementById('permanentAdd').setAttribute('data-original-value', data.permanent_address);
                        document.getElementById('currentAdd').value = data.current_address;
                         document.getElementById('currentAdd').setAttribute('data-original-value', data.current_address);
                        document.getElementById('sssnumber').value = data.sss;
                         document.getElementById('sssnumber').setAttribute('data-original-value', data.sss);
                        document.getElementById('philhealthnumber').value = data.philhealth;
                         document.getElementById('philhealthnumber').setAttribute('data-original-value', data.philhealth);
                        document.getElementById('pagibignumber').value = data.pagibig;
                         document.getElementById('pagibignumber').setAttribute('data-original-value', data.pagibig);
                        document.getElementById('TINnumber').value = data.tin;
                         document.getElementById('TINnumber').setAttribute('data-original-value', data.tin);
                        document.getElementById('companyhistory').value = data.company;
                         document.getElementById('companyhistory').setAttribute('data-original-value', data.company);
                        document.getElementById('position').value = data.remark;
                         document.getElementById('position').setAttribute('data-original-value', data.remark);
                        document.getElementById('startjob').value = data.start_date;
                         document.getElementById('startjob').setAttribute('data-original-value', data.start_date);
                        document.getElementById('endjob').value = data.end_date;
                         document.getElementById('endjob').setAttribute('data-original-value', data.end_date);
                        document.getElementById('school').value = data.education;
                         document.getElementById('school').setAttribute('data-original-value', data.education);
                        document.getElementById('attainment').value = data.remarks;
                         document.getElementById('attainment').setAttribute('data-original-value', data.remarks);
                        if (data.empPicture) {
                            document.getElementById('employeeImage').src = `data:image/png;base64,${data.empPicture}`;
                        }
                    })
                    .catch(error => console.error('Error loading employee data:', error));
            }
        });

            document.getElementById('downloadButton').addEventListener('click', function() {
                    const employeeId = document.getElementById('employeeFullName').getAttribute('data-employee-id');
                    console.log('Employee ID:', employeeId);  // Log the employee ID
                    if (employeeId) {
                        window.location.href = `/admin/download-file/${employeeId}`;
                    } else {
                        alert("Employee ID not found. Please select an employee.");
                    }
                });

                document.getElementById('editButton').addEventListener('click', function() {
                    // Get all the input fields in the form
                    const formFields = document.querySelectorAll('#editForm201 input');
                    const educationRadios = document.getElementsByName("educationLevel");
                    const schoolInput = document.getElementById("school");
                    const attainmentInput = document.getElementById("attainment");
                    
                    // Check if the fields are already editable
                    const isEditable = formFields[0].hasAttribute('readonly');

                    if (isEditable) {
                        formFields.forEach(field => {
                            field.removeAttribute('readonly');
                        });
                        editButton.textContent = 'Cancel'; // Change button text to 'Cancel'
                    } else {
                        formFields.forEach(field => {
                            field.setAttribute('readonly', 'true');
                        });
                        editButton.textContent = 'Edit'; // Change button text back to 'Edit'
                    }

                      // Disable inputs by default
                        schoolInput.setAttribute("readonly", true);
                        attainmentInput.setAttribute("readonly", true);

                     educationRadios.forEach((radio) => {
                        radio.addEventListener("change", function () {
                            if (this.checked) {
                                schoolInput.removeAttribute("readonly");
                                attainmentInput.removeAttribute("readonly");
                            } else {
                                schoolInput.setAttribute("readonly", true);
                                attainmentInput.setAttribute("readonly", true);
                            }
                        });
                    });

                });


                document.getElementById('updateButton').addEventListener('click', function () {
                    const formFields = document.querySelectorAll('#editForm201 input');
                    const employeeId = document.getElementById('employeeId').value;
                    const selectedRadio = document.querySelector('input[name="educationLevel"]:checked');
                    const schoolInput = document.getElementById('school');
                    const attainmentInput = document.getElementById('attainment');

                     const updatedFields = {};

                    formFields.forEach(field => {
                        const originalValue = field.getAttribute('data-original-value'); // Original value from backend
                        const currentValue = field.value;

                        if (originalValue !== currentValue) {
                            const fieldName = field.getAttribute('id');
                            updatedFields[fieldName] = currentValue;
                        }
                    });

                    if (selectedRadio && selectedRadio.value !== selectedRadio.getAttribute('data-original-value')) {
                        updatedFields['educationLevel'] = selectedRadio.value;
                    }

                    if (schoolInput.value !== schoolInput.getAttribute('data-original-value')) {
                        updatedFields['school'] = schoolInput.value;
                    }
                    if (attainmentInput.value !== attainmentInput.getAttribute('data-original-value')) {
                        updatedFields['attainment'] = attainmentInput.value;
                    }

                    if (document.getElementById('firstName').value !== document.getElementById('firstName').getAttribute('data-original-value')) {
                        updatedFields['first_name'] = document.getElementById('firstName').value;
                    }
                    if (document.getElementById('middleName').value !== document.getElementById('middleName').getAttribute('data-original-value')) {
                        updatedFields['middle_name'] = document.getElementById('middleName').value;
                    }
                    if (document.getElementById('lastName').value !== document.getElementById('lastName').getAttribute('data-original-value')) {
                        updatedFields['last_name'] = document.getElementById('lastName').value;
                    }
                    if (document.getElementById('suffix').value !== document.getElementById('suffix').getAttribute('data-original-value')) {
                        updatedFields['suffix'] = document.getElementById('suffix').value;
                    }


                    if (Object.keys(updatedFields).length === 0) {
                        alert('No changes');
                        return;
                    }

                    fetch(`/admin/update-employee/${employeeId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(updatedFields)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Changes complete');
                            } else {
                                alert('Error editing the changes');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error editing the changes');
                        });
                });

                 document.getElementById('doneButton').addEventListener('click', function() {
                    // Refresh the page
                    location.reload();
                });


    </script>

    <!--PERFORMANCE evaluation contents-->
    <section class="section w-full p-4 " id="performance-evaluation-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Performance Evaluation</h1>
        
        <!--whole section-->
        <div class="w-full h-auto p-3 flex flex-col gap-2">
            <!--first row-->
            <div class="w-full h-auto p-2 flex flex-row items-center">
                <!--buttons-->
                <div class="w-[60vh] h-auto flex flex-row items-center gap-3">
                    <button class="w-full h-[7vh] flex flex-row gap-4 justify-center items-center bg-white dark:bg-gray-700 rounded-2xl shadow-xl hover:scale-105 transition duration-200" data-toggle-section="performance-form-content" onclick="navigateTo('performance-form', this)">
                        <img src="{{URL('images/evaluate.png')}}" alt="" class="w-8">
                        <h2 class="text-lg dark:text-white">Evaluate</h2>
                    </button>
                    <button class="w-full h-[7vh] flex flex-row gap-4 justify-center items-center bg-white dark:bg-gray-700 rounded-2xl shadow-xl hover:scale-105 transition duration-200" data-toggle-section="viewAllEvaluation-content" onclick="navigateTo('viewAllEvaluation', this)">
                        <img src="{{URL('images/view.png')}}" alt="" class="w-7">
                        <h2 class="text-lg dark:text-white">View Evaluation</h2>
                    </button>
                </div> 
            </div>

            <!--second row-->
            <div class="w-full h-[76vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl p-4">
                <div class="flex flex-col gap-3 p-2">
                    
                    <div class="flex flex-row w-full items-center">
                        <h1 class="text-2xl font-bold dark:text-white">OVERVIEW</h1>

                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden ml-auto">
                            <input 
                                type="text" 
                                name="search" 
                                class="w-full py-1 px-4" 
                                placeholder="Search..."
                            >
                            <button class="px-4 focus:scale-110">
                                <img src="{{ asset('images/search_emp.png') }}" alt="Search Icon" class="w-7 h-auto">
                            </button>
                        </div>
                    </div>

                    <table class="w-full h-[60vh]">
                        <thead class="w-full bg-gray-100 dark:bg-gray-500">
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">EVALUATED BY</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">EMPLOYEE</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">RECOMMENDED ACTION</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">STATUS</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">DATE</th>
                        </thead>
                        <tbody id="overviewPerformanceEvaluation">

                        </tbody>
                    </table>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                            fetchOverviewEvaluations();
                        });

                        function fetchOverviewEvaluations() {
                            fetch('/evaluations?limit=6')  // Modify this to pass a limit if needed
                                .then(response => response.json())
                                .then(data => {
                                    const overviewBody = document.getElementById('overviewPerformanceEvaluation');
                                    overviewBody.innerHTML = ''; // Clear existing rows

                                    // Limit to 6 evaluations
                                    data.slice(0, 6).forEach(evaluation => { // Ensure only 6 rows are processed
                                        const row = document.createElement('tr');
                                        row.classList.add('border-b', 'hover:bg-gray-200', 'cursor-pointer', 'transition', 'duration-200','dark:hover:bg-gray-900');
                                        
                                        // Set the evaluation data as a data attribute for the row
                                        row.setAttribute('data-evaluation', JSON.stringify(evaluation));

                                        row.innerHTML = `
                                            <td class="text-center text-md font-bold text-black dark:text-white px-3 py-3">${evaluation.rater_first_name} ${evaluation.rater_last_name}</td>
                                            <td class="text-center text-md font-bold text-black dark:text-white px-3 py-3">${evaluation.employee_first_name} ${evaluation.employee_last_name}</td>
                                            <td class="text-center text-md font-bold text-white px-3 py-3">
                                                <span class="p-2 bg-green-500 rounded-lg shadow-lg">${evaluation.recommended_action}</span>
                                            </td>
                                            <td class="text-center text-md font-bold text-white px-3 py-3">
                                                <span class="p-2 bg-red-500 rounded-lg shadow-lg">${evaluation.performance_rating}</span>
                                            </td>
                                            <td class="text-center text-md font-bold text-black dark:text-white px-3 py-3">${evaluation.date_evaluated}</td>
                                        `;

                                        // Add click event listener to the row
                                        row.addEventListener('click', function() {
                                            openEvaluationModal(evaluation); // Call the modal function with the current evaluation
                                        });

                                        overviewBody.appendChild(row);
                                    });
                                })
                                .catch(error => console.error('Error fetching evaluations:', error));
                        }          
                </script>
            </div>
        </div>
    </section>

    <!--ATTENDANCE contents-->
    <section class="section w-full p-4" id="attendance-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Attendance</h1>
        <!--whole section-->
        <div class="w-full h-auto p-4 flex flex-col gap-3">
            <!--first row-->
            <div class="w-full h-auto flex flex-row gap-3">
                <!-- Button -->
                <!-- Input Attendance Button -->
                <button onclick="toggleModal()" class="w-[30vh] h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row gap-2 items-center justify-center hover:scale-105 transition duration-200">
                    <img src="{{ URL('images/input_att.png') }}" alt="" class="w-7">
                    <h2 class="text-lg dark:text-white">Input Attendance</h2>
                </button>

                <!-- Modal Form -->
                <form action="{{ route('attendance.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Modal -->
                    <div id="fileModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-2xl w-[90vw] md:w-[40vw]">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Upload Attendance File</h3>
                                <button onclick="toggleModal()" type="button" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 font-semibold">&times;</button>
                            </div>
                            <input type="file" name="file" required class="mb-4">
                            <!-- Buttons -->
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="toggleModal()" class="bg-red-400 text-white px-4 py-2 rounded-lg hover:bg-red-500 transition duration-200 font-semibold">Cancel</button>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 font-semibold">Import</button>
                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    function toggleModal() {
                        const modal = document.getElementById('fileModal');
                        modal.classList.toggle('hidden');  // Toggle the modal visibility
                    }
                </script>
        
                    <button class="flex justify-center items-center w-[9vh] h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl hover:scale-105 transition duration-200 search-button">
                            <img src="{{URL('images/search.png')}}" alt="search Admin Management" class="w-8 h-8">
                    </button>
                </div>
            </div>

                    <!--second row-->
                    <div class="w-full h-[76vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl p-3">
                        <div class="flex flex-col w-full h-auto p-3 gap-1">
                            <div class="flex flex-row w-full h-auto items-center">
                                <h1 class="text-lg font-bold dark:text-white">ATTENDANCE OVERVIEW</h1>
                            </div>

                            <!-- Container for table with fixed header and scrollable rows -->
                            <div class="w-full p-5">
                                <div class="overflow-y-auto h-[calc(83vh-150px)]">
                                    <table class="w-full">
                                        <thead class="bg-gray-100 dark:bg-gray-500 sticky top-0 z-10">
                                            <tr>
                                                <th class="text-lg font-semibold opacity-50 py-2 text-center dark:text-gray-100">ATTENDANCE ID</th>
                                                <th class="text-lg font-semibold opacity-50 py-2 text-center dark:text-gray-100">NAME</th>
                                                <th class="text-lg font-semibold opacity-50 py-2 text-center dark:text-gray-100">DATE</th>
                                                <th class="text-lg font-semibold opacity-50 py-2 text-center dark:text-gray-100">TIME-IN</th>
                                                <th class="text-lg font-semibold opacity-50 py-2 text-center dark:text-gray-100">TIME-OUT</th>
                                            </tr>
                                        </thead>
                                        <tbody id="attendance-table-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                fetchAttendanceData();
                            });

                            function fetchAttendanceData() {
                                fetch('/admin/attendance-data')
                                    .then(response => response.json())
                                    .then(data => {
                                        let tbody = document.getElementById("attendance-table-body");
                                        tbody.innerHTML = ""; // Clear previous data

                                        data.forEach(record => {
                                            let row = document.createElement("tr");

                                            row.innerHTML = `
                                                <td class="py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white">${record.attendance_ID}</td>
                                                <td class="py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white">${record.employee_name}</td>
                                                <td class="py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white">${record.date}</td>
                                                <td class="py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white">${record.time_in}</td>
                                                <td class="py-2 text-center font-semibold dark:text-white border-b border-gray-300 dark:border-white">${record.time_out}</td>
                                            `;
                                            tbody.appendChild(row);
                                        });
                                    })
                                    .catch(error => console.error('Error fetching attendance data:', error));
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--LEAVE & ABSENCES contents-->
    <section class="section w-full p-4" id="leave-absence-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Leave & Absence</h1>

        <!-- Whole section -->
            <div class="w-full h-auto p-4 flex flex-col gap-4">
                <!-- Employee leave requests overview -->
                <div class="w-full h-[80vh] flex flex-col p-5 gap-8 bg-white dark:bg-gray-700 rounded-2xl shadow-2xl mt-10">
                    <!-- Buttons -->
                    <div class="w-full flex flex-row items-center">
                        <h1 class="w-full text-2xl font-bold dark:text-white">Leave Requests</h1>
                        <div class="ml-auto flex flex-row items-center justify-center gap-3">
                            <button class="w-[5vh] h-[5vh] flex items-center justify-center bg-gray-200 dark:bg-gray-500 rounded-full shadow-xl hover:scale-110 transition duration-200">
                                <img src="{{URL('images/refresh.png')}}" alt="" data-light-src="{{URL('images/refresh.png')}}" data-dark-src="{{URL('images/refresh_dark.png')}}" class="w-6 h-6">
                            </button>
                            <button class="w-7 h-auto hover:scale-125 transition duration-200">
                                <img src="{{URL('images/rightmore.png')}}" alt="" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7" onclick="navigateTo('displayAllRequestForHr', this)" data-toggle-section="displayAllRequestForHr-content">
                            </button>
                        </div>
                    </div>

                    <!-- Table with fixed header and scrollable body -->
                    <div class="overflow-y-auto h-[calc(93vh-150px)]">
                        <table class="w-full">
                            <thead class="bg-gray-100 dark:bg-gray-500 sticky top-0 z-10">
                                <tr>
                                    <th class="text-medium py-3 font-medium dark:text-gray-200 text-center">NAME</th>
                                    <th class="text-medium py-3 font-medium dark:text-gray-200 text-center">LEAVE TYPE</th>
                                    <th class="text-medium py-3 font-medium dark:text-gray-200 text-center">DEPARTMENT</th>
                                    <th class="text-medium py-3 font-medium dark:text-gray-200 text-center">START</th>
                                    <th class="text-medium py-3 font-medium dark:text-gray-200 text-center">END</th>
                                    <th class="text-medium py-3 font-medium dark:text-gray-200 text-center">APPRAISAL OF SUPERVISOR</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody id="leave-requests-tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetchLeaveRequests();

                function fetchLeaveRequests() {
                    fetch('/leave-requests')
                        .then(response => response.json())
                        .then(data => {
                            const tbody = document.getElementById('leave-requests-tbody');
                            tbody.innerHTML = ''; // Clear existing content

                            data.forEach(request => {
                                const row = document.createElement('tr');
                                row.classList.add('border-b', 'hover:bg-gray-200', 'cursor-pointer', 'hover:dark:bg-gray-800');

                                row.innerHTML = `
                                    <td class="text-sm py-3 font-normal text-center dark:text-white">
                                        <a href="#" class="no-underline">${request.first_name} ${request.last_name}</a>
                                    </td>
                                    <td class="text-sm py-3 font-normal text-center">
                                        <span class="w-full py-1 px-2 text-white font-semibold bg-blue-600 rounded-lg shadow-lg">
                                            ${request.leave_type === 0 ? request.leave_type_other : (request.leaveType ? request.leaveType : 'N/A')}
                                        </span>
                                    </td>
                                    <td class="text-sm py-3 font-normal text-center dark:text-white">${request.department_name}</td>
                                    <td class="text-sm py-3 font-normal text-center dark:text-white">${request.leave_from}</td>
                                    <td class="text-sm py-3 font-normal text-center dark:text-white">${request.leave_to}</td>
                                    <td class="text-sm py-3 font-normal text-center">
                                        <span class="w-full py-1 px-2 text-white font-semibold
                                            ${request.manager_approval === 1 ? 'bg-green-600' :
                                            request.manager_approval === 0 ? 'bg-red-600' : 'bg-yellow-500'}
                                            rounded-lg shadow-lg">
                                            ${request.manager_approval === 1 ? 'Approved' :
                                            request.manager_approval === 0 ? 'Rejected' : 'Pending'}
                                        </span>
                                    </td>
                                `;
                                row.addEventListener('click', () => openModal(request));
                                tbody.appendChild(row);
                            });
                        })
                        .catch(error => console.error('Error fetching leave requests:', error));
                }

                function openModal(request) {
                    document.getElementById('leaveID').innerText =request.leave_ID;
                    document.getElementById('employeeName').innerText = `${request.first_name} ${request.last_name}`;
                    document.getElementById('departmentName').innerText = request.department_name;
                    document.getElementById('requestedDate').innerText = request.date_applied; 
                    document.getElementById('startDate').innerText = request.leave_from;
                    document.getElementById('endDate').innerText = request.leave_to;
                   document.getElementById('leaveType').innerText = request.leaveType ? request.leaveType : (request.leave_type_other || 'N/A');


                    // Set appraisal text and class based on approval status
                    const appraisalText = request.manager_approval === 1 ? 'Approved' :
                                        request.manager_approval === 0 ? 'Rejected' : 'Pending';
                    const appraisalClass = request.manager_approval === 1 ? 'bg-green-600 rounded-lg p-2 text-white text-sm':
                                        request.manager_approval === 0 ? 'bg-red-600 rounded-lg p-2 text-white text-sm' : 'bg-yellow-600 rounded-lg p-2 text-white text-sm';

                    const managerAppraisalElement = document.getElementById('managerAppraisal');
                    managerAppraisalElement.innerText = appraisalText;
                    managerAppraisalElement.className = `flex justify-center p-2 items-center ${appraisalClass} rounded-lg font-bold text-lg italic dark:text-white`;

                      // Check if the request is rejected by the department head
                      // Buttons
                    const approveBtn = document.getElementById('approve-btn');
                    const rejectBtn = document.getElementById('reject-btn');

                    // Enable/disable buttons based on manager_approval status
                    if (request.manager_approval === 1) { // Approved
                        approveBtn.disabled = false;
                        approveBtn.classList.remove('cursor-not-allowed', 'opacity-50');
                        rejectBtn.disabled = false;
                        rejectBtn.classList.remove('cursor-not-allowed', 'opacity-50');
                    } else if (request.manager_approval === 0) { // Rejected
                        approveBtn.disabled = true;
                        approveBtn.classList.add('cursor-not-allowed', 'opacity-50');
                        rejectBtn.disabled = false;
                        rejectBtn.classList.remove('cursor-not-allowed', 'opacity-50');
                    } else { // Pending
                        approveBtn.disabled = true;
                        approveBtn.classList.add('cursor-not-allowed', 'opacity-50');
                        rejectBtn.disabled = true;
                        rejectBtn.classList.add('cursor-not-allowed', 'opacity-50');
                    }
                     // Display the reason for leave
                    document.getElementById('leaveReason').innerText = request.reason;

                    // Show the modal
                    document.getElementById('displayRequestForHr').classList.remove('hidden');
                }

                // Close modal functionality
                document.getElementById('close-btn').addEventListener('click', () => {
                    document.getElementById('displayRequestForHr').classList.add('hidden');
                });
            });
        </script>
    </section>

    <!--SETTINGS contents-->
    <section class="section w-full p-4" id="settings-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Settings</h1>
        
      
      
    </section>

    <!--Leave request  modal approve and reject request-->
    <section id="displayRequestForHr" class="fixed flex items-center inset-0 bg-white  bg-opacity-80 items-center justify-center hidden z-50">
        <div class="flex flex-col gap-3 bg-gray-200 dark:bg-gray-700 p-6 rounded-2xl shadow-lg max-w-md w-full justify-center">
            <div class="flex flex-col p-2 gap-3">

                <div class="flex flex-row items-center gap-3">
                    <h1 class="text-3xl font-bold text-black dark:text-white" id="leaveID"></h1> <!-- Leave ID will be displayed here -->
                    <div class = "flex flex-col items-start">
                        <h1 id="employeeName" class="text-2xl font-bold text-black dark:text-white">Employee Name</h1>
                        <h2 id="departmentName" class="text-md font-normal text-black dark:text-white opacitiy-60"><!--insert department name here--></h2>
                    </div>
                </div>

                <div class="flex flex-row items-center gap-4">
                    <p class="text-md font-bold text-black dark:text-white">Date Requested: </p>
                    <span id="requestedDate" class="text-black text-md dark:text-white" id="requestedDate"></span>
                </div>
                <div class="flex flex-row items-center gap-4">
                    <p class="text-md font-bold text-black dark:text-white">Start Date: </p>
                    <span id="startDate" class="text-black text-md dark:text-white" id="startDate"></span>
                </div>
                <div class="flex flex-row items-center gap-4">
                    <p class="text-md font-bold text-black dark:text-white">End Date: </p>
                    <span id="endDate" class="text-black text-md dark:text-white" id="endDate"></span>
                </div>
                <div class="flex flex-row items-center gap-4">
                    <p class="text-md font-bold text-black dark:text-white">Leave Type: </p>
                    <span id="leaveType" class="text-black text-md dark:text-white" id="leaveType"></span>
                </div class="flex flex-col items-start gap-2">
                    <p class="text-md font-bold text-black dark:text-white">Reason: </p>
                    <span id="leaveReason" class="text-black text-md dark:text-white" id="leaveReason"></span>
                </div>

                <div class="flex flex-row items-center gap-3">
                    <p class="text-md font-bold text-black dark:text-white">Appraisal of Supervisor status: </p>
                    <span id="managerAppraisal"class="flex justify-center p-3 items-center bg-green-600 rounded-lg shadow-lg font-bold text-sm "><!--insert the manager_approval value in here--></span>
                </div>
                

                <!-- Modal Buttons -->
                <!-- Approve Button -->
                <button id="approve-btn" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-xl hover:scale-105 transition duration-200 hover:font-bold">
                    Approve
                </button>

                <!-- Reject Button -->
                <button id="reject-btn" class="bg-red-500 text-white py-2 px-4 rounded rounded-lg shadow-xl hover:scale-105 transition duration-200 hover:font-bold">
                    Reject
                </button>
                    <button id="close-btn" class="w-[10vh] h-[5vh] rounded-lg text-center font-semibold dark:text-white text-black hover:scale-105 transition duration-200" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </section>

    <script>
            function handleLeaveRequest(url, action, leaveID) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure you have CSRF token for protection
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message); // You can display success message in UI if needed
                    if (action === 'approved') {
                        alert('Leave request approved successfully');
                    } else if (action === 'rejected') {
                        alert('Leave request rejected successfully');
                    }
                    // Remove the row from the table
                    const tbody = document.getElementById('leave-requests-tbody');
                    const row = tbody.querySelector(`tr[data-leave-id="${leaveID}"]`); // Select row by data attribute
                    if (row) {
                        tbody.removeChild(row);
                    }
                    // Close modal after action
                    document.getElementById('displayRequestForHr').classList.add('hidden');
                })
                .catch(error => console.error('Error:', error));
            }

            document.getElementById('approve-btn').addEventListener('click', function() {
                const leaveID = document.getElementById('leaveID').innerText;
                if (confirm('Are you sure you want to approve this leave request?')) {
                    handleLeaveRequest('/leave-request/approve/' + leaveID, 'approved', leaveID);
                }
            });

            document.getElementById('reject-btn').addEventListener('click', function() {
                const leaveID = document.getElementById('leaveID').innerText;
                if (confirm('Are you sure you want to reject this leave request?')) {
                    handleLeaveRequest('/leave-request/reject/' + leaveID, 'rejected', leaveID);
                }
            });    
    </script> 

    <!--display all request HR Page-->
    <section id="displayAllRequestForHr-content" class="section hidden w-full h-screen p-7">
            <div class="flex flex-col bg-white dark:bg-gray-700 rounded-xl shadow-xl w-full h-[85vh] p-4 mt-12">
                <div class="flex flex-row justify-between items-center mb-5">
                    <h1 class="text-2xl font-bold text-black dark:text-white">All Leave Requests</h1>
                    <div class="flex flex-row justify-center items-center gap-2">
                        <h2 class="text-sm font-bold text-black dark:text-white">Filter: </h2>
                        <select id="filter-option" class="w-[20vh] border-gray-300 text-sm font-normal border rounded-md p-2  focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="all">All</option> <!-- Add 'All' option -->
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col w-full h-[calc(90vh-100px)] overflow-y-auto">
                    <table>
                        <thead class="w-full h-auto bg-gray-200 dark:bg-gray-500">
                            <tr>
                                <th class="font-semibold text-medium py-3 px-2 text-black dark:text-white text-nowrap">Full Status</th>
                                <th class="font-semibold text-medium py-3 px-2 text-black dark:text-white text-nowrap">Date Applied</th>
                                <th class="font-semibold text-medium py-3 px-6 text-black dark:text-white text-nowrap">Employee</th>
                                <th class="font-semibold text-medium py-3 px-2 text-black dark:text-white text-nowrap">Department</th>
                                <th class="font-semibold text-medium py-3 px-2 text-black dark:text-white text-nowrap">Leave Type</th>
                                <th class="font-semibold text-medium py-3 px-2 text-black dark:text-white text-nowrap">Reason</th>
                            </tr>
                        </thead>

                        <tbody id="fullList-requests-forHR">
                            <!-- Data will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
                
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        let allRequests = []; // Array to store all requests initially

                        // Function to load all leave requests and store them in `allRequests`
                        function loadAllLeaveRequests() {
                            $.ajax({
                                url: "{{ route('leave.requests.history') }}",
                                method: "GET",
                                success: function(data) {
                                    allRequests = data; // Store all requests in `allRequests` array
                                    displayRequests(allRequests); // Display all requests initially
                                }
                            });
                        }

                        // Function to display requests based on the selected filter
                        function displayRequests(requests) {
                            let tableBody = $("#fullList-requests-forHR");
                            tableBody.empty(); // Clear previous content

                            requests.forEach(request => {
                                // Determine the background color based on the status
                                let statusClass = '';
                                if (request.full_status.toLowerCase() === 'approved') {
                                    statusClass = 'bg-green-600 text-white font-bold rounded-lg p-2 shadow-xl';
                                } else if (request.full_status.toLowerCase() === 'rejected') {
                                    statusClass = 'bg-red-600 text-white font-bold rounded-lg p-2 shadow-xl';
                                } else if (request.full_status.toLowerCase() === 'pending') {
                                    statusClass = 'bg-yellow-600 text-white font-bold rounded-lg p-2 shadow-xl';
                                }

                                // Truncate reason if it's longer than 80 characters
                                let reasonText = request.reason || 'N/A';
                                let truncatedReason = reasonText.length > 80 ? reasonText.substring(0, 80) + '...' : reasonText;

                                tableBody.append(`
                                    <tr class="border-b border-gray-300">
                                        <td class="py-4 px-2 text-sm text-center "><span class="${statusClass}">${request.full_status}</span></td>
                                        <td class="py-4 px-2 text-sm text-center dark:text-white">${request.date_applied}</td>
                                        <td class="py-4 px-4 text-sm text-center dark:text-white">${request.first_name} ${request.last_name}</td>
                                        <td class="py-4 px-2 text-sm text-center dark:text-white">${request.department_name}</td>
                                        <td class="py-4 px-2 text-sm text-center "><span class="bg-blue-500 rounded-lg shadow-xl p-2 font-semibold text-white">${request.leaveType || request.leave_type_other}</span></td>
                                        <td class="py-4 px-2 text-sm text-center dark:text-white" title="${reasonText}">${truncatedReason}</td>
                                    </tr>
                                `);
                            });
                        }

                        // Initial load of all leave requests
                        loadAllLeaveRequests();

                        // Filter requests based on dropdown selection
                        $('#filter-option').change(function() {
                            let selectedStatus = $(this).val(); // Get selected filter option

                            // Filter requests based on selected status, or show all if "all" is selected
                            let filteredRequests = selectedStatus === "all" 
                                ? allRequests 
                                : allRequests.filter(request => request.full_status.toLowerCase() === selectedStatus);

                            displayRequests(filteredRequests); // Display filtered requests
                        });
                    });
                </script>

            </div>
    </section>

    <!--add employee section-->
    <section id="add-employee-content" class="section hidden w-full h-screen p-7" >

        <div id="messageModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white dark:bg-gray-200 p-6 rounded-lg shadow-lg w-1/3">
                <div id="messageContent" class="text-center text-lg"></div>
                <div class="flex justify-end mt-4">
                    <button onclick="closeModalForm201()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md focus:outline-none">OK</button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let successMessage = "{{ session('success') }}";
                let errorMessage = "{{ session('error') }}";

                if (successMessage || errorMessage) {
                    let messageModal = document.getElementById('messageModal');
                    let messageContent = document.getElementById('messageContent');

                    if (successMessage) {
                        messageContent.innerHTML = `<p class="text-green-500 font-bold">${successMessage}</p>`;
                    } else if (errorMessage) {
                        messageContent.innerHTML = `<p class="text-red-500 font-bold">${errorMessage}</p>`;
                    }

                    // Show the modal
                    messageModal.classList.remove('hidden');
                }
            });

            function closeModalForm201() {
                let messageModal = document.getElementById('messageModal');
                messageModal.classList.add('hidden');
            }
        </script>


        <div class="flex flex-row w-full h-[10vh] items-center justify-start">
            <button class=" w-14 p-2 hover:scale-125 transition duration-200" onclick="goBack()">
                <img src="{{URL('images/goback.png')}}" alt="" data-light-src="{{URL('images/goback.png')}}" data-dark-src="{{URL('images/goback_dark.png')}}" class="w-12">
            </button>
        </div>
        
            <!--FORM 201-->
                <div class="w-full bg-white dark:bg-gray-300 md:h-[85vh] h-[calc(100vh-100px)] rounded-lg overflow-y-auto p-4 shadow-2xl">
                    <div class="bg-white dark:bg-gray-200 shadow-md rounded-lg overflow-hidden p-7 space-y-1">
                        <h1 class="text-4xl sm:text-2xl font-bold text-center">Form 201</h1>
                        <p class="text-lg sm:text-sm italic text-center">Fill out the form below</p>
                            
                </div>
                        <!--general form-->
                    <form action="{{ route('admin.InsertEmployeeData') }}" method="POST" class="space-y-5" onsubmit="showLoadingSpinner()"  enctype="multipart/form-data">
                            
                        @csrf
                            <!-- Upload Picture -->
                            <div class="flex items-start justify-between">
                                <div class="w-20vh ml-10">
                                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload image</label>
                                    <input 
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                        id="file_inputempPic" 
                                        name="employee_images" 
                                        type="file" 
                                        accept="image/*" 
                                        onchange="previewImage(event)">
                                </div>

                                <!-- Preview Box with 70x70px size -->
                                <div class="border border-gray-300 rounded-lg overflow-hidden dark:border-gray-600 mr-10" style="width: 220px; height: 220px;">
                                    <img id="image_preview" class="w-full h-full object-cover" src="#" alt="Image preview" style="display: none;">
                                </div>
                            </div>

                            <script>
                                function previewImage(event) {
                                    const preview = document.getElementById('image_preview');
                                    const file = event.target.files[0];
                                    
                                    if (file) {
                                        preview.style.display = 'block';
                                        preview.src = URL.createObjectURL(file);
                                        preview.onload = function() {
                                            URL.revokeObjectURL(preview.src);
                                        };
                                    } else {
                                        preview.style.display = 'none';
                                        preview.src = '';
                                    }
                                }
                                
                            </script>

                            <!--Selecting Department-->
                            <div class="p-5">
                                <label for="department" class="block text-sm font-medium text-gray-600">Designated Department:</label>
                                <select id="department" name="department" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500">
                                    <option value="" disabled selected>Select a department</option>
                                </select>
                                @error('department')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    fetchDepartments();
                                });

                                function fetchDepartments() {
                                    fetch('/departments')
                                        .then(response => response.json())
                                        .then(data => {
                                            const departmentSelect = document.getElementById('department');
                                            
                                            data.forEach(department => {
                                                const option = document.createElement('option');
                                                option.value = department.department_ID;
                                                option.textContent = department.department_name;
                                                departmentSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error fetching departments:', error);
                                        });
                                }
                              
                            </script>

                            <!--personal information section-->
                            <div class="p-5">
                                <p class="text-sm italic text-black font-normal mb-4"><span class="text-sm font-bold italic">NOTE: </span>(All fields that have asterisk required value)</p>
                            
                                <h3 class="text-lg font-medium text-gray-800 text-left">-Personal Information-</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <label for="firstName" class="block text-sm font-medium text-gray-600">First Name:  <span class="text-red-500">*</span></label>
                                        <input type="text" id="w_firstName" name="firstName" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="First name" required>
                                    
                                    </div>
                                    <div>
                                        <label for="middleName" class="block text-sm font-medium text-gray-600">Middle Name:  <span class="text-red-500">*</span></label>
                                        <input type="text" id="w_middleName" name="middleName" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Middle name" required>
                                    
                                    </div>
                                    <div>
                                        <label for="lastName" class="block text-sm font-medium text-gray-600">Last Name:  <span class="text-red-500">*</span></label>
                                        <input type="text" id="w_lastName" name="lastName" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Last name" required>
                                    
                                    </div>

                                    <div>
                                        <label for="suffixes" class="block text-sm font-medium text-gray-600">Suffix:</label>
                                        <select id="w_suffix" name="suffix_input" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500">
                                            <option value="none">- -</option>
                                            <option value="junior">JR</option>
                                            <option value="second">II</option>
                                            <option value="third">III</option>
                                            <option value="fourth">IV</option>
                                            <option value="fifth">V</option>
                                            <option value="sixth">VI</option>
                                        </select>
                                    </div>
                                
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <label for="birthday" class="block text-sm font-medium text-gray-600">Birth date: <span class="text-red-500">*</span></label>
                                        <input type="date" id="w_birthdate" name="birthdate" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Birth date" required>
                                        <p id="birthdateError" class="text-red-500 text-sm mt-1 hidden"></p>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const birthdateInput = document.getElementById('w_birthdate');
                                            const birthdateError = document.getElementById('birthdateError');
                                            
                                            // Calculate today's date and the minimum date (18 years ago)
                                            const today = new Date();
                                            const minDate = new Date(today);
                                            minDate.setFullYear(today.getFullYear() - 18);

                                            // Set the max date to today's date to prevent future dates
                                            birthdateInput.setAttribute('max', today.toISOString().split('T')[0]);
                                            birthdateInput.setAttribute('min', '1900-01-01'); // Broad min date, controlled by validation

                                            // Custom validation function to check age and future dates
                                            function validateAge() {
                                                const birthdateInputValue = birthdateInput.value;
                                                const birthdate = new Date(birthdateInputValue);

                                                // Reset the error message
                                                birthdateError.classList.add('hidden');
                                                birthdateError.textContent = "";

                                                if (!birthdateInputValue) return; // Exit if no date is selected

                                                // Check if the selected date is in the future
                                                if (birthdate > today) {
                                                    birthdateError.textContent = "Birth date cannot be in the future.";
                                                    birthdateError.classList.remove('hidden');
                                                    return;
                                                }

                                                // Calculate age based on selected date
                                                let age = today.getFullYear() - birthdate.getFullYear();
                                                const monthDifference = today.getMonth() - birthdate.getMonth();
                                                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
                                                    age--;
                                                }

                                                // Show error if age is less than 18
                                                if (age < 18) {
                                                    birthdateError.textContent = "Birth date is not valid. You must be at least 18 years old.";
                                                    birthdateError.classList.remove('hidden');
                                                }
                                            }

                                            // Trigger validation on input and change events
                                            birthdateInput.addEventListener('input', validateAge);
                                            birthdateInput.addEventListener('change', validateAge);
                                        });
                                    </script>

                                    <div>
                                        <label for="birthplace" class="block text-sm font-medium text-gray-600">Birth place:  <span class="text-red-500">*</span></label>
                                        <input type="text" id="w_birthplace" name="birthplace" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Birth place" required>
                                    
                                    </div>
                                    <div>
                                        <label for="civilstatus" class="block text-sm font-medium text-gray-600">Civil Status:  <span class="text-red-500">*</span></label>
                                        <select id="w_civilstatus" name="civilstatus" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                                            <option value="" disabled selected>Select your civil status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Windowed</option>
                                        </select>
                                    
                                    </div>
                                </div>
                            </div>

                            <!-- Contact information section -->
                            <div class="p-5">
                                <h3 class="text-lg font-medium text-gray-800 text-left">-Contact Information-</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-600">Email:  <span class="text-red-500">*</span></label>
                                        <input type="email" id="w_email" name="Email" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Email" required>
                                    </div>

                                    <div>
                                        <label for="contactNo" class="block text-sm font-medium text-gray-600">Contact Number: <span class="text-red-500">*</span></label>
                                        <input type="text" id="w_contactNo" name="contactNumber" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Contact Number" maxlength="11" required>
                                        <p id="contactError" class="text-red-500 text-sm mt-1 hidden">Please enter a valid 11-digit Philippine mobile number starting with 09.</p>
                                    </div>

                                    <script>
                                        document.getElementById('w_contactNo').addEventListener('input', function() {
                                            let contactNoInput = this.value;
                                            
                                            // Only allow numeric characters and limit to 11 digits
                                            contactNoInput = contactNoInput.replace(/\D/g, '').slice(0, 11); // Remove non-numeric and limit to 11 digits

                                            // Update the input value with the cleaned value
                                            this.value = contactNoInput;

                                            const contactError = document.getElementById('contactError');

                                            // Check if the input is exactly 11 digits and starts with '09'
                                            const isValid = /^\d{11}$/.test(contactNoInput) && contactNoInput.startsWith('09');

                                            // Show error if invalid, else hide the error
                                            if (!isValid) {
                                                contactError.classList.remove('hidden');
                                            } else {
                                                contactError.classList.add('hidden');
                                            }
                                        });
                                    </script>

                                    <div>
                                        <label for="telephoneNo" class="block text-sm font-medium text-gray-600">Telephone Number: <span class="text-red-500 italic text-black text-xs">(Leave blank if no landline number)</span></label>
                                        <input type="text" id="w_telephoneNum" name="telephoneNumber" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Telephone Number" maxlength="15">
                                        <p id="telephoneError" class="text-red-500 text-sm mt-1 hidden">Please enter a valid Philippine telephone number with the correct format.</p>
                                    </div>

                                    <script>
                                        document.getElementById('w_telephoneNum').addEventListener('input', function() {
                                            const telephoneInput = this.value;
                                            const telephoneError = document.getElementById('telephoneError');

                                            // If the field is empty, hide the error message
                                            if (telephoneInput === '') {
                                                telephoneError.classList.add('hidden');
                                                return;
                                            }

                                            // Strip out any non-digit characters to process the number
                                            let formattedInput = telephoneInput.replace(/\D/g, '');

                                            // Automatically insert dashes as needed (for formatting)
                                            if (formattedInput.length > 10) {
                                                formattedInput = formattedInput.slice(0, 10); // Limit to 10 digits (max allowed)
                                            }

                                            // Apply formatting: +63 (Area Code) (7-9 digits)
                                            if (formattedInput.length <= 3) {
                                                formattedInput = formattedInput.replace(/(\d{1,3})/, "+63 $1");  // Format the country code +63
                                            } else if (formattedInput.length <= 5) {
                                                formattedInput = formattedInput.replace(/(\d{1,3})(\d{1,2})/, "+63 ($1) $2"); // Add area code
                                            } else {
                                                formattedInput = formattedInput.replace(/(\d{1,3})(\d{1,2})(\d{1,7})/, "+63 ($1) $2-$3"); // Add main number
                                            }

                                            // Set the formatted input back to the field
                                            this.value = formattedInput;

                                            // Format: +63 (Area Code) (7-9 digit number), including both mobile and landline types
                                            const regex = /^\+63(\d{1,2})\s?(\d{7,9})$/; // Updated regex to match format with spaces

                                            // Check if the telephone number matches the valid format
                                            if (!regex.test(formattedInput)) {
                                                telephoneError.textContent = "Please enter a valid Philippine telephone number with the correct format.";
                                                telephoneError.classList.remove('hidden');
                                            } else {
                                                telephoneError.classList.add('hidden');
                                            }
                                        });
                                    </script>

                                </div>

                                <!-- Permanent Address Section -->
                                <div class="mt-4">
                                    <h4 class="text-md font-semibold text-gray-700">Permanent Address<span class="text-red-500">*</span></h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="perm_house_number" class="block text-sm font-medium text-gray-600">House Number:</label>
                                            <input type="text" id="perm_house_number" name="permHouseNumber" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="House Number" oninput="copyToCurrent('perm_house_number', 'current_house_number')">
                                        </div>
                                        <div>
                                            <label for="perm_street" class="block text-sm font-medium text-gray-600">Street:</label>
                                            <input type="text" id="perm_street" name="permStreet" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="Street" oninput="copyToCurrent('perm_street', 'current_street')">
                                        </div>
                                        <div>
                                            <label for="perm_barangay" class="block text-sm font-medium text-gray-600">Barangay: <span class="text-red-500">*</span></label>
                                            <input type="text" id="perm_barangay" name="permBarangay" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="Barangay" required oninput="copyToCurrent('perm_barangay', 'current_barangay')">
                                        </div>
                                        <div>
                                            <label for="perm_city" class="block text-sm font-medium text-gray-600">City:<span class="text-red-500">*</span></label>
                                            <input type="text" id="perm_city" name="permCity" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="City" required oninput="copyToCurrent('perm_city', 'current_city')">
                                        </div>
                                        <div>
                                            <label for="perm_province" class="block text-sm font-medium text-gray-600">Province:<span class="text-red-500">*</span></label>
                                            <input type="text" id="perm_province" name="permProvince" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="Province" required oninput="copyToCurrent('perm_province', 'current_province')">
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Address Section with Copy Button -->
                                <div class="mt-4">
                                    <h4 class="text-md font-semibold text-gray-700">Current Address <span class="text-red-500">*</span>
                                        <button 
                                            type="button" 
                                            onclick="copyPermanentToCurrentAddress()" 
                                            class="ml-2 px-2 py-1 text-xs text-white bg-blue-500 hover:bg-blue-600 rounded">
                                            Copy Permanent Address
                                        </button>
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="current_house_number" class="block text-sm font-medium text-gray-600">House Number:</label>
                                            <input type="text" id="current_house_number" name="currentHouseNumber" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="House Number">
                                        </div>
                                        <div>
                                            <label for="current_street" class="block text-sm font-medium text-gray-600">Street:</label>
                                            <input type="text" id="current_street" name="currentStreet" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="Street">
                                        </div>
                                        <div>
                                            <label for="current_barangay" class="block text-sm font-medium text-gray-600">Barangay:<span class="text-red-500">*</span></label>
                                            <input type="text" id="current_barangay" name="currentBarangay" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="Barangay" required>
                                        </div>
                                        <div>
                                            <label for="current_city" class="block text-sm font-medium text-gray-600">City:<span class="text-red-500">*</span></label>
                                            <input type="text" id="current_city" name="currentCity" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="City" required>
                                        </div>
                                        <div>
                                            <label for="current_province" class="block text-sm font-medium text-gray-600">Province:<span class="text-red-500">*</span></label>
                                            <input type="text" id="current_province" name="currentProvince" class="w-full mt-2 p-2 border rounded-md border-gray-300" placeholder="Province" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function copyPermanentToCurrentAddress() {
                                    document.getElementById('current_house_number').value = document.getElementById('perm_house_number').value;
                                    document.getElementById('current_street').value = document.getElementById('perm_street').value;
                                    document.getElementById('current_barangay').value = document.getElementById('perm_barangay').value;
                                    document.getElementById('current_city').value = document.getElementById('perm_city').value;
                                    document.getElementById('current_province').value = document.getElementById('perm_province').value;
                                }
                            </script>

                                <!--Governement information-->
                                <div class="p-5">
                                    <h3 class="text-lg font-medium text-gray-800 text-left">-Government Identification-</h3>
                                    
                                    <!-- SSS ID -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="sssid" class="block text-sm font-medium text-gray-600">SSS ID:</label>
                                            <input type="text" id="w_sss" name="sssId" value="{{ old('sssId') }}" class="w-full mt-2 p-2 border rounded-md @error('sssId') border-red-500 @enderror" placeholder="00-0000000-0" maxlength="12" >
                                            <span class="text-gray-500 text-sm italic">Leave blank if not available.</span>
                                            <p id="sssError" class="text-red-500 text-sm hidden">Continue typing until the designated format are met.  (00-0000000-0).</p>
                                            
                                        </div>
                                    </div>

                                    <!-- PhilHealth ID -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="philhealthid" class="block text-sm font-medium text-gray-600">PhilHealth ID:</label>
                                            <input type="text" id="w_philhealth" name="philhealthId" value="{{ old('philhealthId')}}" class="w-full mt-2 p-2 border rounded-md @error('philhealthId') border-gray-300 @enderror " placeholder="00-00000000-0" maxlength="13">
                                            <span class="text-gray-500 text-sm italic">Leave blank if not available.</span>
                                            <p id="philhealthError" class="text-red-500 text-sm hidden">Continue typing until the designated format are met.  (00-00000000-0).</p>
                                        
                                        </div>
                                    </div>

                                    <!-- PAGIBIG -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="Pagibig" class="block text-sm font-medium text-gray-600">PAGIBIG:</label>
                                            <input type="text" id="w_pagibig" name="Pagibig" value="{{ old('Pagibig') }}" class="w-full mt-2 p-2 border rounded-md @error('Pagibig') border-gray-300 @enderror" placeholder="0000-0000-0000" maxlength="14">
                                            <span class="text-gray-500 text-sm italic">Leave blank if not available.</span>
                                            <p id="pagibigError" class="text-red-500 text-sm hidden">Continue typing until the designated format are met.  (0000-0000-0000).</p>
                                        
                                        </div>
                                    </div>

                                    <!-- TIN Number -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="TIN" class="block text-sm font-medium text-gray-600">TIN Number:</label>
                                            <input type="text" id="w_tin" name="TINno" value="{{ old('TINno') }}" class="w-full mt-2 p-2 border rounded-md @error('TINno') border-gray-300 @enderror" placeholder="000-000-000-000" maxlength="15" >
                                            <span class="text-gray-500 text-sm italic">Leave blank if not available.</span>
                                            <p id="tinError" class="text-red-500 text-sm hidden">Continue typing until the designated format are met.  (000-000-000-000).</p>
                                        
                                        </div>
                                    </div>
                                </div>
                                <!--id formats-->
                                <script>
                                    // Input mask functions for each format
                                    function applySSSMask(input) {
                                        input.value = input.value
                                            .replace(/\D/g, '') // Remove non-digit characters
                                            .replace(/^(\d{2})(\d{0,7})(\d{0,1})/, '$1-$2-$3') // Apply mask format
                                            .slice(0, 12); // Limit length
                                    }

                                    function applyPhilHealthMask(input) {
                                        input.value = input.value
                                            .replace(/\D/g, '')
                                            .replace(/^(\d{2})(\d{0,8})(\d{0,1})/, '$1-$2-$3')
                                            .slice(0, 13);
                                    }

                                    function applyPagibigMask(input) {
                                        input.value = input.value
                                            .replace(/\D/g, '')
                                            .replace(/^(\d{4})(\d{0,4})(\d{0,4})/, '$1-$2-$3')
                                            .slice(0, 14);
                                    }

                                    function applyTINMask(input) {
                                        input.value = input.value
                                            .replace(/\D/g, '')
                                            .replace(/^(\d{3})(\d{0,3})(\d{0,3})(\d{0,3})/, '$1-$2-$3-$4')
                                            .slice(0, 15);
                                    }

                                    // Event listeners to apply masks on input
                                    document.getElementById('w_sss').addEventListener('input', function () {
                                        applySSSMask(this);
                                        validatePattern(this, /^\d{2}-\d{7}-\d{1}$/, 'sssError');
                                    });

                                    document.getElementById('w_philhealth').addEventListener('input', function () {
                                        applyPhilHealthMask(this);
                                        validatePattern(this, /^\d{2}-\d{8}-\d{1}$/, 'philhealthError');
                                    });

                                    document.getElementById('w_pagibig').addEventListener('input', function () {
                                        applyPagibigMask(this);
                                        validatePattern(this, /^\d{4}-\d{4}-\d{4}$/, 'pagibigError');
                                    });

                                    document.getElementById('w_tin').addEventListener('input', function () {
                                        applyTINMask(this);
                                        validatePattern(this, /^\d{3}-\d{3}-\d{3}-\d{3}$/, 'tinError');
                                    });

                                    // Function to validate the pattern and show error message
                                    function validatePattern(input, pattern, errorElementId) {
                                        const regex = new RegExp(pattern);
                                        const errorElement = document.getElementById(errorElementId);

                                        if (!regex.test(input.value)) {
                                            errorElement.classList.remove('hidden');
                                            input.classList.add('border-red-500');
                                            input.classList.remove('border-gray-300');
                                        } else {
                                            errorElement.classList.add('hidden');
                                            input.classList.remove('border-red-500');
                                            input.classList.add('border-gray-300');
                                        }
                                    }
                                </script>

                            <!-- Employment details workhistory -->
                            <div class="p-5">
                                <h3 class="text-lg font-medium text-gray-800 text-left">-Employment Details-</h3>

                                <div class="flex flex-col gap-3">
                                    <p class="text-sm italic text-black font-normal"><span class="text-sm font-bold">NOTE: </span>(Recent Employment Only)</p>
                                    <p class="text-sm italic text-black font-normal">(Choose first the work history status of the employee, if the Employee has any experience)</p>
                                    
                                    <!-- Identify the work status history of the employee -->
                                    <div class="flex flex-row gap-3">
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="full_time" name="employment_type" value="Full-time" class="mr-2" onclick="toggleFields()">
                                            <label for="full_time" class="text-sm text-gray-700 font-semibold">Full-time</label>
                                        </div>
                                        
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="part_time" name="employment_type" value="Part-time" class="mr-2" onclick="toggleFields()">
                                            <label for="part_time" class="text-sm text-gray-700 font-semibold">Part-time</label>
                                        </div>
                                        
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="fresh_graduate" name="employment_type" value="Fresh Graduate" class="mr-2" onclick="toggleFields()">
                                            <label for="fresh_graduate" class="text-sm text-gray-700 font-semibold">Fresh Graduate</label>
                                        </div>
                                    </div>

                                    <!-- Employment details fields -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2" id="employmentDetails">
                                        <div>
                                            <label for="companyName" class="block text-sm font-medium text-gray-600">Company Name: </label>
                                            <input type="text" id="w_companyname" name="companyname" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Company Name" disabled>
                                        </div>

                                        <div>
                                            <label for="jobPosition" class="block text-sm font-medium text-gray-600">Job Position: </label>
                                            <input type="text" id="w_jobposition" name="jobposition" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Job Position" disabled>
                                        </div>

                                        <div>
                                            <label for="dateHired" class="block text-sm font-medium text-gray-600">Date Hired: </label>
                                            <input type="date" id="w_datehired" name="datehired" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" disabled onchange="validateEmploymentDuration()">
                                        </div>

                                        <div>
                                            <label for="dateEnd" class="block text-sm font-medium text-gray-600">Date End: </label>
                                            <input type="date" id="w_dateend" name="dateend" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" disabled onchange="validateEmploymentDuration()">
                                            <span id="dateEndError" class="text-red-500 text-sm mt-1 hidden">Invalid duration of employment</span>
                                        </div>
                                    </div>

                                    <script>
                                        function toggleFields() {
                                            const freshGraduateChecked = document.getElementById('fresh_graduate').checked;
                                            const employmentDetails = document.getElementById('employmentDetails');
                                            const inputs = employmentDetails.querySelectorAll('input');

                                            if (freshGraduateChecked) {
                                                employmentDetails.classList.add('hidden');
                                                inputs.forEach(input => {
                                                    input.value = ''; // Clear previous values if any
                                                    input.disabled = true; // Disable inputs
                                                });
                                            } else {
                                                employmentDetails.classList.remove('hidden');
                                                inputs.forEach(input => {
                                                    input.disabled = false; // Enable inputs
                                                });
                                            }
                                        }

                                        function validateEmploymentDuration() {
                                            const dateHired = document.getElementById('w_datehired').value;
                                            const dateEnd = document.getElementById('w_dateend').value;
                                            const errorMsg = document.getElementById('dateEndError');

                                            if (dateHired && dateEnd) {
                                                const hiredDate = new Date(dateHired);
                                                const endDate = new Date(dateEnd);

                                                // Calculate the difference in months
                                                const monthsDifference = (endDate.getFullYear() - hiredDate.getFullYear()) * 12 + (endDate.getMonth() - hiredDate.getMonth());

                                                if (monthsDifference < 1 || (monthsDifference === 1 && endDate.getDate() < hiredDate.getDate())) {
                                                    // Show error if duration is less than 1 month
                                                    errorMsg.classList.remove('hidden');
                                                } else {
                                                    // Hide error if duration is valid
                                                    errorMsg.classList.add('hidden');
                                                }
                                            } else {
                                                // Hide error if one of the dates is missing
                                                errorMsg.classList.add('hidden');
                                            }
                                        }

                                        // Disable fields by default
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const inputs = document.querySelectorAll('#employmentDetails input');
                                            inputs.forEach(input => {
                                                input.disabled = true; // Start with inputs disabled
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            <!-- Educational Background -->
                            <div class="p-5">
                                <h3 class="text-lg font-medium text-gray-800 text-left">-Education Attainment-</h3>

                                <div class="flex flex-col gap-3">
                                    <p class="text-sm italic text-black font-normal"><span class="text-sm font-bold">NOTE: </span>(Input the highest educational attainment of the employee)</p>
                                    <p class="text-sm italic text-black font-normal">(Choose first the highest educational attainment)</p>

                                    <!-- Identify the education status that the employee attained -->
                                    <div class="flex flex-row flex-wrap gap-4">
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="grade_school" name="education_type" value="Grade School" class="mr-2" onclick="toggleEducationFields(this)">
                                            <label for="grade_school" class="text-sm text-gray-700 font-semibold">Grade School</label>
                                        </div>
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="high_school" name="education_type" value="High School" class="mr-2" onclick="toggleEducationFields(this)">
                                            <div class="flex flex-col">
                                                <label for="high_school" class="text-sm text-gray-700 font-semibold">High School</label>
                                                <p class="text-xs italic text-black font-normal">(For Old Curriculums)</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="senior_high" name="education_type" value="Senior High School" class="mr-2" onclick="toggleEducationFields(this)">
                                            <div class="flex flex-col">
                                                <label for="senior_high" class="text-sm text-gray-700 font-semibold">Senior High School</label>
                                                <p class="text-xs italic text-black font-normal">(For New Curriculums)</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="undergraduate" name="education_type" value="Under Graduate" class="mr-2" onclick="toggleEducationFields(this)">
                                            <label for="undergraduate" class="text-sm text-gray-700 font-semibold">Under Graduate</label>
                                        </div>
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="vocational" name="education_type" value="Vocational" class="mr-2" onclick="toggleEducationFields(this)">
                                            <label for="vocational" class="text-sm text-gray-700 font-semibold">Vocational</label>
                                        </div>
                                        <div class="flex flex-row items-center">
                                            <input type="radio" id="college" name="education_type" value="College" class="mr-2" onclick="toggleEducationFields(this)">
                                            <label for="college" class="text-sm text-gray-700 font-semibold">College</label>
                                        </div>
                                    </div>

                                    <!-- Educational fields -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2" id="educationDetails">
                                        <div>
                                            <label for="schoolName" class="block text-sm font-medium text-gray-600">School Name: </label>
                                            <input type="text" id="school_name" name="schoolname" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="University, School, Academy, Etc." disabled required>
                                        </div>

                                        <!-- Program Field - input and select (one visible at a time) -->
                                        <div>
                                            <label for="program" class="block text-sm font-medium text-gray-600">Program: </label>
                                            <!-- Input field for Program -->
                                            <input type="text" id="program_input" name="program" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Program" disabled required>

                                            <!-- Select dropdown for Program, hidden by default -->
                                            <select id="program_select" name="program_select" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" style="display: none;" disabled required>
                                                <option value="" disabled selected>Choose an option</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function toggleEducationFields(selectedRadio) {
                                    const programInput = document.getElementById("program_input");
                                    const programSelect = document.getElementById("program_select");

                                    // Enable the School Name field
                                    document.getElementById("school_name").disabled = false;

                                    // Reset the Program fields
                                    programInput.style.display = "none";
                                    programInput.disabled = true;
                                    programSelect.style.display = "none";
                                    programSelect.disabled = true;
                                    programSelect.innerHTML = "<option value='' disabled selected>Choose an option</option>";

                                    // Update fields based on selected education type
                                    switch (selectedRadio.value) {
                                        case "Grade School":
                                            programSelect.style.display = "block";
                                            programSelect.disabled = false;
                                            ["Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"].forEach(grade => {
                                                const option = new Option(grade, grade);
                                                programSelect.add(option);
                                            });
                                            break;
                                        case "High School":
                                            programSelect.style.display = "block";
                                            programSelect.disabled = false;
                                            ["1st Year", "2nd Year", "3rd Year", "4th Year"].forEach(year => {
                                                const option = new Option(year, year);
                                                programSelect.add(option);
                                            });
                                            break;
                                        case "Senior High School":
                                            programSelect.style.display = "block";
                                            programSelect.disabled = false;
                                            ["GA (General Academic)", "STEM (Science, Technology, Engineering, and Mathematics)", "HUMMS (Humanities and Social Sciences)", "ABM (Accountancy, Business, and Management)" ,"Arts and Design",
                                            "Sports Track","TVL (Technical Vocational Livelihood)", "AFA (Agricultural-Fishery Arts)","HE (Home Economics)","IA (Industrial Arts)", "ICT (Information Communication Technology)"].forEach(strand => {
                                                const option = new Option(strand, strand);
                                                programSelect.add(option);
                                            });
                                            break;
                                        case "Under Graduate":
                                        case "College":
                                        case "Vocational": // Handle Vocational
                                            programInput.style.display = "block";
                                            programInput.disabled = false;
                                            break;
                                    }
                                }
                            </script>

                        <!-- Drag-and-Drop Area for Documents and Images -->
                        <div class="ml-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">
                                Upload scanned files (Documents, Images) <span class="text-sm italic font-normal">*if available</span>
                            </label>
                            <div 
                                id="drop-area" 
                                class="w-full border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer"
                                ondrop="handleDrop(event)" 
                                ondragover="handleDragOver(event)" 
                                ondragleave="handleDragLeave(event)">
                                <p class="text-gray-500">Drag and drop files here, or click to select files</p>
                                <input 
                                    id="file_input" 
                                    type="file" 
                                    name="documents[]" 
                                    multiple 
                                    accept=".pdf,.doc,.docx,image/*" 
                                    class="hidden"
                                    onchange="handleFiles(this.files)">
                            </div>
                            <div id="file-list" class="mt-3 text-sm text-gray-600"></div>
                        </div>

                        <script>
                            const dropArea = document.getElementById('drop-area');
                            const fileInput = document.getElementById('file_input');
                            const fileList = document.getElementById('file-list');
                            const dataTransfer = new DataTransfer(); // Create a new DataTransfer object

                            // Function to handle the dragover event
                            function handleDragOver(event) {
                                event.preventDefault();
                                dropArea.classList.add('border-blue-500');
                            }

                            // Function to handle dragleave event
                            function handleDragLeave(event) {
                                event.preventDefault();
                                dropArea.classList.remove('border-blue-500');
                            }

                            // Function to handle drop event
                            function handleDrop(event) {
                                event.preventDefault();
                                dropArea.classList.remove('border-blue-500');
                                const files = event.dataTransfer.files;
                                handleFiles(files);
                            }

                            // Function to display files in the file list and add to DataTransfer
                            function handleFiles(files) {
                                for (let i = 0; i < files.length; i++) {
                                    const file = files[i];
                                    dataTransfer.items.add(file); // Add file to DataTransfer
                                    updateFileList(file); // Update the file list display
                                }
                                fileInput.files = dataTransfer.files; // Set the input's files to the DataTransfer files
                            }

                            // Function to update the file list display
                            function updateFileList(file) {
                                // Create a new list item for each file
                                const listItem = document.createElement('div');
                                listItem.classList.add('flex', 'items-center', 'py-1');

                                // Display file name
                                const fileName = document.createElement('span');
                                fileName.textContent = file.name;

                                // Remove button
                                const removeButton = document.createElement('button');
                                removeButton.textContent = 'Remove';
                                removeButton.classList.add('text-red-500', 'ml-2');
                                removeButton.onclick = () => removeFile(file, listItem);

                                // Append elements to the list item
                                listItem.appendChild(fileName);
                                listItem.appendChild(removeButton);
                                fileList.appendChild(listItem);
                            }

                            // Function to remove a file
                            function removeFile(file, listItem) {
                                // Find and remove the file from DataTransfer
                                for (let i = 0; i < dataTransfer.items.length; i++) {
                                    if (dataTransfer.items[i].getAsFile() === file) {
                                        dataTransfer.items.remove(i);
                                        break;
                                    }
                                }

                                // Update file input files
                                fileInput.files = dataTransfer.files;

                                // Remove the list item from the display
                                listItem.remove();
                            }

                            // Clicking the drop area to open file input dialog
                            dropArea.addEventListener('click', () => fileInput.click());

                            // When selecting files manually, add them to DataTransfer
                            fileInput.addEventListener('change', () => {
                                handleFiles(fileInput.files);
                            });
                        </script>


                        <!-- Submit Button -->
                        <div class="flex mt-7">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Submit
                            </button>

                        </div>
                    </form>
                                    

                    @if (session('success'))
                        <div class="text-green-600 z-50">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="text-red-500 z-50">{{ session('error') }}</div>
                    @endif

                    </div>
                </div>
    </section>

    <!--performance form section-->
    <section id="performance-form-content" class="section hidden w-full h-screen p-7">
        <!--whole section-->
        <div class="w-full h-auto p-2 flex flex-col gap-2">
            <div class="w-full flex flex-row items-center p-3 gap-5">
               <button  class=" hover:scale-125 transition duration-200">
                    <img src="{{URL('images/goback.png')}}" alt="" data-light-src="{{URL('images/goback.png')}}" data-dark-src="{{URL('images/goback_dark.png')}}" class="w-10" onclick="navigateTo('performance-evaluation', this)">
                </button>
            </div>

            <!--employee evaluation information-->
            <div class="w-full p-2">
                <form action="{{ route('admin.submit.evaluation') }}" method="POST" class="space-x-3 flex flex-col gap-3">
                    @csrf
                    
                    <!--Performance Eval employee information-->
                    <div class="w-full flex flex-row">
                        <!-- First column -->
                        <div class="w-full flex flex-col gap-2">
                            <div class="flex flex-row items-center gap-2">
                                <label for="department" class="text-medium font-normal text-black dark:text-white">
                                    Department: <span class="text-red-500">*</span>
                                </label>
                                <select id="department" name="department" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md" onchange="fetchEmployees(this.value)" required>
                                    <option value="" disabled selected>Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_ID }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Modal for Employees Table -->
                            <div id="employeeModalforPerformance" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                <div class="bg-white dark:bg-gray-800 w-[60vh] max-h-[70vh] overflow-y-auto p-4 rounded-md">
                                    <h3 class="text-2xl font-semibold mb-4">Choose an Employee:</h3>
                                    <table class="w-full table-auto border-collapse border border-gray-300">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="border p-2 w-24 ">Employee ID</th>
                                                <th class="border p-2">Name</th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeTableBody">
                                            <!-- Dynamic rows will be added here -->
                                        </tbody>
                                    </table>
                                    <button onclick="closeModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
                                </div>
                            </div>

                            <!-- Hidden field for selected employee name -->
                            <div class="w-full flex flex-row items-center gap-2">
                                <label for="name" class="text-medium font-normal text-black dark:text-white">Name of Employee:</label>
                                <input type="text" id="selectedEmployeeName" class="w-[30vh] p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md" placeholder="Choose a department first...." readonly>
                            </div>

                            <input type="hidden" id="employee_ID" name="employee_ID">

                            <div class="flex flex-row items-center gap-2">
                                <label for="period" class="text-medium font-normal text-black dark:text-white">Period Covered:</label>
                                <div class="flex flex-col gap-2">
                                    <span class="flex flex-row items-center gap-2">
                                        <p class="text-[14px] font-normal italic text-black dark:text-white opacity-60">Start Date: <span class="text-red-500">*</span></p>
                                        <input type="date" name="evaluation_start" id="start-period" class="w-48 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md" required>
                                        <button type="button" onclick="setToday()" class="bg-blue-500 text-white px-2 py-1 rounded-md">Get date today</button>
                                    </span>
                                    <span class="flex flex-row items-center">
                                        <p class="text-[14px] font-normal italic text-black dark:text-white opacity-60">End Date: <span class="text-red-500">*</span></p>
                                        <input type="date" name="evaluation_end" id="end-period" class="w-48 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md" required>
                                    </span>
                                </div>
                            </div>
                            <script>
                                  function setToday() {
                                        const today = new Date();
                                        const startDate = formatDate(today); // Format today's date
                                        const endDate = new Date(today); // Create a new date instance based on today
                                        endDate.setFullYear(today.getFullYear() + 1); // Add one year to today's date

                                        // Set the values of the start and end date inputs
                                        document.getElementById('start-period').value = startDate;
                                        document.getElementById('end-period').value = formatDate(endDate);
                                    }

                                    function formatDate(date) {
                                        const year = date.getFullYear();
                                        const month = String(date.getMonth() + 1).padStart(2, '0');
                                        const day = String(date.getDate()).padStart(2, '0');
                                        return `${year}-${month}-${day}`; // Format date as yyyy-mm-dd for input[type=date]
                                    }

                                    // Update end date whenever the user selects a start date
                                    document.getElementById('start-period').addEventListener('change', function () {
                                        const startDate = new Date(this.value);
                                        if (!isNaN(startDate)) {
                                            startDate.setFullYear(startDate.getFullYear() + 1);
                                            document.getElementById('end-period').value = formatDate(startDate);
                                        }
                                    });
                            </script>
                        </div>

                        <!-- Second column -->
                        <div class="w-full flex flex-col gap-2">
                            <div class="flex flex-row items-center gap-2">
                                <label for="position" class="text-medium font-normal text-black dark:text-white">
                                    Job Title / Position: 
                                </label>
                                <input type="text" id="position" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Position...">
                            </div>
                            
                            <div class="w-full flex flex-row items-center gap-2">
                                <label for="hired-date" class="text-medium font-normal text-black dark:text-white">
                                    Date hired: <span class="text-red-500">*</span>
                                </label>
                                <label id="hired-date" class="w-72 p-1 text-black dark:text-white ">
                                    <!-- This will be populated with the hired date -->
                                </label>
                            </div>
                            <div class="flex flex-row items-center gap-2">
                                <label for="evaluate-by" class="text-medium font-normal text-black dark:text-white">
                                    Evaluated by: <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="evaluate-by" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md" placeholder="Evaluated by..." required>
                                <button type="button" onclick="insertEvaluatorName()" class="p-1 bg-blue-500 text-white rounded-md">Insert Your Name</button>
                            </div>

                            <script>
                                function insertEvaluatorName() {
                                    // Get the user's name from the Laravel Blade syntax
                                    const userName = "{{ Auth::user()->employeeInfo->first_name }} {{ Auth::user()->employeeInfo->last_name }}";

                                    // Set the value of the evaluated by input field
                                    document.getElementById('evaluate-by').value = userName;
                                }

                                // Your existing functions here (fetchEmployees, openModal, closeModal, selectEmployee)
                            </script>
                            
                            <div class="flex flex-row items-center gap-2">
                                <label for="evaluation-type" class="text-medium font-normal text-black dark:text-white">Evaluation for: <span class="text-red-500">*</span></label>
                                <select id="evaluation-type" name="evaluation_type" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md" required>
                                    <option value="" disabled selected>Select Evaluation Type</option>
                                    <option value="salary_increase">Salary Increase</option>
                                    <option value="regularization">Regularization</option>
                                </select>
                            </div>
                        </div>
                        <script>
                                function fetchEmployees(departmentId) {
                                    if (!departmentId) return;

                                    fetch(`/employees/${departmentId}`)
                                        .then(response => response.json())
                                        .then(employees => {
                                            let tableBody = document.getElementById('employeeTableBody');
                                            tableBody.innerHTML = ''; // Clear any previous data

                                            employees.forEach(employee => {
                                                let suffix = employee.suffix && employee.suffix.toLowerCase() !== 'none' ? ` ${employee.suffix}` : '';
                                                let row = document.createElement('tr');
                                                 row.classList.add('cursor-pointer', 'hover:bg-gray-200');
                                                row.innerHTML = `
                                                    <td class="border p-2 w-24">${employee.employee_ID}</td>
                                                    <td class="border p-2">${employee.first_name} ${employee.middle_name} ${employee.last_name}${suffix}</td>
                                                `;
                                                row.addEventListener('click', () => selectEmployee(employee));
                                                tableBody.appendChild(row);
                                            });

                                            openModal();
                                        })
                                        .catch(error => console.error('Error fetching employees:', error));;
                                    }

                                    function openModal() {
                                        document.getElementById('employeeModalforPerformance').classList.remove('hidden');
                                    }

                                    function closeModal() {
                                        document.getElementById('employeeModalforPerformance').classList.add('hidden');
                                    }
                                    function selectEmployee(employee) {
                                        let suffix = employee.suffix && employee.suffix.toLowerCase() !== 'none' ? ` ${employee.suffix}` : '';
                                        document.getElementById('selectedEmployeeName').value = `${employee.first_name} ${employee.middle_name} ${employee.last_name}${suffix}`;
                                        
                                        // Set the hired date label
                                        document.getElementById('hired-date').innerText = employee.start_date; // Set the hired date

                                        // Set the employee ID
                                        document.getElementById('employee_ID').value = employee.employee_ID; // Set the employee ID

                                        closeModal();
                                    }
                        </script>
                    </div>

                      <!--evaluation form-->   
                    <div class="w-full bg-white dark:bg-gray-300 md:h-[50vh] h-[calc(50vh-100px)] rounded-lg overflow-y-auto p-4 shadow-2xl">
                        <div class="w-full flex flex-col gap-2">
                            <div class="w-full flex flex-row items-center">
                                <h1 class="text-xl font-bold text-black ">PERFORMANCE EVALUATION</h1>
                                <!--performance rating scale-->
                                <button  id="helpButton" class="w-10 h-10 ml-auto hover:scale-110 transition duration-200">
                                    <img src="{{URL('images/help_info.png')}}" alt="" class="w-7 h-7">
                                </button>
                            </div>

                            <div class="border-b w-full border-gray-700"></div>
                            
                            <!--eval form inside-->
                            <div class="w-full bg-white flex flex-col p-4 overflow-y-auto justify-center rounded-lg">
                                <h1 class="text-xl font-bold text-black mb-3">Factors:</h1>

                                <!--evaluation form part A-->
                                <table>

                                    <!--part A-->
                                    <thead class="w-full bg-gray-400">
                                        <th class="w-full py-2 px-3 text-start">
                                            Part A : COMPETENCY
                                        </th>
                                        <th class="w-full py-2 px-[30vh] text-center">
                                            GRADE
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    JOB KNOWLEDGE
                                                </h3>
                                                <p class="text-sm font-normal">
                                                    Exhibits job-relevant knowledge and skills needed perform the duties
                                                    and responsibilities required for the position.
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-1" name="eval-1" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    DEPENDABILITY
                                                </h3>
                                                <p class="text-sm font-normal">
                                                Adheres to work schedul consistently and willing to accept additional assignments when so needed.
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-2" name="eval-2" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    PRODUCTIVITY
                                                </h3>
                                                <p class="text-sm font-normal">
                                                    Considers how the person uses available working, plans and prioritizes work and accomplishes goals and 
                                                    completes assigments on schedule.
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-3" name="eval-3"  class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    QUALITY OF WORK
                                                </h3>
                                                <p class="text-sm font-normal">
                                                    Work quality refers to effort that consistently achieves desired outcomes with a minimum of avoidable errors and problems.                                            
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-4" name="eval-4"  class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                    </tbody>

                                    <!--part B-->
                                    <thead class="w-full bg-gray-400">
                                        <th class="w-full py-2 px-3 text-start">
                                            Part B : WORK ATTITUDE
                                        </th>
                                        <th class="w-full py-2 px-[30vh] text-center">
                                            GRADE
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    TEAMWORK
                                                </h3>
                                                <p class="text-sm font-normal">
                                                    Works well with fellow employees and superiors in meeting teams's deliverable and works harmoniously.                                            
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-5" name="eval-5"  class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    WORK VALUES
                                                </h3>
                                                <p class="text-sm font-normal">
                                                Adheres to professionalism and with high level of maturity and emotional quotient including compliance to Code of Conduct.                                            
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-6" name="eval-6"  class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                    </tbody>

                                    <!--part C-->
                                    <thead class="w-full bg-gray-400">
                                        <th class="w-full py-2 px-3 text-start">
                                            Part C : ATTENDANCE AND PERSONALITY
                                        </th>
                                        <th class="w-full py-2 px-[30vh] text-center">
                                            GRADE
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    ATTENDANCE
                                                </h3>
                                                <p class="text-sm font-normal">
                                                With minimal or no absences within the period of evaluation.                                          
                                                </p>
                                                </td>

                                                <td class="py-3 text-center">
                                                    <input type="text" id="eval-7" name="eval-7" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                                </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    PUNCTUALITY
                                                </h3>
                                                <p class="text-sm font-normal">
                                                    With minimal or no record of tardiness within the period of evaluation.                                           
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-8" name="eval-8" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                <h3 class="text-medium font-bold mb-2">
                                                    PERSONAL APPEARANCE
                                                </h3>
                                                <p class="text-sm font-normal">
                                                    Well-groomed, clean and tidy. Demonstration pleasant, professional personality when dealing 
                                                    with customers, fellow employees and superiors.
                                                </p>
                                            </td>

                                            <td class="py-3 text-center">
                                                <input type="text" id="eval-9" name="eval-9" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5" oninput="validateInput(this)" required>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-3">
                                                

                                            <td class="py-3 text-center">
                                                <input type="text"  name="results" id="results" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="Result">
                                            </td>
                                        </tr>
                                    </tbody>

                                    <!--remarks part-->
                                    <thead class="w-full bg-gray-400">
                                        <th class="w-full py-2 px-3 text-start">
                                            REMARKS
                                        </th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-5 text-start ">
                                                <div class="flex flex-col">
                                                    <h1 class="text-medium font-bold">
                                                        1. Any Record of disciplinary action within the period of evaluation.
                                                    </h1>
                                                    <input type="text" id="comment-1" placeholder="Type here...." class="w-full py-3 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-5 text-start ">
                                                <div class="flex flex-col">
                                                    <h1 class="text-medium font-bold">
                                                        2. Notable performance/accomplishment within the period of evaluation.
                                                    </h1>
                                                    <input type="text" id="comment-2" placeholder="Type here...." class="w-full py-3 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-5 text-start ">
                                                <div class="flex flex-col">
                                                    <h1 class="text-medium font-bold">
                                                        3. Areas/skills that would need further improvement.
                                                    </h1>
                                                    <input type="text" id="comment-3" placeholder="Type here...." class="w-full py-3 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-5 text-start ">
                                                <div class="flex flex-col">
                                                    <h1 class="text-medium font-bold">
                                                        4. Comments from immediate Superior/Rater
                                                    </h1>
                                                    <input type="text" id="comment-4" placeholder="Type here...." class="w-full py-3 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-5 text-start ">
                                                <div class="flex flex-col">
                                                    <h1 class="text-medium font-bold">
                                                        5. Comments from employee evaluated/ratee
                                                    </h1>
                                                    <input type="text" id="comment-5" placeholder="Type here...." class="w-full py-3 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="w-full border-b border-gray-600">
                                            <td class="py-5 text-start ">
                                                <div class="flex flex-col">
                                                    <h1 class="text-medium font-bold">
                                                        Recommended Action/s to be taken: 
                                                    </h1>
                                                <!-- Radio Buttons -->
                                                    <div class="flex flex-col space-y-2">
                                                        @foreach($recommendedActions as $action)
                                                            <label class="flex items-center">
                                                                <input type="radio" name="action" value="{{ $action->recommended_action }}" class="form-radio text-blue-600" id="action_{{ $action->recommended_action }}">
                                                                <span class="ml-2">{{ $action->value }}</span>
                                                            </label>
                                                        @endforeach

                                                        <!-- Radio button for "Others" with custom input -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="action" value="other" class="form-radio text-blue-600" id="otherRadio">
                                                            <span class="ml-2">Others</span>
                                                        </label>
                                                    </div>

                                                    <!-- Textbox for "Others" -->
                                                    <div id="otherTextbox" class="mt-4 hidden">
                                                        <label for="otherAction" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            Please specify:
                                                        </label>
                                                        <input type="text" name="otherAction" id="otherAction" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    </div>
                                                                                                        
                                                    <script>
                                                        document.querySelectorAll('input[name="action"]').forEach(radio => {
                                                            radio.addEventListener('change', function() {
                                                                const otherTextbox = document.getElementById('otherTextbox');
                                                                if (this.value === 'other') {
                                                                    otherTextbox.classList.remove('hidden');
                                                                } else {
                                                                    otherTextbox.classList.add('hidden');
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <script>
                                        function validateInput(input) {
                                                // Allow only valid numeric characters (0-9, ., and optional leading digits)
                                                const value = input.value.replace(/[^0-9.]/g, ''); // Allow digits and decimal points
                                                const regex = /^\d+(\.\d{0,2})?$/; // Regex for numbers with up to two decimal places

                                                // Update input value if it matches the regex
                                                if (regex.test(value)) {
                                                    input.value = value; // Set the valid value
                                                } else {
                                                    input.value = ''; // Clear input if invalid
                                                }

                                                // Parse the value as a float
                                                const parsedValue = parseFloat(input.value);

                                                // Check if the value is within range (1-5)
                                                if (parsedValue < 1 || parsedValue > 5 || isNaN(parsedValue)) {
                                                    input.value = ''; // Clear the input if outside the valid range
                                                }
                                            }

                                            function calculateResults() {
                                                // Define weights
                                                const weights = {
                                                    jobKnowledge: 0.20,
                                                    dependability: 0.10,
                                                    productivity: 0.10,
                                                    qualityOfWork: 0.10,
                                                    teamwork: 0.10,
                                                    workValue: 0.20,
                                                    attendance: 0.05,
                                                    punctuality: 0.05,
                                                    personalAppearance: 0.10
                                                };

                                                // Get input values
                                                const jobKnowledge = parseFloat(document.getElementById("eval-1").value) || 0;
                                                const dependability = parseFloat(document.getElementById("eval-2").value) || 0;
                                                const productivity = parseFloat(document.getElementById("eval-3").value) || 0;
                                                const qualityOfWork = parseFloat(document.getElementById("eval-4").value) || 0;
                                                const teamwork = parseFloat(document.getElementById("eval-5").value) || 0;
                                                const workValue = parseFloat(document.getElementById("eval-6").value) || 0;
                                                const attendance = parseFloat(document.getElementById("eval-7").value) || 0;
                                                const punctuality = parseFloat(document.getElementById("eval-8").value) || 0;
                                                const personalAppearance = parseFloat(document.getElementById("eval-9").value) || 0;

                                                // Calculate weighted scores
                                                const totalScore =
                                                    (jobKnowledge * weights.jobKnowledge) +
                                                    (dependability * weights.dependability) +
                                                    (productivity * weights.productivity) +
                                                    (qualityOfWork * weights.qualityOfWork) +
                                                    (teamwork * weights.teamwork) +
                                                    (workValue * weights.workValue) +
                                                    (attendance * weights.attendance) +
                                                    (punctuality * weights.punctuality) +
                                                    (personalAppearance * weights.personalAppearance);

                                                // Update the result input
                                                document.getElementById("results").value = totalScore.toFixed(2);
                                            }

                                            // Attach event listeners to inputs
                                            const inputs = document.querySelectorAll('input[type="text"]');
                                            inputs.forEach(input => {
                                                input.addEventListener('input', calculateResults);
                                            });
                                </script>

                            </div>
                        </div>
                    </div>

                    <button id="submitButton" type="submit" class="w-[15vh] h-[5vh] ml-auto mt-5 rounded-lg bg-blue-500 items-center text-medium font-bold text-white hover:scale-110 transition duration-200">
                        Submit
                    </button>
                </form>
            </div>
          
        </div>
    </section>  
    
    <!--help evaluation modal-->
    <div id="helpModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <!-- Modal Content -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
            <div class="flex flex-col justify-between items-center mb-4 gap-3">
                <h2 class="text-xl font-semibold dark:text-blac">Evaluation Help </h2>
                <p class="text-sm font-normal dark:text-white text-black">Validity of the Performance Evaluation is 1 year. After 1 year, it will be deleted
                Make sure that every fields that have asterisks are filled. </p>

            </div>
                
            <!--rating scale information-->    
            <div class="flex flex-col w-full">
                <table>
                    <thead class="py-3 px-3">
                        <th class="py-3 px-3 text-lg text-black dark:text-white text-center">
                            SCORES
                        </th>
                        <th class="py-3 px-3 text-end">

                        </th>
                    </thead>
                    <tbody>
                        <tr class="border-b border-black dark:border-white">
                            <td class="py-5 px-3 font-sm text-black dark:text-white font-normal text-center">5.0-4.5</td>
                            <td class="py-5 px-4 font-sm text-black dark:text-white font-normal text-end">Outstanding Performance</td>
                        </tr>
                        <tr class="border-b border-black dark:border-white">
                            <td class="py-5 px-3 font-sm text-black dark:text-white font-normal text-center">4.49-3.5</td>
                            <td class="py-5 px-4 font-sm text-black dark:text-white font-normal text-end">Above Average</td>
                        </tr>
                        <tr class="border-b border-black dark:border-white">
                            <td class="py-5 px-3 font-sm text-black dark:text-white font-normal text-center">3.49-2.5</td>
                            <td class="py-5 px-4 font-sm text-black dark:text-white font-normal text-end">Average</td>
                        </tr>
                        <tr class="border-b border-black dark:border-white">
                            <td class="py-5 px-3 font-sm text-black dark:text-white font-normal text-center">2.49-1.5</td>
                            <td class="py-5 px-4 font-sm text-black dark:text-white font-normal text-end">Below Average</td>
                        </tr>
                        <tr class="border-b border-black dark:border-white">
                            <td class="py-5 px-3 font-sm text-black dark:text-white font-normal text-center">1.49-0</td>
                            <td class="py-5 px-4 font-sm text-black dark:text-white font-normal text-end">Poor</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button id="closeButton" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Close
            </button>
        </div>
    </div>
    <!--script of help evaluation modal-->
    <script>
        document.getElementById('helpButton').addEventListener('click', function() {
            document.getElementById('helpModal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('helpModal').classList.add('hidden');
        });

        document.getElementById('closeButton').addEventListener('click', function() {
            document.getElementById('helpModal').classList.add('hidden');
        });
    </script>

    <!--View Evaluation All page-->
    <section id ="viewAllEvaluation-content" class="section hidden w-full h-screen p-7">
        <div class="w-full p-2 flex flex-col gap-3">
            <div class="w-full flex flex-row items-center p-3 gap-5">
               <button  class=" hover:scale-125 transition duration-200">
                    <img src="{{URL('images/goback.png')}}" alt="" data-light-src="{{URL('images/goback.png')}}" data-dark-src="{{URL('images/goback_dark.png')}}" class="w-10" onclick="navigateTo('performance-evaluation', this)">
                </button>
            </div>

            <div class="w-full h-[calc(93vh-100px)] overflow-y-auto bg-white p-4 rounded-xl shadow-xl dark:bg-gray-700">
                <div class="w-full p-3">
                    <table class="w-full" id="displayAllEvaluationTable">
                        <thead class="w-full bg-gray-100 dark:bg-gray-500">
                            <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">EMPLOYEE</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">EVALUATED BY</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">DATE EVALUATED</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">RECOMMENDED ACTION</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">GRADE</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100"></th>
                        </thead>

                        <tbody id="evaluationAllBody">
                        
                        </tbody>
                    </table>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        fetchEvaluations();

                        // Handle row click
                        document.getElementById('evaluationAllBody').addEventListener('click', function(event) {
                            const row = event.target.closest('tr');
                            if (row) {
                                const evaluation = JSON.parse(row.getAttribute('data-evaluation')); // Get the evaluation data stored in the row
                                openEvaluationModal(evaluation);
                            }
                        });
                    });

                    function fetchEvaluations() {
                        fetch('/evaluations')
                            .then(response => response.json())
                            .then(data => {
                                const evaluationBody = document.getElementById('evaluationAllBody');
                                evaluationBody.innerHTML = ''; // Clear existing rows

                                // Sort evaluations by 'date_evaluated' in descending order (latest first)
                                data.sort((a, b) => new Date(b.date_evaluated) - new Date(a.date_evaluated));

                                data.forEach(evaluation => {
                                    const row = document.createElement('tr');
                                    row.classList.add('border-b', 'hover:bg-gray-200', 'cursor-pointer', 'transition', 'duration-200','dark:hover:bg-gray-900');
                                    row.setAttribute('data-evaluation', JSON.stringify(evaluation)); // Store evaluation data directly in the row

                                    row.innerHTML = `
                                        <td class="text-center text-md font-bold text-black px-3 py-3 dark:text-white">${evaluation.employee_first_name} ${evaluation.employee_last_name}</td>
                                        <td class="text-center text-md font-bold text-black px-3 py-3 dark:text-white">${evaluation.rater_first_name} ${evaluation.rater_last_name}</td>
                                        <td class="text-center text-md text-black px-3 py-3 dark:text-white">${evaluation.date_evaluated}</td>
                                        <td class="text-center text-md text-white font-bold px-3 py-3"><span class="p-2 bg-green-500 rounded-lg shadow-lg">${evaluation.recommended_action}</span></td>
                                        <td class="text-center text-md text-white font-bold px-3 py-3"><span class="p-2 bg-red-500 rounded-lg shadow-lg">${evaluation.performance_rating}</span></td>
                                        <td></td>
                                    `;

                                    evaluationBody.appendChild(row);
                                });
                            })
                            .catch(error => console.error('Error fetching evaluations:', error));
                    }

                    function openEvaluationModal(evaluation) {
                        // Reset modal content before opening the modal
                        resetModal();

                        // Set new modal content based on the selected row
                        document.getElementById('employeeNameTitle').textContent = `${evaluation.employee_first_name} ${evaluation.employee_last_name}`;
                        document.getElementById('evaluatedBy').textContent = `${evaluation.rater_first_name} ${evaluation.rater_last_name}`;
                        document.getElementById('datePeriod').textContent = `Start: ${evaluation.evaluation_start} to End: ${evaluation.evaluation_end}`;
                        document.getElementById('remarkOffense').textContent = evaluation.remark_offense || 'N/A';
                        document.getElementById('remarkAccomplish').textContent = evaluation.remark_accomplish || 'N/A';
                        document.getElementById('remarkForImprove').textContent = evaluation.remark_forimprove || 'N/A';
                        document.getElementById('commentRater').textContent = evaluation.comment_rater || 'N/A';
                        document.getElementById('commentRatee').textContent = evaluation.comment_ratee || 'N/A';
                        document.getElementById('recommendedAction').textContent = evaluation.recommended_action;

                        setPerformanceRating(evaluation.performance_rating);

                        // Ensure the modal is shown
                        const modal = document.getElementById('evaluationModal');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex'); // This will ensure it's displayed with flex or adjust as needed
                    }

                    // Function to set the performance rating in the modal and reset the chart
                    function setPerformanceRating(rating) {
                        // Destroy the existing chart if it exists
                        if (window.performanceChart) {
                            window.performanceChart.destroy();
                        }

                        const ctx = document.getElementById('employeeProgressChart').getContext('2d');
                        
                        // Create a new chart instance
                        window.performanceChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    data: [rating, 5 - rating], // Rating and remaining space
                                    backgroundColor: ['#4CAF50', '#dcdcdc'] // Green for the rating, light gray for the remaining space
                                }]
                            },
                            options: {
                                rotation: -Math.PI / 2, // Start the doughnut from the top
                                cutoutPercentage: 85, // Make the doughnut look like a progress circle
                                tooltips: { enabled: false }, // Disable tooltips
                            }
                        });

                        // Set the performance rating text
                        document.getElementById('performanceRatingText').textContent = rating;
                    }

                    // Reset modal content
                    function resetModal() {
                        document.getElementById('employeeNameTitle').textContent = '';
                        document.getElementById('evaluatedBy').textContent = '';
                        document.getElementById('datePeriod').textContent = '';
                        document.getElementById('remarkOffense').textContent = '';
                        document.getElementById('remarkAccomplish').textContent = '';
                        document.getElementById('remarkForImprove').textContent = '';
                        document.getElementById('commentRater').textContent = '';
                        document.getElementById('commentRatee').textContent = '';
                        document.getElementById('recommendedAction').textContent = '';
                        document.getElementById('performanceRatingText').textContent = '';
                        // Clear the chart or reset it
                        const ctx = document.getElementById('employeeProgressChart').getContext('2d');
                        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Reset canvas
                    }

                    // Close modal functionality
                    function closebtn() {
                        const modal = document.getElementById('evaluationModal');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex'); // Hide it properly
                    }

                    // Close modal if clicked outside of modal content
                    document.getElementById('evaluationModal').addEventListener('click', function(event) {
                        if (event.target === this) {
                            closebtn();
                        }
                    });
                </script>
            </div>
        </div>
    </section>

    <!-- Modal Admin view evaluation -->
    <div id="evaluationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg p-5 w-[50vh]">
            <h2 class="text-lg font-bold mb-4" id="modalTitle">Evaluation Details </h2>
           
            <div id="modalContent">
                <span class="text-xl font-bold mb-4 text-center" id="employeeNameTitle"></span>
                <div class="relative w-[30vh] h-[30vh] mx-auto mb-10">
                    <canvas id="employeeProgressChart" width="100" height="100"></canvas>
                    <div id="performanceRatingText" class="absolute inset-0 flex items-center justify-center font-bold text-xl text-gray-700">0</div>
                </div>

                <p><strong>Evaluated By:</strong> <span id="evaluatedBy"></span></p>
                <p><strong>Date Period:</strong> <span id="datePeriod"></span></p>
                <p><strong>Remarks (Offense):</strong> <span id="remarkOffense">N/A</span></p>
                <p><strong>Remarks (Accomplish):</strong> <span id="remarkAccomplish">N/A</span></p>
                <p><strong>Remarks (For Improvement):</strong> <span id="remarkForImprove">N/A</span></p>
                <p><strong>Comment from Rater:</strong> <span id="commentRater">N/A</span></p>
                <p><strong>Comment from Ratee:</strong> <span id="commentRatee">N/A</span></p>
                <p><strong>Recommended Action:</strong> <span id="recommendedAction"></span></p>
            </div>
           <button id="close-btn" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:scale-105 transition duration-300" onclick="closebtn()">Close</button>
        </div>
    </div>

    <!--department page full list-->
    <section id = "department_page-content" class="section hidden w-full h-screen p-7">
        <div class="w-full h-[85vh] h-[calc(100vh-100px)] overflow-y-auto p-5 mt-14 bg-white rounded-lg dark:bg-gray-800 shadow-lg">
            <h1 class="font-bold text-2xl text-black dark:text-white mb-10">DEPARTMENTS</h1>

            <div class="flex flex-col">
                <!--office-->
                <div class="flex flex-col gap-5 w-full items-start">
                    <h1 class = "font-bold text-xl text-black dark:text-white">OFFICE:</h1>

                    <!--1st row OFFICE-->
                    <div class = "flex flex-row items-start gap-6 w-full">
                        <!-- Admin Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-500 hover:scale-105 transition duration-400" data-department-id="1">
                            <img src="{{URL('images/admin.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">Human Resources</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="admin1-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- MSIT Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="2">
                            <img src="{{URL('images/msit.png')}}" alt="msit_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-wrap text-left">MSIT</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="msit1-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- Purchasing Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="3">
                            <img src="{{URL('images/purchasing.png')}}" alt="purchasing_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-wrap text-left">Purchasing</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="purchasing-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- Shipping Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="4">
                            <img src="{{URL('images/shipping.png')}}" alt="shipping_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-wrap text-left">Shipping</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="shipping-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>
                    </div>

                    <!--2nd row OFFICE-->
                    <div class = "flex flex-row items-start gap-6 w-full">
                        <!-- Accounting Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="5">
                            <img src="{{URL('images/accounting.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">Accounting</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="accounting-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- Sales Marketing Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="6">
                            <img src="{{URL('images/salesmarketing.png')}}" alt="msit_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-wrap text-left">Sales Marketing</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="sales-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- PPC Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400"  data-department-id="7">
                            <img src="{{URL('images/ppc.png')}}" alt="purchasing_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-wrap text-left">PPC</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="ppc-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- Technical Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-start justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400"  data-department-id="8">
                            <img src="{{URL('images/technical.png')}}" alt="shipping_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-wrap text-left">Technical</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="technical1-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>
                    </div>
                </div>

                <!--PRODUCTION-->
                <div class="flex flex-col gap-5 w-full items-start mt-10">
                    <h1 class = "font-bold text-xl text-black dark:text-white">PRODUCTION:</h1>

                    <div class = "flex flex-row items-start gap-6 w-full">
                        <!-- Packing Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="9">
                            <img src="{{URL('images/packing.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">Packing</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="packing-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                         <!-- Mixer Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="10">
                            <img src="{{URL('images/mixer.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">Mixer</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="mixer-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- RollerMill Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="11">
                            <img src="{{URL('images/rollermill.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">Rollermill</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="rollermill1-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- sandmill Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="12">
                            <img src="{{URL('images/sandmill.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">Sandmill</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="sandmill-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                    </div>

                      <div class = "flex flex-row items-start gap-6 w-full">
                        <!-- Weighning Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="13">
                            <img src="{{URL('images/weighning.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-wrap text-left">Weighning & Premix</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="weighning-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                         <!-- Washing Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="14">
                            <img src="{{URL('images/washing.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">Washing</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="washing-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- RG Warehouse Department -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="15">
                            <img src="{{URL('images/fgwarehouse.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">FG Warehouse</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="fgwarehouse-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                        <!-- RM WarehouseDepartment -->
                        <button class="department-btn flex flex-row p-5 gap-2 align-center justify-center items-center w-[35vh] h-[15vh] rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 shadow-xl dark:hover:bg-gray-300 hover:scale-105 transition duration-400" data-department-id="16">
                            <img src="{{URL('images/rmwarehouse.png')}}" alt="admin_department" class="w-[10vh]">
                            <div class="flex flex-col items-center">
                                <h2 class="font-bold text-lg text-black dark:text-white text-nowrap text-left">RM Warehouse</h2>
                                <p class="text-xs italic text-black dark:text-white opacity-70">Number of Employees:</p>
                                <h1 id="rmwarehouse-count" class="font-bold text-3xl text-black dark:text-white">Loading...</h1>
                            </div>
                        </button>

                    </div>
                </div>

                    <!--script for department page employee counter-->
                      <script>
                        function fetchDepartmentEmployeeCounts() {
                            fetch('/department-employee-counts')
                                .then(response => response.json())
                                .then(data => {
                                    const counts = data.departmentEmployeeCounts;
                                    
                                    // Update the employee count for each department
                                    document.getElementById('admin1-count').textContent = counts[1] || '0'; 
                                    document.getElementById('msit1-count').textContent = counts[2] || '0'; 
                                    document.getElementById('purchasing-count').textContent = counts[3] || '0';
                                    document.getElementById('shipping-count').textContent = counts[4] || '0';
                                    document.getElementById('accounting-count').textContent = counts[5] || '0'; 
                                    document.getElementById('sales-count').textContent = counts[6] || '0';
                                    document.getElementById('technical1-count').textContent = counts[7] || '0';
                                    document.getElementById('ppc-count').textContent = counts[8] || '0';  
                                    document.getElementById('packing-count').textContent = counts[9] || '0'; 
                                    document.getElementById('mixer-count').textContent = counts[10] || '0'; 
                                    document.getElementById('rollermill1-count').textContent = counts[11] || '0';
                                    document.getElementById('sandmill-count').textContent = counts[12] || '0';
                                    document.getElementById('weighning-count').textContent = counts[13] || '0'; 
                                    document.getElementById('washing-count').textContent = counts[14] || '0';
                                    document.getElementById('fgwarehouse-count').textContent = counts[15] || '0'; 
                                    document.getElementById('rmwarehouse-count').textContent = counts[16] || '0'; 
                                })
                                .catch(error => {
                                    console.error('Error fetching department employee counts:', error);
                                    // Set default 0 if there's an error
                                    document.getElementById('admin1-count').textContent = '0';
                                    document.getElementById('msit1-count').textContent = '0';
                                    document.getElementById('purchasing-count').textContent = '0';
                                    document.getElementById('shipping-count').textContent = '0';
                                    document.getElementById('accounting-count').textContent = '0';
                                    document.getElementById('sales-count').textContent = '0';
                                    document.getElementById('ppc-count').textContent = '0';
                                    document.getElementById('technical1-count').textContent = '0';
                                    document.getElementById('packing-count').textContent = '0';
                                    document.getElementById('mixer-count').textContent = '0';
                                    document.getElementById('rollermill1-count').textContent = '0';
                                    document.getElementById('sandmill-count').textContent = '0';
                                    document.getElementById('weighning-count').textContent = '0';
                                    document.getElementById('washing-count').textContent = '0';
                                    document.getElementById('fgwarehouse-count').textContent = '0';
                                    document.getElementById('rmwarehouse-count').textContent = '0';
                                });
                        }

                        // Fetch department employee counts when the page loads
                        document.addEventListener('DOMContentLoaded', fetchDepartmentEmployeeCounts);

                        // Optionally, refresh the count every minute
                        setInterval(fetchDepartmentEmployeeCounts, 60000); // 60000 ms = 1 minute
                    </script>
            </div>
        </div>

       
    </section>

    <!-- Employee List Modal Department -->
        <div id="employee-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-11/12 md:w-2/3 lg:w-1/2 p-5">
                <h2 class="text-xl font-bold mb-4 dark:text-white">Employee List</h2>
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="py-3 px-2 font-bold dark:text-white">Employee ID</th>
                            <th class="py-3 px-2 font-bold dark:text-white">Employee Name</th>
                            <th class="py-3 px-2 font-bold dark:text-white">Date Hired</th>
                            <th class="py-3 px-2 font-bold dark:text-white">Action</th>
                            <th class="py-3 px-2 font-bold dark:text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody id="employee-list">
                        <!-- Employee rows will be populated here -->
                    </tbody>
                </table>
                <button id="close-modal" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Close</button>
                <button id="update-modal" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Update</button>
            </div>
        </div>

        <!-- Script for department employee list modal -->
        <script>
                                // Function to open the modal and fetch employee data
                function fetchEmployeesByDepartment(departmentId) {
                    fetch(`/department-employees/${departmentId}`)
                    .then(response => response.json())
                    .then(data => {
                        const employeeList = document.getElementById('employee-list');
                        employeeList.innerHTML = ''; // Clear previous data

                        // Populate the employee list in the modal
                        data.employees.forEach(employee => {
                            const statusClass = employee.status === 1 ? 'bg-green-500' : 'bg-red-500';  // Determine the color based on status
                            const statusText = employee.status === 1 ? 'Active' : 'Inactive';  // Determine the text based on status

                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <tr class="border-b border-gray-200 hover:bg-gray-200 dark:border-white opacity-70">
                                    <td class="py-2 px-2 dark:text-white">${employee.employee_ID}</td>
                                    <td class="py-2 px-4 dark:text-white text-center">${employee.employee_name}</td>
                                    <td class="py-2 px-4 dark:text-white text-center">${employee.date_hired}</td>
                                    <td class="py-2 px-6 items-center">
                                        <select class="employee-status rounded-lg border border-gray-300" data-employee-id="${employee.employee_ID}">
                                            <option value="1" ${employee.status === 1 ? 'selected' : ''}>Active</option>
                                            <option value="0" ${employee.status === 0 ? 'selected' : ''}>Inactive</option>
                                        </select>
                                    </td>
                                    <td class="py-2 px-6 items-center">
                                        <span class="status-label ${statusClass} text-white py-1 px-3 rounded">${statusText}</span>
                                    </td>
                                </tr>
                            `;
                            employeeList.appendChild(row);
                        });

                        // Show the modal
                        document.getElementById('employee-modal').classList.remove('hidden');

                        // Add event listeners to status dropdowns
                        document.querySelectorAll('.employee-status').forEach(select => {
                            select.addEventListener('change', (event) => {
                                const employeeId = event.target.getAttribute('data-employee-id');
                                const newStatus = event.target.value;
                                updateEmployeeStatus(employeeId, newStatus);
                            });
                        });
                    })
                    .catch(error => console.error('Error fetching employees:', error));
                }

                // Function to update employee status
                function updateEmployeeStatus(employeeId, newStatus) {
                    fetch('/change-status-dropdown', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ employee_ID: employeeId, status: newStatus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Corrected querySelector to target the specific select element
                            document.querySelector(`.employee-status[data-employee-id="${employeeId}"]`).value = data.status;
                            const statusLabel = document.querySelector(`.status-label[data-employee-id="${employeeId}"]`);
                            if (statusLabel) {
                                const statusClass = newStatus == 1 ? 'bg-green-500' : 'bg-red-500';
                                const statusText = newStatus == 1 ? 'Active' : 'Inactive';
                                statusLabel.className = `status-label ${statusClass} text-white py-1 px-3 rounded`;
                                statusLabel.textContent = statusText;
                            }
                        } else {
                            alert('Failed to update status.');
                        }
                    })
                    .catch(error => console.error('Error updating status:', error));
                }

                // Event listener to close the modal
                document.getElementById('close-modal').addEventListener('click', () => {
                    document.getElementById('employee-modal').classList.add('hidden');
                });

                // Event listener for the update button
                document.getElementById('update-modal').addEventListener('click', () => {
                    const employeeStatus = {};

                    // Collect each employee's status
                    document.querySelectorAll('.employee-status').forEach(select => {
                        const employeeId = select.getAttribute('data-employee-id');
                        const status = select.value;
                        employeeStatus[employeeId] = status;
                    });

                    // Send the status data to the server
                    fetch('/update-employee-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ employeeStatus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Employee status updated successfully.');
                            document.getElementById('employee-modal').classList.add('hidden');
                        } else {
                            alert('Failed to update employee status.');
                        }
                    })
                    .catch(error => console.error('Error updating status:', error));
                });

                // Add event listeners to department buttons
                document.querySelectorAll('.department-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        const departmentId = button.getAttribute('data-department-id');
                        fetchEmployeesByDepartment(departmentId);
                    });
                });

        </script>


    <!--announcement all list section-->
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
            <!--script for announcement all list section-->
            <script>

                document.addEventListener('DOMContentLoaded', function () {
                    fetchFullAnnouncements(); // Call this to fetch announcements when the page loads
                });

                // Fetch announcements from the backend and display them
                function fetchFullAnnouncements() {
                    fetch('{{ route('admin.getAllAnnouncements') }}') // Make sure this matches your route for fetching announcements
                        .then(response => response.json())
                        .then(data => {
                            const announcements = data.announcements;
                            const announcementList = document.getElementById('full-announcement-list');
                            announcementList.innerHTML = ''; // Clear the existing content

                            if (announcements.length > 0) {
                                announcements.forEach(announcement => {
                                    const employee = announcement.employee;
                                    const employeeName = employee ? `${employee.first_name} ${employee.last_name}`.trim() : 'Unknown'; // Combine first, middle, and last name
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
                                                <button class="text-blue-500 hover:underline dark:text-red-400"  onclick="expandAnnouncement(${announcement.announce_ID})">View Details</button>
                                            </td>
                                        </tr>

                                        <!-- Hidden row for expanded details -->
                                        <tr id="announcement-details-${announcement.announce_ID}" class="hidden">
                                            <td colspan="3" class="px-4 py-2">
                                                <div class="announcement-scroll" style="max-height: 200px; overflow-y: auto;  padding: 8px; border-radius: 8px;">
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

                        // First, collapse all other open announcements
                        const allDetails = document.querySelectorAll('[id^="announcement-details-"]');
                        allDetails.forEach(detail => {
                            if (!detail.classList.contains('hidden')) {
                                detail.classList.add('hidden'); // Hide all currently open details
                            }
                        });
                        const detailsRow = document.getElementById(`announcement-details-${announceId}`);
                        detailsRow.classList.remove('hidden'); // Show the details
                    }

                    const announcementBody = detailsRow.querySelector('p');
                    announcementBody.classList.add('pre-wrap'); // Add the pre-wrap class

                    // Collapse announcement details
                    function collapseAnnouncement(announceId) {
                        const detailsRow = document.getElementById(`announcement-details-${announceId}`);
                        detailsRow.classList.add('hidden'); // Hide the details
                    }

                </script>
    </section>

    <!--announce modal-->
    <div id="announceModal" class="fixed flex items-center inset-0 bg-white bg-opacity-50 items-center justify-center hidden z-50">
        
        <div class="flex flex-col bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full justify-center">
        
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-black dark:text-white">Create an Announcement</h2>
            </div>

            <form id="announceForm" method="POST" action="{{ route('admin.createAnnouncement')}}"> 
                @csrf
            <div class="p-4 flex flex-col gap-2">
               <div class="flex flex-col">
                    <h2 class="text-md font-medium dark:text-white">
                        Subject:
                    </h2>
                   <input type="text" id="subject" name="announce_subject" class="w-full p-2 h-[5vh] rounded-lg border-2 border-gray-200" placeholder="Subject..." required>
               </div>
               <div class="flex flex-col">
                    <h2 class="text-md font-medium dark:text-white">
                        Announcement:
                    </h2>
                    <textarea id="announcement" name="announce_body" class="w-full p-2 h-[10vh] rounded-lg border-2 border-gray-200" placeholder="Announcement Body...." required></textarea>
                    </textarea>
               </div>
               
            </div>

            <!-- Button container -->
            <div class="flex justify-between items-center mt-4">
                <!-- Post button -->
                <button class="w-[10vh] h-[5vh] rounded-lg shadow-md bg-blue-500 text-lg font-bold text-white text-center hover:scale-110 transition duration-200">
                    Post
                </button>

                <!-- Close button -->
                <button id="closeButton" type="button" onclick="closeModalAnnouncement()" class="w-[10vh] h-[5vh] rounded-lg shadow-md bg-red-500 text-lg font-bold text-white text-center hover:scale-110 transition duration-200">
                    Close
                </button>
            </div>
            </form>
        </div>
    </div>
     <!--script of announce Modal-->
    <script>
        function closeModalAnnouncement() {
            document.getElementById('announceModal').classList.add('hidden');
        }
        document.getElementById('announcementButton').addEventListener('click', function() {
            document.getElementById('announceModal').classList.remove('hidden');
        });

    </script>


            <!--loading spinner-->
            <div class="fixed inset-0 flex items-center justify-center bg-gray-100 z-50 hidden" id="loading-spinner">
                <div class="flex flex-row gap-2">
                    <span class='sr-only'>Loading...</span>
                    <div class='h-8 w-8 bg-green-500 rounded-full animate-bounce [animation-delay:-0.3s]'></div>
                    <div class='h-8 w-8 bg-violet-600 rounded-full animate-bounce [animation-delay:-0.15s]'></div>
                    <div class='h-8 w-8 bg-red-500 rounded-full animate-bounce'></div>
                </div>
            </div>

            <script>
                function showLoadingSpinner() {
                    document.getElementById('loading-spinner').classList.remove('hidden');
                }
            </script>
   


     <!-- Search Modal -->
    <div id="searchModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg w-full max-w-md relative mx-4 sm:mx-8 md:mx-16 lg:mx-24 xl:mx-32">
            <button onclick="toggleSearchModal(false)" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition">
                &times;
            </button>
            <h2 class="text-2xl mb-4 text-center dark:text-white">Search</h2>
            <input type="text" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type to search...">
        </div>
    </div>

    <!--script for search modal-->
    <script>
        // JavaScript for Modal Functionality
        function toggleSearchModal(isVisible) {
            const searchModal = document.getElementById('searchModal');
            const body = document.body;

            if (isVisible) {
                searchModal.classList.remove('hidden');
                body.classList.add('blur-content');
            } else {
                searchModal.classList.add('hidden');
                body.classList.remove('blur-content');
            }
        }

        // Attach event listeners to all search buttons
        document.querySelectorAll('.search-button').forEach(button => {
            button.addEventListener('click', () => toggleSearchModal(true));
        });
    </script>
    
   
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