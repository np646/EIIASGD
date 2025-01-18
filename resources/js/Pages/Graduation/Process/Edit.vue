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
                            <label class="flex items-center col-span-3 h-full" for="inputInicio">Periodo de inicio de estudios</label>
                            <div class="col-span-9 mb-2">
                                <Select id="inputInicio" v-model="selectedStartPeriod" :options="periods" optionLabel="period" class="w-100" />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputFinalizacion">Periodo de Integración Curricular</label>
                            <div class="col-span-9 mb-2">
                                <Select id="inputFinalizacion" v-model="selectedEndPeriod" :options="periods" optionLabel="period" class="w-100" />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputMatricula">Matrícula</label>
                            <div class="col-span-9 mb-2">
                                <Select id="inputMatrícula" v-model="selectedTimes" :options="registrationTimes" optionLabel="name" class="w-100" />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputAprobacion">Fecha de aprobación del plan</label>
                            <div class="col-span-9 mb-2">
                                <Datepicker v-model="form.plan_approval_date" id="inputAprobacion" required />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputModalidad">Modalidad de titulación</label>
                            <div class="col-span-9 mb-2">
                                <Select id="inputModalidad" v-model="selectedType" :options="types" optionLabel="type" class="w-100" />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputTitulo">Título de tesis</label>
                            <div class="col-span-9 mb-2">
                                <InputText id="inputTitulo" fluid v-model="form.thesis_name" />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputLinea">Línea de investigación</label>
                            <div class="col-span-9 mb-2">
                                <Select id="inputLinea" v-model="selectedArea" :options="areas" optionLabel="area" class="w-100" />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputAsesor">Asesor</label>
                            <div class="col-span-9 mb-2">
                                <Select v-model="selectedAdvisor" id="inputAsesor" :options="professors" filter optionLabel="name" class="w-100">
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
                            <label class="flex items-center col-span-3 h-full" for="inputFechaAsesor">Fecha de asignación de asesor</label>
                            <div class="col-span-9 mb-2">
                                <Datepicker v-model="form.advisor_assignment_date" id="inputFechaAsesor" required />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputLector1">Lector (I)</label>
                            <div class="col-span-9 mb-2">
                                <Select v-model="selectedReader1" id="inputLector1" :options="professors" filter optionLabel="name" class="w-100">
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
                            <label class="flex items-center col-span-3 h-full" for="inputLector2">Lector (II)</label>
                            <div class="col-span-9 mb-2">
                                <Select v-model="selectedReader2" id="inputLector2" :options="professors" filter optionLabel="name" class="w-100">
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
                            <label class="flex items-center col-span-3 h-full" for="inputFechaLectores">Fecha de asignación de lectores</label>
                            <div class="col-span-9 mb-2">
                                <Datepicker v-model="form.readers_assignment_date" id="inputFechaLectores" required />
                            </div>
                            <label class="flex items-center col-span-3 h-full" for="inputGraduacion">Fecha de graduación</label>
                            <div class="col-span-9 mb-2">
                                <Datepicker v-model="form.graduation_date" id="inputGraduacion" required />
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
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Datepicker from "@/Components/Datepicker.vue";
import Select from "@/Components/Select.vue";
import { useComputeSelectedOption } from "@/Composables/useComputeSelectedOption";
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
const toast = useToast();

const graduationArray = ref(usePage().props.graduation);
const graduation = graduationArray.value[0];

const periods = ref(usePage().props.periods);
const types = ref(usePage().props.types);
const areas = ref(usePage().props.areas);
const professors = ref(usePage().props.professors);
const statuses = ref(usePage().props.statuses);

const registration_times = ref("");

const form = useForm({
    academic_period_start_id: graduation.academic_period_start_id,
    academic_period_end_id: graduation.academic_period_end_id,
    advisor_id: graduation.advisor_id,
    advisor_assignment_date: graduation.advisor_assignment_date,
    reader1_id: graduation.reader1_id,
    reader2_id: graduation.reader2_id,
    readers_assignment_date: graduation.readers_assignment_date,
    thesis_area: graduation.thesis_area,
    registration_times: registration_times,
    plan_approval_date: graduation.plan_approval_date,
    graduation_type: graduation.graduation_type,
    thesis_name: graduation.thesis_name,
    graduation_date: graduation.graduation_date,
    status: graduation.status,
});

const title = graduation.student_name;

const selectedStartPeriod = ref(null);
selectedStartPeriod.value = useComputeSelectedOption(graduation.academic_period_start_id, periods);
if (selectedStartPeriod.value) {
    form.academic_period_start_id = selectedStartPeriod.value.id;
} else {
  form.academic_period_start_id = null;
}
watch(selectedStartPeriod, () => {
    form.academic_period_start_id = selectedStartPeriod.value;
});

const selectedEndPeriod = ref(null);
selectedEndPeriod.value = useComputeSelectedOption(graduation.academic_period_end_id, periods);
if (selectedEndPeriod.value) {
    form.academic_period_end_id = selectedEndPeriod.value.id;
} else {
  form.academic_period_end_id = null;
}
watch(selectedEndPeriod, () => {
    form.academic_period_end_id = selectedEndPeriod.value;
});

const registrationTimes = ref([
    { id: 1, name: "PRIMERA" },
    { id: 2, name: "SEGUNDA" },
    { id: 3, name: "TERCERA" },
]);
const selectedTimes = ref(null);
selectedTimes.value = useComputeSelectedOption(graduation.registration_times, registrationTimes);
if (selectedTimes.value) {
    form.registration_times = selectedTimes.value.id;
} else {
  form.registration_times = null;
}
watch(selectedTimes, () => {
    form.registration_times = selectedTimes.value;
});

const selectedType = ref(null);
selectedType.value = useComputeSelectedOption(graduation.graduation_type, types);
if (selectedType.value) {
  form.graduation_type = selectedType.value.id;
} else {
  form.graduation_type = null;
}
watch(selectedType, () => {
    form.graduation_type = selectedType.value;
});

const selectedArea = ref(null);
selectedArea.value = useComputeSelectedOption(graduation.thesis_area, areas);
if (selectedArea.value) {
    form.thesis_area = selectedArea.value.id;
} else {
  form.thesis_area = null;
}
watch(selectedArea, () => {
    form.thesis_area = selectedArea.value;
});

const selectedAdvisor = ref(null);
selectedAdvisor.value = useComputeSelectedOption(graduation.advisor_id, professors);
if (selectedAdvisor.value) {
    form.advisor_id = selectedAdvisor.value.id;
} else {
  form.advisor_id = null;
}
watch(selectedAdvisor, () => {
    form.advisor_id = selectedAdvisor.value;
});

const selectedReader1 = ref(null);
selectedReader1.value = useComputeSelectedOption(graduation.reader1_id, professors);
if (selectedReader1.value) {
    form.reader1_id = selectedReader1.value.id;
} else {
  form.reader1_id = null;
}
watch(selectedReader1, () => {
    form.reader1_id = selectedReader1.value;
});

const selectedReader2 = ref(null);
selectedReader2.value = useComputeSelectedOption(graduation.reader2_id, professors);
if (selectedReader2.value) {
    form.reader2_id = selectedReader2.value.id;
} else {
  form.reader2_id = null;
}
watch(selectedReader2, () => {
    form.reader2_id = selectedReader2.value;
});

const selectedStatus = ref(null);
selectedStatus.value = useComputeSelectedOption(graduation.status, statuses);
if (selectedStatus.value) {
    form.status = selectedStatus.value.id;
} else {
  form.status = null;
}
watch(selectedStatus, () => {
    form.status = selectedStatus.value;
});

function cancel() {
    const url = route('graduation.process', { student: graduation.id});
    router.visit(url);
}

function submit() {
    const url = route('graduation.update', { graduation: graduation.id});
    form.put(url, {
        onError: (errors) => {
            Object.keys(errors).forEach((key) => {
                toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: errors[key].join(", "),
                    life: 3000,
                });
            });
        },
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Éxito",
                detail: "Información actualizada correctamente.",
                life: 3000,
            });
        },
    });
}
</script>
