<template v-slot:slot-content>
    <Head title="Estudiantes en proyecto de vinculación" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
           <ProjectFiles></ProjectFiles>
        </ContentContainer>
        <ContentContainer>
            <Subtitle title="Estudiantes en proyecto de vinculación" />
            <AddStudentToProject v-model="showAddModal" @item-added="handleItemAdded" />
            <StudentsDatatable
                :data="items"
                :columnHeaders="columnHeaders"
                :pageName="pageName"
                @item-deleted="handleItemDeleted"
                @item-updated="handleItemUpdated"
                @open-add-modal="showAddModal = true"
                :globalFilters="globalFilters"
            />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import StudentsDatatable from './Partials/StudentsDatatable.vue';
import AddStudentToProject from './Partials/AddStudentToProject.vue';
import axios from "axios";
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import ProjectFiles from './Partials/ProjectFiles.vue';
import Subtitle from '@/Components/Subtitle.vue';

const project = usePage().props.project;
const projectName = usePage().props.projectName.name;
console.log(projectName);
const title = projectName;


const items = ref([]);
const pageName = "community.projects";
const showAddModal = ref(false);

const columnHeaders = [
    { field: "student_name", header: "Nombre" },
    { field: "academic_period", header: "Periodo académico" },
];
const globalFilters = ["name", "academic_period_name"];

const fetchItems = async () => {
    try {
        const response = await axios.get(route('api.community.projects.studentsInProject', { project: project }));
                items.value = response.data;
        console.log(items)
    } catch (error) {
        console.error("Error fetching items:", error);
    }
};

const handleItemAdded = async (newItem) => {
    showAddModal.value = false;
    // Fetch fresh data instead of pushing
    await fetchItems();
};

const handleItemDeleted = async (itemId) => {
    await fetchItems();
};

const handleItemUpdated = async (updatedItem) => {
    await fetchItems();
};

onMounted(fetchItems);
</script>
