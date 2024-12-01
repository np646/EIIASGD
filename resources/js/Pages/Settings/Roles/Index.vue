<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Table :data="rolesRef" :columnHeaders="columnHeaders" :pageName="pageName" @remove-id="updateArray" />
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

const title = "Roles";

const { roles: initialRoles } = usePage().props;
const rolesRef = ref([...initialRoles]);
const pageName = "roles";
const columnHeaders = [
    { field: "name", header: "Rol" },
];

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    rolesRef.value = rolesRef.value.filter((role) => role.id !== removeId);
};
</script>
