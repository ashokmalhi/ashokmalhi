/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

// import VueGoogleMap from 'vuejs-google-maps'
// import 'vuejs-google-maps/dist/vuejs-google-maps.css'
//
//
// Vue.use(VueGoogleMap, {
//     load: {
//         apiKey: 'AIzaSyAVJiRDZsecoVecl0fiq2xHchQdWihXr3k',
//         libraries: 'visualization'
//     }
// })

import VueGoogleHeatmap from 'vue-google-heatmap';

Vue.use(VueGoogleHeatmap, {
    apiKey: 'AIzaSyAVJiRDZsecoVecl0fiq2xHchQdWihXr3k'
});

import axios from 'axios'

export const instance = axios.create({
    baseURL: 'http://afl.local/player',
    timeout: 80000,
    headers: {
         'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    withCredentials: true,
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('player-min-interval-component', require('./components/PlayerMinuteIntervalComponent').default);
Vue.component('heatmap-component', require('./components/HeatMapComponent').default);
Vue.component('intensity-component', require('./components/PlayerIntensityStatComponent').default);
Vue.component('player-all-stats-component', require('./components/PlayerAllStatsComponent').default);





/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
