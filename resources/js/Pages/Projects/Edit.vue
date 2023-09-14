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
    project: Object,
    update: Boolean
});

onMounted(() => {
    if (!props.update) {
        title.value = 'View Project'
    }
});

const form = useForm({
    name: props.project.name,
});

const updateProject = () => {
    form.put(route('projects.update', props.project));
};

const redirectBack = () => {
    window.location.href = route('projects.index');
};

const title = ref('Update Project')
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
                <FormSection @submitted="updateProject">
                    <template #form>
                        <div class="col-span-6 lg:col-span-3">
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" v-model="form.name" type="text"
                                class="radius-input shadow-none block w-full mt-1" autofocus :disabled="!update" required />
                            <InputError :message="form.errors.name" class="mt-2" />
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
