<template v-slot:slot-content>
    <MenuLayout>
        <Title :title="title" />
        <ContentContainer>
            <div class="row g-3 mb-4">
                <div class="col-md-1"></div>
                <div class="col">
                    <label for="inputUsuario" class="col-form-label">Usuario</label>
                        <InputText class="form-control" v-model="user.name" id="inputUsuario" required disabled />
                     </div>
                <div class="col">
                    <label for="inputRol" class="col-form-label">Rol</label>
                        <InputText class="form-control" v-model="user.roles" id="inputRol" required disabled />
                    </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-1"></div>
                <div class="col">
                    <label for="inputEmail" class="col-form-label">Email</label>
                        <InputText type="email" class="form-control" v-model="user.email" id="inputEmail" required disabled />
                  </div>
                <div class="col-md-1"></div>
            </div>
           
        </ContentContainer>
    </MenuLayout>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
import Title from "@/Components/Title.vue";
import InputText from "primevue/inputtext";
import ContentContainer from "@/Components/ContentContainer.vue";
const title = "Perfil";

const user = usePage().props.auth.user;
</script>
