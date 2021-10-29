<?php use Carbon\Carbon;

function isZeroOrBelow($occupied, $capacity){
    if($capacity == 0) return false;
    //return true if 0 or below
    if($capacity != 0 && ($capacity - $occupied) < 1 ) return true;
    return false;
}
?>
<x-app-layout>
    <h1 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        Notifications
    </h1>
    @forelse ($notifications as $notification)
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="
        bg-gray-100 col-span-6 min-w-0 p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 relative
          ">
            <p class="text-xs text-gray-500 " style="position: absolute; right:17px; top:17px;">
                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($notification->data['health_facility']['updated_at']))->diffForHumans() }}
            </p>
            <h4 class="mt-6 md:mt-0 mb-4 text-xl font-semibold text-gray-600 dark:text-gray-300">
                {{$notification->data['health_facility']['name']}}
            </h4>
            <p class="flex -mt-2"><span
                    class="bg-green-200 shadow-sm px-2 py-1 text-gray-100 flex text-gray-600 rounded text-xs font-semibold">Updated</span></p>
            <p class="mt-4 text-gray-500">   {{$notification->data['health_facility']['name']}} has updated their occupied beds.</p>
            {{-- <table width="100%" class="w-full block sm:table text-sm mt-5 overflow-auto">
                <thead>
                    <tr>
                        <th class="bg-gray-200 cursor-pointer text-gray-600 p-2 font-normal text-center min-width">
                            ICU Beds
                        </th>
                        <th class="bg-gray-200 cursor-pointer text-gray-600 p-2 font-normal text-center min-width">
                            Ward Beds
                        </th>
                        <th class="bg-gray-200 cursor-pointer text-gray-600 p-2 font-normal text-center min-width">
                            Isolation Beds
                        </th>
                        <th class="bg-gray-200 cursor-pointer text-gray-600 p-2 font-normal text-center">
                            Ventilators
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100 text-gray-600 text-center">
                        <td class="{{isZeroOrBelow(
                            $notification->data['health_facility']['occupied_icu'],
                            $notification->data['health_facility']['icu_capacity']
                            ) ? 'bg-red-500' : ''}} p-2 bg-opacity-20 border border-gray-300"
            :class="{'bg-red-500': isZeroOrBelow}">

            {{$notification->data['health_facility']['occupied_icu']}}/{{$notification->data['health_facility']['icu_capacity']}}
            </td>
            <td class="
                        {{isZeroOrBelow(
                            $notification->data['health_facility']['occupied_ward'],
                            $notification->data['health_facility']['ward_capacity']
                            ) ? 'bg-red-500' : ''}}
                        p-2 bg-opacity-20 border border-gray-300">

                {{$notification->data['health_facility']['occupied_ward']}}/{{$notification->data['health_facility']['ward_capacity']}}
            </td>
            <td class="
                        {{isZeroOrBelow(
                            $notification->data['health_facility']['occupied_isolation'],
                            $notification->data['health_facility']['isolation_capacity']
                            ) ? 'bg-red-500' : ''}}
                        p-2 bg-opacity-20 border border-gray-300">

                {{$notification->data['health_facility']['occupied_isolation']}}/{{$notification->data['health_facility']['isolation_capacity']}}
            </td>
            <td class="p-2 bg-opacity-20 border border-gray-300">

                14/{{$notification->data['health_facility']['max_ventilator']}}
            </td>
            </tr>
            </tbody>
            </table> --}}
            <div>
                {{$notification->markAsRead()}}
            </div>
            {{-- <div class="mt-5">
                <a href="#">
                    <button class="order-last text-sm focus:outline-none border border-transparent py-2 px-3
                    rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                        Mark as Read
                    </button>
                </a>

            </div> --}}
        </div>
    </div>
    @empty
    <p>No notifications</p>
    @endforelse

</x-app-layout>