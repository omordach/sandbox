<template>
  <transition name="fade" appear>
    <div v-if="show" class="fixed bottom-4 right-4 z-50">
      <div :class="wrapperCls">
        <component :is="icon" class="h-5 w-5" />
        <span>{{ message }}</span>
        <button class="btn-ghost ml-2" @click="$emit('close')" aria-label="Close">✕</button>
      </div>
    </div>
  </transition>
</template>
<script setup lang="ts">
import { computed } from 'vue'
import { CheckCircleIcon, XCircleIcon, ExclamationTriangleIcon, InformationCircleIcon } from '@heroicons/vue/24/solid'

const props = defineProps<{ show: boolean; type?: 'success'|'error'|'warning'|'info'; message: string }>()
const icon = computed(() => {
  switch (props.type) {
    case 'success': return CheckCircleIcon
    case 'error': return XCircleIcon
    case 'warning': return ExclamationTriangleIcon
    default: return InformationCircleIcon
  }
})
const wrapperCls = computed(() => {
  switch (props.type) {
    case 'success': return 'card px-4 py-3 flex items-center gap-2 text-emerald-700 dark:text-emerald-300'
    case 'error': return 'card px-4 py-3 flex items-center gap-2 text-rose-700 dark:text-rose-300'
    case 'warning': return 'card px-4 py-3 flex items-center gap-2 text-amber-800 dark:text-amber-300'
    default: return 'card px-4 py-3 flex items-center gap-2'
  }
})
</script>
<style>
.fade-enter-active, .fade-leave-active { transition: opacity .2s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>

