/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

import Swal from "sweetalert2";
window.Swal = Swal;

import Vue from 'vue';
import vSelect from 'vue-select';
Vue.component('v-select', vSelect);

Vue.use(VueRouter)

let routes = [
    { path: '/', component: require('./components/Dashboard.vue').default },
    { path: '/home', component: require('./components/Dashboard.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/customers', component: require('./components/Customers.vue').default },
    { path: '/customers/view/:id', component: require('./components/Customers-view.vue').default },
    { path: '/packages', component: require('./components/Packages.vue').default },
    { path: '/services', component: require('./components/Services.vue').default },
    { path: '/admin-panel', component: require('./components/Admin_panel.vue').default },    
    { path: '/test', component: require('./components/Test.vue').default }
]


const router = new VueRouter({
    hashbang: false,
    mode: "history",
    linkActiveClass: "active",
    routes // short for `routes: routes`
})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('user-component', require('./components/Customers.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});