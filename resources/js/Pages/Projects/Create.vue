<script setup>
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const form = useForm({
    name: '',
});

const createProject = () => {
    form.post(route('projects.store'));
};

const title = ref('Create Project');

</script>


<template>
    <AuthenticatedLayout :title="title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Project
            </h2>
        </template>
        <div>
            <div class="mx-auto lg:py-8 sm:py-6 xl:px-8">
                <FormSection @submitted="createProject">
                    <template #form>
                        <div class="col-span-6 lg:col-span-3">
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" v-model="form.name" type="text"
                                class="radius-input shadow-none block w-full mt-1" autofocus required />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
