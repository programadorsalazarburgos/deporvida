
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vue from 'vue';
import Vuetify from 'vuetify';
import roles_permisos from './components/Notification.vue';
import reportegeneral from './components/Notification.vue';

// Vue.component('notification', require('./components/Notification.vue'));

Vue.use(Vuetify)


Vue.use(VueRouter);
// const Foo = require('./components/Notification.vue')
const router = new VueRouter({
mode: 'history',
routes: [
    {
        path: '/usuarios/roles_permisos', 
        component: roles_permisos,
        name: 'home'
    },

    {path: '/usuarios/reportegeneral',          component: reportegeneral,           name: 'reportegeneral'},

    
]

});


const app = new Vue({
    el: '#app',
    router,

    data: {
        notifications: ''
    },

    created(){
        axios.post('/notification/get').then(response => {
            this.notifications = response.data;
            console.log(response.data);
        });
        
    },
    mounted(){

        window.Echo.private('App.User.1')
            .notification( (notification) => {
                console.log('test'); //====> Never logs
                console.log(notification); //====> Never logs
            });
    }
});
export default app;
