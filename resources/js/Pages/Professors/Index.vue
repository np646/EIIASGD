<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <Datatable
            :data="professorsRef"
            :columnHeaders="columnHeaders"
            :globalFilters="globalFilters"
            :pageName="pageName"
            @remove-id="updateArray"
            :perfil="perfil"
        />
    </MenuLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Datatable from "@/Components/Datatable.vue";
import Title from "@/Components/Title.vue";
import { ref } from "vue";

const { professors: initialProfessors } = usePage().props;
const professorsRef = ref([...initialProfessors]);

const pageName = "professors";
const title = "Docentes";
const perfil = true;
const columnHeaders = [
    { field: "lastname", header: "Apellidos" },
    { field: "name", header: "Nombres" },
    { field: "email", header: "Email" },
];
const globalFilters = ["lastname", "name", "email"];

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    professorsRef.value = professorsRef.value.filter((professor) => professor.id !== removeId);
};
</script>
