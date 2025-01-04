<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    consumable: {
        type: Object,
    },
    isUpdate: Boolean,
})

const form = useForm({
    consumable_name: null,
    consumable_type: null,
})
if (props.consumable) {
    form.consumable_name = props.consumable.consumable_name;
    form.consumable_type = props.consumable.consumable_type ?? null;
}
let submit = () => {
    if (props.isUpdate)
        form.post(`/consumables/${props.consumable.id}/update`);
    else
        form.post(`/consumables/create`);
}
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6 py-6">
        <h1 class="text-xl font-bold"> {{ isUpdate ? 'Update' : 'Add new'}} consumable</h1>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="consumable_name" class="mb-3 block text-base font-medium">
                        Consumable Name
                    </label>
                    <input type="text" name="consumble_name"
                           id="consumable_name" placeholder="Consumable Type" v-model="form.consumable_name"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.consumable_name">{{ form.errors.consumable_name }}</p>
                </div>
            </div>

        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="consumable_type" class="mb-3 block text-base font-medium">
                        Consumable Type
                    </label>
                    <input type="text" name="model_name"
                           id="consumable_type" placeholder="e.g Herbicide" v-model="form.consumable_type"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.consumable_type">{{ form.errors.consumable_type }}</p>
                </div>
            </div>
        </div>

        <div>
            <button type="submit"
                class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                {{ isUpdate ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</template>

<style scoped>

</style>
