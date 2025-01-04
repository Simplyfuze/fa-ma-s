<script setup>

import ListNav from "../../Shared/ListNav.vue";
import EmptyListItem from "../../Shared/EmptyListItem.vue";
import ListItem from "../../Shared/ListItem.vue";

let props = defineProps({
    users: Array,
})
</script>

<template>

    <list-nav title="User" href="users/create"/>

    <ul class="bg-white w-full shadow overflow-hidden sm:rounded-md ">

        <empty-list-item v-if="users.length === 0">
            You don`t have any equipment. Please add equipment
        </empty-list-item>

        <list-item v-for="user in users" :key="user.id" :href="`/users/${user.id}`">

            {{ user.first_name }} {{ user.last_name }}

            <template #secondary>
                <p>Role: {{ user.role }}</p>
            </template>
        </list-item>
    </ul>

</template>

<style scoped>

</style>
