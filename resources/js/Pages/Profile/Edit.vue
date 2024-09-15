<script setup>
import { usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";

const user = usePage().props.auth.user;
</script>

<template v-slot:slot-content>
    <!-- <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout> -->

    <MenuLayout>
        <div class="profile-info">
            <div class="row g-3">
                <div class="col-12">
                   <h4 class="form-label">Información básica</h4>
                </div>
                <div class="col-md-8">
                    <label for="inputNombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control bg-white" id="inputNombres" required v-model="user.name" disabled/>
                </div>
                 <!-- TODO: make v-for to create divs depending on the amount of roles -->
                <div class="col-md-8">
                    <label for="inputApellidos" class="form-label">Rol</label>
                    <input type="text" class="form-control" id="inputApellidos" required v-model="user.roles"/>
                </div>
                <div class="col-md-8">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control bg-white" id="inputEmail" required v-model="user.email" disabled/>
                </div>
            </div>
        </div>

        <!-- <h2>perfil</h2>
        <div style="width: 20px; height:20px;">

        </div> -->
    </MenuLayout>
</template>

<style scoped>
/* TODO: should be global styles for the stuff inside slot */
.profile-info {
    max-width: 800px;
    padding-top: 20px;
    padding-left: 40px;
}
</style>