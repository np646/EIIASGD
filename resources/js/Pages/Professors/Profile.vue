<template>
    <Head title="Docentes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Accordion multiple>
                <AccordionPanel value="0">
                    <AccordionHeader>Información personal</AccordionHeader>
                    <AccordionContent>
                        <Information :professor="professor" />
                    </AccordionContent>
                </AccordionPanel>

                <!-- TODO: Información quemada -->
                <AccordionPanel value="1">
                    <AccordionHeader>Titulación</AccordionHeader>
                    <AccordionContent>
                        <Titulacion :professor="professor" :students="students" />
                    </AccordionContent>
                </AccordionPanel>
            </Accordion>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
import Information from "./ProfilePartials/Information.vue";
import Titulacion from "./ProfilePartials/Titulacion.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const { professor } = usePage().props;

const students = ref([
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

const title = professor?.lastname + " " + professor?.name;
</script>
