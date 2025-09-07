import '../css/app.css'
import './styles/a11y.css'
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

  // Enhance embedded certification iframes
  document.querySelectorAll<HTMLIFrameElement>('.cert-embed iframe').forEach((el) => {
    el.setAttribute('loading', 'lazy')
    el.setAttribute('width', '100%')
    el.setAttribute('height', '100%')
    el.style.width = '100%'
    el.style.height = '100%'
  })
})

// Optional: set keyboard-nav class when using Tab
window.addEventListener('keydown', (e) => {
  if (e.key === 'Tab') document.documentElement.classList.add('keyboard-nav')
})
