<x-app-layout>

    <h2 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        Health Facilities
    </h2>
    <div class="w-full">
        <form action="{{route('health-facilities.index')}}" method="GET" autocomplete="off">
            <div class="flex mb-5">
                <label for="type" class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Type
                    </span>
                    <select name="type"
                        class="border border-gray-200 rounded block mt-1 w-max text-sm dark:text-gray-300 dark:border-gray-600
                    dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="all" selected>All</option>
                        <option value="hospital" {{request()->input('type') == 'hospital' ? 'selected' : ''}}>Hospital
                        </option>
                        <option value="isolation" {{request()->input('type') == 'isolation' ? 'selected' : ''}}>
                            Isolation Facility</option>
                    </select>
                </label>

                <label for="name_search" class="block text-sm ml-5">
                    <span class="text-gray-700 dark:text-gray-400">
                        Search name
                    </span>
                    <input type="text" name="name_search" value="{{request()->input('name_search')}}"
                        class="border border-gray-200 rounded block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                </label>
                <button type="submit"
                    class="self-end ml-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md border dark:border-transparent">

        <div class="w-full overflow-x-auto">
            @if(count($health_facilities) >= 1)
            <table class="w-full whitespace-no-wrap mb-5">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Facility name</th>
                        <th class="px-4 py-3">Address</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($health_facilities as $health_facility)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{$health_facility->name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$health_facility->municipality->name}}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="{{route('health-facilities.edit', $health_facility)}}"
                                    class="flex edit-icon-container hover:bg-green-500 ease-in-out transition-all items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit">
                                    <svg class="w-5 h-5 edit-icon" aria-hidden="true" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
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
    </div>
    <span class="mt-5 pb-5">
        {{ $health_facilities->onEachSide(1)->links() }}
    </span>
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