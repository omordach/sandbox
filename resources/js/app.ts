import '../css/app.css';
import { createApp } from 'vue';
import CopyLink from './components/CopyLink.vue';

// Minimal Vue boot (no SPA) mounted to #app
const app = createApp({});
app.component('copy-link', CopyLink);

const el = document.getElementById('app');
if (el) {
    app.mount('#app');
}
