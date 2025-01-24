<script setup>
import { computed, ref, watch } from "vue";

const emit = defineEmits(["updateUsers"]);

const props = defineProps({
    items: {
        type: Array,
        default: () => [],
    },
    initialItems: Array,
    keys: Array,
    label: String,
    errors: Object,
});

const showDropdown = ref(false);
const selectedItems = ref(!props.initialItems.length ? [] : props.initialItems);
</script>

<template>
    <div>
        <div
            class="bg-white rounded-lg p-4 shadow"
            @click="showDropdown = !showDropdown"
        >
            <div
                v-if="selectedItems.length === 0"
                class="flex justify-center items-center h-full w-full"
            >
                <p class="font-medium">
                    {{ `Click to select ${label.toLowerCase()}s` }}
                </p>
            </div>

            <div
                v-if="selectedItems.length != 0"
                class="flex flex-wrap gap-2 max-h-[160px] min-h-[160px]: overflow-y-auto"
            >
                <div
                    v-for="item in selectedItems"
                    :key="item.id"
                    class="flex items-center bg-[#6A64F1] text-white px-3 py-1 rounded-full"
                >
                    <span
                        >{{ item[keys[0]] ?? "" }}
                        {{ item[keys[1]] ?? "" }}</span
                    >
                </div>
            </div>

            <p class="text-red-500" v-if="errors"></p>
        </div>

        <div class="relative">
            <div
                v-if="showDropdown && items.length > 0"
                class="user-dropdown absolute z-10 mt-2 w-full bg-white border rounded-lg shadow max-h-60 overflow-y-auto"
                @click.stop
            >
                <div class="border border-[#e0e0e0] rounded-md p-4 bg-white">
                    <div
                        v-for="item in items"
                        :key="item.id"
                        class="flex items-center mb-3"
                    >
                        <input
                            type="checkbox"
                            :id="label.toLowerCase() + item.id"
                            :value="item"
                            v-model="selectedItems"
                            class="h-7 w-5 text-[#6A64F1] focus:ring-[#6A64F1] border-gray-300 rounded"
                        />

                        <label
                            :for="'item-' + item.id"
                            class="ml-3 text-base text-gray-800"
                        >
                            {{ item[keys[0]] ?? "" }} {{ item[keys[1]] ?? "" }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
