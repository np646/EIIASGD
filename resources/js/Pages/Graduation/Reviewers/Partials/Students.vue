<template v-slot:slot-content>
    <DataTable
        :value="graduations"
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
        class="custom-datatable p-datatable-striped"
    >
        <template #header>
            <div class="flex justify-between">
                <IconField>
                    <InputIcon>
                        <i class="pi pi-search" />
                    </InputIcon>
                    <InputText v-model="filters['global'].value" placeholder="Filtrar por estudiante" class="border-color" />
                </IconField>
            </div>
        </template>
        <template #empty> No se han encontrado los datos. </template>
        <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable></Column>
        <Column :exportable="false" header="Ver estudiante" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Link :href="generateRoute(slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-search-plus" severity="success" outlined rounded />
                </Link>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import { FilterMatchMode } from "@primevue/core/api";
import "primeicons/primeicons.css";
import Button from "primevue/button";

const filters = ref();
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};

initFilters();

const columnHeaders = [
    { field: "student", header: "Estudiante" },
    { field: "graduation_date", header: "Fecha de graduación" },
    { field: "advisor", header: "Asesor" },
    { field: "reader1", header: "Lector I" },
    { field: "reader2", header: "Lector II" },
];
const globalFilters = ["student"];

const generateRoute = (id = null) => {
    if (id) {
        return route(`graduation.graduation`, id);
    }
    return route(`students.profile`);
};

import axios from "axios";

const graduations = ref([]);
const loading = ref(true);

const fetchData = async () => {
    try {
        const response = await axios.get(route("graduation.getReviewersByStudents"));
        graduations.value = response.data.graduations;
        loading.value = false;
    } catch (error) {
        console.error("Error fetching graduations:", error);
        loading.value = false;
    }
};

onMounted(() => {
    fetchData();
});
</script>
<style>
:root {
    --p-datatable-row-striped-background: var(--softer-border-color);
}
</style>