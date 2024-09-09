<template>
    <body>
        <section class="center-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="container-image">
                                <img
                                    src="https://www.cincinnati.com/gcdn/presto/2021/07/08/NCCT/41a860e4-8fbc-44b3-a555-cd735e05f8c4-07082021ceb_02.JPG?width=660&height=441&fit=crop&format=pjpg&auto=webp"
                                />
                                <div>
                                    <div class="top-left">
                                        <div class="text-overlay" style="font-size: 30px" ref="title">
                                            {{ titleText }}
                                        </div>

                                        <div class="text-overlay second-text" ref="subtitle">{{ subtitleText }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="login-wrap p-4 p-md-5">
                                <form @submit.prevent="submit" class="signin-form">
                                    <!-- Email -->
                                    <label class="label input-label" for="email">EMAIL</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="email"><BIconEnvelope></BIconEnvelope></span>
                                        </div>
                                        <input
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            class="form-control"
                                            placeholder="Email"
                                            aria-label="email"
                                            aria-describedby="email"
                                            autocomplete="username"
                                            required
                                        />
                                    </div>
                                    <!-- Password -->
                                    <label class="label input-label" for="password">CONTRASEÑA</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="password"><BIconLock></BIconLock></span>
                                        </div>
                                        <input
                                            id="password"
                                            v-model="form.password"
                                            type="password"
                                            class="form-control"
                                            placeholder="Contraseña"
                                            aria-label="password"
                                            aria-describedby="password"
                                            autocomplete="current-password"
                                            required
                                        />
                                    </div>

                                    <!-- Login button -->
                                    <div class="form-group">
                                        <button :disabled="form.processing" type="submit" class="form-control btn btn-primary rounded submit px-3">
                                            Iniciar sesión
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</template>

<script setup>
import { BIconEnvelope, BIconLock } from "bootstrap-icons-vue";
import { ref, onMounted, computed } from "vue";
import { useForm } from "@inertiajs/vue3";

// Typewritter animation on title and subtitle
const props = defineProps({
    titleText: {
        type: String,
        default: "GESTIÓN DOCUMENTAL",
    },
    subtitleText: {
        type: String,
        default: "| ESCUELA DE INFORMÁTICA E INTELIGENCIA ARTIFICIAL",
    },
    speed: {
        type: Number,
        default: 30,
    },
});

const title = ref(null);
const subtitle = ref(null);
const firstCurrentIndex = ref(0);
const secondCurrentIndex = ref(0);

const titleText = computed(() => props.titleText.slice(0, firstCurrentIndex.value));
const subtitleText = computed(() => props.subtitleText.slice(0, secondCurrentIndex.value));

const typeTitleText = () => {
    if (firstCurrentIndex.value < props.titleText.length) {
        firstCurrentIndex.value++;
        setTimeout(typeTitleText, props.speed);
    } else {
        setTimeout(typeSubtitleText, props.speed);
    }
};

const typeSubtitleText = () => {
    if (secondCurrentIndex.value < props.subtitleText.length) {
        secondCurrentIndex.value++;
        setTimeout(typeSubtitleText, props.speed - 10);
    }
};

// For logging in
const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
        preserveState: true,
    });
};

onMounted(() => {
    typeTitleText();
});
</script>

<style scoped>
section {
    display: block;
}

label {
    display: inline-block;
    margin-bottom: 0.5rem;
}

.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

.row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-12,
.col-lg-10 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

@media (min-width: 768px) {
    .col-md-12 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
}

@media (min-width: 992px) {
    .col-lg-10 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 83.33333%;
        flex: 0 0 83.33333%;
        max-width: 83.33333%;
    }
}

.form-group {
    margin-bottom: 1rem;
}

.input-group-prepend,
.input-group-append {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

.input-group-text {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0.375rem 0.75rem;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

.input-group > .input-group-prepend > .btn,
.input-group > .input-group-prepend > .input-group-text,
.input-group > .input-group-append:not(:last-child) > .btn,
.input-group > .input-group-append:not(:last-child) > .input-group-text,
.input-group > .input-group-append:last-child > .btn:not(:last-child):not(.dropdown-toggle),
.input-group > .input-group-append:last-child > .input-group-text:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.rounded {
    border-radius: 0.25rem !important;
}

@media (min-width: 768px) {
    .d-md-flex {
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
    }
}

.justify-content-center {
    -webkit-box-pack: center !important;
    -ms-flex-pack: center !important;
    justify-content: center !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.px-3 {
    padding-right: 1rem !important;
}

.p-4 {
    padding: 1.5rem !important;
}

@media (min-width: 768px) {
    .p-md-5 {
        padding: 3rem !important;
    }
}

body {
    font-size: 16px;
    line-height: 1.8;
    background: rgb(242, 242, 242);
    color: gray;
}

.bg-primary {
    background: #00356b !important;
}

.center-section {
    padding: 7em 0;
}

.wrap {
    width: 100%;
    overflow: hidden;
    background: #fff;
    border-radius: 5px;
    -webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
    -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
    box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
}

.login-wrap {
    width: 50%;
}
@media (max-width: 991.98px) {
    .login-wrap {
        width: 100%;
    }
}

@media (max-width: 767.98px) {
    .wrap {
        height: 250px;
    }
}

.login-wrap {
    position: relative;
    background: #fff h3;
}

.form-group {
    position: relative;
}
.form-group .label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #000;
    font-weight: 700;
}
.form-group a {
    color: gray;
}

.form-control {
    height: 48px;
    background: #fff;
    color: #000;
    font-size: 16px;
    border-radius: 5px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid rgba(0, 0, 0, 0.1);
}
.form-control::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: rgba(0, 0, 0, 0.2) !important;
}
.form-control::-moz-placeholder {
    /* Firefox 19+ */
    color: rgba(0, 0, 0, 0.2) !important;
}
.form-control:-ms-input-placeholder {
    /* IE 10+ */
    color: rgba(0, 0, 0, 0.2) !important;
}
.form-control:-moz-placeholder {
    /* Firefox 18- */
    color: rgba(0, 0, 0, 0.2) !important;
}
.form-control:focus,
.form-control:active {
    outline: none !important;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid #00356b;
}

.btn {
    cursor: pointer;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    font-size: 15px;
    padding: 10px 20px;
}
.btn:hover,
.btn:active,
.btn:focus {
    outline: none;
}
.btn.btn-primary {
    background: #00356b !important;
    border: 1px solid #00356b !important;
    color: #fff !important;
}
.btn.btn-primary:hover {
    border: 1px solid #00356b;
    background: transparent;
    color: #00356b;
}
.btn.btn-primary.btn-outline-primary {
    border: 1px solid #00356b;
    background: transparent;
    color: #00356b;
}
.btn.btn-primary.btn-outline-primary:hover {
    border: 1px solid transparent;
    background: #00356b;
    color: #fff;
}

.input-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #00356b;
    font-weight: 700;
}

.container-image {
    position: relative;
    color: white;
    width: 50%;
}

.container-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(50%);
}

/* Text over image */
.top-left {
    position: absolute;
    top: 10px;
}

.text-overlay {
    font-size: 24px;
    font-weight: bold;
    color: rgb(255, 255, 255);
    padding: 15px 0px 0px 24px;
}

.second-text {
    color: white;
    word-wrap: break-word;
    max-width: 26ch;
}

.second-text::first-letter {
    color: rgb(68, 182, 227);
}
</style>
