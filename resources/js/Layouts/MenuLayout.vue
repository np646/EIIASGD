<template>
    <div class="cuerpo">
        <!-- Navigation bar -->
        <div class="barra-navegacion">
            <div class="nombre-pagina">
                <BIconList aria-label="Toggle navigation" id="nav-max" @click="toggleSidebar"></BIconList>
                <span>EIIASGD</span>
                <form class="d-flex busqueda" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" />
                    <button class="btn btn-outline-secondary" type="submit"><BIconSearch id="lupa"></BIconSearch></button>
                </form>

                <div class="dropdown perfil">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">usuario</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
            <transition name="fade">
                <div v-show="isNavMinVisible" class="barra-navegacion-min">
                    <div class="bg-light">
                        <ul id="nav_min_ul">
                            <li v-for="item in menuItems" :key="item.href" id="nav_min_li">
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
        <div class="barra-lateral" :class="{ 'mini-barra-lateral': isSidebarMini }">
            <nav class="navegacion">
                <ul id="nav_ul">
                    <template v-for="(item, index) in menuItems" :key="item.href">
                        <li :id="item.id" :class="{ 'has-submenu': item.subItems }">
                          
                            <a v-if="(item.text == 'Prácticas')"  @click.prevent="toggleSubmenu(item)">
                                <!-- Usa el componente de ícono en lugar de la clase -->
                                <component :is="item.icon"></component>
                                <span :class="{ oculto: isSidebarMini }">{{ item.text }}</span>
                            </a>
                          
                            <Link v-else :href="item.href" @click.prevent="item.subItems && toggleSubmenu(item)">
                                <!-- Usa el componente de ícono en lugar de la clase -->
                                <component :is="item.icon"></component>
                                <span :class="{ oculto: isSidebarMini }">{{ item.text }}</span>
                            </Link>
                          
                        </li>
                        <template v-if="item.subItems">
                            <li v-for="subItem in item.subItems" :key="subItem.href" class="submenu-item" :class="{ visible: activeSubmenu === item }">
                                <Link :href="subItem.href">
                                    <span :class="{ oculto: isSidebarMini }">{{ subItem.text }}</span>
                                </Link>
                            </li>
                        </template>
                    </template>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <main class="principal" :class="{ 'min-main': isSidebarMini }">
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
/* Include your existing CSS here */

/* Updated styles for submenu */
.submenu-item {
    height: 0;
    overflow: hidden;
    transition: height 0.3s ease;
}

.submenu-item.visible {
    height: 45px; /* Adjust this value based on your item height */
}

.submenu-item a {
    display: flex;
    align-items: center;
}

/* Styles for the parent menu item with submenu */
.has-submenu {
    position: relative;
}

.has-submenu.active::after {
    transform: translateY(-50%) rotate(180deg);
}

/* Updated styles for submenu */
.submenu {
    padding-left: 0;
    list-style-type: none;
}

.submenu ul {
    list-style-type: none;
    padding-left: 0;
}

.submenu li {
    margin-bottom: 5px;
}

.submenu a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: var(--color-texto-menu);
    padding: 10px 15px;
}

.submenu i {
    margin-right: 10px;
}

/* Styles for the parent menu item with submenu */
.has-submenu {
    position: relative;
}

.has-submenu.active::after {
    transform: translateY(-50%) rotate(180deg);
}

/* Fade transition */
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Include your existing CSS here */

/* Fade transition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Submenu styles */
.submenu {
    padding-left: 20px;
}

.submenu ul {
    list-style-type: none;
    padding-left: 0;
}

.submenu li {
    margin-bottom: 5px;
}

.submenu a {
    text-decoration: none;
    color: var(--color-texto-menu);
}

/* Mobile menu styles */
.barra-navegacion-min {
    width: 100%;
    margin-top: 15px;
}

@media (max-width: 600px) {
    .barra-navegacion-min li {
        border-bottom: 1px solid #2b5177;
    }

    .barra-navegacion-min span {
        width: 100px;
        white-space: nowrap;
        font-size: 18px;
        text-align: center;
        color: #00356b;
    }
}

/* Existing styles from your CSS file */
#practicas {
    padding: 0;
}

#practicas ul {
    padding-left: 20px;
}

#practicas li {
    margin-bottom: 5px;
    list-style-type: none;
}

#practicas li a {
    padding-left: 15px;
}
</style>
