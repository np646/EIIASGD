<template>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <BIconPersonFill></BIconPersonFill>
            {{ form.lastname }} {{ form.name }}
            <Accordion multiple>
                <AccordionPanel value="0">
                    <AccordionHeader>Información básica</AccordionHeader>
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
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputIdentificacion">Identificación</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText v-model="form.identification" id="inputIdentificacion" size="small" fluid disabled />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputCodigoBanner">Código de banner</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText v-model="form.banner_code" id="inputCodigoBanner" size="small" fluid disabled />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputFechaDeNacimiento"
                                    >Fecha de nacimiento</label
                                >
                                <div class="col-span-12 md:col-span-10">
                                    <InputText v-model="form.date_of_birth" id="inputFechaDeNacimiento" size="small" fluid disabled />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputSexo">Sexo</label>
                                <div class="col-span-12 md:col-span-10">
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
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo de inicio</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo de finalización</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Estado</label>
                                <div class="col-span-12 md:col-span-10">
                                    <div class="flex flex-wrap gap-4">
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient1" name="pizza" value="Cheese" />
                                            <label for="ingredient1" class="ml-2">Por iniciar</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient2" name="pizza" value="Mushroom" />
                                            <label for="ingredient2" class="ml-2">En proceso</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient3" name="pizza" value="Pepper" />
                                            <label for="ingredient3" class="ml-2">Terminado</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient4" name="pizza" value="Onion" />
                                            <label for="ingredient4" class="ml-2">Fallido</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Línea de investigación</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="SOFTWARE" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Asesor</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="DOCENTE APELLIDO NOMBRE" />
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="2">
                    <AccordionHeader>Prácticas de servicio comunitario</AccordionHeader>
                    <AccordionContent>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Estado</label>
                                <div class="col-span-12 md:col-span-10">
                                    <div class="flex flex-wrap gap-4">
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient1" name="pizza" value="Cheese" />
                                            <label for="ingredient1" class="ml-2">Por iniciar</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient2" name="pizza" value="Mushroom" />
                                            <label for="ingredient2" class="ml-2">En proceso</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient3" name="pizza" value="Pepper" />
                                            <label for="ingredient3" class="ml-2">Terminado</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient4" name="pizza" value="Onion" />
                                            <label for="ingredient4" class="ml-2">Fallido</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>
                <AccordionPanel value="3">
                    <AccordionHeader>Prácticas preprofesionales</AccordionHeader>
                    <AccordionContent>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Periodo</label>
                                <div class="col-span-12 md:col-span-10">
                                    <InputText id="" size="small" fluid disabled value="2023-2024" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 justify-center h-full mb-3">
                            <div class="grid grid-cols-12 gap-2 h-full">
                                <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="">Estado</label>
                                <div class="col-span-12 md:col-span-10">
                                    <div class="flex flex-wrap gap-4">
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient1" name="pizza" value="Cheese" />
                                            <label for="ingredient1" class="ml-2">Por iniciar</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient2" name="pizza" value="Mushroom" />
                                            <label for="ingredient2" class="ml-2">En proceso</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient3" name="pizza" value="Pepper" />
                                            <label for="ingredient3" class="ml-2">Terminado</label>
                                        </div>
                                        <div class="flex items-center">
                                            <RadioButton v-model="ingredient" inputId="ingredient4" name="pizza" value="Onion" />
                                            <label for="ingredient4" class="ml-2">Fallido</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionPanel>
            </Accordion>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import InputText from "primevue/inputtext";
import Title from "@/Components/Title.vue";
import RadioButton from "primevue/radiobutton";
import ContentContainer from "@/Components/ContentContainer.vue";
import { ref, computed, watch } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
const title = "Perfil del estudiante";

const { student } = usePage().props;
const ingredient = ref("");
const sex = ref("");

const form = useForm({
    name: student.name,
    lastname: student.lastname,
    identification: student.identification,
    date_of_birth: student.date_of_birth,
    email: student.email,
    banner_code: student.banner_code,
    sex: sex,
});

// Set sex selected option from student object
function selectedSex() {
    if (form.sex == 0) {
        sex.value = "Femenino";
    } else {
        sex.value = "Masculino";
    }
}

selectedSex();

import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
</script>
