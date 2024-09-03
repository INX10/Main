
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
    </style>

    
</head>


<body class="bg-[#ededed] dark:bg-gray-900 dark:opacitiy-70 flex">
    <!--user profile-->
    <div class="flex w-full flex-row justify-end space-x-2 items-center mb-7 fixed right-5 top-7">
        <button class="hover:scale-110 transition duration-200">
            <img src="{{URL('images/defaultprofpic.png')}}" alt="" class="w-9 h-9">
        </button>
        <h2 class="text-lg dark:text-white">Ryan Mark Luis</h2>
        <div x-data="{ open: false }" class="relative">
            <button @click.stop="open = !open" class="hover:scale-110 transition duration-200">
                <img src="{{URL('images/dropdownprofile.png')}}" 
                    data-light-src="{{URL('images/dropdownprofile.png')}}" 
                    data-dark-src="{{URL('images/dropdownprofile_dark.png')}}" 
                    alt="" 
                    class="w-9 h-9">
            </button>
            <!-- Dropdown Menu -->
           <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" 
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                <div class="py-2">
                    <button class="w-full text-left px-4 py-2 text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" onclick="navigateTo('settings', this)">
                        Settings
                    </button>
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
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
                        <button class="p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200">
                            <img src="{{ URL('images/update.png') }}" alt="update" class="w-7 h-7">
                        </button>
                        <button class="p-2 bg-white hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-400 rounded-full transition hover:scale-125 shadow-xl duration-200 search-button">
                            <img src="{{ URL('images/search.png') }}" alt="search" class="w-7 h-7">
                        </button>
                    </div>
    <!--number of emp, pending, next pay date-->
                    <div class="flex w-full flex-row gap-3 justify-center mb-4">
                        <div class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl">
                            <h1 class="text-sm font-medium dark:text-white">Number of Employees</h1>
                            <p class="text-2xl font-bold font-sans dark:text-white">345</p>
                        </div>
                        <div class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl">
                            <h1 class="text-sm font-medium dark:text-white">Pending Requests</h1>
                            <p class="text-2xl font-bold font-sans dark:text-white">3</p>
                        </div>
                        <div class="flex flex-col items-center bg-white dark:bg-gray-700 p-4 w-full h-auto rounded-2xl shadow-xl">
                            <h1 class="text-sm font-medium dark:text-white">Next pay date</h1>
                            <p class="text-2xl font-bold font-sans dark:text-white">03/20/2024</p>
                        </div>
                    </div>
    <!--departments-->
                    <div class="flex flex-col w-full md:h-[40vh] bg-white dark:bg-gray-700 p-6 gap-3 justify-start shadow-lg rounded-2xl mb-3">
                        <div class="w-full h-auto flex items-center justify-between ">
                                <h1 class="text-lg font-bold font-sans dark:text-white">DEPARTMENTS:</h1>
                                <button class="ml-auto hover:scale-125 transition-all duration-300">
                                    <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7">
                                </button>
                        </div>
    <!--department_inside-->
                        <div class="flex flex-row w-full h-auto gap-4">
                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/admin.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold dark:text-white">ADMIN</h1>
                                <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                <h1 class="text-4xl font-bold dark:text-white">10</h1>
                            </button>

                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/msit.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold dark:text-white">MS-IT</h1>
                                <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                <h1 class="text-4xl font-bold dark:text-white">4</h1>
                            </button>

                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/rollermill.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold dark:text-white">ROLLER-MILL</h1>
                                <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                <h1 class="text-4xl font-bold dark:text-white">13</h1>
                            </button>

                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] dark:bg-gray-600 p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 dark:hover:bg-gray-500 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/technical.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold dark:text-white">TECHNICAL</h1>
                                <p class="text-sm text-gray-400 dark:text-white">Total Employees:</p>
                                <h1 class="text-4xl font-bold dark:text-white">19</h1>
                            </button>

                        </div>
                    </div>

    <!--performance eval & activity logs-->
                    <div class="flex flex-row w-full h-auto gap-3">
    <!--performance eval-->    
                        <div class="flex flex-col w-full md:h-[30vh] bg-white dark:bg-gray-700 p-4 gap-3 justify-start item-center shadow-lg rounded-2xl">
                            <div class="w-full h-auto flex items-center justify-between ">
                                <h1 class="text-lg font-bold font-sans sm:text-xs md:text-lg lg:text-lg text-sm dark:text-white">PERFORMANCE EVALUATION:</h1>
                                <button class="ml-auto hover:scale-125 transition-all duration-300">
                                    <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7">
                                </button>
                            </div>
    <!--performance list -->
                            <div class="w-full h-[30vh] h-auto flex flex-col justify-center gap-3">
                            <!--row1-->
                                <button class="flex flex-row w-full sm:h-3vh md:h-[6vh] bg-[#ededed] dark:bg-gray-600 rounded-lg shadow-lg justify-center items-center p-1 gap-2">

                                    <img src="{{URL('images/identify.png')}}" alt="perf profile" class="w-[4vh]">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-medium dark:text-white">Ryan Luis</h1>
                                        <p class="text-xs font-normal opacity-60 dark:text-white">MS-IT | IT Support</p>
                                    </div>

                                    <div class="inline-block h-auto min-h-[1em] w-0.5 self-stretch opacity-50"></div>

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-normal opacity-60 dark:text-white">Evaluated by:</h1>
                                        <p class="text-xs italic font-semibold opacity-60 dark:text-white">Martin Calpo</p>
                                    </div>

                                </button>
                                 <!--row2-->
                                 <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] dark:bg-gray-600 rounded-lg shadow-lg justify-center items-center p-1 gap-2">

                                <img src="{{URL('images/identify.png')}}" alt="perf profile" class="w-[4vh]">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-medium dark:text-white">Ryan Luis</h1>
                                        <p class="text-xs font-normal opacity-60 dark:text-white">MS-IT | IT Support</p>
                                    </div>

                                    <div class="inline-block h-auto min-h-[1em] w-0.5 self-stretch opacity-50"></div>

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-normal opacity-60 dark:text-white">Evaluated by:</h1>
                                        <p class="text-xs italic font-semibold opacity-60 dark:text-white">Martin Calpo</p>
                                    </div>

                                </button>
                                <!--row3-->
                                <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] dark:bg-gray-600 rounded-lg shadow-lg justify-center items-center p-1 gap-2">

                                    <img src="{{URL('images/identify.png')}}" alt="perf profile" class="w-[4vh]">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-medium dark:text-white">Ryan Luis</h1>
                                        <p class="text-xs font-normal opacity-60 dark:text-white">MS-IT | IT Support</p>
                                    </div>

                                    <div class="inline-block h-auto min-h-[1em] w-0.5 self-stretch opacity-50"></div>

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-normal opacity-60 dark:text-white">Evaluated by:</h1>
                                        <p class="text-xs italic font-semibold opacity-60 dark:text-white">Martin Calpo</p>
                                    </div>

                                </button>
                            </div>
                        </div>
    <!--activity logs-->  
                        <div class="flex flex-col w-full md:h-[30vh] bg-white dark:bg-gray-700 p-4 gap-3 justify-start shadow-lg rounded-2xl">
                            <div class="w-full h-auto flex items-center justify-between ">
                                <h1 class="text-lg font-bold font-sans dark:text-white">ACTIVITY LOGS:</h1>
                                <button class="ml-auto hover:scale-125 transition-all duration-300">
                                    <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7">
                                </button>
                            </div>
    <!--activity logs list-->
                            <div class="w-full h-auto flex flex-col justify-center gap-3">
            <!--row1-->
                                <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] dark:bg-gray-600 rounded-lg shadow-lg justify-start items-center p-1 gap-2">

                                    <img src="{{URL('images/activityLog_user.png')}}" alt="log profiles" class="w-7 h-7 ml-3">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-bold opacity-70 dark:text-white">Leomar Montoya</h1>
                                        <p class="text-xs font-normal opacity-50 dark:text-white">Leomar Montoya has logged in.</p>
                                    </div>

                                    <div class="flex flex-col items-end ml-auto mr-3">
                                        <h2 class="text-xs font-normal opacity-60 dark:text-white">Date</h2>
                                        <p class="text-xs font-normal opacity-60 dark:text-white">Time</p>
                                    </div>

                                </button>
            <!--row2-->
                                <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] dark:bg-gray-600 rounded-lg shadow-lg justify-start items-center p-1 gap-2">

                                    <img src="{{URL('images/activityLog_user.png')}}" alt="log profiles" class="w-7 h-7 ml-3">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-bold opacity-70 dark:text-white">Leomar Montoya</h1>
                                        <p class="text-xs font-normal opacity-50 dark:text-white">Leomar Montoya has logged in.</p>
                                    </div>

                                    <div class="flex flex-col items-end ml-auto mr-3">
                                        <h2 class="text-xs font-normal opacity-60 dark:text-white">Date</h2>
                                        <p class="text-xs font-normal opacity-60 dark:text-white">Time</p>
                                    </div>

                                </button>

                                 <!--row3-->
                                 <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] dark:bg-gray-600 rounded-lg shadow-lg justify-start items-center p-1 gap-2">

                                    <img src="{{URL('images/activityLog_user.png')}}" alt="log profiles" class="w-7 h-7 ml-3">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-bold opacity-70 dark:text-white">Leomar Montoya</h1>
                                        <p class="text-xs font-normal opacity-50 dark:text-white">Leomar Montoya has logged in.</p>
                                    </div>

                                    <div class="flex flex-col items-end ml-auto mr-3">
                                        <h2 class="text-xs font-normal opacity-60 dark:text-white">Date</h2>
                                        <p class="text-xs font-normal opacity-60 dark:text-white">Time</p>
                                    </div>

                                </button>
                            </div>
                        </div>

                    </div>

                </div>


    <!--right panel content-->
                <div class="w-2/5 flex flex-col mt-16">

    <!--date & time-->
                    <div class="w-full flex flex-row justify-end items-end space-x-3 mb-9">
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
                    <button class="absolute right-0 hover:scale-125 transition-all duration-300">
                        <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7">
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
                        <tbody>
                            <!-- Row 1 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-500 dark:border-white">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span class="dark:text-white">Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40 dark:text-white">08/06/2024</span>
                                </td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-500 dark:border-white">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span class="dark:text-white">Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40 dark:text-white">08/06/2024</span>
                                </td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-500 dark:border-white">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span class="dark:text-white">Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40 dark:text-white">08/06/2024</span>
                                </td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-500 dark:border-white">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span class="dark:text-white">Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40 dark:text-white">08/06/2024</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>

    <!--birthday-->
                   <div class="w-full md:h-[35vh] bg-white dark:bg-gray-700 p-4 rounded-xl shadow-xl flex flex-col justify-center items-center gap-1">
                        <div class="w-full h-auto flex flex-row items-center justify-center relative mb-3">
                            <h1 class="text-2xl font-bold font-sans mx-auto flex-1 text-center dark:text-white">
                                BIRTHDAYS
                            </h1>
                        </div>

                        <div class="w-full h-auto flex flex-row justify-center items-center gap-2">
                            <img src="{{URL('images/bday_default.png')}}" alt="bday profile" class="h-20 w-20">

                            <div class="flex flex-col items-start">
                                <h1 class="text-2xl font-bold dark:text-white">Martin Calpo</h1>
                                <p class="text-xs font-normal italic dark:text-white">Technical Department</p>
                            </div>
                        </div>
                        <!--upcoming birthdays-->

                        <h1 class="text-sm font-normal italic opacity-40 dark:text-white ">Upcoming Birthdays</h1>
                        <div class="inline-block h-0.5 w-auto self-stretch bg-gray-600 dark:bg-gray-300 opacity-30"></div>

                        <div class="w-full h-auto ">
                                <table class="w-full text-center">
                                    <tbody>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 gap-4">
                                            <td class="px-4 py-2 text-sm text-gray-700 font-bold dark:text-white">Ryan Mark Luis</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-white">January 2025</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 italic dark:text-white">MS-IT</td>
                                        </tr>

                                        <tr class="border-b border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 gap-4">
                                            <td class="px-4 py-2 text-sm text-gray-700 font-bold dark:text-white">Ryan Mark Luis</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-white">January 2025</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 italic dark:text-white">MS-IT</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>

                   </div>

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

    <!--ADMIN Management Contents-->
    <section class="section w-full p-4" id="admin-management-content">
        <h1 class="text-3xl font-bold mb-4 dark:text-white">Admin Management</h1>
        <div clas="w-full p-5">
            <div class="w-full flex flex-col space-y-3 p-3">

                <!--first row-->
                <div class="w-1/2 h-[8vh] flex flex-row mb-2">

                    <!--buttons add access , update access and search-->
                    <div class="w-full flex flex-row gap-5">
                        <button class="w-full flex flex-row justify-center items-center h-auto bg-white dark:bg-gray-700 gap-2 rounded-2xl shadow-xl hover:scale-105 transition duration-200">
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
                    <button class="w-7 h-auto hover:scale-125">
                        <img src="{{URL('images/rightmore.png')}}" alt="" data-light-src="{{URL('images/rightmore.png')}}" data-dark-src="{{URL('images/rightmore_dark.png')}}" class="h-7 w-7">
                    </button>
                    <div class="p-4">
                        <table class="w-full h-[60vh]">
                            <thead class=" bg-gray-100 dark:bg-gray-500 ">
                                <th class="text-lg font-bold opacity-60 px-4 py-4 dark:text-white">NAME</th>
                                <th class="text-lg font-bold opacity-60 dark:text-white">DEPARTMENT</th>
                                <th class="text-lg font-bold opacity-60 dark:text-white">DATE CREATED</th>
                                <th class="text-lg font-bold opacity-60 dark:text-white">STATUS</th>
                            </thead>

                            <tbody>
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200">
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                </tr>
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200">
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                </tr>
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200">
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                </tr>
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200">
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                </tr>
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200">
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                </tr>
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200">
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                    <td class="text-medium text-center dark:text-white">Ryan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

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
                        <button class="w-full h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row justify-center items-center hover:translate-y-1.5 transition duration-200 space-x-3">
                            <img src="{{URL('images/update.png')}}" alt="" class="w-7 w-7">
                            <h2 class="text-medium font-normal dark:text-white">Update Employee</h2>
                        </button>
                        <button class="w-full h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row justify-center items-center hover:translate-y-1.5 transition duration-200 space-x-3">
                            <img src="{{URL('images/department.png')}}" alt="" class="w-7 w-7">
                            <h2 class="text-medium font-normal dark:text-white">Departments</h2>
                        </button>
                        <button class="w-full h-[7vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row justify-center items-center hover:translate-y-1.5 transition duration-200 space-x-3" data-toggle-section="leave-form-content"  onclick="navigateTo('leave-form', this)">
                            <img src="{{URL('images/requests.png')}}" alt="" class="w-7 w-7">
                            <h2 class="text-medium font-normal dark:text-white">Requests</h2>
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

                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden ml-auto">
                            <input 
                                type="text" 
                                name="search" 
                                class="w-full py-1 px-4" 
                                placeholder="Search employee..."
                            >
                            <button class="px-4 focus:scale-110">
                                <img src="{{ asset('images/search_emp.png') }}" alt="Search Icon" class="w-7 h-auto">
                            </button>
                        </div>
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
                                    REQUESTS
                                </th>
                                <th class="w-auto px-4 py-2 text-normal opacity-50 text-xl font-normal dark:text-gray-100">
                                    DATE HIRED
                                </th>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="text-normal text-sm font-bold py-3 px-2 dark:text-white">1</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="text-normal text-sm font-bold py-3 px-2 dark:text-white">1</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="text-normal text-sm font-bold py-3 px-2 dark:text-white">1</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="text-normal text-sm font-bold py-3 px-2 dark:text-white">1</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="text-normal text-sm font-bold py-3 px-2 dark:text-white">1</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="text-normal text-sm font-bold py-3 px-2 dark:text-white">1</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                    <td class="text-normal text-sm font-bold py-3 px-2 text-center dark:text-white">Ryan Mark</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <button class="w-full h-[7vh] flex flex-row gap-4 justify-center items-center bg-white dark:bg-gray-700 rounded-2xl shadow-xl hover:scale-105 transition duration-200">
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
                            <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">DEPARTMENT</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">EVALUATED BY</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">EMPLOYEE</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">RECOMMENDED ACTION</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">STATUS</th>
                            <th class="text-lg font-semibold opacity-50 dark:text-gray-100">DATE</th>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-400 transition duration-300">
                                <td class="text-medium font-normal text-center dark:text-white">MS-IT</td>
                                <td class="text-medium font-normal text-center dark:text-white">
                                    <a href="">
                                        <span class="dark:text-white ">Martin Calpo</span>
                                    </a>
                                </td>
                                <td class="text-medium font-normal text-center">
                                    <a href="">
                                        <span class="dark:text-white" >Leomar Montoya</span>
                                    </a>
                                </td>
                                <td class="text-medium font-bold text-red-700 text-center ">Counseling</td>
                                <td class="text-medium font-bold text-green-700 text-center">5.0</td>
                                <td class="text-medium font-normal text-center dark:text-white ">08-05-2024</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-400 transition duration-300">
                                <td class="text-medium font-normal text-center dark:text-white">MS-IT</td>
                                <td class="text-medium font-normal text-center dark:text-white">
                                    <a href="">
                                        <span class="dark:text-white ">Martin Calpo</span>
                                    </a>
                                </td>
                                <td class="text-medium font-normal text-center">
                                    <a href="">
                                        <span class="dark:text-white" >Leomar Montoya</span>
                                    </a>
                                </td>
                                <td class="text-medium font-bold text-red-700 text-center ">Counseling</td>
                                <td class="text-medium font-bold text-green-700 text-center">5.0</td>
                                <td class="text-medium font-normal text-center dark:text-white ">08-05-2024</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-400 transition duration-300">
                                <td class="text-medium font-normal text-center dark:text-white">MS-IT</td>
                                <td class="text-medium font-normal text-center dark:text-white">
                                    <a href="">
                                        <span class="dark:text-white ">Martin Calpo</span>
                                    </a>
                                </td>
                                <td class="text-medium font-normal text-center">
                                    <a href="">
                                        <span class="dark:text-white" >Leomar Montoya</span>
                                    </a>
                                </td>
                                <td class="text-medium font-bold text-red-700 text-center ">Counseling</td>
                                <td class="text-medium font-bold text-green-700 text-center">5.0</td>
                                <td class="text-medium font-normal text-center dark:text-white ">08-05-2024</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-400 transition duration-300">
                                <td class="text-medium font-normal text-center dark:text-white">MS-IT</td>
                                <td class="text-medium font-normal text-center dark:text-white">
                                    <a href="">
                                        <span class="dark:text-white ">Martin Calpo</span>
                                    </a>
                                </td>
                                <td class="text-medium font-normal text-center">
                                    <a href="">
                                        <span class="dark:text-white" >Leomar Montoya</span>
                                    </a>
                                </td>
                                <td class="text-medium font-bold text-red-700 text-center ">Counseling</td>
                                <td class="text-medium font-bold text-green-700 text-center">5.0</td>
                                <td class="text-medium font-normal text-center dark:text-white ">08-05-2024</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-400 transition duration-300">
                                <td class="text-medium font-normal text-center dark:text-white">MS-IT</td>
                                <td class="text-medium font-normal text-center dark:text-white">
                                    <a href="">
                                        <span class="dark:text-white ">Martin Calpo</span>
                                    </a>
                                </td>
                                <td class="text-medium font-normal text-center">
                                    <a href="">
                                        <span class="dark:text-white" >Leomar Montoya</span>
                                    </a>
                                </td>
                                <td class="text-medium font-bold text-red-700 text-center ">Counseling</td>
                                <td class="text-medium font-bold text-green-700 text-center">5.0</td>
                                <td class="text-medium font-normal text-center dark:text-white ">08-05-2024</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--ATTENDANCE contents-->
    <section class="section w-full p-4" id="attendance-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Attendance</h1>
        <!--whole section-->
        <div class="w-full h-auto p-4 flex flex-col gap-3">
            <!--first row-->
            <div class="w-full h-auto flex flex-row">
                <!--buttons-->
                <div class="w-1/2 h-auto flex flex-row items-center gap-3">
                    <button class="w-full h-[8vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row gap-2 items-center justify-center hover:scale-105 transition duration-200">
                        <img src="{{URL('images/input_att.png')}}" alt="" class="w-7">
                        <h2 class="text-lg dark:text-white">Input Attendance</h2>
                    </button>
                    <button class="w-full h-[8vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl flex flex-row gap-2 items-center justify-center hover:scale-105 transition duration-200">
                        <img src="{{URL('images/edit_att.png')}}" alt="" class="w-7">
                        <h2 class="text-lg dark:text-white">Edit Attendance</h2>
                    </button>
                    <button class="flex justify-center items-center w-[20vh] h-[8vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl hover:scale-105 transition duration-200 search-button">
                            <img src="{{URL('images/search.png')}}" alt="search Admin Management" class="w-8 h-8">
                    </button>
                </div>
            </div>

            <!--second row-->
            <div class="w-full h-[76vh] bg-white dark:bg-gray-700 rounded-2xl shadow-xl p-3">
                <div class="flex flex-col w-full h-auto p-3 gap-3">
                    <div class="flex flex-row w-full h-auto items-center">
                        <h1 class="text-lg font-bold dark:text-white">ATTENDANCE OVERVIEW</h1>
                        <a href="" class="text-medium underline hover:text-red-600 dark:text-white dark:hover:text-red-300 hover:font-bold ml-auto">View All...</a>
                    </div>

                    <!--table for attendace over view-->
                    <table class="p-4">
                        <thead class="bg-gray-100 dark:bg-gray-500">
                            <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">ID</th>
                            <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">NAME</th>
                            <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">DATE</th>
                            <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">TIME-IN</th>
                            <th class="text-lg font-semibold opacity-50 py-2 dark:text-gray-100">TIME-OUT</th>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="text-medium text-center py-3 dark:text-white">1</td>
                                <td class="text-medium text-center py-3 dark:text-white">Ryan Mark</td>
                                <td class="text-medium text-center py-3 dark:text-white">08-13-2024</td>
                                <td class="text-medium text-center py-3 dark:text-white">7:00am</td>
                                <td class="text-medium text-center py-3 dark:text-white">6:00pm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--LEAVE & ABSENCES contents-->
    <section class="section w-full p-4" id="leave-absence-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Leave & Absence</h1>

        <!--Whole section-->
        <div class="w-full h-auto p-4 flex flex-col gap-4">
            <!--go to your space button-->
            <div class="w-full h-auto">
                <button class="w-[25vh] h-[7vh] bg-white dark:bg-gray-700 flex flex-row gap-3 justify-center items-center rounded-2xl shadow-xl hover:scale-110 transition duration-300" data-toggle-section="leave-form-content"  onclick="navigateTo('leave-form', this)">
                    <img src="{{URL('images/add_request.png')}}" alt="" class="w-7 h-7">
                    <h2 class="text-medium dark:text-white">Request a Leave</h2>
                </button>
            </div>
            <!--employee leave requests overview-->
            <div class="w-full h-[76vh] flex flex-col p-5 gap-8 bg-white dark:bg-gray-700 rounded-2xl shadow-2xl">
                <!--buttons-->
                <div class="w-full flex flex-row items-center">
                    <h1 class="w-full text-2xl font-bold dark:text-white">Leave Requests</h1>
                    <div class=" ml-auto flex flex-row items-center justify-center gap-3">
                        <button class="w-[5vh] h-[5vh] flex items-center justify-center bg-gray-200 dark:bg-gray-500 rounded-full shadow-xl hover:scale-110 transition duration-200">
                            <img src="{{URL('images/edit.png')}}" alt="" data-light-src="{{URL('images/edit.png')}}" data-dark-src="{{URL('images/edit_dark.png')}}" class="w-5 h-5">
                        </button>
                        <button class="w-[5vh] h-[5vh] flex items-center justify-center bg-gray-200 dark:bg-gray-500 rounded-full shadow-xl hover:scale-110 transition duration-200">
                            <img src="{{URL('images/refresh.png')}}" alt="" data-light-src="{{URL('images/refresh.png')}}" data-dark-src="{{URL('images/refresh_dark.png')}}" class="w-6 h-6">
                        </button>
                    </div>
                </div>

                <!--table for leave requests-->
                <table>
                    <thead class="w-full h-auto bg-gray-100 dark:bg-gray-500">
                        <th class="text-medium py-3 font-medium dark:text-gray-200">NAME</th>
                        <th class="text-medium py-3 font-medium dark:text-gray-200">LEAVE TYPE</th>
                        <th class="text-medium py-3 font-medium dark:text-gray-200">DEPARTMENT</th>
                        <th class="text-medium py-3 font-medium dark:text-gray-200">START</th>
                        <th class="text-medium py-3 font-medium dark:text-gray-200">END</th>
                        <th class="text-medium py-3 font-medium dark:text-gray-200">Appraisal of Supervisor</th>
                        <th class=""></th>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="text-sm py-3 font-normal text-center">
                                <a href="" class="no-underline dark:text-white">Ryan Mark Luis</a>
                            </td>
                            <td class="text-sm py-3 font-normal text-center">
                                <span class="w-full py-1 px-2 text-white font-semibold bg-blue-600 rounded-lg shadow-lg">
                                    Vacation
                                </span>
                            </td>
                            <td class="text-sm py-3 font-normal text-center dark:text-white">MS-IT</td>
                            <td class="text-sm py-3 font-normal text-center dark:text-white">08-16-2024</td>
                            <td class="text-sm py-3 font-normal text-center dark:text-white">08-24-2024</td>
                            <td class="text-sm py-3 font-normal text-center ">
                                <span class="w-full py-1 px-2 text-white font-semibold bg-green-600 rounded-lg shadow-lg">
                                    Approved
                                </span>
                            </td>
                            <td class="text-sm py-3 font-bold">
                                <a href="" class="underline hover:text-red-600 ransition duration-300 dark:text-white">View details...</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!--SETTINGS contents-->
    <section class="section w-full p-4" id="settings-content">
        <h1 class="text-3xl font-bold mb-3 dark:text-white">Settings</h1>
        
      
      
    </section>

    <!--add employee section-->
    <section id="add-employee-content" class="section hidden w-full h-screen p-7">

        <div class="flex flex-row w-full h-[10vh] items-center justify-start">
            <button class=" w-14 p-2 hover:scale-125 transition duration-200" onclick="navigateTo('dashboard', this)">
                <img src="{{URL('images/goback.png')}}" alt="" data-light-src="{{URL('images/goback.png')}}" data-dark-src="{{URL('images/goback_dark.png')}}" class="w-12">
            </button>
        </div>
    <!--FORM 201-->
        <div class="w-full bg-white dark:bg-gray-300 md:h-[85vh] h-[calc(100vh-100px)] rounded-lg overflow-y-auto p-4 shadow-2xl">
            <div class="bg-white dark:bg-gray-200 shadow-md rounded-lg overflow-hidden p-7 space-y-1">
                <h1 class="text-4xl sm:text-2xl font-bold text-center">Form 201</h1>
                <p class="text-lg sm:text-sm italic text-center">Fill out the form below</p>

                        <!--upload picture-->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Upload image</label>
                    <input class="block w-1/4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                </div>
                        <!--general form-->
                <form action="#" method="POST" class="space-y-5">

                        <!--personal information section-->
                    <div class="p-5">
                        <h3 class="text-lg font-medium text-gray-800 text-left">-Personal Information-</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-600">First Name:</label>
                                <input type="text" id="w_firstName" name="firstName" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="First name" required>
                            </div>
                            <div>
                                <label for="middleName" class="block text-sm font-medium text-gray-600">Middle Name:</label>
                                <input type="text" id="w_middleName" name="middleName" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Middle name" required>
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-600">Last Name:</label>
                                <input type="text" id="w_lastName" name="lastName" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Last name" required>
                            </div>
                           
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <label for="birthday" class="block text-sm font-medium text-gray-600">Birth date:</label>
                                <input type="text" id="w_birthdate" name="birthdate" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Birth date" required>
                            </div>
                            <div>
                                <label for="birthplace" class="block text-sm font-medium text-gray-600">Birth place:</label>
                                <input type="text" id="w_birthplace" name="birthplace" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Birth place" required>
                            </div>
                            <div>
                                <label for="civilstatus" class="block text-sm font-medium text-gray-600">Civil Status:</label>
                                <input type="text" id="w_civilstatus" name="civilstatus" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Civil status" required>
                            </div>
                        </div>
                    </div>

                        <!--Contact information section-->
                    <div class="p-5">
                        <h3 class="text-lg font-medium text-gray-800 text-left">-Contact Information-</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-600">Email:</label>
                                <input type="text" id="w_email" name="Email" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Email" required>
                            </div>
                            <div>
                                <label for="contactNo" class="block text-sm font-medium text-gray-600">Contact Number:</label>
                                <input type="text" id="w_contactNo" name="contactNumber" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Contact Number" required>
                            </div>
                            <div>
                                <label for="telephoneNo" class="block text-sm font-medium text-gray-600">Telephone Number:</label>
                                <input type="text" id="w_telephoneNum" name="TelephoneNumber" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Telephone Number" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <label for="permaddress" class="block text-sm font-medium text-gray-600">Permanent Address:</label>
                                <input type="text" id="w_Currentaddress" name="PermanentAddress" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Permanent Address" required>
                            </div>
                            <div>
                                <label for="currentaddress" class="block text-sm font-medium text-gray-600">Current Address:</label>
                                <input type="text" id="w_Currentaddress" name="CurrentAddress" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Current Address" required>
                            </div>
                        </div>
                    </div>

                        <!--Governement information-->
                        <div class="p-5">
                            <h3 class="text-lg font-medium text-gray-800 text-left">-Government Identification-</h3>
                            
                            <!-- SSS ID -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                <div>
                                    <label for="sssid" class="block text-sm font-medium text-gray-600">SSS ID:</label>
                                    <input type="text" id="w_sss" name="sssId" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="00-0000000-0" maxlength="12" required>
                                    <p id="sssError" class="text-red-500 text-sm hidden">Continue typing until the designated format are met.  (00-0000000-0).</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Upload scanned files <span class="text-sm italic font-normal">*if available</span></label>
                                    <input class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                                </div>
                            </div>

                            <!-- PhilHealth ID -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                <div>
                                    <label for="philhealthid" class="block text-sm font-medium text-gray-600">PhilHealth ID:</label>
                                    <input type="text" id="w_philhealth" name="philhealthId" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="00-00000000-0" maxlength="13" required>
                                    <p id="philhealthError" class="text-red-500 text-sm hidden">Continue typing until the designated format are met.  (00-00000000-0).</p>
                                </div>
                            </div>

                            <!-- PAGIBIG -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                <div>
                                    <label for="Pagibig" class="block text-sm font-medium text-gray-600">PAGIBIG:</label>
                                    <input type="text" id="w_pagibig" name="Pagibig" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="0000-0000-0000" maxlength="14" required>
                                    <p id="pagibigError" class="text-red-500 text-sm hidden">Continue typing until the designated format are met.  (0000-0000-0000).</p>
                                </div>
                            </div>

                            <!-- TIN Number -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                <div>
                                    <label for="TIN" class="block text-sm font-medium text-gray-600">TIN Number:</label>
                                    <input type="text" id="w_tin" name="TINno" class="w-full mt-2 p-2 border rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="000-000-000-000" maxlength="15" required>
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

                    
                        <!--Work History-->
                    <div class="p-5">
                        <h3 class="text-lg font-medium text-gray-800 text-left">-Work History-</h3>
                        <div id="work-history-container" class="space-y-4 mt-6">
                    <!-- Work History Entry Template -->
                            <div class="work-history-entry p-4 bg-white border border-gray-300 rounded-md">
                                <label for="job-title-1" class="block text-sm font-medium text-gray-700">Job Title:</label>
                                <input type="text" id="job-title-1" name="job_titles[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                <label for="Company" class="block text-sm font-medium text-gray-700">Company:</label>
                                <input type="text" id="company" name="company[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <label for="start-date-1" class="block text-sm font-medium text-gray-700 mt-4">Start Date</label>
                                        <input type="date" id="start-date-1" name="start_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="end-date-1" class="block text-sm font-medium text-gray-700 mt-4">End Date</label>
                                        <input type="date" id="end-date-1" name="end_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <label for="Remarks" class="block text-sm font-medium text-gray-700">Remarks:</label>
                                <input type="text" id="remarks" name="remarks[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                
                                <button type="button" class="remove-entry mt-4 text-red-500 hover:text-red-700">
                                    Remove
                                </button>
                            </div>
                        </div>
                                <button type="button" id="add-work-history" class="mt-4 inline-flex items-center px-3 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add more Work History
                                </button>

                        <!--adding employee script-->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                let workHistoryCounter = 1;

                                // Event listener for adding new work history entry
                                document.getElementById('add-work-history').addEventListener('click', function() {
                                    workHistoryCounter++;
                                    const container = document.getElementById('work-history-container');
                                    const newEntry = document.createElement('div');
                                    newEntry.className = 'work-history-entry p-4 bg-white border border-gray-300 rounded-md';

                                    newEntry.innerHTML = `
                                        <label for="job-title-${workHistoryCounter}" class="block text-sm font-medium text-gray-700">Job Title:</label>
                                        <input type="text" id="job-title-${workHistoryCounter}" name="job_titles[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                        <label for="company-${workHistoryCounter}" class="block text-sm font-medium text-gray-700 mt-4">Company:</label>
                                        <input type="text" id="company-${workHistoryCounter}" name="companies[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                            <div>
                                                <label for="start-date-${workHistoryCounter}" class="block text-sm font-medium text-gray-700 mt-4">Start Date:</label>
                                                <input type="date" id="start-date-${workHistoryCounter}" name="start_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label for="end-date-${workHistoryCounter}" class="block text-sm font-medium text-gray-700 mt-4">End Date:</label>
                                                <input type="date" id="end-date-${workHistoryCounter}" name="end_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <label for="remarks-${workHistoryCounter}" class="block text-sm font-medium text-gray-700 mt-4">Remarks:</label>
                                        <input type="text" id="remarks-${workHistoryCounter}" name="remarks[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                        <button type="button" class="remove-entry mt-4 text-red-500 hover:text-red-700">
                                            Remove
                                        </button>
                                    `;

                                    container.appendChild(newEntry);

                                    // Add event listener to the new remove button
                                    newEntry.querySelector('.remove-entry').addEventListener('click', function() {
                                        newEntry.remove();
                                    });
                                });

                                // Initial event listener for existing remove buttons
                                document.querySelectorAll('.remove-entry').forEach(button => {
                                    button.addEventListener('click', function() {
                                        button.parentElement.remove();
                                    });
                                });
                            });
                        </script>

                    </div>

                <!--education background-->
                <div class="p-5">
                    <h3 class="text-lg font-medium text-gray-800 text-left">-Educational Background-</h3>
                    <div class="p-5">

                    <!-- High School Section -->
                    <div class="mt-6">
                        <h4 class="text-md font-medium text-gray-700">High School</h4>
                        <div id="high-school-container" class="space-y-4">
                            <!-- High School Entry Template -->
                            <div class="high-school-entry p-4 bg-white border border-gray-300 rounded-md">
                                <label for="high-school-name-1" class="block text-sm font-medium text-gray-700">School Name:</label>
                                <input type="text" id="high-school-name-1" name="high_school_names[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <label for="high-school-start-date-1" class="block text-sm font-medium text-gray-700 mt-4">Start Date:</label>
                                        <input type="date" id="high-school-start-date-1" name="high_school_start_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="high-school-end-date-1" class="block text-sm font-medium text-gray-700 mt-4">End Date:</label>
                                        <input type="date" id="high-school-end-date-1" name="high_school_end_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <button type="button" class="remove-high-school-entry mt-4 text-red-500 hover:text-red-700">
                                    Remove
                                </button>
                            </div>
                        </div>
                        
                        <button type="button" id="add-high-school" class="mt-4 inline-flex items-center px-3 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add High School
                        </button>
                    </div>

                    <!-- College Section -->
                    <div class="mt-6">
                        <h4 class="text-md font-medium text-gray-700">College</h4>
                        <div id="college-container" class="space-y-4">
                            <!-- College Entry Template -->
                            <div class="college-entry p-4 bg-white border border-gray-300 rounded-md">
                                <label for="college-name-1" class="block text-sm font-medium text-gray-700">School Name:</label>
                                <input type="text" id="college-name-1" name="college_names[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                
                                <label for="course-1" class="block text-sm font-medium text-gray-700 mt-4">Course:</label>
                                <input type="text" id="course-1" name="courses[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <label for="college-start-date-1" class="block text-sm font-medium text-gray-700 mt-4">Start Date:</label>
                                        <input type="date" id="college-start-date-1" name="college_start_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="college-end-date-1" class="block text-sm font-medium text-gray-700 mt-4">End Date:</label>
                                        <input type="date" id="college-end-date-1" name="college_end_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <label for="achievement-1" class="block text-sm font-medium text-gray-700 mt-4">Academic Achievement:</label>
                                <input type="text" id="achievement-1" name="achievements[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                <button type="button" class="remove-college-entry mt-4 text-red-500 hover:text-red-700">
                                    Remove
                                </button>
                            </div>
                        </div>

                        <button type="button" id="add-college" class="mt-4 inline-flex items-center px-3 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add College
                        </button>
                    </div>
                </div>
                        <!--add schools script-->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                let highSchoolCounter = 1;
                                let collegeCounter = 1;

                                // High School: Add Entry
                                document.getElementById('add-high-school').addEventListener('click', function() {
                                    highSchoolCounter++;
                                    const container = document.getElementById('high-school-container');
                                    const newEntry = document.createElement('div');
                                    newEntry.className = 'high-school-entry p-4 bg-white border border-gray-300 rounded-md';

                                    newEntry.innerHTML = `
                                        <label for="high-school-name-${highSchoolCounter}" class="block text-sm font-medium text-gray-700">School Name:</label>
                                        <input type="text" id="high-school-name-${highSchoolCounter}" name="high_school_names[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                            <div>
                                                <label for="high-school-start-date-${highSchoolCounter}" class="block text-sm font-medium text-gray-700 mt-4">Start Date:</label>
                                                <input type="date" id="high-school-start-date-${highSchoolCounter}" name="high_school_start_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label for="high-school-end-date-${highSchoolCounter}" class="block text-sm font-medium text-gray-700 mt-4">End Date:</label>
                                                <input type="date" id="high-school-end-date-${highSchoolCounter}" name="high_school_end_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <button type="button" class="remove-high-school-entry mt-4 text-red-500 hover:text-red-700">
                                            Remove
                                        </button>
                                    `;

                                    container.appendChild(newEntry);

                                    // Add event listener to the new remove button
                                    newEntry.querySelector('.remove-high-school-entry').addEventListener('click', function() {
                                        newEntry.remove();
                                    });
                                });

                                // High School: Initial Remove Button
                                document.querySelectorAll('.remove-high-school-entry').forEach(button => {
                                    button.addEventListener('click', function() {
                                        button.parentElement.remove();
                                    });
                                });

                                // College: Add Entry
                                document.getElementById('add-college').addEventListener('click', function() {
                                    collegeCounter++;
                                    const container = document.getElementById('college-container');
                                    const newEntry = document.createElement('div');
                                    newEntry.className = 'college-entry p-4 bg-white border border-gray-300 rounded-md';

                                    newEntry.innerHTML = `
                                        <label for="college-name-${collegeCounter}" class="block text-sm font-medium text-gray-700">School Name:</label>
                                        <input type="text" id="college-name-${collegeCounter}" name="college_names[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        
                                        <label for="course-${collegeCounter}" class="block text-sm font-medium text-gray-700 mt-4">Course:</label>
                                        <input type="text" id="course-${collegeCounter}" name="courses[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                            <div>
                                                <label for="college-start-date-${collegeCounter}" class="block text-sm font-medium text-gray-700 mt-4">Start Date:</label>
                                                <input type="date" id="college-start-date-${collegeCounter}" name="college_start_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label for="college-end-date-${collegeCounter}" class="block text-sm font-medium text-gray-700 mt-4">End Date:</label>
                                                <input type="date" id="college-end-date-${collegeCounter}" name="college_end_dates[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <label for="achievement-${collegeCounter}" class="block text-sm font-medium text-gray-700 mt-4">Academic Achievement:</label>
                                        <input type="text" id="achievement-${collegeCounter}" name="achievements[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                        <button type="button" class="remove-college-entry mt-4 text-red-500 hover:text-red-700">
                                            Remove
                                        </button>
                                    `;

                                    container.appendChild(newEntry);

                                    // Add event listener to the new remove button
                                    newEntry.querySelector('.remove-college-entry').addEventListener('click', function() {
                                        newEntry.remove();
                                    });
                                });

                                // College: Initial Remove Button
                                document.querySelectorAll('.remove-college-entry').forEach(button => {
                                    button.addEventListener('click', function() {
                                        button.parentElement.remove();
                                    });
                                });
                            });
                        </script>

                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Submit
                    </button>
                </div>
                </form>


            </div>
        </div>

        
    </section>

    <!--performance form section-->
    <section id="performance-form-content" class="section hidden w-full h-screen p-7">
        <!--whole section-->
        <div class="w-full h-auto p-4 flex flex-col gap-3">
            <div class="w-full flex flex-row items-center p-3 gap-5">
               <button  class=" hover:scale-125 transition duration-200">
                    <img src="{{URL('images/goback.png')}}" alt="" data-light-src="{{URL('images/goback.png')}}" data-dark-src="{{URL('images/goback_dark.png')}}" class="w-10" onclick="navigateTo('performance-evaluation', this)">
                </button>
            </div>

            <!--employee evaluation information-->
            <div class="w-full p-2">
                <form action="#" method="POST" class="space-x-3 flex flex-row">
                    <div class="w-full flex flex-row">
                         <!--first col-->
                        <div class="w-full flex flex-col gap-2">
                            <div class="w-full flex flex-row items-center gap-2">
                                <label for="name" class="text-medium font-normal text-black dark:text-white">
                                    Name of Employee:
                                </label>
                                <input type="text" id="name" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Name...">
                            </div>

                            <div class="flex flex-row items-center gap-2">
                                <label for="position" class="text-medium font-normal text-black dark:text-white">
                                    Job Title / Position:
                                </label>
                                <input type="text" id="position" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Position...">
                            </div>

                            <div class="flex flex-row items-center gap-2">
                                <label for="period" class="text-medium font-normal text-black dark:text-white">
                                    Period Covered: 
                                </label>
                                <div class="flex flex-col gap-2">
                                    <span class="flex flex-row items-center">
                                        <p class="text-[14px] font-normal italic text-black dark:text-white opacity-60">
                                            Start Date:
                                        </p>
                                        <input type="date" id="start-period" class="w-48 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Position...">
                                    </span>
                                    <span class="flex flex-row items-center">
                                        <p class="text-[14px] font-normal italic text-black dark:text-white opacity-60">
                                            End Date:
                                        </p>
                                        <input type="date" id="end-period" class="w-48 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Position...">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!--second col -->
                        <div class="w-full flex flex-col gap-2">
                            <div class="w-full flex flex-row items-center gap-2">
                                <label for="hired-date" class="text-medium font-normal text-black dark:text-white">
                                    Date hired:
                                </label>
                                <input type="date" id="hired-date" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Hired date...">
                            </div>

                            <div class="flex flex-row items-center gap-2">
                                <label for="department" class="text-medium font-normal text-black dark:text-white">
                                    Department:
                                </label>
                                <input type="text" id="department" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Department...">
                            </div>

                            <div class="flex flex-row items-center gap-2">
                                <label for="evaluate-by" class="text-medium font-normal text-black dark:text-white">
                                    Evaluated by:
                                </label>
                                <input type="text" id="evaluate-by" class="w-72 p-1 bg-white dark:bg-gray-100 border-2 border-gray-200 rounded-md " placeholder="Evaluated by...">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--evaluation form-->
            <div class="w-full bg-white dark:bg-gray-300 md:h-[55vh] h-[calc(55vh-100px)] rounded-lg overflow-y-auto p-4 shadow-2xl">
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
                                        <input type="text" id="eval-1" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                        <input type="text" id="eval-2" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                        <input type="text" id="eval-3" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                        <input type="text" id="eval-4" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                        <input type="text" id="eval-5" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                        <input type="text" id="eval-6" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                            <input type="text" id="eval-7" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                        <input type="text" id="eval-8" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                        <input type="text" id="eval-9" class="w-[10vh] p-2 rounded-lg text-center border-2 border-gray-400" placeholder="1-5">
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
                                                <label class="flex items-center">
                                                    <input type="radio" name="action" value="retention" class="form-radio text-blue-600" checked>
                                                    <span class="ml-2">Retention</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" name="action" value="counseling" class="form-radio text-blue-600">
                                                    <span class="ml-2">Counseling</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" name="action" value="pay_adjustment" class="form-radio text-blue-600">
                                                    <span class="ml-2">Pay Adjustment</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" name="action" value="training" class="form-radio text-blue-600">
                                                    <span class="ml-2">Training</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" name="action" value="transfer" class="form-radio text-blue-600">
                                                    <span class="ml-2">Transfer</span>
                                                </label>
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
                                <tr>
                                    <td>
                                    <button class="w-[15vh] h-[5vh] ml-auto mt-5 rounded-lg bg-blue-500 items-center text-medium font-bold text-white hover:scale-110 transition duration-200">
                                            Submit
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    
    <!--leave form section-->
    <section id = "leave-form-content" class="section hidden w-full h-screen p-7">
        
        <!--whole section-->
        <div class="w-full h-auto p-4 flex flex-col gap-3">
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

                        <form action="" method="POST" class="space-y-2 w-full">
                            <!-- Leave Type Dropdown -->
                            <div class="mb-4">
                                <label for="leave-type" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Leave Type</label>
                                <select id="leave-type" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-black dark:text-white" onchange="handleLeaveTypeChange()">
                                    <option value="sick">Sick Leave</option>
                                    <option value="vacation">Vacation Leave</option>
                                    <option value="emergency">Emergency Leave</option>
                                    <option value="maternity">Maternity Leave</option>
                                    <option value="bereavement">Bereavement Leave</option>
                                    <option value="casual">Casual Leave</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Other Leave Type Textbox (Initially Hidden) -->
                            <div id="other-leave-type-container" class="mb-4 hidden">
                                <label for="other-leave-type" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Please Specify</label>
                                <input type="text" id="other-leave-type" name="other-leave-type" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-black dark:text-white">
                            </div>

                            <!-- Reason Textbox -->
                            <div class="mb-4">
                                <label for="reason" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Reason</label>
                                <textarea id="reason" class="w-full p-2 border border-gray-300 dark:border-white rounded-md h-32 resize-none bg-white dark:bg-gray-800 text-black dark:text-white" placeholder="Enter the reason for your leave..."></textarea>
                            </div>

                            <!-- Start Date Calendar -->
                            <div class="mb-4">
                                <label for="start-date" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Start Date</label>
                                <input type="date" id="start-date" class="w-full p-2 border border-gray-300 dark:border-white rounded-md bg-white dark:bg-gray-800 text-black dark:text-white">
                            </div>

                            <!-- End Date Calendar -->
                            <div class="mb-6">
                                <label for="end-date" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">End Date</label>
                                <input type="date" id="end-date" class="w-full p-2 border border-gray-300 dark:border-white rounded-md bg-white dark:bg-gray-800 text-black dark:text-white">
                            </div>

                            <!-- Submit Button -->
                            <button class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-200">
                                Submit
                            </button>
                        </form>
                    </div>

                    <!--leave balance-->
                    <div class="w-[20vh] h-[35vh] flex flex-col item-center p-3 justify-start bg-white dark:bg-gray-700 rounded-xl shadow-2xl">
                        <h1 class="text-xl font-bold text-black dark:text-white">BALANCES:</h1>

                        <span class="w-full flex flex-col items-center justify-center gap-2 p-2">
                            <h3 class="text-sm font-normal text-black dark:text-white text-center">Vacation Leave</h3>
                            <span class="w-14 h-14 bg-blue-500 flex items-center justify-center rounded-full shadow-xl">
                                <h1 class="text-lg font-bold text-white">8.56</h1>
                            </span>
                        </span>
                        <span class="w-full flex flex-col items-center justify-center gap-2 p-2">
                            <h3 class="text-sm font-normal text-black dark:text-white">Sick Leave</h3>
                            <span class="w-14 h-14 bg-blue-500 flex items-center justify-center rounded-full shadow-xl">
                                <h1 class="text-lg font-bold text-white">8.56</h1>
                            </span>
                        </span>
                        
                    </div>
                </div>

                <!--script for others type of leave-->
                <script>
                    function handleLeaveTypeChange() {
                        const leaveType = document.getElementById('leave-type').value;
                        const otherLeaveTypeContainer = document.getElementById('other-leave-type-container');
                        const otherLeaveTypeInput = document.getElementById('other-leave-type');

                        if (leaveType === 'other') {
                            otherLeaveTypeContainer.classList.remove('hidden');
                            otherLeaveTypeInput.setAttribute('required', true);
                        } else {
                            otherLeaveTypeContainer.classList.add('hidden');
                            otherLeaveTypeInput.removeAttribute('required');
                        }
                    }
                </script>

            </div>
        
    </section>

    <!--announce modal-->
    <div id="announceModal" class="fixed flex items-center inset-0 bg-white bg-opacity-50 items-center justify-center hidden z-50">
        
        <div class="flex flex-col bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full justify-center">
        
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-black dark:text-white">Create an Announcement</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 dark:text-white dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="p-4 flex flex-col gap-2">
               <div class="flex flex-col">
                    <h2 class="text-md font-medium dark:text-white">
                        Subject:
                    </h2>
                    <input type="text" id="subject" class="w-full p-2 h-[5vh] rounded-lg border-2 border-gray-200" placeholder="Subject..." required>
               </div>
               <div class="flex flex-col">
                    <h2 class="text-md font-medium dark:text-white">
                        Announcement:
                    </h2>
                    <textarea id="announcement" class="w-full p-2 h-[10vh] rounded-lg border-2 border-gray-200" placeholder="announcement" required>
                    </textarea>
               </div>
               
            </div>

            <button class="w-[10vh] h-[6vh] rounded-lg shadow-md bg-blue-500 text-lg font-bold text-white text-center hover:scale-110 transition duration-200 ml-auto">
                Post
            </button>
        </div>
    </div>


    <!--help evaluation modal-->
    <div id="helpModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <!-- Modal Content -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold dark:text-blac">Evaluation Help </h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 dark:text-white dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
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

    <!--script of announce Modal-->
    <script>
        document.getElementById('announcementButton').addEventListener('click', function() {
            document.getElementById('announceModal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('announceModal').classList.add('hidden');
        });

        document.getElementById('closeButton').addEventListener('click', function() {
            document.getElementById('announceModal').classList.add('hidden');
        });
    </script>

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

            // Update the document title based on the clicked element
            document.title = element.textContent.trim() + ' - INX10';

            // Optional: Update the active class on navigation
            const navItems = document.querySelectorAll('.sidebar-item');
            navItems.forEach(item => {
                item.classList.remove('font-bold');
            });
            element.classList.add('font-bold');
        }

        // Initial load: Activate the default section (Dashboard)
        document.addEventListener('DOMContentLoaded', () => {
            navigateTo('dashboard', document.querySelector('.sidebar-item'));
        });
    </script>


</body>
</html>