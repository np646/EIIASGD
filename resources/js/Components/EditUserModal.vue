<template>
    <Dialog 
        :visible="modelValue" 
        @update:visible="$emit('update:modelValue', $event)"
        modal 
        header="Editar Usuario" 
        :style="{ width: '30rem' }"
    >
        <form @submit.prevent="updateUser" class="flex flex-col gap-4">
            <div class="field">
                <label for="edit-name">Nombre</label>
                <InputText 
                    id="edit-name" 
                    v-model="form.name" 
                    required 
                    class="w-full"
                />
            </div>
            
            <div class="field">
                <label for="edit-email">Correo</label>
                <InputText 
                    id="edit-email" 
                    v-model="form.email" 
                    required 
                    type="email" 
                    class="w-full"
                />
            </div>
            
            <div class="flex justify-end gap-2">
                <Button 
                    type="button" 
                    label="Cancelar" 
                    severity="secondary" 
                    @click="closeModal"
                />
                <Button 
                    type="submit" 
                    label="Guardar" 
                    :loading="loading"
                />
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { useToast } from 'primevue/usetoast';

const props = defineProps({
    modelValue: Boolean,
    userData: {
        type: Object,
        default: () => ({})
    }
});

const emit = defineEmits(['update:modelValue', 'user-updated']);

const toast = useToast();
const loading = ref(false);
const form = ref({
    name: '',
    email: '',
    status: 1
});

watch(() => props.userData, (newData) => {
    if (newData) {
        form.value = { ...newData };
    }
}, { immediate: true });

const updateUser = async () => {
    loading.value = true;
    try {
        const response = await axios.put(`/api/users/${props.userData.id}`, form.value);
        emit('user-updated', response.data);
        toast.add({ 
            severity: 'success', 
            summary: 'Success', 
            detail: 'Usuario actualizado exitosamente', 
            life: 3000 
        });
        closeModal();
    } catch (error) {
        console.error('Error updating user:', error);
        toast.add({ 
            severity: 'error', 
            summary: 'Error', 
            detail: 'No fue posible actualizar el usuario', 
            life: 3000 
        });
    } finally {
        loading.value = false;
    }
};

const closeModal = () => {
    form.value = { name: '', email: '', status: 1 };
    emit('update:modelValue', false);
};
</script>