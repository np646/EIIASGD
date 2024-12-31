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
                    <ModalButtonSlide @click="$emit('open-add-modal')" />
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
        <Column :exportable="false" header="Informe" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <i :class="isNull(slotProps.data.student_report_id)" :style="getColor(slotProps.data.student_report_id)"></i>
            </template>
        </Column>
        <Column :exportable="false" header="Ver proceso" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Link :href="generateProcessRoute(slotProps.data)">
                    <Button class="mr-2" icon="pi pi-search-plus" severity="secondary" outlined rounded />
                </Link>
            </template>
        </Column>
        <Column :exportable="false" header="Quitar" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Button icon="pi pi-trash" outlined rounded severity="danger" @click="openDeleteDialog(slotProps.data.id)" />
            </template>
        </Column>
        <Dialog v-model:visible="showDeleteDialog" modal header="Quitar estudiante del proyecto" :style="{ width: '25rem' }">
            <span class="text-surface-500 dark:text-surface-400 block mb-8"> ¿Está seguro que desea continuar? </span>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="showDeleteDialog = false" />
                <Button type="button" label="Quitar" severity="danger" @click="deleteItem" />
            </div>
        </Dialog>
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

const emit = defineEmits(["item-deleted", "open-add-modal"]);
const loading = ref(false);

const toast = useToast();
const showDeleteDialog = ref(false);
const itemToDelete = ref(null);

const generateProcessRoute = (data) => {
    console.log('Generating route for:', data); // Debug log
    return route('community.process', { id: data.id });
};

const openDeleteDialog = (id) => {
    itemToDelete.value = id;
    showDeleteDialog.value = true;
};

const deleteItem = async () => {
    loading.value = true;
    try {
        await axios.put(route("api.community.projects.removeStudentFromProject", { student: itemToDelete.value }));
        emit("item-deleted", itemToDelete.value);
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Ha sido actualizado exitosamente.",
            life: 3000,
        });
        showDeleteDialog.value = false;
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

const isNull = (value) => {
    if (value == null) {
        return "pi pi-times";
    } else {
        return "pi pi-check";
    }
};

const getColor = (value) => {
    if (value == null) {
        return { color: "red" };
    } else {
        return { color: "green" };
    }
};
</script>
<style>
.p-datatable tbody tr:nth-child(even) {
    --p-datatable-row-striped-background: rgb(237, 237, 252);
}
</style>
