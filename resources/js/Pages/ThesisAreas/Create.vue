<template v-slot:slot-content>
    <Head title="Áreas de titulación" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <form @submit.prevent="submit">
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputAreaTitulacion" class="col-form-label">Área de titulación</label>
                        <InputText class="form-control" v-model="form.area" id="inputAreaTitulacion" required />
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
import { useForm } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import InputText from "primevue/inputtext";
import ContentContainer from "@/Components/ContentContainer.vue";

const title = "Registrar nueva área de titulación";

const form = useForm({
    area: "",
    status: 1,
});

const submit = () => {
    form.post(route("thesisAreas.store")),
        {
            onFinish: () => form.reset(),
        };
};
</script>
