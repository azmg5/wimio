import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        // {path: '/', component: require('./views/customer/index.vue')},
        // {path: '/customer/create', component: require('./views/customer/form.vue')},
        // {path: '/customer/:id/edit', component: require('./views/customer/form.vue'), meta: {mode: 'edit'}},
        // {path: '/customer/:id', component: require('./views/customer/show.vue')},
        //
        // {path: '/invoice', component: require('./views/invoice/index.vue')},
        // {path: '/invoice/create', component: require('./views/invoice/form.vue')},
        // {path: '/invoice/:id/edit', component: require('./views/invoice/form.vue'), meta: {mode: 'edit'}},
        // {path: '/invoice/:id', component: require('./views/invoice/show.vue')},

        {path: '/', component: require('./views/tasks/index.vue')},
        {path: '/tasks/create', component: require('./views/tasks/form.vue')},
        {path: '/tasks/:id/edit', component: require('./views/tasks/form.vue'), meta: {mode: 'edit'}},
        {path: '/tasks/:id/map', component: require('./views/tasks/deliverypath.vue'), meta: {mode: 'path'}},
        {path: '/tasks/:id', component: require('./views/tasks/show.vue')},
    ]
})

export default router
