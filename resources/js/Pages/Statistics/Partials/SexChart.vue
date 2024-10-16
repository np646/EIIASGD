<template>
    <Chart type="pie" :data="doughnutData" :options="doughnutOptions" class="w-75" />
</template>

<script setup>
import Chart from "primevue/chart";
import { ref } from "vue";

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
                backgroundColor: [documentStyle.getPropertyValue("--p-yellow-400"), documentStyle.getPropertyValue("--p-orange-500")],
                hoverBackgroundColor: [documentStyle.getPropertyValue("--p-yellow-300"), documentStyle.getPropertyValue("--p-orange-400")],
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

doughnutData.value = setdoughnutData();
doughnutOptions.value = setdoughnutOptions();
</script>
