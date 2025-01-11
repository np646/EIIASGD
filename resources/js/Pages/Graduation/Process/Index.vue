<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Subtitle :title="`Proceso de titulación`" class="pt-3"></Subtitle>
            <div class="p-3">
                <div>
                    <ButtonGroup>
                        <Button label="Editar información" icon="pi pi-pencil" size="small" @click="edit"></Button>
                        <Button label="Ver documentación" icon="pi pi-file" size="small" @click="documents"></Button>
                    </ButtonGroup>
                </div>
                <div class="flex flex-col gap-4 justify-center h-full pt-4">
                    <div class="grid grid-cols-12 gap-3 h-full">
                        <label class="flex items-center col-span-3 h-full" for="inputInicio">Periodo de inicio de titulación</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputInicio" fluid disabled v-model="form.start_period" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputFinalizacion">Periodo de Integración Curricular</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputFinalizacion" fluid disabled v-model="form.end_period" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputMatricula">Matrícula</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputMatrícula" fluid disabled v-model="registration_times" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputAprobacion">Fecha de aprobación del plan</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputAprobacion" fluid disabled v-model="form.approval_date" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputModalidad">Modalidad de titulación</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputModalidad" fluid disabled v-model="form.type" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputTitulo">Título de tesis</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputTitulo" fluid disabled v-model="form.thesis_name" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputLinea">Línea de investigación</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputLinea" fluid disabled v-model="form.area" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputAsesor">Asesor</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputAsesor" fluid disabled v-model="form.advisor" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputFechaAsesor">Fecha de asignación de asesor</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputFechaAsesor" fluid disabled v-model="form.advisor_assignment_date" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputAsesor">Lector (I)</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputLector1" fluid disabled v-model="form.reader1" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputAsesor">Lector (II)</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputLector2" fluid disabled v-model="form.reader2" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputFechaLector">Fecha de asignación de lectores</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputFechaLectores" fluid disabled v-model="form.readers_assignment_date" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputGraduacion">Fecha de graduación</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputGraduacion" fluid disabled v-model="form.graduation_date" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputEstado">Estado</label>
                        <div class="col-span-9">
                            <InputText id="inputEstado" fluid disabled v-model="form.status" />
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
import Title from "@/Components/Title.vue";
import Subtitle from "@/Components/Subtitle.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import ButtonGroup from "primevue/buttongroup";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

import { useForm } from "@inertiajs/vue3";

const graduationArray = ref(usePage().props.graduation);
const graduation = graduationArray.value[0];

const registration_times = ref("");
const form = useForm({
    start_period: graduation.start_period,
    end_period: graduation.end_period,
    advisor: graduation.advisor_name,
    advisor_assignment_date: graduation.advisor_assignment_date,
    reader1: graduation.reader1_name,
    reader2: graduation.reader2_name,
    readers_assignment_date: graduation.readers_assignment_date,
    area: graduation.area,
    registration_times: registration_times,
    approval_date: graduation.plan_approval_date,
    type: graduation.type,
    thesis_name: graduation.thesis_name,
    graduation_date: graduation.graduation_date,
    status: graduation.status_name,
});

const title = graduation.student_name;

function selectedRegistrationTimes() {
    switch (graduation.registration_times) {
        case 1:
            registration_times.value = "PRIMERA";
            break;
        case 2:
            registration_times.value = "SEGUNDA";
            break;
        case 3:
            registration_times.value = "TERCERA";
            break;
    }
}

selectedRegistrationTimes();

function documents() {
    const url = route("graduationFiles.studentFiles", { student: graduation.id });
    router.visit(url);
}

function edit() {
    const url = route("graduation.processEdit", { student: graduation.student_id });
    router.visit(url);
}
</script>
