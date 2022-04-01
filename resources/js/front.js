require('./bootstrap');
window.Vue = require('vue');
import App from './views/App';
import Home from './pages/Home';
import Search from './pages/Search';
import Restaurant from './pages/Restaurant.vue';
import VueRouter from 'vue-router';
import Vue from 'vue';
Vue.use(VueRouter);
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
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});