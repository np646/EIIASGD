<template v-slot:slot-content>
        <Head title="Permisos" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <form @submit.prevent="submit">
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputPermiso" class="col-form-label">Permiso</label>
                        <InputText class="form-control" v-model="form.name" id="inputPermiso" required />
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="row g-3 mt-2 mb-4">
                    <div class="col"></div>
                    <div class="col d-flex justify-content-center">
                        <Button label="Guardar" icon="pi pi-check" type="submit" severity="success"/>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import InputText from "primevue/inputtext";
import ContentContainer from "@/Components/ContentContainer.vue";

const title = "Registrar nuevo permiso";

const form = useForm({
    name: "",
    status: 1,
});

const submit = () => {
    form.post(route("permissions.store")),
        {
            onFinish: () => form.reset(),
        };
};
</script>
