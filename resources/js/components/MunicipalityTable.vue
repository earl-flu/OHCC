<template>
    <div>
        <h1 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
            <span class="text-yellow-500 mr-1 font-thin">#</span>
            {{ title }} Per Municipality
        </h1>
        <div class="overflow-auto shadow-md border rounded-lg p-5 mb-10">
            <label class="block text-sm pl-1 mb-5">
                <span class="text-gray-700 dark:text-gray-400">
                    Select here:
                </span>
                <select
                    v-model="selectedBedTotal"
                    class="block w-full mt-1 rounded text-sm border dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                    <option value="1">Bed Capacity</option>
                    <option value="2">Occupied Bed</option>
                    <option value="3">Vacant Bed</option>
                    <option value="4">Occupied Bed/Bed Capacity</option>
                </select>
            </label>
            <div class="tableFixHead mb-2 overflow-auto" style="height:490px;">
                <table width="100%">
                    <thead>
                        <tr
                            class="bg-gradient-to-r from-indigo-400 via-blue-500 to-purple-600 "
                        >
                            <th class="text-white p-2 font-normal" width="200">
                                Municipality
                            </th>
                            <th class="text-white p-2 font-normal">
                                {{ text }} ICU Beds
                            </th>
                            <th class="text-white p-2 font-normal">
                                {{ text }} Isolation Beds
                            </th>
                            <th class="text-white p-2 font-normal">
                                {{ text }} Ward Beds
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="hover:bg-gray-100"
                            v-for="m in municipalitiesData"
                            :key="m.id"
                        >
                            <td class="p-2 bg-opacity-80">{{ m.name }}</td>
                            <td
                                width="150"
                                class="p-2 bg-opacity-80"
                                :class="
                                    classObj(
                                        showSelectedBedTotal(m, 'icu'),
                                        'yellow'
                                    )
                                "
                            >
                                {{ showSelectedBedTotal(m, "icu") }}
                            </td>
                            <td
                                width="150"
                                class="p-2 bg-opacity-80"
                                :class="
                                    classObj(
                                        showSelectedBedTotal(m, 'isolation'),
                                        'blue'
                                    )
                                "
                            >
                                {{ showSelectedBedTotal(m, "isolation") }}
                            </td>
                            <td
                                width="150"
                                class="p-2 bg-opacity-80"
                                :class="
                                    classObj(
                                        showSelectedBedTotal(m, 'ward'),
                                        'green'
                                    )
                                "
                            >
                                {{ showSelectedBedTotal(m, "ward") }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div
                    v-if="loaded && !municipalitiesData.length"
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
import MunicipalityService from "../services/MunicipalityService.js";

export default {
    data() {
        return {
            loaded: false,
            selectedBedTotal: 1, //e.g. Bed Capacity, Occupied Bed
            municipalitiesData: []
        };
    },
    created() {
        MunicipalityService.getMunicipalities()
            .then(res => {
                this.loaded = false;
                this.municipalitiesData = res.data.data;
                this.loaded = true;
            })
            .catch(err => {
                console.log("There was an error:", err);
            });
    },
    methods: {
        classObj(val, color) {
            let isOccupiedOverCapacity = String(val).includes("/"); //Occupied Bed/Bed Capacity e.g. 1/3

            if (isOccupiedOverCapacity) {
                const [occ, cap] = val.split("/");
                return {
                    [`bg-${color}-100`]: cap - occ >= 1,
                    [`bg-red-200`]: (occ != 0 && occ == cap) || occ > cap
                };
            }
            return {
                [`bg-${color}-100`]: val >= 1
            };
        },

        showSelectedBedTotal(mun, bedType) {
            const selected = this.selectedBedTotal;
            return selected == 1
                ? mun[`total_${bedType}_capacity`]
                : selected == 2
                ? mun[`total_${bedType}_occupied`]
                : selected == 3
                ? mun[`total_${bedType}_capacity`] -
                  mun[`total_${bedType}_occupied`]
                : selected == 4
                ? mun[`total_${bedType}_occupied`] +
                  "/" +
                  mun[`total_${bedType}_capacity`]
                : "";
        }
    },
    computed: {
        title() {
            if (this.selectedBedTotal == 1) return "Bed Capacity";
            if (this.selectedBedTotal == 2) return "Occupied Bed";
            if (this.selectedBedTotal == 3) return "Vacant Bed";
            if (this.selectedBedTotal == 4) return "Occupied Bed/Bed Capacity";
        },
        text() {
            if (this.selectedBedTotal == 2) return "Occupied";
            if (this.selectedBedTotal == 3) return "Vacant";
            return "Total";
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
tr {
    border: 0.5px solid #ccc;
}
</style>
