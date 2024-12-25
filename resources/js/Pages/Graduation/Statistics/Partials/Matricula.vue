<template>
    <Subtitle title="Estudiantes en segunda o tercera matrícula" />
    <div class="col mb-4">
        <DataTable :value="students" class="w-full">
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
import Subtitle from "@/Components/Subtitle.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

const students = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await axios.get(route("api.graduation.registrationTimes"));
        students.value = response.data;
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
});

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
</script>
