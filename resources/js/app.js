import "./bootstrap";
import "../css/app.css";
import "../css/fonts.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

// To use bootstrap styles
import "bootstrap/dist/css/bootstrap.min.css";
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;
//

// To use bootstrap-icons
import { BootstrapIconsPlugin } from "bootstrap-icons-vue";

// To use PrimeVue
import PrimeVue from "primevue/config";
import { definePreset } from '@primevue/themes';
import Aura from "@primevue/themes/aura";
import ToastService from 'primevue/toastservice';

import Tooltip from "primevue/tooltip";

// To use Pinia
import { createPinia } from 'pinia';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

const appName = import.meta.env.VITE_APP_NAME || "Laravel";


const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{slate.50}',
            100: '{slate.100}',
            200: '{slate.200}',
            300: '{slate.300}',
            400: '{slate.400}',
            500: '{slate.500}',
            600: '{slate.600}',
            700: '{slate.700}',
            800: '{slate.800}',
            900: '{slate.900}',
            950: '{slate.950}'
        }
    }
});


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob("./Pages/**/*.vue")),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(BootstrapIconsPlugin)
            .use(pinia)
            .use(PrimeVue, {
                theme: {
                    preset: MyPreset,
                },
                locale: {
                    dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    dayNamesMin: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    firstDayOfWeek: 1,
                },
            })
            .use(ToastService)
            .directive("tooltip", Tooltip)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
