import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

import ApexCharts from 'vue3-apexcharts'

createInertiaApp({
    title: (title) => `${title} - IGP Drarekstanie`,
    
    resolve: (name) => {
        // C'est cette ligne qui permet ta structure flexible.
        // Inertia va chercher récursivement (**) dans le dossier Pages.
        // Tu pourras avoir : Pages/Public/Welcome.vue ou Pages/Armee/Dashboard.vue
        return resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        )
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