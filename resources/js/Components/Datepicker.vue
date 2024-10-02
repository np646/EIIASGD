<template>
    <DatePicker v-model="date" dateFormat="dd/mm/yy" />
</template>

<script setup>
import DatePicker from "primevue/datepicker";
import { ref, watch } from "vue";

const date = ref();

const emit = defineEmits(["update:date"]);
watch(date, (newOption) => {
    emit("update:date", newOption);
});
</script>

<style>
:root {
    --general: #00356b;
    --p-datepicker-dropdown-focus-ring-color: #00356b;
    --p-datepicker-date-selected-background: #00356b;
    --p-datepicker-date-focus-ring-color: #00356b;
}

.p-datepicker-input:focus-within {
    border-color: var(--general) !important;
}
.p-datepicker-day-selected  {
    background-color: var(--general) !important;
}
</style>
