<template>
    <div>
        <h1>Subir Archivos y Carpetas</h1>

        <form @submit.prevent="uploadFile" enctype="multipart/form-data">
            <div>
                <input v-model="form.name" type="text" placeholder="Nombre del archivo o carpeta" required />
            </div>

            <div>
                <label> <input v-model="form.is_folder" type="checkbox" /> Es carpeta </label>
            </div>

            <div v-if="!form.is_folder">
                <input ref="fileInput" type="file" @change="handleFileChange" />
            </div>

            <button type="submit">Subir</button>
        </form>
    </div>

    <div>
        <h1>Archivos y Carpetas</h1>
        <div>
            <h2>Carpetas</h2>
            <ul>
                <li v-for="folder in folders" :key="folder.id">
                    {{ folder.name }}
                    <button @click="openEditModal(folder)">Editar</button>
                    <button @click="deleteItem(folder)">Eliminar</button>
                </li>
            </ul>
        </div>
        <div>
            <h2>Archivos</h2>
            <ul>
                <li v-for="file in files" :key="file.id">
                    {{ file.name }}
                    <button @click="openEditModal(file)">Editar</button>
                    <button @click="openFileInNewTab(file)">Abrir</button>
                    <button @click="downloadFile(file)">Descargar</button>
                    <button @click="deleteItem(file)">Eliminar</button>
                </li>
            </ul>
        </div>

        <!-- Modal de Edición -->
        <div v-if="isEditModalOpen" class="modal-overlay">
            <div class="modal-content">
                <h3>Editar {{ selectedItem?.name }}</h3>
                <input v-model="selectedItem.name" />
                <button @click="updateItem">Guardar Cambios</button>
                <button @click="closeEditModal">Cancelar</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

// To upload files
const form = useForm({
    name: "",
    is_folder: false,
    parent_id: null,
    file: null,
});

const fileInput = ref(null);

const handleFileChange = (event) => {
    form.file = event.target.files[0];
};

const uploadFile = () => {
    form.post("/studentfiles", {
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

// To view folders and files
import { computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";


const { props } = usePage();
const items = ref(props.items || []);


const folders = computed(() => items.value.filter((item) => item.is_folder));
const files = computed(() => items.value.filter((item) => !item.is_folder));


const isEditModalOpen = ref(false);
const selectedItem = ref(null);


const openEditModal = (item) => {
  selectedItem.value = { ...item }; 
  isEditModalOpen.value = true;
};

const closeEditModal = () => {
  isEditModalOpen.value = false;
  selectedItem.value = null;
};


const updateItem = () => {
  router.put(`/files/update/${selectedItem.value.id}`, { name: selectedItem.value.name }, {
    onSuccess: () => {
      alert("Archivo actualizado correctamente");
      closeEditModal();
    },
    onError: (error) => {
      console.error("Error al actualizar:", error);
    }
  });
};


const deleteItem = async (item) => {
    if (confirm(`¿Estás seguro de que deseas eliminar "${item.name}"?`)) {
        try {
            await router.delete(`/files/delete/${item.id}`);
            alert("Archivo o carpeta eliminado exitosamente.");
        } catch (error) {
            console.error("Error al eliminar:", error);
            alert("Error al eliminar el archivo o carpeta.");
        }
    }
};


const downloadFile = (item) => {
    window.open(`/files/download/${item.id}`, "_blank");
};


const openFileInNewTab = (item) => {
    window.open(`/files/open/${item.id}`, "_blank");
};
</script>

<style scoped>
h1 {
    font-size: 1.5em;
    margin-bottom: 1em;
}
h2 {
    font-size: 1.2em;
    margin-top: 1em;
}
ul {
    list-style: none;
    padding: 0;
}
li {
    padding: 0.5em 0;
}

.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 1rem;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  width: 300px;
}
</style>
