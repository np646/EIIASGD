<template v-slot:slot-content>
    <div class="py-3 d-flex justify-content-center">
        <div class="col text-center">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <span class="fw-bold fs-6 mb-2">Seleccione el periodo académico</span>
                <Select v-model="selectedPeriod" :options="periods" optionLabel="period" class="w-auto" />
            </div>
        </div>
    </div>
    <DataTable
        :value="students"
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
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import { FilterMatchMode } from "@primevue/core/api";
import "primeicons/primeicons.css";
import Button from "primevue/button";
import Tag from "primevue/tag";
import { usePage } from "@inertiajs/vue3";
import Select from "primevue/select";
import axios from "axios";

const students = ref([]);
const periods = ref(usePage().props.periods);
const selectedPeriod = ref(null);

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
});

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
const globalFilters = ["student", "thesis_name"];

const generateRoute = (id = null) => {
    if (id) {
        return route(`graduation.process`, id);
    }
    return route(`students.profile`);
};

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

const loading = ref(true);

const fetchStudents = async () => {
    if (!selectedPeriod.value) {
        students.value = [];
        return;
    }

    loading.value = true;
    try {
        const response = await axios.get(route("api.graduation.getProcessesAsAdvisor", { professor: props.id, period: selectedPeriod.value }));
        students.value = response.data;
        console.log("Fetched students:", response.data);
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
};

watch([selectedPeriod], fetchStudents);
</script>
