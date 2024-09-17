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
    form.post(route("students.store")), {
        onFinish: () => form.reset(),
    };
};
</script>

<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <h1>Create Student</h1>
            <form @submit.prevent="submit">
                <div>
                    <label>Nombres:</label>
                    <input v-model="form.name" type="text" />
                </div>
                <div>
                    <label>Apellidos:</label>
                    <input v-model="form.lastname" type="text" />
                </div>
                <div>
                    <label>Fecha de nacimiento:</label>
                    <input v-model="form.date_of_birth" type="text" />
                </div>
                <div>
                    <label>Identificación: </label>
                    <input v-model="form.identification" type="text" />
                </div>
                <div>
                    <label>Email:</label>
                    <input v-model="form.email" type="email" />
                </div>
                <div>
                    <label>Código de Banner</label>
                    <input v-model="form.banner_code" type="text" />
                </div>
                <div>
                    <label>Sexo:</label>
                    <input v-model="form.sex" type="number" />
                </div>
                <div>
                    <label>Estado:</label>
                    <input v-model="form.status" type="number" />
                </div>
                <button type="submit">Save</button>
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
