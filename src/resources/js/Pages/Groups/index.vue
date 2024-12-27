<script setup>

import Layout from "../../Shared/Layout.vue";

import groupcard from "../../Shared/GroupCard.vue";

defineProps({
    groups: Array, // Вкажіть тип для props
});

</script>

<template>

    <Layout>

        <div class="mb-8">
            <!-- Base -->

            <Link
                class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                href="groups" as="button"
            >
                Add Group
            </Link>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <groupcard v-for="group in groups" :key="group.id">
                {{ group.name }}
            </groupcard>
        </div>
    </Layout>
</template>

<style scoped>

</style>
