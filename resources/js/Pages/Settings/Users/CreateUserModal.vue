<template>
    <Dialog :visible="modelValue" @update:visible="$emit('update:modelValue', $event)" modal header="Crear usuario" :style="{ width: '30rem' }">
        <form @submit.prevent="createItem" class="flex flex-col gap-4">
            <div class="field">
                <label for="name">Usuario</label>
                <InputText id="name" v-model="form.name" required class="w-full" />
            </div>

            <div class="field">
                <label for="email">Correo</label>
                <InputText id="email" v-model="form.email" required type="email" class="w-full" />
            </div>
            <div class="field">
                <label for="email">Contraseña</label>
                <InputText id="password" v-model="form.password" required type="password" class="w-full" />
            </div>

            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="closeModal" />
                <Button type="submit" label="Crear" :loading="loading" />
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import { useToast } from "primevue/usetoast";

const props = defineProps({
    modelValue: Boolean,
});

const emit = defineEmits(["update:modelValue", "item-created"]);

const toast = useToast();
const loading = ref(false);
const form = ref({
    name: "",
    email: "",
    password: "",
    status: 1,
});

const createItem = async () => {
    loading.value = true;
    try {
        const response = await axios.post(route('api.users.store'), form.value);
        emit("item-created", response.data);
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Ha sido creado exitosamente",
            life: 3000,
        });
        closeModal();
    } catch (error) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible crear el usuario.",
            life: 3000,
        });
    } finally {
        loading.value = false;
    }
};

const closeModal = () => {
    form.value = { name: "", email: "", status: 1 };
    emit("update:modelValue", false);
};
</script>
