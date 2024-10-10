<template>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Accordion multiple>
                <AccordionPanel value="0">
                    <AccordionHeader>Información personal</AccordionHeader>
                    <AccordionContent>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputApellidos">Apellidos</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText v-model="form.lastname" id="inputApellidos" size="small" fluid disabled />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputNombres">Nombres</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText v-model="form.name" id="inputNombres" size="small" fluid disabled />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputEmail">Email</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText v-model="form.email" id="inputEmail" size="small" fluid disabled />
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>

                <!-- TODO: Información quemada -->
                <AccordionPanel value="1">
                    <AccordionHeader>Titulación</AccordionHeader>
                    <AccordionContent>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Asesor</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="ESTUDIANTE APELLIDO NOMBRE" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Lector 1</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="ESTUDIANTE1 APELLIDO NOMBRE" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Lector 2</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="ESTUDIANTE2 APELLIDO NOMBRE" />
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>
            </Accordion>

            <Dialog v-model:visible="visible" modal header="Editar información" :style="{ width: '25rem' }">
                <template #header>
                    <div class="inline-flex items-center justify-center gap-2">
                        <span class="font-bold whitespace-nowrap">Editar información</span>
                    </div>
                </template>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Periodo de inicio</label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Periodo de finalización</label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Estado</label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Línea de investigación </label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Asesor </label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Lector 1 </label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Lector 2 </label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <template #footer>
                    <Button label="Cancel" text severity="secondary" @click="visible = false" autofocus />
                    <Button label="Save" outlined severity="secondary" @click="visible = false" autofocus />
                </template>
            </Dialog>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import InputText from "primevue/inputtext";
import Title from "@/Components/Title.vue";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import ContentContainer from "@/Components/ContentContainer.vue";
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";

const { professor } = usePage().props;
const visible = ref(false);
const form = useForm({
    name: professor.name,
    lastname: professor.lastname,
    identification: professor.identification,
    email: professor.email,
});

const title = form.lastname + " " + form.name;

import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
import ButtonGroup from "primevue/buttongroup";
</script>
