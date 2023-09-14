<script setup>
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';


const props = defineProps({
    task: Object,
    projects: Array,
    update: Boolean
});

onMounted(() => {
    if (!props.update) {
        title.value = 'View Task'
    }
});

const form = useForm({
    name: props.task.name,
    priority: props.task.priority,
    project_id: props.task.project_id,
});

const updateTask = () => {
    form.put(route('tasks.update', props.task));
};

const redirectBack = () => {
    window.location.href = route('tasks.index');
};

const title = ref('Update Task')
</script>


<template>
    <AuthenticatedLayout :title="title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>
        <div>
            <div class="mx-auto lg:py-8 sm:py-6 xl:px-8">
                <FormSection @submitted="updateTask">
                    <template #form>
                        <div class="col-span-6 lg:col-span-3">
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" v-model="form.name" type="text"
                                class="radius-input shadow-none block w-full mt-1" autofocus required />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <InputLabel for="priority" value="Priority" />
                            <TextInput id="priority" v-model="form.priority" type="text"
                                class="radius-input shadow-none block w-full mt-1" autofocus readonly />
                            <InputError :message="form.errors.priority" class="mt-2" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <InputLabel for="project_id" value="Project" />
                            <select v-model="form.project_id" name="project_id"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded block w-full mt-1">
                                <option value="">Select Project</option>
                                <option v-for="project in projects" :value="project.id" :key="project.id">{{ project.name
                                }}</option>
                            </select>
                            <InputError :message="form.errors.project_id" class="mt-2" />
                        </div>
                    </template>
                    <template #actions>
                        <SecondaryButton :type="'button'" @click="redirectBack">
                            Close
                        </SecondaryButton>
                        <PrimaryButton v-if="props.update" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" class="ml-4">
                            Update
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
