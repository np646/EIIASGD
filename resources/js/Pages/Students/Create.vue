<script setup>
import { useForm } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";

const form = useForm({
    name: "",
    lastname: "",
    date_of_birth: "",
    identification: "",
    email: "",
    banner_code: "",
    sex: "",
    status: "",
});

const submit = () => {
    form.post(route("students.store")),
        {
            onFinish: () => form.reset(),
        };
};
</script>

<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <h1>Registrar nuevo estudiante</h1>
            <form @submit.prevent="submit" class="row g-3">
                <div class="col-md-6">
                    <label for="inputNombres" class="form-label">Nombres:</label>
                    <input v-model="form.name" type="text" class="form-control" id="inputNombres" required />
                </div>
                <div class="col-md-6">
                    <label for="inputApellidos" class="form-label">Apellidos:</label>
                    <input v-model="form.lastname" type="text" class="form-control" id="inputApellidos" required />
                </div>
                <div class="col-md-6">
                    <label for="inputFechaDeNacimiento" class="form-label">Fecha de nacimiento:</label>
                    <input v-model="form.date_of_birth" type="date" class="form-control" id="inputFechaDeNacimiento" required />
                </div>
                <div class="col-md-6">
                    <label for="inputIdentificacion" class="form-label">Identificación: </label>
                    <input v-model="form.identification" type="text" class="form-control" id="inputIdentificacion" required />
                </div>
                <div class="col-md-6">
                    <label for="inputEmail" class="form-label">Email:</label>
                    <input v-model="form.email" type="email" class="form-control" id="inputEmail" required />
                </div>
                <div class="col-md-6">
                    <label for="inputCodigoBanner" class="form-label">Código de Banner:</label>
                    <input v-model="form.banner_code" type="text" class="form-control" id="inputCodigoBanner" required />
                </div>
                <!-- <div>
                    <label>Sexo:</label>
                    <input v-model="form.sex" type="number" />
                </div> -->
                <div class="col-md-6">
                    <label for="selectSexo" class="form-label">Sexo:</label>
                    <select id="selectSexo" class="form-select" required v-model="form.sex">
                        <option>Femenino</option>
                        <option>Masculino</option>
                    </select>
                </div>
                <div>
                    <label>Estado:</label>
                    <input v-model="form.status" type="number" />
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </MenuLayout>
</template>

<style scoped>
/* TODO: should be global styles for the stuff inside slot */
.profile-info {
    max-width: 800px;
    padding-top: 20px;
    padding-left: 40px;
}
</style>
