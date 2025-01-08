<template>
    <Dialog :visible="modelValue" @update:visible="$emit('update:modelValue', $event)" modal header="Editar usuario" :style="{ width: '30rem' }">
        <form @submit.prevent="updateItem" class="flex flex-col gap-4">
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
                    <select class="styled-select" v-model="roles[index]" :options="roleOptions" optionLabel="name" placeholder="Seleccione un rol">
                        <option v-for="role in roleOptions" :key="role.id" :value="role.id" >
                            {{ role.name }}
                        </option>
                    </select>
                    <Button icon="pi pi-minus" severity="danger" type="button" @click="removeRole(index)" :disabled="roles.length === 1" />
                </div>
                <Button label="Añadir rol" icon="pi pi-plus" type="button" class="mt-2" @click="addRole" />
            </div>

            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancelar" severity="secondary" @click="closeModal" />
                <Button type="submit" label="Guardar" :loading="loading" />
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
import axios from "axios";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import { useToast } from "primevue/usetoast";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
// TODO: handle user not selecting a role error
// "required" doesn't work apparently

const props = defineProps({
    modelValue: Boolean,
    itemData: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(["update:modelValue", "item-updated"]);

const toast = useToast();
const loading = ref(false);
const form = ref({
    name: "",
    email: "",
    status: 1,
});

const isValidName = computed(() => /^[a-zA-Z0-9]*$/.test(form.value.name));

function updateEmail() {
    form.value.email = `${form.value.name}@example.com`;
}

const pageProps = usePage().props;
const roleOptions = computed(() => {
    return pageProps.roles?.original || [];
});

watch(
    () => props.itemData,
    (newData) => {
        if (newData) {
            form.value = { ...newData };
            populateRoles();
        }
    },
    { immediate: true }
);

// Separate roles state
const roles = ref([1, 2]);

function addRole() {
    roles.value.push(null);
}

function removeRole(index) {
    if (roles.value.length > 1) {
        roles.value.splice(index, 1);
    }
}

function populateRoles() {
    roles.value = [];
    for (let i = 0; i < props.itemData.role_ids.length; i++) {
        if (props.itemData.role_ids[i] != ",") {
            roles.value.push(parseInt(props.itemData.role_ids[i]));
        }
    }
}

const updateItem = async () => {
    loading.value = true;
    try {
        const formData = {
            ...form.value,
            roles: roles.value,
        };
        const response = await axios.put(route("api.users.update", { role_user: props.itemData.id }), formData);
        emit("item-updated", response.data);
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Ha sido actualizado exitosamente.",
            life: 3000,
        });
        closeModal();
    } catch (error) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "No fue posible actualizar.",
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

onMounted(() => {});
</script>

<style scoped>
/* Styles to make normal select look like PrimeVue's select component */
/* Which doesn't work with the dynamic role/select creation */
.styled-select {
    appearance: none;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: var(--text-color);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    width: 100%;
    height: 42px;
}

.styled-select::after {
    content: "▼";
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

.styled-select:focus {
    border-color: var(--main-color);
    outline: none;
    box-shadow: none;
}

.styled-select:hover {
    border-color: rgb(148, 163, 184);
}

.styled-select:disabled {
    background-color: #e9ecef;
    cursor: not-allowed;
}
</style>
