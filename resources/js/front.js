require('./bootstrap');
window.Vue = require('vue');
import App from './views/App';
import Vue from 'vue';
import Home from './pages/Home';
import Search from './pages/Search';
import Checkout from './pages/Checkout';
import Restaurant from './pages/Restaurant.vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

require('velocity-animate');

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/search',
            name: 'search',
            component: Search
        },
        {
            path: '/restaurant/:id',
            name: 'restaurant',
            props: true,
            component: Restaurant
        },
        {
            path: '/checkout',
            name: 'checkout',
            props: true,
            component: Checkout
        },
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});