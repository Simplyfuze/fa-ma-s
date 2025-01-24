<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    task: Object,
    group: String,
    field: Object,
    consumables: {
        type: Array,
        default: () => [],
    },
    equipments: {
        type: Array,
        default: () => [],
    },
    users: {
        type: Array,
        default: () => [],
    },
});


const form = useForm({
    task_status: props.task.task_status,
})


let submit = () => {
    form.post(`/tasks/${props.task.id}/update`)
}

</script>

<template>

    <form @submit.prevent="submit" class="space-y-4 py-6">
        <h1 class="text-xl font-bold">View Task</h1>
        <div class="-mx-3 flex">
            <div class="w-full px-3 sm:w-1/2">
                <div>
                    <label class="mb-3 block text-base font-medium">
                        Task Name
                    </label>
                    <p class="py-3 px-6 bg-white rounded-md">{{ task.task_name }}</p>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div>
                    <label class="mb-3 block text-base font-medium">
                        Task Type
                    </label>
                    <p class="py-3 px-6 bg-white rounded-md">{{ task.task_type }}</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-2 lg:grid-cols-2 lg:gap-4">

            <div class="px-1 ">
                <label class="mb-3 block text-base font-medium">Users</label>
                <ul class="space-y-3 text-lg bg-white rounded-lg p-3 ">
                    <li class="flex space-x-3"
                        v-for="user in users">
                        <span class="">{{ user.first_name }} {{ user.last_name }}</span>
                    </li>
                </ul>
            </div>
            <div class="px-1 ">
                <label class="mb-3 block text-base font-medium">Equipments</label>
                <ul class="space-y-3 text-lg bg-white rounded-lg p-3 ">
                    <li class="flex space-x-3"
                        v-for="equipment in equipments">
                        <span class="">{{ equipment.brand_name }} {{ equipment.model_name }}</span>
                    </li>
                </ul>
            </div>

        </div>
        <div class="grid grid-cols-1 gap-2 lg:grid-cols-2 lg:gap-4">
            <div class="px-1 ">
                <label class="mb-3 block text-base font-medium">Consumables</label>
                <ul class="space-y-3 text-lg bg-white rounded-lg p-3 ">
                    <li class="flex space-x-3"
                        v-if="consumables.length === 0">
                        <span class="">No consumable selected</span>
                    </li>
                    <li class="flex space-x-3"
                        v-for="consumable in consumables">
                        <span class="">{{ consumable.consumable_name }} {{ consumable.type }}</span>
                    </li>
                </ul>
            </div>
            <div class="px-1">
                <label class="mb-3 block text-base font-medium">
                    Field
                </label>
                <p class="py-3 px-6  rounded-md">{{ field?.field_name || 'No field selected' }}</p>
            </div>
        </div>
        <div class="w-1/2">
            <label class="mb-3 block text-base font-medium">
                Task Description
            </label>
            <p class="py-3 px-6 bg-white  rounded-md">{{ task.task_description }}</p>
        </div>
        <div>
            <label class="mb-3 block text-base font-medium ">
                Task Status
            </label>
            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <input type="radio" name="task_status" id="statusPending" class="h-5 w-5" v-model="form.task_status"
                           value="false"/>
                    <label for="statusPending" class="pl-3 text-base font-medium ">
                        Pending
                    </label>
                </div>
                <div class="flex items-center">
                    <input type="radio" name="task_status" id="statusCompleted" class="h-5 w-5"
                           v-model="form.task_status"
                           value="true"/>
                    <label for="statusCompleted" class="pl-3 text-base font-medium ">
                        Completed
                    </label>
                </div>
            </div>
        </div>
        <div>
            <button type="submit"
                    class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                Update Task Status
            </button>
        </div>
    </form>

</template>

<style scoped>

</style>
