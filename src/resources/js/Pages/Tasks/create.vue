<script setup>
import TaskForm from "../../Shared/TaskForm.vue";

const props = defineProps({
    consumables: {
        type: Array,
        default: () => [],
    },
    equipments: {
        type: Array,
        default: () => [],
    },
    users  : {
        type: Array,
        default: () => [],
    },
    fields : {
        type: Array,
        default: () => [],
    },
    group : String,
})

</script>

<template>
    <TaskForm :isUpdate="false" :consumables="consumables"
              :equipments="equipments" :users="users"
              :fields="fields" :group="group"/>
</template>

<style scoped>

</style>
