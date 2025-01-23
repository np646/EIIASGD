<template v-slot:slot-content>
    <Head title="Periodos académicos" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <CreatePeriodModal v-model="showCreateModal" @item-created="updateTable" />
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
import SettingsDatatable from '../Partials/SettingsDatatable.vue';
import CreatePeriodModal from './CreatePeriodModal.vue';
import axios from "axios";
import { ref, onMounted } from "vue";


const title = "Periodos académicos";

const items = ref([]);
const pageName = "academicPeriods";
const showCreateModal = ref(false);

const columnHeaders = [
    { field: "period", header: "Periodo académico" },
    { field: "year", header: "Año" },
];
const globalFilters = ["period", "year"];

const fetchItems = async () => {
    try {
        const response = await axios.get(route("api.academicPeriods.index"));
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
