<template>
<Chart type="pie" :data="doughnutData1" :options="doughnutOptions1" class="w-full" />
</template>

<script setup>
import Chart from "primevue/chart";
import { ref } from "vue";


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
                    documentStyle.getPropertyValue("--p-yellow-400"),
                    documentStyle.getPropertyValue("--p-orange-500"),
                    documentStyle.getPropertyValue("--p-pink-500"),
                ],
                hoverBackgroundColor: [
                    documentStyle.getPropertyValue("--p-yellow-300"),
                    documentStyle.getPropertyValue("--p-orange-400"),
                    documentStyle.getPropertyValue("--p-pink-400"),
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

doughnutData1.value = setdoughnutData1();
doughnutOptions1.value = setdoughnutOptions1();
</script>