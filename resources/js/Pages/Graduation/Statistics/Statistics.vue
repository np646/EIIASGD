<template v-slot:slot-content>
    <Head title="Reportes estadísticos" />
    <MenuLayout>
        <Title :title="title" />

        <ContentContainer>
            <Select v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Seleccione un tipo" class="w-full md:w-56" />



            <Accordion value="0">
                <AccordionPanel value="0">
                    <AccordionHeader>Graduados por fechas</AccordionHeader>
                    <AccordionContent>
                        <Fechas />
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="1">
                    <AccordionHeader>Estudiantes resagados</AccordionHeader>
                    <AccordionContent>
                        <Resagados />
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="2">
                    <AccordionHeader>Estudiantes en segunda o tercera matrícula</AccordionHeader>
                    <AccordionContent>
                        <Matricula />
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="3">
                    <AccordionHeader>Estudiantes con plan de titulación por caducar</AccordionHeader>
                    <AccordionContent>
                        <Caducidad />
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="4">
                    <AccordionHeader>Documentación entregada</AccordionHeader>
                    <AccordionContent>
                        <Documentacion />
                    </AccordionContent>
                </AccordionPanel>
            </Accordion>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Resagados from "./Partials/Resagados.vue";
import Fechas from "./Partials/Fechas.vue";
import Matricula from "./Partials/Matricula.vue";
import Caducidad from "./Partials/Caducidad.vue";
import Documentacion from "./Partials/Documentacion.vue";
import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
import Select from 'primevue/select';

const title = "Reportes estadísticos: Titulación";


import { ref } from "vue";

const selectedCity = ref();
const cities = ref([
    { name: 'Graduados por fechas', code: 'NY' },
    { name: 'Estudiantes resagados', code: 'RM' },
    { name: 'Estudiantes en segunda o tercera matrícula', code: 'LDN' },
    { name: 'Estudiantes con plan por caducar', code: 'IST' },
    { name: 'Documentación entregada', code: 'PRS' }
]);
</script>
