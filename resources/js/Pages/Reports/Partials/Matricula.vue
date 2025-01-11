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
            <Column field="end_period" header="Periodo de Integración Curricular" />
            <Column field="registration_times" header="Número de matrícula">
                <template #body="slotProps">
                    <label>{{ getRegistrationTimes(slotProps.data.registration_times) }}</label>
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
        const response = await axios.get(route("api.graduation.registrationTimes", { id: selectedPeriod.value }));
        students.value = response.data;
        console.log("Fetched students:", response.data);
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
};

const getRegistrationTimes = (times) => {
    switch (times) {
        case 1:
            return "PRIMERA MATRÍCULA";
        case 2:
            return "SEGUNDA MATRÍCULA";
        case 3:
            return "TERCERA MATRÍCULA";
    }
};

onMounted(() => {
    currentDate.value = useGetDate;
    currentTime.value = useGetTime;
});
watch([selectedPeriod], fetchStudents);
</script>
<style>
:root {
    --p-datatable-row-striped-background: var(--softer-border-color);
}
</style>
