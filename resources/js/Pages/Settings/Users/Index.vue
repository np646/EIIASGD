<template>
    <Head title="Usuarios" />
    <MenuLayout>
        <Title :title="title" />
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
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from "axios";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import CreateUserModal from "./CreateUserModal.vue";
import SettingsDatatable from "../Partials/SettingsDatatable.vue";

const title = "Usuarios";
const items = ref([]);
const pageName = "users";
const showCreateModal = ref(false);

const columnHeaders = [
    { field: "name", header: "Usuario" },
    { field: "email", header: "Correo" },
    { field: "role", header: "Roles" },
];
const globalFilters = ["name", "email"];

const fetchItems = async () => {
    try {
        const response = await axios.get(route("api.users.index"));
        items.value = response.data;
    } catch (error) {
        console.error("Error fetching items:", error);
    }
};

const handleItemCreated = (newItem) => {
   /* items.value.push(newItem);
    showCreateModal.value = false;*/
    fetchItems();
};

const handleItemDeleted = (itemId) => {
    items.value = items.value.filter((item) => item.id !== itemId);
};

const handleItemUpdated = () => {
    fetchItems();
};

onMounted(fetchItems);
</script>
