<template>
    <Subtitle title="Estudiantes con plan de titulación por caducar" />
    <div class="col mb-4">
        <DataTable :value="students" class="w-full">
            <Column field="student" header="Estudiante" />
            <Column field="plan_approval_date" header="Fecha de aprobación del plan" />
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
        const response = await axios.get("/api/titulacion/reportes/planes-por-caducar");
        students.value = response.data;
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
});
</script>
