<x-guest-layout>
    <div class="h-screen overflow-hidden flex relative bg-black">

        <img src="{{asset('images/bg-images/login-bg.jpg')}}" class="object-cover w-full h-full left-0 top-0 absolute
    opacity-20" alt="">
        <div style="display:relative; z-index:5;" class="max-w-md m-auto">
            <div class="flex items-center justify-center p-6 sm:p-12 max-w-md h-full">
                <div class="w-full">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <h1 class="text-4xl text-white font-bold">One Health<br>Command Center</h1>
                    <p class="text-gray-300 mb-10 text-xs">Lorem ipsum dolor sit amet cute si ryan</p>
                    <h2 class="mb-4 text-xl font-md text-gray-200">
                        Login
                    </h2>
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <label class="block text-sm">
                            <span class="text-gray-400">Email</span>
                            <input name="email"
                            value="{{old('email')}}"
                                class="rounded block w-full mt-1 text-gray-700 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="ryanCute@gmail.com" />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-400">Password</span>
                            <input name="password"
                             class="rounded block w-full mt-1 text-gray-700 text-sm dark:border-gray-600 
                            dark:bg-gray-700 focus:border-purple-400 focus:outline-none 
                            focus:shadow-outline-purple dark:text-gray-300 
                            dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" />
                        </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 
                        text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600
                            hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                            Log in
                        </button>
                    </form>
                    <hr class="my-8" />


                    <p class="mt-1">
                        <a class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline"
                            href="./create-account.html">
                            Create account
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div style="display:relative; z-index:5;">

        </div>
    </div>
</x-guest-layout>