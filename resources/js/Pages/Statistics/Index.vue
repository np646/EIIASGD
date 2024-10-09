<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <div class="mb-10">
                <Chart type="line" :data="lineData" :options="lineOptions" class="h-[20rem]" />
            </div>

            <div class="d-flex justify-content-center mb-10">
                <div class="row">
                    <label for="inputSelectPeriodo" class="col-form-label text-center">Periodo</label>
                    <div class="row">
                        <Select
                            class="w-100"
                            id="inputSelectPeriodo"
                            :options="period"
                            :optionLabel="label"
                            :placeholder="placeholder"
                            v-model="selectedOption"
                        />
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center text-center items-center mb-10">
                <div class="col">
                    Tipo de titulación
                    <div class="d-flex justify-content-center text-center items-center">
                        <Chart type="doughnut" :data="doughnutData" :options="doughnutOptions" class="w-50" />
                    </div>
                </div>

                <div class="col">
                    Línea de investigación
                    <div class="d-flex justify-content-center text-center items-center">
                        <Chart type="doughnut" :data="doughnutData1" :options="doughnutOptions1" class="w-50" />
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-around text-center items-center" style="height: 400px">
                <div class="w-50">
                    <DataTable :value="graduates" class="w-full">
                        <Column field="course" header="Carrera" />
                        <Column field="female" header="Mujeres" />
                        <Column field="male" header="Hombres" />
                        <Column field="total" header="Total" />
                    </DataTable>
                </div>

                <div class="d-flex h-full justify-content-center w-50">
                    <Chart type="bar" :data="barData" :options="barOptions" class="w-full" />
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

const title = "test2";

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
                labels: {
                    color: textColor,
                },
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
const label = "period";
const placeholder = "Seleccione uno";

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
        labels: ["Trabajo de investigación", "Examen complexivo", "C"],
        datasets: [
            {
                data: [540, 325, 702],
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
]);

// Gender chart

const barData = ref();
const barOptions = ref();

const setbarData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ["INGENIERÍA EN SISTEMAS", "TECNOLOGÍAS DE LA INFORMACIÓN", "INGENIERÍA DE SOFTWARE"],
        datasets: [
            {
                label: "Mujeres",
                backgroundColor: documentStyle.getPropertyValue("--p-cyan-500"),
                borderColor: documentStyle.getPropertyValue("--p-cyan-500"),
                data: [65, 59, 80],
            },
            {
                label: "Hombres",
                backgroundColor: documentStyle.getPropertyValue("--p-gray-500"),
                borderColor: documentStyle.getPropertyValue("--p-gray-500"),
                data: [28, 48, 40],
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
                labels: {
                    color: textColor,
                },
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
