
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import ElementUI from 'element-ui';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(ElementUI);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
Vue.axios.defaults.baseURL = Laravel.apiUrl;

import util from './lib/util';
import marked from 'marked';
import localforage from 'localforage';
Vue.prototype.util = util;
Vue.prototype.marked = marked;
Vue.prototype.localforage = localforage;

import App from './App.vue';
import HomeIndex from './components/pager/home/index.vue';
import UserIndex from './components/pager/user/index.vue';

const routes = [
    {
        path: '/',
        component: HomeIndex,
        name: '',
        iconCls: 'fa fa-home',
        leaf: true,
    },
    {
        path: '/user',
        component: UserIndex,
        name: '',
        iconCls: 'fa fa-home',
        leaf: true,
    }
];

const router = new VueRouter({
    history: true,
    root: 'dashboard',
    routes
});

const app = new Vue({
    el: '#app',
    template: '<App/>',
    router,
    components: { App }
}).$mount('#app');