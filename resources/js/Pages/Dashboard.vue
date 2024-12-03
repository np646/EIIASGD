<template>
    <Head title="Inicio" />
    <MenuLayout>
        <ContentContainer>
            <div class="px-4 py-2">
                <span class="font-semibold fs-3 mb-4"
                    >Bienvenido, <span style="color: darkblue">{{ user.name }}<br /></span
                ></span>
                <span class="fs-6 mb-4">Sistema de gestión documental de la Escuela de Informática e Inteligencia Artificial de la PUCE-I<br /></span>
            </div>
        </ContentContainer>
        <ContentContainer>
            <div class="px-4 py-2">
                <span class="font-semibold fs-5"> <i style="color: darkblue" class="pi pi-calendar-clock"></i> {{ formattedDate }}</span>
            </div>
        </ContentContainer>

        <ContentContainer>
            <div class="py-2 pl-3">
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
                                        <span class="fw-bold fs-3" style="color: var(--celeste)">{{ totalStudents }}</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-user" style="font-size: 300%; color: var(--main-color)"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row mb-2">
                                        <span class="fs-5">Graduados</span>
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-3" style="color: var(--celeste)">{{ totalGraduated }}</span>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="pi pi-graduation-cap" style="font-size: 300%; color: var(--main-color)"></i>
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
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import "primeicons/primeicons.css";
const user = usePage().props.auth.user;

const totalStudents = usePage().props.students.original;
const totalGraduated = usePage().props.graduated.original;
const graduatedPerYear = usePage().props.graduatedPerYear.original;
console.log(usePage().props.graduatedPerYear.original);
const formattedDate = computed(() => {
    const today = new Date();
    const options = { weekday: "long", day: "numeric", month: "long", year: "numeric" };
    const dateString = today.toLocaleDateString("es-ES", options);
    return `Hoy es ${dateString}`;
});

import Chart from "primevue/chart";
import { ref } from "vue";
const lineData = ref();
const lineOptions = ref();

const labels = graduatedPerYear.map((item) => item.year);
const data = graduatedPerYear.map((item) => item.total_graduated);

const setlineData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: labels,
        datasets: [
            {
                label: "Graduados",
                data: data,
                fill: false,
                borderColor: documentStyle.getPropertyValue("--celeste"),
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
