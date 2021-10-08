<template>
    <div class="overflow-auto">
        <h1 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
            <span class="text-yellow-500 mr-1 font-thin">#</span>
            Hospitals & Health Facilities
        </h1>
        <div class=" shadow-md border rounded-lg p-5 mb-10">
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
                            <option value="0">Hospitals</option>
                            <option value="1">Isolation Facilities</option>
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
                    <!-- <button
                        @click="sortByNameAsc"
                        class="w-full md:align-bottom md:w-36 text-sm focus:outline-none border border-transparent py-2 px-3
                        rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
                    >
                        SortByName
                    </button> -->
                </div>
            </div>
            <!--End Filter Container-->

            <div class="overflow-auto tableFixHead mb-10 table-min-height">
                <table width="100%">
                    <thead>
                        <tr>
                            <th
                                class="bg-blue-500 text-white px-2 py-3 font-normal"
                            >
                                Name
                            </th>
                            <th
                                class="bg-blue-500 text-white px-2 py-3 font-normal text-left min-width"
                            >
                                ICU Beds
                            </th>
                            <th
                                class="bg-blue-500 text-white px-2 py-3 font-normal text-left min-width"
                            >
                                Isolation Beds
                            </th>
                            <th
                                class="bg-blue-500 text-white px-2 py-3 font-normal text-left min-width"
                            >
                                Ward Beds
                            </th>

                            <th
                                class="bg-blue-500 text-white px-2 py-3 font-normal text-left"
                            >
                                Last update
                            </th>
                            <th
                                class="bg-blue-500 text-white px-2 py-3 font-normal text-left"
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
                                name,
                                occupied_icu,
                                occupied_ward,
                                occupied_isolation,
                                icu_capacity,
                                isolation_capacity,
                                ward_capacity,
                                max_ventilator,
                                updated_at
                            },
                            index) in filteredData"
                            :key="index"
                        >
                            <td class="px-2 py-3 bg-opacity-80">{{ name }}</td>
                            <td
                                class="px-2 py-3 bg-opacity-80"
                                :class="classICU(occupied_icu, icu_capacity)"
                            >
                                {{ occupied_icu }}/{{ icu_capacity }}
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
                            <td
                                class="px-2 py-3 bg-opacity-80"
                                :class="classWard(occupied_ward, ward_capacity)"
                            >
                                {{ occupied_ward }}/{{ ward_capacity }}
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
                                :class="classVenti(max_ventilator)"
                            >
                                {{ max_ventilator }}
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
            filteredData: []
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

    methods: {
        sortByNameAsc() {
            this.filteredData = this.filteredData.sort((a, b) => {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
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
            const option1 = {
                weekday: "short",
                year: "numeric",
                month: "short",
                day: "numeric"
            };
            const option2 = {
                hour: "numeric",
                minute: "numeric",
                hour12: true
            };
            const today = new Date();
            const date = new Date(inputDate);
            const formatedDate = date.toLocaleDateString("en-US", option1);
            const formatedTime = date.toLocaleString("en-US", option2);

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
        classVenti(val) {
            return {
                "bg-purple-100": val >= 1
            };
        },
        classHasToday(str) {
            return {
                "bg-green-200": str.includes("Today")
            };
        }
    },
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
