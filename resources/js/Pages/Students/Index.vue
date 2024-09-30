<template v-slot:slot-content>
    <MenuLayout>
        <div>
            <Title :title="title" />
            <Datatable :data="students" :columnHeaders="columnHeaders" :globalFilters="globalFilters" :pageName="pageName"/>
        </div>
    </MenuLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Datatable from "@/Components/Datatable.vue";
import Title from "@/Components/Title.vue";

const { students } = usePage().props;
const pageName = "students";
const title = "Estudiantes";
const columnHeaders = [
    { field: "lastname", header: "Apellidos" },
    { field: "name", header: "Nombres" },
    { field: "email", header: "Email" },
];
const globalFilters = ["lastname", "name", "email"];
</script>

<style scoped></style>
