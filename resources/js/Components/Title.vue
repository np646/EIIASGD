<template>
    <div class="wrapper container">
        <h3 class="title">{{ title }}</h3>
        <div class="line"></div>
    </div>
</template>

<script setup>
import "primeicons/primeicons.css";
const props = defineProps({
    title: String,
});
</script>

<style scoped>
.wrapper {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    
}
.container {
    border: 1px solid var(--border-color);
    border-radius: 10px;
    padding-top: 10px;
    background-color: white;
    width:90%;
}

.line {
    border-top: 1px solid var(--softer-border-color);
    flex-grow: 1;
    margin-left: 10px;
}

.title {
    color: var(--main-color);
    padding:20px;
}
</style>
