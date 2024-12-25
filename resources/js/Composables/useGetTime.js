import { computed } from "vue";
export const useGetTime = computed(() => {
    const today = new Date();
    return  today.toLocaleTimeString("es-ES", { hour: "2-digit", minute: "2-digit" });
});
