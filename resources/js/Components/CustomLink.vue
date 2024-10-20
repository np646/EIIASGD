<template>
    <Link :href="href">
        <h5>
            <span>{{ title }}</span>
            &nbsp;<i class="pi pi-arrow-right"></i>
        </h5>
    </Link>
    <div class="line"></div>
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
    border-radius: 5px;
}
h5:hover{
    padding-left: 30px;
    
    background-color: var(--softer-border-color);
}
h5:hover span {
    text-decoration: none;
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
.line {
    border-top: 1px solid var(--softer-border-color);
}

</style>
