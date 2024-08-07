Vue.component('home', {
    props: ['user'],

    ready() {
        //
    }
});

Vue.component('contact', require('./contact.vue'));
Vue.component('contact_modal', require('./contact_modal.vue'));
Vue.component('reminder', require('./reminder.vue'));
Vue.component('reminder_modal', require('./reminder_modal.vue'));

Vue.component('import', require('./import.vue'));
Vue.component('export', require('./export.vue'));
Vue.component('search', require('./search.vue'));
