<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    field: {
        type: Object,
    },
    isUpdate: Boolean,
})

const form = useForm({
    field_name: null,
    field_size: null,
})
if (props.field) {
    form.field_name = props.field.field_name;
    form.field_size = props.field.field_size ?? null;
}

let submit = () => {
    if (props.isUpdate)
        form.post(`/field/${props.field.id}/update`);
    else
        form.post(`/field/create`);
}
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6 py-6">
        <h1 class="text-xl font-bold">{{ isUpdate ? "Update" : "Add new" }} field</h1>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="field_name" class="mb-3 block text-base font-medium">
                        Field Name
                    </label>
                    <input type="text" name="field_name"
                           id="field_name" placeholder="Field Name" v-model="form.field_name"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.field_name">{{ form.errors.field_name }}</p>
                </div>
            </div>

        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="field_size" class="mb-3 block text-base font-medium">
                        Field Size (ha)
                    </label>
                    <input type="text" name="field_size"
                           id="field_size" placeholder="e.g 23" v-model="form.field_size"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.field_size">{{ form.errors.field_size }}</p>
                </div>
            </div>
        </div>

        <div>
            <button
                class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                {{ isUpdate ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</template>

<style scoped>

</style>
