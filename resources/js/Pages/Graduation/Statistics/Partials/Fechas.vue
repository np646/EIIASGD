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
            <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable></Column>
        </DataTable>

        {{ startDate }}
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref, watch, computed } from "vue";
import DatePicker from "primevue/datepicker";
import FloatLabel from "primevue/floatlabel";
import { FilterMatchMode } from "@primevue/core/api";
import Subtitle from "@/Components/Subtitle.vue";
import axios from "axios";

const startDate = ref(null);
const endDate = ref(null);
const students = ref([]);
const loading = ref(false);

const formatedStartDate = computed(() => startDate.value?.toISOString().split("T")[0] || "");
const formatedEndDate = computed(() => endDate.value?.toISOString().split("T")[0] || "");

const fetchStudents = async () => {
    if (!formatedStartDate.value || !formatedEndDate.value) {
        students.value = [];
        return;
    }

    loading.value = true;
    try {
        const response = await axios.get(`/api/graduation/statistics/graduates-by-date/${formatedStartDate.value}/${formatedEndDate.value}`);
        students.value = response.data;
        console.log("Fetched students:", response.data);
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
};

watch([formatedStartDate, formatedEndDate], fetchStudents);
const columnHeaders = [
    { field: "student", header: "Estudiante" },
    { field: "graduation_date", header: "Fecha de graduación" },
];
const globalFilters = ["student", "graduation_date"];
const filters = ref();
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};
initFilters();
</script>
