<template>
    <DatePicker v-model="date" format="yy/mm/dd" showIcon iconDisplay="input" fluid />
</template>

<script setup>
import DatePicker from "primevue/datepicker";
import { ref, watch } from "vue";

const props = defineProps({
    modelValue: [String, Number, Object],
});

const date = ref(props.modelValue);
const emit = defineEmits(["update:modelValue"]);
watch(date, (newDate) => {
    if (newDate instanceof Date) {
        const year = newDate.getFullYear();
        const month = String(newDate.getMonth() + 1).padStart(2, '0');
        const day = String(newDate.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        emit("update:modelValue", formattedDate);
    } else {
        emit("update:modelValue", null);
    }
});
</script>