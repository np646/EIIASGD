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
                                                <Button label="Ir a perfil" icon="pi pi-user" severity="contrast" size="small" @click="visitProfile"></Button>
                                                <Button
                                                    label="Ir a proceso de graduación"
                                                    icon="pi pi-graduation-cap"
                                                    severity="contrast"
                                                    size="small"
                                                    @click="visitGraduation"
                                                ></Button>
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
                <DataTable :value="files" dataKey="id" class="w-full">
                    <Column header="Documentación" field="file" />
                    <Column :exportable="false" header="Abrir" bodyStyle="text-align: center" headerStyle="width: 3rem; text-align: center">
                        <template #body="slotProps">
                            <Button
                                v-if="slotProps.data.file_id"
                                class="mr-2"
                                icon="pi pi-search-plus"
                                severity="secondary"
                                outlined
                                rounded
                                @click="openFile(slotProps.data.file_id)"
                            />
                        </template>
                    </Column>
                    <Column :exportable="false" header="Cargar" bodyStyle="text-align: center;" headerStyle="width: 3rem; text-align: center">
                        <template #body="slotProps">
                            <Button class="mr-2" icon="pi pi-upload" severity="success" outlined rounded @click="openUpdateDialog(slotProps.data.id)" />
                            <Dialog v-model:visible="visibleUpdate" modal header="Cargar archivo" :style="{ width: '25rem' }">
                                <form @submit.prevent="uploadFile">
                                    <InputGroup>
                                        <InputGroupAddon class="p-0">
                                            <FileUpload
                                                chooseLabel="Buscar"
                                                mode="basic"
                                                @select="onFileSelect"
                                                customUpload
                                                auto
                                                severity="secondary"
                                                class="p-button-text"
                                            />
                                        </InputGroupAddon>
                                        <InputText type="text" v-model="form.name" fluid disabled />
                                    </InputGroup>

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
                            <Button
                                v-if="slotProps.data.file_id"
                                class="mr-2"
                                icon="pi pi-trash"
                                outlined
                                rounded
                                severity="danger"
                                @click="openDeleteDialog(slotProps.data.id, slotProps.data.file_id)"
                            />
                            <Dialog v-model:visible="visibleDelete" modal header="Eliminar" :style="{ width: '25rem' }">
                                <span class="text-surface-500 dark:text-surface-400 block mb-8">¿Está seguro que desea continuar?</span>
                                <form @submit.prevent="deleteFile">
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
import { useForm } from "@inertiajs/vue3";
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
import InputText from "primevue/inputtext";
import InputGroup from "primevue/inputgroup";
import InputGroupAddon from "primevue/inputgroupaddon";
import { useModuleStore } from "@/stores/module";

const moduleStore = useModuleStore();
const moduleId = moduleStore.moduleId;

const fileInput = ref(null);

const student = usePage().props.student;
const files = usePage().props.files;

const form = useForm({
    name: "",
    is_folder: false,
    parent_id: moduleId,
    file: null,
    student_id: student.original.id,
    graduation_files_id: null,
});

function visitGraduation() {
    router.visit("/graduation/process/" + student.original.id);
}
function visitProfile() {
    router.visit("/students/" + student.original.id + "/profile");
}

const removeId = ref(null);
const indexRef = ref(null);
const visibleDelete = ref(false);

const openDeleteDialog = (index, file_id) => {
    console.log(index, file_id);
    indexRef.value = index;
    removeId.value = file_id; 
    visibleDelete.value = true;
};

const visibleUpdate = ref(false);
const openUpdateDialog = (id) => {
    visibleUpdate.value = true;
    form.graduation_files_id = id;
};

const uploadFile = () => {
    form.post(
        route("graduationfiles.storeFile", {
            parentId: 1,
        }),
        {
            onSuccess: () => {
                alert("Archivo cargado con éxito");
                form.reset();
                if (fileInput.value) {
                    fileInput.value.value = null;
                }
                visibleUpdate.value = false;
            },
            onError: (errors) => {
                console.error("Error al subir el archivo:", errors);
                alert("Error al subir el archivo");
            },
        }
    );
};

const src = ref(null);

function onFileSelect(event) {
    const file = event.files[0];
    form.file = file;
    form.name = file.name;
    const reader = new FileReader();

    reader.onload = async (e) => {
        src.value = e.target.result;
    };
    reader.readAsDataURL(file);
}

function openFile(file_id) {
    window.open(`/files/open/${file_id}`, "_blank");
}

const deleteFile = async () => {
    const student_id = student.original.id;

    try {
        await router.delete(`/files/delete/${student_id}/${indexRef.value}/${removeId.value}`);
        alert("Archivo eliminado exitosamente.");
        visibleDelete.value = false;
    } catch (error) {
        console.error("Error al eliminar:", error);
        alert("Error al eliminar el archivo.");
        visibleDelete.value = false;
    }
};
</script>
