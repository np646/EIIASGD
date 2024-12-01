<template>
        <button class="btn btn-primary open">
            <span class="icon"><i class="pi pi-plus"></i></span>
            <span class="text">Agregar nuevo</span>
        </button>
</template>

<script setup>
import "primeicons/primeicons.css";
const props = defineProps({
    pageName: String,
});
</script>

<style scoped>
.btn-primary {
    background-color: var(--main-color);
    border-color: var(--main-color);
    border-radius: 5px;
}
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.active,
.open > .dropdown-toggle.btn-primary {
    color: #fff;
    background-color:  var(--main-color);
    border-color:  var(--main-color);
}

.open {
    height: 42px;
    display: inline-flex;
    align-items: center;
    overflow: hidden;
    width: auto;
    max-width: 40px;
    -webkit-transition: max-width 0.5s;
    transition: max-width 0.5s;
}

.open:hover {
    max-width: 300px;
}

.icon {
    font-size: 16px;
    margin-right: 5px;
    padding-right: 8px;
    display: flex;
    align-items: center;
}

.text {
    white-space: nowrap;
}
</style>
