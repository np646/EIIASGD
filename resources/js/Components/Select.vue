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
    if (!selectedOption.value) return null;

    if (typeof selectedOption.value === "object") {
        return selectedOption.value.id;
    } else {
        const found = props.options.find((option) => option.value === selectedOption.value);
        return found ? found.id : null;
    }
});

watch(selectedOption, () => {
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
