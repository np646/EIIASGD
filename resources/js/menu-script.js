import { onMounted, ref } from 'vue';

export default {
    setup() {
        const nav2 = ref(null);
        const barraLateral = ref(null);
        const spans = ref([]);
        const main = ref(null);
        const nav = ref(null);

        onMounted(() => {
            const nav2Collapse = new bootstrap.Collapse(nav2.value, { toggle: false });

            nav.value.addEventListener("click", () => {
                if (window.innerWidth <= 600) {
                    nav2Collapse.toggle();
                } else {
                    barraLateral.value.classList.toggle("mini-barra-lateral");
                    main.value.classList.toggle("min-main");
                    spans.value.forEach((span) => {
                        span.classList.toggle("oculto");
                    });
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 600) {
                    nav2Collapse.hide();
                }
            });
        });

        return {
            nav,
            barraLateral,
            spans,
            main,
            nav2
        };
    }
};
