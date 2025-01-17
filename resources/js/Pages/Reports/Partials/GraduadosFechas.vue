<template>
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
    <div class="p-3 d-flex justify-content-start">
        <span class="fw-medium fs-6">Reporte generado el {{ currentDate }} a las {{ currentTime }}</span>
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
            <template #header>
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <Button icon="pi pi-file-excel" @click="exportExcel()" />
                </div>
            </template>
            <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable></Column>
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref, watch, computed, onMounted } from "vue";
import DatePicker from "primevue/datepicker";
import FloatLabel from "primevue/floatlabel";
import { FilterMatchMode } from "@primevue/core/api";
import axios from "axios";
import Button from "primevue/button";
import useExportExcel from "@/Composables/useExportExcel";
import { useGetDate } from "@/Composables/useGetDate";
import { useGetTime } from "@/Composables/useGetTime";

const currentDate = ref("");
const currentTime = ref("");

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
        const response = await axios.get(route("api.graduation.graduatesByDate", { start: formatedStartDate.value, end: formatedEndDate.value }));
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

onMounted(() => {
    currentDate.value = useGetDate();
    currentTime.value = useGetTime();
});

const columnMapping = {
    student: "Estudiante",
    graduation_date: "Fecha de graduación",
};

const exportExcel = () => {
    useExportExcel(students.value, columnMapping);
};
</script>
<style>
:root {
    --p-datatable-row-striped-background: var(--softer-border-color);
}
</style>
