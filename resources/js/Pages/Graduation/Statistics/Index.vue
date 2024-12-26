<template v-slot:slot-content>
    <Head title="Reportes estadísticos" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <div class="py-3 d-flex justify-content-center">
                <div class="col text-center">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <span class="fw-bold fs-6 mb-2">Seleccione el tipo de reporte</span>
                        <Select v-model="activeComponent" :options="options" optionLabel="name" class="w-auto" />
                    </div>
                </div>
            </div>

            <Fechas v-if="activeComponent.value === 'fechas'" />
            <Matricula v-if="activeComponent.value === 'matricula'" />
            <Rezagados v-if="activeComponent.value === 'rezagados'" />
            <Documentacion v-if="activeComponent.value === 'documentacion'" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Rezagados from "./Partials/Rezagados.vue";
import Fechas from "./Partials/Fechas.vue";
import Matricula from "./Partials/Matricula.vue";
import Documentacion from "./Partials/Documentacion.vue";
import Select from "primevue/select";
import { ref } from "vue";
const title = "Reportes estadísticos de titulación";

const activeComponent = ref("");

const options = ref([
    { name: "Graduados por fechas", value: "fechas" },
    { name: "Estudiantes rezagados", value: "rezagados" },
    { name: "Estudiantes en segunda o tercera matrícula", value: "matricula" },
    { name: "Documentación entregada", value: "documentacion" },
]);
</script>
