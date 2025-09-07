import { test, expect } from '@playwright/test';

test('homepage loads', async ({ page }) => {
    await page.goto('/');
    await expect(page.locator('#app')).toBeAttached();
});

test('ping returns pong', async ({ page }) => {
    const response = await page.goto('/ping');
    expect(await response?.text()).toBe('pong');
});
