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
        <Column :exportable="false" header="Eliminar"  bodyStyle="text-align: center;" headerStyle="width: 3rem; text-align: center">
            <template #body="slotProps">
                <Button class="mr-2" icon="pi pi-trash" outlined rounded severity="danger" @click="openDeleteDialog(slotProps.data.id)" />
                <Dialog v-model:visible="visible" modal header="Eliminar" :style="{ width: '25rem' }">
                    <span class="text-surface-500 dark:text-surface-400 block mb-8">¿Está seguro que desea continuar?</span>
                    <form @submit.prevent="submit">
                        <input value="0" class="form-control" id="inputStatus" required hidden />
                        <div class="flex justify-end gap-2">
                            <Button type="button" label="Cancelar" severity="secondary" @click="visible = false"></Button>
                            <Button type="submit" label="Eliminar" severity="danger"></Button>
                        </div>
                    </form>
                </Dialog>
            </template>
        </Column>
        <Column  v-if=perfil :exportable="false" header="Perfil" bodyStyle="text-align: center" headerStyle="width: 1rem; text-align: center">
            <template #body="slotProps">
                <Link :href="generateRoute('profile', slotProps.data.id)">
                    <Button class="mr-2" icon="pi pi-search-plus" severity="secondary" outlined rounded />
                </Link>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
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

const visible = ref(false);
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
const removeId = ref(null);
const generateRoute = (action, id = null) => {
    if (id) {
        return route(`${props.pageName}.${action}`, id);
    }
    return route(`${props.pageName}.${action}`);
};

// To delete
const emit = defineEmits(["remove-id"]);

const form = useForm({
    status: 0,
});

const openDeleteDialog = (id) => {
    removeId.value = id;
    visible.value = true;
};

const submit = () => {
    if (removeId.value !== null) {
        form.put(generateRoute("remove", removeId.value), {
            onSuccess: () => {
                emit("remove-id", removeId.value);
                removeId.value = null;
                visible.value = false;
            },
        });
    } else {
        console.error("No fue posible eliminar el ID.");
    }
};
</script>
<style>

.custom-datatable tbody tr:nth-child(even) {
    background-color: var(--primary-color-100);
}
</style>