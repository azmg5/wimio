<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{title}}
        </div>
        <div class="panel-body">
            <form class="form" @submit.prevent="save">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Courrier Name</label>
                            <p>{{form.courier}}</p>
                        </div>
                        <div class="form-group">
                            <label>Started At</label>
                            <p>{{form.startedAt}}</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Driver</label>
                            <p>{{form.driverName}}</p>
                        </div>
                        <div class="form-group">
                            <label>Delivery Date</label>
                            <p>{{form.deliveryDate}}</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Description</label>
                            <p>{{form.description}}</p>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select v-model="form.status" class="form-control">
                              <option>pending</option>
                              <option>completed</option>
                              <option>failed</option>
                            </select>
                            <small class="text-danger" v-if="errors.address">{{errors.status[0]}}</small>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success">Save / Update</button>
            </form>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'TasksForm',
        data() {
            return {
                form: {},
                errors: {},
                option: {},
                title: 'Create',
                initialize: '/api/tasks/create',
                redirect: '/',
                store: '/api/tasks',
                method: 'post'
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Edit Task'
                this.initialize = '/api/tasks/' + this.$route.params.id + '/edit'
                this.store = '/api/tasks/' + this.$route.params.id
                this.method = 'put'
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
                        Vue.set(vm.$data, 'option', response.data.option)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            save() {
                var vm = this
                axios[this.method](this.store, this.form)
                    .then(function(response) {
                        if(response.data.saved) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        Vue.set(vm.$data, 'errors', error.response.data)
                    })
            }
        }
    }
</script>
