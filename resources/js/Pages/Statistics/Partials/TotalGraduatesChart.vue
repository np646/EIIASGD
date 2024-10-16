<template>
    <Chart type="line" :data="lineData" :options="lineOptions" class="h-[15rem]" />
</template>

<script setup>
// Line chart

import Chart from "primevue/chart";
import { ref } from "vue";
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

lineData.value = setlineData();
lineOptions.value = setlineOptions();
</script>
