<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer> test </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";

const title = "Prácticas preprofesionales";
</script>
