<script setup>
import ListNav from "../../Shared/ListNav.vue";
import ListItem from "../../Shared/ListItem.vue";
import EmptyListItem from "../../Shared/EmptyListItem.vue";

let props = defineProps({
    fields: Array,
})
</script>

<template>

    <list-nav title="Field" :href="'/fields/create'"/>

    <ul class="bg-white w-full shadow overflow-hidden sm:rounded-md ">

        <empty-list-item v-if="fields.length === 0">
            You don`t have any fields. Please add field.
        </empty-list-item>

        <list-item v-for="field in fields" :key="field.id" :href="`/fields/${field.id}`">
            {{ field.field_name }}

            <template #secondary>
                <p>Field Size: {{ field.field_size }} ha</p>
            </template>

        </list-item>
    </ul>
</template>

<style scoped>

</style>
