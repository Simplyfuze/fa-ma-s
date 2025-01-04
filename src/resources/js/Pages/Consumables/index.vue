<script setup>

import ListNav from "../../Shared/ListNav.vue";
import ListItem from "../../Shared/ListItem.vue";
import EmptyListItem from "../../Shared/EmptyListItem.vue";

let props = defineProps({
    consumables: Array,
})
</script>

<template>

    <!--TODO: Make notification when a consumable record was created-->
    <list-nav title="Consumable" href="consumables/create"/>

    <ul class="bg-white w-full shadow overflow-hidden sm:rounded-md ">

        <empty-list-item v-if="consumables.length === 0">
            You don`t have any consumable. Please add consumable
        </empty-list-item>

        <list-item v-for="consumable in consumables" :key="consumable.id"
                   :href="`/consumables/${consumable.id}`">
            {{ consumable.consumable_name }}

            <template #secondary>
                <p>Type: {{ consumable.consumable_type }}</p>
            </template>
        </list-item>

    </ul>
</template>

<style scoped>

</style>
