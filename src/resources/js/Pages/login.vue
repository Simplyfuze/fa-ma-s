<script setup>

import { useForm } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null,
})

let submit = () => {
    form.post('/login', )
}

</script>

<template>
    <div class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="w-full px-4 py-2 rounded-lg border border-gray-400" id="email" name="email"
                           type="email" v-model="form.email">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="w-full px-4 py-2 rounded-lg border border-gray-400" id="password" name="password"
                           type="password" v-model="form.password">
                </div>
                <div>
                    <button class="w-full bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded-lg"
                            :disabled="form.processing">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
