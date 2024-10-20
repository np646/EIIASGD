<template v-slot:slot-content>
    <Head title="Periodos académicos" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <form @submit.prevent="submit">
                <div class="row g-3 mb-4">
                    <div class="col-md-1"></div>
                    <div class="col">
                        <label for="inputPeriodoAcademico" class="col-form-label">Periodo académico</label>
                        <InputText v-model="form.period" type="text" class="form-control" id="inputPeriodoAcademico" required />
                    </div>
                    <div class="col">
                        <label for="inputAno" class="col-form-label">Año</label>
                        <InputText v-model="form.year" type="text" class="form-control" id="inputAno" required />
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
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import InputText from "primevue/inputtext";
import ContentContainer from "@/Components/ContentContainer.vue";

const title = "Registrar nuevo periodo académico";

const form = useForm({
    period: "",
    year: "",
    status: 1,
});

const submit = () => {
    form.post(route("academicPeriods.store")),
        {
            onFinish: () => form.reset(),
        };
};
</script>
