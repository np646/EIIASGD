<template>
    <div class="py-3">
        <div class="flex flex-col gap-4 justify-center h-full">
            <DataTable :value="processes" class="w-full" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]">
                <Column field="student_name" header="Estudiante" sortable/>
                <Column field="identification" header="Cédula" sortable/>
                <Column field="role" header="Responsabilidad" sortable/>
                <Column field="status_name" header="Estado" :sortable="true">
                    <template #body="slotProps">
                        <Tag :severity="getSeverity(slotProps.data.status)" :value="slotProps.data.status_name"> </Tag>
                    </template>
                </Column>
            </DataTable>
        </div>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

import Tag from "primevue/tag";

const processes = ref(usePage().props.processes);
const getSeverity = (status) => {
    switch (status) {
        case 1:
            return "success";
        case 2:
            return "info"; 
        case 3:
            return "danger";
        case 4:
            return "warn";
    }
};
</script>
