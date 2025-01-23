<template>
    <Head title="Iniciar sesión" />
    <body>
        <section class="center-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="container-image">
                                <img src="/img/login.jpg" />
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
                                    <label class="label input-label" for="identifier">USUARIO</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="email"><BIconEnvelope></BIconEnvelope></span>
                                        </div>
                                        <input
                                            id="identifier"
                                            v-model="form.identifier"
                                            type="text"
                                            class="form-control"
                                            placeholder="Usuario"
                                            autocomplete="username"
                                            required
                                        />
                                        <span v-if="form.errors.identifier">{{ form.errors.identifier }}</span>
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
                                        <span v-if="form.errors.password">{{ form.errors.password }}</span>
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
import { Head } from "@inertiajs/vue3";
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
    identifier: "",
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

body {
    font-size: 16px;
    line-height: 1.8;
    background: var(--background-color);
    color: gray;
    font-family: var(--font-family-base) !important;
    height: 100vh;
}

.center-section {
    padding: 7em 0;
}

.wrap {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    border-radius: 5px;
    box-shadow: 0px 10px 34px -15px #0000003d;
    display: flex;
    overflow: hidden;
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

.login-wrap {
    width: 50%;
    padding: 3rem;
    background: white;
}

.top-left {
    position: absolute;
    top: 10px;
    left: 24px;
}

.text-overlay {
    font-size: 24px;
    font-weight: bold;
    color: white;
}

.second-text {
    color: white;
    word-wrap: break-word;
    max-width: 26ch;
}

.second-text::first-letter {
    color: #44b6e3;
}

/* Form styles */
.form-group {
    margin-bottom: 1rem;
}

.input-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--main-color);
    font-weight: 700;
}

.input-group-text {
    display: flex;
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
    border: 1px solid var(--border-color);
    border-radius: 0.25rem;
}
.input-group-prepend,
.input-group-append {
    display: flex;
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

.form-control {
    height: 48px;
    background: white;
    color: black;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}
.form-control:focus,
.form-control:active {
    outline: none !important;
    box-shadow: none;
    border: 1px solid var(--main-color);
}
.btn.btn-primary {
    background: var(--main-color) !important;
    border: 1px solid var(--main-color) !important;
    color: white !important;
    cursor: pointer;
    font-size: 15px;
    padding: 10px 20px;
    width: 100%;
}

/* Responsive styles */
@media (max-width: 768px) {
    .center-section {
        padding: 2em 0;
    }

    .wrap {
        flex-direction: column;
        max-width: 100%;
    }

    .container-image,
    .login-wrap {
        width: 100%;
    }

    .container-image {
        height: 200px;
    }

    .login-wrap {
        padding: 2rem;
    }

    .top-left {
        padding: 15px;
    }

    .text-overlay {
        font-size: 20px;
    }

    .second-text {
        font-size: 14px;
        max-width: 100%;
    }
}
</style>
