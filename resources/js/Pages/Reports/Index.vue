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
            <DocumentacionTitulacion v-if="activeComponent.value === 'titulacion'" />
            <DocumentacionPreprofesionales v-if="activeComponent.value === 'preprofesionales'" />
            <DocumentacionVinculacion v-if="activeComponent.value === 'vinculacion'" />
            <DocumentacionProyectoVinculacion v-if="activeComponent.value === 'proyectos'" />
            <ProcesoTitulacion v-if="activeComponent.value === 'procesoTitulacion'" />
            <ProcesoPreprofesionales v-if="activeComponent.value === 'procesoPreprofesionales'" />
            <ProcesoVinculacion v-if="activeComponent.value === 'procesoVinculacion'" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Rezagados from "./Partials/Rezagados.vue";
import Fechas from "./Partials/GraduadosFechas.vue";
import Matricula from "./Partials/Matricula.vue";
import DocumentacionTitulacion from "./Partials/DocumentacionTitulacion.vue";
import Select from "primevue/select";
import { ref } from "vue";
import DocumentacionVinculacion from "./Partials/DocumentacionVinculacion.vue";
import DocumentacionPreprofesionales from "./Partials/DocumentacionPreprofesionales.vue";
import DocumentacionProyectoVinculacion from "./Partials/DocumentacionProyectoVinculacion.vue";
import ProcesoTitulacion from "./Partials/ProcesoTitulacion.vue";
import ProcesoVinculacion from "./Partials/ProcesoVinculacion.vue";
import ProcesoPreprofesionales from "./Partials/ProcesoPreprofesionales.vue";

const title = "Reportes";

const activeComponent = ref("");

const options = ref([
    { name: "Graduados por fechas", value: "fechas" },
    { name: "Estudiantes rezagados", value: "rezagados" },
    { name: "Estudiantes en segunda o tercera matrícula", value: "matricula" },
    { name: "Documentación entregada - Titulación", value: "titulacion" },
    { name: "Documentación entregada - Vinculación", value: "vinculacion" },
    { name: "Documentación entregada - Proyectos de vinculación", value: "proyectos" },
    { name: "Documentación entregada - Prácticas laborales", value: "preprofesionales" },
    { name: "Estado del proceso - Titulación", value: "procesoTitulacion" },
    { name: "Estado del proceso - Vinculación", value: "procesoVinculacion" },
    { name: "Estado del proceso - Prácticas laborales", value: "procesoPreprofesionales" },
]);
</script>
