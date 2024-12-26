<template>
     <div class="p-3 d-flex justify-content-start">
        <span class="fw-medium fs-6">Reporte generado el {{ currentDate }} a las {{ currentTime }}</span>
    </div>
    <div class="col mb-4">
        <DataTable :value="students" class="w-full" stripedRows paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]">
            <Column field="student" header="Estudiante" />
            <Column field="start_period" header="Periodo de inicio de titulación" />
            <Column field="plan_approval_date" header="Fecha de aprobación del plan" />
            <Column field="is_delayed" header="Plan por caducar">
            <template #body="slotProps">
                    <Tag :severity="getSeverity(slotProps.data.is_delayed)" :value="slotProps.data.is_delayed"> </Tag>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Tag from "primevue/tag";
import Subtitle from "@/Components/Subtitle.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

import { useGetDate } from "@/Composables/useGetDate";
import { useGetTime } from "@/Composables/useGetTime";

const currentDate = ref("");
const currentTime = ref("");

const students = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await axios.get(route("api.graduation.plansDueToExpire"));
        students.value = response.data;
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
});

const getSeverity = (info) => {
    switch (info) {
        case "Sí":
            return "danger";
        case "No":
            return "info";
    }
};

onMounted(() => {
    currentDate.value = useGetDate;
    currentTime.value = useGetTime;
});
</script>
<style>
:root {
    --p-datatable-row-striped-background: var(--softer-border-color);
}
</style>