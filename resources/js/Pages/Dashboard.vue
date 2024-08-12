<script setup>
import { ref, onMounted } from "vue";
import { useAuth } from "@/Composables/useAuth";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

//import AppLayout from "@/Layouts/AppLayout.vue";

const { user } = useAuth();
const userPermissions = ref([]);

onMounted(async () => {
    try {
        const response = await fetch("/user-permissions");
        if (!response.ok) {
            throw new Error("Failed to fetch user permissions");
        }
        userPermissions.value = await response.json();
    } catch (error) {
        console.error("Error fetching user permissions:", error);
    }
});

const hasPermission = (permission) => {
    return userPermissions.value.includes(permission);
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>

        <main>
            <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <h2 class="text-2xl font-bold mb-4">
                        Welcome, {{ user.name }}!
                    </h2>

                    <!-- Admin-only section -->
                    <div
                        v-if="user.roles && user.roles.includes('admin')"
                        class="mb-4"
                    >
                        <h3 class="text-xl font-semibold">Admin Section</h3>
                        <p>This content is only visible to admins.</p>
                    </div>

                    <!-- Adam-only section -->
                    <div
                        v-if="user.roles && user.roles.includes('adam')"
                        class="mb-4"
                    >
                        <h3 class="text-xl font-semibold">Adam Section</h3>
                        <p>
                            This content is only visible to users with the Adam
                            role.
                        </p>
                    </div>

                    <!-- Section T (permission-based) -->
                    <div v-if="hasPermission('view_section_t')" class="mb-4">
                        <h3 class="text-xl font-semibold">Section T</h3>
                        <p>
                            This content is only visible to users with the
                            'view_section_t' permission.
                        </p>
                    </div>

                    <!-- Section P (permission-based) -->
                    <div v-if="hasPermission('view_section_p')" class="mb-4">
                        <h3 class="text-xl font-semibold">Section P</h3>
                        <p>
                            This content is visible to users with the
                            'view_section_p' permission.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </main>
    </AuthenticatedLayout>
    
</template>
