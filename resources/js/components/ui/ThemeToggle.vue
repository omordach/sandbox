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
  dark.value = !dark.value
  document.documentElement.classList.toggle('dark', dark.value)
  localStorage.setItem('theme', dark.value ? 'dark' : 'light')
}
const icon = computed(() => (dark.value ? SunIcon : MoonIcon))
</script>

