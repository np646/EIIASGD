<template v-slot:slot-content>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <form @submit.prevent="submit">
                <div class="row g-3 mb-4 px-5 pt-4">
                    <div class="col-6">
                        <label for="inputApellidos" class="col-form-label">Apellidos</label>
                        <InputText class="form-control" v-model="form.lastname" id="inputApellidos" required />
                    </div>
                    <div class="col-6">
                        <label for="inputNombres" class="col-form-label">Nombres</label>
                        <InputText class="form-control" v-model="form.name" id="inputNombres" required />
                    </div>
                </div>
                <div class="row g-3 mb-4 px-5">
                    <div class="col-6">
                        <label for="inputEmail" class="col-form-label">Email</label>
                        <InputText class="form-control" v-model="form.email" type="email" id="inputEmail" required />
                    </div>
                    <div class="col-6">
                        <label for="inputIdentificacion" class="col-form-label">Identificación</label>
                        <InputText class="form-control" v-model="form.identification" id="inputIdentificacion" required />
                    </div>
                </div>
                <div class="row g-3 mb-4 px-5">
                    <div class="col-6">
                        <label for="inputFechaDeNacimiento" class="col-form-label">Fecha de nacimiento</label>
                        <Datepicker v-model="form.date_of_birth" id="inputFechaDeNacimiento" required />
                    </div>
                    <div class="col-6">
                        <label for="inputSelectSexo" class="col-form-label">Sexo</label>
                        <Select class="w-100" id="inputSelectSexo" :options="sex" :optionLabel="label" v-model="selectedSex" />
                    </div>
                </div>
                <div class="row g-3 mb-4 px-5">
                    <div class="col-6">
                        <label for="inputCodigoBanner" class="col-form-label">Código de Banner</label>
                        <InputText class="form-control" v-model="form.banner_code" id="inputCodigoBanner" required />
                    </div>
                    <div class="col-6">
                        <label for="inputSelectCarrera" class="col-form-label">Carrera</label>
                        <Select id="inputSelectCarrera" v-model="selectedCourse" :options="courses" optionLabel="name" class="w-100" />
                    </div>
                </div>
                <div class="row g-3 mt-2 mb-4 px-5">
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
const title = "Editar información del estudiante";
const label = "sex";
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
    form.put(route("students.update", student.id));
};

const cancel = () => {
    router.visit("/students");
};
</script>
