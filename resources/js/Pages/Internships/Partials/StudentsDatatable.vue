<template v-slot:slot-content>
    <DataTable
        :value="data"
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
        :perfil="perfil"
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
        <Column field="status_name" header="Estado" :sortable="true">
            <template #body="slotProps">
                <Tag :severity="getSeverity(slotProps.data.status)" :value="slotProps.data.status_name"> </Tag>
            </template>
        </Column>
        <Column :exportable="false" header="Documentos" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Link :href="generateRoute('studentFiles', slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-search-plus" severity="secondary" outlined rounded />
                </Link>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref} from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import { FilterMatchMode } from "@primevue/core/api";
import "primeicons/primeicons.css";
import Tag from "primevue/tag";

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
    pageName: String,
    slotProps: Object,
    perfil: Boolean,
});

initFilters();

// To generate routes for student files
const generateRoute = (action, id = null) => {
    if (id) {
        return route(`${props.pageName}.${action}`, id);
    }
    return route(`${props.pageName}.${action}`);
};

const getSeverity = (status) => {
    switch (status) {
        case 1:
            return "secondary";
        case 2:
            return "success";
        case 3:
            return "danger";
        case 4:
            return "info";
    }
};

</script>
<style>
:root {
    --p-datatable-row-striped-background: var(--softer-border-color);
}
</style>