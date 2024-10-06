<!-- TODO: maybe swap this for a modal -->
<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <form @submit.prevent="submit">
            <div class="container">
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
                        <Button label="Guardar" icon="pi pi-check" type="submit" />
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </form>
    </MenuLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import InputText from "primevue/inputtext";

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

<style scoped>
.container {
    border: 1px solid #e2e8f0;
    border-radius: 5px;
    padding-top: 10px;
}
</style>
