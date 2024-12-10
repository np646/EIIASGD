<template>
    <ContentContainer>
        <Subtitle title="Información del estudiante" />
        <div class="pl-5 py-3">
            <div class="row h-[8rem]">
                <div class="col-2 d-flex flex-column justify-content-center">
                    <div class="row h-full">
                        <div class="col d-flex justify-content-center align-items-center">
                            <BIconPersonFill class="student-avatar" />
                        </div>
                    </div>
                </div>
                <div class="col-10 d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col">
                            <div class="row mb-2">
                                <span class="fs-6">{{ student.original.fullname }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="fs-6">{{ student.original.identification }}</span>
                            </div>
                            <div class="row mb-2">
                                <span class="fs-6">{{ student.original.course_name }}</span>
                            </div>
                            <div class="row">
                                <ButtonGroup>
                                    <Button label="Ir a perfil" icon="pi pi-user" size="small" @click="visitProfile"></Button>
                                    <Button label="Ir a proceso de graduación" icon="pi pi-graduation-cap" size="small" @click="visitGraduation"></Button>
                                </ButtonGroup>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ContentContainer>
</template>

<script setup>
import ContentContainer from "@/Components/ContentContainer.vue";
import Button from "primevue/button";
import ButtonGroup from "primevue/buttongroup";
import { router } from "@inertiajs/vue3";
import { BIconPersonFill } from "bootstrap-icons-vue";
import { usePage } from "@inertiajs/vue3";
import Subtitle from "@/Components/Subtitle.vue";
const student = usePage().props.student;

function visitGraduation() {
    const url = route('graduation.process', { student: student.original.id});
    router.visit(url);
}
function visitProfile() {
    const url = route('students.profile', { student: student.original.id});
    router.visit(url);
}
</script>
<style>
.student-avatar {
    background-color: var(--softer-border-color);
    border-radius: 5px;
    height: 100%;
    font-size: 100px;
    color: var(--text-color);
}
</style>
