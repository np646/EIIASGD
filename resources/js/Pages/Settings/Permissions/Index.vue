<template v-slot:slot-content>
    <Head title="Permisos" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <CreatePermissionModal v-model="showCreateModal" @item-created="handleItemCreated" />
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
import CreatePermissionModal from './CreatePermissionModal.vue';
import axios from "axios";
import { ref, onMounted } from "vue";

const title = "Permisos";

const items = ref([]);
const pageName = "permisos";
const showCreateModal = ref(false);

const columnHeaders = [
    { field: "name", header: "Permiso" },
];
const globalFilters = ["name"];

const fetchItems = async () => {
    try {
        const response = await axios.get("/api/permisos");
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
