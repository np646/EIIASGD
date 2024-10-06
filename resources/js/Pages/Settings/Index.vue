<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Link :href="route('academicPeriods.index')">Periodos académicos</Link><br />
            <CustomLink :href="route('academicPeriods.index')" :title="`Periodos académicos`"></CustomLink>
            <Link>Carreras</Link><br />
            <Link>Áreas de titulación</Link><br />
            <Link>Roles</Link><br />
            <Link>Permisos</Link><br />
        </ContentContainer>
    </MenuLayout>
</template>
<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import { Link } from "@inertiajs/vue3";
import ContentContainer from "@/Components/ContentContainer.vue";
import CustomLink from "@/Components/CustomLink.vue";

const title = "Configuración";
</script>
