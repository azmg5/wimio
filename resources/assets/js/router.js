import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {path: '/', component: require('./views/tasks/index.vue')},
        {path: '/tasks/create', component: require('./views/tasks/form.vue')},
        {path: '/tasks/:id/edit', component: require('./views/tasks/form.vue'), meta: {mode: 'edit'}},
        {path: '/tasks/:id/map', component: require('./views/tasks/deliverypath.vue'), meta: {mode: 'path'}},
        {path: '/tasks/:id', component: require('./views/tasks/show.vue')},
    ]
})

export default router
