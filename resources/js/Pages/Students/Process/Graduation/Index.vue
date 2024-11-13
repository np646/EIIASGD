<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <div class="mb-3">
                <ButtonGroup>
                    <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="edit"></Button>
                </ButtonGroup>
            </div>
            <div class="flex flex-col gap-4 justify-center h-full mb-3">
                <div class="grid grid-cols-12 gap-3 h-full pl-4 pr-10">
                    <label class="flex items-center col-span-3 h-full" for="inputInicio">Periodo de inicio de estudios</label>
                    <div class="col-span-7 mb-2">
                        <InputText id="inputInicio" size="small" fluid disabled v-model="form.start_period" />
                    </div>
                    <div class="col-span-2 mb-2">
                        <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small" @click="redirect" fluid></Button>
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputFinalizacion">Periodo de Integración Curricular</label>
                    <div class="col-span-7 mb-2">
                        <InputText id="inputFinalizacion" size="small" fluid disabled v-model="form.end_period" />
                    </div>
                    <div class="col-span-2 mb-2">
                        <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small" @click="redirect" fluid></Button>
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputMatricula">Matrícula</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputMatrícula" size="small" fluid disabled v-model="form.registration_times" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputAprobacion">Fecha de aprobación del plan</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputAprobacion" size="small" fluid disabled v-model="form.approval_date" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputModalidad">Modalidad de titulación</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputModalidad" size="small" fluid disabled v-model="form.type" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputTitulo">Título de tesis</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputTitulo" size="small" fluid disabled v-model="form.thesis_name" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputLinea">Línea de investigación</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputLinea" size="small" fluid disabled v-model="form.area" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputAsesor">Asesor</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputAsesor" size="small" fluid disabled v-model="form.advisor" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputAsesor">Lector (I)</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputLector1" size="small" fluid disabled v-model="form.reader1" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputAsesor">Lector (II)</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputLector2" size="small" fluid disabled v-model="form.reader2" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputGraduacion">Fecha de graduación</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputGraduacion" size="small" fluid disabled v-model="form.graduation_date" />
                    </div>
                    <label class="flex items-center col-span-3 h-full" for="inputEstado">Estado</label>
                    <div class="col-span-9 mb-2">
                        <InputText id="inputEstado" size="small" fluid disabled v-model="form.status" />
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
import ContentContainer from "@/Components/ContentContainer.vue";
import ButtonGroup from "primevue/buttongroup";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const { student } = usePage().props;
const title = student?.lastname + " " + student?.name;


import { useForm } from "@inertiajs/vue3";

const graduationArray = ref(usePage().props.graduation)
const graduation = graduationArray.value[0];

const form = useForm({
    start_period: graduation.start_period,
    end_period: graduation.end_period,
    advisor: graduation.advisor_name,
    reader1: graduation.reader1_name,
    reader2: graduation.reader2_name,
    area: graduation.area,
    registration_times: graduation.registration_times,
    approval_date: graduation.plan_approval_date,
    type: graduation.type,
    thesis_name: graduation.thesis_name,
    graduation_date: graduation.graduation_date,
    status: graduation.status,
});

function redirect() {
    router.visit("/");
}

function edit() {
    router.visit("/");
}
</script>
