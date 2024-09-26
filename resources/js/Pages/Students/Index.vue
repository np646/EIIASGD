<template v-slot:slot-content>
    <MenuLayout>
        <div>
            <!-- <h1>Estudiantes</h1> -->
           
            <TitleButton :pageName="route('students.create')"/>
            <!-- TODO: change color scheme -->
            <Datatable :data="students" :columnHeaders="columnHeaders" :globalFilters="globalFilters" />
        </div>
    </MenuLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Datatable from "@/Components/Datatable.vue";
import TitleButton from "@/Components/TitleButton.vue";

const { students } = usePage().props;
const columnHeaders = [
    { field: "lastname", header: "Apellidos" },
    { field: "name", header: "Nombres" },
    { field: "email", header: "Email" },
];
const globalFilters = ["lastname", "name", "email"];
</script>

<style scoped>

</style>
