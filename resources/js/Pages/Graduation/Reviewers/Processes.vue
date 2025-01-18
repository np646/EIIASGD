<template v-slot:slot-content>
    <Head title="Procesos del docente" />
    <MenuLayout>
        <Title :title="professor" />
        <ContentContainer>
            
            <Subtitle title="Procesos del docente"/>
            <div class="py-3 d-flex justify-content-center">
                <ButtonGroup>
                    <Button
                        @click="activeComponent = 'advisor'"
                        label="Asesorías"
                        icon="pi pi-user"
                        :class="{ 'active-button': activeComponent === 'advisor' }"
                    />
                    <Button
                        @click="activeComponent = 'reader'"
                        label="Lectorías"
                        icon="pi pi-users"
                        :class="{ 'active-button': activeComponent === 'reader' }"
                    />
                </ButtonGroup>
            </div>
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
import Subtitle from "@/Components/Subtitle.vue";

const activeComponent = ref("advisor");

const professor_id = ref(usePage().props.professor_id).value;
const professor = usePage().props.professor.original.name;

</script>

<style>
.active-button {
    background-color: var(--p-primary-hover-color);
}
</style>
