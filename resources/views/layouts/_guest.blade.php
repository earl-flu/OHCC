<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    {{-- <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script> --}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/init-alpine.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>
    <div class="flex items-center min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="flex-1 h-full max-w-md overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-900">
            <div class="flex justify-center flex-col overflow-y-auto md:flex-row">
                {{-- <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                        src="../assets/img/login-office.jpeg" alt="Office" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                        src="../assets/img/login-office-dark.jpeg" alt="Office" />
                </div> --}}
                <div class="flex items-center justify-center p-6 sm:p-12 w-full">
                    <div class="w-full">
                     
                        <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Login
                        </h2>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input
                                class="rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Jane Doe" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input
                                class="rounded block w-full mt-1 text-sm dark:border-gray-600 
                                dark:bg-gray-700 focus:border-purple-400 focus:outline-none 
                                focus:shadow-outline-purple dark:text-gray-300 
                                dark:focus:shadow-outline-gray form-input"
                                placeholder="***************" type="password" />
                        </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <a class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            href="../index.html">
                            Log in
                        </a>

                        <hr class="my-8" />

                        
                        <p class="mt-1">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                href="./create-account.html">
                                Create account
                            </a>
                        </p>
                    </div>
                </div>
               
            </div>
        </div>
        <h1 class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
            ONE <br>HEALTH<br> COMMAND<br> CENTER
        </h1>
    </div>
</body>

</html>