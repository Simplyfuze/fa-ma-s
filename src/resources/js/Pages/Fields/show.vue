<script setup>
import FieldForm from "../../Shared/FieldForm.vue";

const props = defineProps({
    field: {
        type: Object,
    },
})

</script>

<template>

    <FieldForm :isUpdate="true" :field="field"/>

</template>

<style scoped>

</style>
