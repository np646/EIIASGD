<template>
    <div class="mb-3">
        <ButtonGroup>
            <Button label="Editar" icon="pi pi-pencil" severity="contrast" size="small" @click="openDialog"></Button>
            <Button label="Ir a carpeta" icon="pi pi-external-link" severity="contrast" size="small" @click="redirect"></Button>
        </ButtonGroup>
    </div>
    <div class="flex flex-col gap-4 justify-center h-full mb-3">
        <div class="grid grid-cols-12 gap-2 h-full">
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputPeriodo">Periodo</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText id="inputPeriodo" size="small" fluid disabled value="2023-2024" />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputEstado">Estado</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText id="inputEstado" size="small" fluid disabled value="En proceso" />
            </div>
        </div>
    </div>

    <Dialog v-model:visible="visible" modal header="Editar información" :style="{ width: '30rem' }">
        <template #header>
            <div class="inline-flex items-center justify-center gap-2">
                <span class="font-bold whitespace-nowrap">Editar información</span>
            </div>
        </template>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectPeriodo" class="font-semibold w-24">Periodo</label>
            <Select class="w-100" id="selectPeriodo" :options="period" optionLabel="period" :placeholder="`Seleccione uno`" v-model="selectedPeriod" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="selectEstado" class="font-semibold w-24">Estado</label>
            <Select class="w-100" id="selectEstado" :options="status" optionLabel="status" :placeholder="`Seleccione uno`" v-model="selectedStatus" />
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

const selectedPeriod = ref(null);
const selectedStatus = ref(null);
</script>
