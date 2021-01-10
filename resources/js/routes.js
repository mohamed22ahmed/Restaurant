import VueRoute from 'vue-router'


import clients from './components/clients'
import expenses from './components/expenses'
import monthly_sub from './components/monthly_sub'

import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'

const routes = [
    { name: 'clients', path: '/clients', component: clients },
    { name: 'expenses', path: '/expenses', component: expenses },
    { name: 'monthly_sub', path: '/monthly_sub', component: monthly_sub },
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