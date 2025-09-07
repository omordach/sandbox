import '../css/app.css'
import { createApp } from 'vue'
import App from './App.vue'
import CopyLink from './components/CopyLink.vue'
import ThemeToggle from './components/ui/ThemeToggle.vue'

// Progressive enhancement: mount Vue only where needed
document.addEventListener('DOMContentLoaded', () => {
  // Mount App.vue if #app-root exists
  const root = document.getElementById('app-root')
  if (root) {
    createApp(App).mount(root)
  }

  // Mount all <copy-link> tags
  const copyNodes = document.querySelectorAll<HTMLElement>('copy-link')
  copyNodes.forEach((node) => {
    const url = node.getAttribute('url') ?? ''
    const app = createApp(CopyLink, { url })
    app.mount(node)
  })

  // Mount all <theme-toggle> tags
  const themeNodes = document.querySelectorAll<HTMLElement>('theme-toggle')
  themeNodes.forEach((node) => {
    const app = createApp(ThemeToggle)
    app.mount(node)
  })
})
