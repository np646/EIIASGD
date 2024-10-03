<template>
    <Select v-model="selectedOption" :optionLabel="label" :placeholder="placeholder"/>
</template>

<script setup>
import Select from "primevue/select";
import { ref, watch } from "vue";


const props = defineProps({
    data: Object,
    label: String,
    placeholder: String,
    modelValue: Object,
});

const emit = defineEmits(["update:modelValue"]);
const selectedOption = ref(props.modelValue);

watch(selectedOption, (newOption) => {
    emit("update:modelValue", newOption);
});
</script>

<style>
:root {
    --p-select-active-border-color: #00356b;
}

.p-select:focus-within {
    border-color: var(--p-select-active-border-color) !important;
}
</style>
