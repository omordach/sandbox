<template>
  <button class="btn-ghost" aria-label="Toggle theme" @click="toggle">
    <component :is="icon" class="h-5 w-5" />
  </button>
  </template>
<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { SunIcon, MoonIcon } from '@heroicons/vue/24/solid'
const dark = ref(false)
onMounted(() => { dark.value = document.documentElement.classList.contains('dark') })
const toggle = () => {
  // Avoid ugly cross-fades
  const html = document.documentElement
  html.classList.add('motion-reduce:transition-none','transition-none')
  dark.value = !dark.value
  html.classList.toggle('dark', dark.value)
  localStorage.setItem('theme', dark.value ? 'dark' : 'light')
  // Flush next frame then restore transitions
  requestAnimationFrame(() => html.classList.remove('motion-reduce:transition-none','transition-none'))
}
const icon = computed(() => (dark.value ? SunIcon : MoonIcon))
</script>
