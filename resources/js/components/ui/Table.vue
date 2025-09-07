<template>
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead class="bg-black/5 dark:bg-white/5">
        <tr>
          <slot name="head" />
        </tr>
      </thead>
      <tbody class="divide-y divide-[hsl(var(--border))]">
        <slot />
      </tbody>
    </table>
  </div>
</template>
<script setup lang="ts"></script>

