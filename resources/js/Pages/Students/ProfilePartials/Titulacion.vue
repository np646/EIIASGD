<template>
    <div class="mb-3">
        <ButtonGroup>
            <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="openDialog"></Button>
        </ButtonGroup>
    </div>
    <div class="flex flex-col gap-4 justify-center h-full mb-3">
        <div class="grid grid-cols-12 gap-3 h-full pl-4 pr-10">
            <label class="flex items-center col-span-3 h-full" for="inputInicio">Periodo de inicio de estudios</label>
            <div class="col-span-7 mb-2">
                <InputText id="inputInicio" size="small" fluid disabled  v-model="form.start_period"/>
            </div>
            <div class="col-span-2 mb-2">
                <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small" @click="redirect" fluid></Button>
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputFinalizacion">Periodo de Integración Curricular</label>
            <div class="col-span-7 mb-2">
                <InputText id="inputFinalizacion" size="small" fluid disabled value="2024-2025" />
            </div>
            <div class="col-span-2 mb-2">
                <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small" @click="redirect" fluid></Button>
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputMatricula">Matrícula</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputMatrícula" size="small" fluid disabled value="PRIMERA" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputAprobacion">Fecha de aprobación del plan</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputAprobacion" size="small" fluid disabled value="10-07-2023" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputModalidad">Modalidad de titulación</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputModalidad" size="small" fluid disabled value="PROYECTO DE INVESTIGACIÓN" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputTitulo">Título de tesis</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputTitulo" size="small" fluid disabled value="APLICACIÓN WEB DE GESTIÓN DOCUMENTAL" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputLinea">Línea de investigación</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputLinea" size="small" fluid disabled value="INGENIERÍA DE SOFTWARE, INNOVACIÓN Y EMPRENDIMIENTO EN TICS" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputAsesor">Asesor</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputAsesor" size="small" fluid disabled value="AGULLO JIMÉNEZ LUIS SEBASTIAN" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputAsesor">Lector (I)</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputLector1" size="small" fluid disabled value="MEJIAS MOLINERO ALEJANDRA NAROA" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputAsesor">Lector (II)</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputLector2" size="small" fluid disabled value="PERALES SALAS MAURICIO JAVIER" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputGraduacion">Fecha de graduación</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputGraduacion" size="small" fluid disabled value="15-03-2025" />
            </div>
            <label class="flex items-center col-span-3 h-full" for="inputEstado">Estado</label>
            <div class="col-span-9 mb-2">
                <InputText id="inputEstado" size="small" fluid disabled value="En proceso" />
            </div>
        </div>
    </div>

    <Dialog v-model:visible="visible" modal header="Editar información" :style="{ width: '35rem' }">
        <template #header>
            <div class="inline-flex items-center justify-center gap-2">
                <span class="font-bold whitespace-nowrap">Editar información</span>
            </div>
        </template>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectUInicio" class="font-semibold w-50">Periodo de inicio de estudios</label>
            <Select class="w-100" id="selectUInicio" :options="period" optionLabel="period" :placeholder="`Seleccione uno`" v-model="selectedPeriodStart" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectUFinalizacion" class="font-semibold w-50">Periodo de Integración Curricular</label>
            <Select class="w-100" id="selectUFinalizacion" :options="period" optionLabel="period" :placeholder="`Seleccione uno`" v-model="selectedPeriodEnd" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectUMatricula" class="font-semibold w-50">Matrícula</label>
            <Select
                class="w-100"
                id="selectUMatricula"
                :options="period"
                optionLabel="period"
                :placeholder="`Seleccione uno`"
                v-model="selectedRegistrationTimes"
            />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="inputUAprobacion" class="font-semibold w-50">Fecha de aprobación del plan</label>
            <Datepicker  id="inputUAprobacion" required class="w-100"/>
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectULineaInvestigacion" class="font-semibold w-50">Modalidad de titulación</label>
            <Select
                class="w-100"
                id="selectULineaInvestigacion"
                :options="period"
                optionLabel="period"
                :placeholder="`Seleccione uno`"
                v-model="selectedLineOfResearch"
            />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="inputUTema" class="font-semibold w-50">Tema de tesis</label>
            <InputText id="inputUTema" size="small" fluid/>
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectULineaInvestigacion" class="font-semibold w-50">Línea de investigación</label>
            <Select
                class="w-100"
                id="selectULineaInvestigacion"
                :options="period"
                optionLabel="period"
                :placeholder="`Seleccione uno`"
                v-model="selectedLineOfResearch"
            />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectUAsesor" class="font-semibold w-50">Asesor</label>
            <Select v-model="selectedAssesor" id="selectUAsesor" :options="professors" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
            <label for="selectULector1" class="font-semibold w-50">Lector (I) </label>
            <Select v-model="selectedReader1" id="selectULector1" :options="professors" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
            <label for="selectULector2" class="font-semibold w-50">Lector (II) </label>
            <Select v-model="selectedReader2" id="selectULector2" :options="professors" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
            <label for="inputUGraduacion" class="font-semibold w-50">Fecha de graduación</label>
            <Datepicker  id="inputUGraduacion" required class="w-100"/>
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectUEstado" class="font-semibold w-50">Estado</label>
            <Select class="w-100" id="selectUEstado" :options="status" optionLabel="status" :placeholder="`Seleccione uno`" v-model="selectedStatus" />
        </div>
        <template #footer>
            <Button label="Cancelar" text severity="secondary" @click="closeDialog" autofocus />
            <Button label="Guardar" severity="success" @click="closeDialog" autofocus />
        </template>
    </Dialog>
</template>

<script setup>
import ButtonGroup from "primevue/buttongroup";
import InputText from "primevue/inputtext";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import Select from "primevue/select";
import Datepicker from "@/Components/Datepicker.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    student: Object,
    period: Object,
    professors: Object,
    status: Object,
    slotProps: Object,
});

const visible = ref(false);
const openDialog = (id) => {
    console.log(id);
    visible.value = true;
};

const closeDialog = () => {
    visible.value = false;
};

function redirect() {
    router.visit("/");
}

const selectedPeriodStart = ref(null);
const selectedPeriodEnd = ref(null);
const selectedStatus = ref(null);
const selectedAssesor = ref(null);
const selectedReader1 = ref(null);
const selectedReader2 = ref(null);
const selectedLineOfResearch = ref(null);


import { usePage } from "@inertiajs/vue3";
console.log(usePage().props.graduation);


import { useForm } from "@inertiajs/vue3";

const graduationArray = ref(usePage().props.graduation)
const graduation = graduationArray.value[0];

const form = useForm({
    start_period: graduation.start_period,
});

console.log(graduation.advisor_id)

</script>
