<template>
    <div class="wrapper">
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
    margin-bottom: 30px;
}

.line {
    border-top: 1px solid #e9eaec;
    flex-grow: 1;
    margin-left: 10px;
}

.title {
    color: #00356b;
}
</style>
