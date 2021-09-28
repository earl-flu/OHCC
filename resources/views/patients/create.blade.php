<x-app-layout>
    <h2 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        Add Patient
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

    <div class="grid grid-cols-8 gap6">
        <div class="col-span-8 md:col-span-3 px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{route('patients.store')}}" method="POST" autocomplete="off">
                @csrf
                @if ($errors->any())
                <div style="color: red;">
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
                        text: "Error saving patient",
                        icon: 'error',
                        position: 'top-right'
                    })
                </script>
                @endif
                @if (session('status'))
                <div class="alert alert-success">
                    <h1 class="9xl">{{ session('status') }}</h1>
                </div>
                @endif
                <div x-data="app()" x-cloak>

                    <div x-show.transition="step != 'complete'">
                        <!-- Top Navigation -->
                        <div class="border-b-2 py-4 mb-6">
                            <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight"
                                x-text="`Step: ${step} of 2`"></div>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="flex-1">
                                    <div x-show="step === 1">
                                        <div class="text-lg font-bold text-gray-600 dark:text-gray-400 leading-tight">
                                            Patient Detail</div>
                                    </div>

                                    <div x-show="step === 2">
                                        <div class="text-lg font-bold text-gray-600 dark:text-gray-400 leading-tight">
                                            Conditions</div>
                                    </div>
                                </div>

                                <div class="flex items-center md:w-64">
                                    <div class="w-full bg-white rounded-full mr-2">
                                        <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                            :style="'width: '+ parseInt(step / 2 * 100) +'%'"></div>
                                    </div>
                                    <div class="text-xs w-10 text-gray-600 dark:text-gray-400"
                                        x-text="parseInt(step / 2 * 100) +'%'">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Top Navigation -->
                        <div class="grid grid-cols-6 gap-6" x-show.transition.in="step === 1">

                            <!-- STEP 1-->
                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">First name</span>
                                    <input
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 
                                        dark:bg-gray-700 focus:border-purple-400 focus:outline-none
                                        focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        name="first_name" value="{{old('first_name')}}" />
                                </label>
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Middle name</span>
                                    <input
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        name="middle_name" value="{{old('middle_name')}}" />
                                </label>
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Last name</span>
                                    <input
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        name="last_name" value="{{old('last_name')}}" />
                                </label>
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Gender</span>
                                    <select
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="gender_id" id="gender">
                                        <option value="" disabled selected>Select Here</option>
                                        @foreach ($genders as $gender => $gender_value)
                                        <option value="{{$gender_value}}"
                                            {{old('gender_id') == $gender_value ? 'selected' : ''}}>
                                            {{$gender}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Municipality</span>
                                    <select
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="municipality_id" id="municipality">
                                        <option value="" disabled selected>Select Here</option>
                                        @foreach ($municipalities as $municipality)
                                        <option value="{{$municipality->id}}" id="{{$municipality->id_code}}"
                                            {{old('municipality_id') == $municipality->id ? 'selected' : ''}}>
                                            {{$municipality->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                {{-- <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Municipality</span>
                    
                                    <span class="text-gray-700 dark:text-gray-400">Municipality</span>
                                    <select
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="municipality" id="municipality"></select>
                                </label> --}}
                            </div>
                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Barangay</span>
                                    <select
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="barangay" id="barangay"></select>
                                </label>
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Age</span>
                                    <input type="text"
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        name="age" value="{{old('age')}}" />
                                </label>
                            </div>

                            {{-- <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Birthday</span>
                                    <input type="date"
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        name="birthday" value="{{old('birthday')}}" />
                                </label>
                            </div> --}}
                        </div>
                        <!-- END OF STEP 1-->
                        <!-- STEP 2-->
                        <div class="grid grid-cols-6 gap-6" x-show.transition.in="step === 2">

                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Case definition
                                    </span>
                                    <select name="case_definition_id" x-model="casedefinition"
                                        class="case_definition border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">

                                        <option value="" selected>Select here</option>
                                        @foreach ($case_definitions as $case_def => $case_def_value)
                                        <option value="{{$case_def_value}}"
                                            {{old('case_definition_id') == $case_def_value ? 'selected' : ''}}>
                                            {{$case_def}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div class="col-span-6" x-show.transition.in="casedefinition === '3'">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Patient number</span>
                                    <input
                                        class="patient_number border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        name="patient_number" placeholder="e.g. 9504"
                                        value="{{old('patient_number')}}" />
                                </label>
                            </div>

                            <div class="col-span-6 ">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Symptoms classification
                                    </span>
                                    <select name="symptoms_classification_id"
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                        <option value="" disabled selected>Select here</option>
                                        @foreach ($symptoms_classifications as $symptom => $symptom_value)
                                        <option value="{{$symptom_value}}"
                                            {{old('symptoms_classification_id') == $symptom_value ? 'selected' : ''}}>
                                            {{$symptom}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div class="col-span-6 ">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Patient status
                                    </span>
                                    <select name="patient_status_id"
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                        <option value="" disabled selected>Select here</option>
                                        @foreach ($patient_statuses as $stat)
                                        <option value="{{$stat->id}}"
                                            {{old('patient_status_id') == $stat->id ? 'selected' : ''}}>{{$stat->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="col-span-6 ">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Hospitals/Isolation Facility
                                    </span>
                                    {{-- <select name="hospital_id" id="hospital"
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray js-example-basic-single">
                                        <option value="" disabled selected>Select here</option>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{$hospital->id}}"
                                            {{old('hospital_id') == $hospital->id ? 'selected' : ''}}>
                                            {{$hospital->name}}</option>
                                        @endforeach

                                    </select> --}}

                                    <!-- Grouped Hospital -->
                                    <select name="health_facility_id" id="health_facility" class="js-example-basic-single">
                                        <option value="" disabled selected>Select here</option>
                                        @foreach($groupedHospitals as $municipality => $g_hospitals)

                                        <optgroup label="{{$municipality}}">
                                    @foreach($g_hospitals as $g_hospital)
                                    <option value={{$g_hospital->id}}
                                        {{old('health_facility_id') == $g_hospital->id ? 'selected' : ''}}>
                                        {{$g_hospital->name}}</option>
                                    @endforeach
                                    </optgroup>

                                    @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="col-span-6 ">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Bed type
                                    </span>
                                    <select name="bed_id"
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                        <option value="" disabled selected>Select here</option>
                                        @foreach ($beds as $bed => $bed_value)
                                        <option value="{{$bed_value}}" {{old('bed_id') == $bed_value ? 'selected' : ''}}>
                                            {{$bed}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Remarks/Symptoms</span>
                                    <textarea name="remarks"
                                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        rows="3">{{old('remarks')}}</textarea>
                                </label>
                            </div>
                        </div>
                        <!--END OF STEP 2-->
                        <!-- Bottom Navigation -->
                        <div class="pt-5" x-show="step != 'complete'">
                            <div class="max-w-3xl mx-auto">
                                <div class="flex justify-between">
                                    <div class="w-1/2">
                                        <button type="button" x-show="step > 1" @click="step--"
                                            class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Previous</button>
                                    </div>

                                    <div class="w-1/2 text-right">
                                        <button type="button" x-show="step < 2" @click="step++"
                                            class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">Next</button>

                                        <button x-show="step === 2"
                                            class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            //ALPINE
            function app() {
                console.log('executed')
                return {
                    step: 1,
                    casedefinition: "{{old('case_definition_id')}}" || '',
                }
            }

            //PH_LOCATION
            var my_handlers = {
                fill_barangays: function(){
                    var city_code = $(this).find(":selected").attr("id");
                    $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
                }
            };

            //document ready in jquery
            $(function(){
                //ph_location default setup
                $('#municipality').on('change', my_handlers.fill_barangays);

                $('#barangay').ph_locations({'location_type': 'barangays'});

                const municipalityID = $('#municipality').children(":selected").attr("id");
                const oldBarangay= "{{old('barangay')}}";

                    if (municipalityID) {
                        if(oldBarangay) {
                        let [brgy_name, brgy_id] = oldBarangay.split("__");

                        $('#barangay').ph_locations('fetch_list', [{"city_code": municipalityID }]);
                  
                        $('#barangay').one("DOMNodeInserted",function(){
                            $('#barangay').find(`#${brgy_id}`).attr('selected', 'selected');
                        });   
                    }    
                    }
            });

            $(document).ready( function () {
                // patient number
                $('.case_definition').on("change", function(){
                    $(".patient_number").val('');
                });

                //select-2
                $('.js-example-basic-single').select2();

                //select2 style
                $('.select2').addClass('select2-style');
                $('.select2-selection').addClass('bg-gray-700');

                $('#test2').val('2').css('color','red');
                
            });
        </script>
</x-app-layout>