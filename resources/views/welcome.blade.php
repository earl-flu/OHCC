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

        /* Particle JS Style */
        canvas {
            display: block;
            vertical-align: bottom;
        }

        /* ---- particles.js container ---- */
        #particles-js {
            position: relative;
            width: 100%;
            height: 100vh;
            background-color: black;
            /* background-image: url(""); */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 50%;
        }

        /* ---- stats.js ---- */
        .count-particles {
            background: #000022;
            position: absolute;
            top: 48px;
            left: 0;
            width: 80px;
            color: #13E8E9;
            font-size: .8em;
            text-align: left;
            text-indent: 4px;
            line-height: 14px;
            padding-bottom: 2px;
            font-family: Helvetica, Arial, sans-serif;
            font-weight: bold;
        }

        .js-count-particles {
            font-size: 1.1em;
        }

        #stats,
        .count-particles {
            -webkit-user-select: none;
            margin-top: 5px;
            margin-left: 5px;
        }

        #stats {
            border-radius: 3px 3px 0 0;
            overflow: hidden;
        }

        .count-particles {
            border-radius: 0 0 3px 3px;
        }

        /* End of Particle JS Style*/
    </style>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="antialiased">
    <!-- particles.js container -->
    <div id="particles-js" class="bg-black" style="display:flex; align-items:center; justify-content:center;">
        <img src="{{asset('images/bg-images/login-bg.jpg')}}" class="object-cover w-full h-full left-0 top-0 absolute
        opacity-20 pointer-events-none" alt="">
        <div class="flex  absolute left-1/2 top-1/2 pointer-events-none text-gray-200 w-full p-10"
            style="transform: translate(-50%,-50%); ">

            <!--Heading/Title-->
            <div class="text-8xl font-regular flex-1">
                <h1><span class="text-white font-medium">O</span>ne<br> <span
                        class="text-white font-medium">H</span>ealth<br> <span
                        class="text-white font-medium">C</span>ommand<br> <span
                        class="text-white font-medium">C</span>enter<br> <span
                        class="text-white font-medium">C</span>atanduanes</h1>


                <p class="text-xl mt-2 font-thin text-gray-300">Lorem ipsum dolor sit, amet consectetur adipisicing
                    elit. </p>
            </div>
            <!--Login -->
            <div class="flex-1 flex justify-center items-center">
                <div class="bg-gray-900 p-5 w-full pointer-events-auto rounded-md max-w-md">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <h2 class="mb-4 text-2xl font-md text-gray-200">
                        Login
                    </h2>
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <label class="block text-sm">
                            <span class="text-gray-400">Email</span>
                            <input name="email" value="{{old('email')}}"
                                class="rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="test@gmail.com" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-400">Password</span>
                            <input name="password" class="rounded block w-full mt-1 text-sm dark:border-gray-600 
                          dark:bg-gray-700 focus:border-purple-400 focus:outline-none 
                          focus:shadow-outline-purple dark:text-gray-300 
                          dark:focus:shadow-outline-gray form-input" placeholder="**********" type="password" />
                        </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <button class="block w-full px-4 py-2 mt-5 text-sm font-medium leading-5 
                      text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600
                          hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                            Log in
                        </button>
                    </form>
                    <hr class="my-8" />
                    <p class="mt-1">
                        <a class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline"
                            href="#">
                            Create account
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- particles.js lib - https://github.com/VincentGarreau/particles.js -->
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib -->
    <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>

    <script>
        particlesJS("particles-js", {
    particles: {
        number: {
            value: 50,
            density: { enable: true, value_area: 789.1476416322727 },
        },
        color: { value: "#ffffff" },
        shape: {
            type: "circle",
            stroke: { width: 0, color: "#000000" },
            polygon: { nb_sides: 5 },
            image: { src: "img/github.svg", width: 100, height: 100 },
        },
        opacity: {
            value: 0.13,
            random: false,
            anim: { enable: false, speed: 1, opacity_min: 0.1, sync: false },
        },
        size: {
            value: 3,
            random: true,
            anim: { enable: false, speed: 40, size_min: 0.1, sync: false },
        },
        line_linked: {
            enable: true,
            distance: 150,
            color: "#ffffff",
            opacity: 0.13,
            width: 1,
        },
        move: {
            enable: true,
            speed: 6,
            direction: "none",
            random: false,
            straight: false,
            out_mode: "out",
            bounce: false,
            attract: { enable: false, rotateX: 600, rotateY: 1200 },
        },
    },
    interactivity: {
        detect_on: "canvas",
        events: {
            onhover: { enable: true, mode: "repulse" },
            onclick: { enable: true, mode: "push" },
            resize: true,
        },
        modes: {
            grab: { distance: 400, line_linked: { opacity: 0.13 } },
            bubble: {
                distance: 400,
                size: 40,
                duration: 2,
                opacity: 8,
                speed: 3,
            },
            repulse: { distance: 200, duration: 0.4 },
            push: { particles_nb: 4 },
            remove: { particles_nb: 2 },
        },
    },
    retina_detect: true,
});

    </script>
</body>

</html>