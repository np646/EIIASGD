<template>
    <Head title="Docentes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Subtitle :title="`Información personal`"></Subtitle>
            <Information :professor="professor" />
        </ContentContainer>
        <ContentContainer>
            <Subtitle :title="`Procesos de titulación`"></Subtitle>
            <Graduation :professor="professor" :students="processes" />
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
const processes = ref(usePage().props.processes);



const title = professor?.lastname + " " + professor?.name;
</script>
