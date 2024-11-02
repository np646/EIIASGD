<template>

    <div class="pl-5 pt-3">
        <span class="font-semibold fs-5">Graduados por fechas</span>
    </div>
    <div class="d-flex justify-content-center items-center p-3">
                <div class="w-50">
                    <div class="col">
                        <div class="row"><span>Desde</span></div>
                        <div class="row"><DatePicker v-model="date" class="w-50" /></div>
                    </div>
                </div>
                <div class="w-50">
                    <div class="col">
                        <div class="row"><span>Hasta</span></div>
                        <div class="row"><DatePicker v-model="date" class="w-50" /></div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
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
