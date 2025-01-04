<script setup>

import UserForm from "../../Shared/UserForm.vue";

const props = defineProps({
    user: {
        type: Object,
    },
})


</script>

<template>
    <UserForm :isUpdate="true" :user="user"/>
</template>

<style scoped>

</style>
