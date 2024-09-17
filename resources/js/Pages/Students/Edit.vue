<template>
    <div>
        <h1>Edit Student</h1>
        <form @submit.prevent="submit">
            <div>
                <label>Name:</label>
                <input v-model="form.name" type="text">
            </div>
            <div>
                <label>Email:</label>
                <input v-model="form.email" type="email">
            </div>
            <div>
                <label>Age:</label>
                <input v-model="form.age" type="number">
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'

const { student } = usePage().props
const form = useForm({
    name: student.name,
    email: student.email,
    age: student.age
})

const submit = () => {
    form.put(route('students.update', student.id))
}
</script>
