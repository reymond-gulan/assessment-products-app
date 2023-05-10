/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import Vue from "vue";
import JwPagination from 'jw-vue-pagination';

Vue.component('products', require('./components/products/Index.vue').default);
Vue.component('view-product', require('./components/products/Show.vue').default);
Vue.component('jw-pagination', JwPagination);

const app = new Vue({
    el: '#app',
});
