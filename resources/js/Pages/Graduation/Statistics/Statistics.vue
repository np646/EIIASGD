<template v-slot:slot-content>
    <Head title="Reportes estadísticos" />
    <MenuLayout>
        <Title :title="title" />

        <ContentContainer>
            <Select v-model="activeComponent" :options="options" optionLabel="name" placeholder="Seleccione un tipo" class="w-full md:w-56" />
            <Fechas v-if="activeComponent.value === 'fechas'" />
            <Resagados v-if="activeComponent.value === 'resagados'" />
            <Matricula v-if="activeComponent.value === 'matricula'" />
            <Caducidad v-if="activeComponent.value === 'caducidad'" />
            <Documentacion v-if="activeComponent.value === 'documentacion'" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Resagados from "./Partials/Resagados.vue";
import Fechas from "./Partials/Fechas.vue";
import Matricula from "./Partials/Matricula.vue";
import Caducidad from "./Partials/Caducidad.vue";
import Documentacion from "./Partials/Documentacion.vue";
import Select from "primevue/select";
import { ref, watch } from "vue";
const title = "Reportes estadísticos: Titulación";

const activeComponent = ref("fechas");

const options = ref([
    { name: "Graduados por fechas", value: "fechas" },
    { name: "Estudiantes resagados", value: "resagados" },
    { name: "Estudiantes en segunda o tercera matrícula", value: "matricula" },
    { name: "Estudiantes con plan por caducar", value: "caducidad" },
    { name: "Documentación entregada", value: "documentacion" },
]);

</script>
