<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Toast from '@/Components/Toast.vue';
import { useToaster } from '../../Composables/useToaster';
import Table from '@/Components/Table.vue'
import { ref } from 'vue';


defineProps({
    projects: Array,
});

const { show, close } = useToaster();
const title = ref('Projects');

const columns = [
    { label: '#', field: 'id' },
    { label: 'Name', field: 'name' },
]

</script>

<template>
    <AuthenticatedLayout :title="title">
        <Toast :show="show" :close="close" />
        <template #header>
            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Projects
                    </h2>
                </div>
                <div>
                    <Link :href="route('projects.create')">
                    <SecondaryButton class="float-right">
                        Create Project
                    </SecondaryButton>
                    </Link>
                </div>
            </div>
        </template>
        <Table :items="projects" :columns="columns" :resource="'projects'" />
    </AuthenticatedLayout>
</template>
