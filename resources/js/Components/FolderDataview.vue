<template>
    <DataView :value="data" :layout="layout">
        <template #grid="slotProps">
            <div class="grid grid-cols-12 gap-4">
                <div v-for="(item, index) in slotProps.items" :key="index" class="col-span-3 p-2" @dblclick="redirect">
                    <div
                        class="border rounded flex flex-col"
                        style="height: 180px; cursor: pointer; user-select: none"
                        :class="{ 'bg-blue-100': clickedIndex === index }"
                        @click="toggleColor(index)"
                    >
                        <div class="bg-surface-50 flex justify-center rounded p-4">
                            <div class="relative mx-auto">
                                <img class="rounded w-full" src="/img/folder.png" :alt="item.name" style="width: 80px" />
                            </div>
                        </div>
                        <div class="h-full flex justify-center items-center">
                            <div
                                class="text-sm font-medium pl-4 pr-4 word-wrap break-word text-center"
                                style="
                                    max-height: 50px;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    line-height: 1.2;
                                    white-space: normal;
                                    line-clamp: 1.2;
                                "
                            >
                                {{ item.periodo }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DataView>
</template>

<script setup>
import DataView from "primevue/dataview";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const layout = ref("grid");

const clickedIndex = ref(null);

const props = defineProps({
    data: Object,
});

// To toggle the color of the clicked div
function toggleColor(index) {
    if (clickedIndex.value === index) {
        clickedIndex.value = null;
    } else {
        clickedIndex.value = index;
    }
}
function redirect() {
    router.visit("/period");
}
</script>

<style scoped></style>
