import 'vue-loaders/dist/vue-loaders.css';
import VueLoaders from 'vue-loaders';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { HasError } from 'vform/src/components/bootstrap5'
  

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

Vue.component('steps-component', require('./components/StepsComponent.vue').default);
Vue.component('book-content-component', require('./components/BookContentComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component(HasError.name, HasError);
Vue.use(VueLoaders);
Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
});
