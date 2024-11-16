<template v-slot:slot-content>
    <Head title="Titulación" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <FolderDataview :data="students" field="student" :urlStart="urlStart" :urlEnd="urlEnd"/>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import FolderDataview from "@/Components/FolderDataview.vue";
import { ref} from "vue";
import { usePage } from "@inertiajs/vue3";
const title = "Titulación";
const students = ref(usePage().props.students);
const urlStart = "/graduation/documents/";
const urlEnd = "/files";
</script>
