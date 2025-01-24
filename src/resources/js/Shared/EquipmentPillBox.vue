<script setup>
import {computed, ref, watch} from "vue";

const emit = defineEmits(['updateEquipments']);

const props = defineProps({
    equipments: {
        type: Array,
        default: () => [],
    },
    initialEquipments: {
        type: Array,
        default: () => [],
    },
    errors: Object,
});

const showDropdown = ref(false);
const selectedEquipments = ref(!props.initialEquipments.length ? [] : props.initialEquipments);
</script>

<template>
    <div>
        <label for="task_users" class="mb-3 block text-base font-medium">
            Users
        </label>
        <div class="bg-white rounded-lg p-4 shadow" @click="showDropdown = !showDropdown">


            <div v-if="selectedEquipments.length" class="flex flex-wrap gap-2 max-h-[160px] overflow-y-auto">
                <div
                    v-for="equipment in selectedEquipments"
                    :key="equipment.id"
                    class="flex items-center bg-[#6A64F1] text-white px-3 py-1 rounded-full"
                >
                    <span>{{ equipment.brand_name }} {{ equipment.model_name }}</span>
                </div>

            </div>

            <div v-if="!selectedEquipments.length"
                 class="flex justify-center items-center h-full w-full">
                <p>Click to select users</p>
            </div>


            <div class="relative">


                <div
                    v-if="showDropdown && equipments.length > 0"
                    class="user-dropdown absolute z-10 mt-2 w-full bg-white border rounded-lg shadow max-h-60 overflow-y-auto"
                    @click.stop
                >
                    <div class="border border-[#e0e0e0] rounded-md p-4 bg-white">
                        <div v-for="equipment in equipments" :key="equipment.id" class="flex items-center mb-3">
                            <input
                                type="checkbox"
                                :id="`user-` + equipment.id"
                                :value="equipment"
                                v-model="selectedEquipments"
                                class="h-7 w-5 text-[#6A64F1] focus:ring-[#6A64F1] border-gray-300 rounded"
                            />

                            <label :for="'user-' + equipment.id"
                                   class="ml-3 text-base text-gray-800">
                                {{ equipment.brand_name }} {{ equipment.model_name }}
                            </label>

                        </div>
                    </div>

                </div>


            </div>

        </div>
        <p class="text-red-500" v-if="errors"></p>
    </div>
</template>
