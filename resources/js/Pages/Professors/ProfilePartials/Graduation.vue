<template>
    <div class="px-5 pt-4">
        <div class="flex flex-col gap-4 justify-center h-full mb-3">
            <DataTable :value="graduationData" class="w-full">
                <Column field="student" header="Estudiante" />
                <Column field="identification" header="Cédula" />
                <Column field="role" header="Responsabilidad" />
            </DataTable>
        </div>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref } from "vue";

const props = defineProps({
    professor: Object,
    period: Object,
    students: Object,
    status: Object,
});

const graduationData = ref([
    { id: 0, student: "ESTUDIANTE 1", identification: "100123567", role: "ASESOR" },
    { id: 1, student: "ESTUDIANTE 2", identification: "100123568", role: "LECTOR" },
    { id: 1, student: "ESTUDIANTE 3", identification: "100123569", role: "LECTOR" },
]);
</script>
