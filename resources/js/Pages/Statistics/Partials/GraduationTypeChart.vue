<template>
    <Chart type="bar" :data="barData" :options="barOptions" class="h-full" />
</template>

<script setup>
import Chart from "primevue/chart";
import { ref } from "vue";


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


barData.value = setbarData();
barOptions.value = setbarOptions();
</script>
