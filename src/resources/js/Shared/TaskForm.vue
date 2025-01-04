<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    task: {
        type: Object,
    },
    isUpdate: Boolean,
})

const form = useForm({
    task_name: null,
    task_description: null,
    task_type: null,
    task_status: null,
})

if (props.task) {
    form.task_name = props.task.task_name;
    form.task_description = props.task.task_description;
    form.task_type = props.task.task_type;
    form.task_status = props.task.task_status;
}
let submit = () => {
    if (props.isUpdate)
        form.post(`/task/${props.task.id}/update`)
    else
        form.post('/task/create')
}

let back = () => {
    window.history.back();
}
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6 py-6">
        <h1 class="text-xl font-bold">{{ isUpdate ? 'Update' : 'Add new' }} task</h1>
        <div class="-mx-3 ">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="task_description" class="mb-3 block text-base font-medium text-[#07074D]">
                        Task Name
                    </label>
                    <input type="text" name="task_description"
                           id="task_description" placeholder="Enter task name" v-model="form.task_name"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-gray-800 outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.task_name">{{ form.errors.task_name }}</p>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="task_description" class="mb-3 block text-base font-medium text-[#07074D]">
                        Task Description
                    </label>
                    <input type="text" name="task_description"
                           id="task_description" placeholder="Enter task description" v-model="form.task_description"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-gray-800 outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.task_description">{{ form.errors.task_description }}</p>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="task_type" class="mb-3 block text-base font-medium text-[#07074D]">
                        Task Type
                    </label>
                    <input type="text" name="task_type"
                           id="task_type" placeholder="Enter task type" v-model="form.task_type"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-gray-800 outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.task_type">{{ form.errors.task_type }}</p>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <label class="mb-3 block text-base font-medium text-[#07074D]">
                Task Status
            </label>
            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <input type="radio" name="task_status" id="statusPending" class="h-5 w-5" v-model="form.task_status"
                           value="false"/>
                    <label for="statusPending" class="pl-3 text-base font-medium text-[#07074D]">
                        Pending
                    </label>
                </div>
                <div class="flex items-center">
                    <input type="radio" name="task_status" id="statusCompleted" class="h-5 w-5"
                           v-model="form.task_status"
                           value="true"/>
                    <label for="statusCompleted" class="pl-3 text-base font-medium text-[#07074D]">
                        Completed
                    </label>
                </div>
            </div>
        </div>

        <div class="space-x-8">
            <Link @click.prevent="back" as="button"
                  class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                Back
            </Link>
            <button
                class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                {{ isUpdate ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</template>

<style scoped>
</style>
