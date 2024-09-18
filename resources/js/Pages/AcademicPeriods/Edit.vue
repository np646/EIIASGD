<!-- TODO: maybe swap this for a modal -->
<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <div>
                <!-- TODO: this text is too big -->
                <h1>Editar información de periodo</h1>
                <form @submit.prevent="submit" class="row g-3">
                    <div class="col-md-6">
                        <label for="inputPeriodo" class="form-label">Periodo:</label>
                        <input v-model="form.period" type="text" class="form-control" id="inputPeriodo" required />
                    </div>
                    <div class="col-md-6">
                        <label for="inputAno" class="form-label">Año:</label>
                        <input v-model="form.year" type="text" class="form-control" id="inputAno" required />
                    </div>
                    <!-- TODO: Send state by default -->
                    <div>
                        <label>Estado:</label>
                        <input v-model="form.status" type="number" />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </MenuLayout>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
const { academicPeriod } = usePage().props;
const form = useForm({
    period: academicPeriod.period,
    year: academicPeriod.year,
});

const submit = () => {
    form.put(route("academicPeriods.update", academicPeriod.id));
};
</script>

<style scoped>
/* TODO: should be global styles for the stuff inside slot */
.profile-info {
    max-width: 800px;
    padding-top: 20px;
    padding-left: 40px;
}
</style>
