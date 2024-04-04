
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
import reportesesiones from './components/sesiones.vue';
Vue.use(Vuetify)
Vue.use(VueRouter);
const router = new VueRouter({
mode: 'history',
routes: [
    {
        path: '/deporvida/reportesesiones', 
        component: reportesesiones,
        name: 'home'
    },


]

});


const app = new Vue({
    el: '#app',
    router,

    data: {
        notifications: ''
    },


});
export default app;
