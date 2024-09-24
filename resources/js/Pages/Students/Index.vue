<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <div>
                <!-- <h1>Estudiantes</h1> -->
                <Link :href="route('students.create')">Crear nuevo estudiante</Link>
                <DataTable :value="students" tableStyle="min-width: 50rem" stripedRows removableSort>
                    <Column field="lastname" header="Code" sortable></Column>
                    <Column field="name" header="Name" sortable></Column>
                    <Column field="email" header="Category" sortable></Column>
                    <Column :exportable="false" style="min-width: 12rem">
                        <template #body="slotProps">
                            <Link :href="route('students.edit', slotProps.data.id)">
                                <Button label="Edit" class="mr-2" icon="pi pi-pencil" outlined rounded />
                            </Link>
                            <!-- TODO: get delete (updating status) working -->
                            <Button label="Delete" outlined rounded severity="danger" @click="confirmDeleteProduct(slotProps.data.id)" />
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
    </MenuLayout>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import "primeicons/primeicons.css";
const { students } = usePage().props;

</script>
