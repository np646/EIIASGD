<template>
    <DataTable
        :value="data"
        stripedRows
        tableStyle="min-width: 50rem"
        ref="dt"
        removableSort
        v-model:filters="filters"
        dataKey="id"
        :globalFilterFields="globalFilters"
        paginator
        :rows="5"
        paginatorTemplate="RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
        currentPageReportTemplate="{first} - {last} de {totalRecords}"
        class="custom-datatable"
    >
        <template #header>
            <div class="flex justify-between">
                <div style="text-align: left">
                    <ModalButtonSlide @click="$emit('open-create-modal')" />
                </div>
                <IconField>
                    <InputIcon>
                        <i class="pi pi-search" />
                    </InputIcon>
                    <InputText v-model="filters['global'].value" placeholder="Buscar" class="border-color" />
                </IconField>
            </div>
        </template>
        <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable />
        <Column :exportable="false" header="Editar" bodyStyle="text-align: center"  headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Button class="mr-2" icon="pi pi-pencil" severity="success" outlined rounded @click="openEditDialog(slotProps.data)" />
            </template>
        </Column>
        <Column :exportable="false" header="Eliminar" bodyStyle="text-align: center"  headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Button icon="pi pi-trash" outlined rounded severity="danger" @click="openDeleteDialog(slotProps.data.id)" />
            </template>
        </Column>
        <Column :exportable="false" header="Ver" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Link :href="route('community.projects.studentsInProject', slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-search-plus" severity="secondary" outlined rounded />
                </Link>
            </template>
        </Column>
        <Dialog v-model:visible="showDeleteDialog" modal header="Eliminar" :style="{ width: '25rem' }">
            <span class="text-surface-500 dark:text-surface-400 block mb-8"> ¿Está seguro que desea continuar? </span>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="showDeleteDialog = false" />
                <Button type="button" label="Eliminar" severity="danger" @click="deleteItem" />
            </div>
        </Dialog>
        <EditProjectModal v-model="showEditModal" :itemData="selectedItem" @item-updated="handleItemUpdated" />
    </DataTable>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import { Link } from "@inertiajs/vue3";

import { FilterMatchMode } from "@primevue/core/api";
import { useToast } from "primevue/usetoast";
import ModalButtonSlide from "@/Components/ModalButtonSlide.vue";

import EditProjectModal from "./EditProjectModal.vue";

const props = defineProps({
    columnHeaders: Array,
    data: Array,
    pageName: String,
    globalFilters: Array,
});

const pageName = props.pageName;

const filters = ref();
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};
initFilters();

const emit = defineEmits(["item-deleted", "item-updated", "open-create-modal"]);

const toast = useToast();
const showDeleteDialog = ref(false);
const showEditModal = ref(false);
const itemToDelete = ref(null);
const selectedItem = ref(null);

const openDeleteDialog = (id) => {
    itemToDelete.value = id;
    showDeleteDialog.value = true;
};

const deleteItem = async () => {
    try {
        await axios.put(route(`api.${pageName}.remove`, { id: itemToDelete.value }));
        emit("item-deleted", itemToDelete.value);
        showDeleteDialog.value = false;
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Ha sido eliminado exitosamente.",
            life: 3000,
        });
    } catch (error) {
        console.error("No fue posible eliminar el usuario. ", error);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible eliminar el usuario.",
            life: 3000,
        });
    }
};

const openEditDialog = (itemData) => {
    selectedItem.value = { ...itemData };
    showEditModal.value = true;
};

const handleItemUpdated = (updatedItem) => {
    emit("item-updated", updatedItem);
};
</script>
<style>
.p-datatable tbody tr:nth-child(even) {
    --p-datatable-row-striped-background: rgb(237, 237, 252);
}
</style>
