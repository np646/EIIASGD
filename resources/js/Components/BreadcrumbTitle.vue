<template>
    <div class="wrapper container">
        <Breadcrumb :home="home" :model="items">
            <template #item="{ item }">
                <a class="cursor-pointer" :href="item.url">
                    <span :class="item.icon"></span>
                    <span>{{ item.label }}</span>
                </a>
            </template>
        </Breadcrumb>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Breadcrumb from "primevue/breadcrumb";
const props = defineProps({
    title: String,
});

const home = ref({ icon: "pi pi-home" });
const items = ref([{ label: "Configuración", url:"/settings" }, { label: "Usuarios", url:"/settings/users"}]);
</script>

<style scoped>
.wrapper {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}
.container {
    border: 1px solid var(--border-color);
    border-radius: 10px;
    background-color: white;
    width: 90%;
}
a {
    color: inherit;
    text-decoration: none;
}
span{
    color: var(--main-color);
    font-weight: 500;
}
</style>
