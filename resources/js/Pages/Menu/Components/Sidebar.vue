<template>
    <div class="sidebar" :class="{ 'sidebar-min': isSidebarMini }">
        <nav class="menu-items">
            <ul id="menu-items-ul">
                <template v-for="(item, index) in menuItems" :key="item.href">
                    <li :id="item.id" :class="{ 'has-submenu': item.subItems, active: isActive(item) }" v-tooltip="isSidebarMini ? item.text : null">
                        <!-- Single template for all menu items with subItems -->
                        <a v-if="item.subItems" class="menu-link" @click.prevent="toggleSubmenu(item)">
                            <component :is="item.icon"></component>
                            <span :class="{ hide: isSidebarMini }">{{ item.text }} <i v-if="isSubmenuVisible(item)" class="pi pi-angle-down"></i> <i v-else class="pi pi-angle-right"></i></span>
                        </a>

                        <!-- Regular menu items without subItems -->
                        <Link v-else :href="item.href" :class="{ active: isActive(item) }">
                            <component :is="item.icon"></component>
                            <span :class="{ hide: isSidebarMini }">{{ item.text }}</span>
                        </Link>
                    </li>

                    <!-- Submenu items -->
                    <template v-if="item.subItems">
                        <li
                            v-for="subItem in item.subItems"
                            :key="subItem.href"
                            class="submenu-item"
                            :class="{
                                visible: isSubmenuVisible(item),
                                active: isActive(subItem),
                            }"
                        >
                            <Link :href="subItem.href" :class="{ active: isActive(subItem) }" v-tooltip="isSidebarMini ? subItem.text : null">
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
import { ref, computed, onMounted, nextTick } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { useMenuItems } from "@/Pages/Menu/Composables/useMenuItems";
const menuItems = useMenuItems();
const page = usePage();
const currentRoute = computed(() => page.url);
const activeSubmenu = ref(null);
const isAnimating = ref(false);
const props = defineProps({
    isSidebarMini: Boolean,
});

const routeName = computed(() => currentRoute.value.split("/"));

// If it's active it changes color
const isActive = (item) => {
    if (item.href.includes(routeName.value[1])) return true;
    if (item.subItems) {
        return item.subItems.some((subItem) => subItem.href.includes(routeName.value[1]));
    }
    return false;
};

const isSubmenuVisible = (item) => {
    return activeSubmenu.value === item || isAnimating.value;
};

const toggleSubmenu = (item) => {
    if (activeSubmenu.value === item) {
        closeSubmenu();
    } else {
        activeSubmenu.value = item;
        localStorage.setItem("activeSubmenu", JSON.stringify(item.text));
    }
};

const closeSubmenu = () => {
    isAnimating.value = true;
    setTimeout(() => {
        activeSubmenu.value = null;
        isAnimating.value = false;
        localStorage.removeItem("activeSubmenu");
    });
};

const closeSubmenuIfOutside = () => {
    if (activeSubmenu.value && !isActive(activeSubmenu.value)) {
        closeSubmenu();
    }
};

onMounted(() => {
    const savedStateSubmenu = localStorage.getItem("activeSubmenu");
    if (savedStateSubmenu !== null) {
        const savedSubmenuText = JSON.parse(savedStateSubmenu);
        const savedItem = menuItems.find((item) => item.text === savedSubmenuText);
        if (savedItem) {
            activeSubmenu.value = savedItem;
        }
    }

    // To check if any subitem is active and open the submenu if so
    menuItems.forEach((item) => {
        if (item.subItems && item.subItems.some((subItem) => isActive(subItem))) {
            activeSubmenu.value = item;
        }
    });

    nextTick(() => {
        closeSubmenuIfOutside();
    });

});
</script>
<style scoped>
/* Sidebar */
.sidebar {
    /*position: absolute;*/
    position: sticky;
    top: 60px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 226px;
    padding: 20px 15px;
    background-color: white;
    transition: width 0.5s ease, background-color 0.3s ease, left 0.5s ease, margin-right 0.5s ease;
    z-index: 50;
    border-right: 1px solid var(--border-color);
    height: calc(100vh - 60px);
    align-self: flex-start;
    overflow-y: auto;
    box-sizing: border-box;
    flex-shrink: 0;
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
    width: 3px;
}

.sidebar .menu-items::-webkit-scrollbar-thumb {
    background-color: var(--border-color);
    border-radius: 5px;
}

.sidebar .menu-items::-webkit-scrollbar-thumb:hover {
    background-color: var(--border-color);
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
    border-radius: 5px;
    color: var(--text-color);
    padding-left: 17px;
    margin-bottom: 2px;
}

.sidebar .menu-items a:hover {
    background-color: var(--main-color);
    color: white;
}

.sidebar .menu-items a.active {
    background-color: var(--main-color);
    color: white;
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

.menu-link {
    cursor: pointer;
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
    color: var(--text-color);
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
    margin-bottom: 2px;
}

.submenu-item a {
    display: flex;
    align-items: center;
    background-color: var(--softer-border-color);
}

.submenu-item.active a {
    border-left:none;
}

.pi{
    position: absolute;
    right: 10px;
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
    .sidebar {
        height: calc(100vh - 60px);
    }
}

@media (max-width: 600px) {
    .sidebar {
        position: fixed;
        left: -250px;
        height: calc(100vh - 60px);
    }
}
</style>
