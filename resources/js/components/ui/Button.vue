<template>
  <button :class="cls" v-bind="$attrs"><slot /></button>
  </template>
<script setup lang="ts">
import { computed } from 'vue'
const props = defineProps<{ variant?: 'primary'|'ghost' }>()
const cls = computed(() => props.variant === 'primary' ? 'btn-primary' : 'btn-ghost')
</script>

