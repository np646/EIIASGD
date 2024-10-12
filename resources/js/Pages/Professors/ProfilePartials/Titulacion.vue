<template>
    <div class="mb-3">
        <ButtonGroup>
            <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="openDialog"></Button>
        </ButtonGroup>
    </div>
    <div class="flex flex-col gap-4 justify-center h-full mb-3">
        <div class="grid grid-cols-12 gap-2 h-full">
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputAsesor">Asesor</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText id="inputAsesor" size="small" fluid disabled value="ESTUDIANTE APELLIDO NOMBRE" />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputLector1">Lector 1</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText id="inputLector1" size="small" fluid disabled value="ESTUDIANTE1 APELLIDO NOMBRE" />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputLector2">Lector 2</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText id="inputLector2" size="small" fluid disabled value="ESTUDIANTE2 APELLIDO NOMBRE" />
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
            <label for="selectAsesor" class="font-semibold w-44">Asesor</label>
            <Select v-model="selectedAssesor" id="selectAsesor" :options="students" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
            <Select v-model="selectedReader1" id="selectLector1" :options="students" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
            <Select v-model="selectedReader2" id="selectLector2" :options="students" filter optionLabel="name" placeholder="Seleccione uno" class="w-100">
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
import { ref } from "vue";

const props = defineProps({
    professor: Object,
    period: Object,
    students: Object,
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


const selectedAssesor = ref(null);
const selectedReader1 = ref(null);
const selectedReader2 = ref(null);
</script>
