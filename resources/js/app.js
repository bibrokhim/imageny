import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import VueFeather from 'vue-feather';
import vClickOutside from "click-outside-vue3"
import Layout from './Shared/LayoutDefault.vue';

createInertiaApp({
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        );
        page.then((module) => {
            module.default.layout = module.default.layout || Layout;
        });
        return page;
    },
    progress: {
        showSpinner: true,
        color: '#FFD700'
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vClickOutside)
            .component(VueFeather.name, VueFeather)
            .mixin({ methods: { route: window.route } })
            .mount(el)
    },
});
