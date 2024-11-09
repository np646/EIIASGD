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

        <div v-if="folders.length">
            <h2>Carpetas</h2>
            <ul>
                <li v-for="folder in folders" :key="folder.id">📁 {{ folder.name }}</li>
            </ul>
        </div>

        <div v-if="files.length">
            <h2>Archivos</h2>
            <ul>
                <li v-for="file in files" :key="file.id">📄 {{ file.name }}</li>
            </ul>
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
import { usePage } from "@inertiajs/vue3";

const { props } = usePage();
const items = props.files || [];

const folders = computed(() => items.filter((item) => item.is_folder));
const files = computed(() => items.filter((item) => !item.is_folder));

console.log(folders.value, files.value);
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
</style>
