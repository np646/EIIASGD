<template>
    <div class="body">
        <Navbar :user-name="userName" :is-sidebar-mini="isSidebarMini" :is-nav-min-visible="isNavMinVisible" @toggle-sidebar="toggleSidebar" />
        <Sidebar :menu-items="useMenuItems" :is-sidebar-mini="isSidebarMini" />
        <main class="main-content">
            <div :class="{ 'slot-content-sidebar-mini': isSidebarMini, 'slot-content': !isSidebarMini }">
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted} from "vue";
import { usePage } from "@inertiajs/vue3";
import Navbar from "@/Pages/Menu/Components/Navbar.vue";
import Sidebar from "@/Pages/Menu/Components/Sidebar.vue";
import { useMenuItems } from "@/Pages/Menu/Composables/useMenuItems";

const isSidebarMini = ref(false);
const isNavMinVisible = ref(false);

const toggleSidebar = () => {
    if (window.innerWidth <= 600) {
        isNavMinVisible.value = !isNavMinVisible.value;
    } else {
        isSidebarMini.value = !isSidebarMini.value;
        localStorage.setItem('sidebarMini', JSON.stringify(isSidebarMini.value));
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
  const savedState = localStorage.getItem('sidebarMini');
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
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.body {
    height: 100vh;
    width: 100%;
    background-color: #ffffff;
    position:relative;
}



.main-content {
    display: flex;
}

/* Content inside slot */
.slot-content {
    margin-left: 226px;
    width: 100%;
    padding-top: 20px;
    padding-left: 40px;
    padding-right: 40px;
}

.slot-content-sidebar-mini {
    margin-left: 80px;
    width: 100%;
    padding-top: 20px;
    padding-left: 40px;
    padding-right: 40px;
}

.slot-content,
.slot-content-sidebar-mini {
    transition: margin-left 0.4s ease;
}

@media (max-width: 600px) {
    .slot-content {
        margin-left: 0px;
        width: 100%;
        padding-top: 20px;
        transition: margin-left 0.4s ease;
        padding-left: 0px;
    }
}
</style>
