<template v-slot:slot-content>
    <Head title="Resultados de la búsqueda" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <ul v-if="results.length">
                <li v-for="result in results" :key="result.id">
                    <CustomLink :href="getProfile(result)" :title="result.name + ' ' + result.lastname"></CustomLink>
                </li>
            </ul>
            <p v-else>No se encontraron resultados para la búsqueda.</p>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import CustomLink from "@/Components/CustomLink.vue";
import Title from "@/Components/Title.vue";

const results = computed(() => usePage().props.results);
const searchQuery = computed(() => usePage().props.searchQuery);
const title = 'Resultados para "' + searchQuery.value + '"';

console.log(results.value);
console.log("search query: " + searchQuery.value);

function getProfile(result) {
    console.log(result.type);
    return route(`${result.type}.profile`, result.id);
}
</script>

<style scoped>
ul {
    list-style-type: none;
    padding: 0;
}

p {
    color: #00356b;
    padding-left: 0.85rem;
    padding-top: 10px;
    padding-bottom: 10px;
    transition: padding-left 0.5s ease;
    border-radius: 5px;
    margin-top: 10px;
}
</style>
