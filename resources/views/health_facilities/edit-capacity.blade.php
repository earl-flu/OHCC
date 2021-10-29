<x-app-layout>
    <h1 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        {{$health_facility->name}}
    </h1>
    <h2 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
        <span class="text-yellow-500 mr-1 font-thin">#</span>
        Update Capacity
    </h2>
    <p class="text-xs text-gray-600 mb-1">Dedicated beds for Suspect, Probable, and Confirmed COVID-19 patients</p>
    <div class="p-5 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800">
        @if ($errors->any())
        <!-- Jquery Toast for Error-->
        @push('scripts')
        <script>
            $.toast({
                    heading: 'Error',
                    text: "Error updating the data",
                    icon: 'error',
                    position: 'top-right'
                })
        </script>
        @endpush

        @endif

        @if(session()->has('success'))
        <span class="text-green-500 mb-2 block">
            <strong>{{ session()->get('success') }}</strong>
        </span>

        @push('scripts')
        <script>
            $.toast({
                        heading: 'Update Success',
                        text: "{{ session('success') }}",
                        icon: 'success',
                        position: 'top-right'
                    })
        </script>
        @endpush
        @endif
        <form method="POST" action="{{ route('edit.capacity', $health_facility) }}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class=" grid grid-cols-6 gap-6">

                <div class="col-span-6 md:col-span-2">
                    <label for="ward_capacity" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Ward Capacity</span>
                        <input type="text" class="border border-gray-200 rounded block w-full 
                    mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                    focus:border-purple-400 focus:outline-none 
                    focus:shadow-outline-purple dark:text-gray-300 
                    dark:focus:shadow-outline-gray form-input
                    @error('ward_capacity') border border-red-500 @enderror"
                            value="{{old('ward_capacity') ?: $health_facility->ward_capacity}}" name="ward_capacity" />
                        @error('ward_capacity')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <label for="isolation_capacity" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Isolation Capacity</span>
                        <input type="text" class="border border-gray-200 rounded block w-full 
                    mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                    focus:border-purple-400 focus:outline-none 
                    focus:shadow-outline-purple dark:text-gray-300 
                    dark:focus:shadow-outline-gray form-input
                    @error('isolation_capacity') border border-red-500 @enderror"
                            value="{{old('isolation_capacity') ?: $health_facility->isolation_capacity}}"
                            name="isolation_capacity" />
                        @error('isolation_capacity')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <label for="icu_capacity" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">ICU Capacity</span>
                        <input type="text" class="border border-gray-200 rounded block w-full 
                    mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                    focus:border-purple-400 focus:outline-none 
                    focus:shadow-outline-purple dark:text-gray-300 
                    dark:focus:shadow-outline-gray form-input
                    @error('icu_capacity') border border-red-500 @enderror" name="icu_capacity"
                            value="{{old('icu_capacity') ?: $health_facility->icu_capacity}}" />
                        @error('icu_capacity')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                </div>

                @if ($health_facility->level) {{-- Hospital --}}
                <div class="col-span-6 md:col-span-2">
                    <label for="max_ventilator" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Ventilator(s)</span>
                        <input type="text" class="border border-gray-200 rounded block w-full 
                    mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                    focus:border-purple-400 focus:outline-none 
                    focus:shadow-outline-purple dark:text-gray-300 
                    dark:focus:shadow-outline-gray form-input
                    @error('max_ventilator') border border-red-500 @enderror"
                            value="{{old('max_ventilator') ?: $health_facility->max_ventilator}}"
                            name="max_ventilator" />
                        @error('max_ventilator')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                </div>
                @endif

            </div>
            <button class=" w-full md:w-auto mt-8 text-sm focus:outline-none border border-transparent py-2 px-3
        rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                Update Capacity
            </button>
        </form>
    </div>
</x-app-layout>