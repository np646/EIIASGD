<template v-slot:slot-content>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Datatable
                :data="studentsRef"
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
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Datatable from "@/Components/Datatable.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { ref } from "vue";

const { students: initialStudents } = usePage().props;
const studentsRef = ref([...initialStudents]);

const pageName = "students";
const title = "Estudiantes";
const perfil = true;
const columnHeaders = [
    { field: "lastname", header: "Apellidos" },
    { field: "name", header: "Nombres" },
    { field: "identification", header: "Identificación" },
];
const globalFilters = ["lastname", "name", "identification"];

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    studentsRef.value = studentsRef.value.filter((student) => student.id !== removeId);
};
</script>
