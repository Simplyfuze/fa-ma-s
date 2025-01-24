<script setup>

import menubutton from "./MenuButton.vue";
import {Link, usePage} from "@inertiajs/vue3";

import { computed } from 'vue'

const page = usePage()

const user = computed(() => page.props.auth.user)

</script>

<template>
    <header class="fixed w-full bg-white text-indigo-800 z-50 shadow-lg animate-slide-down">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between h-16">
            <button class="mobile-menu-button p-2 lg:hidden">
                <span class="material-icons-outlined text-2xl">menu</span>
            </button>
            <div class="text-xl font-bold text-indigo-800">
                Farming Management System
            </div>
            <p class="text-xl font-bold text-indigo-800">
                {{user.first_name}} {{user.last_name}}
            </p>
        </div>
    </header>

    <div class="pt-16 max-w-7xl mx-auto flex">
        <aside class="sidebar fixed lg:static w-[240px] lg:h-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-45 overflow-y-auto p-4">
            <div class="bg-white rounded-xl shadow-lg mb-6 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <Link href="/" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                   Groups
                </Link>
                <div v-if="user.role === 'admin' || user.role === 'farmer'">
                    <menubutton href="/equipments">
                        Equipment
                    </menubutton>
                    <menubutton href="/consumables">
                        Consumables
                    </menubutton>
                    <menubutton href="/fields">
                        Fields
                    </menubutton>
                </div>
                <menubutton href="/users" v-if="user.role === 'admin'">
                    Users
                </menubutton>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <Link href="/logout" method="post" as="button" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                    Log Out
                </Link>
            </div>
        </aside>

        <main class="flex-1 p-4">
            <slot/>
        </main>
    </div>
</template>

<style scoped>

:root {
    --header-height: 4rem;
    --sidebar-width: 240px;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animate-slide-down {
    animation: slideDown 0.5s ease-out;
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}

.animate-slide-up {
    animation: slideUp 0.5s ease-out forwards;
}
</style>
