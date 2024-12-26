<script setup>

import Layout from '../Layouts/Layout.vue'
import groupcard from "../Share/GroupCard.vue";
</script>

<template>
    <Layout>
        <div class="flex flex-col lg:flex-row gap-4 mb-6">
            <div class="flex-1 bg-indigo-100 border border-indigo-200 rounded-xl p-6 animate-fade-in">
                <h2 class="text-4xl md:text-5xl text-blue-900">
                    Welcome <br><strong></strong>
                </h2>
                <span class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-white bg-indigo-800">
                        01:51
                    </span>
            </div>

            <div class="flex-1 bg-blue-100 border border-blue-200 rounded-xl p-6 animate-fade-in">
                <h2 class="text-4xl md:text-5xl text-blue-900">
                    Uncompleted tasks <br><strong>23</strong>
                </h2>
                <a href="#" class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-white bg-blue-800 hover:bg-blue-900 transition-transform duration-300 hover:scale-105">
                    See messages
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <groupcard href="/group-1">
                Group 1
            </groupcard>
        </div>
    </Layout>
</template>

<style scoped>

</style>
