<template>
        <Link :href="href"
            ><h5>{{ title }}</h5></Link
        ><br />
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    title: String,
});
</script>

<style scoped>
h5 {
    color: #00356b;
}
h5:hover {
    color:blueviolet;
}
a {
    text-decoration: none;
}
a:hover {
    color:blueviolet;
}
a:visited {
    text-decoration: none;
}
</style>
