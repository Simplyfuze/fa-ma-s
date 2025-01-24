<script setup>
import {Icon} from "@vicons/utils";
import {TrashCan} from "@vicons/carbon";

import {Link, usePage} from "@inertiajs/vue3";
import {computed} from "vue";


const page = usePage()

const user = computed(() => page.props.auth.user)

let props = defineProps({
    users: Array,
    tasks: Array,
    group: String,

})

</script>

<template>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
        <main class="h-auto rounded-lg lg:col-span-2 ">
            <nav class="my-6">

                <h1 class="text-xl font-bold mb-4">Tasks</h1>

                <Link
                    class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                    href="/tasks/create" as="button" v-if="user.role === 'admin' || user.role === 'farmer'" :data="{group: group}"
                >
                    Add Task
                </Link>
            </nav>
            <ul class="bg-white w-full shadow overflow-hidden sm:rounded-md ">

                <li v-if="tasks.length === 0" class="flex rounded-md border border-gray-200 px-4 py-5">
                    <p class="mx-auto">There are no tasks in this group</p>
                </li>

                <li v-for="task in tasks" :key="task.id" class="border-t border-gray-200">
                    <Link :href="`/tasks/${task.id}`" class="font-medium text-indigo-600 hover:text-indigo-500">
                        <div class="flex items-center justify-between">
                            <div class="px-4 py-5 sm:px-6 w-4/5">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ task.task_name }}</h3>

                                </div>
                                <div class="mt-4 flex items-center space-x-6">
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Task type: {{ task.task_type }}</p>
                                    <p class="text-sm font-medium text-gray-500">Status:
                                        <span :class="{
                                      'text-green-600': task.task_status === true,
                                      'text-yellow-600': task.task_status === false,
                                    }">{{ task.task_status ? 'Completed' : 'Pending' }}</span>
                                    </p>
                                </div>
                            </div>
                            <Link method="post" :href="`/tasks/${task.id}/delete`"
                                  class="p-2 me-8 text-gray-500 hover:text-red-500" as="button">
                                <Icon size="32" class="cursor-pointer ">
                                    <TrashCan/>
                                </Icon>
                            </Link>
                        </div>
                    </Link>
                </li>
            </ul>
        </main>
        <aside class="h-auto rounded-lg">
            <div class="p-6 space-y-2 bg-white shadow rounded-md">
                <h1 class="text-xl font-bold">Users</h1>
                <p v-if="users.length === 0">There are no users in this group</p>
                <!--TODO: Make a button to add new users to the group-->
                <div v-for="user in users" :key="user.id" class="flex items-center space-x-2  ">
                    <div class="bg-white px-6 py-2 rounded-mds">
                        <h2 class="text-lg font-semibold">{{ user.first_name }} {{ user.last_name }}</h2>
                        <p class="text-gray-600">{{ user.role }}</p>
                    </div>
                    <!--TODO: Make a button to remove users from the group-->
                </div>
            </div>
        </aside>
    </div>
</template>

<style scoped>

</style>
