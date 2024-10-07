<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            testtt
            <!-- TODO: Make dataview its own component -->
            <!-- TODO: on 1 click: color change to focus -->
            <!-- TODO: on 2 clicks: open folder -->
            <DataView :value="datos" :layout="layout">
                <template #grid="slotProps">
                    <div class="grid grid-cols-12 gap-4">
                        <div v-for="(item, index) in slotProps.items" :key="index" class="col-span-3 p-2" @dblclick="doublealert" @click="onealert">
                            <div class="p-6 border border-surface-200 dark:border-surface-700 bg-surface-0 dark:bg-surface-900 rounded flex flex-col">
                                <div class="bg-surface-50 flex justify-center rounded p-4">
                                    <div class="relative mx-auto">
                                        <img
                                            class="rounded w-full"
                                            src="https://cdn-icons-png.flaticon.com/512/5994/5994710.png"
                                            :alt="item.name"
                                            style="max-width: 100px"
                                        />
                                    </div>
                                </div>
                                <div class="pt-6">
                                    <div class="flex justify-center">
                                        <!-- TODO: add text-overflow: ellipsis; -->
                                        <span class="text-sm font-medium">{{ item.periodo }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </DataView>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import ContentContainer from "@/Components/ContentContainer.vue";

import DataView from "primevue/dataview";

const title = "test";
import { ref } from "vue";
const layout = ref("grid");
const datos = [
    { periodo: "OCTUBRE 2021 - ENERO 2022" },
    { periodo: "DICIEMBRE 2022 - FEBRERO 2023" },
    { periodo: "2023-2024" },
    { periodo: "2024-2025" },
    { periodo: "2025-2026" },
];

const onealert = () => {
    console.log("one");
};

const doublealert = () => {
    console.log("double");
};
</script>
