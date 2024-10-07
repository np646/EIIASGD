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
                        <label for="inputFechaDeNacimiento" class="col-form-label">Fecha de nacimiento</label>
                        <Datepicker v-model="selectedDate" id="inputFechaDeNacimiento" required />
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row g-3 mt-2 mb-4">
                    <div class="col"></div>
                    <div class="col d-flex justify-content-center">
                        <Button label="Guardar" icon="pi pi-check" type="submit" severity="success"/>
                    </div>
                    <div class="col"></div>
                </div>
        </form>
    </ContentContainer>
    </MenuLayout>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import InputText from "primevue/inputtext";
import Datepicker from "@/Components/Datepicker.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";

const title = "Registrar nuevo docente";
const selectedDate = ref(null);


const form = useForm({
    name: "",
    lastname: "",
    date_of_birth: selectedDate,
    identification: "",
    email: "",
    status: 1,
});

// Watch for changes in selectedDate value
watch(selectedDate, () => {
    form.date_of_birth = selectedDate.value;
});

const submit = () => {
    form.post(route("professors.store")),
        {
            onFinish: () => form.reset(),
        };
};
</script>