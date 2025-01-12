<template v-slot:slot-content>
    <Head title="Proyectos de vinculación" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <CreateCourseModal v-model="showCreateModal" @item-created="handleItemCreated" />
            <ProjectsDatatable
                :data="items"
                :columnHeaders="columnHeaders"
                :pageName="pageName"
                @item-deleted="handleItemDeleted"
                @item-updated="handleItemUpdated"
                @open-create-modal="showCreateModal = true"
                :globalFilters="globalFilters"
            />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import ProjectsDatatable from "./Partials/ProjectsDatatable.vue";
import CreateCourseModal from "./Partials/CreateProjectModal.vue";
import axios from "axios";
import { ref, onMounted } from "vue";

const title = "Proyectos de vinculación";

const items = ref([]);
const pageName = "community.projects";
const showCreateModal = ref(false);

const columnHeaders = [
    { field: "name", header: "Nombre" },
    { field: "academic_period_name", header: "Periodo académico" },
];
const globalFilters = ["name", "academic_period_name"];

const fetchItems = async () => {
    try {
        const response = await axios.get(route("api.community.projects.index"));
        items.value = response.data;
        console.log(items);
    } catch (error) {
        console.error("Error fetching items:", error);
    }
};

const handleItemCreated = async (newItem) => {
    await fetchItems();
};

const handleItemDeleted = (itemId) => {
    items.value = items.value.filter((item) => item.id !== itemId);
};

const handleItemUpdated = async (updatedItem) => {
    await fetchItems();
};

onMounted(fetchItems);
</script>
