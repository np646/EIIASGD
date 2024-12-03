<template v-slot:slot-content>
    <Head title="Evaluadores" />
    <MenuLayout>
        <Title :title="`Evaluadores`" />
        <ContentContainer>
            <Subtitle title="Lectorías y asesorías"/>
            <div class="py-3 d-flex justify-content-center">
                <ButtonGroup>
                    <Button
                        @click="activeComponent = 'students'"
                        label="Por estudiante"
                        icon="pi pi-user"
                        :class="{ 'active-button': activeComponent === 'students' }"
                    />
                    <Button
                        @click="activeComponent = 'professors'"
                        label="Por docente"
                        icon="pi pi-users"
                        :class="{ 'active-button': activeComponent === 'professors' }"
                    />
                </ButtonGroup>
            </div>

            <Students v-if="activeComponent === 'students'" />
            <Professors v-if="activeComponent === 'professors'" />
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
import Students from "./Partials/Students.vue";
import Professors from "./Partials/Professors.vue";
import Subtitle from "@/Components/Subtitle.vue";

const activeComponent = ref("students");
</script>
<style>
.active-button {
  background-color: var(--p-primary-hover-color);
}
</style>
