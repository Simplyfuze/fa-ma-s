<script setup>
import { ref } from "vue";

const emit = defineEmits(["updateUsers"]);

const props = defineProps({
    users: {
        type: Array,
        default: () => [],
    },
    initialUsers: Array,
    errors: Object,
});

const showDropdown = ref(false);
const selectedUsers = ref(!props.initialUsers.length ? [] : props.initialUsers);
</script>

<template>
    <div>
        <div
            class="bg-white rounded-lg p-4 shadow"
            @click="showDropdown = !showDropdown"
        >
            <div
                v-if="selectedUsers.length === 0"
                class="flex justify-center items-center h-full w-full"
            >
                <p class="font-medium">Click to select users</p>
            </div>

            <div
                v-if="selectedUsers.length != 0"
                class="flex flex-wrap gap-2 max-h-[160px] overflow-y-auto"
            >
                <div
                    v-for="user in selectedUsers"
                    :key="user.id"
                    class="flex items-center bg-[#6A64F1] text-white px-3 py-1 rounded-full"
                >
                    <span>{{ user.first_name }} {{ user.last_name }}</span>
                </div>
            </div>

            <p class="text-red-500" v-if="errors"></p>
        </div>

        <div class="relative">
            <div
                v-if="showDropdown && users.length > 0"
                class="user-dropdown absolute z-10 mt-2 w-full bg-white border rounded-lg shadow max-h-60 overflow-y-auto"
                @click.stop
            >
                <div class="border border-[#e0e0e0] rounded-md p-4 bg-white">
                    <div
                        v-for="user in users"
                        :key="user.id"
                        class="flex items-center mb-3"
                    >
                        <input
                            type="checkbox"
                            :id="`user-` + user.id"
                            :value="user"
                            v-model="selectedUsers"
                            class="h-7 w-5 text-[#6A64F1] focus:ring-[#6A64F1] border-gray-300 rounded"
                        />

                        <label
                            :for="'user-' + user.id"
                            class="ml-3 text-base text-gray-800"
                        >
                            {{ user.first_name }} {{ user.last_name }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
