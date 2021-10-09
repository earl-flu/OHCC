<template>
    <div class="shadow-md border rounded-lg p-5 mb-10 overflow-auto">
        <!-- Filter Container -->
        <div class="flex flex-col md:flex-row mt-5 mb-2 text-gray-600">
            <datepicker
                input-class="text-sm mb-2 md:mb-0 border w-11/12 md:w-auto p-1 rounded"
                placeholder="From"
                :full-month-name="true"
                :clear-button="true"
                v-model="dateFrom"
            ></datepicker>

            <datepicker
                input-class="text-sm mb-2 md:mb-0 border p-1 w-11/12 md:w-auto rounded md:ml-4"
                placeholder="To"
                :full-month-name="true"
                :clear-button="true"
                v-model="dateTo"
            ></datepicker>

            <button
                @click="setHistories(dateFrom, dateTo)"
                class="w-11/12 md:w-auto md:ml-4  px-3 flex-none py-1 text-sm font-medium leading-5
                 text-white transition-colors duration-150 border 
                 border-transparent rounded-md bg-blue-500 hover:bg-blue-600 
                 focus:outline-none"
            >
                Filter
            </button>
        </div>
        <!-- Checkbox -->
        <div class="mb-5">
            <input
                class="align-middle"
                type="checkbox"
                id="checkbox"
                v-model="checked"
                @change="fillData()"
            />
            <label for="checkbox" class="text-sm text-gray-600"
                >Last update per day</label
            >
        </div>
        <div style="min-width:600pxgit ;">
            <line-chart
                :chart-data="datacollection"
                :options="options"
            ></line-chart>
        </div>
    </div>
</template>

<script>
import HistoryService from "../services/HistoryService.js";
import Datepicker from "vuejs-datepicker";

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            dateFrom: null,
            dateTo: new Date(),
            checked: false,
            histories: [],
            singleActivityPerDay: [],
            datacollection: {},
            //IDEA -kung ga update pag gabago ang dataset - edi ihiling yung docu ni chart vuejs
            // at itry utro yung code duman
            options: {
                plugins: {
                    datalabels: {
                        display: true,
                        color: "white",
                        align: "end",
                        anchor: "end",
                        borderRadius: 4,
                        padding: 3,
                        backgroundColor: function(context) {
                            return context.dataset.borderColor;
                        },
                        font: {
                            weight: "bold",
                            size: 10
                        }
                    }
                },
                maintainAspectRatio: false,
                responsive: true
            }
        };
    },
    created() {
        this.setInitialDateFrom();
        this.setHistories(this.dateFrom, this.dateTo);
    },

    methods: {
        setHistories(dateFrom, dateTo) {
            //bago ipasa dapat converted yung dateObj into yyyy/mm/dd
            const startDate = dateFrom.toISOString().split("T")[0];
            const endDate = dateTo.toISOString().split("T")[0];

            HistoryService.getHistories(startDate, endDate)
                .then(res => {
                    //set activities data
                    this.histories = res.data.data;

                    this.singleHistoryPerDay = this.setSingleHistoryPerDay(
                        this.histories
                    );
                    //fill the data for chart
                    this.fillData();
                })
                .catch(err => {
                    console.log("There was an error:", err);
                });
        },

        fillData() {
            const dates = this.mapHistoriesByDate(this.checked);
            const ward_beds = this.mapHistoriesByOccupiedBed(
                this.checked,
                "occupied_ward"
            );
            const iso_beds = this.mapHistoriesByOccupiedBed(
                this.checked,
                "occupied_isolation"
            );
            const icu_beds = this.mapHistoriesByOccupiedBed(
                this.checked,
                "occupied_icu"
            );

            this.datacollection = {
                labels: dates,
                datasets: [
                    {
                        label: "Occupied Ward",
                        backgroundColor: "#81B29A",
                        borderColor: "#81B29A",
                        fill: false,
                        data: ward_beds
                    },
                    {
                        label: "Occupied Isolation",
                        backgroundColor: "#467599",
                        borderColor: "#467599 ",
                        fill: false,
                        data: iso_beds
                    },
                    {
                        label: "Occupied ICU",
                        backgroundColor: "#ffb700",
                        borderColor: "#ffb700",
                        fill: false,
                        data: icu_beds
                    }
                ]
            };
        },

        setInitialDateFrom() {
            let d = new Date();
            let sevenDaysAgo = d.setDate(d.getDate() - 7);
            this.dateFrom = new Date(sevenDaysAgo);
        },

        mapHistoriesByOccupiedBed(isChecked, bedType) {
            // console.log("mapActivitiesByOccupiedBed");
            let beds;
            if (isChecked) {
                beds = this.singleHistoryPerDay.map(h => h[bedType]).reverse();
                return beds;
            }

            beds = this.histories.map(h => h[bedType]).reverse();
            return beds;
        },

        mapHistoriesByDate(isChecked) {
            // console.log("mapActivitiesByDate");
            let dates;
            if (isChecked) {
                dates = this.singleHistoryPerDay
                    .map(h => h.created_at)
                    .reverse();
                return dates;
            }

            dates = this.histories.map(h => h.created_at).reverse();
            return dates;
        },

        /**
         * Code for setting the singleHistoryPerDay - filters the Histories arr of obj and
         * return only the most latest update in a day
         */

        // split the date and time from the histories array of object
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
        resolveLatestByDateAndTime(data) {
            // console.log("resolveLatestByDateAndTime");
            // Create an array of unique date
            const unique = [...new Set(data.map(item => item.date))];

            // loop in every unique date
            return unique.reduce((acc, curr) => {
                // Group the data per date in every loop
                const groupByDate = data.filter(d => d.date === curr);
                // console.log(groupByDate);
                /**
                 * First loop will return e.g.
                 *  [
                 *    { date: "01-01-2021", ...},
                 *    { date: "01-01-2021", ... },
                 *    { date: "01-01-2021", ... },
                 * ]
                 */

                //reduce the group of date and only return the latest
                const highestInGroup = this.findHighestInGroup(groupByDate);

                return [...acc, highestInGroup];
            }, []);
        },

        setSingleHistoryPerDay(histo) {
            const mappedHistories = this.mapHistories(histo);
            return this.resolveLatestByDateAndTime(mappedHistories);
        }
    }
};
</script>

<style lang="css" scoped></style>
