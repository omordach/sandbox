import { defineConfig } from '@playwright/test';

export default defineConfig({
    testDir: './tests/e2e',
    webServer: {
        command: 'node tests/e2e/server.js',
        port: 8000,
        reuseExistingServer: !process.env.CI,
    },
    use: {
        baseURL: 'http://127.0.0.1:8000',
    },
});
