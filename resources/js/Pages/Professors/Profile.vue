<template>
    <Head title="Docentes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Subtitle :title="`Información personal`"></Subtitle>
            <Information :professor="professor" />
        </ContentContainer>
        <ContentContainer>
            <Subtitle :title="`Procesos de titulación activos`"></Subtitle>
            <Graduation :professor="professor" :students="students" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Subtitle from "@/Components/Subtitle.vue";
import Information from "./ProfilePartials/Information.vue";
import Graduation from "./ProfilePartials/Graduation.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const { professor } = usePage().props;

const students = ref([
    { id: 1, name: "John Smith" },
    { id: 2, name: "Jane Doe" },
    { id: 3, name: "Emily Johnson" },
    { id: 4, name: "DMichael Brown" },
    { id: 5, name: "Linda Davis" },
    { id: 6, name: "William Wilson" },
    { id: 7, name: "Elizabeth Martinez" },
    { id: 8, name: "David Anderson" },
    { id: 9, name: "Susan Taylor" },
    { id: 10, name: "Robert Thomas" },
]);

const title = professor?.lastname + " " + professor?.name;
</script>
