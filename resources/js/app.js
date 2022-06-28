import 'vue-loaders/dist/vue-loaders.css';
import VueLoaders from 'vue-loaders';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { HasError } from 'vform/src/components/bootstrap5'
import VTooltip from 'v-tooltip'
import VueSocialSharing from 'vue-social-sharing'




require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('steps-component', require('./components/StepsComponent.vue').default);
Vue.component('book-content-component', require('./components/BookContentComponent.vue').default);
Vue.component('edit-book-content-component', require('./components/EditBookContentComponent.vue').default);
Vue.component('add-book-message-component', require('./components/AddBookMessageComponent.vue').default);
Vue.component('paypal-component', require('./components/PaypalComponent.vue').default);
Vue.component('book-reader', require('./components/BookReaderComponent.vue').default);
Vue.component('book-messages-component', require('./components/BookMessagesComponent.vue').default);
Vue.component('book-pictures-component', require('./components/BookPicturesComponent.vue').default);


Vue.component(HasError.name, HasError);
Vue.use(VueLoaders);
Vue.use(VueSweetalert2);
Vue.use(VTooltip)
Vue.use(VueSocialSharing);

const app = new Vue({
    el: '#app',
});
