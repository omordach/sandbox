<template>
  <div class="flex min-h-screen flex-col">
    <header class="border-b border-[hsl(var(--border))]">
      <div class="container-page h-16 flex items-center justify-between">
        <a href="/" class="font-semibold">YourApp</a>
        <nav class="flex items-center gap-2">
          <button class="btn-ghost" @click="$router?.push?.('/features')">Features</button>
          <button class="btn-ghost" @click="$router?.push?.('/docs')">Docs</button>
          <ThemeToggle />
          <Button variant="primary">Get Started</Button>
        </nav>
      </div>
    </header>
    <main class="flex-1">
      <section class="container-page py-16">
        <div class="grid gap-8 lg:grid-cols-2 items-center">
          <div>
            <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Ship faster with a clean UI</h1>
            <p class="mt-4 text-lg text-[hsl(var(--muted))]">Vue + Tailwind starter with tokens, dark mode, and accessible components.</p>
            <div class="mt-6 flex gap-3">
              <Button variant="primary">Primary action</Button>
              <Button>Secondary</Button>
            </div>
          </div>
          <Card>
            <h2 class="text-xl font-semibold">Highlights</h2>
            <ul class="mt-4 grid gap-3">
              <li class="badge">Dark mode</li>
              <li class="badge">TypeScript</li>
              <li class="badge">A11y-first</li>
              <li class="badge">Responsive</li>
            </ul>
          </Card>
        </div>
      </section>
    </main>
    <footer class="border-t border-[hsl(var(--border))]">
      <div class="container-page h-16 flex items-center justify-between text-sm text-[hsl(var(--muted))]">
        <span>© {{ new Date().getFullYear() }} YourApp</span>
        <a href="/privacy" class="hover:underline">Privacy</a>
      </div>
    </footer>
  </div>
</template>
<script setup lang="ts">
import ThemeToggle from './components/ui/ThemeToggle.vue'
import Button from './components/ui/Button.vue'
import Card from './components/ui/Card.vue'
</script>

