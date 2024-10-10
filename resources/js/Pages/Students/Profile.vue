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
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText v-model="form.lastname" id="inputApellidos" size="small" fluid disabled />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputNombres">Nombres</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText v-model="form.name" id="inputNombres" size="small" fluid disabled />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputEmail">Email</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText v-model="form.email" id="inputEmail" size="small" fluid disabled />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputIdentificacion">Identificación</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText v-model="form.identification" id="inputIdentificacion" size="small" fluid disabled />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputCodigoBanner">Código de banner</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText v-model="form.banner_code" id="inputCodigoBanner" size="small" fluid disabled />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputFechaDeNacimiento"
                                    >Fecha de nacimiento</label
                                >
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText v-model="form.date_of_birth" id="inputFechaDeNacimiento" size="small" fluid disabled />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputSexo">Sexo</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText v-model="sex" id="inputSexo" size="small" fluid disabled />
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>

                <!-- TODO: Información quemada -->
                <AccordionPanel value="1">
                    <AccordionHeader>Titulación</AccordionHeader>
                    <AccordionContent>
                        <div class="mb-3">
                            <ButtonGroup>
                                <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="visible = true"></Button>
                                <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small"></Button>
                            </ButtonGroup>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo de inicio</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo de finalización</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Estado</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="En proceso" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Línea de investigación</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="SOFTWARE" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Asesor</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="DOCENTE APELLIDO NOMBRE" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Lector 1</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="DOCENTE1 APELLIDO NOMBRE" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Lector 2</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="DOCENTE2 APELLIDO NOMBRE" />
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="2">
                    <AccordionHeader>Prácticas de servicio comunitario</AccordionHeader>
                    <AccordionContent>
                        <div class="mb-3">
                            <ButtonGroup>
                                <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="visible = true"></Button>
                                <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small"></Button>
                            </ButtonGroup>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Estado</label>
                                <div class="col-span-12 md:col-span-10 mb-2">
                                    <InputText id="" size="small" fluid disabled value="En proceso" />
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="3">
                    <AccordionHeader>Prácticas preprofesionales</AccordionHeader>
                    <AccordionContent>
                        <div class="mb-3">
                            <ButtonGroup>
                                <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="visible = true"></Button>
                                <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small"></Button>
                            </ButtonGroup>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Estado</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="En proceso" />
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>
            </Accordion>

            <Dialog v-model:visible="visible" modal header="Editar información" :style="{ width: '30rem' }">
                <template #header>
                    <div class="inline-flex items-center justify-center gap-2">
                        <span class="font-bold whitespace-nowrap">Editar información</span>
                    </div>
                </template>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Periodo de inicio</label>
                    <Select
                        class="w-100"
                        id="inputSelectSexo"
                        :options="periodo"
                        :optionLabel="`periodo`"
                        :placeholder="`Seleccione uno`"
                        v-model="selectedPeriodoOption"
                    />
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
                    <label for="username" class="font-semibold w-24">Línea de investigación</label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Asesor</label>
                    <Select v-model="selectedCountry" :options="countries" filter optionLabel="name" placeholder="Select a Country" class="w-100">
                        <template #value="slotProps">
                            <div v-if="slotProps.value" class="flex items-center">
                                <div>{{ slotProps.value.name }}</div>
                            </div>
                            <span v-else>
                                {{ slotProps.placeholder }}
                            </span>
                        </template>
                        <template #option="slotProps">
                            <div class="flex items-center">
                                <div>{{ slotProps.option.name }}</div>
                            </div>
                        </template>
                    </Select>
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

import Select from "primevue/select";

import ContentContainer from "@/Components/ContentContainer.vue";
import { ref, computed, watch } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";

const { student } = usePage().props;
const sex = ref("");
const visible = ref(false);
const form = useForm({
    name: student.name,
    lastname: student.lastname,
    identification: student.identification,
    date_of_birth: student.date_of_birth,
    email: student.email,
    banner_code: student.banner_code,
    sex: sex,
});

const title = form.lastname + " " + form.name;

// Periodo array for select component
const periodo = ref([
    { id: 0, periodo: "2024-2025" },
    { id: 1, periodo: "2023-2024" },
]);

const selectedPeriodoOption = ref(null);
// Set sex selected option from student object
function selectedSex() {
    if (form.sex == 0) {
        sex.value = "Femenino";
    } else {
        sex.value = "Masculino";
    }
}

selectedSex();

const selectedCountry = ref();
const countries = ref([
    { name: "Australia", code: "AU" },
    { name: "Brazil", code: "BR" },
    { name: "China", code: "CN" },
    { name: "Egypt", code: "EG" },
    { name: "France", code: "FR" },
    { name: "Germany", code: "DE" },
    { name: "India", code: "IN" },
    { name: "Japan", code: "JP" },
    { name: "Spain", code: "ES" },
    { name: "United States", code: "US" },
]);

import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
import ButtonGroup from "primevue/buttongroup";
</script>
