<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <div>
                <!-- <h1>Estudiantes</h1> -->
                <Link :href="route('students.create')">Crear nuevo estudiante</Link>
                <!-- TODO: change color scheme -->
                <DataTable
                    :value="students"
                    tableStyle="min-width: 50rem"
                    stripedRows
                    showGridlines
                    removableSort
                    v-model:filters="filters"
                    dataKey="id"
                    :globalFilterFields="['lastname', 'name', 'email']"
                    paginator
                    :rows="5"
                    paginatorTemplate="RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                    currentPageReportTemplate="{first} - {last} de {totalRecords}"
                >
                    <template #header>
                        <div class="flex justify-between">
                            <div style="text-align: left">
                                <Button icon="pi pi-external-link" label="Exportar" @click="exportCSV($event)" />
                            </div>
                            <IconField>
                                <InputIcon>
                                    <i class="pi pi-search" />
                                </InputIcon>
                                <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                            </IconField>
                        </div>
                    </template>
                    <template #empty> No se han encontrado los datos. </template>
                    <Column field="lastname" header="Apellido" sortable>
                        <template #body="{ data }">
                            {{ data.lastname }}
                        </template>
                        <template #filter="{ filterModel }"> <InputText v-model="filterModel.value" type="text" placeholder="Search by name" /> </template
                    ></Column>
                    <Column field="name" header="Nombre" sortable></Column>
                    <Column field="email" header="Email" sortable></Column>
                    <Column :exportable="false" style="min-width: 12rem" header="Acciones">
                        <template #body="slotProps">
                            <Link :href="route('students.edit', slotProps.data.id)">
                                <Button class="mr-2" icon="pi pi-pencil" outlined rounded />
                            </Link>
                            <!-- TODO: get delete (updating status) working -->
                            <Button class="mr-2" icon="pi pi-trash" outlined rounded severity="danger" @click="confirmDeleteProduct(slotProps.data.id)" />
                        </template>
                    </Column>
                    <Column :exportable="false" style="min-width: 12rem" header="Ver perfil">
                        <template #body="slotProps">
                            <Link :href="route('students.edit', slotProps.data.id)">
                                <Button class="mr-2" icon="pi pi-search-plus" outlined rounded />
                            </Link>
                            <!-- TODO: get delete (updating status) working -->
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
    </MenuLayout>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import "primeicons/primeicons.css";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
const { students } = usePage().props;

import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
const filters = ref();

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        lastname: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        email: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }] },
    };
};

initFilters();
</script>
