<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    title: String,
    href: String,
})

</script>

<template>
    <nav class="my-6">

        <h1 class="text-xl font-bold mb-4">{{`${title}s`}}</h1>

        <Link
            class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
            :href="href" as="button"
        >
            Add {{title}}
        </Link>
    </nav>
</template>

<style scoped>

</style>
