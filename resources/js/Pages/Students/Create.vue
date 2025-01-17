<template v-slot:slot-content>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <form @submit.prevent="submit">
                <div class="row g-3 px-3 py-3">
                    <div class="col-6">
                        <label for="inputApellidos" class="col-form-label">Apellidos</label>
                        <InputText class="form-control" v-model="form.lastname" id="inputApellidos" required />
                    </div>
                    <div class="col-6">
                        <label for="inputNombres" class="col-form-label">Nombres</label>
                        <InputText class="form-control" v-model="form.name" id="inputNombres" required />
                    </div>
                </div>
                <div class="row g-3 pb-3 px-3">
                    <div class="col-12">
                        <label for="inputEmail" class="col-form-label">Email</label>
                        <InputText class="form-control" v-model="form.email" type="email" id="inputEmail" required />
                    </div>
                </div>
                <div class="row g-3 pb-3 px-3">
                    <div class="col-6">
                        <label for="inputIdentificacion" class="col-form-label">Identificación</label>
                        <InputText class="form-control" v-model="form.identification" id="inputIdentificacion" required />
                    </div>
                    <div class="col-6">
                        <label for="inputFechaDeNacimiento" class="col-form-label">Fecha de nacimiento</label>
                        <Datepicker v-model="form.date_of_birth" id="inputFechaDeNacimiento" required />
                    </div>
                </div>
                <div class="row g-3 pb-3 px-3">
                    <div class="col-6">
                        <label for="inputSelectSexo" class="col-form-label">Sexo</label>
                        <Select class="w-100" id="inputSelectSexo" :options="sex" optionLabel="sex" v-model="selectedSex" />
                    </div>
                    <div class="col-6">
                        <label for="inputCodigoBanner" class="col-form-label">Código de Banner</label>
                        <InputText class="form-control" v-model="form.banner_code" id="inputCodigoBanner" required />
                    </div>
                </div>
                <div class="row g-3 pb-3 px-3">
                    <div class="col-6">
                        <label for="inputSelectCarrera" class="col-form-label">Carrera</label>
                        <Select id="inputSelectCarrera" v-model="selectedCourse" :options="courses" optionLabel="name" class="w-100" required />
                    </div>
                    <div class="col-6">
                        <label for="inputInicio" class="col-form-label">Periodo de inicio de estudios</label>
                        <Select id="inputInicio" v-model="selectedStartPeriod" :options="periods" optionLabel="period" class="w-100" required />
                    </div>
                </div>
                <div class="row g-3 py-3 px-3">
                    <div class="col d-flex justify-content-center">
                        <Button label="Cancelar" icon="pi pi-times" type="button" severity="secondary" @click="cancel" />
                    </div>
                    <div class="col d-flex justify-content-center">
                        <Button label="Guardar" icon="pi pi-check" type="submit" severity="success" />
                    </div>
                </div>
            </form>
        </ContentContainer>
    </MenuLayout>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import { useForm, usePage, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import InputText from "primevue/inputtext";
import Datepicker from "@/Components/Datepicker.vue";
import Select from "@/Components/Select.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
const courses = ref(usePage().props.courses);
const periods = ref(usePage().props.periods);
import { useToast } from "primevue/usetoast";
const toast = useToast();

const title = "Registrar nuevo estudiante";
const selectedSex = ref(null);
const selectedCourse = ref(null);
const selectedStartPeriod = ref(null);

const form = useForm({
    name: "",
    lastname: "",
    date_of_birth: "",
    identification: "",
    email: "",
    banner_code: "",
    sex: null,
    course_id: null,
    academic_period_start_id: null,
});

// To get the selected sex option
const sex = ref([
    { id: 0, sex: "FEMENINO" },
    { id: 1, sex: "MASCULINO" },
]);

// Watch handlers with proper error state handling
watch(selectedSex, (newValue) => {
    form.sex = newValue; // This should now work
    console.log("Selected sex:", newValue); // To debug the selected value
    console.log("Form sex value:", form.sex); // To debug the form value
});

watch(selectedCourse, (newValue) => {
    form.course_id = newValue;
});

watch(selectedStartPeriod, (newValue) => {
    form.academic_period_start_id = newValue;
});

const submit = () => {
    form.post(route("students.store"), {
        onError: (errors) => {
            Object.keys(errors).forEach((key) => {
                toast.add({
                    severity: "error",
                    summary: "Validation Error",
                    detail: errors[key].join(", "),
                    life: 3000,
                });
            });
            if (errors.sex) selectedSex.value = null;
            if (errors.course_id) selectedCourse.value = null;
            if (errors.academic_period_start_id) selectedStartPeriod.value = null;
        },
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Éxito",
                detail: "Estudiante registrado correctamente.",
                life: 3000,
            });
            resetForm();
        },
    });
};

const cancel = () => {
    resetForm();
    router.visit(route("students.index"));
};

const resetForm = () => {
    form.reset();
    selectedSex.value = null;
    selectedCourse.value = null;
    selectedStartPeriod.value = null;
};
</script>
