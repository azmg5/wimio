<template>

  <div id="app">
    <h2>{{title}}</h2>
    <label>From Location: </label> {{form.fromLat}} , {{form.fromLng}}
    <label>To Location: </label> {{form.toLat}} , {{form.toLng}}
    <google-map />
  </div>
</template>

<script>

import Vue from 'vue'
import axios from 'axios'
import GoogleMap from "../../components/GoogleMap"

export default {
  name: "App",
  data() {
      return {
          form: {},
          errors: {},
          option: {},
          title: 'Delivery Path',
          initialize: '/api/tasks/map',
          redirect: '/',
          store: '/api/tasks',
          method: 'post'
      }
  },
  components: {
    GoogleMap
  },
  created: function(){

  },
  beforeMount() {
    if(this.$route.meta.mode === 'path') {
        this.title = 'Delivery Path'
        this.initialize = '/api/tasks/' + this.$route.params.id + '/map'
        this.method = 'get'
    }
      this.fetchData()
  },
  watch: {
      '$route': 'fetchData'
  },
  methods: {
      fetchData() {
          var vm = this
          axios.get(this.initialize)
              .then(function(response) {
                  Vue.set(vm.$data, 'form', response.data.form)
              })
              .catch(function(error) {
                  console.log(error)
              })
      }
  }
};
</script>
