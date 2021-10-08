<x-app-layout>
    @section('assets')
    <style>
        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }

            thead tr:not(:first-child) {
                display: none;
            }
        }

        td:not(:last-child) {
            border-bottom: 0;
        }

        th:not(:last-child) {
            border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
    </style>
    @endsection

    <h2 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        {{$health_facility->name}}
    </h2>

    <!-- Jquery Toast for success-->
    @if (session('success'))
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
    <h2 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
        <span class="text-yellow-500 mr-1 font-thin">#</span>
        Update Occupied Beds
    </h2>
    <div class="grid grid-cols-8">
        <div class="col-span-8 p-5 mb-8 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800">
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

                <div class="grid grid-cols-6 gap-6">
                    <div class="date-container col-span-6 text-xs text-gray-500 font-semibold rounded px-3 py-2">
                        Last update: <span id="date_updated"></span>
                    </div>
                    <div class="col-span-6 order-1 md:order-1 md:col-span-3">

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Ward Capacity</span>
                            <input disabled
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-400 dark:text-gray-500 dark:focus:shadow-outline-gray form-input"
                                name="ward_capacity"
                                value="{{old('ward_capacity') ?: $health_facility->ward_capacity}}" />
                        </label>
                    </div>

                    <div class="col-span-6 order-4 md:order-2 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Occupied Ward</span>
                            <input class="border border-gray-200 rounded block w-full
                                 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray 
                                 form-input
                                 " name="occupied_ward"
                                value="{{old('occupied_ward') ?: $health_facility->occupied_ward}}" />
                        </label>
                    </div>

                    <div class="col-span-6 order-2 md:order-3 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Isolation Capacity</span>
                            <input disabled
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600
                                dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-400 dark:text-gray-500 dark:focus:shadow-outline-gray form-input"
                                name="isolation_capacity"
                                value="{{old('isolation_capacity') ?: $health_facility->isolation_capacity}}" />
                        </label>
                    </div>

                    <div class="col-span-6 order-5 md:order-4 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Occupied Isolation</span>
                            <input
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                name="occupied_isolation"
                                value="{{old('occupied_isolation') ?: $health_facility->occupied_isolation}}" />
                        </label>
                    </div>

                    <div class="col-span-6 order-3 md:order-5 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">ICU Capacity</span>
                            <input disabled
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-400 dark:text-gray-500 dark:focus:shadow-outline-gray form-input"
                                name="icu_capacity" value="{{old('icu_capacity') ?: $health_facility->icu_capacity}}" />
                        </label>
                    </div>

                    <div class="col-span-6 order-6 md:order-6 md:col-span-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Occupied ICU</span>
                            <input
                                class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                name="occupied_icu" value="{{old('occupied_icu') ?: $health_facility->occupied_icu}}" />
                        </label>
                    </div>

                    <button class="order-last w-full col-span-6 text-sm focus:outline-none border border-transparent py-2 px-3
                        rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                        Update
                    </button>
                </div>
        </div>
        </form>
    </div>

    <div class="overflow-x-auto mb-10 ">
        <h2 class="text-xl mb-2 text-gray-600">History</h2>
        <table id="history-table" class="display responsive nowrap" style="width:100%;">
            <thead class="text-gray-500">
                <tr class="text-left bg-green-100 border text-sm">
                    <th class="py-2 px-2 font-normal">Date</th>
                    <th class="py-2 px-2 font-normal" width="100">Ward</th>
                    <th class="py-2 px-2 font-normal" width="100">Isolation</th>
                    <th class="py-2 px-2 font-normal" width="100">ICU</th>
                    <th class="py-2 px-2 font-normal">Admin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-xs text-gray-500">
                @foreach($histories as $history)
                <tr class="border hover:bg-gray-100">
                    <td class="px-3 py-2">
                        {{$history->created_at}}
                    </td>
                    <td class="px-3 py-2">
                        {{$history->occupied_ward}}
                    </td>
                    <td class="px-3 py-2">
                        {{$history->occupied_isolation}}
                    </td>
                    <td class="px-3 py-2">
                        {{$history->occupied_icu}}
                    </td>
                    <td class="px-3 py-2">
                        {{$history->user->first_name}}
                        @if ($loop->first)
                        <span class="text-xs text-green-500 testt"> (Latest Update)</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                {{-- @foreach($activities as $activityLog)
                <tr class="border hover:bg-gray-100">
                    <td class="px-3 py-2">
                        {{$activityLog->created_at}}
                </td>
                <td class="px-3 py-2">
                    {{$activityLog->changes['attributes']['occupied_ward']}}
                </td>
                <td class="px-3 py-2">
                    {{$activityLog->changes['attributes']['occupied_isolation']}}
                </td>
                <td class="px-3 py-2">
                    {{$activityLog->changes['attributes']['occupied_icu']}}
                </td>
                <td class="px-3 py-2">
                    {{$activityLog->causer->first_name}}
                    @if ($loop->first)
                    <span class="text-xs text-green-500 testt"> (Latest Update)</span>
                    @endif
                </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    @push('scripts')

    <script src="{{ asset('js/my_scripts/format-date.js') }}"> </script>
    <script>
        const d = formatDate(new Date("{{$health_facility->updated_at}}"))
        const datecontainer = document.querySelector('.date-container');
        //add last update date
        document.querySelector('#date_updated').innerText = d

        if(d.includes("Today")) {
            datecontainer.classList.add('bg-green-200')
        } else {
            datecontainer.classList.add('bg-red-200')
        }
    </script>
    @endpush

</x-app-layout>