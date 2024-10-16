<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <div class="pb-3 pt-2 pl-3">
                <div class="row">
                    <div class="col-9">
                        <TotalGraduatesChart />
                    </div>
                    <div class="col h-[15rem] d-flex flex-column justify-content-center">
                        <div class="h-ful">
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-5">Estudiantes</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-2">3050</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-user text-blue-600" style="font-size: 300%"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-5">Graduados</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-2">1450</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-graduation-cap text-blue-600" style="font-size: 300%"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ContentContainer>
        <ContentContainer>
            <div class="pl-5 pt-3">
                <span class="font-semibold fs-5">Graduados por periodo académico</span>
            </div>
            <div class="d-flex justify-content-around items-center p-3" style="height: 400px">
                <div class="w-50">
                    <div>
                        <div class="col">
                            <div class="flex items-center gap-4 mb-4 pl-4">
                                <Select
                                    class="w-100"
                                    id="inputSelectPeriodo"
                                    :options="period"
                                    optionLabel="period"
                                    :placeholder="`Seleccione uno`"
                                    v-model="selectedOption"
                                />
                            </div>
                        </div>
                        <div class="col">
                            <DataTable :value="graduates" class="w-full">
                                <Column field="course" header="Carrera" />
                                <Column field="female" header="Mujeres" />
                                <Column field="male" header="Hombres" />
                                <Column field="total" header="Total" />
                            </DataTable>
                        </div>
                    </div>
                </div>

                <div class="d-flex h-full w-50 justify-content-center text-center items-center">
                    <SexChart />
                </div>
            </div>

            <div class="pl-5 pt-3">
                <span class="font-semibold fs-5">Graduados por tipo de titulación</span>
            </div>

            <div class="pb-3 pt-2 pl-5 pr-5">
                <div class="row h-[15rem]">
                    <div class="col d-flex flex-column justify-content-center">
                        <div class="h-ful">
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-6">Examen complexivo</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-3">3050</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-book text-blue-600" style="font-size: 200%"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <div class="h-ful">
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-6">Proyecto de investigación</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-3">3050</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-paperclip text-blue-600" style="font-size: 200%"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <GraduationTypeChart />
                    </div>
                </div>
            </div>

            <div class="pl-5 pt-3 pb-3">
                <span class="font-semibold fs-5">Graduados por línea de investigación</span>
            </div>
            <div class="pb-3 pt-2 pl-5 pr-5">
                <div class="row h-[15rem]">
                    <div class="col-3 h-full">
                        <div class="d-flex justify-content-center text-center items-center">
                            <ThesisAreaChart />
                        </div>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <div class="h-ful">
                            <div class="row mb-3 p-3">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-6">Software</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-3">3050</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-desktop text-blue-600" style="font-size: 200%"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <div class="h-ful">
                            <div class="row mb-3 p-3">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-6">IoT</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-3">3050</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-microchip text-blue-600" style="font-size: 200%"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <div class="h-ful">
                            <div class="row mb-3 p-3">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-6">Auditoría informática</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-3">3050</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-file-check text-blue-600" style="font-size: 200%"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Select from "@/Components/Select.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref, watch } from "vue";
import TotalGraduatesChart from "./Partials/TotalGraduatesChart.vue";
import SexChart from "./Partials/SexChart.vue";
import GraduationTypeChart from "./Partials/GraduationTypeChart.vue";
import ThesisAreaChart from "./Partials/ThesisAreaChart.vue";

const title = "Reportes estadísticos";

// Period select
const period = ref([
    { id: 0, period: "SEPTIEMBRE 2024 - FEBRERO 2025" },
    { id: 1, period: "MARZO 2025 - JULIO 2025" },
]);

const selectedOption = ref(null);

// Watch for changes in selectedOption value
watch(selectedOption, () => {
    console.log(selectedOption.value);
});

const graduates = ref([
    { id: 0, course: "INGENIERÍA EN SISTEMAS", female: "50", male: "50", total: "100" },
    { id: 1, course: "TECNOLOGÍAS DE LA INFORMACIÓN", female: "50", male: "50", total: "100" },
    { id: 1, course: "INGENIERÍA DE SOFTWARE", female: "50", male: "50", total: "100" },
]);
</script>
