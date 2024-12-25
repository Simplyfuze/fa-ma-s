<script setup>
import { Link } from '@inertiajs/vue3'

let props = defineProps({
    href : String
})

</script>

<template>
    <Link :href="`${href ? href : '#'}`" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
        <slot/>
    </Link>
</template>

<style scoped>

</style>
