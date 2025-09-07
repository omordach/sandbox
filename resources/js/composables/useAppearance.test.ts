import { beforeEach, describe, expect, it } from 'vitest';
import { mount } from '@vue/test-utils';
import { defineComponent } from 'vue';
import { useAppearance } from './useAppearance';

const setup = () =>
    mount(defineComponent({
        setup() {
            return useAppearance();
        },
        template: '<div></div>',
    }));

describe('useAppearance', () => {
    beforeEach(() => {
        localStorage.clear();
        document.documentElement.className = '';
        document.cookie = '';
    });

    it('defaults to system', () => {
        const wrapper = setup();
        expect(wrapper.vm.appearance).toBe('system');
    });

    it('updates and persists appearance', () => {
        const wrapper = setup();
        wrapper.vm.updateAppearance('dark');

        expect(wrapper.vm.appearance).toBe('dark');
        expect(localStorage.getItem('appearance')).toBe('dark');
        expect(document.documentElement.classList.contains('dark')).toBe(true);
    });
});
