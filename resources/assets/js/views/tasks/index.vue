<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title">
        <template scope="props">
            <tr>
                <td>{{props.item.courier}}</td>
                <td>{{props.item.driverName}}</td>
                <td>{{props.item.status}}</td>
                <td>{{props.item.description}}</td>
                <td>{{props.item.startedAt}}</td>
                <td>{{props.item.deliveryDate}}</td>
                <td style="max-width:70px;" ><label v-if="props.item.status == 'failed'"> {{props.item.driverComment}}</label></td>
                <td>
                  <button class="btn btn-primary btn-xs" @click="$router.push('/tasks/' + props.item.id + '/edit')" v-if="props.item.status == 'pending'">Edit</button>
                  <button class="btn btn-success btn-xs" @click="$router.push('/tasks/' + props.item.id + '/map')">Route</button>
                </td>
            </tr>
        </template>
    </data-viewer>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'

    export default {
        name: 'TasksIndex',
        data() {
            return {
                title: 'Tasks',
                source: '/api/tasks',
                create: '/tasks/create',
                thead: [
                    {title: 'Courrier', key: 'courier', sort: true},
                    {title: 'Driver Name', key: 'driverName', sort: false},
                    {title: 'Task status', key: 'status', sort: true},
                    {title: 'Task Description', key: 'description', sort: true},
                    {title: 'Start Date', key: 'startedAt', sort: true},
                    {title: 'Delivery Date', key: 'deliveryDate', sort: true},
                    {title: 'Driver Comment', key: 'driverComment', sort: true},
                ],
                filter: [
                    'id', 'courier', 'driverName', 'status',
                ]
            }
        },
        components: {
            DataViewer
        },
        methods: {
            update() {
                var vm = this
                axios.update(`api/${this.resource}/${this.$route.params.id}`)
                    .then(function(response) {
                        if(response.data.saved) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            }
        }
    }
</script>
