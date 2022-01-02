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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

                        <apexchart type="bar" :options="chartOptions2" :series="series"></apexchart>
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
                    id: 'vuechart-example22'
                },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        '2011-01-01', '2011-02-01', '2011-03-01', '2011-04-01', '2011-05-01', '2011-06-01',
                        '2011-07-01', '2011-08-01', '2011-09-01', '2011-10-01', '2011-11-01', '2011-12-01',
                        '2012-01-01', '2012-02-01', '2012-03-01', '2012-04-01', '2012-05-01', '2012-06-01',
                        '2012-07-01', '2012-08-01', '2012-09-01', '2012-10-01', '2012-11-01', '2012-12-01',
                        '2013-01-01', '2013-02-01', '2013-03-01', '2013-04-01', '2013-05-01', '2013-06-01',
                        '2013-07-01', '2013-08-01', '2013-09-01'
                    ],
                    labels: {
                        rotate: -90
                    }
                }
            },chartOptions2: {

                dataLabels: {
                    enabled: false
                },
                width: "100%",
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                height: 380,
                chart: {
                    id: 'vuechart-example223'
                },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        '2011-01-01', '2011-02-01', '2011-03-01', '2011-04-01', '2011-05-01', '2011-06-01',
                        '2011-07-01', '2011-08-01', '2011-09-01', '2011-10-01', '2011-11-01', '2011-12-01',
                        '2012-01-01', '2012-02-01', '2012-03-01', '2012-04-01', '2012-05-01', '2012-06-01',
                        '2012-07-01', '2012-08-01', '2012-09-01', '2012-10-01', '2012-11-01', '2012-12-01',
                        '2013-01-01', '2013-02-01', '2013-03-01', '2013-04-01', '2013-05-01', '2013-06-01',
                        '2013-07-01', '2013-08-01', '2013-09-01'
                    ],

                }
            },
            series: [{
                // name: 'Cash Flow',
                // data: [1.45, 5.42, 5.9, -0.42, -12.6, -18.1, -18.2, -14.16, -11.1, -6.09, 0.34, 3.88, 13.07,
                //     5.8, 2, 7.37, 8.1, 13.57, 15.75, 17.1, 19.8, -27.03, -54.4, -47.2, -43.3, -18.6, -
                //         48.6, -41.1, -39.6, -37.6, -29.4, -21.4, -2.4
                // ]
            }],
        }
    },
    async mounted() {
        console.log('Component mounted.')
        let resp = await this.getDistanceInterval()
        this.updateChart(resp)
    },
    methods: {
        updateChart(matchStats) {
            // In the same way, update the series
            //let a = Object.values(matchStats)
            //console.log(a);
            this.chartOptions = {
                xaxis: {

                    categories: Object.keys(matchStats)
                }
            }
            this.chartOptions2 = {
                xaxis: {

                    categories: Object.keys(matchStats)
                }
            }
            this.series = [{
                name:'stats',
                data: Object.values(matchStats)
            },{
                name: 'Net Profit',
                data: [44]
            }, {
                name: 'Revenue',
                data: [76]
            }, {
                name: 'Free Cash Flow',
                data: [35]
            }]
        },
        async getDistanceInterval() {
            try {
                const response = await instance.get('dashboard/distanceInterval');
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
