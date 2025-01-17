<template>
    <Head title="Documentos de titulación" />
    <MenuLayout>
        <Information />
        <ContentContainer>
            <div class="flex flex-col gap-4 justify-center h-full mb-3">
                <DataTable :value="items" dataKey="id" class="w-full">
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
                                                accept=".pdf,.docx" 
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
                    <Column :exportable="false" header="Info" bodyStyle="text-align: center;" headerStyle="width: 3rem; text-align: center">
                        <template #body="slotProps">
                            <Button
                                v-if="slotProps.data.file_id"
                                class="mr-2"
                                icon="pi pi-info-circle"
                                outlined
                                rounded
                                severity="secondary"
                                @click="openInfoDialog(slotProps.data.file_id)"
                            />
                            <Dialog v-model:visible="visibleInfo" modal header="Información del archivo" :style="{ width: '25rem' }">
                                <div v-html="fileInfoData"></div>
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
import { router } from "@inertiajs/vue3";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref, onMounted } from "vue";
import Dialog from "primevue/dialog";
import FileUpload from "primevue/fileupload";
import { usePage } from "@inertiajs/vue3";
import InputText from "primevue/inputtext";
import InputGroup from "primevue/inputgroup";
import InputGroupAddon from "primevue/inputgroupaddon";
import Information from "./Partials/Information.vue";
import axios from "axios";

const fileInput = ref(null);
const fileInfoData = ref(null);

const student = usePage().props.student;
const form = useForm({
    name: "",
    is_folder: false,
    parent_id: 3,
    file: null,
    student_id: student.original.id,
    preprofessional_files_id: null,
});

const removeId = ref(null);
const fileId = ref(null);
const indexRef = ref(null);
const visibleDelete = ref(false);
const visibleInfo = ref(false);

const openDeleteDialog = (index, file_id) => {
    console.log(index, file_id);
    indexRef.value = index;
    removeId.value = file_id;
    visibleDelete.value = true;
};

const openInfoDialog = (file_id) => {
    console.log(file_id);
    fileId.value = file_id;
    fileInfoData.value = "";
    infoFile();
    visibleInfo.value = true;
};

const visibleUpdate = ref(false);
const openUpdateDialog = (id) => {
    visibleUpdate.value = true;
    form.preprofessional_files_id = id;
};

const uploadFile = () => {
    form.post(
        route("preprofessional.storeFile", {
            parentId: 3,
        }),
        {
            onSuccess: () => {
                fetchItems();
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
    const fileUrl = route("files.open", { file_id: file_id });
    window.open(fileUrl, "_blank");
}
const deleteFile = async () => {
    const student_id = student.original.id;

    const url = route("files.destroyPreprofessional", {
        student_id: student_id,
        index: indexRef.value,
        file_id: removeId.value,
    });

    try {
        await router.delete(url);
        alert("Archivo eliminado exitosamente.");
        fetchItems();
        visibleDelete.value = false;
    } catch (error) {
        console.error("Error al eliminar:", error);
        alert("Error al eliminar el archivo.");
        visibleDelete.value = false;
    }
};

const items = ref([]);
const student_id = student.original.id;
const fetchItems = async () => {
    try {
        const response = await axios.get(route("api.preprofessional.preprofessionalFiles", student_id));
        items.value = response.data.files;
    } catch (error) {
        console.error("Error fetching items:", error);
    }
};

const loading = ref(true);

const infoFile = async () => {
    loading.value = true;
    try {
        const response = await axios.get(route("files.info", { id: fileId.value }));
        console.log("Fetched students:", response.data);
        fileInfoData.value =
            "Nombre: " +
            response.data.name +
            "<br>" +
            "Tamaño: " +
            response.data.size +
            "<br>" +
            "Creado por: " +
            response.data.created_by_name +
            "<br>" +
            "Fecha de creación: " +
            response.data.created_at +
            "<br>" +
            "Modificado por: " +
            response.data.updated_by_name +
            "<br>" +
            "Fecha de modificación: " +
            response.data.updated_at;
    } catch (error) {
        console.error("Error fetching students:", error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchItems);
</script>
