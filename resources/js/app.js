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
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* import specific icons */
import { faUserSecret, faUser,faSearch, faCircle, faFileCirclePlus, faGaugeHigh, faEye,
    faPhone, faCertificate, faXmark, faWifi, faClock, faShield, faThumbsUp, faShieldAlt,
    faCoins, faUsd, faAngleRight, faMapMarkerAlt, faEnvelope} from '@fortawesome/free-solid-svg-icons'
import {faBitcoin, faEthereum, faFacebook, faInstagram, faTwitter, faXTwitter, faWhatsapp  } from '@fortawesome/free-brands-svg-icons';
import { createPinia } from 'pinia';
import { useThemeStore } from './Stores/themeStore';
/* add icons to the library */
library.add( faUserSecret, faUser, faSearch, faCircle, faFileCirclePlus, faGaugeHigh, faEye, faPhone,
    faCertificate, faXmark, faWifi, faClock, faShield, faThumbsUp, faShieldAlt, faCoins, faBitcoin, faEthereum, faUsd,
    faFacebook, faInstagram, faTwitter, faXTwitter, faAngleRight, faMapMarkerAlt, faEnvelope, faWhatsapp );


AOS.init({
    duration: 1000,
    once: true,
});

const pinia = createPinia();

createInertiaApp({
    title: (title) => `My App ${title}`,
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
        .component('Link', Link)
        .component('font-awesome-icon', FontAwesomeIcon);

        app.mount(el)
    },
    progress: {
        delay: 250,
        color: '#6600CC',
        includeCSS: true,
        showSpinner: false,
    },
})
