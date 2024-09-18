<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <div>
                <h1>Docentes</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="professor in professors" :key="professor.id">
                            <td>{{ professor.name }}</td>
                            <td>{{ professor.email }}</td>
                            <td>{{ professor.age }}</td>
                            <td>
                                <Link :href="route('professors.edit', professor.id)">Editar</Link>
                                <form :action="route('professors.destroy', professor.id)" method="POST">
                                    <!-- TODO: instead of erasing the professor from the database, the status is changed -->
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Link :href="route('professors.create')">Crear nuevo docente</Link>
            </div>
        </div>
    </MenuLayout>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
const { professors } = usePage().props;
</script>

<style scoped>
/* TODO: should be global styles for the stuff inside slot */
.profile-info {
    max-width: 800px;
    padding-top: 20px;
    padding-left: 40px;
}
</style>
