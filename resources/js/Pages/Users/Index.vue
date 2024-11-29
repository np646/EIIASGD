<template>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <CreateUserModal v-model="showCreateModal" @user-created="handleUserCreated" />

            <NewTable
                :data="users"
                :columnHeaders="columnHeaders"
                :pageName="pageName"
                @user-deleted="handleUserDeleted"
                @user-updated="handleUserUpdated"
                @open-create-modal="showCreateModal = true"
            />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import NewTable from "@/Components/NewTable.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import CreateUserModal from "./CreateUserModal.vue";

const title = "Usuarios";
const users = ref([]);
const pageName = "users";
const showCreateModal = ref(false);

const columnHeaders = [
    { field: "name", header: "Usuario" },
    { field: "email", header: "Correo" },
];

const fetchUsers = async () => {
    try {
        const response = await axios.get("/api/users");
        users.value = response.data;
    } catch (error) {
        console.error("Error fetching users:", error);
    }
};

const handleUserCreated = (newUser) => {
    users.value.push(newUser);
    showCreateModal.value = false;
};

const handleUserDeleted = (userId) => {
    users.value = users.value.filter((user) => user.id !== userId);
};

const handleUserUpdated = (updatedUser) => {
    const index = users.value.findIndex((user) => user.id === updatedUser.id);
    if (index !== -1) {
        users.value[index] = updatedUser;
    }
};

onMounted(fetchUsers);
</script>
