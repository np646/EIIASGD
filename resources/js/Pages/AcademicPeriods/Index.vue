<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <div>
                <h1>Periodos académicos</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Periodo</th>
                            <th>Año</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="academicPeriod in academicPeriods" :key="academicPeriod.id">
                            <td>{{ academicPeriod.period }}</td>
                            <td>{{ academicPeriod.year }}</td>
                            <td>
                                <Link :href="route('academicPeriods.edit', academicPeriod.id)">Editar</Link>
                                <form :action="route('academicPeriods.destroy', academicPeriod.id)" method="POST">
                                    <!-- TODO: instead of erasing the academicPeriod from the database, the status is changed -->
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Link :href="route('academicPeriods.create')">Crear nuevo periodo académico</Link>
            </div>
        </div>
    </MenuLayout>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
const { academicPeriods } = usePage().props;
</script>

<style scoped>
/* TODO: should be global styles for the stuff inside slot */
.profile-info {
    max-width: 800px;
    padding-top: 20px;
    padding-left: 40px;
}
</style>
