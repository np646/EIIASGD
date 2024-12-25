<template v-slot:slot-content>
    <Head title="Áreas de titulación" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <CreateAreaModal v-model="showCreateModal" @item-created="handleItemCreated" />
            <SettingsDatatable
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
import { Head } from '@inertiajs/vue3';
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import SettingsDatatable from '../Partials/SettingsDatatable.vue';
import CreateAreaModal from './CreateAreaModal.vue';
import axios from "axios";
import { ref, onMounted } from "vue";


const title = "Areas de titulación";
const items = ref([]);
const pageName = "thesisAreas";
const showCreateModal = ref(false);

const columnHeaders = [
    { field: "area", header: "Área" },
];
const globalFilters = ["area"];

const fetchItems = async () => {
    try {
        const response = await axios.get(route("api.thesisAreas.index"));
        items.value = response.data;
    } catch (error) {
        console.error("Error fetching items:", error);
    }
};

const handleItemCreated = (newItem) => {
    items.value.push(newItem);
    showCreateModal.value = false;
};

const handleItemDeleted = (itemId) => {
    items.value = items.value.filter((item) => item.id !== itemId);
};

const handleItemUpdated = (updatedItem) => {
    const index = items.value.findIndex((item) => item.id === updatedItem.id);
    if (index !== -1) {
        items.value[index] = updatedItem;
    }
};

onMounted(fetchItems);
</script>
