<template v-slot:slot-content>
    <Head title="Docentes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Datatable :data="items" :columnHeaders="columnHeaders" :globalFilters="globalFilters" :pageName="pageName" @item-deleted="handleItemDeleted" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Datatable from "@/Components/Datatable.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { ref, onMounted } from "vue";

const items = ref([]);

const pageName = "professors";
const title = "Docentes";
const columnHeaders = [
    { field: "lastname", header: "Apellidos" },
    { field: "name", header: "Nombres" },
    { field: "identification", header: "Identificación" },
];
const globalFilters = ["lastname", "name", "identification"];

const fetchItems = async () => {
    try {
        const response = await axios.get("/api/docentes");
        items.value = response.data;
    } catch (error) {
        console.error("Error fetching items:", error);
    }
};
const handleItemDeleted = (itemId) => {
    items.value = items.value.filter((item) => item.id !== itemId);
};
onMounted(fetchItems);
</script>
