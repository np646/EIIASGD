<template>
    <div class="px-5 pt-4">
        <div class="flex flex-col gap-4 justify-center h-full mb-3">
            <DataTable :value="props.processes" class="w-full">
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

const props = defineProps({
    professor: Object,
    period: Object,
    students: Object,
    status: Object,
    processes: Object,
});

</script>
