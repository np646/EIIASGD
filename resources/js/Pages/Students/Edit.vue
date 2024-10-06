<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <form @submit.prevent="submit">
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputApellidos" class="col-form-label">Apellidos</label>
                        <InputText class="form-control" v-model="form.lastname" id="inputApellidos" required />
                    </div>
                    <div class="col">
                        <label for="inputNombres" class="col-form-label">Nombres</label>
                        <InputText class="form-control" v-model="form.name" id="inputNombres" required />
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputEmail" class="col-form-label">Email</label>
                        <InputText class="form-control" v-model="form.email" type="email" id="inputEmail" required />
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputIdentificacion" class="col-form-label">Identificación</label>
                        <InputText class="form-control" v-model="form.identification" id="inputIdentificacion" required />
                    </div>
                    <div class="col">
                        <label for="inputCodigoBanner" class="col-form-label">Código de Banner</label>
                        <InputText class="form-control" v-model="form.banner_code" id="inputCodigoBanner" required />
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputFechaDeNacimiento" class="col-form-label">Fecha de nacimiento</label>
                        <Datepicker v-model="selectedDate" id="inputFechaDeNacimiento" required />
                    </div>
                    <div class="col">
                        <label for="inputSelectSexo" class="col-form-label">Sexo</label>
                        <Select class="w-100" id="inputSelectSexo" :options="sex" :optionLabel="label" :placeholder="placeholder" v-model="selectedOption" />
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="row g-3 mt-2 mb-4">
                    <div class="col"></div>
                    <div class="col d-flex justify-content-center">
                        <Button label="Guardar" icon="pi pi-check" type="submit" />
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, watch } from "vue";
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
const placeholder = "Seleccione uno";
const { student } = usePage().props;

// Sex array for select component
const sex = ref([
    { id: 0, sex: "Femenino" },
    { id: 1, sex: "Masculino" },
]);

const selectedDate = ref(null);
const selectedOption = ref(null);

const form = useForm({
    name: student.name,
    lastname: student.lastname,
    identification: student.identification,
    date_of_birth: student.date_of_birth,
    email: student.email,
    banner_code: student.banner_code,
    sex: student.sex,
});

// Set birth date datepicker value from student object
selectedDate.value = student.date_of_birth;
form.date_of_birth = selectedDate;

// Watch for changes in selectedDate value
watch(selectedDate, () => {
    form.date_of_birth = selectedDate.value;
});

// Set sex selected option from student object
selectedOption.value = useComputeSelectedOption(student.sex, sex);
form.sex = selectedOption.value.id;

// Watch for changes in selectedOption value
watch(selectedOption, () => {
    form.sex = selectedOption.value;
});

const submit = () => {
    form.put(route("students.update", student.id));
};
</script>
