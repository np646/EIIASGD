<template>
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
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useMenuItems } from "@/Pages/Menu/Composables/useMenuItems";
const menuItems = useMenuItems();
const activeSubmenu = ref(null);

// To toggle sidebar and submenu
const props = defineProps({
    isSidebarMini: Boolean,
});

const toggleSubmenu = (item) => {
    activeSubmenu.value = activeSubmenu.value === item ? null : item;
};
</script>
<style scoped>
/* Sidebar */
.sidebar {
    margin-top: 60px;
    position: fixed;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 226px;
    height: 100%;
    overflow: hidden;
    padding: 20px 15px;
    background-color: rgb(255, 255, 255);
    transition: width 0.5s ease, background-color 0.3s ease, left 0.5s ease, margin-right 0.5s ease;
    z-index: 50;
    border-right: 1px solid #e9eaec;
}

.sidebar span {
    width: 100px;
    white-space: nowrap;
    font-size: 18px;
    text-align: left;
    opacity: 1;
    transition: opacity 0.5s ease, width 0.5s ease;
    padding-left: 8px;
    padding-top: 3px;
}

.sidebar span.hide {
    opacity: 0;
    width: 0;
}

/* Sidebar menu items*/
.sidebar .menu-items {
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
}

.sidebar .menu-items::-webkit-scrollbar {
    width: 5px;
}

.sidebar .menu-items::-webkit-scrollbar-thumb {
    background-color: rgb(192, 192, 192);
    border-radius: 5px;
}

.sidebar .menu-items::-webkit-scrollbar-thumb:hover {
    background-color: rgb(134, 134, 134);
}

.sidebar .menu-items #menu-items-ul {
    margin: 0;
    padding: 0;
}

.sidebar .menu-items a {
    width: 100%;
    height: 45px;
    display: flex;
    align-items: center;
    text-decoration: none;
    border-radius: 10px;
    color: #00356b;
    padding-left: 17px;
}

.sidebar .menu-items a:hover {
    background-color: #00356b;
    color: #ffffff;
}

.sidebar .menu-items i {
    padding-left: 15px;
    margin-right: 10px;
    min-width: 30px;
    font-size: 20px;
}

.sidebar-min {
    width: 80px;
}

.practicas-icon {
    cursor: pointer;
}
/* Buttons */
.btn-primary {
    background-color: #00356b;
    border-color: #00356b;
}

.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.active,
.open > .dropdown-toggle.btn-primary {
    color: #fff;
    background-color: #0e2950;
    border-color: #0e2950;
}

/* Prácticas submenu */

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
    color: #00356b;
    padding: 10px 15px;
}

.submenu i {
    margin-right: 10px;
}

.submenu-item {
    height: 0;
    overflow: hidden;
    transition: height 0.3s ease;
}

.submenu-item.visible {
    height: 45px;
}

.submenu-item a {
    display: flex;
    align-items: center;
}

.has-submenu {
    position: relative;
}

.has-submenu.active::after {
    transform: translateY(-50%) rotate(180deg);
}

.has-submenu {
    position: relative;
}

.has-submenu.active::after {
    transform: translateY(-50%) rotate(180deg);
}

/* Window size <600px */
@media (max-height: 660px) {
    .sidebar .website-name {
        margin-bottom: 5px;
    }
}

@media (max-width: 600px) {
    .sidebar {
        position: fixed;
        left: -250px;
    }
}
</style>
