<script setup>

import ConsumableForm from "../../Shared/ConsumableForm.vue";

const props = defineProps({
    consumable: {
        type: Object,
    },
})


</script>

<template>
    <ConsumableForm :isUpdate="true" :consumable="consumable"/>
</template>

<style scoped>

</style>
