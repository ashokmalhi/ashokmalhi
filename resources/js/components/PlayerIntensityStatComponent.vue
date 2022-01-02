<template>
    <div class="">
        <div class="row ">
            <div class="col-md-12">
                <apexchart type="bar" :options="chartOptions" :series="series"></apexchart>
            </div>
        </div>
    </div>
</template>

<script>
import { instance } from "../app";

export default {
    data: function() {
        return {
            chartOptions: {

                dataLabels: {
                    enabled: false
                },
                width: "100%",
                height: 380,
                chart: {
                    id: 'vuechart-example1'
                },
                xaxis: {

                },

            },
            series: [],
        }
    },
    async mounted() {
        console.log('Component mounted.')
        let resp = await this.getIntensityStat()
        this.updateChart(resp)

        //let heatMapData = await this.getHeatedMap()


    },
    methods: {
        updateChart(stats) {
            // In the same way, update the series
            //let a = Object.keys(matchStats)
            console.log(a);
            this.chartOptions = {
                xaxis: {
                    minutes: stats.label
                }
            }
            this.series = [{
                name : 'intensity',
                data: stats.value
            }]
        },
        async getIntensityStat() {
            try {
                const response = await instance.get('/match/1/intensityTimeStat');
                //this.updateChart(response.data)
                return response.data;
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        }

    }

    }
</script>
