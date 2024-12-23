import { computed } from "vue";
export const useGetDate = computed(() => {
  const today = new Date();
  const options = { weekday: "long", day: "numeric", month: "long", year: "numeric" };
  return today.toLocaleDateString("es-ES", options);
});
