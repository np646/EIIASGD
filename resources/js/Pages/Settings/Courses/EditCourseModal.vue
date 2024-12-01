<template>
    <Dialog :visible="modelValue" @update:visible="$emit('update:modelValue', $event)" modal header="Editar" :style="{ width: '30rem' }">
        <form @submit.prevent="updateItem" class="flex flex-col gap-4">
            <div class="field">
                <label for="edit-name">Carrera</label>
                <InputText id="edit-name" v-model="form.name" required class="w-full" />
            </div>
            <div class="field">
                <label for="edit-bannerid">Código de banner</label>
                <InputText id="edit-bannerid" v-model="form.banner_id" required class="w-full" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="closeModal" />
                <Button type="submit" label="Guardar" :loading="loading" />
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { ref, watch } from "vue";
import axios from "axios";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import { useToast } from "primevue/usetoast";

const props = defineProps({
    modelValue: Boolean,
    itemData: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(["update:modelValue", "item-updated"]);

const toast = useToast();
const loading = ref(false);
const form = ref({
    name: "",
    banner_id: "",
});

watch(
    () => props.itemData,
    (newData) => {
        if (newData) {
            form.value = { ...newData };
        }
    },
    { immediate: true }
);

const updateItem = async () => {
    loading.value = true;
    try {
        const response = await axios.put(`/api/courses/${props.itemData.id}`, form.value);
        emit("item-updated", response.data);
        console.log("response", response.data);
        console.log("form", form.value);
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Ha sido actualizado exitosamente.",
            life: 3000,
        });
        closeModal();
    } catch (error) {
        console.error("Error updating item:", error);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible actualizar.",
            life: 3000,
        });
    } finally {
        loading.value = false;
    }
};

const closeModal = () => {
    form.value = { name: "", banner_id: "" };
    emit("update:modelValue", false);
};
</script>
