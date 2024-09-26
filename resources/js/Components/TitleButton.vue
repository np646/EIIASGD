<template>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="m-0">test</h1>
        <Link :href="pageName">
            <!-- TODO: fix button animation -->
            <button class="btn btn-primary open"><BIconPersonFillAdd /></button>
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { BIconPersonFillAdd } from "bootstrap-icons-vue";

const props = defineProps({
    pageName: String,
});
</script>

<style scoped>
/* Buttons */
.btn-primary {
    background-color: #00356b;
    border-color: #00356b;
}

.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.active,
.open > .dropdown-toggle.btn-primary {
    color: #fff;
    background-color: #0e2950;
    border-color: #0e2950;
}
.open {
    width: 10px;
    height: 10px;
    
}
.open:hover {
    width: 100%;
    height: 100%;
    display: inline;
    content:'Agregar nuevo';
}
</style>
