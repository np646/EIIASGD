<template>
    <div class="p-3">
        <div class="flex flex-col gap-4 justify-center h-full">
            <div class="grid grid-cols-12 gap-3 h-full">
                <label class="flex items-center col-span-3 h-full" for="inputApellidos">Apellidos</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.lastname" id="inputApellidos" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputNombres">Nombres</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.name" id="inputNombres" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputEmail">Email</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.email" id="inputEmail" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputIdentificacion">Identificación</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.identification" id="inputIdentificacion" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputCodigoBanner">Código de banner</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.banner_code" id="inputCodigoBanner" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputFechaDeNacimiento">Fecha de nacimiento</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.date_of_birth" id="inputFechaDeNacimiento" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputSexo">Sexo</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="sex" id="inputSexo" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputCarrera">Carrera</label>
                <div class="col-span-9">
                    <InputText v-model="form.course_name" id="inputCarrera" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputInicio">Periodo de inicio de estudios</label>
                <div class="col-span-9">
                    <InputText v-model="startPeriod" id="inputInicio" fluid disabled />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import InputText from "primevue/inputtext";
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { useComputeSelectedOption } from "@/Composables/useComputeSelectedOption";

const periods = ref(usePage().props.periods);

const props = defineProps({
    student: Object,
});

const sex = ref("");
const startPeriod = ref("");
startPeriod.value = useComputeSelectedOption(props.student.academic_period_start_id, periods).period;

const form = useForm({
    name: props.student.name,
    lastname: props.student.lastname,
    identification: props.student.identification,
    date_of_birth: props.student.date_of_birth,
    email: props.student.email,
    banner_code: props.student.banner_code,
    sex: sex,
    course_name: props.student.course_name,
    academic_period_start_id: startPeriod,
});

function selectedSex() {
    if (props.student.sex == 0) {
        sex.value = "FEMENINO";
    } else {
        sex.value = "MASCULINO";
    }
}
selectedSex();


</script>
