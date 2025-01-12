<template>
    <div class="app-container">
        <Navbar :user-name="userName" :is-sidebar-mini="isSidebarMini" :is-nav-min-visible="isNavMinVisible" @toggle-sidebar="toggleSidebar" />
        <div class="content-wrapper">
            <Sidebar :menu-items="useMenuItems" :is-sidebar-mini="isSidebarMini" />
            <main class="main-content" :class="{ 'main-content-sidebar-mini': isSidebarMini }">
                <slot></slot>
            </main>
        </div>
    </div>
    <Toast />
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import Navbar from "@/Pages/Menu/Components/Navbar.vue";
import Sidebar from "@/Pages/Menu/Components/Sidebar.vue";
import { useMenuItems } from "@/Pages/Menu/Composables/useMenuItems";
import Toast from 'primevue/toast';

const isSidebarMini = ref(false);
const isNavMinVisible = ref(false);

const toggleSidebar = () => {
    if (window.innerWidth <= 600) {
        isNavMinVisible.value = !isNavMinVisible.value;
    } else {
        isSidebarMini.value = !isSidebarMini.value;
        localStorage.setItem("sidebarMini", JSON.stringify(isSidebarMini.value));
    }
};

const handleResize = () => {
    if (window.innerWidth > 600) {
        isNavMinVisible.value = false;
    } else {
        isNavMinVisible.value = true;
    }
};

onMounted(() => {
    window.addEventListener("resize", handleResize);

    // Load the sidebar state from localStorage when the component mounts
    const savedState = localStorage.getItem("sidebarMini");
    if (savedState !== null) {
        isSidebarMini.value = JSON.parse(savedState);
    }
});

onUnmounted(() => {
    window.removeEventListener("resize", handleResize);
});

const page = usePage();
const userName = computed(() => page.props.auth.user.name);
</script>

<style scoped>
.app-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.content-wrapper {
    display: flex;
    margin-top: 60px;
    min-height: calc(100vh - 60px);
}

.main-content {
    flex-grow: 1;
    overflow-y: auto;
    padding-top: 20px;
    padding-bottom: 20px;
    transition: margin-left 0.4s ease;
}

</style>
