<script setup>
import ListItem from "../../Shared/ListItem.vue";
import ListNav from "../../Shared/ListNav.vue";

let props = defineProps({
    equipments: Array,
})

</script>

<template>
    <!--TODO: Make notification when a equipment record was created-->

    <list-nav title="Equipment" href="equipments/create"/>


    <ul class="bg-white w-full shadow overflow-hidden sm:rounded-md ">

        <li v-if="equipments == null" class="border-t border-gray-200">

            <div class="px-4 py-5 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">You don`t have any equipment. Please add
                        equipment</h3>
                </div>
            </div>
        </li>

        <list-item v-for="equipment in equipments"
                   :key="equipment.id"
                   :href="`/equipments/${equipment.id}`">

            {{ `${equipment.brand_name} ${equipment.model_name}` }}

            <template #secondary>
                <p>Registration number: {{ equipment.registration_number ?? 'None' }}</p>
                <p>Year of manufacture: {{ equipment.year_of_manufacture ?? 'None' }}</p>
            </template>

            <template #aside>
                <p>Equipment type: {{equipment.equipment_type}}</p>
            </template>

        </list-item>

    </ul>

</template>

<style scoped>

</style>
