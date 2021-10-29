<x-app-layout>
    <h2 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
    </h2>

    {{-- Card For HF admin  --}}
    @if (Auth::user()->healthFacility)
    <h1 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
        <span class="text-yellow-500 mr-1 font-thin">#</span>
        {{$healthfacility->name}}
    </h1>
    <div class="grid gap-6 mb-10 md:grid-cols-2 xl:grid-cols-3 mt-2">
        <!--Card-->
        <div
            class="h-36 flex flex-col p-2 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 ">
            <div class="text-center text-xl mb-1">ICU Beds</div>
            <div class="flex items-stretch h-full border border-gray-300 rounded overflow-hidden">
                <div class="flex-1 flex flex-col">
                    <div class="text-sm text-center p-2 bg-yellow-200">
                        Occupied
                    </div>
                    <div class="flex-1 flex">
                        <div class="flex flex-1 items-center justify-center border-r border-gray-200">
                            <div class="text-xl text-gray-600">
                                {{$healthfacility->occupied_icu}}/{{$healthfacility->icu_capacity}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex flex-col text-gray-600">
                    <div class="text-sm text-center p-2 bg-yellow-300 font-semibold">Vacant</div>
                    <div class="flex items-center justify-center h-full border-l border-gray-200 text-5xl">
                        {{$healthfacility->totalRemainingIcu()}}
                    </div>

                </div>
            </div>
        </div>
        <!--Card-->
        <div
            class="h-36 flex flex-col p-2 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 ">
            <div class="text-center text-xl mb-1">Ward Beds</div>
            <div class="flex items-stretch h-full border border-gray-300 rounded overflow-hidden">
                <div class="flex-1 flex flex-col">
                    <div class="text-sm text-center p-2 bg-green-200">
                        Occupied
                    </div>
                    <div class="flex-1 flex">
                        <div class="flex flex-1 items-center justify-center border-r border-gray-200">
                            <div class="text-xl text-gray-600">
                                {{$healthfacility->occupied_ward}}/{{$healthfacility->ward_capacity}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex flex-col text-gray-600">
                    <div class="text-sm text-center p-2 bg-green-300 font-semibold">Vacant</div>
                    <div class="flex items-center justify-center h-full border-l border-gray-200 text-5xl">
                        {{$healthfacility->totalRemainingWard()}}
                    </div>

                </div>
            </div>
        </div>

        <!--Card-->
        <div
            class="h-36 flex flex-col p-2 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 ">
            <div class="text-center text-xl mb-1">Isolation Beds</div>
            <div class="flex items-stretch h-full border border-gray-300 rounded overflow-hidden">
                <div class="flex-1 flex flex-col">
                    <div class="text-sm text-center p-2 bg-blue-200">
                        Occupied
                    </div>
                    <div class="flex-1 flex">
                        <div class="flex flex-1 items-center justify-center border-r border-gray-200">
                            <div class="text-xl text-gray-600">
                                {{$healthfacility->occupied_isolation}}/{{$healthfacility->isolation_capacity}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex flex-col text-gray-600">
                    <div class="text-sm text-center p-2 bg-blue-300 font-semibold">Vacant</div>
                    <div class="flex items-center justify-center h-full  border-l border-gray-200 text-5xl">
                        {{$healthfacility->totalRemainingIso()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{--End Card For HF admin  --}}
    <!--vue component -->
    <health-facility-history-chart></health-facility-history-chart>
    @endif

    {{-- For Super Admin --}}
    @if (Auth::user()->isSuperAdmin())
    <!-- Health Facility Table-->
    <health-facility-table :municipalities="{{$municipalities}}"></health-facility-table>

    <municipality-table></municipality-table>
    @endif

    </div>

</x-app-layout>