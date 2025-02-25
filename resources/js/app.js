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
import { definePreset } from "@primevue/themes";
import Aura from "@primevue/themes/aura";
import ToastService from "primevue/toastservice";

import Tooltip from "primevue/tooltip";

// To use Pinia
import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: "var(--primary-color-50)",
            100: "var(--primary-color-100)",
            200: "var(--primary-color-200)",
            300: "var(--primary-color-300)",
            400: "var(--primary-color-400)",
            500: "var(--primary-color-500)",
            600: "var(--primary-color-600)",
            700: "var(--primary-color-700)",
            800: "var(--primary-color-800)",
            900: "var(--primary-color-900)",
            950: "var(--primary-color-950)",
        },
    },
    components: {
        inputtext: {
            disabled: {
                color: "var(--p-inputtext-color)",
                background: "var(--p-inputtext-background)",
            },
        },
    },
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
            .mixin({
                methods: {
                    hasRole(role) {
                        return this.$page.props.auth.user.roles.includes(role);
                    }
                }
            })
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
