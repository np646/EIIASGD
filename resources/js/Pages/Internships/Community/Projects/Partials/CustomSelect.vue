<template>
    <select v-model="boundValue" @change="handleChange" class="w-full p-2 border rounded">
        <option v-for="period in periods" :key="period.id" :value="period.id">
            {{ period.period }}
        </option>
    </select>
</template>

<script setup>
import { ref, computed, watch } from "vue";

const props = defineProps({
    modelValue: [Number, String, null],
    periods: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(["update:modelValue"]);

const boundValue = computed({
    get() {
        return props.modelValue ?? "";
    },
    set(newValue) {
        emit("update:modelValue", newValue);
    },
});

const handleChange = (event) => {
    emit("update:modelValue", event.target.value);
};
</script>

<style scoped>
/* Styles to make normal select look like PrimeVue's select component */
/* Which doesn't work with the dynamic role/select creation */
.styled-select {
    appearance: none;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 0.375rem 0.75rem;
    line-height: 1.5;
    color: var(--text-color);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    width: 100%;
    height: 42px;
}

.styled-select::after {
    content: "▼";
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    border-color: var(--main-color);
}

.styled-select:focus {
    border-color: var(--main-color);
    outline: none;
    box-shadow: none;
}

.styled-select:hover {
    border-color: rgb(201, 220, 239);
}

.styled-select:disabled {
    background-color: #e9ecef;
    cursor: not-allowed;
}

select {
  -ms-overflow-style: none;
  scrollbar-width: none; 
}

select::-webkit-scrollbar {
  display: none; 
}

</style>
