<template>

<div class="pl-5 pt-3 pb-3">
                <span class="font-semibold fs-5">Documentación entregada</span>
            </div>
            <div class="col">
                <DataTable :value="graduates" class="w-full">
                    <Column field="course" header="Carrera" />
                    <Column field="female" header="Mujeres" />
                    <Column field="male" header="Hombres" />
                    <Column field="total" header="Total" />
                </DataTable>
            </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref} from "vue";
import DatePicker from "primevue/datepicker";


const graduates = ref([
{ id: 0, course: "INGENIERÍA EN SISTEMAS", female: "50", male: "50", total: "100" },
{ id: 1, course: "TECNOLOGÍAS DE LA INFORMACIÓN", female: "50", male: "50", total: "100" },
{ id: 1, course: "INGENIERÍA DE SOFTWARE", female: "50", male: "50", total: "100" },
]);
</script>
