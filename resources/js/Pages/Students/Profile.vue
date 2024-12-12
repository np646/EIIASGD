<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Subtitle :title="`Ver procesos`"></Subtitle>
            <div class="py-3 d-flex justify-content-center ">
                <div class="row gap-5">
                    <div class="col d-flex flex-column justify-content-center">
                        <Link :href="url" class="content-wrapper">
                            <div class="row p-3">
                                <div class="col text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <BIconMortarboardFill class="fs-5 me-2" style="color: var(--main-color)" />
                                        <span class="fw-bold fs-6">Titulación</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <Link href="/dashboard" class="content-wrapper">
                            <div class="row p-3">
                                <div class="col text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <BIconPersonRaisedHand class="fs-5 me-2" style="color: var(--main-color)" />
                                        <span class="fw-bold fs-6">Vinculación</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <Link href="/dashboard" class="content-wrapper">
                            <div class="row p-3">
                                <div class="col text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <BIconPersonWorkspace class="fs-5 me-2" style="color: var(--main-color)" />
                                        <span class="fw-bold fs-6">Preprofesionales</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </ContentContainer>
        <ContentContainer >
            <Subtitle :title="`Información personal`" class="pt-3"></Subtitle>
            <Information :student="student"></Information>
        </ContentContainer>
    </MenuLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import Subtitle from "@/Components/Subtitle.vue";
import ContentContainer from "@/Components/ContentContainer.vue";
import Information from "./ProfilePartials/Information.vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { BIconMortarboardFill, BIconPersonWorkspace, BIconPersonRaisedHand } from "bootstrap-icons-vue";

const { student } = usePage().props;
const title = student?.lastname + " " + student?.name;
const url = route('graduation.process', { student: student?.id });
</script>
<style scoped>
.content-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    transition: background-color 0.3s, transform 0.3s;
    text-decoration: none;
    color: inherit;
    width: 200px;
}

.content-wrapper:hover {
    background-color: var(--softer-border-color);
    transform: scale(1.05);
    cursor: pointer;
}
</style>
