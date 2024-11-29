<template>
    <DataTable :value="data" stripedRows tableStyle="min-width: 50rem">
        <template #header>
            <div class="flex justify-between">
                <div style="text-align: left">
                    <Button label="Crear Usuario" icon="pi pi-plus" @click="$emit('open-create-modal')" />
                </div>
            </div>
        </template>

        <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable />

        <Column :exportable="false" header="Acciones" bodyStyle="text-align: center" headerStyle="width: 8rem; text-align: center">
            <template #body="slotProps">
                <Button class="mr-2" icon="pi pi-pencil" severity="success" outlined rounded @click="openEditDialog(slotProps.data)" />
                <Button icon="pi pi-trash" outlined rounded severity="danger" @click="openDeleteDialog(slotProps.data.id)" />
            </template>
        </Column>

        <Dialog v-model:visible="showDeleteDialog" modal header="Eliminar" :style="{ width: '25rem' }">
            <span class="text-surface-500 dark:text-surface-400 block mb-8"> ¿Está seguro que desea continuar? </span>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="showDeleteDialog = false" />
                <Button type="button" label="Eliminar" severity="danger" @click="deleteUser" />
            </div>
        </Dialog>

        <EditUserModal v-model="showEditModal" :userData="selectedUser" @user-updated="handleUserUpdated" />
    </DataTable>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import { useToast } from 'primevue/usetoast';
import EditUserModal from './EditUserModal.vue';

const props = defineProps({
    columnHeaders: Array,
    data: Array,
    pageName: String,
});

const emit = defineEmits(['user-deleted', 'user-updated', 'open-create-modal']);

const toast = useToast();
const showDeleteDialog = ref(false);
const showEditModal = ref(false);
const userToDelete = ref(null);
const selectedUser = ref(null);

const openDeleteDialog = (id) => {
    userToDelete.value = id;
    showDeleteDialog.value = true;
};

const deleteUser = async () => {
    try {
        await axios.delete(`/api/users/${userToDelete.value}`);
        emit("user-deleted", userToDelete.value);
        showDeleteDialog.value = false;
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Usuario eliminado exitosamente",
            life: 3000,
        });
    } catch (error) {
        console.error("Error deleting user:", error);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible eliminar el usuario",
            life: 3000,
        });
    }
};

const openEditDialog = (userData) => {
    selectedUser.value = { ...userData };
    showEditModal.value = true;
};

const handleUserUpdated = (updatedUser) => {
    emit('user-updated', updatedUser);
};
</script>
