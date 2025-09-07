<template>
  <select class="input" :value="modelValue" @change="onChange" v-bind="$attrs">
    <slot />
  </select>
</template>
<script setup lang="ts">
const props = defineProps<{ modelValue?: string | number | null }>()
const emit = defineEmits<{ 'update:modelValue': [value: string | number | null] }>()
function onChange(e: Event) {
  const t = e.target as HTMLSelectElement
  emit('update:modelValue', t.value)
}
</script>

