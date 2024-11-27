<template v-slot:slot-content>
<hr>
<h4>
    Por docente
</h4>
    <DataTable
        :value="professors"
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
        <Column :exportable="false" header="Detalles" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Link :href="generateRoute(slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-search-plus" severity="success" outlined rounded />
                </Link>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
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

const columnHeaders = [
    { field: "professor", header: "Docente" },
    { field: "advisor_count", header: "Asesorías totales" },
    { field: "reader_count", header: "Lectorías totales" },
    { field: "advisor_not_graduated_count", header: "Asesorados no graduados" },
    { field: "reader_not_graduated_count", header: "Lectorías no graduados" },
];
const globalFilters = ["student", "graduation_date", "advisor", "reader1", "reader2"];

const generateRoute = (id = null) => {
    if (id) {
        return route(`graduation.processesByProfessor`, id);
    }
    return route(`students.profile`);
};


import axios from 'axios'

const professors = ref([])
const loading = ref(true)

const fetchData = async () => {
    try {
        const response = await axios.get(route('graduation.getReviewersByProfessors'))
        professors.value = response.data.professors
        loading.value = false
    } catch (error) {
        console.error('Error fetching professors:', error)
        loading.value = false
    }
}

onMounted(() => {
    fetchData()
})
</script>
