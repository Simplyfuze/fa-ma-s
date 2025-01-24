<script setup>

import GroupCard from "../../Shared/GroupCard.vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    groups: Array,
    role: String,
});

</script>

<template #default="{role}">
    <nav class="my-6">

        <h1 class="text-xl font-bold mb-4">Groups</h1>

        <Link
            class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
            v-if="role === 'admin'"
            :href="href" as="button"
        >
            Add Group
        </Link>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <group-card v-for="group in groups"
                   :key="group.id"
                   :show_href="`/groups/${group.id}`"
                   :delete_href="`/groups/delete/${group.id}`">
            {{ group.group_name }}
        </group-card>
    </div>
</template>

<style scoped>

</style>
