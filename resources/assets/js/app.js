import Vue from 'vue'
import App from './App.vue'
import router from './router'
import * as VueGoogleMaps from "vue2-google-maps"

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyBsbSxAxZPmHhw61bvth8J0fhHGDxCSZQM",
    libraries: "places,directions" // necessary for places input
  }
});

const app = new Vue({
    el: '#root',
    components: { App },
    template: '<app></app>',
    router
})
