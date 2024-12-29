<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Subtitle :title="`Proceso de prácticas de vinculación`" class="pt-3"></Subtitle>
            <div class="p-3">
                <div>
                    <ButtonGroup>
                        <Button label="Editar información" icon="pi pi-pencil" size="small" @click="edit"></Button>
                        <Button label="Ver documentación" icon="pi pi-file" size="small" @click="documents"></Button>
                    </ButtonGroup>
                </div>
                <div class="flex flex-col gap-4 justify-center h-full pt-4">
                    <div class="grid grid-cols-12 gap-3 h-full">
                        <label class="flex items-center col-span-3 h-full" for="inputInicio">Periodo de realización de prácticas</label>
                        <div class="col-span-9 mb-2">
                            <InputText id="inputInicio" fluid disabled v-model="form.academic_period" />
                        </div>
                        <label class="flex items-center col-span-3 h-full" for="inputEstado">Estado</label>
                        <div class="col-span-9">
                            <InputText id="inputEstado" fluid disabled v-model="form.status" />
                        </div>
                    </div>
                </div>
            </div>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import Subtitle from "@/Components/Subtitle.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import ButtonGroup from "primevue/buttongroup";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

import { useForm } from "@inertiajs/vue3";

const process = ref(usePage().props.process).value;

const form = useForm({
    academic_period: process.academic_period,
    status: process.status_name,
});

const title = process.student_name;

console.log(process);
function documents() {
    const url = route("community.studentFiles", { student: process.id });
    router.visit(url);
}

function edit() {
    const url = route("community.processEdit", { student: process.student_id });
    router.visit(url);
}
</script>
