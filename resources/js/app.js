require('./bootstrap');

import Vue from 'vue';
import {InertiaApp} from '@inertiajs/inertia-vue';
import {InertiaForm} from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import moment from 'moment'
import TextHighlight from 'vue-text-highlight';
import VCalendar from 'v-calendar';

Vue.component('text-highlight', TextHighlight);

Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VCalendar, {
    componentPrefix: 'vc'
});

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY');
    }
});

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
