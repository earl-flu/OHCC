<x-app-layout>
    <!-- ############################################################# -->
    <!-- FOR SUPER ADMIN - TO BE CONVERTED TO VUE COMPONENT-->
    <!-- ############################################################# -->

    
    @push('chart_scripts')
    {{-- <script src="{{ asset('js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('js/charts-bars.js') }}" defer></script>
    <script src="{{ asset('js/charts-pie.js') }}" defer></script> --}}
    @endpush
    <h2 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        Health Facility Dashboard
    </h2>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 mt-5">
        <!--Card-->
        <div
            class=" flex items-center p-4 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 ">
            <div class=" p-3 mr-4 text-orange-500 bg-yellow-400 rounded-full dark:text-orange-100 dark:bg-yellow-400">
                <svg fill="white" id="Capa_1" class="h-7 w-7" enable-background="new 0 0 512.005 512.005"
                    viewBox="0 0 512.005 512.005" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path
                            d="m467.005 60.002c24.814 0 45-20.186 45-45 0-8.291-6.709-15-15-15s-15 6.709-15 15c0 8.276-6.738 15-15 15h-181c-8.262 0-15-6.724-15-15 0-8.291-6.709-15-15-15s-15 6.709-15 15c0 19.53 12.578 36.024 30 42.237v32.763h-15c-8.291 0-15 6.709-15 15v92c0 8.291 6.709 15 15 15h60c8.291 0 15-6.709 15-15v-92c0-8.291-6.709-15-15-15h-15v-30h60v212h-228.578l-81.24-81.24c-11.367-11.309-30.967-11.338-42.393.029-11.748 11.777-11.702 30.688 0 42.422l51.211 51.211v140.341c-17.422 6.213-30 22.707-30 42.237 0 24.814 20.186 45 45 45s45-20.186 45-45c0-19.53-12.578-36.024-30-42.237v-32.763h331v32.763c-17.422 6.213-30 22.707-30 42.237 0 24.814 20.186 45 45 45s45-20.186 45-45c0-19.53-12.578-36.024-30-42.237v-92.763h31c16.553 0 30-13.462 30-30s-13.447-30-30-30h-91v-212h76zm-46 272v30h-331v-47.578l8.818 8.818c5.684 5.654 13.213 8.76 21.182 8.76z" />
                    </g>
                </svg>
            </div>
            <div>
                <p class=" mb-2 text-sm font-medium text-gray-600 dark:text-gray-400 font-semibold">
                    Vacant ICU Beds
                </p>
                <p class=" text-lg text-gray-700 dark:text-gray-200" id="icu-num">
                    0
                </p>
            </div>
        </div>

        <!--Card-->
        <div
            class=" flex items-center p-4 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 ">
            <div class=" p-3 mr-4 text-orange-500 bg-green-400 rounded-full dark:text-orange-100 dark:bg-green-400">
                <svg class="h-7 w-7" fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 910 910"
                    style="enable-background:new 0 0 910 910;" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M789.1,449.9H879V369c0-16.8-13.7-30.5-30.5-30.5H342.1c1.601,3.3,3.101,6.6,4.601,10c10.2,24.2,15.399,49.9,15.399,76.4
        c0,8.399-0.5,16.8-1.6,25H789.1z" />
                            <path d="M165.9,263.7c-3.4,0-6.7,0.1-10,0.3v185.8H267h58.1c1.301-8.2,1.9-16.5,1.9-25c0-31.8-9.2-61.399-25.1-86.3
        C273.4,293.5,223.1,263.7,165.9,263.7z" />
                            <path d="M30,731.5h60.9c16.6,0,30-13.4,30-30v-95.7h668.2v95.7c0,16.6,13.4,30,30,30H880c16.6,0,30-13.4,30-30V514.9
        c0-16.601-13.4-30-30-30h-90.9H120.9V270.1v-61.6c0-16.6-13.4-30-30-30H30c-16.6,0-30,13.4-30,30v111.7v38.5V491v38.5v172
        C0,718,13.4,731.5,30,731.5z" />
                        </g>
                    </g>

                </svg>
            </div>
            <div>
                <p class=" mb-2 text-sm font-medium text-gray-600 dark:text-gray-400 font-semibold">
                    Vacant Isolation Beds
                </p>
                <p class=" text-lg text-gray-700 dark:text-gray-200" id="iso-num">
                    0
                </p>
            </div>
        </div>

        <!--Card-->
        <div
            class=" flex items-center p-4 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 ">
            <div class=" p-3 mr-4 text-orange-500 bg-blue-400 rounded-full dark:text-orange-100 dark:bg-blue-400">
                <svg class="h-7 w-7" fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 501.333 501.333"
                    style="enable-background:new 0 0 501.333 501.333;" xml:space="preserve">
                    <g>
                        <g>
                            <g>
                                <path d="M64.48,240h108.608c6.048,0,13.579,0,13.579-26.667c0-12.619-24.277-26.667-40.725-26.667H66.443
                           c-14.4,0-27.733,10.123-28.992,24.203C36,226.677,48.693,240,64.48,240z" />
                                <path d="M490.667,250.667H32v-160C32,84.776,27.224,80,21.333,80H10.667C4.776,80,0,84.776,0,90.667v320
                           c0,5.891,4.776,10.667,10.667,10.667h10.667c5.891,0,10.667-4.776,10.667-10.667V336h437.333v74.667
                           c0,5.891,4.776,10.667,10.667,10.667h10.667c5.891,0,10.667-4.776,10.667-10.667V261.333
                           C501.333,255.442,496.558,250.667,490.667,250.667z" />
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <div>
                <p class=" mb-2 text-sm font-medium text-gray-600 dark:text-gray-400 font-semibold">
                    Vacant Ward Beds
                </p>
                <p class=" text-lg text-gray-700 dark:text-gray-200" id="ward-num">
                    0
                </p>
            </div>
        </div>
    </div>


    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div
            class="mb-10 col-span-2 min-w-0 p-4 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800">
            <form action="{{route('dashboard')}}" method="GET">
                <div class="flex mt-5">
                    <label for="municipality" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Municipality
                        </span>
                        <select name="municipality"
                            class="border border-gray-200 rounded block mt-1 w-max text-sm dark:text-gray-300 dark:border-gray-600
                        dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="all" selected>All</option>
                            @foreach ($municipalities as $municipality)
                            <option value="{{$municipality->code}}"
                                {{$selected_municipality == $municipality->code ? 'selected' : ''}}>
                                {{$municipality->name}}</option>
                            @endforeach
                        </select>
                    </label>

                    <label for="type" class="block text-sm ml-5">
                        <span class="text-gray-700 dark:text-gray-400">
                            Type
                        </span>
                        <select name="type"
                            class="border border-gray-200 rounded block mt-1 w-max text-sm dark:text-gray-300 dark:border-gray-600
                        dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="all" {{$selected_type == "all" ? 'selected' : ''}} selected>All</option>
                            <option value="hospital" {{$selected_type == "hospital" ? 'selected' : ''}}>Hospital
                            </option>
                            <option value="isolation" {{$selected_type == "isolation" ? 'selected' : ''}}>Isolation
                                Facility
                            </option>
                        </select>
                    </label>
                    <button type="submit"
                        class="self-end ml-5 px-4 py-2 text-sm font-medium leading-5
                         text-white transition-colors duration-150 bg-blue-500 border border-transparent
                          rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Filter
                    </button>
                </div>

            </form>
            <table id="hospital_table" class="display order-column mt-20" width="100%">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th>Name</th>
                        <th>ICU Beds</th>
                        <th>Isolation Beds</th>
                        <th>Ward Beds</th>
                        <th>Ventilators</th>
                        <th>Municipality</th>
                        <th>Barangay</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hospitals as $hospital)
                    <!-- SHOWING OCCUPIED/CAPACITY BASED ON HEALTH FACILITY TABLE ONLY-->
                    <tr>
                        <td class="text-gray-700">{{$hospital->name}}</td>
                        <td
                            class="{{$hospital->icu_capacity - $hospital->occupied_icu > 0 ? 'bg-yellow-500 bg-opacity-30' : ''}} ">

                            {{$hospital->icu_capacity == 0 ? '0' : $hospital->occupied_icu .'/'. $hospital->icu_capacity }}

                            <span
                                class="icu-capacity hidden">{{$hospital->icu_capacity - $hospital->occupied_icu}}</span>
                        </td>
                        <td
                            class="{{$hospital->isolation_capacity - $hospital->occupied_isolation > 0 ? 'bg-green-500 bg-opacity-30' : ''}} ">
                            {{$hospital->isolation_capacity == 0 ? '0' : $hospital->occupied_isolation .'/'. $hospital->isolation_capacity  }}
                            <span
                                class="isolation-capacity hidden">{{$hospital->isolation_capacity - $hospital->occupied_isolation}}</span>
                        </td>
                        <td
                            class="{{$hospital->ward_capacity - $hospital->occupied_ward > 0 ? 'bg-blue-500 bg-opacity-30' : ''}} ">
                            {{$hospital->ward_capacity == 0 ? '0' : $hospital->occupied_ward .'/'. $hospital->ward_capacity  }}
                            <span
                                class="ward-capacity hidden">{{$hospital->ward_capacity - $hospital->occupied_ward}}</span>
                        </td>
                        <td class="{{$hospital->max_ventilator > 0 ? 'bg-purple-500 bg-opacity-30' : ''}} ventilator">
                            {{$hospital->max_ventilator}}

                        </td>

                        <td>{{$hospital->municipality->name}}</td>
                        <td>{{$hospital->barangay}}</td>
                    </tr>

                    <!--SHOW OCCUPIED/CAPACITY USING PATIENT -->
                    {{-- <tr>
                        <td class="text-gray-700">{{$hospital->name}}</td>
                    <td class="{{$hospital->getRemainingIcuCapacity() > 0 ? 'bg-yellow-500 bg-opacity-30' : ''}} ">
                        {{$hospital->icu_capacity == 0 ? '0' : $hospital->getOccupiedIcu() .'/'. $hospital->icu_capacity }}
                        <span class="icu-capacity hidden">{{$hospital->getRemainingIcuCapacity()}}</span>
                    </td>
                    <td class="{{$hospital->getRemainingIsolationCapacity() > 0 ? 'bg-green-500 bg-opacity-30' : ''}} ">
                        {{$hospital->isolation_capacity == 0 ? '0' : $hospital->getOccupiedIsolation() .'/'. $hospital->isolation_capacity }}
                        <span class="isolation-capacity hidden">{{$hospital->getRemainingIsolationCapacity()}}</span>
                    </td>
                    <td class="{{$hospital->getRemainingWardCapacity() > 0 ? 'bg-blue-500 bg-opacity-30' : ''}} ">
                        {{$hospital->ward_capacity == 0 ? '0' : $hospital->getOccupiedWard() .'/'. $hospital->ward_capacity }}
                        <span class="ward-capacity hidden">{{$hospital->getRemainingWardCapacity()}}</span>
                    </td>
                    <td
                        class="{{$hospital->getRemainingVentilators() > 0 ? 'bg-purple-500 bg-opacity-30' : ''}} ventilator">
                        {{$hospital->getRemainingVentilators()}}

                    </td>

                    <td>{{$hospital->municipality->name}}</td>
                    <td>{{$hospital->barangay}}</td>
                    </tr> --}}


                    <!-- SHOW REMAINING CAPACITY USING PATIENT-->
                    {{-- <tr>
                        <td class="font-semibold text-gray-700">{{$hospital->name}}</td>
                    <td
                        class="{{$hospital->getRemainingIcuCapacity() > 0 ? 'bg-yellow-500 bg-opacity-30' : ''}} icu-capacity">
                        {{$hospital->getRemainingIcuCapacity()}}</td>
                    <td
                        class="{{$hospital->getRemainingIsolationCapacity() > 0 ? 'bg-green-500 bg-opacity-30' : ''}} isolation-capacity">
                        {{$hospital->getRemainingIsolationCapacity()}}</td>
                    <td
                        class="{{$hospital->getRemainingWardCapacity() > 0 ? 'bg-blue-500 bg-opacity-30' : ''}} ward-capacity">
                        {{$hospital->getRemainingWardCapacity()}}</td>
                    <td
                        class="{{$hospital->getRemainingVentilators() > 0 ? 'bg-purple-500 bg-opacity-30' : ''}} ventilator">
                        {{$hospital->getRemainingVentilators()}}</td>

                    <td>{{$hospital->municipality->name}}</td>
                    <td>{{$hospital->barangay}}</td>
                    </tr> --}}
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Symptoms Classification
            </h4>
            <canvas id="pie"></canvas>
            <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                    <span>Asymptomatic</span>
                </div>
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                    <span>Mild</span>
                </div>
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                    <span>Severe</span>
                </div>
            </div>
        </div>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Line Chart
            </h4>
            <canvas id="line"></canvas>
            <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                    <span>Line 1</span>
                </div>
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                    <span>Line 2</span>
                </div>
            </div>
        </div>

        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Bar Chart
            </h4>
            <canvas id="bars"></canvas>
            <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"></span>
                    <span>Test 1</span>
                </div>
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                    <span>Test 2</span>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="w-full mb-10">
        <table id="per_municipality_table" class="display">
            <thead>
                <tr class="bg-gradient-to-r from-indigo-400 via-blue-500 to-purple-600 text-white">
                    <th>Municipality</th>
                    <th>Total ICU Beds</th>
                    <th>Total Isolation Beds</th>
                    <th>Total Ward Beds</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($municipalities as $municipality)
                <tr>
                    <td>{{$municipality->name}}</td>
                    <td class="{{$municipality->bedCount('icu_capacity') > 0 ? 'bg-yellow-500 bg-opacity-30' : ''}}">
                        {{$municipality->bedCount('icu_capacity')}}</td>
                    <td
                        class="{{$municipality->bedCount('isolation_capacity') > 0 ? 'bg-green-500 bg-opacity-30' : ''}}">
                        {{$municipality->bedCount('isolation_capacity')}}</td>
                    <td class="{{$municipality->bedCount('ward_capacity') > 0 ? 'bg-blue-500 bg-opacity-30' : ''}}">
                        {{$municipality->bedCount('ward_capacity')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // TOTAL BED PER MUNICIPALITY TABLE
    $(document).ready( function () { 
        $('#per_municipality_table').DataTable({
                paging: false,
                info: false,
                bSortClasses: false,
        });
    });
   
    // HEALTH FACILITY TABLE     
        let available_icu = 0; 
        let available_isolation = 0; 
        let available_ward = 0; 
        $('.isolation-capacity').each(function(){
            available_isolation += parseInt(this.innerText)
        })
        $('.icu-capacity').each(function(){
            available_icu += parseInt(this.innerText)
        })
        $('.ward-capacity').each(function(){
            available_ward += parseInt(this.innerText)
        })
            
        var icu_countUp = new countUp.CountUp('icu-num', available_icu);
        var iso_countUp = new countUp.CountUp('iso-num', available_isolation);
        var ward_countUp = new countUp.CountUp('ward-num', available_ward);
        icu_countUp.start();
        iso_countUp.start();
        ward_countUp.start();
        
        $(document).ready( function () {

            $('#hospital_table').DataTable({
                scrollY: "50vh",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                info: false,
                bSortClasses: false,
                columnDefs: [
                    // {
                    //     targets:"_all",
                    //     className: 'dt-body-left'
                    // }
                    {
                        targets:0,
                        className: 'dt-body-left'
                    },
                    {
                        targets:"_all",
                        className: 'dt-body-right'
                    },

                ],
                fixedColumns:{
                    leftColumns: 1,
                }
            });

            $('#hospital_table_length').addClass('text-gray-800 dark:text-gray-300')
            $('.dataTables_filter').addClass('text-gray-800 dark:text-gray-300').css('margin-bottom', '20px')
            $('.dataTables_info').addClass('text-gray-800 dark:text-gray-300')
            $('.dataTables_paginate').addClass('text-gray-800 dark:text-gray-300')
    } );
    </script>
</x-app-layout>