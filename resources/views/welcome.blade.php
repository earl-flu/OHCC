<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    {{-- <link href="/css/app.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="antialiased">
    <!-- particles.js container -->

    <img src="{{asset('images/bg-images/login-bg.jpg')}}" class="object-cover w-full h-full left-0 top-0 fixed bg-red-500
        opacity-30 pointer-events-none" alt="">
    {{-- <div class="flex flex-col  lg:flex-row border border-red-500 absolute left-1/2 top-1/2 pointer-events-none text-gray-200 w-full p-10"
            style="transform: translate(-50%,-50%); "> --}}

    <div class="flex flex-col md:flex-row w-full p-5 md:p-10 pointer-events-none text-gray-200" style="position:relative; z-index:20;">

        <!--Heading/Title-->
        <div class="text-blue-800 text-5xl sm:text-7xl xl:text-8xl font-regular flex-1 mb-10 md:mb-0">
            <h1><span class="text-blue-800 font-medium">O</span>ne<br> <span
                    class="text-blue-800 font-medium">H</span>ealth<br> <span
                    class="text-blue-800 font-medium">C</span>ommand<br> <span
                    class="text-blue-800 font-medium">C</span>enter<br> <span
                    class="text-blue-800 font-medium">C</span>atanduanes</h1>


            <p class="text-sm text sm:text-xl mt-2 font-normal text-blue-600">Lorem ipsum dolor sit, amet consectetur
                adipisicing
                elit. </p>
        </div>
        <!--Login -->
        <div class="flex-1 flex justify-center items-center">
            <div class="bg-blue-900 p-5 w-full pointer-events-auto rounded-lg max-w-md">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <h2 class="mb-4 text-xl md:text-2xl font-md text-gray-200">
                    Login
                </h2>
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <label class="block text-sm">
                        <span class="text-gray-300">Email</span>
                        <input name="email" value="{{old('email')}}" class="rounded block w-full text-gray-700 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple 
                                dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="maripati@gmail.com" />
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-300">Password</span>
                        <input name="password" class="text-gray-700 rounded block w-full mt-1 text-sm dark:border-gray-600 
                          dark:bg-gray-700 focus:border-purple-400 focus:outline-none 
                          focus:shadow-outline-purple dark:text-gray-300 
                          dark:focus:shadow-outline-gray form-input" placeholder="**********" type="password" />
                    </label>

                    <!-- You should use a button here, as the anchor is only used for the example  -->
                    <button class="block w-full px-4 py-2 mt-8 mb-10 text-sm font-medium leading-5 
                      text-center text-white transition-colors duration-150 bg-blue-600 border border-gray-300 rounded-lg active:bg-blue-600
                          hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Log in
                    </button>
                </form>
        
            </div>
        </div>
    </div>
    
</body>

</html>