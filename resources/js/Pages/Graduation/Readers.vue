<template v-slot:slot-content>
    <Head title="Lectores" />
    <MenuLayout>
        <Title :title="`Lectores`" />
        <ContentContainer>
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
            >
                <template #header>
                    <div class="flex justify-between">
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Buscar" class="border-color" />
                        </IconField>
                    </div>
                </template>
                <template #empty> No se han encontrado los datos. </template>
                <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable></Column>
                <Column :exportable="false" header="Ver estudiante" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
                    <template #body="slotProps">
                        <Link :href="generateRoute(slotProps.data.id)">
                            <Button class="mr-2" icon="pi pi-search-plus" severity="secondary" outlined rounded />
                        </Link>
                    </template>
                </Column>
            </DataTable>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
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
const data = [
    {
        id: 1,
        student: "PEREZ SUAREZ JOSÉ EMILIO",
        professor: "DOMINGUEZ GUERRA MARÍA JOSÉ",
        period: "2021-2022",
        status: "ACTIVO",
    },
    
    {
        id: 2,
        student: "SORIA GARCIA JUAN CARLOS",
        professor: "DOMINGUEZ GUERRA MARÍA JOSÉ",
        period: "2021-2022",
        status: "ACTIVO",
    },
    {
        id: 3,
        student: "PEREZ SUAREZ JOSÉ EMILIO",
        professor: "PRADO GONZALEZ JUAN DANIEL",
        period: "2020-2021",
        status: "INACTIVO",
    },

];

const columnHeaders = [
    { field: "professor", header: "Docente" },
    { field: "student", header: "Estudiante" },
    { field: "period", header: "Período" },
    { field: "status", header: "Estado" },
];
const globalFilters = ["lastname", "name", "identification"];

const generateRoute = (id = null) => {
    if (id) {
        return route(`students.profile`, id);
    }
    return route(`students.profile`);
};

const props = defineProps({
    slotProps: Object,
});
</script>
