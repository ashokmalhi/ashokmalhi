<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

                        <apexchart type="bar" :options="chartOptions" :series="series"></apexchart>
                    </div>
                </div>
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
                    id: 'vuechart-example'
                },
                xaxis: {

                }
            },
            series: [{
                name: 'min-interval',

            }],
        }
    },
    async mounted() {
        console.log('Component mounted.')
        let resp = await this.getMinByInterval()
        this.updateChart(resp)

        //let heatMapData = await this.getHeatedMap()


    },
    methods: {
        updateChart(matchStats) {
            // In the same way, update the series
            let a = Object.keys(matchStats)
            console.log(a);
            this.chartOptions = {
                xaxis: {
                    minutes: Object.keys(matchStats)
                }
            }
            this.series = [{
                data: Object.values(matchStats)
            }]
        },
        async getMinByInterval() {
            try {
                const response = await instance.get('/match/1/getMinByInterval');
                //this.updateChart(response.data)
                return response.data;
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        },
    }

    }
</script>
