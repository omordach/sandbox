<template>
  <div :class="cls"></div>
</template>
<script setup lang="ts">
import { computed } from 'vue'
const props = defineProps<{ class?: string }>()
const cls = computed(() => `animate-pulse rounded-md bg-black/10 dark:bg-white/10 ${props.class ?? ''}`)
</script>

