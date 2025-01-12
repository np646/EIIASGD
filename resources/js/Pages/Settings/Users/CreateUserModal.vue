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

            <div class="field">
                <label for="roles">Roles</label>
                <div v-for="(role, index) in roles" :key="index" class="flex items-center gap-2 mb-2">
                    <Select v-model="roles[index]" :options="roleOptions" optionLabel="name" placeholder="Seleccione un rol" class="w-full" />
                    <Button icon="pi pi-minus" severity="danger" type="button" @click="removeRole(index)" :disabled="roles.length === 1" />
                </div>
                <Button label="Añadir rol" icon="pi pi-plus" type="button" class="mt-2" @click="addRole" />
            </div>

            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="closeModal" />
                <Button type="submit" label="Crear" :loading="loading" />
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Select from "@/Components/Select.vue";
import { useToast } from "primevue/usetoast";

const toast = useToast();

const props = defineProps({
    modelValue: Boolean,
});

const emit = defineEmits(["update:modelValue", "item-created"]);
const loading = ref(false);

const pageProps = usePage().props;
const roleOptions = computed(() => {
    return pageProps.roles?.original || [];
});

const form = ref({
    name: "",
    email: "",
    password: "password", //TODO: remove when api authentication is implemented
    status: 1,
});

// Separate roles state
const roles = ref([null]);

const isValidName = computed(() => /^[a-zA-Z0-9]*$/.test(form.value.name));

function updateEmail() {
    form.value.email = `${form.value.name}@example.com`;
}

function addRole() {
    roles.value.push(null);
}

function removeRole(index) {
    if (roles.value.length > 1) {
        roles.value.splice(index, 1);
    }
}

const createItem = async () => {
    try {
        const formData = {
            ...form.value,
            roles: roles.value,
        };
        const response = await axios.post(route("api.users.store"), formData);
        emit("item-created", response.data);
        toast.add({
            severity: "success",
            summary: "Éxito",
            detail: "Usuario creado exitosamente.",
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
    form.value = {
        name: "",
        email: "",
        status: 1,
    };
    roles.value = [null];
    emit("update:modelValue", false);
};
</script>
