<template v-slot:slot-content>
    <Head title="Titulación" />
    <MenuLayout>
        <Title :title="title" />
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
const title = "Titulación";
const data = [
    { periodo: "OCTUBRE 2021 - ENERO 2022" },
    { periodo: "DICIEMBRE 2022 - FEBRERO 2023" },
    { periodo: "2023-2024" },
    { periodo: "2024-2025" },
    { periodo: "2025-2026" },
];
</script>
