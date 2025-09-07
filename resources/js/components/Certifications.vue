<template>
  <div class="min-h-screen bg-gray-50 py-10">
    <h1 class="mb-8 text-center text-4xl font-bold">My Certifications</h1>
    <div class="flex flex-wrap justify-center gap-6">
      <div v-for="id in badgeIds" :key="id">
        <div
          :data-share-badge-id="id"
          data-share-badge-host="https://www.credly.com"
          data-iframe-width="150"
          data-iframe-height="270"
        ></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'

const badgeIds = [
  'ab4c5958-13e5-4af3-9092-2231a1925459',
]

onMounted(() => {
  const scriptId = 'credly-embed'
  if (!document.getElementById(scriptId)) {
    const script = document.createElement('script')
    script.id = scriptId
    script.async = true
    script.src = 'https://cdn.credly.com/assets/utilities/embed.js'
    document.body.appendChild(script)
  }
})
</script>
