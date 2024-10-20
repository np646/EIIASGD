<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Accordion multiple>
                <AccordionPanel value="0">
                    <AccordionHeader>Información personal</AccordionHeader>
                    <AccordionContent>
                        <Information :student="student"></Information>
                    </AccordionContent>
                </AccordionPanel>

                <!-- TODO: Información quemada -->
                <AccordionPanel value="1">
                    <AccordionHeader>Titulación</AccordionHeader>
                    <AccordionContent>
                        <Titulacion :student="student" :period="periodo" :professors="professors" :status="status"></Titulacion>
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="2">
                    <AccordionHeader>Prácticas de servicio comunitario</AccordionHeader>
                    <AccordionContent>
                        <Vinculacion :student="student" :period="periodo" :status="status"></Vinculacion>
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="3">
                    <AccordionHeader>Prácticas preprofesionales</AccordionHeader>
                    <AccordionContent>
                        <Preprofesionales :student="student" :period="periodo" :status="status"></Preprofesionales>
                    </AccordionContent>
                </AccordionPanel>
            </Accordion>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
import Titulacion from "./ProfilePartials/Titulacion.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Information from "./ProfilePartials/Information.vue";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import Vinculacion from "./ProfilePartials/Vinculacion.vue";
import Preprofesionales from "./ProfilePartials/Preprofesionales.vue";

const { student } = usePage().props;
const title = student?.lastname + " " + student?.name;

const periodo = ref([
    { id: 0, period: "2024-2025" },
    { id: 1, period: "2023-2024" },
]);

const professors = ref([
    { id: 1, name: "John Smith" },
    { id: 2, name: "Jane Doe" },
    { id: 3, name: "Emily Johnson" },
    { id: 4, name: "DMichael Brown" },
    { id: 5, name: "Linda Davis" },
    { id: 6, name: "William Wilson" },
    { id: 7, name: "Elizabeth Martinez" },
    { id: 8, name: "David Anderson" },
    { id: 9, name: "Susan Taylor" },
    { id: 10, name: "Robert Thomas" },
]);

const status = ref([
    { id: 0, status: "En proceso" },
    { id: 1, status: "Finalizado" },
    { id: 2, status: "Cancelado" },
]);
</script>
