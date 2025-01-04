<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    equipment: {
        type: Object,
    },
    isUpdate: Boolean,
})

const form = useForm({
    brand_name: null,
    model_name: null,
    registration_number: null,
    year_of_manufacture: null,
})
if (props.equipment) {
    form.brand_name = props.equipment.brand_name;
    form.model_name = props.equipment.model_name ?? null;
    form.registration_number = props.equipment.registration_number ?? null;
    form.year_of_manufacture = props.equipment.year_of_manufacture ?? null;
}
let submit = () => {
    if (props.isUpdate)
        form.post(`/equipments/${props.equipment.id}/update`);
    else
        form.post(`/equipments/create`);
}
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6 py-6">
        <h1 class="text-xl font-bold">{{ isUpdate ? 'Update' : 'Add new' }} equipment</h1>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2 text-black">
                <div class="mb-5">
                    <label for="brand_name" class="mb-3 block text-base font-medium ">
                        Brand Name
                    </label>
                    <input type="text" name="brand_name"
                           id="brand_name" placeholder="Brand Name" v-model="form.brand_name"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.brand_name">{{ form.errors.brand_name }}</p>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="brand_name" class="mb-3 block text-base font-medium">
                        Model Name
                    </label>
                    <input type="text" name="model_name"
                           id="model_name" placeholder="Model Name" v-model="form.model_name"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.model_name">{{ form.errors.model_name }}</p>
                </div>
            </div>
        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="date" class="mb-3 block text-base font-medium">
                        Registration Number
                    </label>
                    <input type="text" name="date" v-model="form.registration_number"
                           id="registration_number" placeholder="e.g ВХ2345ВІ"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.registration_number">{{ form.errors.registration_number }}</p>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="year_of_manufacture" class="mb-3 block text-base font-medium">
                        Year Of Manufacture
                    </label>
                    <input type="text" name="year_of_manufacture" v-model="form.year_of_manufacture"
                           id="year_of_manufacture" placeholder="e.g 2005"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.brand_name">{{ form.errors.year_of_manufacture }}</p>
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
