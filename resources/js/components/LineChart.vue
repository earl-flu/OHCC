<script>
import { Line, mixins } from "vue-chartjs";
import ChartDataLabels from "chartjs-plugin-datalabels";
const { reactiveProp } = mixins;

export default {
    extends: Line,
    mixins: [reactiveProp],
    props: ["options"],
    mounted() {
        this.addPlugin(ChartDataLabels);
        // Add margin below the line chart Legend
        this.addPlugin({
            beforeInit: function(chart, options) {
                chart.legend.afterFit = function() {
                    this.height = this.height + 15;
                };
            }
        });
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, this.options);
    }
};
</script>
