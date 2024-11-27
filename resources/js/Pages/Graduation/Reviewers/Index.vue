<template v-slot:slot-content>
    <Head title="Evaluadores" />
    <MenuLayout>
        <Title :title="`Evaluadores`" />
        <ContentContainer>

          <!-- <Students /> -->
           <!-- <Professors/> -->
            <AsAdvisor/>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import "primeicons/primeicons.css";
import Button from "primevue/button";
import Students from "./Partials/Students.vue";
import Professors from "./Partials/Professors.vue";
import AsAdvisor from "./Partials/AsAdvisor.vue";


</script>
