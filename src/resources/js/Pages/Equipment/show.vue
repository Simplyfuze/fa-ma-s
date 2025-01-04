<script setup>
import EquipmentForm from "../../Shared/EquipmentForm.vue";

const props = defineProps({
    equipment: {
        type: Object,
    },
})

</script>

<template>

    <EquipmentForm :isUpdate="true" :equipment="equipment"/>

</template>

<style scoped>

</style>
