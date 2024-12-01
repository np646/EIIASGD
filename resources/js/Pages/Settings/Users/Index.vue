<template>
    <MenuLayout>
        <Title :title="title" />
        <BreadcrumbTitle />
        <ContentContainer>
            <CreateUserModal v-model="showCreateModal" @item-created="handleItemCreated" />
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
import { ref, onMounted } from "vue";
import axios from "axios";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import CreateUserModal from "./CreateUserModal.vue";
import SettingsDatatable from "../Partials/SettingsDatatable.vue";
import BreadcrumbTitle from "@/Components/BreadcrumbTitle.vue";

const title = "Usuarios";
const items = ref([]);
const pageName = "users";
const showCreateModal = ref(false);

const columnHeaders = [
    { field: "name", header: "Usuario" },
    { field: "email", header: "Correo" },
];
const globalFilters = ["name", "email"];

const fetchItems = async () => {
    try {
        const response = await axios.get("/api/users");
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
