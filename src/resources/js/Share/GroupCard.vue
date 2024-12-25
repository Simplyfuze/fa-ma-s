<script setup>

import { Link } from '@inertiajs/vue3'

let props = defineProps({
    href: String,
})

</script>

<template>

    <Link :href="`${href ? href : '#'}`">
        <div class="bg-white rounded-xl shadow-lg p-6 h-64 duration-300 hover:-translate-y-1 hover:shadow-xl">

            <h3 class="text-xl font-bold text-indigo-800">
                <slot/>
            </h3>

        </div>
    </Link>
</template>

<style scoped>

</style>
