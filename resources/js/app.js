require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue');

import VueResource from 'vue-resource';
import App from './components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
// import InfiniteLoading from 'vue-infinite-loading';
  
  
// Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
// Vue.component('InfiniteLoading', require('vue-infinite-loading'));
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});