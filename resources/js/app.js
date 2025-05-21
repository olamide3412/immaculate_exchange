import './bootstrap';
import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import Layout from './Layouts/Layout.vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import { formatDate } from './Utils/dateFormat';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { createPinia } from 'pinia';
import { useThemeStore } from './Stores/themeStore';


AOS.init({
    duration: 1000,
    once: true,
});



const pinia = createPinia();

createInertiaApp({
    title: (title) => `IME ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page =  pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
       const app = createApp({ render: () => h(App, props) });
       app.use(plugin)
          .use(ZiggyVue)
          .use(Toast)
          .use(pinia);

        const themeStore = useThemeStore();
        themeStore.loadTheme();

        app.config.globalProperties.$formatDate = formatDate;

        app.component('Head', Head)
        .component('Link', Link);

        // ✅ Dynamically import FontAwesome to split the chunk
        import('./fontawesome').then(({ FontAwesomeIcon }) => {
            app.component('font-awesome-icon', FontAwesomeIcon)
             app.mount(el);
        });

       // app.mount(el)
    },
    progress: {
        delay: 250,
        color: '#6600CC',
        includeCSS: true,
        showSpinner: false,
    },
})
