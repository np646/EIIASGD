<template>
    <Link :href="href">
        <h5>
            <span>{{ title }}</span>
            &nbsp;<i class="pi pi-arrow-right"></i>
        </h5>
    </Link>
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
    padding-left: 20px;
    padding-top: 10px;
    padding-bottom: 10px;
    transition: padding-left 0.5s ease;
}
h5:hover{
    padding-left: 30px;
}
h5:hover span {
    text-decoration: underline;
}

h5 i {
    display: none;
    text-decoration: none;
}

h5:hover i {
    display: inline;
}
a:hover {
    text-decoration: none;
}
a {
    text-decoration: none;
}
</style>
