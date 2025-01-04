<script setup>
import TaskForm from "../../Shared/TaskForm.vue";

const props = defineProps({
    task: {
        type: Object,
    },
})


</script>

<template>
    <TaskForm :isUpdate="true" :task="task"/>
</template>

<style scoped>

</style>
