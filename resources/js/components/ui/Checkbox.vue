<template>
  <label class="inline-flex items-center gap-2">
    <input
      type="checkbox"
      class="rounded-md border-[hsl(var(--border))] text-[hsl(var(--brand))] focus:ring-[hsl(var(--brand))]"
      :checked="modelValue"
      @change="onChange"
      v-bind="$attrs"
    />
    <span><slot /></span>
  </label>
</template>
<script setup lang="ts">
const props = defineProps<{ modelValue?: boolean }>()
const emit = defineEmits<{ 'update:modelValue': [value: boolean] }>()
function onChange(e: Event) {
  const t = e.target as HTMLInputElement
  emit('update:modelValue', t.checked)
}
</script>

