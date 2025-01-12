<template>
    <Dialog :visible="modelValue" @update:visible="$emit('update:modelValue', $event)" modal header="Agregar estudiante" :style="{ width: '30rem' }">
        <form @submit.prevent="addItem" class="flex flex-col gap-4">
            <div class="field">
                <label for="select-estudiante">Estudiante</label>
                <div class="col-span-9 mb-2">
                    <Select 
                        v-model="selectedStudent" 
                        id="select-estudiante" 
                        :options="students" 
                        filter 
                        optionLabel="name"
                        class="w-100"
                        @change="(e) => console.log('Select changed:', e.value)"
                    >
                        <template #value="slotProps">
                            <div v-if="slotProps.value" class="flex items-center">
                                <div>{{ slotProps.value.name }}</div>
                            </div>
                            <span v-else>
                                {{ slotProps.placeholder }}
                            </span>
                        </template>
                        <template #option="slotProps">
                            <div class="flex items-center">
                                <div>{{ slotProps.option.name }}</div>
                            </div>
                        </template>
                    </Select>
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="closeModal" />
                <Button type="submit" label="Añadir" :loading="loading" :disabled="!selectedStudent" />
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { ref, watch } from "vue";
import axios from "axios";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import { useToast } from "primevue/usetoast";
import { usePage } from "@inertiajs/vue3";
import Select from "@/Components/Select.vue";

const students = ref(usePage().props.students);
const project = usePage().props.project;
const props = defineProps({
    modelValue: Boolean,
});
const emit = defineEmits(["update:modelValue", "item-added"]);
const toast = useToast();
const loading = ref(false);


const selectedStudent = ref(null);

const addItem = async () => {
    if (!selectedStudent.value) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "Por favor seleccione un estudiante",
            life: 3000,
        });
        return;
    }

    loading.value = true;
    try {
        console.log('Sending student:', selectedStudent.value);
        console.log('Sending project:', project);

        const response = await axios.put(
            route("api.community.projects.addStudentToProject", 
            { 
                student: selectedStudent.value,
                project: project  
            })
        );

        emit("item-added", response.data);
        
        toast.add({
            severity: "success",
            summary: "Éxito",
            detail: "Estudiante agregado exitosamente.",
            life: 3000,
        });
        closeModal();
    } catch (error) {
        console.error('No fue posible agregar el estudiante. ', error);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible agregar el estudiante.",
            life: 3000,
        });
    } finally {
        loading.value = false;
    }
};

const closeModal = () => {
    selectedStudent.value = null;  // Reset selected student
    emit("update:modelValue", false);
};
</script>