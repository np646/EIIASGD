<template>
    <Head title="Estudiantes" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <Subtitle :title="`Información personal`"></Subtitle>
            <Information :student="student" class="px-5 pt-4"></Information>
        </ContentContainer>
        <ContentContainer>
            <Subtitle :title="`Ver procesos`"></Subtitle>
            <div class="pb-4 pt-3 px-5">
                <div class="row">
                    <div class="col d-flex flex-column justify-content-center">
                        <Link :href="url" class="content-wrapper">
                            <div class="row p-3">
                                <div class="col text-center">
                                    <div class="row mb-2">
                                        <BIconMortarboardFill style="font-size: 30px; color: var(--main-color)" />
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-5">Titulación</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <Link href="/dashboard" class="content-wrapper">
                            <div class="row p-3">
                                <div class="col text-center">
                                    <div class="row mb-2">
                                        <BIconPersonRaisedHand style="font-size: 30px; color: var(--main-color)" />
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-5">Vinculación</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <Link href="/dashboard" class="content-wrapper">
                            <div class="row p-3">
                                <div class="col text-center">
                                    <div class="row mb-2">
                                        <BIconPersonWorkspace style="font-size: 30px; color: var(--main-color)" />
                                    </div>
                                    <div class="row">
                                        <span class="fw-bold fs-5">Preprofesionales</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
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
import Information from "./ProfilePartials/Information.vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { BIconMortarboardFill, BIconPersonWorkspace, BIconPersonRaisedHand } from "bootstrap-icons-vue";

const { student } = usePage().props;
const title = student?.lastname + " " + student?.name;
const url = "/graduation/process/" + student?.id;
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
}

.content-wrapper:hover {
    /* TODO: change background color */
    background-color: #e0dcdc; 
    transform: scale(1.05);
    cursor: pointer;
}
</style>
