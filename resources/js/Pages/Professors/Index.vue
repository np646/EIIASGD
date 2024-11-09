<template v-slot:slot-content>
        <Head title="Docentes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Datatable
                :data="professorsRef"
                :columnHeaders="columnHeaders"
                :globalFilters="globalFilters"
                :pageName="pageName"
                @remove-id="updateArray"
                :perfil="perfil"
            />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Datatable from "@/Components/Datatable.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { ref } from "vue";

const { professors: initialProfessors } = usePage().props;
const professorsRef = ref([...initialProfessors]);

const pageName = "professors";
const title = "Docentes";
const perfil = true;
const columnHeaders = [
    { field: "lastname", header: "Apellidos" },
    { field: "name", header: "Nombres" },
    { field: "identification", header: "Identificación" },
];
const globalFilters = ["lastname", "name", "identification"];

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    professorsRef.value = professorsRef.value.filter((professor) => professor.id !== removeId);
};

console.log(professorsRef);
</script>
