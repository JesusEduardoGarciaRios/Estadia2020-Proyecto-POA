/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// Imports para usar validaciones en modales
import Vue from 'vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('tablero', require('./components/Tablero.vue').default);
Vue.component('datos-basicos', require('./components/DatosBasicos.vue').default);
Vue.component('datos-especificos', require('./components/DatosEspecificos.vue').default);
Vue.component('calend-seguimtos', require('./components/CalendSeguimtos.vue').default);
Vue.component('recursos-requeridos', require('./components/RecursosRequeridos.vue').default);
Vue.component('partidas-presupuestales', require('./components/PartidasPresupuestales.vue').default);
Vue.component('poa-completo', require('./components/POACompleto.vue').default);
Vue.component('usuarios', require('./components/Usuarios.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});
