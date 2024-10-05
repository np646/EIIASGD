<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <form @submit.prevent="submit">
            <div class="col-md-6 mb-3">
                <label for="inputNombres" class="col-form-label">Nombres</label>
                <InputText class="form-control" v-model="form.name" id="inputNombres" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="inputApellidos" class="col-form-label">Apellidos</label>
                <InputText class="form-control" v-model="form.lastname" id="inputApellidos" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="inputEmail" class="col-form-label">Email</label>
                <InputText class="form-control" v-model="form.email" type="email" id="inputEmail" required />
            </div>
            <div class="row gap-3">
                <div class="col-md-3 mb-3">
                    <label for="inputIdentificacion" class="col-form-label">Identificación</label>
                    <InputText class="form-control" v-model="form.identification" id="inputIdentificacion" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="inputCodigoBanner" class="col-form-label">Código de Banner</label>
                    <InputText class="form-control" v-model="form.banner_code" id="inputCodigoBanner" required />
                </div>
            </div>
            <div class="row gap-3">
                <div class="col-md-3 mb-3">
                    <label for="inputFechaDeNacimiento" class="col-form-label">Fecha de nacimiento</label>
                    <Datepicker v-model="form.date_of_birth" @update:date="onDateUpdate" id="inputFechaDeNacimiento" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="selectSexo" class="col-form-label">Sexo</label>
                    <Select class="w-100" :options="sex" :optionLabel="label" :placeholder="placeholder" v-model="selectedOption" />
                </div>
            </div>
            <div class="col-12">
                <Button label="Guardar" icon="pi pi-check" type="submit" />
            </div>
        </form>
    </MenuLayout>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import InputText from "primevue/inputtext";
import Datepicker from "@/Components/Datepicker.vue";
import Select from "@/Components/Select.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";

const title = "Editar información de estudiante";

const { student } = usePage().props;
//TODO: getIndex from select component isnt reading the real id from the array? if id:2 it's returning 1
//TODO: fix select from create
const sex = ref([
    { id: 0, sex: "Femenino" },
    { id: 1, sex: "Masculino" },
]);
const label = "sex";
const placeholder = "Seleccione uno";

const selectedDate = ref(null);

const form = useForm({
    name: student.name,
    lastname: student.lastname,
    identification: student.identification,
    date_of_birth: student.date_of_birth,
    email: student.email,
    banner_code: student.banner_code,
    sex: student.sex,
});

const selectedOption = ref(null);

//TODO: find a better way to set the selected option
if (student.sex === 0) {
    selectedOption.value = { id: 0, sex: "Femenino" };
} else {
    selectedOption.value = { id: 1, sex: "Masculino" };
}

selectedDate.value = student.date_of_birth;
form.date_of_birth = selectedDate;
form.sex = selectedOption.value.id;

const onDateUpdate = (newDate) => {
    if (newDate instanceof Date) {
        const year = newDate.getFullYear();
        const month = String(newDate.getMonth() + 1).padStart(2, "0");
        const day = String(newDate.getDate()).padStart(2, "0");
        form.date_of_birth = `${year}-${month}-${day}`;
    } else {
        form.date_of_birth = newDate;
    }
};
console.log(form.sex);
console.log(form.date_of_birth);
const submit = () => {
    form.put(route("students.update", student.id));
};
</script>
