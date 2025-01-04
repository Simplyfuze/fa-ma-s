<script setup>

import {Link} from "@inertiajs/vue3";
import {TrashCan} from "@vicons/carbon";
import {Icon} from "@vicons/utils";

let props = defineProps({
    href : String,
})

</script>

<template>
    <li class="flex items-center justify-between border-t border-gray-200">
        <Link :href="href" class="w-4/5">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900"><slot/></h3>
                    <!--TODO: Add Equipment Type-->
                    <div class="text-sm font-medium text-gray-500">
                        <slot name="aside"/>
                    </div>
                </div>
                <div class="mt-4 flex items-center space-x-2 text-sm font-medium text-gray-500">
                    <slot name="secondary"/>
                </div>
            </div>
        </Link>

        <!--TODO: Make pagination or prevent scroll-->
        <Link method="post" :href="`${href}/delete`"
              class="p-2 me-8 text-gray-500 hover:text-red-500" as="button">
            <Icon size="32" class="cursor-pointer ">
                <TrashCan/>
            </Icon>
        </Link>

    </li>
</template>
