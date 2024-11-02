<template v-slot:slot-content>
    <Head title="Reportes estadísticos" />
    <MenuLayout>
        <Title :title="title" />

        <ContentContainer>
            <Fechas />
            <Resagados />
            <Matricula />
            <Caducidad/>
           <Documentacion/>
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

const title = "Reportes estadísticos: Titulación";
</script>
