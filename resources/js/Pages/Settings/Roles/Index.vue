<template v-slot:slot-content>
    <Head title="Roles" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <CreateRoleModal v-model="showCreateModal" @item-created="updateTable" />
            <SettingsDatatable
                :data="items"
                :columnHeaders="columnHeaders"
                :pageName="pageName"
                @item-deleted="updateTable"
                @item-updated="updateTable"
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
import SettingsDatatable from "../Partials/SettingsDatatable.vue";
import CreateRoleModal from "./CreateRoleModal.vue";
import axios from "axios";
import { ref, onMounted } from "vue";

const title = "Roles";

const items = ref([]);
const pageName = "roles";
const showCreateModal = ref(false);

const columnHeaders = [{ field: "name", header: "Rol" }];
const globalFilters = ["name"];

const fetchItems = async () => {
    try {
        const response = await axios.get(route("api.roles.index"));
        items.value = response.data;
    } catch (error) {
        console.error("Error fetching items:", error);
    }
};

const updateTable = () => {
    fetchItems();
};
onMounted(fetchItems);
</script>
