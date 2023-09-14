<script setup>
import Error from '@/Components/Error.vue';
import Success from '@/Components/Success.vue';
import Warning from '@/Components/Warning.vue';

const props = defineProps({
    show: Boolean,
    close: Function
})

</script>

<template>
    <TransitionGroup name="slide-fade">
        <div :key="1" class="fixed top-4 right-4 z-50" v-if="$page.props.success && show">
            <Success @close="close" />
        </div>
        <div :key="2" class="fixed top-4 right-4 z-50" v-if="$page.props.error && show">
            <Error @close="close" />
        </div>
        <div :key="3" class="fixed top-4 right-4 z-50" v-if="$page.props.warning && show">
            <Warning @close="close" />
        </div>
    </TransitionGroup>
</template>

<style>
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>