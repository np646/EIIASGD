<template>
    <Select :options="options" v-model="selectedOption" :optionLabel="label" :placeholder="placeholder" />
</template>

<script setup>
import Select from "primevue/select";
import { ref, watch, computed } from "vue";

const props = defineProps({
    options: Object,
    label: String,
    placeholder: String,
    modelValue: [String, Number, Object],
});

const emit = defineEmits(["update:modelValue"]);
const selectedOption = ref(props.modelValue);

const selectedOptionIndex = computed(() => {
    if (!selectedOption.value) return -1;
    return props.options.findIndex((option) => {
        if (typeof selectedOption.value === "object") {
            return option.id === selectedOption.value.id;
        } else {
            return option.value === selectedOption.value;
        }
    });
});

watch(selectedOption, () => {
    console.log(selectedOptionIndex.value);
    emit("update:modelValue", selectedOptionIndex.value);
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
