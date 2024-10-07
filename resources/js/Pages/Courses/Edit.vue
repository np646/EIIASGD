<template v-slot:slot-content>
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
                        <Button label="Guardar" icon="pi pi-check" type="submit" severity="success"/>
                    </div>
                    <div class="col"></div>
                </div>
        </form>
    </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import InputText from "primevue/inputtext";
import ContentContainer from "@/Components/ContentContainer.vue";

const title = "Editar información de la carrera";

const { course } = usePage().props;
const form = useForm({
    name: course.name,
    banner_id: course.banner_id,
});

const submit = () => {
    form.put(route("courses.update", course.id));
};
</script>
