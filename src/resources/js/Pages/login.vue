<script setup>

</script>

<template>
    <div class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md">
<!--            <h1 class="text-4xl font-bold text-center text-purple-700 mb-8"></h1>-->
            <form class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="w-full px-4 py-2 rounded-lg border border-gray-400" id="email" name="email"
                           type="email">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="w-full px-4 py-2 rounded-lg border border-gray-400" id="password" name="password"
                           type="password">
                </div>
                <div>
                    <button class="w-full bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded-lg">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
