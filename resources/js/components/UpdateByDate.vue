<template>
    <div
        class="shadow-md border rounded-lg p-4 sm:p-5 mb-10 overflow-auto"
        style="min-height:500px;"
    >
        <div class="flex flex-col md:flex-row mb-2 text-gray-600">
            <datepicker
                input-class="text-sm mb-2 md:mb-0 border w-11/12 md:w-auto p-1 rounded font-semibold"
                placeholder="Date"
                :full-month-name="true"
                :clear-button="true"
                v-model="date"
            ></datepicker>
            <button
                @click="setHistories(date)"
                class="w-11/12 md:w-auto md:ml-4  px-3 flex-none py-1 text-sm font-medium leading-5
                 text-white transition-colors duration-150 border 
                 border-transparent rounded-md bg-blue-500 hover:bg-blue-600 
                 focus:outline-none"
            >
                Filter
            </button>
        </div>
        <div class="flex">
            <!-- Checkbox -->
            <div class="mb-8">
                <input
                    class="align-middle"
                    type="checkbox"
                    id="checkbox"
                    v-model="checked"
                />
                <!-- @change="fillData()" -->
                <label for="checkbox" class="text-sm text-gray-600"
                    >Last Update Only</label
                >
            </div>
        </div>
        <div v-if="!checked">
            <div v-for="history in histories">
                <h2 class="text-xl mb-2 text-gray-700 text-opacity-95">
                    <span class="text-yellow-500 mr-1 font-thin">#</span>
                    {{ history.health_facility_name }}
                </h2>
                <div
                    class="border border-gray-300 shadow-md p-4 rounded bg-gray-100 bg-opacity-70 mb-8"
                >
                    <p class="text-xs text-gray-500 font-semibold -mt-1 mb-5">
                        {{ getTime(history.created_at) }}
                    </p>
                    <table width="100%" class="overflow-auto block sm:table">
                        <thead>
                            <tr>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    ICU Beds
                                </th>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    Ward Beds
                                </th>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    Isolation Beds
                                </th>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    Ventilators
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="hover:bg-gray-200 text-gray-600 bg-white"
                            >
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.icu_capacity,
                                            history.occupied_icu
                                        )
                                    "
                                >
                                    {{ history.occupied_icu }}/{{
                                        history.icu_capacity
                                    }}
                                </td>
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.ward_capacity,
                                            history.occupied_ward
                                        )
                                    "
                                >
                                    {{ history.occupied_ward }}/{{
                                        history.ward_capacity
                                    }}
                                </td>
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.isolation_capacity,
                                            history.occupied_isolation
                                        )
                                    "
                                >
                                    {{ history.occupied_isolation }}/{{
                                        history.isolation_capacity
                                    }}
                                </td>
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.max_ventilator,
                                            history.active_ventilator
                                        )
                                    "
                                >
                                    {{ history.active_ventilator }}/{{
                                        history.max_ventilator
                                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div
                class="text-red-500 font-semibold"
                v-if="loaded && histories.length === 0"
            >
                NO UPDATE FOUND
            </div>
            <div v-if="!loaded">
                Loading...
            </div>
        </div>
        <div v-else>
            <!-- Single History per day -->
            <div v-for="history in singleHistoryPerDay">
                <h2 class="text-xl mb-2 text-gray-700 text-opacity-95">
                    <span class="text-yellow-500 mr-1 font-thin">#</span>
                    {{ history.health_facility_name }}
                </h2>
                <div
                    class="border border-gray-300 shadow-md p-4 rounded bg-gray-100 bg-opacity-70 mb-8"
                >
                    <p class="text-xs text-gray-500 font-semibold -mt-1 mb-5">
                        {{ getTime(history.created_at) }}
                    </p>
                    <table width="100%" class="overflow-auto block sm:table">
                        <thead>
                            <tr>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    ICU Beds
                                </th>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    Ward Beds
                                </th>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    Isolation Beds
                                </th>
                                <th
                                    class="bg-gray-500 bg-opacity-70 text-white p-2 font-normal"
                                >
                                    Ventilators
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="hover:bg-gray-200 text-gray-600 bg-white"
                            >
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.icu_capacity,
                                            history.occupied_icu
                                        )
                                    "
                                >
                                    {{ history.occupied_icu }}/{{
                                        history.icu_capacity
                                    }}
                                </td>
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.ward_capacity,
                                            history.occupied_ward
                                        )
                                    "
                                >
                                    {{ history.occupied_ward }}/{{
                                        history.ward_capacity
                                    }}
                                </td>
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.isolation_capacity,
                                            history.occupied_isolation
                                        )
                                    "
                                >
                                    {{ history.occupied_isolation }}/{{
                                        history.isolation_capacity
                                    }}
                                </td>
                                <td
                                    class="p-2 bg-opacity-80 border border-gray-300 text-center"
                                    :class="
                                        classIsFull(
                                            history.max_ventilator,
                                            history.active_ventilator
                                        )
                                    "
                                >
                                    {{ history.active_ventilator }}/{{
                                        history.max_ventilator
                                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div
                class="text-red-500 font-semibold"
                v-if="loaded && singleHistoryPerDay.length === 0"
            >
                NO UPDATE FOUND
            </div>
            <div v-if="!loaded">
                Loading...
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import SuperAdminHistoryService from "../services/SuperAdminHistoryService.js";

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            loaded: false,
            histories: [],
            singleHistoryPerDay: [],
            date: new Date(),
            checked: true
        };
    },
    created() {
        this.setHistories(this.date);
    },
    methods: {
        setHistories(date) {
            //bago ipasa dapat converted yung dateObj into yyyy/mm/dd
            const myDate = date.toISOString().split("T")[0];

            SuperAdminHistoryService.getHistories(myDate)
                .then(res => {
                    this.loaded = false;
                    //set activities data
                    this.histories = res.data.data;

                    this.singleHistoryPerDay = this.setSingleHistoryPerDay(
                        this.histories
                    );
                    this.loaded = true;
                })
                .catch(err => {
                    console.log("There was an error:", err);
                });
        },
        getTime(date) {
            const time = new Date(date);
            return time.toLocaleString("en-US", {
                hour: "numeric",
                minute: "numeric",
                hour12: true
            });
        },
        // METHODS FOR REDUCING THE ARRAY
        mapHistories(arr) {
            return arr.map(item => {
                const [date, time] = item.created_at.split(" ");
                return { ...item, date, time };
            });
        },
        findHighestInGroup(data) {
            return data.reduce(
                (acc, curr) => {
                    const { time } = curr;
                    if (time > acc.time) {
                        return {
                            ...curr
                        };
                    }
                    return acc;
                },
                { time: "" }
            );
        },
        resolveLatestByTime(data) {
            // Create an array of unique health_facility_name
            const unique = [
                ...new Set(data.map(item => item.health_facility_name))
            ];

            // loop in every unique health_facility_name
            return unique.reduce((acc, curr) => {
                // Group the data per health_facility_name in every loop
                const groupByName = data.filter(
                    d => d.health_facility_name === curr
                );

                /**
                 * First loop will return e.g.
                 *  [
                 *    { health_facility_name: A, date: "01-01-2021", ...},
                 *    { health_facility_name: A, date: "01-01-2021", ... },
                 *    { health_facility_name: A, date: "01-01-2021", ... },
                 * ]
                 */

                //reduce the health_facility_name of date and only return the latest
                const highestInGroup = this.findHighestInGroup(groupByName);

                return [...acc, highestInGroup];
            }, []);
        },

        setSingleHistoryPerDay(histo) {
            const mappedHistories = this.mapHistories(histo);
            return this.resolveLatestByTime(mappedHistories);
        },

        classIsFull(capacity, occupied) {
            return {
                "bg-red-200": capacity > 0 && capacity - occupied < 1
            };
        }
    }
};
</script>

<style lang="scss" scoped></style>
