<template>
    <div class="mb-3">
        <ButtonGroup>
            <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="openDialog"></Button>
        </ButtonGroup>
    </div>
    <div class="flex flex-col gap-4 justify-center h-full mb-3">
        <div class="grid grid-cols-12 gap-2 h-full">
            <label class="flex items-center col-span-2 h-full" for="inputInicio">Periodo de inicio</label>
            <div class="col-span-6 mb-2">
                <InputText id="inputInicio" size="small" fluid disabled value="2023-2024" />
            </div>
            <div class="col-span-4 mb-2">
                <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small" @click="redirect"></Button>
            </div>
            <label class="flex items-center col-span-2 h-full" for="inputFinalizacion">Periodo de finalización</label>
            <div class="col-span-6 mb-2">
                <InputText id="inputFinalizacion" size="small" fluid disabled value="2023-2024" />
            </div>
            <div class="col-span-4 mb-2">
                <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small" @click="redirect"></Button>
            </div>
            <label class="flex items-center col-span-2 h-full" for="inputEstado">Estado</label>
            <div class="col-span-6 mb-2">
                <InputText id="inputEstado" size="small" fluid disabled value="En proceso" />
            </div>
            <div class="col-span-4 mb-2"></div>
            <label class="flex items-center col-span-2 h-full" for="inputLineaInvestigacion">Línea de investigación</label>
            <div class="col-span-6 mb-2">
                <InputText id="inputLineaInvestigacion" size="small" fluid disabled value="SOFTWARE" />
            </div>
            <div class="col-span-4 mb-2"></div>
            <label class="flex items-center col-span-2 h-full" for="inputAsesor">Asesor</label>
            <div class="col-span-6 mb-2">
                <InputText id="inputAsesor" size="small" fluid disabled value="DOCENTE APELLIDO NOMBRE" />
            </div>
            <div class="col-span-4 mb-2"></div>
            <label class="flex items-center col-span-2 h-full" for="inputLector1">Lector 1</label>
            <div class="col-span-6 mb-2">
                <InputText id="inputLector1" size="small" fluid disabled value="DOCENTE1 APELLIDO NOMBRE" />
            </div>
            <div class="col-span-4 mb-2"></div>
            <label class="flex items-center col-span-2 h-full" for="inputLector2">Lector 2</label>
            <div class="col-span-6 mb-2">
                <InputText id="inputLector2" size="small" fluid disabled value="DOCENTE2 APELLIDO NOMBRE" />
            </div>
            <div class="col-span-4 mb-2"></div>
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
            <Button label="Cancel" text severity="secondary" @click="closeDialog" autofocus />
            <Button label="Save" severity="success" @click="closeDialog" autofocus />
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
