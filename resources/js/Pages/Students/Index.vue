<template>
    <div>
        <h1>Students</h1>
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
                        <inertia-link :href="route('students.edit', student.id)">Edit</inertia-link>
                        <form :action="route('students.destroy', student.id)" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <inertia-link :href="route('students.create')">Create New Student</inertia-link>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'

const { students } = usePage().props
</script>
