<script setup>

import { Link } from '@inertiajs/vue3'
import {Icon} from "@vicons/utils";
import { TrashCan } from '@vicons/carbon'

let props = defineProps({
    show_href: String,
    delete_href: String,
})

</script>

<template>

    <Link :href="`${show_href ? show_href : '#'}`">
        <div
            class="flex justify-between bg-white items-center rounded-xl shadow-lg p-6 h-32 duration-300 hover:-translate-y-1 hover:shadow-xl">
            <h3 class="text-xl font-bold text-indigo-800">
                <slot/>
            </h3>

            <Link method="post" :href="`${delete_href ? delete_href : '#'}`" class="p-2 text-gray-500 hover:text-red-500" as="button">
                <Icon size="32" class="cursor-pointer ">
                    <TrashCan/>
                </Icon>
            </Link>
        </div>
    </Link>
</template>

<style scoped>

</style>
