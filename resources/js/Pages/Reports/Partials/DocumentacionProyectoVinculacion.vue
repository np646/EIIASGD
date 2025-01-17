<template>
    <div class="py-3 d-flex justify-content-center">
        <div class="col text-center">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <span class="fw-bold fs-6 mb-2">Seleccione el periodo académico</span>
                <Select v-model="selectedPeriod" :options="periods" optionLabel="period" class="w-auto" />
            </div>
        </div>
    </div>
    <div class="p-3 d-flex justify-content-start">
        <span class="fw-medium fs-6">Reporte generado el {{ currentDate }} a las {{ currentTime }}</span>
    </div>
    <div class="col mb-4">
        <DataTable :value="students" class="w-full" stripedRows paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]">
            <template #header>
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <Button icon="pi pi-file-excel" @click="exportExcel()" />
                </div>
            </template>
            <Column field="name" header="Nombre del proyecto" />
            <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header">
                <template #body="slotProps">
                    <i :class="isNull(slotProps.data[column.field])" :style="getColor(slotProps.data[column.field])"></i>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref, watch, onMounted } from "vue";
import axios from "axios";
import Select from "primevue/select";
import { usePage } from "@inertiajs/vue3";
import { useGetDate } from "@/Composables/useGetDate";
import { useGetTime } from "@/Composables/useGetTime";
import Button from "primevue/button";
import useExportExcel from "@/Composables/useExportExcel";

const currentDate = ref("");
const currentTime = ref("");

const students = ref([]);
const loading = ref(true);

const periods = ref(usePage().props.periods);
const selectedPeriod = ref(null);

const fetchStudents = async () => {
    if (!selectedPeriod.value) {
        students.value = [];
        return;
    }

    loading.value = true;
    try {
        const response = await axios.get(route("api.community.project.sentDocumentation", { id: selectedPeriod.value }));
        students.value = response.data;
        console.log("Fetched students:", response.data);
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
};

const columnHeaders = [{ field: "project_report_is_null", header: "Informe del proyecto" }];
const isNull = (value) => {
    switch (value) {
        case false:
            return "pi pi-times";
        case true:
            return "pi pi-check";
    }
};

const getColor = (value) => {
    switch (value) {
        case false:
            return "color: red";
        case true:
            return "color: green";
    }
};


onMounted(() => {
    currentDate.value = useGetDate();
    currentTime.value = useGetTime();
});

watch([selectedPeriod], fetchStudents);
watch(selectedPeriod, () => {
    currentTime.value = useGetTime();
});

const columnMapping = {
    name: "Nombre del proyecto",
    project_report_is_null: "Informe del proyecto",
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
