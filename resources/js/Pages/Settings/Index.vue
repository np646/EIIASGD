<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <CustomLink :href="route('academicPeriods.index')" :title="`Periodos académicos`"></CustomLink>
            <CustomLink :href="route('courses.index')" :title="`Carreras`"></CustomLink>
            <CustomLink :href="route('thesisAreas.index')" :title="`Áreas de titulación`"></CustomLink>
            <CustomLink :href="route('roles.index')" :title="`Roles`"></CustomLink>
            <CustomLink :href="route('permissions.index')" :title="`Permisos`"></CustomLink>

        </ContentContainer>
    </MenuLayout>
</template>
<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import CustomLink from "@/Components/CustomLink.vue";

const title = "Configuración";
</script>
