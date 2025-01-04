import './bootstrap';
import '../css/app.css'

import { createApp, h } from 'vue'
import Layout from './Shared/Layout.vue'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = name.startsWith('login') ? undefined : Layout
        return page
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el)

    },

    title: title => `My App - ${title}`
})
