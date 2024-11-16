<template>
    <DataView :value="data" :layout="layout" paginator :rows="8">
        <template #header>
            <div class="flex justify-end">
                <SelectButton v-model="layout" :options="options" :allowEmpty="false">
                    <template #option="{ option }">
                        <i :class="[option === 'list' ? 'pi pi-bars' : 'pi pi-table']" />
                    </template>
                </SelectButton>
            </div>
        </template>
        <template #grid="slotProps">
            <div class="grid grid-cols-12 gap-4">
                <div v-for="(item, index) in slotProps.items" :key="index" class="col-span-3 p-2" @dblclick="redirect(item.id)">
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
                                {{ item[field]}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #list="slotProps">
            <div class="flex flex-col">
                <div v-for="(item, index) in slotProps.items" :key="index" @dblclick="redirect">
                    <div
                        class="flex flex-col sm:flex-row sm:items-center p-3 gap-3"
                        :class="{ 'border-t border-surface-200 dark:border-surface-700': index !== 0, 'bg-blue-100': clickedIndex === index }"
                        @click="toggleColor(index)"
                        style="cursor: pointer; user-select: none"
                    >
                        <div class="md:w-20 relative">
                            <img class="block xl:block mx-auto rounded w-full" src="/img/folder.png" :alt="item.name" style="width: 40px" />
                        </div>
                        <div class="flex flex-col md:flex-row justify-between md:items-center flex-1 gap-6">
                            <div class="flex flex-row md:flex-col justify-between items-start gap-2">
                                <div>
                                    <div class="text-medium font-medium mt-2">{{ item[field]}}</div>
                                </div>
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
import SelectButton from "primevue/selectbutton";
const layout = ref("grid");

const clickedIndex = ref(null);

const props = defineProps({
    data: Object,
    field: String,
    urlStart: String,
    urlEnd: String,
});

const options = ["list", "grid"];

// To toggle the color of the clicked div
function toggleColor(index) {
    if (clickedIndex.value === index) {
        clickedIndex.value = null;
    } else {
        clickedIndex.value = index;
    }
}
function redirect(id) {
    const url = props.urlStart + id + props.urlEnd;
    router.visit(url);
}
</script>

<style scoped></style>
