
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INX10 | Login</title>
    <link rel="icon" href="{{ URL('images/logo_title.png') }}" type="image/png">
    @vite('resources/css/app.css')
    
</head>

<body class="flex items-center justify-center" style="background-image: url('images/login_main_bg.jpg'); background-size: cover; background-position: center; ">
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

    <div class="bg-white shadow-md rounded-lg flex max-w-4xl mx-auto overflow-hidden">
        <div class="w-1/2 bg-blue-100 flex flex-col justify-center items-center">
            <img src="{{ asset('images/login_art.jpg') }}" alt="Illustration" class="w-full h-auto">
        </div>
        <div class="w-1/2 p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('images/inx10_final_logo.png')}}" alt="Logo" class="mx-auto h-12 w-auto">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">User Login</h2>
                <p class="mt-2 text-sm text-gray-600">
                    You must be an employee or MCR Industries Incorporated to login and access the site.
                </p>
            </div>

           
            <form action="{{ route('login') }}" method="POST" onsubmit="showLoadingSpinner()">
                @csrf
                <div class="rounded-md shadow-sm">
                    <div class="mb-4">
                        <label for="user_ID" class="sr-only">User ID</label>
                        <input id="user_ID" name="user_ID" type="text" value="{{ old('user_ID') }}" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Enter your User ID...">
                        
                        <!-- Display error message for user_ID -->
                        @error('user_ID')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Enter your password...">
                        
                        <!-- Display error message for password if any -->
                        @error('password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        LOG IN
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>