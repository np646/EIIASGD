<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Subtitle :title="`Actualizar información del proceso de titulación`" class="pt-3"></Subtitle>
            <div class="px-3 pt-3">
                <div class="flex flex-col gap-4 justify-center h-full mb-3">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-12 gap-3 h-full">
                            <label class="flex items-center col-span-3 h-full" for="inputPeriodo">Periodo de realización de prácticas</label>
                            <div class="col-span-9 mb-2">
                                <Select id="inputPeriodo" v-model="selectedAcademicPeriod" :options="periods" optionLabel="period" class="w-100" />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputEstado">Estado</label>
                            <div class="col-span-9 mb-2">
                                <Select id="inputEstado" v-model="selectedStatus" :options="statuses" optionLabel="name" class="w-100" />
                            </div>
                            <div class="col-span-12 mt-2">
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-center">
                                        <Button label="Cancelar" icon="pi pi-times" type="button" severity="secondary" @click="cancel" />
                                    </div>
                                    <div class="col-6 d-flex justify-content-center">
                                        <Button label="Guardar" icon="pi pi-check" type="submit" severity="success" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
import Button from "primevue/button";
import Select from "@/Components/Select.vue";
import { useComputeSelectedOption } from "@/Composables/useComputeSelectedOption";
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

import { useForm } from "@inertiajs/vue3";

const process = ref(usePage().props.process).value;
console.log(process);
const periods = ref(usePage().props.periods);
const statuses = ref(usePage().props.statuses);

const form = useForm({
    academic_period_id: process.academic_period_id,
    status: process.status,
});

const title = process.student_name;

const selectedAcademicPeriod = ref(null);
selectedAcademicPeriod.value = useComputeSelectedOption(process.academic_period_id, periods);
if (selectedAcademicPeriod.value) {
    form.academic_period_id = selectedAcademicPeriod.value.id;
} else {
    form.academic_period_id = null;
}
watch(selectedAcademicPeriod, () => {
    form.academic_period_id = selectedAcademicPeriod.value;
});

const selectedStatus = ref(null);
selectedStatus.value = useComputeSelectedOption(process.status, statuses);
if (selectedStatus.value) {
    form.status = selectedStatus.value.id;
} else {
    form.status = null;
}
watch(selectedStatus, () => {
    form.status = selectedStatus.value;
});

function cancel() {
    const url = route("preprofessional.process", { student: process.student_id });
    router.visit(url);
}

function submit() {
    const url = route("preprofessional.updateProcess", { student: process.student_id });
    form.put(url);
}
</script>
