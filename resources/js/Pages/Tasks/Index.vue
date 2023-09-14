<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Toast from '@/Components/Toast.vue';
import { useToaster } from '../../Composables/useToaster';
import Table from '@/Components/Table.vue'
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    tasks: Array,
    projects: Array
});

const { show, close } = useToaster();
const title = ref('Tasks');


const columns = [
    { label: '#', field: 'id' },
    { label: 'Name', field: 'name' },
    { label: 'Priority', field: 'priority' },
]


const project_id = ref('');

const filterTasks = () => {
    if (project_id.value) {
        router.get(route('tasks.index', { project_id: project_id.value }));
    } else {
        router.get(route('tasks.index'));
    }
}

onMounted(() => {
    const queryString = window.location?.search;
    const parameters = new URLSearchParams(queryString);
    const value = parameters.get('project_id');
    if (value) {
        project_id.value = value
    }
})

</script>

<template>
    <AuthenticatedLayout :title="title">
        <Toast :show="show" :close="close" />
        <template #header>
            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Tasks
                    </h2>
                    <div class="mt-4">
                        <select name="projects" id="projects" @change="filterTasks" v-model="project_id"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded block w-1/2 mt-1">
                            <option value="">Select Project</option>
                            <option v-for="project in projects" :value="project.id">{{ project.name }}</option>
                        </select>
                    </div>
                </div>
                <div>
                    <Link :href="route('tasks.create')">
                    <SecondaryButton class="float-right">
                        Create Task
                    </SecondaryButton>
                    </Link>
                </div>
            </div>
        </template>
        <Table :items="tasks" :columns="columns" :resource="'tasks'" :draggable="true" />
    </AuthenticatedLayout>
</template>
