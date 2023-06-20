import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import DefaultLayout from './Layouts/DefaultLayout.vue'
import { InertiaProgress } from '@inertiajs/progress'
import Toast from "vue-toastification"
import './tabler-init'
import VueCookies from 'vue-cookies'
import axios from 'axios'
import MobileView from "./Mixins/MobileView";

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

InertiaProgress.init()

createInertiaApp({
    resolve: (name) => {
        let page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/**/*.vue'))

        page.then((module) => {
            module.default.layout = module.default.layout || DefaultLayout;
        });

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .mixin({ methods: {route}})
            .mixin(MobileView)
            .use(plugin)
            .use(VueCookies, { expires: '1d'})
            .use(Toast, {
                transition: "Vue-Toastification__bounce",
                maxToasts: 20,
                newestOnTop: true,
                position: "top-right",
                timeout: 3000,
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: false,
                hideProgressBar: false,
                closeButton: "button",
                icon: true,
                rtl: false
            })
            .mount(el)

        document.addEventListener('inertia:start', (event) => {
            if(
                !document.querySelector('.navbar-toggler.collapsed') &&
                document.querySelector('.navbar-toggler')
            ) {
                document.querySelector('.navbar-toggler').click()
            }
        })

        // Hide preloader after app setup
        document.getElementById('preloader-custom').style.display = 'none'
    },
})
