import { beforeEach, describe, expect, it } from 'vitest';
import { updateTheme, useAppearance } from '../useAppearance';

describe('useAppearance', () => {
    beforeEach(() => {
        document.cookie = '';
        localStorage.clear();
        document.documentElement.classList.remove('dark');
    });

    it('applies dark theme', () => {
        updateTheme('dark');
        expect(document.documentElement.classList.contains('dark')).toBe(true);
    });

    it('persists appearance selection', () => {
        const { updateAppearance } = useAppearance();
        updateAppearance('light');

        expect(localStorage.getItem('appearance')).toBe('light');
        expect(document.cookie).toContain('appearance=light');
    });
});
