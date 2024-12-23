<template v-slot:slot-content>
    <Head title="Docentes" />
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
                        <label for="inputCodigoBanner" class="col-form-label">Código de Banner</label>
                        <Datepicker v-model="form.banner_code" id="inputCodigoBanner" required />
                    </div>
                    <div class="col-6">
                        <label for="inputSelectSexo" class="col-form-label">Sexo</label>
                        <Select class="w-100" id="inputSelectSexo" :options="sex" :optionLabel="label" v-model="selectedSex" placeholder="Seleccione uno" />
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
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Select from "@/Components/Select.vue";
import { useComputeSelectedOption } from "@/Composables/useComputeSelectedOption";

const title = "Editar información del docente";
const label = "sex";

// Sex array for select component
const sex = ref([
    { id: 0, sex: "FEMENINO" },
    { id: 1, sex: "MASCULINO" },
]);


const { professor } = usePage().props;
const form = useForm({
    name: professor.name,
    lastname: professor.lastname,
    date_of_birth: professor.date_of_birth,
    identification: professor.identification,
    email: professor.email,
    banner_code: professor.banner_code,
    sex: professor.sex
});

const selectedSex = ref(null);
selectedSex.value = useComputeSelectedOption(professor.sex, sex);
form.sex = selectedSex.value.id;
watch(selectedSex, () => {
    form.sex = selectedSex.value;
});
const selectedDate = ref(null);
// Set birth date datepicker value from professor object
selectedDate.value = professor.date_of_birth;
form.date_of_birth = selectedDate;

// Watch for changes in selectedDate value
watch(selectedDate, () => {
    form.date_of_birth = selectedDate.value;
});

const submit = () => {
    form.put(route("professors.update", professor.id));
};
const cancel = () => {
    router.visit(route("professors.index"));
};
</script>
