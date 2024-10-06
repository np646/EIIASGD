<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <form @submit.prevent="submit">
            <div class="container">
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
                        <label for="inputFechaDeNacimiento" class="col-form-label">Fecha de nacimiento</label>
                        <Datepicker v-model="selectedDate" id="inputFechaDeNacimiento" required />
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
            </div>
        </form>
    </MenuLayout>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import InputText from "primevue/inputtext";
import Datepicker from "@/Components/Datepicker.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
const title = "Editar información del docente";
const { professor } = usePage().props;
const form = useForm({
    name: professor.name,
    lastname: professor.lastname,
    date_of_birth: professor.date_of_birth,
    identification: professor.identification,
    email: professor.email,
});

const selectedDate = ref(null);
// Set birth date datepicker value from student object
selectedDate.value = professor.date_of_birth;
form.date_of_birth = selectedDate;

// Watch for changes in selectedDate value
watch(selectedDate, () => {
    form.date_of_birth = selectedDate.value;
});

const submit = () => {
    form.put(route("professors.update", professor.id));
};
</script>

<style scoped>
.container {
    border: 1px solid #e2e8f0;
    border-radius: 5px;
    padding-top: 10px;
}
</style>
