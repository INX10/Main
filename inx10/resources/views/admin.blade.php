<!DOCTYPE html>
<html lang="en">
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
        max-width: 200px; /* Adjust the max width if needed */
        white-space: normal; /* Allow text wrapping */
        z-index: 10; /* Ensure tooltip is above other elements */
        }
    </style>
</head>
<body class="bg-[#ededed] flex">

    <!--side panel-->
    <aside class="w-1/4 h-screen bg-white shadow-lg flex flex-col items-start p-4">
        <div class="mb-10 mt-5 flex justify-center">
            <img src="{{ URL('images/inx10_final_logo.png') }}" alt="INX10 Logo" class="w-40 h-auto ml-14 hidden lg:block">
            <img src="{{ URL('images/INX10_soloLogo.png') }}" alt="INX10 Solo Logo"  class="w-10 h-auto mb-1 block lg:hidden">
        </div>

        <nav class="w-full h-auto">
            <ul>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300 " onclick="navigateTo('dashboard', this)">
                        <img src="{{URL('images/dashboard.png')}}" alt="dashboard logo" class="w-8 h-auto mr-2">
                        <span class="hidden lg:block lg:text-lg">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('calendar', this)">
                        <img src="{{URL('images/calendar.png')}}" alt="calendar logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Calendar</span>
                    </a>
                </li>
                <li class="mt-6 text-gray-500 text-sm lg:text-xs font-semibold">HRS:</li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('admin-management', this)">
                        <img src="{{URL('images/adminManagement.png')}}" alt="admin management logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Admin Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('employee-management', this)">
                        <img src="{{URL('images/employeeManagement.png')}}" alt="employee management logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Employee Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('performance-evaluation', this)">
                        <img src="{{URL('images/performanceManagement.png')}}" alt="performance evaluation logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Performance Evaluation</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('attendance', this)">
                        <img src="{{URL('images/attendance.png')}}" alt="attendance logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('leave-absence', this)">
                        <img src="{{URL('images/leaveAbsence.png')}}" alt="leave and absence logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Leave & Absence</span>
                    </a>
                </li>
                <li class="mt-6 text-gray-500 text-sm lg:text-xs font-semibold">EXTENSIONS:</li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('storage', this)">
                        <img src="{{URL('images/storage.png')}}" alt="storage logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Storage</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center py-3 px-2 mb-1 text-lg text-gray-700 hover:font-bold hover:translate-x-2 transition-all duration-300" onclick="navigateTo('settings', this)">
                        <img src="{{URL('images/settings.png')}}" alt="settings logo" class="w-7 h-auto mr-2">
                        <span class="hidden lg:block">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!--DASHBOARD contents-->
    <section class="section active w-full p-3" id="dashboard-content">
        
            <h1 class="text-3xl font-bold sticky">Dashboard</h1>
    <!--whole section flex-->
            <div class="flex flex-row w-full h-auto gap-3.5">
    <!--left panel content-->
                <div class="w-4/5 h-full">
    <!--buttons (add,update,search)-->
                    <div class="flex w-full justify-end mb-3 space-x-6 ">
                        <button class="p-2 bg-white hover:bg-gray-300 rounded-full transition hover:scale-125 shadow-xl" onclick="navigateTo('add-employee', this)">
                            <img src="{{ URL('images/add.png') }}" alt="add" class="w-7 h-7">
                        </button>
                        <button class="p-2 bg-white hover:bg-gray-300 rounded-full transition hover:scale-125 shadow-xl">
                            <img src="{{ URL('images/update.png') }}" alt="update" class="w-7 h-7">
                        </button>
                        <button class="p-2 bg-white hover:bg-gray-300 rounded-full transition hover:scale-125 shadow-xl">
                            <img src="{{ URL('images/search.png') }}" alt="search" class="w-7 h-7">
                        </button>
                    </div>

    <!--number of emp, pending, next pay date-->
                    <div class="flex w-full flex-row gap-3 justify-center mb-4">
                        <div class="flex flex-col items-center bg-white p-4 w-full h-auto rounded-2xl shadow-xl">
                            <h1 class="text-sm font-medium">Number of Employees</h1>
                            <p class="text-2xl font-bold font-sans">345</p>
                        </div>
                        <div class="flex flex-col items-center bg-white p-4 w-full h-auto rounded-2xl shadow-xl">
                            <h1 class="text-sm font-medium">Pending Requests</h1>
                            <p class="text-2xl font-bold font-sans">3</p>
                        </div>
                        <div class="flex flex-col items-center bg-white p-4 w-full h-auto rounded-2xl shadow-xl">
                            <h1 class="text-sm font-medium">Next pay date</h1>
                            <p class="text-2xl font-bold font-sans">03/20/2024</p>
                        </div>
                    </div>
    <!--departments-->
                    <div class="flex flex-col w-full md:h-[40vh] bg-white p-6 gap-3 justify-start shadow-lg rounded-2xl mb-3">
                        <div class="w-full h-auto flex items-center justify-between ">
                                <h1 class="text-lg font-bold font-sans">DEPARTMENTS:</h1>
                                <button class="ml-auto hover:scale-125 transition-all duration-300">
                                    <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" class="h-7 w-7">
                                </button>
                        </div>
    <!--department_inside-->
                        <div class="flex flex-row w-full h-auto gap-4">
                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/admin.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold">ADMIN</h1>
                                <p class="text-sm text-gray-400">Total Employees:</p>
                                <h1 class="text-4xl font-bold">10</h1>
                            </button>

                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/msit.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold">MS-IT</h1>
                                <p class="text-sm text-gray-400">Total Employees:</p>
                                <h1 class="text-4xl font-bold">4</h1>
                            </button>

                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/rollermill.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold">ROLLER-MILL</h1>
                                <p class="text-sm text-gray-400">Total Employees:</p>
                                <h1 class="text-4xl font-bold">13</h1>
                            </button>

                            <button class="flex flex-col w-full md:h-[30vh] bg-[#ededed] p-4 items-center justify-center rounded-2xl shadow-lg hover:bg-gray-100 hover:scale-105 transition-all duration-300">
                                <img src="{{URL('images/technical.png')}}" alt="admin_department" class="w-[10vh]">
                                <h1 class="text-lg font-bold">TECHNICAL</h1>
                                <p class="text-sm text-gray-400">Total Employees:</p>
                                <h1 class="text-4xl font-bold">19</h1>
                            </button>

                        </div>
                    </div>

    <!--performance eval & activity logs-->
                    <div class="flex flex-row w-full h-auto gap-3">
    <!--performance eval-->    
                        <div class="flex flex-col w-full md:h-[30vh] bg-white p-4 gap-3 justify-start item-center shadow-lg rounded-2xl">
                            <div class="w-full h-auto flex items-center justify-between ">
                                <h1 class="text-lg font-bold font-sans">PERFORMANCE EVALUATION:</h1>
                                <button class="ml-auto hover:scale-125 transition-all duration-300">
                                    <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" class="h-7 w-7">
                                </button>
                            </div>
    <!--performance list -->
                            <div class="w-full h-auto flex flex-col justify-center gap-3">
                            <!--row1-->
                                <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] rounded-lg shadow-lg justify-center items-center p-1 gap-2">

                                    <img src="{{URL('images/identify.png')}}" alt="perf profile" class="w-[4vh]">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-medium">Ryan Luis</h1>
                                        <p class="text-xs font-normal opacity-60">MS-IT | IT Support</p>
                                    </div>

                                    <div class="inline-block h-auto min-h-[1em] w-0.5 self-stretch bg-gray-600 opacity-50"></div>

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-normal opacity-60">Evaluated by:</h1>
                                        <p class="text-xs italic font-semibold opacity-60">Martin Calpo</p>
                                    </div>

                                </button>
                                 <!--row2-->
                                 <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] rounded-lg shadow-lg justify-center items-center p-1 gap-2">

                                    <img src="{{URL('images/identify.png')}}" alt="perf profile" class="w-[4vh]">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-medium">Ryan Luis</h1>
                                        <p class="text-xs font-normal opacity-60">MS-IT | IT Support</p>
                                    </div>

                                    <div class="inline-block h-auto min-h-[1em] w-0.5 self-stretch bg-gray-600 opacity-50"></div>

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-normal opacity-60">Evaluated by:</h1>
                                        <p class="text-xs italic font-semibold opacity-60">Martin Calpo</p>
                                    </div>

                                </button>
                                <!--row3-->
                                <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] rounded-lg shadow-lg justify-center items-center p-1 gap-2">

                                    <img src="{{URL('images/identify.png')}}" alt="perf profile" class="w-[4vh]">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-medium">Ryan Luis</h1>
                                        <p class="text-xs font-normal opacity-60">MS-IT | IT Support</p>
                                    </div>

                                    <div class="inline-block h-auto min-h-[1em] w-0.5 self-stretch bg-gray-600 opacity-50"></div>

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-normal opacity-60">Evaluated by:</h1>
                                        <p class="text-xs italic font-semibold opacity-60">Martin Calpo</p>
                                    </div>

                                </button>
                            </div>
                        </div>
    <!--activity logs-->  
                        <div class="flex flex-col w-full md:h-[30vh] bg-white p-4 gap-3 justify-start shadow-lg rounded-2xl">
                            <div class="w-full h-auto flex items-center justify-between ">
                                <h1 class="text-lg font-bold font-sans">ACTIVITY LOGS:</h1>
                                <button class="ml-auto hover:scale-125 transition-all duration-300">
                                    <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" class="h-7 w-7">
                                </button>
                            </div>
    <!--activity logs list-->
                            <div class="w-full h-auto flex flex-col justify-center gap-3">
            <!--row1-->
                                <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] rounded-lg shadow-lg justify-start items-center p-1 gap-2">

                                    <img src="{{URL('images/activityLog_user.png')}}" alt="log profiles" class="w-7 h-7 ml-3">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-bold opacity-70">Leomar Montoya</h1>
                                        <p class="text-xs font-normal opacity-50">Leomar Montoya has logged in.</p>
                                    </div>

                                    <div class="flex flex-col items-end ml-auto mr-3">
                                        <h2 class="text-xs font-normal opacity-60">Date</h2>
                                        <p class="text-xs font-normal opacity-60">Time</p>
                                    </div>

                                </button>
            <!--row2-->
                                <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] rounded-lg shadow-lg justify-start items-center p-1 gap-2">

                                    <img src="{{URL('images/activityLog_user.png')}}" alt="log profiles" class="w-7 h-7 ml-3">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-bold opacity-70">Leomar Montoya</h1>
                                        <p class="text-xs font-normal opacity-50">Leomar Montoya has logged in.</p>
                                    </div>

                                    <div class="flex flex-col items-end ml-auto mr-3">
                                        <h2 class="text-xs font-normal opacity-60">Date</h2>
                                        <p class="text-xs font-normal opacity-60">Time</p>
                                    </div>

                                </button> 

                                 <!--row3-->
                                 <button class="flex flex-row w-full md:h-[6vh] bg-[#ededed] rounded-lg shadow-lg justify-start items-center p-1 gap-2">

                                    <img src="{{URL('images/activityLog_user.png')}}" alt="log profiles" class="w-7 h-7 ml-3">

                                    <div class="flex flex-col items-start">
                                        <h1 class="text-sm font-bold opacity-70">Leomar Montoya</h1>
                                        <p class="text-xs font-normal opacity-50">Leomar Montoya has logged in.</p>
                                    </div>

                                    <div class="flex flex-col items-end ml-auto mr-3">
                                        <h2 class="text-xs font-normal opacity-60">Date</h2>
                                        <p class="text-xs font-normal opacity-60">Time</p>
                                    </div>

                                </button> 
                            </div>
                        </div>

                    </div>

                </div>


    <!--right panel content-->
                <div class="w-2/5 h-auto flex flex-col space-y-4.5">
    <!--user profile-->
                    <div class="flex w-full flex-row justify-end space-x-2 items-center mb-7">
                        <button class="hover:scale-110 transition duration-200">
                            <img src="{{URL('images/defaultprofpic.png')}}" alt="" class="w-9 h-9">
                        </button>
                        <h2 class="text-lg">Ryan Mark Luis</h2>
                        <button class="hover:scale-110 transition duration-200">
                            <img src="{{URL('images/dropdownprofile.png')}}" alt="" class="w-9 h-9">
                        </button>
                    </div>

    <!--date & time-->
                    <div class="w-full flex flex-row justify-end items-end space-x-3 mb-9">
                        <div class="h-auto flex flex-col items-end">
                            <p class="text-medium font-medium" id="current-date">
                             
                            </p>
                            <p class="text-medium font-medium" id="current-time">
            
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
                <div class="w-full md:h-[35vh] bg-white p-4 rounded-xl shadow-xl flex justify-center flex-col mb-3">
                <div class="w-full flex items-center justify-center relative mb-3">
                    <h1 class="text-2xl font-bold font-sans mx-auto flex-1 text-center">
                        ANNOUNCEMENTS
                    </h1>
                    <button class="absolute right-0 hover:scale-125 transition-all duration-300">
                        <img src="{{URL('images/rightmore.png')}}" alt="showmore-point" class="h-7 w-7">
                    </button>
                </div>
                <!-- TABLE FOR ANNOUNCEMENTS -->
                <div class="w-full max-h-64 overflow-visible">
                    <table class="w-full table-fixed text-left">
                        <thead>
                            <tr class="bg-gray-100 text-white text-left">
                                <th class="px-4 py-2 font-normal text-sm text-black opacity-60 w-1/2">Title</th>
                                <th class="px-4 py-2 font-normal text-sm text-black opacity-60 w-1/4 text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span>Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40">08/06/2024</span>
                                </td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span>Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40">08/06/2024</span>
                                </td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span>Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40">08/06/2024</span>
                                </td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap relative group">
                                    <a href=""><span>Annual Meeting for new applicants.</span></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 bg-gray-700 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Annual meeting for new applicants this coming september 22, 2024
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                    <span class="italic opacity-40">08/06/2024</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>

    <!--birthday-->
                   <div class="w-full md:h-[35vh] bg-white p-4 rounded-xl shadow-xl flex flex-col justify-center items-center gap-1">
                        <div class="w-full h-auto flex flex-row items-center justify-center relative mb-3">
                            <h1 class="text-2xl font-bold font-sans mx-auto flex-1 text-center">
                                BIRTHDAYS
                            </h1>
                        </div>

                        <div class="w-full h-auto flex flex-row justify-center items-center gap-2">
                            <img src="{{URL('images/bday_default.png')}}" alt="bday profile" class="h-20 w-20">

                            <div class="flex flex-col items-start">
                                <h1 class="text-2xl font-bold">Martin Calpo</h1>
                                <p class="text-xs font-normal italic">Technical Department</p>
                            </div>
                        </div>
                        <!--upcoming birthdays-->

                        <h1 class="text-sm font-normal italic opacity-40 ">Upcoming Birthdays</h1>
                        <div class="inline-block h-0.5 w-auto self-stretch bg-gray-600 opacity-30"></div>

                        <div class="w-full h-auto ">
                                <table class="w-full text-center">
                                    <tbody>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50 gap-4">
                                            <td class="px-4 py-2 text-sm text-gray-700 font-bold">Ryan Mark Luis</td>
                                            <td class="px-4 py-2 text-sm text-gray-700">January 2025</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 italic">MS-IT</td>
                                        </tr>

                                        <tr class="border-b border-gray-200 hover:bg-gray-50 gap-4">
                                            <td class="px-4 py-2 text-sm text-gray-700 font-bold">Ryan Mark Luis</td>
                                            <td class="px-4 py-2 text-sm text-gray-700">January 2025</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 italic">MS-IT</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>

                   </div>

                </div>

            </div>
        
    </section>

    <section class="section w-full p-4" id="calendar-content">
        <h1 class="text-3xl font-bold mb-3">Calendar</h1>
        <!-- Calendar content goes here -->
    </section>

    <section class="section w-full p-4" id="admin-management-content">
        <h1 class="text-3xl font-bold mb-3">Admin Management</h1>
        <!-- Admin Management content goes here -->
    </section>

    <section class="section w-full p-4" id="employee-management-content">
        <h1 class="text-3xl font-bold mb-3">Employee Management</h1>
        <!-- Employee Management content goes here -->
    </section>

    <section class="section w-full p-4" id="performance-evaluation-content">
        <h1 class="text-3xl font-bold mb-3">Performance Evaluation</h1>
        <!-- Performance Evaluation content goes here -->
    </section>

    <section class="section w-full p-4" id="attendance-content">
        <h1 class="text-3xl font-bold mb-3">Attendance</h1>
        <!-- Attendance content goes here -->
    </section>

    <section class="section w-full p-4" id="leave-absence-content">
        <h1 class="text-3xl font-bold mb-3">Leave & Absence</h1>
        <!-- Leave & Absence content goes here -->
    </section>

    <section class="section w-full p-4" id="storage-content">
        <h1 class="text-3xl font-bold mb-3">Storage</h1>
        <!-- Storage content goes here -->
    </section>

    <section class="section w-full p-4" id="settings-content">
        <h1 class="text-3xl font-bold mb-3">Settings</h1>
        <!-- Settings content goes here -->
    </section>

    <!--add employee section-->
    <section id="add-employee-content" class="section hidden w-full h-screen p-7">

        <div class="flex flex-row w-full items-center justify-center">
            <button class=" w-14 p-2 hover:scale-125 transition duration-200" onclick="navigateTo('dashboard', this)">
                <img src="{{URL('images/goback.png')}}" alt="" class="w-12">
            </button>

            <!--user profile_add employee-->
            <div class="flex w-full flex-row justify-end space-x-2 items-center mb-7">
                <button class="hover:scale-110 transition duration-200">
                    <img src="{{URL('images/defaultprofpic.png')}}" alt="" class="w-9 h-9">
                </button>
                <h2 class="text-lg">Ryan Mark Luis</h2>
                <button class="hover:scale-110 transition duration-200">
                    <img src="{{URL('images/dropdownprofile.png')}}" alt="" class="w-9 h-9">
                </button>
            </div>
        </div>
    <!--FORM 201-->
        <div class="w-full bg-white md:h-[85vh] h-[calc(100vh-100px)] rounded-lg overflow-y-auto p-4 shadow-2xl">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-7 space-y-1">
                <h1 class="text-4xl sm:text-2xl font-bold text-center">Form 201</h1>
                <p class="text-lg sm:text-sm italic text-center">Fill out the form below</p>

                        <!--upload picture-->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload image</label>
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
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload scanned files <span class="text-sm italic font-normal">*if available</span></label>
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