<template>
    <nav class="navigation-bar">
        <div class="website-name">
            <div class="toggle-sidebar" @click="$emit('toggleSidebar')">
                <BIconList aria-label="Toggle navigation" class="sidebar-menu-icon"></BIconList>
            </div>
            <div>
                <img src="/img/logo-pucesi.jpg" />
            </div>
            <form class="d-flex search-box" role="search">
                <div class="position-relative">
                    <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" />
                    <BIconSearch id="search-icon"></BIconSearch>
                </div>
            </form>
            <div class="dropdown profile">
                <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <BIconPersonCircle class="avatar"></BIconPersonCircle>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <Link class="dropdown-item" :href="route('profile.edit')">{{ userName }}</Link>
                    </li>
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
</template>

<script setup>
import { BIconList, BIconPersonCircle, BIconSearch } from "bootstrap-icons-vue";
import { Link } from "@inertiajs/vue3";
import { useMenuItems } from "@/Pages/Menu/Composables/useMenuItems";
const menuItems = useMenuItems();
const props = defineProps({
    userName: String,
    isSidebarMini: Boolean,
    isNavMinVisible: Boolean,
});

const emit = defineEmits(["toggleSidebar"]);

import "primeicons/primeicons.css";
</script>

<style scoped>
/* Navigation bar */
.navigation-bar {
    width: 100%;
    height: 60px;
    position: relative;
    border-bottom: 1px solid var(--border-color);
    background-color: white;
}

.navigation-bar .website-name {
    width: 100%;
    height: 45px;
    color: var(--text-color);
    display: flex;
    align-items: center;
}

.toggle-sidebar {
    min-height: 40px;
    min-width: 40px;
    cursor: pointer;
    margin-left: 20px;
    margin-top: 15px;
    border: 1px solid var(--border-color);
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.sidebar-menu-icon {
    font-size: 25px;
}

.navigation-bar .website-name img {
    margin-top: 15px;
    margin-left: 25px;
    margin-right: 35px;
}

#search-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 15px;
    color: gray;
    cursor: pointer;
}

#search-icon:hover {
    color: var(--main-color);
}

.position-relative {
    position: relative;
}

.form-control {
    padding-right: 40px;
}

.search-box {
    margin-top: 15px;
    margin-left: auto;
    margin-right: auto;
}

.search-box input {
    width: 500px;
    height: 42px;
    border-color: var(--border-color);
}
.search-box input:focus {
    border-color: var(--border-color-hover);
    box-shadow: none;
    outline: none;
}

.position-relative input:focus ~ #search-icon {
    color: var(--main-color);
}

/* Profile */
.profile {
    margin-left: 50px;
    margin-top: 15px;
    margin-right: 20px;
}

.profile,
.profile button,
.profile a {
    color: var(--text-color);
}

.profile .dropdown-menu {
    border-color: var(--border-color);
}

.profile .dropdown-item:hover {
    background-color: var(--softer-border-color);
    color: var(--text-color);
}

.avatar {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    color: var(--text-color);
    font-size: 20px;
    margin-right: 0px;
}

.avatar:hover,
.avatar:focus {
    color: var(--main-color);
}

/* Navigation bar <600px */
.navigation-bar-min-ul {
    text-align: center;
    list-style-type: none;
    padding-left: 0;
    margin-left: 0;
}

#navigation-bar-min-li {
    border-bottom: 1px solid var(--border-color);
    padding-top: 1.5%;
    padding-bottom: 1.5%;
    background-color: white;
}

#navigation-bar-min-li a {
    text-decoration: none;
}

#navigation-bar-min-li:hover {
    background-color: var(--main-color);
}

#navigation-bar-min-li:hover a span {
    color: white;
}

.navigation-bar-min {
    width: 100%;
    margin-top: 15px;
    position: relative;
    z-index: 1;
}

.navigation-bar-min span {
    width: 100px;
    white-space: nowrap;
    font-size: 18px;
    text-align: center;
    color: var(--text-color);
}

/* Window size <600px */
@media (max-height: 660px) {
    .sidebar .website-name {
        margin-bottom: 5px;
    }
}

@media (max-width: 600px) {
    .search-box input,
    .search-box button,
    #search-icon {
        display: none;
    }
    img {
        display: none;
    }
}
@media (max-width: 816px) {
    img {
        display: none;
    }
}

/* Toggle animations  */
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
