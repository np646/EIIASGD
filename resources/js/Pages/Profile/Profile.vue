<template v-slot:slot-content>
    <Head title="Perfil" />
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <div class="px-3 pb-3 pt-1">
                <div class="row pb-3">
                    <div class="col">
                        <label for="inputUsuario" class="col-form-label">Usuario</label>
                        <InputText class="form-control w-50" v-model="user.name" id="inputUsuario" required disabled />
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col">
                        <label for="inputEmail" class="col-form-label">Email</label>
                        <InputText type="email" class="form-control w-50" v-model="user.email" id="inputEmail" required disabled />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label for="inputRol" class="col-form-label">Roles</label>
                        <InputText v-for="role in user.roles" class="form-control mb-3  w-50" id="inputRol" required disabled :value="role" />
                    </div>
                </div>
            </div>
        </ContentContainer>
    </MenuLayout>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import InputText from "primevue/inputtext";
import ContentContainer from "@/Components/ContentContainer.vue";
const title = "Perfil";

const user = usePage().props.auth.user;
</script>
