<template>
  <teleport to="body">
    <div v-if="open" class="fixed inset-0 z-50">
      <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="emit('close')" aria-hidden="true"></div>
      <div class="absolute inset-0 grid place-items-center p-4">
        <section
          role="dialog"
          aria-modal="true"
          :aria-label="ariaLabel"
          class="card p-6 w-full max-w-lg"
        >
          <header class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold"><slot name="title" /></h3>
            <button class="btn-ghost" @click="emit('close')" aria-label="Close">✕</button>
          </header>
          <div>
            <slot />
          </div>
          <footer class="mt-6 flex justify-end gap-2">
            <slot name="footer" />
          </footer>
        </section>
      </div>
    </div>
  </teleport>
</template>
<script setup lang="ts">
const props = defineProps<{ open: boolean; ariaLabel?: string }>()
const emit = defineEmits<{ close: [] }>()
const open = props.open
const ariaLabel = props.ariaLabel ?? 'Dialog'
</script>

