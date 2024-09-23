<template v-slot:slot-content>
    <MenuLayout>
        <div class="profile-info">
            <div>
                <h1>Estudiantes</h1>
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
                        <tr v-for="student in students" :key="student.id">
                            <td>{{ student.name }}</td>
                            <td>{{ student.email }}</td>
                            <td>{{ student.age }}</td>
                            <td>
                                <Link :href="route('students.edit', student.id)">Editar</Link>
                                <form :action="route('students.destroy', student.id)" method="POST">
                                    <!-- TODO: instead of erasing the student from the database, the status is changed -->
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Link :href="route('students.create')">Crear nuevo estudiante</Link>
            </div>
        </div>
    </MenuLayout>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import MenuLayout from "@/Layouts/MenuLayout.vue";
const { students } = usePage().props;
</script>
