<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Table :data="usersRef" :columnHeaders="columnHeaders" :pageName="pageName" />
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

const title = "Usuarios";

const { users: initialUsers } = usePage().props;
const usersRef = ref([...initialUsers]);
const pageName = "users";
const columnHeaders = [
    { field: "name", header: "Usuario" },
    { field: "email", header: "Correo" },
];

</script>
