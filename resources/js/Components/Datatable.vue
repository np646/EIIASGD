<template v-slot:slot-content>
    <DataTable
        :value="data"
        tableStyle="min-width: 50rem"
        stripedRows
        ref="dt"
        removableSort
        v-model:filters="filters"
        dataKey="id"
        :globalFilterFields="globalFilters"
        paginator
        :rows="5"
        paginatorTemplate="RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
        currentPageReportTemplate="{first} - {last} de {totalRecords}"
        :perfil="perfil"
        class="custom-datatable p-datatable-striped"
    >
        <template #header>
            <div class="flex justify-between">
                <div style="text-align: left">
                    <ButtonSlide :pageName="generateRoute('create')" />
                </div>
                <IconField>
                    <InputIcon>
                        <i class="pi pi-search" />
                    </InputIcon>
                    <InputText v-model="filters['global'].value" placeholder="Buscar" class="border-color" />
                </IconField>
            </div>
        </template>
        <template #empty> No se han encontrado los datos. </template>

        <Column v-for="column in columnHeaders" :key="column.field" :field="column.field" :header="column.header" sortable></Column>

        <Column :exportable="false" header="Editar" bodyStyle="text-align: center" headerStyle="width: 3rem; text-align: center">
            <template #body="slotProps">
                <Link :href="generateRoute('edit', slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-pencil" severity="success" outlined rounded />
                </Link>
            </template>
        </Column>
        <Column :exportable="false" header="Eliminar" bodyStyle="text-align: center;" headerStyle="width: 3rem; text-align: center">
            <template #body="slotProps">
                <Button class="mr-2" icon="pi pi-trash" outlined rounded severity="danger" @click="openDeleteDialog(slotProps.data.id)" />
                <Dialog v-model:visible="showDeleteDialog" modal header="Eliminar" :style="{ width: '25rem' }">
                    <span class="text-surface-500 dark:text-surface-400 block mb-8"> ¿Está seguro que desea continuar? </span>
                    <div class="flex justify-end gap-2">
                        <Button type="button" label="Cancelar" severity="secondary" @click="showDeleteDialog = false" />
                        <Button type="button" label="Eliminar" severity="danger" @click="deleteItem" />
                    </div>
                </Dialog>
            </template>
        </Column>
        <Column :exportable="false" header="Perfil" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Link :href="generateRoute('profile', slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-search-plus" severity="secondary" outlined rounded />
                </Link>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, defineEmits } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import { FilterMatchMode } from "@primevue/core/api";
import "primeicons/primeicons.css";
import ButtonSlide from "./ButtonSlide.vue";
import Dialog from "primevue/dialog";
import { useToast } from "primevue/usetoast";
import axios from "axios";

const filters = ref();
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};

const props = defineProps({
    columnHeaders: Array,
    globalFilters: Array,
    data: Object,
    pageName: String,
    slotProps: Object,
    perfil: Boolean,
});

initFilters();

// To generate routes based on page name
const generateRoute = (action, id = null) => {
    if (id) {
        return route(`${props.pageName}.${action}`, id);
    }
    return route(`${props.pageName}.${action}`);
};

// To delete
const emit = defineEmits(["item-deleted"]);

const toast = useToast();
const showDeleteDialog = ref(false);
const itemToDelete = ref(null);
const openDeleteDialog = (id) => {
    itemToDelete.value = id;
    showDeleteDialog.value = true;
};

const deleteItem = async () => {
    try {
        await axios.delete(`/api/${props.pageName}/${itemToDelete.value}`);
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
</script>
<style>
:root {
    --p-datatable-row-striped-background: var(--softer-border-color);
}
</style>