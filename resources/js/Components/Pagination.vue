<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    links: Array,
    total: Number,
    from: Number,
    to: Number 
})

</script>

<template>
    <div v-if="links.length > 3">
        <div>
            <div class="flex flex-wrap float-left text-xs text-gray-500 mt-2">Showing ({{ from }}-{{ to }}) of {{ total }}</div>
            <div class="flex flex-wrap float-right mb-1">
                <template v-for="(link, index) in links" :key="index">
                    <div v-if="link.url === null" class="mr-1 mb-1 px-3 py-2 text-sm leading-4 text-gray-400 border rounded"
                        v-html="link.label" />
                    <Link v-else
                        class="mr-1 mb-1 px-3 py-2 text-sm leading-4 border rounded hover:bg-slate-100 hover:text-black focus:border-slate-500 focus:text-slate-900"
                        :class="{ 'bg-slate-700 text-white': link.active }" :href="link.url" v-html="link.label" />
                </template>
            </div>
        </div>
    </div>
</template>
