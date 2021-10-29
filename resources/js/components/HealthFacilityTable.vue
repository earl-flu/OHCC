<template>
    <div class="overflow-auto">
        <h2 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
            <span class="text-yellow-500 mr-1 font-thin">#</span>
            Health Facilities
        </h2>

        <div class="grid gap-6 mb-10 md:grid-cols-2 xl:grid-cols-3 mt-2">
            <!--Card-->
            <div
                class="h-36 flex flex-col p-2 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 "
            >
                <div class="text-center text-xl mb-1">ICU Beds</div>
                <div
                    class="flex items-stretch h-full border border-gray-300 rounded overflow-hidden"
                >
                    <div class="flex-1 flex flex-col">
                        <div class="text-sm text-center p-2 bg-yellow-200">
                            Occupied
                        </div>
                        <div class="flex-1 flex">
                            <div
                                class="flex flex-1 items-center justify-center border-r border-gray-200"
                            >
                                <div class="text-xl text-gray-600">
                                    {{ occupiedICU }}/{{ capacityICU }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col text-gray-600">
                        <div
                            class="text-sm text-center p-2 bg-yellow-300 font-semibold"
                        >
                            Vacant
                        </div>
                        <div
                            class="flex items-center justify-center h-full border-l border-gray-200 text-5xl"
                        >
                            {{ capacityICU - occupiedICU }}
                        </div>
                    </div>
                </div>
            </div>
            <!--Card-->
            <div
                class="h-36 flex flex-col p-2 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 "
            >
                <div class="text-center text-xl mb-1">Ward Beds</div>
                <div
                    class="flex items-stretch h-full border border-gray-300 rounded overflow-hidden"
                >
                    <div class="flex-1 flex flex-col">
                        <div class="text-sm text-center p-2 bg-green-200">
                            Occupied
                        </div>
                        <div class="flex-1 flex">
                            <div
                                class="flex flex-1 items-center justify-center border-r border-gray-200"
                            >
                                <div class="text-xl text-gray-600">
                                    {{ occupiedWard }}/{{ capacityWard }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col text-gray-600">
                        <div
                            class="text-sm text-center p-2 bg-green-300 font-semibold"
                        >
                            Vacant
                        </div>
                        <div
                            class="flex items-center justify-center h-full border-l border-gray-200 text-5xl"
                        >
                            {{ capacityWard - occupiedWard }}
                        </div>
                    </div>
                </div>
            </div>

            <!--Card-->
            <div
                class="h-36 flex flex-col p-2 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800 "
            >
                <div class="text-center text-xl mb-1">Isolation Beds</div>
                <div
                    class="flex items-stretch h-full border border-gray-300 rounded overflow-hidden"
                >
                    <div class="flex-1 flex flex-col">
                        <div class="text-sm text-center p-2 bg-blue-200">
                            Occupied
                        </div>
                        <div class="flex-1 flex">
                            <div
                                class="flex flex-1 items-center justify-center border-r border-gray-200"
                            >
                                <div class="text-xl text-gray-600">
                                    {{ occupiedIsolation }}/{{
                                        capacityIsolation
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col text-gray-600">
                        <div
                            class="text-sm text-center p-2 bg-blue-300 font-semibold"
                        >
                            Vacant
                        </div>
                        <div
                            class="flex items-center justify-center h-full  border-l border-gray-200 text-5xl"
                        >
                            {{ capacityIsolation - occupiedIsolation }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-md border rounded-lg p-5 mb-10">
            <!-- Filter Container-->
            <div class="grid grid-cols-4 gap-4 mb-5">
                <div class="col-span-4 md:col-span-1">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400"
                            >Name</span
                        >
                        <input
                            class="border w-full border-gray-200 rounded block mt-1 text-sm
            dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400
            focus:outline-none focus:shadow-outline-purple dark:text-gray-300
            dark:focus:shadow-outline-gray form-input"
                            name="name"
                            v-model="nameQuery"
                            autocomplete="off"
                        />
                    </label>
                </div>

                <!-- Type -->
                <div class="col-span-4 md:col-span-1">
                    <label class="block text-sm pl-1">
                        <span class="text-gray-700 dark:text-gray-400">
                            Type
                        </span>
                        <select
                            v-model="selectedType"
                            class="block w-full mt-1 rounded text-sm border dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        >
                            <option value="All">All</option>
                            <option value="0">Hospital</option>
                            <option value="1">Isolation Facility</option>
                        </select>
                    </label>
                </div>

                <!-- Municipality -->
                <div class="col-span-4 md:col-span-1">
                    <label class="block text-sm pl-1">
                        <span class="text-gray-700 dark:text-gray-400">
                            Municipality
                        </span>
                        <select
                            v-model="selectedMunicipality"
                            class="block w-full mt-1 rounded text-sm border dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        >
                            <option value="All">All</option>
                            <option
                                v-for="m in municipalities"
                                v-bind:value="m.id"
                                >{{ m.name }}</option
                            >
                        </select>
                    </label>
                </div>
                <div class="flex items-end col-span-4 md:col-span-1">
                    <button
                        @click="setFilteredData"
                        class="w-full md:align-bottom md:w-36 text-sm focus:outline-none border border-transparent py-2 px-3
                        rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
                    >
                        Filter
                    </button>
                </div>
            </div>
            <!--End Filter Container-->

            <div class="overflow-auto tableFixHead mb-10 table-min-height">
                <table width="100%">
                    <thead>
                        <tr>
                            <th
                                @click="sortCol('name')"
                                class="bg-blue-500 cursor-pointer text-white px-2 py-3 font-normal"
                            >
                                Name
                            </th>
                            <th
                                @click="sortCol('icu_capacity')"
                                class="bg-blue-500 cursor-pointer text-white px-2 py-3 font-normal text-left min-width"
                            >
                                ICU Beds
                            </th>
                            <th
                                @click="sortCol('ward_capacity')"
                                class="bg-blue-500 cursor-pointer text-white px-2 py-3 font-normal text-left min-width"
                            >
                                Ward Beds
                            </th>
                            <th
                                @click="sortCol('isolation_capacity')"
                                class="bg-blue-500 cursor-pointer text-white px-2 py-3 font-normal text-left min-width"
                            >
                                Isolation Beds
                            </th>
                            <th
                                @click="sortCol('updated_at')"
                                class="bg-blue-500 cursor-pointer text-white px-2 py-3 font-normal text-left"
                            >
                                Updated At
                            </th>
                            <th
                                @click="sortCol('max_ventilator')"
                                class="bg-blue-500 cursor-pointer text-white px-2 py-3 font-normal text-left"
                            >
                                Ventilators
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="hover:bg-gray-100 text-gray-600"
                            v-if="loaded"
                            v-for="({
                                id,
                                name,
                                occupied_icu,
                                occupied_ward,
                                occupied_isolation,
                                icu_capacity,
                                isolation_capacity,
                                ward_capacity,
                                max_ventilator,
                                active_ventilator,
                                updated_at
                            },
                            index) in filteredData"
                            :key="index"
                        >
                            <td class="px-2 py-3 bg-opacity-80">
                               {{ name }}</td>
                            <td
                                class="px-2 py-3 bg-opacity-80"
                                :class="classICU(occupied_icu, icu_capacity)"
                            >
                                {{ occupied_icu }}/{{ icu_capacity }}
                            </td>
                            <td
                                class="px-2 py-3 bg-opacity-80"
                                :class="classWard(occupied_ward, ward_capacity)"
                            >
                                {{ occupied_ward }}/{{ ward_capacity }}
                            </td>
                            <td
                                class="px-2 py-3 bg-opacity-80"
                                :class="
                                    classIso(
                                        occupied_isolation,
                                        isolation_capacity
                                    )
                                "
                            >
                                {{ occupied_isolation }}/{{
                                    isolation_capacity
                                }}
                            </td>
                            <td class="px-2 py-3 bg-opacity-80 text-sm">
                                <span
                                    class="p-2 rounded"
                                    :class="
                                        classHasToday(formatDate(updated_at))
                                    "
                                    >{{ formatDate(updated_at) }}</span
                                >
                            </td>
                            <td
                                class="px-2 py-3 bg-opacity-80"
                                :class="classVenti(active_ventilator,max_ventilator)"
                            >
                                {{ active_ventilator }}/{{ max_ventilator }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div
                    v-if="loaded && !filteredData.length"
                    class="text-center mt-5"
                >
                    No Record Found
                </div>
                <div v-if="!loaded" class="text-center mt-5">Loading...</div>
            </div>
        </div>
    </div>
</template>

<script>
import HealthFacilityService from "../services/HealthFacilityService.js";
export default {
    props: ["municipalities"],
    data() {
        return {
            nameQuery: "",
            selectedType: "All",
            selectedMunicipality: "All",
            loaded: false,
            healthfacilities: [],
            filteredData: [],
            currentSort: "name",
            currentSortDir: "asc"
        };
    },
    created() {
        HealthFacilityService.getHealthFacilities()
            .then(res => {
                this.loaded = false;
                this.healthfacilities = res.data.data;
                this.setDefaultFilteredData();
                this.loaded = true;
            })
            .catch(err => {
                console.log("There was an error:", err);
            });
    },
    computed: {
        // refactor this, I think this is not the best approach
        occupiedWard() {
            return this.filteredData.reduce((total, obj) => {
                total += obj.occupied_ward;
                return total;
            }, 0);
        },
        capacityWard() {
            return this.filteredData.reduce((total, obj) => {
                total += obj.ward_capacity;
                return total;
            }, 0);
        },
        occupiedIsolation() {
            return this.filteredData.reduce((total, obj) => {
                total += obj.occupied_isolation;
                return total;
            }, 0);
        },
        capacityIsolation() {
            return this.filteredData.reduce((total, obj) => {
                total += obj.isolation_capacity;
                return total;
            }, 0);
        },
        occupiedICU() {
            return this.filteredData.reduce((total, obj) => {
                total += obj.occupied_icu;
                return total;
            }, 0);
        },
        capacityICU() {
            return this.filteredData.reduce((total, obj) => {
                total += obj.icu_capacity;
                return total;
            }, 0);
        }
    },
    methods: {
        sortCol(name) {
            this.setCurrentSortDir(name);
            this.sortFilteredData();
        },
        setCurrentSortDir(n) {
            //if s == current sort, reverse
            if (n === this.currentSort) {
                this.currentSortDir =
                    this.currentSortDir === "asc" ? "desc" : "asc";
            }
            this.currentSort = n;
        },
        sortFilteredData() {
            this.filteredData = this.filteredData.sort((a, b) => {
                let modifier = 1;
                if (this.currentSortDir === "desc") modifier = -1;
                if (a[this.currentSort] < b[this.currentSort])
                    return -1 * modifier;
                if (a[this.currentSort] > b[this.currentSort])
                    return 1 * modifier;
                return 0;
            });
        },
        setFilteredData() {
            this.setDefaultFilteredData();
            this.setFilteredDataByName();
            this.setFilteredDataByType();
            this.setFilteredDataByMunicipality();
        },

        setDefaultFilteredData() {
            this.filteredData = this.healthfacilities;
        },
        setFilteredDataByName() {
            if (!this.nameQuery) return;

            this.filteredData = this.filteredData.filter(item => {
                return (
                    item.name
                        .toLowerCase()
                        .indexOf(this.nameQuery.toLowerCase()) > -1
                );
            });
        },
        setFilteredDataByType() {
            if (this.selectedType === "All") {
                this.filteredData = this.filteredData;
            }
            //if isolation facility
            if (this.selectedType === "1") {
                this.filteredData = this.filteredData.filter(item => {
                    return item.is_isolation_facility === 1;
                });
            }
            //if hospital
            if (this.selectedType === "0") {
                this.filteredData = this.filteredData.filter(item => {
                    return item.is_isolation_facility === 0;
                });
            }
        },
        setFilteredDataByMunicipality() {
            const municipality_id = this.selectedMunicipality;
            if (municipality_id === "All") {
                this.filteredData = this.filteredData;
            } else {
                this.filteredData = this.filteredData.filter(item => {
                    return item.municipality.id == municipality_id;
                });
            }
        },
        formatDate(inputDate) {
            const dateOption = {
                weekday: "short",
                year: "numeric",
                month: "short",
                day: "numeric"
            };
            const timeOption = {
                hour: "numeric",
                minute: "numeric",
                hour12: true
            };
            const today = new Date();
            const date = new Date(inputDate);
            const formatedDate = date.toLocaleDateString("en-US", dateOption);
            const formatedTime = date.toLocaleString("en-US", timeOption);

            //if today
            if (date.setHours(0, 0, 0, 0) == today.setHours(0, 0, 0, 0)) {
                return `Today, ${formatedTime}`;
            } else {
                return `${formatedDate} | ${formatedTime}`;
            }
        },
        classICU(occupied, capacity) {
            return {
                "bg-yellow-100": capacity - occupied >= 1
            };
        },
        classIso(occupied, capacity) {
            return {
                "bg-blue-100": capacity - occupied >= 1
            };
        },
        classWard(occupied, capacity) {
            return {
                "bg-green-100": capacity - occupied >= 1
            };
        },
        classVenti(occupied, capacity) {
            return {
                "bg-purple-100":  capacity - occupied >= 1
            };
        },
        classHasToday(str) {
            return {
                "bg-green-200": str.includes("Today")
            };
        }
    }
};
</script>

<style lang="css" scoped>
.tableFixHead thead th {
    position: sticky;
    top: 0;
    z-index: 1;
}
.min-width {
    min-width: 140px;
}
/* table {
    border-collapse: collapse;
} */
tr {
    border: 0.5px solid #ccc;
}

.table-min-height {
    height: 420px;
}
</style>
