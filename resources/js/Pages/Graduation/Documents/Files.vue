<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <ContentContainer>
            <div>
                <div class="pl-5">
                    <div class="row h-[8rem]">
                        <div class="col-2 d-flex flex-column justify-content-center">
                            <div class="h-ful">
                                <div class="row">
                                    <div class="col d-flex justify-content-center align-items-center">
                                        <BIconPersonFill style="font-size: 100px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 d-flex flex-column justify-content-center">
                            <div class="h-ful">
                                <div class="row">
                                    <div class="col">
                                        <div class="row mb-2">
                                            <span class="fs-6">{{ student.original.fullname }}</span>
                                        </div>
                                        <div class="row mb-2">
                                            <span class="fs-6">{{ student.original.identification }}</span>
                                        </div>
                                        <div class="row">
                                            <ButtonGroup>
                                                <Button label="Ir a perfil" icon="pi pi-pencil" severity="contrast" size="small" @click="redirect"></Button>
                                            </ButtonGroup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ContentContainer>
        <ContentContainer>
            <div class="flex flex-col gap-4 justify-center h-full mb-3">
                <DataTable :value="requiredFiles" class="w-full">
                    <Column header="Documentación" field="file" />
                    <Column :exportable="false" header="Abrir" bodyStyle="text-align: center" headerStyle="width: 3rem; text-align: center">
                        <template #body="slotProps">
                            <!-- <Link>
                                <Button class="mr-2" icon="pi pi-search-plus" severity="secondary" outlined rounded />
                            </Link> -->
                        </template>
                    </Column>
                    <Column :exportable="false" header="Cargar" bodyStyle="text-align: center;" headerStyle="width: 3rem; text-align: center">
                        <template #body="slotProps">
                            <Button class="mr-2" icon="pi pi-pencil" severity="success" outlined rounded @click="openUpdateDialog(slotProps.data.id)" />
                            <Dialog v-model:visible="visibleUpdate" modal header="Cargar archivo" :style="{ width: '25rem' }">
                                <form @submit.prevent="uploadFile">
                                    <div>
                                        <input v-model="form.name" type="text" placeholder="Nombre del archivo o carpeta" required />
                                    </div>
                                    <input ref="fileInput" type="file" @change="handleFileChange" />
                                    <div class="flex justify-end gap-2 mt-4">
                                        <Button type="button" label="Cancelar" severity="secondary" @click="visibleUpdate = false"></Button>
                                        <Button type="submit" label="Guardar" severity="success"></Button>
                                    </div>
                                </form>
                            </Dialog>
                        </template>
                    </Column>
                    <Column :exportable="false" header="Eliminar" bodyStyle="text-align: center;" headerStyle="width: 3rem; text-align: center">
                        <template #body="slotProps">
                            <Button class="mr-2" icon="pi pi-trash" outlined rounded severity="danger" @click="openDeleteDialog(slotProps.data.id)" />
                            <Dialog v-model:visible="visibleDelete" modal header="Eliminar" :style="{ width: '25rem' }">
                                <span class="text-surface-500 dark:text-surface-400 block mb-8">¿Está seguro que desea continuar?</span>
                                <form @submit.prevent="submit">
                                    <input value="0" class="form-control" id="inputStatus" required hidden />
                                    <div class="flex justify-end gap-2">
                                        <Button type="button" label="Cancelar" severity="secondary" @click="visibleDelete = false"></Button>
                                        <Button type="submit" label="Eliminar" severity="danger"></Button>
                                    </div>
                                </form>
                            </Dialog>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Button from "primevue/button";
import ButtonGroup from "primevue/buttongroup";
import { router } from "@inertiajs/vue3";
import { BIconPersonFill } from "bootstrap-icons-vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref } from "vue";
import Dialog from "primevue/dialog";
import FileUpload from "primevue/fileupload";
import { usePage } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    is_folder: false,
    parent_id: null,
    file: null,
});

const fileInput = ref(null);

const handleFileChange = (event) => {
    form.file = event.target.files[0];
    console.log("Selected file:", form.file); // Log the file
};

const student = usePage().props.student;
const files = usePage().props.files;

const requiredFiles = ref([
    { file: "Certificación internacional" },
    { file: "Certificación de inglés" },
    { file: "Certificación de prácticas de Vinculación" },
    { file: "Certificación de prácticas Preprofesionales" },
    { file: "Solicitud de modalidad de titulación" },
    { file: "Solicitud de aprobación de plan de titulación" },
    { file: "Solicitud de asignación de lectores" },
]);
function redirect() {
    router.visit("/graduation/process/" + student.original.id);
}
const visibleDelete = ref(false);
const removeId = ref(null);
const openDeleteDialog = (id) => {
    removeId.value = id;
    visibleDelete.value = true;
};

const visibleUpdate = ref(false);
const openUpdateDialog = (id) => {
    visibleUpdate.value = true;
};

const onAdvancedUpload = () => {
    toast.add({ severity: "info", summary: "Success", detail: "File Uploaded", life: 3000 });
};

const uploadFile = () => {
    form.post(
        route("graduationfiles.storeFile", {
            parentId: 1,
            student_id: 1,
        }), {
        onSuccess: () => {
            alert("Archivo o carpeta subido con éxito");
            form.reset();
            if (fileInput.value) {
                fileInput.value.value = null;
            }
        },
        onError: (errors) => {
            console.error("Error al subir el archivo:", errors);
            alert("Error al subir el archivo");
        },
    });
};
</script>
