<template v-slot:slot-content>
    <Head title="Prácticas de vinculación" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <FolderDataview :data="students" field="student" @selected-item="selectedItem" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import FolderDataview from "@/Components/FolderDataview.vue";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
const title = "Prácticas de vinculación";
const students = ref(usePage().props.students);

function selectedItem(id) {
    const url = route("community.studentFiles", { student: id });
    router.visit(url);
}
</script>
