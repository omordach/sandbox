<template>
  <button
    type="button"
    class="px-3 py-1.5 text-sm rounded bg-gray-100 hover:bg-gray-200 border border-gray-300"
    @click="copy"
  >
    <span v-if="copied">Copied!</span>
    <span v-else>Copy link</span>
  </button>
  <span v-if="error" class="ml-2 text-sm text-red-600">{{ error }}</span>
  <span v-else-if="copied" class="ml-2 text-sm text-gray-500">You can paste it anywhere.</span>
  
</template>

<script setup lang="ts">
import { ref } from 'vue';

interface Props {
  url: string;
}

const props = defineProps<Props>();

const copied = ref(false);
const error = ref('');

async function copy() {
  try {
    await navigator.clipboard.writeText(props.url);
    copied.value = true;
    error.value = '';
    setTimeout(() => (copied.value = false), 1500);
  } catch (e) {
    error.value = 'Clipboard not available';
  }
}
</script>

