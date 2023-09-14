import { ref, watch, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

export function useToaster() {
  const show = ref(false);

  const close = () => {
    show.value = false;
  };

  const page = usePage();
  
  watch(show, () => {
    if (page.props.success || page.props.error || page.props.warning || show.value) {
      setTimeout(() => close(), 4000);
    }
  });

  onMounted(() => {
    show.value = true;
  });

  return {
    show,
    close,
  };
}
