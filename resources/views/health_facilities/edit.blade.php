<x-app-layout>

    <h2 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        {{$health_facility->name}}
    </h2>

    <!-- Jquery Toast for success-->
    @if (session('success'))
    <script>
        $.toast({
                heading: 'Update Success',
                text: "{{ session('success') }}",
                icon: 'success',
                position: 'top-right'
            })
    </script>
    @endif

    <div class="grid grid-cols-8 gap6 border border-red-500 ">
        <div
            class="border border-red-500 col-span-8 md:col-span-4 px-4 py-3 mb-8 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800">
            <form action="{{route('health-facilities.update', $health_facility)}}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <!-- Display errors -->
                <div class="mb-5 text-xs text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <!-- Jquery Toast for Error-->
                <script>
                    $.toast({
                        heading: 'Error',
                        text: "Error updating the data",
                        icon: 'error',
                        position: 'top-right'
                    })
                </script>
                @endif


                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 md:col-span-3">

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Ward Capacity</span>
                            <input disabled
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-400 dark:text-gray-500 dark:focus:shadow-outline-gray form-input"
                                name="ward_capacity"
                                value="{{old('ward_capacity') ?: $health_facility->ward_capacity}}" />
                        </label>
                    </div>

                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Occupied Ward</span>
                            <input
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                name="occupied_ward"
                                value="{{old('occupied_ward') ?: $health_facility->occupied_ward}}" />
                        </label>
                    </div>


                    <div class="col-span-3 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Isolation Capacity</span>
                            <input disabled
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600
                                dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-400 dark:text-gray-500 dark:focus:shadow-outline-gray form-input"
                                name="isolation_capacity"
                                value="{{old('isolation_capacity') ?: $health_facility->isolation_capacity}}" />
                        </label>
                    </div>

                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Occupied Isolation</span>
                            <input
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                name="occupied_isolation"
                                value="{{old('occupied_isolation') ?: $health_facility->occupied_isolation}}" />
                        </label>
                    </div>

                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">ICU Capacity</span>
                            <input disabled
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-400 dark:text-gray-500 dark:focus:shadow-outline-gray form-input"
                                name="icu_capacity" value="{{old('icu_capacity') ?: $health_facility->icu_capacity}}" />
                        </label>
                    </div>

                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Occupied ICU</span>
                            <input
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                name="occupied_icu" value="{{old('occupied_icu') ?: $health_facility->occupied_icu}}" />
                        </label>
                    </div>

                    <button class="w-32 focus:outline-none border border-transparent py-2 px-5
                        rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                        Update
                    </button>
                </div>
        </div>
        </form>
    </div>

    <div>
        <h2 class="text-xl">History</h2>
        <table>
            <thead>
                <tr>
                    <th>Updated at</th>
                    <th>Occupied Ward</th>
                    <th>Occupied Isolation</th>
                    <th>Occupied ICU</th>
                    <th>Updated By</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activityLog)
                <tr>
                    <td>
                        {{$activityLog->created_at}}
                    </td>
                    <td>
                        {{$activityLog->changes['attributes']['occupied_ward']}}
                    </td>
                    <td>
                        {{$activityLog->changes['attributes']['occupied_isolation']}}
                    </td>
                    <td>
                        {{$activityLog->changes['attributes']['occupied_icu']}}
                    </td>
                    <td>
                        {{$activityLog->causer->first_name}}
                    </td>
                    <td>
                        @if ($loop->first)
                        <span class="text-green-500">Latest Update</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>