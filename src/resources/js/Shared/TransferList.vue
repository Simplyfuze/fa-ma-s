<script setup>
import {ref} from "vue";
import {ArrowLeft, ArrowRight} from '@vicons/carbon'
import { Icon } from '@vicons/utils'

const emit = defineEmits(['updateUsers'])
const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const leftItems = ref(props.items);
const rightItems = ref([]);

const moveToRight = (item) => {
    leftItems.value = leftItems.value.filter((i) => i.id !== item.id);
    rightItems.value.push(item);
    emit('updateUsers', rightItems);
};

const moveToLeft = (item) => {
    rightItems.value = rightItems.value.filter((i) => i.id !== item.id);
    leftItems.value.push(item);
    emit('updateUsers', rightItems);
};
</script>

<template>
    <label for="GroupName" class="block text-lg font-medium text-gray-700"> Add users to group </label>
    <div class="flex space-x-8 max-h-full" >

        <!-- Left List -->
        <div class="flex-1 border rounded p-4">
            <h3 class="text-lg font-semibold mb-2">Available users</h3>
            <ul class="space-y-2">
                <li
                    v-for="item in leftItems"
                    :key="item.id"
                    class="flex items-center justify-between p-2 bg-gray-100 rounded hover:bg-gray-200"
                >
                    <span>{{ item.first_name }} {{ item.last_name }} <span>{{ item.role }} </span></span>
                    <button
                        class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                        @click="moveToRight(item)"
                    >
                        <Icon>
                            <ArrowRight/>
                        </Icon>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Right List -->
        <div class="flex-1 border rounded p-4">
            <h3 class="text-lg font-semibold mb-2">Selected users</h3>
            <ul class="space-y-2">
                <li v-if="rightItems.length === 0" >Please select users from left list</li>
                <li
                    v-for="item in rightItems"
                    :key="item.id"
                    class="flex items-center justify-between p-2 bg-gray-100 rounded hover:bg-gray-200"
                >
                    <span>{{ item.first_name }} {{ item.last_name }} <span>{{ item.role }}</span> </span>
                    <button
                        class="px-2 py-1 bg-primary text-white rounded hover:bg-primary_hover"
                        @click="moveToLeft(item)"
                    >
                        <Icon>
                            <ArrowLeft/>
                        </Icon>
                    </button>
                </li>
            </ul>
        </div>
    </div>

</template>
