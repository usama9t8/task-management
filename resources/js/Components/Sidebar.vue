<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    title: String,
});

const openHamMenu = ref(false)

const logout = () => {
    router.post(route('logout'));
};
</script>
<template>
    <div class="md:flex flex-col md:flex-row md:min-h-screen h-full w-full">
        <div class="flex flex-col w-full text-gray-700 sidebar-bg flex-shrink-0">
            <div class=" flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
                <button class="md:hidden rounded focus:outline-none focus:shadow-outline"
                    @click="openHamMenu = !openHamMenu">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6 text-dark">
                        <path v-show="!openHamMenu" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path v-show="openHamMenu" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <nav :class="openHamMenu ? 'block' : 'hidden'" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
                <span class="block w-full">
                    <button type="button"
                        class="block w-full px-3 py-2 border font-semibold border-transparent text-md leading-4 rounded-md text-gray-100 hover:text-gray-500 focus:outline-none transition">
                        <span class="flex items-center text-gray-100">
                            <img src="/images/user-placeholder.png" class="h-10 w-10 rounded-full object-cover mr-4"> {{
                                $page.props.auth.user.name }}
                        </span>
                    </button>
                </span>
                <Link :href="route('dashboard')" :class="route().current('dashboard') ? 'md:bg-slate-700 bg-gray-200' : ''"
                    class="block px-3 py-2 mt-2 text-md font-semibold text-gray-100 rounded hover:text-gray-500 focus:text-gray-500 focus:outline-none focus:shadow-outline">
                Home
                </Link>
                <Link :href="route('profile.edit')"
                    :class="route().current('profile.edit') ? 'md:bg-slate-700 bg-gray-200' : ''"
                    class="block px-3 py-2 mt-2 text-md font-semibold text-gray-100 rounded hover:text-gray-500 focus:text-gray-500 focus:outline-none focus:shadow-outline">
                My Profile
                </Link>
                <Link :href="route('projects.index')"
                    :class="route().current('projects.index') ? 'md:bg-slate-700 bg-gray-200' : ''"
                    class="block px-3 py-2 mt-2 text-md font-semibold text-gray-100 rounded hover:text-gray-500 focus:text-gray-500 focus:outline-none focus:shadow-outline">
                Projects
                </Link>
                <Link :href="route('tasks.index')"
                    :class="route().current('tasks.index') ? 'md:bg-slate-700 bg-gray-200' : ''"
                    class="block px-3 py-2 mt-2 text-md font-semibold text-gray-100 rounded hover:text-gray-500 focus:text-gray-500 focus:outline-none focus:shadow-outline">
                Tasks
                </Link>
                <div class="border-t border-color-white pt-3 mt-8">
                    <form @submit.prevent="logout">
                        <button as="button"
                            class="block w-full text-left px-3 py-2 mt-2 text-md text-gray-100 font-semibold bg-transparent rounded hover:text-gray-500 focus:text-gray-500 focus:outline-none focus:shadow-outline">
                            Log Out
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</template>