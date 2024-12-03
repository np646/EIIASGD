<template>
    <Subtitle title="Graduados por fechas" />
    <div class="d-flex justify-content-center items-center p-3 mb-3">
        <div class="w-50">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center">
                    <FloatLabel variant="on">
                        <DatePicker v-model="startDate" inputId="inputDesde" showIcon iconDisplay="input" />
                        <label for="inputDesde">Desde</label>
                    </FloatLabel>
                </div>
            </div>
        </div>
        <div class="w-50">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center">
                    <FloatLabel variant="on">
                        <DatePicker v-model="endDate" inputId="inputHasta" showIcon iconDisplay="input" />
                        <label for="inputHasta">Hasta</label>
                    </FloatLabel>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <DataTable
            :value="graduates"
            tableStyle="min-width: 50rem"
            stripedRows
            ref="dt"
            removableSort
            v-model:filters="filters"
            dataKey="id"
            :globalFilterFields="globalFilters"
            paginator
            :rows="5"
            paginatorTemplate="RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
            currentPageReportTemplate="{first} - {last} de {totalRecords}"
        >
            <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable></Column>
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref } from "vue";
import DatePicker from "primevue/datepicker";
import FloatLabel from 'primevue/floatlabel';
import { FilterMatchMode } from "@primevue/core/api";
import Subtitle from "@/Components/Subtitle.vue";

const graduates = ref([
    { id: 0, course: "INGENIERÍA EN SISTEMAS", female: "50", male: "50", total: "100" },
    { id: 1, course: "TECNOLOGÍAS DE LA INFORMACIÓN", female: "50", male: "50", total: "100" },
    { id: 1, course: "INGENIERÍA DE SOFTWARE", female: "50", male: "50", total: "100" },
]);
const columnHeaders = [
    { field: "course", header: "Apellidos" },
    { field: "female", header: "Nombres" },
    { field: "male", header: "Identificación" },
];
const globalFilters = ["course", "female", "male"];
const startDate = ref(null);
const endDate = ref(null);
const filters = ref();
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};
initFilters();
</script>
