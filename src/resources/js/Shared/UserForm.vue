<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    user: {
        type: Object,
    },
    isUpdate: Boolean,
})

const form = useForm({
    first_name: null,
    last_name: null,
    role: null,
    email: null,
    password: null,
    password_confirmation : null,
})
if (props.user) {
    form.first_name = props.user.first_name;
    form.last_name = props.user.last_name;
    form.role = props.user.role;
    form.email = props.user.email;
    form.password = props.user.password;
}

let submit = () => {
    if (props.isUpdate)
        form.post(`/user/${props.user.id}/update`);
    else
        form.post(`/user/create`);
}
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6 py-6">
        <h1 class="text-xl font-bold">{{ isUpdate ? 'Update' : 'Add new' }} user</h1>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="first_name" class="mb-3 block text-base font-medium ">
                        First Name
                    </label>
                    <input type="text" name="first_name"
                           id="first_name" placeholder="First Name" v-model="form.first_name"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.first_name">{{ form.errors.first_name }}</p>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="last_name" class="mb-3 block text-base font-medium ">
                        Last Name
                    </label>
                    <input type="text" name="last_name"
                           id="last_name" placeholder="Last Name" v-model="form.last_name"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.last_name">{{ form.errors.last_name }}</p>
                </div>
            </div>
        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="date" class="mb-3 block text-base font-medium ">
                        E-mail
                    </label>
                    <input type="email" name="date" v-model="form.email"
                           id="registration_number" placeholder="e.g example@example.com"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</p>
                </div>
            </div>
        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="year_of_manufacture" class="mb-3 block text-base font-medium">
                        Password
                    </label>
                    <input type="text" name="password" v-model="form.password"
                           id="password" placeholder="Enter new password"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.password">{{ form.errors.password }}</p>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-3 block text-base font-medium ">
                        Confirm Password
                    </label>
                    <input type="email" name="date" v-model="form.password_confirmation"
                           id="password_confirmation" placeholder="Confirm password"
                           class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    <p class="text-red-500" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</p>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <label class="mb-3 block text-base font-medium ">
                Select role
            </label>
            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <input type="radio" name="radio1" id="radioButton1" class="h-5 w-5" v-model="form.role"
                           value="farmer"/>
                    <label for="radioButton1" class="pl-3 text-base font-medium ">
                        Farmer
                    </label>
                </div>
                <div class="flex items-center">
                    <input type="radio" name="radio1" id="radioButton2" class="h-5 w-5" v-model="form.role"
                           value="worker"/>
                    <label for="radioButton2" class="pl-3 text-base font-medium ">
                        Worker
                    </label>
                </div>
            </div>
        </div>

        <div class="space-x-8">
            <Link href="/users" as="button"
                  class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none" > Back</Link>
            <button
                class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                {{ isUpdate ? 'Update' : 'Create' }}
            </button>

        </div>
    </form>
</template>

<style scoped>

</style>
