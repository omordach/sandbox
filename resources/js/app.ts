import '../css/app.css';
import { createApp } from 'vue';
import CopyLink from './components/CopyLink.vue';

// Progressive enhancement: mount Vue only where needed
// Find all <copy-link> tags and mount the component on each
document.addEventListener('DOMContentLoaded', () => {
    const nodes = document.querySelectorAll<HTMLElement>('copy-link');
    nodes.forEach((node) => {
        const url = node.getAttribute('url') ?? '';
        const app = createApp(CopyLink, { url });
        app.mount(node);
    });
});
