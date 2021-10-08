<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" autocomplete="off" x-data="{superAdmin: false,title: 'test'}">
            @csrf
            <h1 x-text="title"></h1>
            <!-- First Name -->
            <div>
                <x-label for="first_name" :value="__('First name')" />

                <x-input id="first_name" class="border border-gray-200 rounded block w-full 
                mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                focus:border-purple-400 focus:outline-none 
                focus:shadow-outline-purple dark:text-gray-300 
                dark:focus:shadow-outline-gray form-input" type="text" name="first_name" :value="old('first_name')"
                    required autofocus />
            </div>
            <!-- Middle Name -->
            <div class="mt-4">
                <x-label for="middle_name" :value="__('Middle name')" />

                <x-input id="middle_name" class="border border-gray-200 rounded block w-full 
                mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                focus:border-purple-400 focus:outline-none 
                focus:shadow-outline-purple dark:text-gray-300 
                dark:focus:shadow-outline-gray form-input" type="text" name="middle_name" :value="old('middle_name')"
                    required autofocus />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Last name')" />

                <x-input id="last_name" class="border border-gray-200 rounded block w-full 
                mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                focus:border-purple-400 focus:outline-none 
                focus:shadow-outline-purple dark:text-gray-300 
                dark:focus:shadow-outline-gray form-input" type="text" name="last_name" :value="old('last_name')"
                    required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="border border-gray-200 rounded block w-full 
                mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                focus:border-purple-400 focus:outline-none 
                focus:shadow-outline-purple dark:text-gray-300 
                dark:focus:shadow-outline-gray form-input" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Super Admin-->
            <div class="flex mt-4 text-sm">
                <label class="flex items-center dark:text-gray-400">
                    <input type="checkbox" name="super_admin" value="1" @click="superAdmin = !superAdmin"
                        class="text-purple-600 form-checkbox border border-gray-300 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                    <span class="ml-2">
                        Super Admin
                    </span>
                </label>
            </div>

            <!-- Health Facility -->
            <div class="mt-4" x-show="!superAdmin">
                <x-label for="health_facility_id" :value="__('Health Facility')" />

                <select name="health_facility_id"
                    class="health-facility-select border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option value="" selected disabled>Please select here</option>
                    @foreach ($health_facilities as $health_facility)
                    <option value="{{$health_facility->id}}"
                        {{old('health_facility_id') == $health_facility->id ? 'selected' : ''}}>
                        {{$health_facility->name}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="border border-gray-200 rounded block w-full 
                mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                focus:border-purple-400 focus:outline-none 
                focus:shadow-outline-purple dark:text-gray-300 
                dark:focus:shadow-outline-gray form-input" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="border border-gray-200 rounded block w-full 
                mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                focus:border-purple-400 focus:outline-none 
                focus:shadow-outline-purple dark:text-gray-300 
                dark:focus:shadow-outline-gray form-input" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 bg-blue-500 hover:bg-blue-600 ">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <script>
            $(document).ready(function(){
                $('.health-facility-select').select2();
                //select2 style
                $('.select2').addClass('select2-style');
            });
     
        </script>
    </x-auth-card>

</x-guest-layout>