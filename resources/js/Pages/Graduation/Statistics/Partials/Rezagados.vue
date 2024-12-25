<template>
    <Subtitle title="Estudiantes con plan de titulación por caducar" />
    <div class="col mb-4">
        <DataTable :value="students" class="w-full">
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
</script>
