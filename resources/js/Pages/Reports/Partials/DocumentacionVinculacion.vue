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
            <Column field="student" header="Estudiante" />
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
        const response = await axios.get(route("api.community.sentDocumentation", {id: selectedPeriod.value }));
        students.value = response.data;
        console.log("Fetched students:", response.data);
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
};

const columnHeaders = [
    { field: "student_report_is_null", header: "Informe del estudiante" },
];

const isNull = (value) => {
    switch (value) {
        case false:
            return "pi pi-check";
        case true:
            return "pi pi-times";
    }
};

const getColor = (value) => {
    switch (value) {
        case false:
            return "color: green";
        case true:
            return "color: red";
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
</script>
<style>
:root {
    --p-datatable-row-striped-background: var(--softer-border-color);
}
</style>
