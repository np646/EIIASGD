<template>
    <Subtitle title="Documentación entregada" />
    <div class="col mb-4">
        <DataTable :value="students" class="w-full">
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
import Subtitle from "@/Components/Subtitle.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

const students = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await axios.get(route("api.graduationFiles.sentDocummentation"));
        students.value = response.data;
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
});

const columnHeaders = [
    { field: "int_cert_is_null", header: "Certificación internacional" },
    { field: "english_cert_is_null", header: "Inglés" },
    { field: "community_cert_is_null", header: "Prácticas de vinculación" },
    { field: "prep_cert_is_null", header: "Prácticas laborales" },
    { field: "grad_type_is_null", header: "Modalidad de titulación" },
    { field: "readers_is_null", header: "Asignación de lectores" },
    { field: "plan_approval_is_null", header: "Aprobación del plan de titulación" },
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
</script>
