<template>
    <div class="body">
        <!-- Navigation bar -->
        <div class="navigation-bar">
            <div class="website-name">
                <BIconList aria-label="Toggle navigation" id="toggle-sidebar" @click="toggleSidebar"></BIconList>
                <span>EIIASGD</span>
                <form class="d-flex search-box" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" />
                    <button class="btn btn-outline-secondary" type="submit"><BIconSearch id="search-icon"></BIconSearch></button>
                </form>

                <!-- TODO: bring profile functionality from real vue/laravel dashboard-->
                <div class="dropdown profile">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">usuario</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
            <transition name="fade">
                <div v-show="isNavMinVisible" class="navigation-bar-min">
                    <div class="bg-light">
                        <ul class="navigation-bar-min-ul">
                            <li v-for="item in menuItems" :key="item.href" id="navigation-bar-min-li">
                                <a :id="item.id" :href="item.href">
                                    <span>{{ item.text }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </transition>
        </div>

        <!-- Sidebar -->
        <div class="sidebar" :class="{ 'sidebar-min': isSidebarMini }">
            <nav class="menu-items">
                <ul id="menu-items-ul">
                    <template v-for="(item, index) in menuItems" :key="item.href">
                        <li :id="item.id" :class="{ 'has-submenu': item.subItems }">
                          
                            <a v-if="(item.text == 'Prácticas')"  @click.prevent="toggleSubmenu(item)">
                                <!-- Usa el componente de ícono en lugar de la clase -->
                                <component :is="item.icon"></component>
                                <span :class="{ hide: isSidebarMini }">{{ item.text }}</span>
                            </a>
                          
                            <Link v-else :href="item.href" @click.prevent="item.subItems && toggleSubmenu(item)">
                                <!-- Usa el componente de ícono en lugar de la clase -->
                                <component :is="item.icon"></component>
                                <span :class="{ hide: isSidebarMini }">{{ item.text }}</span>
                            </Link>
                          
                        </li>
                        <template v-if="item.subItems">
                            <li v-for="subItem in item.subItems" :key="subItem.href" class="submenu-item" :class="{ visible: activeSubmenu === item }">
                                <Link :href="subItem.href">
                                    <span :class="{ hide: isSidebarMini }">{{ subItem.text }}</span>
                                </Link>
                            </li>
                        </template>
                    </template>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <main class="main-content" :class="{ 'main-content-min': isSidebarMini }">
            <slot></slot>
        </main>
    </div>
</template>

<script setup>
import {
    BIconList,
    BIconSearch,
    BIconHouseDoorFill,
    BIconPersonFill,
    BIconPeopleFill,
    BIconMortarboardFill,
    BIconSuitcaseLgFill,
    BIconClipboardDataFill,
    BIconGearFill,
} from "bootstrap-icons-vue";
import { markRaw } from 'vue';
import "/resources/css/menu-style.css";
import { ref, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";

// Marca los componentes como no reactivos
const BIconHouseDoorFillRaw = markRaw(BIconHouseDoorFill);
const BIconPersonFillRaw = markRaw(BIconPersonFill);
const BIconPeopleFillRaw = markRaw(BIconPeopleFill);
const BIconMortarboardFillRaw = markRaw(BIconMortarboardFill);
const BIconSuitcaseLgFillRaw = markRaw(BIconSuitcaseLgFill);
const BIconClipboardDataFillRaw = markRaw(BIconClipboardDataFill);
const BIconGearFillRaw = markRaw(BIconGearFill);


const isSidebarMini = ref(false);
const isNavMinVisible = ref(false);
const activeSubmenu = ref(null);




const menuItems = ref([
    { id: "inbox", href: route('dashboard'), text: "Inicio", icon: BIconHouseDoorFillRaw },
    { id: "estudiantes", href: "/estudiantes", text: "Estudiantes", icon: BIconPersonFillRaw },
    { id: "docentes", href: "/docentes", text: "Docentes", icon: BIconPeopleFillRaw },
    { id: "titulacion", href: "/titulacion", text: "Titulación", icon: BIconMortarboardFillRaw },
    {
        href: "",
        text: "Prácticas",
        icon: BIconSuitcaseLgFillRaw,
        subItems: [
            { href: "/vinculacion", text: "Vinculación" },
            { href: "/preprofesionales", text: "Preprofesionales" },
        ],
    },
    { id: "reportes", href: "/reportes", text: "Reportes", icon: BIconClipboardDataFillRaw },
    { id: "configuracion", href: "/configuracion", text: "Configuración", icon: BIconGearFillRaw },
]);

const toggleSidebar = () => {
    if (window.innerWidth <= 600) {
        isNavMinVisible.value = !isNavMinVisible.value;
    } else {
        isSidebarMini.value = !isSidebarMini.value;
        toggleSubmenu(null);
    }
};

const toggleSubmenu = (item) => {
    activeSubmenu.value = activeSubmenu.value === item ? null : item;
};

const handleResize = () => {
    if (window.innerWidth > 600) {
        isNavMinVisible.value = false;
    }
};

onMounted(() => {
    window.addEventListener("resize", handleResize);
});

onUnmounted(() => {
    window.removeEventListener("resize", handleResize);
});
</script>

<style scoped>
</style>
