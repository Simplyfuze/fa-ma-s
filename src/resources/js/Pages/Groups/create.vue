<script setup>

import TransferList from "../../Shared/TransferList.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    users: {
        type: Array,
    },
});

const form = useForm({
    groupName: null,
    attachedUsers: null
})

function updateAttachedUsers(users) {
    form.attachedUsers = users;
}

let submit = () => {
    form.post('/groups/create')
}
</script>

<template>
    <section class="p-8 max-w-7xl">
        <h1 class="text-xl font-bold">Create new group</h1>
        <form @submit.prevent="submit">
            <div class="py-4">
                <div class="mb-8">
                    <label for="GroupName" class="block text-lg font-medium text-gray-700"> Group name </label>

                    <input class="w-full px-4 py-2 rounded-lg border border-gray-400" id="groupName" name="groupName"
                           type="text" required v-model="form.groupName">
                    <p v-if="form.errors.groupName" class="text-red-500"> {{ form.errors.groupName }}</p>
                </div>

                <TransferList :items="users"
                              @updateUsers='updateAttachedUsers'/>

            </div>
            <div>
                <button class="w-full bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded-lg"
                        :disabled="form.processing">
                    Create group
                </button>
            </div>

        </form>

    </section>
</template>

<style scoped>

</style>
