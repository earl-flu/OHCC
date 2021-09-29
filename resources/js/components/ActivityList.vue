<template>
    <div>
        <div class="">
            <datepicker
                input-class="border"
                placeholder="Date From"
                :full-month-name="true"
                :clear-button="true"
                v-model="dateFrom"
            ></datepicker>
            <datepicker
                input-class="border"
                placeholder="To"
                :full-month-name="true"
                :clear-button="true"
                v-model="dateTo"
            ></datepicker>
            <button @click="setActivities(dateFrom, dateTo)">
                Filter Date
            </button>
        </div>

        <line-chart
            :chart-data="datacollection"
            :options="options"
        ></line-chart>
        <input
            type="checkbox"
            id="checkbox"
            v-model="checked"
            @change="fillData()"
        />
        <label for="checkbox">Last update per day</label> |

        <!-- <button @click="getDateOnly()">Console Date</button> -->
    </div>
</template>

<script>
import ActivityService from "../../js/services/ActivityService.js";
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
            activities: [],
            singleActivityPerDay: [],
            datacollection: {},
            options: {
                plugins: {
                    datalabels: {
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
                            size: 10,
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
        this.setActivities(this.dateFrom, this.dateTo);
    },

    methods: {
        setActivities(dateFrom, dateTo) {
            //bago ipasa dapat converted yung dateObj into yyyy/mm/dd
            const startDate = dateFrom.toISOString().split("T")[0];
            const endDate = dateTo.toISOString().split("T")[0];

            ActivityService.getActivities(startDate, endDate)
                .then(res => {
                    //set activities data
                    this.activities = res.data.data;

                    //set singleActivityPerDay data
                    const activities = this.activities;
                    this.singleActivityPerDay = this.setSingleActivityPerDay(
                        activities
                    );
                    //fill the data for chart
                    this.fillData();
                })
                .catch(err => {
                    console.log("There was an error:", err);
                });
        },
        fillData() {
            const dates = this.mapActivitiesByDate(this.checked);
            const ward_beds = this.mapActivitiesByOccupiedBed(
                this.checked,
                "occupied_ward"
            );
            const iso_beds = this.mapActivitiesByOccupiedBed(
                this.checked,
                "occupied_isolation"
            );
            const icu_beds = this.mapActivitiesByOccupiedBed(
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
                        backgroundColor: "#AF5D63",
                        borderColor: "#AF5D63",
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

        mapActivitiesByOccupiedBed(isChecked, bedType) {
            let beds;
            if (isChecked) {
                beds = this.singleActivityPerDay
                    .map(a => a.attributes[bedType])
                    .reverse();
                return beds;
            }

            beds = this.activities.map(a => a.attributes[bedType]).reverse();
            return beds;
        },

        mapActivitiesByDate(isChecked) {
            let dates;
            if (isChecked) {
                dates = this.singleActivityPerDay
                    .map(a => a.created_at)
                    .reverse();
                return dates;
            }

            dates = this.activities.map(a => a.created_at).reverse();
            return dates;
        },

        /**
         * Code for setting the singleActivityPerDay - filters the Activities arr of obj and
         * return only the most latest update in a day
         */

        // split the date and time from the activities array of object
        mapActivities(arr) {
            return arr.map(item => {
                const [date, time] = item.created_at.split(" ");
                return { ...item, date, time };
            });
        },

        findHighestInGroup(data) {
            console.log(data, "findHighestInGroup");
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
            // Create an array of unique date
            const unique = [...new Set(data.map(item => item.date))];

            // loop in every unique date
            return unique.reduce((acc, curr) => {
                // Group the data per date in every loop
                const groupByDate = data.filter(d => d.date === curr);
                console.log(groupByDate);
                /**
                 * First loop will return e.g.
                 *  [
                 *    { name: "01-01-2021", ...},
                 *    { name: "01-01-2021", ... },
                 *    { name: "01-01-2021", ... },
                 * ]
                 */

                //reduce the group of date and only return the latest
                const highestInGroup = this.findHighestInGroup(groupByDate);

                return [...acc, highestInGroup];
            }, []);
        },
        setSingleActivityPerDay(actis) {
            const mappedActivities = this.mapActivities(actis);
            return this.resolveLatestByDateAndTime(mappedActivities);
        }
    }
};
</script>

<style lang="css" scoped></style>
