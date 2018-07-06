<template>
  <div>
    <gmap-map
      :center="center"
      :zoom="10"
      style="width:100%;  height: 500px;"
    >
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        @click="center=m.position"
      ></gmap-marker>
    </gmap-map>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "GoogleMap",
  data() {
    return {
      // default to Dubai to keep it simple
      // change this to whatever makes sense
      center: { lat: 25.204849, lng: 55.270783 },
      markers: [],
      places: [],
      fromLat: 0,
      fromLng: 0,
      currentPlace: null,
      title: 'Delivery Path',
      initialize: '/api/tasks/map',
      method: 'post'
    };
  },

  beforeMount() {

        this.title = 'Delivery Path'
        this.initialize = '/api/tasks/' + this.$route.params.id + '/map'
        this.method = 'get'

      this.fetchData()
  },
  mounted() {
  },

  methods: {
    // receives a place object via the autocomplete component
    setPlace(place) {
      this.currentPlace = place;
    },
    addMarker() {
        const marker = {
          lat: this.fromLat,
          lng: this.fromLng
        };
        this.markers.push({ position: marker });
        // this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
    },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    },
    fetchData() {
        var vm = this
        axios.get(this.initialize)
            .then(function(response) {

                // vm.fromLat = response.data.form.fromLat
                // vm.fromLng = response.data.form.fromLng

                navigator.geolocation.getCurrentPosition(position => {
                  vm.center = {
                    lat: response.data.form.fromLat * 1,
                    lng: response.data.form.fromLng * 1
                  };
                });

                const marker = {
                  lat: response.data.form.fromLat * 1,
                  lng: response.data.form.fromLng * 1
                };
                vm.markers.push({ position: marker });
                vm.center = marker;

                const marker_to = {
                  lat: response.data.form.toLat * 1,
                  lng: response.data.form.toLng * 1
                };
                vm.markers.push({ position: marker_to });

                vm.directionsService = new google.maps.DirectionsService()
                vm.directionsDisplay = new google.maps.DirectionsRenderer()
                vm.directionsDisplay.setMap(vm.$mapObject)

                var from_point = response.data.form.fromLat + ',' + response.data.form.fromLng
                var to_point = response.data.form.toLat + ',' + response.data.form.toLng

                vm.directionsService.route({
                  origin: from_point,
                  destination: to_point,
                  travelMode: 'DRIVING'
                }, function (response, status) {
                  if (status === 'OK') {
                    vm.directionsDisplay.setDirections(response)
                  } else {
                    console.log('Directions request failed due to ' + status)
                  }
                })
            })
            .catch(function(error) {
                console.log(error)
            })
    }
  }
};
</script>
