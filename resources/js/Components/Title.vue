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
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding-top: 10px;
    background-color: white;
    width:90%;
}

.line {
    border-top: 1px solid #e2e8f0;
    flex-grow: 1;
    margin-left: 10px;
}

.title {
    color: #00356b;
    padding:20px;
}
</style>
