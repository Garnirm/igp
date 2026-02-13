import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

import ApexCharts from 'vue3-apexcharts'

createInertiaApp({
    title: (title) => `${title} - Gifrane ERP`,

    resolve: async (name) => {
        let page = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        )

        if (typeof page.default.layout === 'undefined') {
            if (name.startsWith('Guest/')) {
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