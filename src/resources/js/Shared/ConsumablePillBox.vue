<script setup>
import { computed, ref, watch } from "vue";

const emit = defineEmits(["updateConsumablesId"]);

const props = defineProps({
    consumables: {
        type: Array,
        default: () => [],
    },
    initialConsumables: {
        type: Array,
        default: () => [],
    },
    errors: Object,
});

const searchConsumable = ref("");
const showDropdown = ref(false);
const selectedConsumables = ref(props.initialConsumables);

// Обчислюємо вибрані витратні матеріали на основі ID
const selectedConsumablesList = computed(() =>
    props.consumables.filter((consumable) =>
        selectedConsumables.value.includes(consumable.id)
    )
);

const filteredConsumables = computed(() =>
    props.consumables.filter(
        (consumable) =>
            (consumable.consumable_name
                .toLowerCase()
                .includes(searchConsumable.value.toLowerCase()) ||
                consumable.consumable_type
                    .toLowerCase()
                    .includes(searchConsumable.value.toLowerCase())) &&
            !selectedConsumables.value.includes(consumable.id)
    )
);

const selectConsumable = (consumable) => {
    selectedConsumables.value = [...selectedConsumables.value, consumable.id];
    emit("updateConsumablesId", selectedConsumables.value);
    searchConsumable.value = "";
    showDropdown.value = false;
};

const removeConsumable = (consumableId) => {
    selectedConsumables.value = selectedConsumables.value.filter(
        (id) => id !== consumableId
    );
    emit("updateConsumablesId", selectedConsumables.value);
};

const addConsumableFromSearch = () => {
    if (searchConsumable.value.trim() === "") return;

    const matchedConsumable = props.consumables.find(
        (consumable) =>
            consumable.consumable_name
                .toLowerCase()
                .includes(searchConsumable.value.toLowerCase()) ||
            consumable.consumable_type
                .toLowerCase()
                .includes(searchConsumable.value.toLowerCase())
    );

    if (
        matchedConsumable &&
        !selectedConsumables.value.includes(matchedConsumable.id)
    ) {
        selectConsumable(matchedConsumable);
    }
};

watch(searchConsumable, (value) => {
    showDropdown.value = value.trim().length > 0;
});
</script>

<template>
    <div class="px-1">
        <div>
            <label
                for="task_consumables"
                class="mb-3 block text-base font-medium"
            >
                Consumables
            </label>
            <div class="border rounded-lg p-2 shadow">
                <div class="flex flex-wrap gap-2 mb-4">
                    <div
                        v-for="consumable in selectedConsumablesList"
                        :key="consumable.id"
                        class="flex items-center bg-[#6A64F1] text-white px-3 py-1 rounded-full"
                    >
                        <span
                            >{{ consumable.consumable_name }}
                            {{ consumable.consumable_type }}</span
                        >
                        <button
                            type="button"
                            @click="removeConsumable(consumable.id)"
                            class="ml-2 text-sm font-bold hover:text-red-500"
                        >
                            ✕
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <input
                        type="text"
                        v-model="searchConsumable"
                        placeholder="Search and add consumable..."
                        class="consumable-search w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-[#6A64F1]"
                        @focus="showDropdown = true"
                        @keyup.enter.prevent="addConsumableFromSearch"
                    />

                    <div
                        v-if="showDropdown && filteredConsumables.length > 0"
                        class="consumable-dropdown absolute z-10 mt-2 w-full bg-white border rounded-lg shadow max-h-40 overflow-y-auto"
                    >
                        <ul>
                            <li
                                v-for="consumable in filteredConsumables"
                                :key="consumable.id"
                                @click="selectConsumable(consumable)"
                                class="px-4 py-2 cursor-pointer hover:bg-blue-100"
                            >
                                {{ consumable.consumable_name }}
                                {{ consumable.consumable_type }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="text-red-500" v-if="errors.consumables">
                {{ errors.consumables }}
            </p>
        </div>
    </div>
</template>
