<template v-slot:slot-content>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <StudentsDatatable :data="items" :columnHeaders="columnHeaders" :globalFilters="globalFilters" :pageName="pageName" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";

import { usePage } from "@inertiajs/vue3";
import StudentsDatatable from "../Partials/StudentsDatatable.vue";

const items = usePage().props.students;
const pageName = "community";

const title = "Estudiantes";
const columnHeaders = [
    { field: "student", header: "Apellidos" },
    { field: "status_name", header: "Nombres" },
];
const globalFilters = ["lastname", "name", "identification"];
</script>
