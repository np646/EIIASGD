<template>
    <Dialog :visible="modelValue" @update:visible="$emit('update:modelValue', $event)" modal header="Editar" :style="{ width: '30rem' }">
        <form @submit.prevent="updateItem" class="flex flex-col gap-4">
            <div class="field">
                <label for="edit-name">Nombre del proyecto</label>
                <InputText id="edit-name" v-model="form.name" required class="w-full" />
            </div>
            <div class="field">
                <label for="edit-periodo">Periodo académico</label>
                <Select id="edit-period" v-model="selectedPeriod" :options="periods" optionLabel="period" class="w-100" />
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
import Select from "@/Components/Select.vue";
import { useToast } from "primevue/usetoast";
import { usePage } from "@inertiajs/vue3";
import { useComputeSelectedOption } from "@/Composables/useComputeSelectedOption";

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
const periods = ref(usePage().props.periods);

const form = ref({
    name: "",
    academic_period_id: "",
});

const selectedPeriod = ref(null);

watch(
    () => props.itemData,
    (newData) => {
        if (newData) {
            form.value = { ...newData };
            selectedPeriod.value = useComputeSelectedOption(props.itemData.academic_period_id, periods);
            if (selectedPeriod.value) {
                form.value.academic_period_id = selectedPeriod.value.id;
            }
        }
    },
    { immediate: true }
);


watch(selectedPeriod, (newPeriod) => {
    if (newPeriod) {
        form.value.academic_period_id = newPeriod;
    } else {
        form.value.academic_period_id = "";
    }
});
const updateItem = async () => {
    loading.value = true;
    try {
        const response = await axios.put(route("api.community.projects.update", { project: props.itemData.id }), form.value);
        emit("item-updated", response.data);
        toast.add({
            severity: "success",
            summary: "Éxito",
            detail: "Ha sido actualizado exitosamente.",
            life: 3000,
        });
        closeModal();
    } catch (error) {
        console.error("Error updating item:", error);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible actualizar el proyecto.",
            life: 3000,
        });
    } finally {
        loading.value = false;
    }
};

const closeModal = () => {
    form.value = { name: "", academic_period_id: "" };
    selectedPeriod.value = null;
    emit("update:modelValue", false);
};
</script>
