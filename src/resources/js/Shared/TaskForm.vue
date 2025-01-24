<script setup>
import { useForm } from "@inertiajs/vue3";
import EquipmentPillBox from "./EquipmentPillBox.vue";
import MultiSelect from "./MultiSelect.vue";

const props = defineProps({
    task: Object,
    group: String,
    fields: {
        type: Array,
        default: () => [],
    },
    selectedField: Object,
    consumables: {
        type: Array,
        default: () => [],
    },
    selectedConsumables: {
        type: Array,
        default: () => [],
    },
    equipments: {
        type: Array,
        default: () => [],
    },
    selectedEquipments: {
        type: Array,
        default: () => [],
    },
    users: {
        type: Array,
        default: () => [],
    },
    selectedUsers: {
        type: Array,
        default: () => [],
    },
    isUpdate: Boolean,
});

const task_types = [
    "maintenance",
    "sowing",
    "fertilizing",
    "spraying",
    "harvesting",
    "plowing",
    "cultivation",
    "other",
];

const form = useForm({
    task_name: null,
    task_description: null,
    task_type: null,
    task_status: false,
    consumables: [],
    equipments: [],
    users: [],
    field_id: null,
    group_id: props.group,
});

if (props.task) {
    form.task_name = props.task.task_name;
    form.task_description = props.task.task_description;
    form.task_type = props.task.task_type;
    form.task_status = props.task.task_status;
    form.consumables = props.selectedConsumables;
}

const updateEquipmentsId = (selectedEquipmentsId) => {
    form.equipments = selectedEquipmentsId;
};
const updateUsersId = (selectedUsersId) => {
    form.users = selectedUsersId;
};
const updateConsumablesId = (selectedConsumablesId) => {
    form.consumables = selectedConsumablesId;
};

let submit = () => {
    if (props.isUpdate) form.post(`/tasks/${props.task.id}/update`);
    else form.post("/tasks/create");
};

let back = () => {
    window.history.back();
};
</script>

<template>
    <form @submit.prevent="submit" class="space-y-4 py-6">
        <h1 class="text-xl font-bold">
            {{ isUpdate ? "Update" : "Add new" }} task
        </h1>
        <div class="grid grid-cols-1">
            <div>
                <input
                    type="text"
                    name="task_description"
                    id="task_description"
                    placeholder="Enter task name"
                    v-model="form.task_name"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
                <p class="text-red-500" v-if="form.errors.task_name">
                    {{ form.errors.task_name }}
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1">
            <div class="">
                <textarea
                    rows="5"
                    placeholder="Enter task description"
                    v-model="form.task_description"
                    class="appearance-none block w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-gray-800 outline-none focus:border-[#6A64F1] focus:shadow-md"
                ></textarea>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-2 lg:grid-cols-3 lg:gap-4">
            <multi-select
                :items="users"
                :initialItems="selectedUsers"
                :label="'User'"
                :errors="form.errors.users"
                :keys="['first_name', 'last_name']"
            />

            <multi-select
                :initialItems="selectedEquipments"
                :items="equipments"
                :label="'Equipment'"
                :errors="form.errors.equipments"
                :keys="['brand_name', 'model_name']"
            />
        </div>

        <div class="-mx-3"></div>

        <div class="grid grid-cols-1 gap-2 lg:grid-cols-2 lg:gap-4">
            <div>
                <label class="mb-3 block text-base font-medium">
                    Task Status
                </label>
                <div class="flex items-center space-x-6">
                    <div class="flex items-center">
                        <input
                            type="radio"
                            name="task_status"
                            id="statusPending"
                            class="h-5 w-5"
                            v-model="form.task_status"
                            value="false"
                        />
                        <label
                            for="statusPending"
                            class="pl-3 text-base font-medium"
                        >
                            Pending
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input
                            type="radio"
                            name="task_status"
                            id="statusCompleted"
                            class="h-5 w-5"
                            v-model="form.task_status"
                            value="true"
                        />
                        <label
                            for="statusCompleted"
                            class="pl-3 text-base font-medium"
                        >
                            Completed
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <label for="task_type" class="mb-3 block text-base font-medium">
                    Task Type
                </label>
                <select
                    id="task_type"
                    v-model="form.task_type"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"
                >
                    <option value="" disabled>Select a task type</option>
                    <option v-for="type in task_types" :value="type">
                        {{ type }}
                    </option>
                </select>
                <p class="text-red-500" v-if="form.errors.task_type">
                    {{ form.errors.task_type }}
                </p>
            </div>
        </div>

        <div class="space-x-8">
            <Link
                @click.prevent="back"
                as="button"
                class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
            >
                Back
            </Link>
            <button
                type="submit"
                class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
            >
                {{ isUpdate ? "Update" : "Create" }}
            </button>
        </div>
    </form>
</template>

<style scoped></style>
