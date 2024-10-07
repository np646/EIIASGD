<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Table :data="thesisAreasRef" :columnHeaders="columnHeaders" :pageName="pageName" @remove-id="updateArray" />
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

const title = "Areas de titulación";

const { thesisAreas: initialThesisAreas } = usePage().props;
const thesisAreasRef = ref([...initialThesisAreas]);
const pageName = "thesisAreas";
const columnHeaders = [
    { field: "area", header: "Área" },
];

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    thesisAreasRef.value = thesisAreasRef.value.filter((thesisArea) => thesisArea.id !== removeId);
};
</script>
