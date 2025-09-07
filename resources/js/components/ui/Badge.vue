<template>
  <span :class="cls"><slot /></span>
</template>
<script setup lang="ts">
import { computed } from 'vue'
const props = defineProps<{ variant?: 'default'|'success'|'warning'|'danger'|'accent' }>()
const cls = computed(() => {
  switch (props.variant) {
    case 'success': return 'badge-success'
    case 'warning': return 'badge-warning'
    case 'danger': return 'badge-danger'
    case 'accent': return 'badge-accent'
    default: return 'badge'
  }
})
</script>

