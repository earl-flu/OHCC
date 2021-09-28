<x-app-layout>

    <h2 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        Patients List
    </h2>


    <!-- With actions -->

    <div class="w-full overflow-hidden rounded-lg shadow-md border dark:border-transparent">
        <div class="w-full overflow-x-auto">
            @if(count($patients) >= 1)
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Case Definition</th>
                        <th class="px-4 py-3">Symptoms Classification</th>
                        <th class="px-4 py-3">Hospital/Facility</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($patients as $patient)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$patient->getCaseDefinition()}}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight
                                {{$patient->isMild() ? 'bg-yellow-100 dark:bg-yellow-500 dark:text-white text-gray-700' : 'bg-green-100 dark:bg-green-700 text-green-700 dark:text-green-100'}}
                                rounded-full  ">
                                {{$patient->getSymptomsClassification()}}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$patient->healthFacility->name}}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="{{route('patients.edit', $patient)}}"
                                    class="flex edit-icon-container hover:bg-green-500 ease-in-out transition-all items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit">
                                    <svg class="w-5 h-5 edit-icon" aria-hidden="true" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
                                    </svg>
                                </a>

                                <div id="ex-{{$loop->index}}" class="modal">
                                    <p class="text-red-500 text-2xl mb-2 font-bold">
                                        Delete
                                    </p>
                                    <p class="mb-5">Are you sure you want to delete <span
                                            class="font-bold">{{$patient->first_name}}</span>?</p>

                                    <div class="flex justify-evenly">
                                        <form action="{{route('patients.destroy', $patient)}}" method="POST"
                                            class="w-2/6">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-full bg-red-500 p-2 text-white rounded-md">
                                                Delete
                                            </button>
                                        </form>

                                        <a hred="#" rel="modal:close"
                                            class="cursor-pointer text-center w-2/6 bg-blue-400 p-2 text-white rounded-md">
                                            Cancel
                                        </a>
                                    </div>
                                </div>

                                <a href="#ex-{{$loop->index}}"
                                    class="del-modal flex edit-icon-container hover:bg-red-500 ease-in-out transition-all items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit">
                                    <svg class="w-5 h-5 delete-icon" aria-hidden="true" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h2 class="text-md text-red-500 font-semibold">Patients table is empty</h2>
            @endif
        </div>

        {{ $patients->links() }}
    </div>


    <script>
        // JQUERY MODAL CONFIG
        $('.del-modal').each(function(){
           $(this).click(function(event){
            event.preventDefault();
            $(this).modal({
                fadeDuration: 100
            })
           })
        });
    </script>

</x-app-layout>