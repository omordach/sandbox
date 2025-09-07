<template>
  <div class="card p-8 text-center">
    <div class="mx-auto mb-3 inline-flex h-12 w-12 items-center justify-center rounded-full bg-black/5 dark:bg-white/5">
      <slot name="icon">🙂</slot>
    </div>
    <h3 class="text-lg font-semibold"><slot name="title">Nothing here</slot></h3>
    <p class="mt-1 text-[hsl(var(--muted))]"><slot name="description">Try adjusting your filters.</slot></p>
    <div class="mt-4">
      <slot name="action" />
    </div>
  </div>
</template>
<script setup lang="ts"></script>

