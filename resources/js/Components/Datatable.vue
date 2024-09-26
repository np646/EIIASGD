<template v-slot:slot-content>
    <DataTable
        :value="data"
        tableStyle="min-width: 50rem"
        stripedRows
        showGridlines
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
        <template #header>
            <div class="flex justify-between">
                <div style="text-align: left">
                    <!-- TODO: Change to export as excel file -->
                    <Button icon="pi pi-external-link" label="Exportar" @click="exportCSV($event)" />
                </div>
                <IconField>
                    <InputIcon>
                        <i class="pi pi-search" />
                    </InputIcon>
                    <InputText v-model="filters['global'].value" placeholder="Buscar" />
                </IconField>
            </div>
        </template>
        <template #empty> No se han encontrado los datos. </template>

        <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable></Column>

        <Column :exportable="false" style="min-width: 12rem" header="Editar">
            <template #body="slotProps">
                <Link :href="route('students.edit', slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-pencil" outlined severity="info" rounded />
                </Link>
            </template>
        </Column>
        <Column :exportable="false" style="min-width: 12rem" header="Eliminar">
            <template #body="slotProps">
                <!-- TODO: get delete (updating status) working -->
                <Button class="mr-2" icon="pi pi-trash" outlined rounded severity="danger" @click="confirmDeleteProduct(slotProps.data.id)" />
            </template>
        </Column>
        <Column :exportable="false" style="min-width: 12rem" header="Ver perfil">
            <template #body="slotProps">
                <Link :href="route('students.edit', slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-search-plus" outlined severity="secondary" rounded />
                </Link>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { Link} from "@inertiajs/vue3";
import { ref } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import { FilterMatchMode } from "@primevue/core/api";
import "primeicons/primeicons.css";

const filters = ref();
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};

const props = defineProps({
    columnHeaders: Array,
    globalFilters: Array,
    data: Object,
});

// To export as CSV
const dt = ref();
const exportCSV = () => {
    dt.value.exportCSV();
};
initFilters();
</script>
