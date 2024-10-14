<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <div class="pb-3 pt-2 pl-3">
                <div class="row">
                    <div class="col-9">
                        <Chart type="line" :data="lineData" :options="lineOptions" class="h-[15rem]" />
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
                    <Chart type="pie" :data="doughnutData" :options="doughnutOptions" class="w-75" />
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
                        <Chart type="bar" :data="barData" :options="barOptions" class="h-full" />
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
                            <Chart type="pie" :data="doughnutData1" :options="doughnutOptions1" class="w-full" />
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
import Chart from "primevue/chart";
import Select from "@/Components/Select.vue";

import DataTable from "primevue/datatable";
import Column from "primevue/column";

import { ref, watch, onMounted } from "vue";

const title = "Reportes estadísticos";

// Line chart

// onMounted(() => {
// lineData.value = setlineData();
// lineOptions.value = setlineOptions();

// doughnutData.value = setdoughnutData();
// doughnutOptions.value = setdoughnutOptions();

// doughnutData1.value = setdoughnutData1();
// doughnutOptions1.value = setdoughnutOptions1();

// barData.value = setbarData();
// barOptions.value = setbarOptions();
// });

const lineData = ref();
const lineOptions = ref();

const setlineData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021", "2022", "2023", "2024"],
        datasets: [
            {
                label: "Graduados",
                data: [65, 65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55, 40, 45],
                fill: false,
                borderColor: documentStyle.getPropertyValue("--p-cyan-500"),
                tension: 0.4,
            },
        ],
    };
};
const setlineOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue("--p-text-color");
    const textColorSecondary = documentStyle.getPropertyValue("--p-text-muted-color");
    const surfaceBorder = documentStyle.getPropertyValue("--p-content-border-color");

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.6,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                },
            },
            y: {
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                },
            },
        },
    };
};

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

// Tipo de titulación chart

const doughnutData = ref();
const doughnutOptions = ref(null);

const setdoughnutData = () => {
    const documentStyle = getComputedStyle(document.body);

    return {
        labels: ["Hombres", "Mujeres"],
        datasets: [
            {
                data: [540, 325],
                backgroundColor: [documentStyle.getPropertyValue("--p-teal-400"), documentStyle.getPropertyValue("--p-pink-400")],
                hoverBackgroundColor: [documentStyle.getPropertyValue("--p-cyan-400"), documentStyle.getPropertyValue("--p-orange-400")],
            },
        ],
    };
};

const setdoughnutOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue("--p-text-color");

    return {
        plugins: {
            legend: {
                labels: {
                    cutout: "60%",
                    color: textColor,
                },
            },
        },
    };
};
// Línea de investigación chart

const doughnutData1 = ref();
const doughnutOptions1 = ref(null);

const setdoughnutData1 = () => {
    const documentStyle = getComputedStyle(document.body);

    return {
        labels: ["Software", "IoT", "Auditoría informática"],
        datasets: [
            {
                data: [320, 260, 150],
                backgroundColor: [
                    documentStyle.getPropertyValue("--p-cyan-500"),
                    documentStyle.getPropertyValue("--p-orange-500"),
                    documentStyle.getPropertyValue("--p-gray-500"),
                ],
                hoverBackgroundColor: [
                    documentStyle.getPropertyValue("--p-cyan-400"),
                    documentStyle.getPropertyValue("--p-orange-400"),
                    documentStyle.getPropertyValue("--p-gray-400"),
                ],
            },
        ],
    };
};

const setdoughnutOptions1 = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue("--p-text-color");

    return {
        plugins: {
            legend: {
                labels: {
                    cutout: "60%",
                    color: textColor,
                },
            },
        },
    };
};

// Gender table

const graduates = ref([
    { id: 0, course: "INGENIERÍA EN SISTEMAS", female: "50", male: "50", total: "100" },
    { id: 1, course: "TECNOLOGÍAS DE LA INFORMACIÓN", female: "50", male: "50", total: "100" },
    { id: 1, course: "INGENIERÍA DE SOFTWARE", female: "50", male: "50", total: "100" },
]);

// Gender chart

const barData = ref();
const barOptions = ref();

const setbarData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ["EXAMEN COMPLEXIVO", "PROYECTO DE TITULACIÓN"],
        datasets: [
            {
                backgroundColor: documentStyle.getPropertyValue("--p-cyan-500"),
                borderColor: documentStyle.getPropertyValue("--p-cyan-500"),
                data: [65, 59],
            },
        ],
    };
};
const setbarOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue("--p-text-color");
    const textColorSecondary = documentStyle.getPropertyValue("--p-text-muted-color");
    const surfaceBorder = documentStyle.getPropertyValue("--p-content-border-color");

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.8,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary,
                    font: {
                        weight: 500,
                    },
                },
                grid: {
                    display: false,
                    drawBorder: false,
                },
            },
            y: {
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                    drawBorder: false,
                },
            },
        },
    };
};

//to avoid sidebar from opening on page load using onMount
lineData.value = setlineData();
lineOptions.value = setlineOptions();

doughnutData.value = setdoughnutData();
doughnutOptions.value = setdoughnutOptions();

doughnutData1.value = setdoughnutData1();
doughnutOptions1.value = setdoughnutOptions1();

barData.value = setbarData();
barOptions.value = setbarOptions();
</script>
