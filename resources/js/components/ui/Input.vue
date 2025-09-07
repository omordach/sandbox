<template>
  <input
    :type="type"
    class="input"
    :value="modelValue"
    @input="onInput"
    v-bind="$attrs"
  />
</template>
<script setup lang="ts">
const props = defineProps<{ modelValue?: string | number | null; type?: string }>()
const emit = defineEmits<{ 'update:modelValue': [value: string | number | null] }>()
const type = props.type ?? 'text'
function onInput(e: Event) {
  const t = e.target as HTMLInputElement
  emit('update:modelValue', t.value)
}
</script>

