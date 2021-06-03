require('./bootstrap');

window.Vue =require('vue')

import Vue from "vue";
//register component globally so that it can be used inside our Vue elem
Vue.component('app', require('./components/App').default);
Vue.component('site-body', require('./components/SiteBody').default);
Vue.component('site-footer', require('./components/SiteFooter').default);
Vue.component('site-header', require('./components/SiteHeader').default);
Vue.component('site-impressum', require('./components/SiteImpressum').default);


const axios = require('axios');
const vueaxios = require('vue-axios');

Vue.use(vueaxios, axios);

const app = new Vue({
    el: '#app',
});
