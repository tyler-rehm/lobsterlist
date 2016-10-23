Vue.component('home', {
    props: ['user'],

    ready() {
        //
    }
});

Vue.component('contact', require('./contact.vue'));
Vue.component('import', require('./import.vue'));
Vue.component('contact_modal', require('./contact_modal.vue'));
Vue.component('export', require('./export.vue'));
