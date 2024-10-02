<template>
    <MenuLayout>
        holaaa

        <Select :options="cities" :optionLabel="label" :placeholder="placeholder" v-model="selectedOption" />
        {{ selectedCityName }}

        <Datepicker v-model="selectedDate" />
        testing date {{ selectedDate }}!!
    </MenuLayout>
</template>

<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Select from "@/Components/Select.vue";
import { ref, computed } from "vue";
import Datepicker from "@/Components/Datepicker.vue";

const cities = ref([
    { name: "New York", code: "NY" },
    { name: "Rome", code: "RM" },
    { name: "London", code: "LDN" },
    { name: "Istanbul", code: "IST" },
    { name: "Paris", code: "PRS" },
]);

const selectedOption = ref(null);
const label = "name";
const placeholder = "Select a City";
const selectedCityName = computed(() => {
    return selectedOption.value ? selectedOption.value.name : null;
});

const selectedDate = ref(null);
</script>
