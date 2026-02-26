import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

import ApexCharts from 'vue3-apexcharts'

import GuestLayout from './Layouts/GuestLayout.vue'

createInertiaApp({
    title: () => 'Portail numérique unifié',

    resolve: async (name) => {
        let page = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        )

        if (typeof page.default.layout === 'undefined') {
            if (name.startsWith('Public/')) {
                page.default.layout = GuestLayout
            } else {
                page.default.layout = AppLayout
            }
        }

        return page
    },

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ApexCharts)
            .mount(el)
    },

    progress: {
        color: '#4f46e5', 
        showSpinner: true,
    },
})