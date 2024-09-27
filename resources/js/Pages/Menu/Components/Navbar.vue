<template>
    <nav class="navigation-bar">
        <div class="website-name">
            <BIconList aria-label="Toggle navigation" id="toggle-sidebar" @click="$emit('toggleSidebar')"></BIconList>
            <span>EIIASGD</span>
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
                    <li><Link class="dropdown-item" :href="route('profile.edit')">{{ userName }}</Link></li>
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
    background-color: #ffffff;
    width: 100%;
    height: 60px;
    position: relative;
    margin-bottom: 0px;
    border-bottom: 1px solid #e9eaec;
}

.navigation-bar .website-name {
    width: 100%;
    height: 45px;
    color: #00356b;
    display: flex;
    align-items: center;
}

.navigation-bar .website-name #toggle-sidebar {
    min-width: 40px;
    font-size: 30px;
    cursor: pointer;
    margin-left: 20px;
    margin-top: 15px;
}

.navigation-bar .website-name span {
    margin-top: 15px;
    margin-left: 25px;
    margin-right: 35px;
    font-size: 25px;
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
    color: #00356b;
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

.btn-outline-secondary {
    border-color: rgb(222, 226, 230);
}

.btn-outline-secondary:hover {
    background-color: #2b5177;
}

.btn-outline-secondary:hover #search-icon {
    color: #ffffff;
}

.search-box input {
    width: 400px;
}
.search-box input:focus {
    border-color: #00356b;
    box-shadow: 0 0 0 2px #cadae7;
    outline: none;
}

.position-relative input:focus ~ #search-icon {
    color: #00356b;
}
/* Profile */
.profile {
    margin-left: 20px;
    margin-top: 15px;
    margin-right: 20px;
}

.profile,
.profile button,
.profile a {
    color: #00356b;
}

.profile .dropdown-item:active {
    background-color: #00356b;
    color: white;
}

.profile .dropdown-item:hover {
    background-color: #e9eaec;
    /* background-color: rgb(222,226,230); */
    color: #00356b;
}

.avatar {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    color: #00356b;
    font-size: 20px;
    margin-right: 0px;
}
/* Navigation bar <600px */
.navigation-bar-min-ul {
    text-align: center;
    list-style-type: none;
    padding-left: 0;
    margin-left: 0;
}

#navigation-bar-min-li {
    border-bottom: 1px solid #dce0e8;
    padding-top: 1.5%;
    padding-bottom: 1.5%;
    background-color: #ffffff;
}

#navigation-bar-min-li a {
    text-decoration: none;
}

#navigation-bar-min-li:hover {
    background-color: #00356b;
}

#navigation-bar-min-li:hover a span {
    color: white;
}

.navigation-bar-min {
    width: 100%;
    margin-top: 15px;
    position:relative;
    z-index: 1;
}

.navigation-bar-min span {
    width: 100px;
    white-space: nowrap;
    font-size: 18px;
    text-align: center;
    color: #00356b;
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
    .search-box i {
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
