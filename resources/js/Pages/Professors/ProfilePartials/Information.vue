<template>
    <div class="px-5 pt-4">
        <div class="flex flex-col gap-4 justify-center h-full mb-3">
            <div class="grid grid-cols-12 gap-3 h-full">
                <label class="flex items-center col-span-3 h-full" for="inputApellidos">Apellidos</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.lastname" id="inputApellidos" size="small" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputNombres">Nombres</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.name" id="inputNombres" size="small" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputEmail">Email</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.email" id="inputEmail" size="small" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputIdentificacion">Identificación</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.identification" id="inputIdentificacion" size="small" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputEmail">Fecha de nacimiento</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.date_of_birth" id="inputFechaDeNacimiento" size="small" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputCodigoBanner">Código de banner</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="form.banner_code" id="inputCodigoBanner" size="small" fluid disabled />
                </div>
                <label class="flex items-center col-span-3 h-full" for="inputSexo">Sexo</label>
                <div class="col-span-9 mb-2">
                    <InputText v-model="sex" id="inputSexo" size="small" fluid disabled />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import InputText from "primevue/inputtext";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    professor: Object,
});

const sex = ref("");

const form = useForm({
    name: props.professor.name,
    lastname: props.professor.lastname,
    date_of_birth: props.professor.date_of_birth,
    identification: props.professor.identification,
    email: props.professor.email,
    banner_code: props.professor.banner_code,
    sex: sex,
});

function selectedSex() {
    if (props.professor.sex == 0) {
        sex.value = "FEMENINO";
    } else {
        sex.value = "MASCULINO";
    }
}

selectedSex();
</script>
