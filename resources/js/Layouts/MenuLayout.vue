<template>
    <div class="body">
        <!-- Navigation bar -->
        <nav class="navigation-bar">
            <div class="website-name">
                <BIconList aria-label="Toggle navigation" id="toggle-sidebar" @click="toggleSidebar"></BIconList>
                <span>EIIASGD</span>
                <form class="d-flex search-box" role="search">
                    <div class="position-relative">
                        <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" />
                        <BIconSearch id="search-icon"></BIconSearch>
                    </div>
                </form>
                <div class="dropdown profile">
                    <div class="avatar">
                        {{ firstLetter }}
                    </div>
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ userName }}</button>
                    <ul class="dropdown-menu">
                        <li><Link class="dropdown-item" :href="route('profile.edit')">Perfil</Link></li>
                        <li><Link class="dropdown-item" :href="route('logout')" method="post" as="button">Cerrar sesión</Link></li>
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
        </nav>

        <!-- Sidebar -->
        <div class="sidebar" :class="{ 'sidebar-min': isSidebarMini }">
            <nav class="menu-items">
                <ul id="menu-items-ul">
                    <template v-for="(item, index) in menuItems" :key="item.href">
                        <li :id="item.id" :class="{ 'has-submenu': item.subItems }">
                            <a class="practicas-icon" v-if="item.text == 'Prácticas'" @click.prevent="toggleSubmenu(item)">
                                <component :is="item.icon"></component>
                                <span :class="{ hide: isSidebarMini }">{{ item.text }}</span>
                            </a>

                            <Link v-else :href="item.href" @click.prevent="item.subItems && toggleSubmenu(item)">
                                <component :is="item.icon"></component>
                                <span :class="{ hide: isSidebarMini }">{{ item.text }}</span>
                            </Link>
                        </li>
                        <template v-if="item.subItems">
                            <li v-for="subItem in item.subItems" :key="subItem.href" class="submenu-item" :class="{ visible: activeSubmenu === item }">
                                <Link :href="subItem.href">
                                    <component :is="subItem.icon"></component>
                                    <span :class="{ hide: isSidebarMini }">{{ subItem.text }}</span>
                                </Link>
                            </li>
                        </template>
                    </template>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <main class="main-content" name="main-content" :class="{ 'main-content-min': isSidebarMini }">
            <div class="slot-content">
                <slot> </slot>
            </div>
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
    BIconPersonWorkspace,
    BIconPersonRaisedHand,
} from "bootstrap-icons-vue";
// Stuff breaks if I put the styles in this file so it has to stay in its own css file lol
// TODO: figure out how to make it work (low priority)
// TODO: rather, each part of the layout should be its own component
import "/resources/css/menu-style.css";
import { markRaw } from "vue";
import { ref, onMounted, onUnmounted } from "vue";
import { Link,usePage } from "@inertiajs/vue3";

// To set icons as not reactive
const BIconHouseDoorFillRaw = markRaw(BIconHouseDoorFill);
const BIconPersonFillRaw = markRaw(BIconPersonFill);
const BIconPeopleFillRaw = markRaw(BIconPeopleFill);
const BIconMortarboardFillRaw = markRaw(BIconMortarboardFill);
const BIconSuitcaseLgFillRaw = markRaw(BIconSuitcaseLgFill);
const BIconClipboardDataFillRaw = markRaw(BIconClipboardDataFill);
const BIconGearFillRaw = markRaw(BIconGearFill);
const BIconPersonWorkspaceRaw = markRaw(BIconPersonWorkspace);
const BIconPersonRaisedHandRaw = markRaw(BIconPersonRaisedHand);

// To toggle sidebar and submenu
const isSidebarMini = ref(false);
const isNavMinVisible = ref(false);
const activeSubmenu = ref(null);

// To create menu items
const menuItems = ref([
    { id: "inbox", href: route("dashboard"), text: "Inicio", icon: BIconHouseDoorFillRaw },
    { id: "estudiantes", href: route("students.index"), text: "Estudiantes", icon: BIconPersonFillRaw },
    { id: "docentes", href: route("professors.index"), text: "Docentes", icon: BIconPeopleFillRaw },
    { id: "titulacion", href: "/titulacion", text: "Titulación", icon: BIconMortarboardFillRaw },
    {
        href: "",
        text: "Prácticas",
        icon: BIconSuitcaseLgFillRaw,
        subItems: [
            { href: "/vinculacion", text: "Vinculación", icon: BIconPersonRaisedHandRaw },
            { href: "/preprofesionales", text: "Preprofesionales", icon: BIconPersonWorkspaceRaw },
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

import { computed } from 'vue';

//FOR USERNAME AVATAR
const page = usePage();
const userName = computed(() => page.props.auth.user.name);
const firstLetter = computed(() => userName.value.charAt(0).toUpperCase());
</script>
