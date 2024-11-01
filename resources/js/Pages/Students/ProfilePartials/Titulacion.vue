<template>
    <div class="mb-3">
        <ButtonGroup>
            <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="openDialog"></Button>
        </ButtonGroup>
    </div>
    <div class="flex flex-col gap-4 justify-center h-full mb-3">
        <div class="grid grid-cols-12 gap-3 h-full pl-4 pr-10">
            <label class="flex items-center col-span-3 h-full" for="inputInicio">Periodo de inicio</label>
            <div class="col-span-7 mb-2">
                <InputText id="inputInicio" size="small" fluid disabled value="2023-2024" />
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
            <label for="selectInicio" class="font-semibold w-44">Periodo de inicio</label>
            <Select class="w-100" id="selectInicio" :options="period" optionLabel="period" :placeholder="`Seleccione uno`" v-model="selectedPeriodStart" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectFinalizacion" class="font-semibold w-44">Periodo de finalización</label>
            <Select class="w-100" id="selectFinalizacion" :options="period" optionLabel="period" :placeholder="`Seleccione uno`" v-model="selectedPeriodEnd" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectEstado" class="font-semibold w-44">Estado</label>
            <Select class="w-100" id="selectEstado" :options="status" optionLabel="status" :placeholder="`Seleccione uno`" v-model="selectedStatus" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectLineaInvestigacion" class="font-semibold w-44">Línea de investigación</label>
            <Select
                class="w-100"
                id="selectLineaInvestigacion"
                :options="period"
                optionLabel="period"
                :placeholder="`Seleccione uno`"
                v-model="selectedLineOfResearch"
            />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectAsesor" class="font-semibold w-44">Asesor</label>
            <Select v-model="selectedAssesor" id="selectAsesor" :options="professors" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
            <label for="selectLector1" class="font-semibold w-44">Lector 1 </label>
            <Select v-model="selectedReader1" id="selectLector1" :options="professors" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
            <label for="selectLector2" class="font-semibold w-44">Lector 2 </label>
            <Select v-model="selectedReader2" id="selectLector2" :options="professors" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    student: Object,
    period: Object,
    professors: Object,
    status: Object,
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
</script>
