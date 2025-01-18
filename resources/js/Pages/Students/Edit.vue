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
                        <Select id="inputSelectCarrera" v-model="selectedCourse" :options="courses" optionLabel="name" class="w-100" />
                    </div>
                    <div class="col-6">
                        <label for="inputInicio" class="col-form-label">Periodo de inicio de estudios</label>
                        <Select id="inputInicio" v-model="selectedStartPeriod" :options="periods" optionLabel="period" class="w-100" />
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
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import InputText from "primevue/inputtext";
import Datepicker from "@/Components/Datepicker.vue";
import Select from "@/Components/Select.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { useComputeSelectedOption } from "@/Composables/useComputeSelectedOption";
import { useToast } from "primevue/usetoast";
const toast = useToast();

const title = "Editar información del estudiante";
const { student } = usePage().props;
const courses = ref(usePage().props.courses);

const form = useForm({
    name: student.name,
    lastname: student.lastname,
    identification: student.identification,
    date_of_birth: student.date_of_birth,
    email: student.email,
    banner_code: student.banner_code,
    sex: student.sex,
    course_id: student.course_id,
    academic_period_start_id: student.academic_period_start_id,
});

// To load sex from student object and update it to the selected option
const sex = ref([
    { id: 0, sex: "FEMENINO" },
    { id: 1, sex: "MASCULINO" },
]);
const selectedSex = ref(null);
selectedSex.value = useComputeSelectedOption(student.sex, sex);
form.sex = selectedSex.value.id;
watch(selectedSex, () => {
    form.sex = selectedSex.value;
});

// To load course name from student object and update it to the selected option
const selectedCourse = ref(null);
selectedCourse.value = useComputeSelectedOption(student.course_id, courses);
form.course_id = selectedCourse.value.id;

watch(selectedCourse, () => {
    form.course_id = selectedCourse.value;
});

const submit = () => {
    form.put(route("students.update", student.id), {
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
                detail: "Estudiante actualizado correctamente.",
                life: 3000,
            });
        },
    });
};

const cancel = () => {
    router.visit(route("students.index"));
};

const periods = ref(usePage().props.periods);

const selectedStartPeriod = ref(null);
selectedStartPeriod.value = useComputeSelectedOption(student.academic_period_start_id, periods);
form.academic_period_start_id = selectedStartPeriod.value.id;

watch(selectedStartPeriod, () => {
    form.academic_period_start_id = selectedStartPeriod.value;
});
</script>
