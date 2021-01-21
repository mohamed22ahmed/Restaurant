import Vue from 'vue'
import Vuex from 'vuex'
import vuexI18n from 'vuex-i18n'
import router from './routes'
import storeData from './store/store.js'
import vSelect from 'vue-select'
import FlashMessage from '@smartweb/vue-flash-message';


import VueHtmlToPaper from 'vue-html-to-paper';
const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
}
Vue.use(VueHtmlToPaper, options);


Vue.use(FlashMessage);
require('./bootstrap');

window.Vue = require('vue');
Vue.use(Vuex);


const store = new Vuex.Store(storeData);

Vue.use(vuexI18n.plugin, store);
const translationsDe = {
    "My nice title": "Ein schöner Titel",
    "content": "Dies ist ein toller Inhalt"
};


Vue.i18n.set(default_locale_lang);


window.Fire = new Vue();


import swal from 'sweetalert2'
window.swal = swal


import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

Vue.component('v-select', vSelect)


const app = new Vue({
    el: '#app',
    store,
    router
});
