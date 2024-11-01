<template>
    <div class="flex flex-col gap-4 justify-center h-full mb-3">
        <div class="grid grid-cols-12 gap-2 h-full">
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputApellidos">Apellidos</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.lastname" id="inputApellidos" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputNombres">Nombres</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.name" id="inputNombres" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputEmail">Email</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.email" id="inputEmail" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputIdentificacion">Identificación</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.identification" id="inputIdentificacion" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputCodigoBanner">Código de banner</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.banner_code" id="inputCodigoBanner" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputFechaDeNacimiento">Fecha de nacimiento</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.date_of_birth" id="inputFechaDeNacimiento" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputSexo">Sexo</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="sex" id="inputSexo" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputCarrera">Carrera</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.course_id" id="inputCarrera" size="small" fluid disabled />
            </div>
            <label class="flex items-center col-span-12 md:col-span-2 md:mb-0 h-full" for="inputInicioEstudios">Inicio de estudios</label>
            <div class="col-span-12 md:col-span-10 mb-2">
                <InputText v-model="form.academic_period_start_id" id="inputInicioEstudios" size="small" fluid disabled />
            </div>
        </div>
    </div>
</template>

<script setup>
import InputText from "primevue/inputtext";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    student: Object,
});

const sex = ref("");
const form = useForm({
    name: props.student.name,
    lastname: props.student.lastname,
    identification: props.student.identification,
    date_of_birth: props.student.date_of_birth,
    email: props.student.email,
    banner_code: props.student.banner_code,
    sex: sex,
    academic_period_start_id: props.student.academic_period_start_id,
    course_id: props.student.course_id,
});

function selectedSex() {
    if (form.sex == 0) {
        sex.value = "Femenino";
    } else {
        sex.value = "Masculino";
    }
}

selectedSex();
</script>
