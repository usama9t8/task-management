<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue'

defineProps({
    title: String,
});

</script>

<template>
    <div>

        <Head :title="title" />
        <div class="min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <div class="md:flex">
                <div class="md:w-2/12 w-full sidebar-area z-40">
                    <Sidebar />
                </div>
                <div class="flex-1 min-h-screen overflow-hidden">
                    <div class="flex">
                        <div class="container mx-auto xl:px-20 px-4 mt-6" :class="{ 'home-page': route().current('home') }">
                            <!-- Page Heading -->
                            <div class="mx-auto xl:px-8">
                                <header v-if="$slots.header" class="bg-white shadow py-6 px-4 sm:px-6 lg:px-8 rounded">
                                    <slot name="header" />

                                </header>

                            </div>
                            <!-- Page Content -->

                            <main>
                                <slot />
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
