<template>
    <Dialog :visible="modelValue" @update:visible="$emit('update:modelValue', $event)" modal header="Crear nuevo" :style="{ width: '30rem' }">
        <form @submit.prevent="createItem" class="flex flex-col gap-4">
            <div class="field">
                <label for="edit-area">Área de titulación</label>
                <InputText id="edit-area" v-model="form.area" required class="w-full" />
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
    area: "",
    status: 1,
});

const createItem = async () => {
    loading.value = true;
    try {
        const response = await axios.post("/api/areas-titulacion", form.value);
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
            detail: "No fue posible crear el área.",
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
