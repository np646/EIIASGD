<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <div class="container">
            <Link :href="route('academicPeriods.index')">Periodos académicos</Link><br />
            <Link>Carreras</Link><br />
            <Link>Áreas de titulación</Link><br />
            <Link>Roles</Link><br />
            <Link>Permisos</Link><br />
        </div>
    </MenuLayout>
</template>
<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import { Link } from "@inertiajs/vue3";

const title = "Configuración";
</script>

<style scoped>
.container {
    border: 1px solid #e2e8f0;
    border-radius: 5px;
    padding-top: 10px;
}
</style>
