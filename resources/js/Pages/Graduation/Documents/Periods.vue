<template v-slot:slot-content>
    <Head title="Titulación" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <FolderDataview :data="periods" field="period" @selected-item="selectedItem" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import FolderDataview from "@/Components/FolderDataview.vue";
import { useModuleStore } from "@/stores/module";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

import { router } from "@inertiajs/vue3";
const title = "Titulación";

const periods = ref(usePage().props.periods);

function setModule() {
    const moduleStore = useModuleStore();
    moduleStore.setModuleId(1); // TITULACIÓN
}

setModule();

function selectedItem(id) {
    const url = route("graduation.studentsInPeriod", { period: id });
    router.visit(url);
}
</script>
