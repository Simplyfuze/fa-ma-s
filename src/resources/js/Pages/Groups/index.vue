<script setup>

import GroupCard from "../../Shared/GroupCard.vue";
import ListNav from "../../Shared/ListNav.vue";

defineProps({
    groups: Array,
});

</script>

<template>
    <!--TODO: Add search bar-->
    <list-nav title="Group" href="/groups/create"/>

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
