/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es'

Vue.use(ElementUI,{locale});
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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sidebar-component', require('./components/Layout/Sidebar.vue').default);
Vue.component('topbar-component', require('./components/Layout/topMenu.vue').default);
Vue.component('usersindex-component', require('./components/Users/index.vue').default);
Vue.component('userscreate-component', require('./components/Users/create.vue').default);
Vue.component('patientsindex-component', require('./components/Patients/index.vue').default);
Vue.component('patientscreate-component', require('./components/Patients/create.vue').default);
Vue.component('diagnosepatient-component', require('./components/Patients/diagnoseindex.vue').default);
Vue.component('diagnoseindex-component', require('./components/Diagnoses/index.vue').default);
Vue.component('diagnosecreate-component', require('./components/Diagnoses/create.vue').default);
Vue.component('areaindex-component', require('./components/Areas/index.vue').default);
Vue.component('areacreate-component', require('./components/Areas/create.vue').default);
Vue.component('dashboard-component', require('./components/DashBoard/index.vue').default);
Vue.component('cardinfo-component', require('./components/DashBoard/cardinf.vue').default);
Vue.component('schedulecreate-component', require('./components/Schedule/create.vue').default);
Vue.component('scheduleindex-component', require('./components/Schedule/index.vue').default);
Vue.component('scheduleusers-component', require('./components/Schedule/users.vue').default);
Vue.component('scheduleuser-component', require('./components/Users/schedule.vue').default);
Vue.component('inventaryindex-component', require('./components/Inventary/index.vue').default);
Vue.component('inventarycreate-component', require('./components/Inventary/create.vue').default);
Vue.component('inventaryshort-component', require('./components/Inventary/indexshort.vue').default);
Vue.component('cirugyindex-component', require('./components/cirugy/index.vue').default);
Vue.component('cirugycreate-component', require('./components/cirugy/create.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
