<template>
    <DatePicker v-model="date" format="yy/mm/dd" showIcon iconDisplay="input" fluid />
</template>

<script setup>
import DatePicker from "primevue/datepicker";
import { ref, watch } from "vue";

const date = ref();

const emit = defineEmits(["update:date"]);
watch(date, (newDate) => {
    if (newDate instanceof Date) {
        const year = newDate.getFullYear();
        const month = String(newDate.getMonth() + 1).padStart(2, '0');
        const day = String(newDate.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        emit("update:date", formattedDate);
    } else {
        emit("update:date", null);
    }
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
.p-datepicker-day-selected {
    background-color: var(--general) !important;
}
</style>
