import VueRoute from 'vue-router'


import tag_setup from './components/Setup/tag_setup'

import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'

const routes = [
    { name: 'tag_setup', path: '/tag_setup', component: tag_setup },
]


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'))

Vue.use(VueRoute);

const router = new VueRoute({
    routes,
    mode: 'history'

});

export default router