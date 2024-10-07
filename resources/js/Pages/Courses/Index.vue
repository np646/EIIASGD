<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Table :data="coursesRef" :columnHeaders="columnHeaders" :pageName="pageName" @remove-id="updateArray" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import Table from "@/Components/Table.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { ref } from "vue";

const title = "Carreras";

const { courses: initialCourses } = usePage().props;
const coursesRef = ref([...initialCourses]);
const pageName = "courses";
const columnHeaders = [
    { field: "name", header: "Carrera" },
    { field: "banner_id", header: "Banner ID" },
];

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    coursesRef.value = coursesRef.value.filter((course) => course.id !== removeId);
};
</script>
