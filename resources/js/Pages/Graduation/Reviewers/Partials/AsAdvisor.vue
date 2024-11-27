<template v-slot:slot-content>
    <Head title="Evaluadores" />
    <MenuLayout>
        <Title :title="`Evaluadores`" />
        <ContentContainer>
            <DataTable
                :value="advisors"
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
                <Column field="status_name" header="Estado" :sortable="true">
                    <template #body="slotProps">
                        <Tag :severity="getSeverity(slotProps.data.status)" :value="slotProps.data.status_name"> </Tag>
                    </template>
                </Column>
                <Column :exportable="false" header="Ver estudiante" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
                    <template #body="slotProps">
                        <Link :href="generateRoute(slotProps.data.id)">
                            <Button class="mr-2" icon="pi pi-search-plus" severity="success" outlined rounded />
                        </Link>
                    </template>
                </Column>
            </DataTable>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
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
import Tag from "primevue/tag";

const filters = ref();
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};

initFilters();

const columnHeaders = [
    { field: "student", header: "Estudiante" },
    { field: "thesis_name", header: "Tema" },
];
const globalFilters = ["student", "graduation_date", "advisor", "reader1", "reader2"];

const generateRoute = (id = null) => {
    if (id) {
        return route(`graduation.graduation`, id);
    }
    return route(`students.profile`);
};

const props = defineProps({
    slotProps: Object,
});

const advisors = ref(usePage().props.advisors)

const getSeverity = (status) => {
    switch (status) {
        case 1:
            return "success";
        case 2:
            return "info"; 
        case 3:
            return "danger";
        case 4:
            return "warn";
    }
};
</script>
