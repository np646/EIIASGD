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
        </div>
    </div>
</template>

<script setup>
import InputText from "primevue/inputtext";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    professor: Object,
});

const form = useForm({
    name: props.professor.name,
    lastname: props.professor.lastname,
    date_of_birth: props.professor.date_of_birth,
    identification: props.professor.identification,
    email: props.professor.email,
});

</script>
