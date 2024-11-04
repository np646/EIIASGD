<template v-slot:slot-content>
    <Head title="Titulación" />
    <MenuLayout>
        <Title :title="`ENERO 2024 - ABRIL 2024`" />
        <ContentContainer>
            <FolderDataview :data="data" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import FolderDataview from "@/Components/FolderDataview.vue";
const data = [
    { periodo: "OCHOA RAMOS JAVIER ALEXANDER" },
    { periodo: "DIAZ MUÑÓZ WALTER FABIÁN" },
    { periodo: "FLORES BENAVIDES MYRIAM ANDREA" },
];
</script>
