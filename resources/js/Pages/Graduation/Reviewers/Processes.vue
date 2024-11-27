<template v-slot:slot-content>
    <Head title="Procesos activos" />
    <MenuLayout>
        <Title :title="`Procesos activos`" />
        <ContentContainer>
            <ButtonGroup>
                <Button @click="activeComponent = 'advisor'" label="Asesorías" icon="pi pi-user" severity="contrast" />
                <Button @click="activeComponent = 'reader'" label="Lectorías" icon="pi pi-users" severity="contrast" />
            </ButtonGroup>
            <AsAdvisor v-if="activeComponent === 'advisor'" :id="professor_id" />
            <AsReader v-if="activeComponent === 'reader'" :id="professor_id" />
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import "primeicons/primeicons.css";
import Button from "primevue/button";
import ButtonGroup from "primevue/buttongroup";
import AsAdvisor from "./Partials/AsAdvisor.vue";
import AsReader from "./Partials/AsReader.vue";
import { usePage } from "@inertiajs/vue3";

const activeComponent = ref("advisor");

const professor_id = ref(usePage().props.professor_id).value;

console.log("id: " + professor_id);
</script>
