<template v-slot:slot-content>
    <Head title="Permisos" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Table :data="permissionsRef" :columnHeaders="columnHeaders" :pageName="pageName" @remove-id="updateArray" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import Table from "@/Components/Table.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { ref } from "vue";

const title = "Permisos";

const { permissions: initialPermissions } = usePage().props;
const permissionsRef = ref([...initialPermissions]);
const pageName = "permissions";
const columnHeaders = [{ field: "name", header: "Permiso" }];

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    permissionsRef.value = permissionsRef.value.filter((permission) => permission.id !== removeId);
};
</script>
