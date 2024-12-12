<template>
    <div class="wrapper">
        <span class="font-semibold fs-6">{{ title }}</span>
        <div class="line"></div>
    </div>
</template>

<script setup>
const props = defineProps({
    title: String,
});
</script>

<style scoped>
.line {
    border-top: 1px solid var(--softer-border-color);
    margin-top: 10px;
}
.wrapper {
    padding: 5px 0.85rem;
}
</style>
