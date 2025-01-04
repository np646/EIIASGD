<template>
    <Dialog :visible="modelValue" @update:visible="$emit('update:modelValue', $event)" modal header="Crear usuario" :style="{ width: '30rem' }">
        <form @submit.prevent="createItem" class="flex flex-col gap-4">
            <div class="field">
                <label for="name">Usuario</label>
                <InputText
                    id="name"
                    v-model="form.name"
                    @input="updateEmail"
                    required
                    class="w-full"
                    pattern="^[a-zA-Z0-9]*$"
                    title="Solo se admiten caracteres alfanuméricos"
                />
                <small v-if="!isValidName" class="text-red-500">Solo se admiten caracteres alfanuméricos.</small>
            </div>

            <!-- Add Role Section -->
            <div class="field">
                <label for="roles">Roles</label>
                <div v-for="(role, index) in roles" :key="index" class="flex items-center gap-2">
                    <InputText v-model="roles[index]" placeholder="Ingrese un rol" class="w-full" />
                    <Button icon="pi pi-minus" class="p-button-danger" type="button" @click="removeRole(index)" />
                </div>
                <Button label="Añadir Rol" icon="pi pi-plus" type="button" class="mt-2" @click="addRole" />
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="closeModal" />
                <Button type="submit" label="Crear" :loading="loading" />
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import { useToast } from "primevue/usetoast";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const roleArray = ref(usePage().props.roles);
// TODO: change the text input to a dynamic select input filled with the roles from the database
const props = defineProps({
    modelValue: Boolean,
});

const emit = defineEmits(["update:modelValue", "item-created"]);

const toast = useToast();
const loading = ref(false);
const form = ref({
    name: "",
    email: "",
    password: "password", //TODO: remove when api authentication is implemented
    status: 1,
});

const roles = ref([]);

const isValidName = computed(() => /^[a-zA-Z0-9]*$/.test(form.value.name));

function updateEmail() {
    form.value.email = form.value.name + "@pucesi.edu.ec";
}

function addRole() {
  roles.value.push('');
}

// Remove a specific role input
function removeRole(index) {
  roles.value.splice(index, 1);
}

const createItem = async () => {
    loading.value = true;
    try {
        const response = await axios.post(route("api.users.store"), form.value);
        emit("item-created", response.data);
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Ha sido creado exitosamente",
            life: 3000,
        });
        closeModal();
    } catch (error) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible crear el usuario.",
            life: 3000,
        });
    } finally {
        loading.value = false;
    }
};

const closeModal = () => {
    form.value = { name: "", email: "", status: 1 };
    emit("update:modelValue", false);
};
</script>
