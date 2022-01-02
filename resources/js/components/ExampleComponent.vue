<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                        <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data: function() {
        return {
            options: {
                chart: {
                    id: 'vuechart-example'
                },
                xaxis: {
                    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                }
            },
            series: [{
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            }]
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
    }
</script>
