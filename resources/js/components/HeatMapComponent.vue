<template>
    <div class="">
        <div class="row ">
            <div class="col-md-12 form-group">
                <vue-google-heatmap :map-type="maptype" :initial-zoom="19" :points="points" :key="lat" :lat="lat" :lng="lng" :height="350" />
            </div>
        </div>
    </div>
</template>

<script>
import { instance } from "../app";

export default {
    props : ['period'],
    data: function() {
        return {
            maptype:'satellite',
            lat : 0,
            lng : 0,
            points: []

        }
    },
    async mounted() {
        console.log('Component mounted.')


        let heatMapData = await this.getHeatedMap()
        console.log(heatMapData)
        this.lat = heatMapData[0].lat
        this.lng = heatMapData[0].lng
        this.points = heatMapData;

    },
    methods: {


        async getHeatedMap() {
            try {
                const response = await instance.get('/match/1/getHeatMapData',{params:{period:this.$props.period}});
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
