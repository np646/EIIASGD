<template>
    <Head title="Inicio" />
    <MenuLayout>
        <ContentContainer>
           Bienvenido, {{user.name}} <br>
           Sistema web de gestión documental <br>
           Escuela de informática e inteligenica artificial
        </ContentContainer>
        <ContentContainer>
            {{ formattedDate }}
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import { computed } from 'vue';
import { usePage } from "@inertiajs/vue3";
const user = usePage().props.auth.user;

const formattedDate = computed(() => {
  const today = new Date();
  const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
  const dateString = today.toLocaleDateString('es-ES', options);
  return `Hoy es ${dateString}`;
});
</script>

<style lang="scss" scoped></style>
