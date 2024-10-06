<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
        <Table :data="academicPeriodsRef" :columnHeaders="columnHeaders" :pageName="pageName" @remove-id="updateArray"/>
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

const title = "Periodos académicos";

const {  academicPeriods: initialAcademicPeriods } = usePage().props;
const  academicPeriodsRef = ref([...initialAcademicPeriods]);
const pageName = "academicPeriods";
const columnHeaders = [
    { field: "period", header: "Periodo" },
    { field: "year", header: "Año" },
]

// Function to update the data array after a deletion is performed inside the datatable component
const updateArray = (removeId) => {
    academicPeriodsRef.value =  academicPeriodsRef.value.filter(( academicPeriod) =>  academicPeriod.id !== removeId);
};
</script>

