<template v-slot:slot-content>
    <Head title="Carreras" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <form @submit.prevent="submit">
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputCarrera" class="col-form-label">Carrera</label>
                        <InputText v-model="form.name" type="text" class="form-control" id="inputCarrera" required />
                    </div>
                    <div class="col">
                        <label for="inputBannerId" class="col-form-label">Banner ID</label>
                        <InputText v-model="form.banner_id" type="text" class="form-control" id="inputBannerId" required />
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="row g-3 mt-2 mb-4">
                    <div class="col"></div>
                    <div class="col d-flex justify-content-center">
                        <Button label="Guardar" icon="pi pi-check" type="submit" severity="success" />
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

const title = "Registrar nueva carrera";

const form = useForm({
    name: "",
    banner_id: "",
    status: 1,
});

const submit = () => {
    form.post(route("courses.store")),
        {
            onFinish: () => form.reset(),
        };
};
</script>
