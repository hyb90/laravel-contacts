require('./bootstrap');

window.Vue = require('vue');


Vue.component('contacts', require('./components/Contacts.vue').default);

const app = new Vue({
    el: '#app',
});
